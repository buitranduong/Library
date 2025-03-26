<?php

namespace AnChoi;

use Laven\TinhDiemSim;

class REST_BatTrach_Controller {

    // Here initialize our namespace and resource name.
    public $namespace;
    public $resource_name;
    public $schema;

    public function __construct() {
        $this->namespace = '/bat-trach/v1';
        $this->resource_name = 'la-so';
    }

    // Register our routes.
    public function register_routes() {
        register_rest_route($this->namespace, '/' . $this->resource_name, array(
            // Here we register the readable endpoint for collections.
            array(
                'methods' => 'GET',
                'callback' => [
                    $this,
                    'lay_la_so',
                ],
                'args' => [
                    'date' => [
                        'required' => true,
                        'validate_callback' => function($param, $request, $key) {
                            $dateOfBirthExploded = explode("-", $param);
                            if (count($dateOfBirthExploded) != 3) {
                                return false;
                            }
                            $date = (1 <= $dateOfBirthExploded[0]) && ($dateOfBirthExploded[0] <= 31);
                            $month = (1 <= $dateOfBirthExploded[1]) && ($dateOfBirthExploded[1] <= 12);
                            $year = (1900 <= $dateOfBirthExploded[2]) && ($dateOfBirthExploded[2] <= 2900);
                            return $date && $month && $year;
                        },
                    ],
                    'build_at' => [
                        'required' => true,
                        'validate_callback' => function($param, $request, $key) {
                            return is_numeric($param) && ($param >= 1900 && $param <= 2900);
                        },
                    ],
                    'hour' => [
                        'required' => true,
                        'validate_callback' => function($param, $request, $key) {
                            return is_numeric($param) && ($param >= 0 && $param <= 23);
                        },
                    ],
                    'minute' => [
                        'required' => true,
                        'validate_callback' => function($param, $request, $key) {
                            return is_numeric($param) && ($param >= 0 && $param <= 59);
                        },
                    ],
                    'gender' => [
                        'required' => true,
                        'validate_callback' => function($param, $request, $key) {
                            return is_numeric($param) && ($param >= 0 && $param <= 1);
                        },
                    ],
                ],
            /* 'permission_callback' => array(
              $this,
              'get_items_permissions_check',
              ), */
            ),
                //  Register our schema callback.
//            'schema' => array(
//                $this,
//                'get_item_schema',
//            ),
        ));
    }

    public function lay_la_so($data) {
        $params = $data->get_params();

        $dateOfBirthExploded = explode("-", $params['date']);
        $gioSinh = $params['hour'];
        $phutSinh = $params['minute'];
        $namXem = $params['build_at'];
        $gioiTinhVal = $params['gender'];
        $ngaySinh = $dateOfBirthExploded[0];
        $thangSinh = $dateOfBirthExploded[1];
        $namSinh = $dateOfBirthExploded[2];
        $ngaysinhFull = $ngaySinh . '-' . $thangSinh . '-' . $namSinh;
        $tuTru = new \Laven\LasoTutru($ngaysinhFull, $gioSinh, $phutSinh, $gioiTinhVal, 7, 'Vô danh khách');
        $batTu = $tuTru->tinhBatTu();
        $tietKhi = $tuTru->getTietKhiHienTai();
        $cungMenhThaiNguyen = $tuTru->tinhCungMenhThaiNguyen();
        $chuTinh = $tuTru->tinhChuTinh();
        $canTang = $tuTru->tinhCanTang();
        $nhatKien = $tuTru->tinhNhatKien();
        $nguyetKien = $tuTru->tinhNguyetKien();
        $vtsTru = $tuTru->vongTrangSinhTru();
        $daiVan = $tuTru->tinhDaiVan();
        $daiVanList = $tuTru->tinhDaiVanTieuVan();
        $napAm = $tuTru->tinhNapAm();
        $render = true;
        $nguHanhThaiNguyen = $tuTru->tinhNapAmThaiNguyen($cungMenhThaiNguyen['thai_nguyen']['can'] . $cungMenhThaiNguyen['thai_nguyen']['chi']);
        $lasoInfo = [];
        $namAmLich = 'Năm ' . $tuTru->canNamText . ' ' . $tuTru->chiNamText . ', tháng ' . $tuTru->canThangText . ' ' . $tuTru->chiThangText . ', ngày ' . $tuTru->canNgayText . ' ' . $tuTru->chiNgayText . ', giờ ' . $tuTru->canGioText . ' ' . $tuTru->chiGioText;
        $doVuong = $tuTru->tinhDoVuong();
        $doVuongSuy = $tuTru->tinhDoVuongSuy($doVuong);
        $total = array_sum($doVuongSuy['total']);
        $soNguHanh = floor($total * 0.4);
        $dungThan = $hyThan = $banMenhText = '';
        $lasoInfo = [];
        $lasoInfo['chuTinh'] = $chuTinh;
        $lasoInfo['canTang'] = $canTang;
        $lasoInfo['nhatKien'] = $nhatKien;
        $lasoInfo['nguyetKien'] = $nguyetKien;
        $lasoInfo['napAm'] = $napAm;
        $thanNhuoc = false;
        if ($doVuongSuy['cung_phe'] >= $soNguHanh) {
            $banMenhText = 'Vượng ' . $doVuongSuy['ban_menh']['title'];
            $dungThan = $doVuongSuy['ban_menh']['dung_than'];
            $hyThan = $doVuongSuy['ban_menh']['hy_than'];
        }
        if ($doVuongSuy['cung_phe'] < $soNguHanh) {
            $banMenhText = 'Nhược ' . $doVuongSuy['ban_menh']['title'];
            $dungThan = $doVuongSuy['ban_menh']['dung_than_2'];
            $hyThan = $doVuongSuy['ban_menh']['hy_than_2'];
            $thanNhuoc = true;
        }
        $dungThanId = $tuTru->getNguHanhId($dungThan);
        $hyThanId = $tuTru->getNguHanhId($hyThan);
        $diem = 0;
        $nguHanhBanMenh = $doVuongSuy['ban_menh']['name'];
        $menhChuGiaiNghia = '';

        $duNienArr = [
            'can' => ['name' => 'Càn', 'name2' => 'can', 'huong' => 'Hướng Tây Bắc', 'toa' => 'Tốn', 'toa2' => 'ton'],
            'kham' => ['name' => 'Khảm', 'name2' => 'kham', 'huong' => 'Hướng Bắc', 'toa' => 'Ly', 'toa2' => 'ly'],
            'can2' => ['name' => 'Cấn', 'name2' => 'can2', 'huong' => 'Hướng Đông Bắc', 'toa' => 'Khôn', 'toa2' => 'khon'],
            'chan' => ['name' => 'Chấn', 'name2' => 'chan', 'huong' => 'Hướng Đông', 'toa' => 'Đoài', 'toa2' => 'doai'],
            'ton' => ['name' => 'Tốn', 'name2' => 'ton', 'huong' => 'Hướng Đông Nam', 'toa' => 'Càn', 'toa2' => 'can'],
            'ly' => ['name' => 'Ly', 'name2' => 'ly', 'huong' => 'Hướng Nam', 'toa' => 'Khảm', 'toa2' => 'kham'],
            'khon' => ['name' => 'Khôn', 'name2' => 'khon', 'huong' => 'Hướng Tây Nam', 'toa' => 'Cấn', 'toa2' => 'can2'],
            'doai' => ['name' => 'Đoài', 'name2' => 'doai', 'huong' => 'Hướng Tây', 'toa' => 'Chấn', 'toa2' => 'chan'],
        ];
        $arrCuuDieu = [
            1 => ['id' => 1, 'name' => 'Nhất Bạch', 'menh' => 'Thủy', 'so' => [2, 3, 4, 5, 6, 7, 8, 9], 'text' => '<p>Nhất Bạch 1 (tham lang) thủy tinh (mầu trắng) đại diện cho thận,tai.máu huyết. (con trai thứ)<br>
                                Nhất bạch sinh vượng, chủ vượng cả đinh lẫn tài, lợi cho cả nghiệp văn lẫn nghiệp võ, trẻ tuổi thi cử đỗ đạt, tiếng tăm lừng lẫy, thường sinh con trai thông minh tài trí. Người làm quan sẽ gặp bổng lộc, thăng chức phát tài. Người thường gặp tin vui về tiền bạc. Đây là cát tinh hàng đầu trong Cửu tinh.
                                Khi lâm trạng thái suy tử dễ gây họa do đam mê tửu sắc, hoặc vì đam mê tửu sắc mà tan cửa nát nhà. Dễ mắc các bệnh về tai, suy thận, bệnh về bàng quang, sức khỏe giới tính và sinh sản. Nghiêm trọng thì hình khắc vợ, gây mù lòa, yểu mệnh, sống phiêu bạt
                                Nên đặt các vật dụng thuộc hành Kim như chuông gió bắng nhôm hoặc bằng đồng, tranh ảnh bằng đồng, thạch anh trắng...</p>'],
            2 => ['id' => 2, 'name' => 'Nhị Hắc', 'menh' => 'Thổ', 'so' => [3, 4, 5, 6, 7, 8, 9, 1], 'text' => '<p>Nhị Hắc 2 - (Cự Môn) Thổ tinh, màu đen.bụng và dạ dày, là mẹ hoặc vợ trong gia đình.<br>
                                Khi Cự môn gặp thế sinh vượng thì có quyền có của, cơ ngơi bề thế, vượng cả đinh lẫn tài, thường xuất hiện võ quý, phụ nữ cai quản gia đình, đa mưu, keo kiệt.
                                Khi sao này lâm trạng thái suy tử dễ gặp tai họa vì sắc, hoặc xảy ra hỏa hoạn. Dễ gây điều tiếng thị phi, làm hao tiền tốn của. Phụ nữ trong nhà dễ bị xảy thai, đau bụng, mụn nhọt và các bệnh ngoài da, đặc biệt ở cơ quan sinh sản phụ nữ và hai nách. Nếu nhà của âm u, ở lâu sẽ gặp cảnh phụ nữ ở góa cai quản gia đình, người ốm mắc bệnh lâu ngày không khỏi.</p><p><span class="red">Hóa giải:</span> Khu vực này không nên bài trí vật dụng mang hành Thổ hoặc Hỏa (vật liệu đá, gốm, sứ, nhựa, pha lê; màu vàng, nâu, đỏ, hồng… mà nên bài trí vật dụng, đặc biệt là các vật mang hành Kim (kim loại, màu trắng), vì Thổ sẽ suy yếu do phải sinh cho Kim. Nếu có bếp có sao này, thì nên treo tiền đồng trước bếp.<br>Nếu giường ngủ đặt tại sao này, không di chuyển được, hoặc phòng khách tại sao này, thì nên treo tiền đồng, hồ lô đồng; đèn ngũ hành bằng đồng, Lệnh Bài Trấn Trạch Cát tinh cao chiếu bằng đồng, Tháp Văn Xương bằng đồng, quả cầu thạch anh trắng, Đĩa thất tinh màu trắng, Tháp Văn Xương màu trắng v.v… để hóa giải sát khí Thổ của sao Nhị Hắc. Những vật dụng mang tính động như ti vi, tủ lạnh, quạt điện nên di chuyển khỏi vị trí của sao Nhị Hắc, vì khi khởi động chúng, tính hung hãn của ngôi sao này sẽ lan tỏa khắp nơi trong nhà.</p>'],
            3 => ['id' => 3, 'name' => 'Tam Bích', 'menh' => 'Mộc', 'so' => [4, 5, 6, 7, 8, 9, 1, 2], 'text' => '<p>Tam Bích 3 - (Lộc Tồn) thuộc Mộc.màu xanh, mật, vai và 2 tay.là con trai trưởng trong gia đình.<br>
                                Khi Tam bích sinh vượng chủ hưng gia lập nghiệp, giàu sang phú quý, công thành danh toại, vượng nhất ngành trưởng. Tam bích gặp suy tử chủ về dễ dính líu đến kiện tụng, dễ gặp trộm cướp, sinh bệnh tật hình khắc vợ con, dễ mắc các bệnh nhiễm trùng máu, bệnh về chân, bệnh liên quan đến gan và mật</p>
                            <p><span class="red">Hóa giải:</span> Cấm kỵ đặt các thiết bị phát sinh rung động hoặc tiếng ồn ở phương vị này (ti vi, tủ lạnh, quạt, chuông gió, thác nước v.v…). Tránh bày trí các vật kim loại ở đây, sẽ làm Tam Bích hung hãn thêm, và tránh làm tăng năng lượng Mộc của sao Tam bích, nên cần tránh bài trí hành Mộc (gỗ, màu xanh, cây cảnh) tại đây. Hóa giải bằng cách sử dụng vật phẩm phong thủy thuộc hành Hỏa như thảm màu đỏ, đèn tháp đỏ, quả cầu phong thủy bằng Thạch anh đỏ, hồng, cam, tím, hoặc động Thạch anh tím...</p>'],
            4 => ['id' => 4, 'name' => 'Tứ Lục', 'menh' => 'Mộc', 'so' => [5, 6, 7, 8, 9, 1, 2, 3], 'text' => '<p>Tứ Lục 4- (Văn Xương) thuộc Mộc.màu xanh dương. gan, đùi và 2 chân.là con gái trưởng trong gia đình.<br>
                                Khi sao này sinh vượng chủ thi cử đỗ đạt, quân tử thăng quan, tiểu nhân có tiền của, lấy được vợ hiền, chồng giỏi, có tài văn chương.<br>
                                Tứ lục lâm suy tử chủ mắc bệnh thần kinh, bị hen suyễn, sống phiêu bạt, vì đam mêm tửu sắc mà phá tan cơ nghiệp. Dễ bị xảy thai, dễ mắc bệnh ở vùng thắt lưng, dễ gặp tai nạn bất ngờ</p>'],
            5 => ['id' => 5, 'name' => 'Ngũ Hoàng đại sát', 'menh' => 'Thổ', 'so' => [6, 7, 8, 9, 1, 2, 3, 4], 'text' => '<p>Ngũ Hoàng 5 – (Liên Trinh) thuộc Thổ.màu vàng.<br>
                                Ngũ hoàng Thổ tinh ở vị trí giữa, chiếm địa vị cao quý, truyền lệnh đi bốn phương, do vậy hoàng đế các đời đều coi màu vàng là màu sắc của Đế quyền, họ tự xưng mình là rồng vàng, khoác hoàng bào.<br>
                                Khi Ngũ hoàng nhập trung cung được coi là cát tinh thì vượng cả đinh lần tài, sự nghiệp phát triển nhưng khi nó bay đến hướng khác sẽ trở thành đại hung, được coi là Ngũ hoàng đại sát, Mậu kỷ sát, được coi là sát tinh lớn nhất thế gian, nếu gặp Thái tuế hoặc Tam sát, Thất sát thì hung tướng phát tác, hại người mất của, nhẹ thì gặp tai họa, bệnh tật, nặng thì mất mạng năm người.<br>
                                Sao này khi ở trung cung mà sinh vượng thì vượng khí của nó ban ra khắp bốn phương, nhưng khi bay đến hướng khác dù sinh hay khắc đều bộc lộ hung tướng, khi ứng dụng thuật phong thủy phải hết sức đề phòng</p>
                            <p><span class="red">Hóa giải:</span> Tránh sử dụng các vật dụng màu đỏ, hoặc tạo ra lửa ở đây. Nếu có bếp hướng Nam, thì nên treo tiền 7 đồng trước bếp.
                                Ở tại phương này có thể đặt một vật thuộc Kim để hóa giải như Hồ Lô đồng, Đèn ngũ hành bằng đồng, Lệnh Bài Trấn Trạch Cát tinh cao chiếu bằng đồng, Long Quy bằng đồng, Tỳ Hưu bằng đồng, Thiềm Thừ bằng đồng, Ngũ Đế Tiền, Lục Đế Tiền, Chuông gió bằng nhôm hoặc bằng đồng, Tháp Văn Xương bằng đồng, Mã thượng phong hầu bằng đồng, Kỳ Lân đồng, Rồng bằng đồng, quả cầu phong thủy Thạch anh trắng, Tỳ Hưu màu trắng, Khỉ màu trắng, màu vàng kim, Tháp Văn Xương màu trắng, Đĩa thất tinh màu trắng, lấy Thổ sinh Kim, lấy Kim sinh Thủy ngũ hành tương sinh, gặp hung hóa cát. Dùng Kim hóa Thổ cũng làm chậm lại ác phá của Ngũ Hoàng Đại Sát.<br>
                                Nhưng hiệu quả nhất cho nhà ở hoặc công ty nên sử dụng con giải hạn xấu và sử dụng thêm 7 đồng tiền. Nếu các bạn có giường ngủ ở hướng Nam (so với trung tâm ngôi nhà), hoặc cửa phòng ngủ, hoặc cửa phòng làm việc ở hướng Nam (so với trung tâm phòng ngủ hoặc phòng làm việc), các bạn nên treo tiền đồng, hồ lô đồng, đèn ngũ hành đồng.<br>
                                Nếu tránh né nằm hướng khác di chuyển càng tốt….có thể đặt gường sắt tại phương bị này.<br>
                                Nếu nhà ở các bạn, hoặc công ty, hoặc văn phòng, hoặc cửa hàng kinh doanh, có cửa sổ ở hướng Nam, các bạn nên treo tiền đồng, hồ lô đồng, hoặc phong linh bằng kim loại.<br>Nếu các bạn có bếp hướng Nam, các bạn nên đổi hướng bếp hoặc treo tiền đồng trước bếp.</p>'],
            6 => ['id' => 6, 'name' => 'Lục Bạch', 'menh' => 'Kim', 'so' => [7, 8, 9, 1, 2, 3, 4, 5], 'text' => '<p>Lục Bạch 6- (Vũ Khúc) thuộc Kim.thuộc màu trắng. đầu, mũi, cổ, xương, ruột già.là chồng hoặc cha trong gia đình.<br>
                                Khi Vũ khúc đắc vận chủ lắm của đông người, quyền cao, chức trọng, phát lớn về nghiệp võ, uy danh lững lẫy bốn phương. Đây là cát tinh thứ ba trong Cửu tinh.<br>
                                Khi Vũ khúc thất vận dễ dính líu đến kiện tụng, hoặc vất vả chốn quan trường, lại dễ bị đau đầu, đau ngực, bị thương tích do kim loại. Với gia đình chủ hình hại vợ con, phải sống cô đơn, không nơi nương tựa.</p>
                            <p><span class="red">Hóa giải:</span> Nên treo hoặc đặt các vật phẩm phong thủy bằng kim loại như: Chuông gió bằng nhôm hoặc bằng đồng, Ngũ Đế tiền, Lục Đế Tiền, Long Quy, Kỳ Lân, Tỳ Hưu, Thiềm Thừ, chuông gió bằng kim loại, Hồ lô đồng, Lệnh Bài Trấn Trạch Cát tinh cao chiếu bằng đồng</p>'],
            7 => ['id' => 7, 'name' => 'Thất Xích', 'menh' => 'Kim', 'so' => [8, 9, 1, 2, 3, 4, 5, 6], 'text' => '<p>Thất Xích 7 – (Phá Quân) thuộc Kim. thuộc màu đỏ. phổi, miệng, lưỡi. là con gái út trong gia đình.<br>
                                Thất xích khi đắc vận vượng cả đinh lẫn tài, sự nghiệp phát đạt, chi út phát phúc, phát về nghiệp võ, quan vận hanh thông.<br>
                                Khi sao này thất vận chủ gây chuyện rắc rối, sống lưu lạc làm trộm cướp, chết vì tai nạn chiến tranh, hoặc phải ngồi tù. Với gia đình dễ gây hỏa hoạn, tổn thất nhân khẩu, bị mắc các bệnh về đường hô hấp như phổi, cổ họng, đặc biệt bất lợi cho bé gái</p>
                            <p><span class="red">Hóa giải:</span> Tránh đặt các thiết bị phát sinh tiếng ồn ở phương vị này.</p>'],
            8 => ['id' => 8, 'name' => 'Bát Bạch', 'menh' => 'Thổ', 'so' => [9, 1, 2, 3, 4, 5, 6, 7], 'text' => '<p>Bát Bạch 8 – (Tả Phù) thuộc Thổ.thuộc màu trắng. lưng, ngực và lá lách.là con trai út trong gia đình.<br>
                                Khi sinh vượng chủ công danh phú quý, nên lập nghiệp để vượng tài, nghỉ ngơi dưỡng sức. Do sao này có bản tính hiền lành, hiếu nghĩa trung lương, có thể hóa giải hung sát, cho nên Tả phù là cát tinh thứ hai trong Cửu tinh<br>
                                Gặp lúc thất vận chủ tổn hại đến trẻ nhỏ, bị các bệnh liên quan đến tay chân, gân cốt, sống lưng, trướng bụng<br>
                                Có thể bố trí ở phương vị này các vật phong thủy thuộc hành Hỏa hoặc hành Thổ, có thể bày thảm đỏ, vật dụng màu đỏ, quả cầu phong thủy bằng Thạch anh đỏ, hồng, cam, tím, hoặc động Thạch anh tím, hoặc đĩa Thất tinh Thạch anh tím, hoặc đỏ, hồng, cam...</p>'],
            9 => ['id' => 9, 'name' => 'Cửu Tử', 'menh' => 'Hỏa', 'so' => [1, 2, 3, 4, 5, 6, 7, 8], 'text' => '<p>Cửu Tử 9 – (Hữu Bật) thuộc Hỏa. màu đỏ, mắt, tim, ấn đường. con gái thứ trong gia đình.<br>
                                Khi sinh vương thì phát phúc rất nhanh, vượng cả đinh lẫn tài, sự nghiệp ổn định lại có tài văn chương xuấ chúng, nên hiển đạt chóng vánh, đặc biệt phát phúc cho chi thứ.<br>
                                Khi lâm suy tử chủ tính tình kiên cường, khí khái, dễ bị hỏa hoạn. Với thân thể, dễ bị thổ huyết, bị điên, khó sinh, bệnh về tim và mạch máu.<br>
                                Hữu bật còn gọi là quý nhân, là trợ tinh của chòm sao Bắc Đẩu, trong phong thủy chủ về thi cử đỗ đạt, vinh hoa hiển đạt, lạc quan tiến thủ.<br>
                                Vị trí này thích hợp để đặt các thứ đồ động, kê giường, bàn làm việc… tất có cát khánh hỷ khí giáng lâm nhanh chóng, chủ có giàu có về nhà đất, thăng quan nhậm chức, khiến cho sự nghiệp cùng cá nhân phát triển mọi mặt, thành tích của bạn được công nhận và khen thưởng, phú kham địch quốc, đứng đầu chỗ làm, hỷ sự trùng phùng.</p>'],
        ];
        $namArr = str_split($namXem);
        $soCuDieu = $namArr[2] + $namArr[3];
        if ($soCuDieu > 9) {
            $soCuDieu = array_sum(str_split($soCuDieu));
        }
        $soTru = $namXem >= 2000 ? 9 : 10;
        $soCuDieu = $soTru - $soCuDieu;
        if ($soCuDieu == 0) {
            $soCuDieu = 9;
        }
        $cuuDieuInfo = $arrCuuDieu[$soCuDieu];
        $dongNam = $arrCuuDieu[$cuuDieuInfo['so'][7]];
        $chinhNam = $arrCuuDieu[$cuuDieuInfo['so'][3]];
        $tayNam = $arrCuuDieu[$cuuDieuInfo['so'][5]];
        $chinhDong = $arrCuuDieu[$cuuDieuInfo['so'][6]];
        $chinhTay = $arrCuuDieu[$cuuDieuInfo['so'][1]];
        $dongBac = $arrCuuDieu[$cuuDieuInfo['so'][2]];
        $chinhBac = $arrCuuDieu[$cuuDieuInfo['so'][4]];
        $tayBac = $arrCuuDieu[$cuuDieuInfo['so'][0]];
        $luanGiaiCuuDieu = '';
        $luanGiaiCuuDieu .= '<div class="cuu-dieu"><span class="bold ' . khongdau($dongNam['menh']) . '">- Đông Nam - ' . $dongNam['name'] . ' - ' . $dongNam['menh'] . '</span>' . $dongNam['text'] . '</div>';
        $luanGiaiCuuDieu .= '<div class="cuu-dieu"><span class="bold ' . khongdau($chinhNam['menh']) . '">- Chính Nam - ' . $chinhNam['name'] . ' - ' . $chinhNam['menh'] . '</span>' . $chinhNam['text'] . '</div>';
        $luanGiaiCuuDieu .= '<div class="cuu-dieu"><span class="bold ' . khongdau($tayNam['menh']) . '">- Tây Nam - ' . $tayNam['name'] . ' - ' . $tayNam['menh'] . '</span>' . $tayNam['text'] . '</div>';
        $luanGiaiCuuDieu .= '<div class="cuu-dieu"><span class="bold ' . khongdau($chinhDong['menh']) . '">- Chính Đông - ' . $chinhDong['name'] . ' - ' . $chinhDong['menh'] . '</span>' . $chinhDong['text'] . '</div>';
        $luanGiaiCuuDieu .= '<div class="cuu-dieu"><span class="bold ' . khongdau($cuuDieuInfo['menh']) . '">- Trung cung - ' . $cuuDieuInfo['name'] . ' - ' . $cuuDieuInfo['menh'] . '</span>' . $cuuDieuInfo['text'] . '</div>';
        $luanGiaiCuuDieu .= '<div class="cuu-dieu"><span class="bold ' . khongdau($chinhTay['menh']) . '">- Chính Tây - ' . $chinhTay['name'] . ' - ' . $chinhTay['menh'] . '</span>' . $chinhTay['text'] . '</div>';
        $luanGiaiCuuDieu .= '<div class="cuu-dieu"><span class="bold ' . khongdau($dongBac['menh']) . '">- Đông bắc - ' . $dongBac['name'] . ' - ' . $dongBac['menh'] . '</span>' . $dongBac['text'] . '</div>';
        $luanGiaiCuuDieu .= '<div class="cuu-dieu"><span class="bold ' . khongdau($chinhBac['menh']) . '">- Chính bắc - ' . $chinhBac['name'] . ' - ' . $chinhBac['menh'] . '</span>' . $chinhBac['text'] . '</div>';
        $luanGiaiCuuDieu .= '<div class="cuu-dieu"><span class="bold ' . khongdau($tayBac['menh']) . '">- Tây Bắc - ' . $tayBac['name'] . ' - ' . $tayBac['menh'] . '</span>' . $tayBac['text'] . '</div>';
        $tamNguyenVan = [];
        $van = 1;
        for ($i = 964; $i <= 5000; $i++) {
            if ($i > 964 && ($i - 964) % 20 == 0) {
                $van++;
            }
            if ($van > 9) {
                $van = 1;
            }
            $tamNguyenVan[$i] = $van;
        }
        $cuuVanId = isset($tamNguyenVan[$namXem]) ? $tamNguyenVan[$namXem] : 1;
        $cuuVanInfo = $arrCuuDieu[$cuuVanId];

        $namXemInfo = $tuTru->tinhNamAm('07', '07', $namXem);
        $son = '';
        $huong = '';
        $cuuDieuInfo = $arrCuuDieu[$soCuDieu];
        $dongNam = $arrCuuDieu[$cuuDieuInfo['so'][7]];
        $chinhNam = $arrCuuDieu[$cuuDieuInfo['so'][3]];
        $tayNam = $arrCuuDieu[$cuuDieuInfo['so'][5]];
        $chinhDong = $arrCuuDieu[$cuuDieuInfo['so'][6]];
        $chinhTay = $arrCuuDieu[$cuuDieuInfo['so'][1]];
        $dongBac = $arrCuuDieu[$cuuDieuInfo['so'][2]];
        $chinhBac = $arrCuuDieu[$cuuDieuInfo['so'][4]];
        $tayBac = $arrCuuDieu[$cuuDieuInfo['so'][0]];
        $lasoBt = new \Laven\LasoBatTrach([
            'cuuVanInfo' => $cuuVanInfo,
            'cuuDieuInfo' => [
                'chinhCung' => $cuuDieuInfo,
                'dongNam' => $dongNam,
                'chinhNam' => $chinhNam,
                'tayNam' => $tayNam,
                'chinhDong' => $chinhDong,
                'chinhTay' => $chinhTay,
                'dongBac' => $dongBac,
                'chinhBac' => $chinhBac,
                'tayBac' => $tayBac
            ],
            'bat_trach' => $tuTru->menhQuaiArr['menhquai']['name2'],
            'menh_quai' => $tuTru->menhQuaiArr['menh2'],
            'namXemInfo' => $namXemInfo,
            'tamNguyenVan' => $tamNguyenVan,
            'namXem' => $namXem,
                //'huong2' => ['son' => 'giap', 'huong' => 'canh']
        ]);
        $imgBatTu = $lasoBt->drawImage(true);

        return new \WP_REST_Response([
            'ban_menh' => [
                'con_giap' => get_stylesheet_directory_uri() . '/congiap/' . $tuTru->chiNamSlug . '_active.png',
                'menh_chu' => $batTu['menh'] . ' ' . $tuTru->gioSinh . ':' . $tuTru->phutSinh . ' ' . $tuTru->ngayDuong . '/' . $tuTru->thangDuong . '/' . $tuTru->namDuong . '(DL)' . ' ' . $tuTru->gioPhutSinh . ' ' . $tuTru->ngaythangAm[0] . '/' . $tuTru->ngaythangAm[1] . '/' . $tuTru->ngaythangAm[2] . ' (AL), Tiết khí:' . $tietKhi['name'],
                'nam_can_chi' => $tuTru->canNamText . ' ' . $tuTru->chiNamText,
                'menh_nien' => $napAm['nam']['menh'],
                'menh_quai' => $tuTru->menhQuaiArr['menhquai']['name'] . ' ' . $tuTru->menhQuaiArr['menh'],
                'cung_menh' => $cungMenhThaiNguyen['cung_menh']['can'] . ' ' . $cungMenhThaiNguyen['cung_menh']['chi'],
                'thai_nguyen' => $cungMenhThaiNguyen['thai_nguyen']['can'] . ' ' . $cungMenhThaiNguyen['thai_nguyen']['chi'],
                'bat_tu' => $namAmLich,
                'menh' => $banMenhText,
                'dung_than' => $tuTru->convertSlugToText($dungThan),
                'hy_than' => $tuTru->convertSlugToText($hyThan),
                'tong_quan' => [
                    $tuTru->namAmlich['can']['luan_giai'], $tuTru->namAmlich['chi']['luan_giai'], $tuTru->napAmLuanGiai[$napAm['nam']['ngu_hanh']], $cungMenhThaiNguyen['cung_menh']['info']
                ],
            ],
            'bat_trach' => [
                'la_so' => get_home_url() . '/wp-content/uploads/bat_trach/' . $imgBatTu,
                'menh_quai' => $this->tinhMenhQuai($tuTru),
                'bat_trach' => $this->tinhBatTrach(),
                'trach_tuoi' => $this->tinhTrachTuoi($namXem, $namSinh),
                'tam_nguyen_cuu_van' => $this->tamNguyenCuuVan(),
                'cuu_dieu_8_phuong' => $this->cuuDieu8Phuong($cuuDieuInfo, $soCuDieu, $dongNam, $chinhNam, $tayNam, $chinhDong, $chinhTay, $dongBac, $chinhBac, $tayBac, $luanGiaiCuuDieu),
                'tinh_do_cuu_dieu_dong_the_quai' => $this->tinhDoCuuDieuDongTheQuai(),
                'bat_trach_theo_24_son_huong' => $this->batTrachTheo24SonHuong($tuTru),
                'thuong_son_ha_thuy' => $this->thuongSonHaThuy(),
                'thai_tue' => $this->thaiTueTuePha(),
                'thu_tu_sat_chu' => $this->thuTuSatChu(),
                'bat_sat' => $this->batSat($tuTru, $duNienArr),
                'hoang_tuyen' => $this->hoangTuyen($huong),
                'hoang_oc' => $this->hoangOc($namXem, $namSinh),
                'kim_lau' => $this->kimLau($namXem, $namSinh),
                'tam_tai' => $this->tamTai($tuTru, $namXem, $namXemInfo),
            ],
                ], 200);
    }

    public function tinhMenhQuai($tuTru) {
        ob_start();
        ?>
        <h3 class="luan-giai-title mt-2" id="tinh_menh_quai">1. TÍNH MỆNH QUÁI</h3>
        <p>Theo quan niệm của người phương đông thì trong bát quái sẽ được phân chia ra đông và tây tứ mệnh, mối chúng ta khi sinh ra sẽ được gắn liền với một quái bất kỳ trong bát quái, (Càn, Khảm, Cấn, Chấn, Tốn, Ly, Khôn, Đoài) tính theo năm sinh âm, và giới tính, mỗi một quái lại mang một ý ngĩa hung cát khác nhau, và theo quan niệm thì người đông tứ mệnh lên kết hợp với người đông tứ mệnh cũng vậy, khi chúng ta kết hợp với người cùng phương sẽ nhận được bốn điều tốt là (Sinh Khí, Thiên Y, Diên Niên, Phục Vị) còn khi kết hợp với người khác phương sẽ gặp bốn điều, (Tuyệt Mệnh, Lục Sát, Ngũ Quỷ, Họa Hại) về vấn đề xét đông tây tứ mệnh cũng còn theo nhiều luồng quan điểm lên dùng và không lên dùng, nhưng với thăng long đạo quán thì cung phi (mệnh quái) vẫn có ý nghĩa và được dùng để hỗ trợ quý vị xét về hung cát và có hướng giải quyết. quý vị xin lưu ý: trong phong thủy bát trạch thì đông tây tứ mệnh biến Du Niên vẫn chưa phải là quan trong nhất. quan trọng nhất là sơn hứơng, tọa độ, hình thế lý số của mảnh đất và ngôi nha</p>
        <div class="text-center">
            <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/tinhmenhquai.png" />
        </div>
        <div class="text-center">
            <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/tinhmenhquai2.png" />
        </div>
        <p>Cách tính:<br>
            cộng tất cả những số trong năm sinh lại như ảnh trên rồi chia cho 9, số dư sẽ là cung mệnh ( quái). Nam tính nghịch trung cung khởi từ 6. Nữ tính thuận trung cung khới từ 1. Nếu nam số dư là 6 thì cung khôn, nữ số dư là 1 là cung cấn.<br>
            Vd: nam sinh 1990 = 1+9+9+0 = 19:9=2 dư 1 = khảm<br>
            Ghi chú : cung khảm- chấn- tốn- ly ( hướng bắc-đông- đông nam- nam) thuộc đông tứ mệnh + đông tứ trạch.<br>
            – cung khôn - đoài - càn – cấn (hướng tây nam - tây – tây bắc - đông bắc thuộc tây tứ mệnh + tây tứ trạch)</p>
        <ul class="red">
            <li class="mb-0 moc">Đông tứ mệnh: là nhưng quý vị thuộc cung KHẢM, CHẤN, TỐN, LY</li>
            <li class="mb-0 kim">Tây tứ mệnh: là nhưng quý vị thuộc cung CÀN, CẤN, KHÔN, ĐOÀI</li>
            <li class="mb-0">Cung sinh khí: càn, đoài – khảm, tốn – cấn, khôn – chấn, ly.</li>
            <li class="mb-0">Cung thiên Y: càn, cấn – khảm, chấn – tốn, ly – khôn, đoài</li>
            <li class="mb-0">Cung diên niên: càn, khôn – khảm, ly – cấn, đoài – chấn, tốn.</li>
            <li class="mb-0">Cung phục vị: càn, càn – khảm, khảm – cấn, cấn – chấn, chấn – tốn, tốn – ly, ly – khôn, khôn – đoài, đoài.</li>
            <li class="mb-0">Cung tuyệt mệnh: càn, ly – khảm, khôn – cấn, tốn – chấn, đoài.</li>
            <li class="mb-0">Cung lục sát: càn, khảm – cấn, chấn – tốn, đoài – ly, khôn.</li>
            <li class="mb-0">Cung ngũ quỷ: càn, chấn – khảm, cấn – tốn, khôn – ly, đoài.</li>
            <li class="mb-0">Cung họa hại: càn, tốn – khảm, đoài – cấn, ly – chấn, khôn.</li>
        </ul>
        <p>Bản thân mình cung phi (mệnh quái nào thì chọn theo hướng đó hoặc 3 cung còn lại thuộc đông tứ mệnh) Cụ thể như sau.</p>
        <div class="text-center">
            <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/bansonhuong.png" />
        </div>
        <?php
        $menh = 'kham';
        $menhQuaiArr = [
            //càn, đoài. – khảm, tốn. – cấn, khôn. – chấn, ly. 
            'sinh_khi' => ['diem' => 2, 'cung' => ['can_doai', 'kham_ton', 'can2_khon', 'chan_ly'], 'text' => '<span class="red">- Sinh khí thuộc Mộc:</span> xin chúc mừng quý anh chị đã chọn hướng cùng phương, thuộc cung sinh khí ám chỉ sự, làm ăn hữu lộc lộc tồn. Những lúc khó khăn ắt có Quý nhân phù trợ, trong cuộc sống luôn may mắn hanh thông, sức khỏe dồi dào, quý anh chị cần tu tâm tích đức gieo duyên thiện lành, giúp người khổ hỗ trợ người khó khăn để giữ lộc tồn. Nhưng quý anh chị cũng xin lưu ý: phúc lộc tai nhân – thành sự tại trí – tâm an trí vững ắt vận thông.'],
            //càn, cấn. – khảm, chấn. – tốn, ly. – khôn, đoài. 
            'thien_y' => ['diem' => 2, 'cung' => ['can_can2', 'kham_chan', 'ton_ly', 'khon_doai'], 'text' => '<span class="red">- Thiên y thuộc Thổ:</span> xin chúc mừng quý anh chị đã chọn hướng cùng phương, thuộc cung Thiên Y, ám chỉ sự, tài lộc trời phú. Quý nhân trợ giúp, kinh doanh phất phát, làm ăn như diều gặp gió, hữu lộc lộc tồn, trong cuộc sống luôn may mắn hanh thông, sức khỏe dồi dào, quý anh chị cần tu tâm tích đức gieo duyên thiện lành, giúp người khổ hỗ trợ người khó khăn để giữ lộc tồn. Nhưng quý anh chị cũng xin lưu ý: phúc lộc tai nhân – thành sự tại trí – tâm an trí vững ắt vận thông'],
            //càn, khôn. – khảm, ly. – cấn, đoài. – chấn, tốn
            'dien_nien' => ['diem' => 2, 'cung' => ['can_khon', 'kham_ly', 'can2_doai', 'chan_ton'], 'text' => '<span class="red">- Phúc đức thuộc Kim:</span> xin chúc mừng quý anh chị đã chọn hướng cùng phương, thuộc cung phúc đức, ám chỉ sự, phúc lộc đề đa. Làm đước giữ được, giữ được lộc dài lâu, gia tiên hộ trì, hữu lộc lộc tồn, trong cuộc sống luôn may mắn hanh thông, sức khỏe dồi dào, quý anh chị cần tu tâm tích đức gieo duyên thiện lành, giúp người khổ hỗ trợ người khó khăn để giữ lộc tồn. Nhưng quý anh chị cũng xin lưu ý: phúc lộc tai nhân – thành sự tại trí – tâm an trí vững ắt vận thông.'],
            //càn, càn. – khảm, khảm. – cấn, cấn. – chấn, chấn. – tốn, tốn. – ly, ly. – khôn, khôn. – đoài, đoài. 
            'phuc_vi' => ['diem' => 2, 'cung' => ['can_can', 'kham_kham', 'can2_can2', 'can_can', 'chan_chan', 'ton_ton', 'ly_ly', 'khon_khon', 'doai_doai'], 'text' => '<span class="red">- Phục vị thuộc Mộc:</span> xin chúc mừng quý anh chị đã chọn hướng cùng phương, thuộc cung Phục Vị, ám chỉ sự, gia tiên gia hộ độ trì, thừa hưởng phúc lộc của gia tiên để lại, hữu lộc lộc tồn, trong cuộc sống luôn may mắn hanh thông, sức khỏe dồi dào, quý anh chị cần tu tâm tích đức gieo duyên thiện lành, giúp người khổ hỗ trợ người khó khăn để giữ lộc tồn. Nhưng quý anh chị cũng xin lưu ý: phúc lộc tai nhân – thành sự tại trí – tâm an trí vững ắt vận thông.'],
            //tuyệt mệnh: càn, ly. – khảm, khôn. – cấn, tốn. – chấn, đoài. 
            'tuyet_menh' => ['diem' => -2, 'cung' => ['can_ly', 'kham_khon', 'can2_ton', 'chan_doai'], 'text' => '<span class="red">- Tuyệt mạng thuộc Kim:</span> quý anh chị khi chọn hướng vô tình phạm phải cung Tuyệt mạng do mệnh quái và hướng khác phương, khi phạm Tuyệt mạng anh chị dễ gặp nhưng chuyện như: sức khỏe bản thân và người xum quanh không được tốt, dễ có bố mẹ, vợ chồng, con cái ốm đau bệnh tất. Hoắc dễ có người Sức khỏe yếu kém, hoắc bản thân hai vợ chồng ai kém mệnh hơn thì dễ đau ốm, yêu. Nhưng quý anh chị cũng không cần quá bận tâm tới điều này, trong thuật toán quy luận có hung ắt có cát, khi quý anh chị phạm Tuyệt mạng chỉ cần dùng năng lượng của Thiên Y hoặc sinh thiên là có thể hóa Hung thành Cát được rồi, và 1 số vật phẩm trợ mệnh chuyển thù thành bạn. quý anh chị cần tu tâm tích đức gieo duyên thiện lành, giúp người khổ hỗ trợ người khó khăn để giữ lộc tồn. Nhưng quý anh chị cũng xin lưu ý: phúc lộc tai nhân – thành sự tại trí – tâm an trí vững ắt vận thông.'],
            // -	Cung lục sát: càn, khảm. – cấn, chấn. – tốn, đoài. – ly, khôn.
            'luc_sat' => ['diem' => -2, 'cung' => ['can_kham', 'can2_chan', 'ton_doai', 'ly_khon'], 'text' => '<span class="red">- Lục sát thuộc Thủy:<span> quý anh chị khi chọn hướng vô tình phạm phải cung Lục sát do mệnh quái và hướng khác phương, khi phạm Lục sát anh chị dễ gặp nhưng chuyện như: dễ tranh cãi bất đồng quan điểm, vợ chồng dễ xô sát dễ kiện tụng, lao lý dình dập, mỗi người một phách, có thể khắc khẩu nói chuyện với nhau được mấy câu xong ai việc người đó, có cảm giác như không hợp. Nhưng quý anh chị cũng không cần quá bận tâm tới điều này, trong thuật toán quy luận có hung ắt có cát, khi quý anh chị phạm Lục sát chỉ cần dùng năng lượng của Phục Diên hoặc cung Phúc đức là có thể hóa Hung thành Cát được rồi, và 1 số vật phẩm trợ mệnh chuyển thù thành bạn. quý anh chị cần tu tâm tích đức gieo duyên thiện lành, giúp người khổ hỗ trợ người khó khăn để giữ lộc tồn. Nhưng quý anh chị cũng xin lưu ý: phúc lộc tai nhân – thành sự tại trí – tâm an trí vững ắt vận thông.'],
            //-	Cung ngũ quỷ: càn, chấn. – khảm, cấn. – tốn, khôn. – ly, đoài. 
            'ngu_quy' => ['diem' => -2, 'cung' => ['can_chan', 'kham_can2', 'ton_khon', 'ly_doai'], 'text' => '<span class="red">- Ngũ quỷ thuộc Hỏa:</span> quý anh chị khi chọn hướng vô tình phạm phải cung Ngũ quỷ do mệnh quái và hướng khác phương, khi phạm Ngũ quỷ anh chị dễ gặp nhưng chuyện như: đào hoa, các mối quan hệ nửa vời, gần được lại mất, vợ chồng không hòa thuận, bồng bềnh trôi nổi, dễ tranh cãi bất đồng quan điểm, mỗi người một phách, có thể khắc khẩu nói chuyện với nhau được mấy câu xong ai việc người đó, có cảm giác như không hợp. Nhưng quý anh chị cũng không cần quá bận tâm tới điều này, trong thuật toán quy luận có hung ắt có cát, khi quý anh chị phạm Ngũ quỷ chỉ cần dùng năng lượng của sinh khí hoặc sinh thiên diên là có thể hóa Hung thành Cát được rồi, và 1 số vật phẩm trợ mệnh chuyển thù thành bạn. quý anh chị cần tu tâm tích đức gieo duyên thiện lành, giúp người khổ hỗ trợ người khó khăn để giữ lộc tồn. Nhưng quý anh chị cũng xin lưu ý: phúc lộc tai nhân – thành sự tại trí – tâm an trí vững ắt vận thông.'],
            //-	Cung họa hại: càn, tốn. – khảm, đoài. – cấn, ly. – chấn, khôn. 
            'hoa_hai' => ['diem' => -2, 'cung' => ['can_ton', 'kham_doai', 'can2_ly', 'chan_khon'], 'text' => '<span class="red">- Họa hại thuộc Thổ:</span> quý anh chị khi chọn hướng vô tình phạm phải cung Họa Hại do mệnh quái và hướng khác phương, khi phạm Họa Hại anh chị dễ gặp nhưng chuyện như: những chuyện thị phi phiền toái, chuyện không đâu ập tới, làm phúc phải tội, chuyện linh tinh khéo tới. Nhưng quý anh chị cũng không cần quá bận tâm tới điều này, trong thuật toán quy luận có hung ắt có cát, khi quý anh chị phạm Họa Hại chỉ cần dùng năng lượng của Sinh Diên hoặc cung Phục Vị là có thể hóa Hung thành Cát được rồi, và 1 số vật phẩm trợ mệnh chuyển thù thành bạn. quý anh chị cần tu tâm tích đức gieo duyên thiện lành, giúp người khổ hỗ trợ người khó khăn để giữ lộc tồn. Nhưng quý anh chị cũng xin lưu ý: phúc lộc tai nhân – thành sự tại trí – tâm an trí vững ắt vận thông.'],
        ];
        ?>
        <p>Xét theo năm sinh mệnh quái: <?= $tuTru->menhQuaiArr['menhquai']['name'] ?></p>
        <?php
        foreach ($duNienArr as $dn) {
            $cungmenh1 = $tuTru->menhQuaiArr['menhquai']['name2'] . '_' . $dn['name2'];
            $cungmenh2 = $dn['name2'] . '_' . $tuTru->menhQuaiArr['menhquai']['name2'];
            foreach ($menhQuaiArr as $key => $val) {
                if (array_search($cungmenh1, $val['cung']) !== false || array_search($cungmenh2, $val['cung']) !== false) {
                    echo '<p><span class="red">Tọa ' . $dn['name'] . ' ' . $dn['huong'] . ' ' . '</span>' . $val['text'] . '</p>';
                }
            }
        }
        ?>
        <?php
        return ob_get_clean();
    }

    public function tinhBatTrach() {
        ob_start();
        ?>
        <h3 class="luan-giai-title" id="tinh_bat_trach">2. BÁT TRẠCH</h3>
        <ul>
            <li>Trong bát trạch thì thứ tự của 8 trạch bắt đầu từ Càn, Khảm, Cấn, Chấn, Tốn, Ly, Khôn, Đoài. Theo phong thủy bát trạch thì khi xây dựng nhà ở phải tọa xấu hướng tốt, (<span style="color:red">trừ sơn hướng trong cung khảm, ly và Cấn, Khôn</span>) người đông tứ mệnh, trạch sẽ xây nhà tọa tây trạch (cung CÀN, CẤN, KHÔN, ĐOÀI) và hướng của đông tứ mệnh, trạch của mình (cung KHẢM, CHẤN, TỐN, LY) và người tây tứ mệnh, trạch cũng vậy. theo quan điểm trấn cái xấu, hung hướng về cái tốt, cát. Vậy cho lên khi xây dựng nhà ở phải tạo xấu, hung, hướng tốt, cát (theo phong thủy bát trạch)</li>
            <li>Vd: năm 1990 thuộc cung khảm thủy = đông tứ mệnh có thể xây nhà tọa Càn (tây tứ trạch) hướng Chấn (Đông tứ trạch). Chứ không thể tọa Chấn (Đông tứ trạch) hướng Càn (tây tứ trạch).</li>
        </ul>
        <p>Sau khi xét năm sinh âm lịch của gia chủ ta có, Hướng Tây Bắc thuộc Càn. - Dương Kim. Gia chủ thuộc <b>(Tây tứ trạch) tọa Tốn hướng Càn</b><br>
            Sau khi xét năm sinh âm lịch của gia chủ ta có, Hướng Bắc thuộc Khảm. - Dương Thủy. Gia chủ thuộc <b>(Đông tứ trạch) tọa Ly hướng khảm</b><br>
            Sau khi xét năm sinh âm lịch của gia chủ ta có, Hướng Đông Bắc thuộc Cấn. - Dương Thổ. Gia chủ thuộc <b>(Tây tứ trạch) tọa Khôn hướng Cấn</b><br>
            Sau khi xét năm sinh âm lịch của gia chủ ta có, Hướng Đông thuộc Chấn. - Dương Mộc. Gia chủ thuộc <b>(Đông tứ trạch) tọa Đoài hướng Chấn</b><br>
            Sau khi xét năm sinh âm lịch của gia chủ ta có, Hướng Đông Nam thuộc Tốn. - Âm Mộc. Gia chủ thuộc <b>(Đông tứ trạch) tọa Càn hướng Tốn</b><br>
            Sau khi xét năm sinh âm lịch của gia chủ ta có, Hướng Nam thuộc Ly. Âm Hỏa. - Âm Kim. Gia chủ thuộc <b>(Đông tứ trạch) tọa Khảm hướng Ly</b><br>
            Sau khi xét năm sinh âm lịch của gia chủ ta có, Hướng Tây Nam thuộc Khôn. - Âm Thổ. Gia chủ thuộc <b>(Tây tứ trạch) tọa Cấn hướng Khôn</b><br>
            Sau khi xét năm sinh âm lịch của gia chủ ta có, Hướng Tây thuộc Đoài. - Âm Kim. Gia chủ thuộc <b>(Tây tứ trạch) tọa Chấn hướng Đoài.</b>
        </p>
        <p>Bát trạch tính theo bát quái. Và theo phương vị 4 phương 8 hướng của trời đất. Bát trạch đước chia làm 2 phương đông tứ trạch và tây tứ trạch. ứng với người đông tứ mệnh thì ở hướng đông tứ mệnh và người tây tứ mệnh thì ở hướng tây tứ mệnh </p>
        <p>Cung Càn là đại diện cho người cha<br>
            Cung  Khảm là đại diện cho con trai thứ<br>
            Cung Cấn là đại diện cho con trai út<br>
            Cung Chấn là đại diện cho con trai cả<br>
            Cung  Tốn là đại diện cho con gái cả<br>
            Cung  Ly là đại diện cho con gái thứ<br>
            Cung  Khôn là đại diện người mẹ<br>
            Cung  Đoài là đại diện cho con gái út
        </p>
        <p>Trên đây là tám Cung trong bát trạch, và mỗi Cung sẽ chia làm 3 sơn hương, tổng cộng có 24 sơn hướng. về phần 24 sơn hướng thăng long đạo quán xin chia sẻ sâu hơn bên dưới. </p>
        <p>Cách tính:<br>
            cộng tất cả những số trong năm sinh lại như ảnh trên rồi chia cho 9, số dư sẽ là TRẠCH QUÁI (quái). Nam tính nghịch trung cung khởi từ 6. Nữ tính thuận trung cung khới từ 1. Nếu nam số dư là 6 thì cung khôn, nữ số dư là 1 là cung cấn.<br>
            Vd: nam sinh 1990 = 1+9+9+0 = 19:9=2 dư 1 = khảm<br>
            Ghi chú : cung khảm- chấn- tốn- ly ( hướng bắc-đông- đông nam- nam) thuộc đông tứ mệnh + đông tứ trạch.<br>
            – cung khôn - đoài- càn – cấn ( hướng tây nam- tây – tây bắc- đông bắc thuộc tây tứ mệnh + tây tứ trạch )
        </p>
        <?php
        return ob_get_clean();
    }

    public function tinhTrachTuoi($namXem, $namSinh) {
        ob_start();
        ?>
        <h3 class="luan-giai-title">3. TRẠCH TUỔI</h3>
        <p>Khi gia chủ Xây nhà là một việc trọng đại, lên quý vị cũng cần tìm hiểu về bát trạch, phong thủy hình thế lý số sẽ tốt cho gia chủ về tài vận và nhân đinh trong ngôi nhà của mình, tuy nói là có quan trọng hay không thì còn tùy theo từng cá nhân nhận định về phong thủy bát trạch. Để đảm bảo xây nhà phong thủy hợp thiên địa nhân, người xưa căn cứ vào rất nhiều yếu tố, sau đây là một trong những yếu tố đó, bảng Cửu Trạch Vận Niên. Trong đó, các trạch tốt là Phúc-Đức-Bảo-Lộc sẽ mang lại may mắn, hanh thông theo tuổi. Một số trạch xấu trong bảng cửu trạch là Bại-Hư-Khốc-Quỷ-Tử. trên đây là kiến thức để quý vị tham khảo khi tính tuổi xây nhà, đây chỉ là một yếu tố nhỏ trong phong thủy xây dựng.</p>
        <?php
        $trachTuoi = ($namXem - $namSinh + 1) % 9;
        ?>
        <?php if ($trachTuoi == 1) : // PHÚC ?>
            <div class="red">Theo quan niệm dân gian những Tuổi 19-28-37-46-55-64: là được Trạch Phúc (Tốt)</div>
            <p>Ám chỉ một sự cát lành khi xây nhà, nhận được sự may mắn hanh thông về tiền tài cung như nhân đinh, nhưng thực tế có một ngôi nhà tốt còn dựa trên rất nhiều yếu tố, và luồng quan điểm này đang bị đối lấp với thuật toán KIM LÂU, TAM TAI, HOANG ỐC. Mỗi bộ môn lại có 1 luồng quan điểm khác nhau, thực sự để tránh hết thì không có năm nào để xây nhà cả, chính vì điều nay hôm nay Thăng Long Đạo Quán xin chia sẻ một số kiến thức sau: thứ nhất quý vị nên phân tách giữa phong thủy và quan niệm dân gian. Thứ hai quý vị lên nắm rõ ngôi nhà đẹp cát, không phải do người tuổi đẹp xây dựng. mà phải dựa vào nhiều yếu tố khác. VD:</p>
            <ul>
                <li>Ngôi nhà: xét vận xây dựng, hình thế lý số nội ngoại của nhà và đất, tọa độ sơn hướng. vv...</li>
                <li>Chủ sự: xét thời vận, kinh tế, mệnh lý, hoang ốc, tam tai, kim lâu, trạch tuổi. vv...</li>
                <li>Năm nay gia chủ thuộc trạch <span class="red bold">Phúc</span> cũng khá tốt trong xây dựng nhưng cần xét thêm nhiều yếu tố quan trọng khác, những điều quan trọng nhất trong xây dựng theo phong thủy theo quan điểm của thăng Long Đạo Quán có thể khác quý vị. vậy cho lên có sai, thiếu sót hoặc không đồng quan điển với quý vị, cũng xin quý vị hoan hỷ góp ý. Xin trân thành cảm ơn quý anh chị. </li>
            </ul>
        <?php elseif ($trachTuoi == 2) : ?>
            <div class="red">Theo quan niệm dân gian những Tuổi 20-29-38-47-56-65: là được Trạch Đức (Tốt)</div>
            <p>Án chị một sự cát lành khi xây nhà, nhận được sự may mắn hanh thông về tiền tài cung như nhân đinh, nhưng thực tế có một ngôi nhà tốt còn dựa trên rất nhiều yếu tố, và luồng quan điểm này đang bị đối lấp với thuật toán KIM LÂU, TAM TAI, HOANG ỐC. Mỗi bộ môn lại có 1 luồng quan điểm khác nhau, thực sự để tránh hết thì không có năm nào để xây nhà cả, chính vì điều nay hôm nay Thăng Long Đạo Quán xin chia sẻ một số kiến thức sau: thứ nhất quý vị nên phân tách giữa phong thủy và quan niệm dân gian. Thứ hai quý vị lên nắm rõ ngôi nhà đẹp cát, không phải do người tuổi đẹp xây dựng. mà phải dựa vào nhiều yếu tố khác vd:</p>
            <ul>
                <li>Ngôi nhà: xét vận xây dựng, hình thế lý số nội ngoại của nhà và đất, tọa độ sơn hướng. vv...</li>
                <li>Chủ sự: xét thời vận, kinh tế, mệnh lý, hoang ốc, tam tai, kim lâu, trạch tuổi. vv...</li>
                <li>Năm nay gia chủ thuộc trạch <span class="red bold">Đức</span> cũng khá tốt trong xây dựng nhưng cần xét thêm nhiều yếu tố quan trọng khác, những điều quan trọng nhất trong xây dựng theo phong thủy theo quan điểm của thăng Long Đạo Quán có thể khác quý vị. vậy cho lên có sai, thiếu sót hoặc không đồng quan điển với quý vị, cũng xin quý vị hoan hỷ góp ý. Xin trân thành cảm ơn quý anh chị</li>
            </ul>
        <?php elseif ($trachTuoi == 3) : ?>
            <div class="red">Theo quan niệm dân gian những Tuổi 19-30-39-48-57-66: (Trạch bại) xấu</div>
            <p>Ám chỉ một sự hung hại khi xây nhà, nhận được sự tự hại bản thân, và bản thân bị hại, dễ ốm đau bệnh tật, làm ăn thua lỗ, nhưng thực tế có một ngôi nhà tốt hay xấu còn dựa trên rất nhiều yếu tố, và luồng quan điểm này đang bị đối lấp với thuật toán KIM LÂU, TAM TAI, HOANG ỐC. Mỗi bộ môn lại có 1 luồng quan điểm khác nhau, thực sự để tránh hết thì không có năm nào để xây nhà cả, chính vì điều nay hôm nay Thăng Long Đạo Quán xin chia sẻ một số kiến thức sau: thứ nhất quý vị nên phân tách giữa phong thủy và quan niệm dân gian. Thứ hai quý vị lên nắm rõ ngôi nhà đẹp cát, không phải do người tuổi đẹp xây dựng. mà phải dựa vào nhiều yếu tố khác vd: mà phải dựa vào nhiều yếu tố khác vd:</p>
            <ul>
                <li>Ngôi nhà: xét vận xây dựng, hình thế lý số nội ngoại của nhà và đất, tọa độ sơn hướng. vv...</li>
                <li>Chủ sự: xét thời vận, kinh tế, mệnh lý, hoang ốc, tam tai, kim lâu, trạch tuổi. vv...</li>
                <li>Năm nay gia chủ thuộc trạch <span class="red bold">Bại</span> không tốt trong xây dựng nhưng, tốt hay xấu cần xét thêm nhiều yếu tố quan trọng khác, những điều quan trọng nhất trong xây dựng theo phong thủy, theo quan điểm của thăng Long Đạo Quán có thể khác quý vị. vậy cho lên có sai, thiếu sót hoặc không đồng quan điển với quý vị, cũng xin quý vị hoan hỷ góp ý. Xin trân thành cảm ơn quý anh chị.</li>
            </ul>
        <?php elseif ($trachTuoi == 4) : ?>
            <div class="red">Theo quan niệm dân gian những Tuổi 20-31-40-49-58-67: (Trạch Hư) xấu</div>
            <p>Ám chỉ một sự hung hại khi xây nhà, hư tức là hư hại, những điều không cát lành, khi phạm vào trạch hư thì trong làm ăn sẽ kém dần, còn trong sức khoẻ thì ốm đau sức khoẻ đi xuông, nhưng thực tế có một ngôi nhà tốt hay xấu còn dựa trên rất nhiều yếu tố, và luồng quan điểm này đang bị đối lấp với thuật toán KIM LÂU, TAM TAI, HOANG ỐC. Mỗi bộ môn lại có 1 luồng quan điểm khác nhau, thực sự để tránh hết thì không có năm nào để xây nhà cả, chính vì điều nay hôm nay Thăng Long Đạo Quán xin chia sẻ một số kiến thức sau: thứ nhất quý vị nên phân tách giữa phong thủy và quan niệm dân gian. Thứ hai quý vị lên nắm rõ ngôi nhà đẹp cát, không phải do người tuổi đẹp xây dựng. mà phải dựa vào nhiều yếu tố khác vd:</p>
            <ul>
                <li>Ngôi nhà: xét vận xây dựng, hình thế lý số nội ngoại của nhà và đất, tọa độ sơn hướng. vv...</li>
                <li>Chủ sự: xét thời vận, kinh tế, mệnh lý, hoang ốc, tam tai, kim lâu, trạch tuổi. vv...</li>
                <li>Năm nay gia chủ thuộc trạch <span class="red bold">Hư</span> không tốt trong xây dựng nhưng, tốt hay xấu cần xét thêm nhiều yếu tố quan trọng khác, những điều quan trọng nhất trong xây dựng theo phong thủy, theo quan điểm của thăng Long Đạo Quán có thể khác quý vị. vậy cho lên có sai, thiếu sót hoặc không đồng quan điển với quý vị, cũng xin quý vị hoan hỷ góp ý. Xin trân thành cảm ơn quý anh chị. </li>
            </ul>
        <?php elseif ($trachTuoi == 5) : ?>
            <div class="red">Theo quan niệm dân gian những Tuổi 21-32-41-50-59-68: 5 Trung (Khắc xấu).</div>
            <p>Ám chỉ một sự hung hại khi xây nhà, nhận được sự dễ người trong nhà xung khắc, bất đồng với nhau, dễ ốm đau bệnh tật, làm ăn thua lỗ, nhưng thực tế có một ngôi nhà tốt hay xấu còn dựa trên rất nhiều yếu tố, và luồng quan điểm này đang bị đối lấp với thuật toán KIM LÂU, TAM TAI, HOANG ỐC. Mỗi bộ môn lại có 1 luồng quan điểm khác nhau, thực sự để tránh hết thì không có năm nào để xây nhà cả, chính vì điều nay hôm nay Thăng Long Đạo Quán xin chia sẻ một số kiến thức sau: thứ nhất quý vị nên phân tách giữa phong thủy và quan niệm dân gian. Thứ hai quý vị lên nắm rõ ngôi nhà đẹp cát, không phải do người tuổi đẹp xây dựng. mà phải dựa vào nhiều yếu tố khác vd: mà phải dựa vào nhiều yếu tố khác vd:</p>
            <ul>
                <li>Ngôi nhà: xét vận xây dựng, hình thế lý số nội ngoại của nhà và đất, tọa độ sơn hướng. vv...</li>
                <li>Chủ sự: xét thời vận, kinh tế, mệnh lý, hoang ốc, tam tai, kim lâu, trạch tuổi. vv...</li>
                <li>Năm nay gia chủ thuộc trạch <span class="red bold">Khắc</span> không tốt trong xây dựng nhưng, tốt hay xấu cần xét thêm nhiều yếu tố quan trọng khác, những điều quan trọng nhất trong xây dựng theo phong thủy, theo quan điểm của thăng Long Đạo Quán có thể khác quý vị. vậy cho lên có sai, thiếu sót hoặc không đồng quan điển với quý vị, cũng xin quý vị hoan hỷ góp ý. Xin trân thành cảm ơn quý anh chị.</li>
            </ul>
        <?php elseif ($trachTuoi == 6) : ?>
            <div class="red">Theo quan niệm dân gian những Tuổi 22-33-42-51-60-69: (Trạch Quỷ xấu).</div>
            <p>Ám chỉ một sự hung hại khi xây nhà, nhận được sự Hại vợ, dễ người trong nhà bất đồng với vợ mình, vợ chồng dễ bất đồng với nhau, dễ ốm đau bệnh tật, làm ăn thua lỗ, nhưng thực tế có một ngôi nhà tốt hay xấu còn dựa trên rất nhiều yếu tố, và luồng quan điểm này đang bị đối lấp với thuật toán KIM LÂU, TAM TAI, HOANG ỐC. Mỗi bộ môn lại có 1 luồng quan điểm khác nhau, thực sự để tránh hết thì không có năm nào để xây nhà cả, chính vì điều nay hôm nay Thăng Long Đạo Quán xin chia sẻ một số kiến thức sau: thứ nhất quý vị nên phân tách giữa phong thủy và quan niệm dân gian. Thứ hai quý vị lên nắm rõ ngôi nhà đẹp cát, không phải do người tuổi đẹp xây dựng. mà phải dựa vào nhiều yếu tố khác vd: mà phải dựa vào nhiều yếu tố khác vd:</p>
            <ul>
                <li>Ngôi nhà: xét vận xây dựng, hình thế lý số nội ngoại của nhà và đất, tọa độ sơn hướng. vv...</li>
                <li>Chủ sự: xét thời vận, kinh tế, mệnh lý, hoang ốc, tam tai, kim lâu, trạch tuổi. vv...</li>
                <li>Năm nay gia chủ thuộc trạch Quỷ không tốt trong xây dựng nhưng, tốt hay xấu cần xét thêm nhiều yếu tố quan trọng khác, những điều quan trọng nhất trong xây dựng theo phong thủy, theo quan điểm của thăng Long Đạo Quán có thể khác quý vị. vậy cho lên có sai, thiếu sót hoặc không đồng quan điển với quý vị, cũng xin quý vị hoan hỷ góp ý. Xin trân thành cảm ơn quý anh chị.</li>
            </ul>
        <?php elseif ($trachTuoi == 7) : ?>
            <div class="red">Theo quan niệm dân gian những Tuổi 23-34-43-52-61-70: (Trạch tử).</div>
            <p>Ám chỉ một sự hung hại khi xây nhà, dễ hại về con, dễ người trong nhà bất đồng với nhau, con cái dễ ốm đau bệnh tật, làm ăn khó khăn, nhưng thực tế có một ngôi nhà tốt hay xấu còn dựa trên rất nhiều yếu tố, và luồng quan điểm này đang bị đối lấp với thuật toán KIM LÂU, TAM TAI, HOANG ỐC. Mỗi bộ môn lại có 1 luồng quan điểm khác nhau, thực sự để tránh hết thì không có năm nào để xây nhà cả, chính vì điều nay hôm nay Thăng Long Đạo Quán xin chia sẻ một số kiến thức sau: thứ nhất quý vị nên phân tách giữa phong thủy và quan niệm dân gian. Thứ hai quý vị lên nắm rõ ngôi nhà đẹp cát, không phải do người tuổi đẹp xây dựng. mà phải dựa vào nhiều yếu tố khác vd: mà phải dựa vào nhiều yếu tố khác vd:</p>
            <ul>
                <li>Ngôi nhà: xét vận xây dựng, hình thế lý số nội ngoại của nhà và đất, tọa độ sơn hướng. vv...</li>
                <li>Chủ sự: xét thời vận, kinh tế, mệnh lý, hoang ốc, tam tai, kim lâu, trạch tuổi. vv...</li>
                <li>Năm nay gia chủ thuộc trạch <span class="red bold">Tử</span> không tốt trong xây dựng nhưng, tốt hay xấu cần xét thêm nhiều yếu tố quan trọng khác, những điều quan trọng nhất trong xây dựng theo phong thủy, theo quan điểm của thăng Long Đạo Quán có thể khác quý vị. vậy cho lên có sai, thiếu sót hoặc không đồng quan điển với quý vị, cũng xin quý vị hoan hỷ góp ý. Xin trân thành cảm ơn quý anh chị.</li>
            </ul>
        <?php elseif ($trachTuoi == 8) : ?>
            <div class="red">Theo quan niệm dân gian những Tuổi 26-35-44-53-62-71: là được Trạch Bảo (Tốt).</div>
            <p>Ám chỉ một sự cát lành khi xây nhà, nhận được sự may mắn hanh thông về tiền tài cung như nhân đinh, nhưng thực tế có một ngôi nhà tốt còn dựa trên rất nhiều yếu tố, và luồng quan điểm này đang bị đối lấp với thuật toán KIM LÂU, TAM TAI, HOANG ỐC. Mỗi bộ môn lại có 1 luồng quan điểm khác nhau, thực sự để tránh hết thì không có năm nào để xây nhà cả, chính vì điều nay hôm nay Thăng Long Đạo Quán xin chia sẻ một số kiến thức sau: thứ nhất quý vị nên phân tách giữa phong thủy và quan niệm dân gian. Thứ hai quý vị lên nắm rõ ngôi nhà đẹp cát, không phải do người tuổi đẹp xây dựng. mà phải dựa vào nhiều yếu tố khác vd:</p>
            <ul>
                <li>Ngôi nhà: xét vận xây dựng, hình thế lý số nội ngoại của nhà và đất, tọa độ sơn hướng. vv...</li>
                <li>Chủ sự: xét thời vận, kinh tế, mệnh lý, hoang ốc, tam tai, kim lâu, trạch tuổi. vv...</li>
                <li>Năm nay gia chủ thuộc trạch <span class="red bold">Bảo</span> cũng khá tốt trong xây dựng nhưng cần xét thêm nhiều yếu tố quan trọng khác, những điều quan trọng nhất trong xây dựng theo phong thủy theo quan điểm của thăng Long Đạo Quán có thể khác quý vị. vậy cho lên có sai, thiếu sót hoặc không đồng quan điển với quý vị, cũng xin quý vị hoan hỷ góp ý. Xin trân thành cảm ơn quý anh chị.</li>
            </ul>
        <?php elseif ($trachTuoi == 9) : ?>
            <div class="red">Theo quan niệm dân gian những Tuổi 27-36-45-54-63-72: là được Trạch Lộc (Rất tốt).</div>
            <p>Ám chỉ một sự cát lành khi xây nhà, nhận được sự may mắn hanh thông về tiền tài cung như nhân đinh, nhưng thực tế có một ngôi nhà tốt còn dựa trên rất nhiều yếu tố, và luồng quan điểm này đang bị đối lấp với thuật toán KIM LÂU, TAM TAI, HOANG ỐC. Mỗi bộ môn lại có 1 luồng quan điểm khác nhau, thực sự để tránh hết thì không có năm nào để xây nhà cả, chính vì điều nay hôm nay Thăng Long Đạo Quán xin chia sẻ một số kiến thức sau: thứ nhất quý vị nên phân tách giữa phong thủy và quan niệm dân gian. Thứ hai quý vị lên nắm rõ ngôi nhà đẹp cát, không phải do người tuổi đẹp xây dựng. mà phải dựa vào nhiều yếu tố khác vd:</p>
            <ul>
                <li>Ngôi nhà: xét vận xây dựng, hình thế lý số nội ngoại của nhà và đất, tọa độ sơn hướng. vv...</li>
                <li>Chủ sự: xét thời vận, kinh tế, mệnh lý, hoang ốc, tam tai, kim lâu, trạch tuổi. vv...</li>
                <li>Năm nay gia chủ thuộc trạch <span class="red bold">Lộc</span> cũng khá tốt trong xây dựng nhưng cần xét thêm nhiều yếu tố quan trọng khác, những điều quan trọng nhất trong xây dựng theo phong thủy theo quan điểm của thăng Long Đạo Quán có thể khác quý vị. vậy cho lên có sai, thiếu sót hoặc không đồng quan điển với quý vị, cũng xin quý vị hoan hỷ góp ý. Xin trân thành cảm ơn quý anh chị.</li>
            </ul>
        <?php endif; ?>    
        <?php
        return ob_get_clean();
    }

    public function tamNguyenCuuVan() {
        ob_start();
        ?>
        <h3 class="luan-giai-title">4. TAM NGUYÊN CỬU VẬN</h3>
        <p class="text-justify">Tam Nguyên Cửu Vận tức là: Nguyên sẽ có 3 Nguyên: Thượng, Trung, Hạ, (mỗi nguyên sẽ là 80 năm và mỗi nguyên sẽ giữ 3 vận). Cửu vận ngĩa là 9 Vận, từ Vận 1 tới Vận 9, (mỗi vận sẽ là 20 năm). Tổng cộng một là chu kỳ 180 năm, cứ từ Vận 1 (bắt đầu vào năm GIÁP TÝ) đi hết 3 Nguyên (tức 9 Vận) rồi lại trở về Vận 1 Thượng Nguyên lúc ban đầu. Cứ như thế xoay chuyển không ngừng. Còn sở dĩ người xưa lại dùng chu kỳ 180 năm (tức Tam Nguyên Cửu Vận) làm mốc xoay chuyển của thời gian là vì các hành tinh trong Thái Dương hệ cứ sau 180 năm lại trở về cùng nằm trên 1 đường thẳng. Đó chính là năm khởi đầu cho Vận 1 của Thượng Nguyên. Dùng đó làm mốc để tính thời gian.</p>
        <div class="row row-collapse">
            <div class="col large-6">
                <div class="text-center">
                    <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/tam-nguyen-cuu-van.jpg" />
                </div>
            </div>
            <div class="col large-6">
                <p class="text-justify">Nhưng năm can chi nhưng trong bảng khi phi tinh thì đưa số tưong ứng vào trung cung và phi tinh thuận. trong huyền không phi tinh, rất chú trọng vào thời vận xây nhà để luận hung cát theo cửu tinh, sao sơn hướng, để luận hung cát + thêm hình thế lý số, nội ngoại cục. việc dự đoán này khá thực tế và khoa học, được sử dụng rộng dãi. theo Nguyên lý Phân cực Âm Dương. Nguyên lý Ngũ Hành. Quỹ đạo vận động theo số 8. Nguyên lý cân bằng động của vũ trụ. Hoạt hóa 8 Tượng số Nhị Phân và 9 số Lạc Thư. Quy luật xuất hiện các vòng số Nhị Phân Hệ đo lường thời gian cổ. Điểm khởi đầu của hệ thời gian Can Chi. Quỹ đạo thăng giáng của 9 số Lạc Thư - thước đo Trời " Lường Thiên Xích ". Luật biến hóa của các số Nhị Phân. Biến hóa Âm Dương trong bản thân tượng số. Hệ tiên đề về vũ trụ và Nhân sinh của 8 tượng số. vv...</p>
            </div>
        </div>
        <div class="text-center">
            <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/ban-tinh-do-van.png" />
        </div>
        <br>
        <h4>NHỮNG SƠN HƯỚNG CÁT LÀNH TRONG TAM NGUYÊN CỬU VẬN từ năm 1864 – 2043.</h4>
        <table class="table table-calendar table-fixed">
            <tr>
                <td>
                    <div class="text-left">Vận 1: Không có</div>
                </td>
                <td>
                    <div class="text-left">Vận 2: Có 6 nhà<br>
                        Tọa Tọa Tốn Hướng Càn. Hướng nhà ở 312 đến 318 độ<br>
                        Tọa Càn Hướng Tốn. Hướng nhà ở 132 đến 138 độ<br>
                        Tọa Tỵ Hướng Hợi. Hướng nhà ở 327 đến 333 độ<br>
                        Tọa Hợi Hướng Tỵ. Hướng nhà ở 147 đến 153 độ<br>
                        Tọa Mùi hướng Sửu. Hướng nhà ở 27 đến 33 độ<br>
                        Tọa Sửu Hướng Mùi. Hướng nhà ở 207 đến 213 độ.
                    </div>
                </td>
                <td>
                    <div class="text-left">
                        Vận 3: Có 6 nhà<br>
                        Tọa Mão Hướng Dậu. Hướng nhà ở 237 đến 243 độ<br>
                        Tọa Dậu Hướng Mão. Hướng nhà ở 87 đến 93 độ<br>
                        Tọa Ất Hướng Tân. Hướng nhà ở 87 đến 93 độ<br>
                        Tọa Tân Hướng Ất. Hướng nhà ở 297 đến 303 độ<br>
                        Tọa Thìn Hướng Tuất. Hướng nhà ở 297 đến 303 độ<br>
                        Tọa Tuất Hướng Thìn. Hướng nhà ở 117 đến 123 độ
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="text-left">
                        Vận 4: Có 6 nhà<br>
                        Tọa Giáp Hướng Canh. Hướng nhà ở 252 đến 258 độ<br>
                        Tọa Canh Hướng Giáp. Hướng nhà ở 72 đến 78 độ<br>
                        Tọa Khôn Hướng Cấn. Hướng nhà ở 42 đến 48 độ<br>
                        Tọa Cấn Hướng Khôn. Hướng nhà ở 222 đến 228 độ<br>
                        Tọa Thân Hướng Dần. Hướng nhà ở 57 đến 63 độ<br>
                        Tọa Dần Hướng Thân. Hướng nhà ở 237 đến 243 độ
                    </div>
                </td>
                <td>
                    <div class="text-left">
                        Vận 5: Có 12 nhà<br>
                        Tọa Mão Hướng Dậu. Hướng nhà ở 237 đến 243 độ<br>
                        Tọa Dậu Hướng Mão. Hướng nhà ở 87 đến 93 độ<br>
                        Tọa Ất Hướng Tân. Hướng nhà ở 87 đến 93 độ<br>
                        Tọa Tân Hướng Ất. Hướng nhà ở 297 đến 303 độ<br>
                        Tọa Thìn Hướng Tuất. Hướng nhà ở 297 đến 303 độ<br>
                        Tọa Tuất Hướng Thìn. Hướng nhà ở 117 đến 123 độ<br>
                        Tọa Ngọ Hướng Tý. Hướng nhà ở 357 đến 3 độ<br>
                        Tọa Tý Hướng Ngọ. Hướng nhà ở 177 đến 183 độ<br>
                        Tọa Đinh Hướng Quý. Hướng nhà ở 192 đến 198 độ<br>
                        Tọa Quý Hướng Đinh. Hướng nhà ở 192 đến 198 đô<br>
                        Tọa Mùi Hướng Sửu. Hướng nhà ở 27 đến 33 độ<br>
                        Tọa Sửu Hướng Mùi. Hướng nhà ở 207 đến 213 độ
                    </div>
                </td>
                <td>
                    <div class="text-left">
                        Vận 6: Có 6 nhà<br>
                        Tọa Giáp Hướng Canh. Hướng nhà ở 252 đến 258 độ<br>
                        Tọa Canh Hướng Giáp. Hướng nhà ở 72 đến 78 độ<br>
                        Tọa Khôn Hướng Cấn. Hướng nhả ở 42 đến 48 độ<br>
                        Tọa Cấn Hướng Khôn. Hướng nhà ở 222 đến 228 độ<br>
                        Tọa Thân Hướng Dần. Hướng nhà ở 57 đến 63 độ<br>
                        Tọa Dần Hướng Thân. Hướng nhà ở 237 đến 243 độ
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="text-left">Vận 7: Có 6 nhà<br>
                        Tọa Mão Hướng Dậu Hướng nhà ở 237 đến 243 độ<br>
                        Tọa Dậu Hướng Mão. Hướng nhà ở 87 đến 93 độ<br>
                        Tọa Ất Hướng Tân. Hướng nhà ở 87 đến 93 độ<br>
                        Tọa Tân Hướng Ất. Hướng nhà ở 297 đến 303 độ<br>
                        Tọa Thìn Hướng Tuất. Hướng nhà ở 297 đến 303 độ<br>
                        Tọa Tuất Hướng Thìn. Hướng nhà ở 117 đến 123 độ
                    </div>
                </td>
                <td>
                    <div class="text-left">
                        Vận 8: Có 6 nhà<br>
                        Tọa Tốn Hướng Càn. Hướng nhà ở 312 đến 318 độ<br>
                        Tọa Càn Hướng Tốn. Hướng nhà ở 132 đến 138 độ<br>
                        Tọa Tỵ Hướng Hợi. Hướng nhà ở 327 đến 333 độ<br>
                        Tọa Hợi Hướng Tỵ. Hướng nhà ở 147 đến 153 độ<br>
                        Tọa Mùi Hướng Sửu. Hướng nhà ở 27 đến 33 độ<br>
                        Tọa Sửu Hướng Mùi. Hướng nhà ở 207 đến 213 độ.
                    </div>
                </td>
                <td>
                    <div class="text-left">Vận 9: Không có</div>
                </td>
            </tr>
        </table>    
        <?php
        return ob_get_clean();
    }

    public function cuuDieu8Phuong($cuuDieuInfo, $soCuDieu, $dongNam, $chinhNam, $tayNam, $chinhDong, $chinhTay, $dongBac, $chinhBac, $tayBac, $luanGiaiCuuDieu) {
        ob_start();
        ?>
        <h3 class="luan-giai-title">5. CỬU DIỆU 8 PHƯƠNG</h3>
        <p class="text-justify">Dựa vào những bảng dưới đây và năm nào thì đưa số (sao vận) vào trung cung phi tinh thuận. 1- Nhất bạch(thủy), 2- nhị hắc(thổ), 3- tam bích(mộc), 4- tứ lục(mộc), 5- Ngũ hoàng( thổ), 6- Lục bạch(kim), 7- Thất xích(kim), 8- bát bạch(thổ), 9- Cửu tử.(hỏa)</p>
        <div class="row row-collapse">
            <div class="col large-12">
                <div class="text-center">
                    <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/bang-cuu-dieu-nam1.png" />
                </div>
            </div>
            <div class="col large-12">
                <div class="text-center">
                    <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/bang-cuu-dieu-nam2.png" />
                </div>
            </div>
            <div class="col large-12">
                <div class="text-center">
                    <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/bang-cuu-dieu-nam3.png" />
                </div>
            </div>
        </div>

        <h4 class="mt-2">Bảng cửu diệu</h4>
        <div class="text-center">
            <table class="table table-calendar table-fixed table-cuudieu">
                <tr>
                    <td class="<?= khongdau($dongNam['menh']) ?>">
                        <div><?= $cuuDieuInfo['so'][7] ?></div>
                        <div><?= $dongNam['name'] ?>(<?= $dongNam['menh'] ?>)</div>
                    </td>
                    <td class="<?= khongdau($chinhNam['menh']) ?>">
                        <div><?= $cuuDieuInfo['so'][3] ?></div>
                        <div><?= $chinhNam['name'] ?>(<?= $chinhNam['menh'] ?>)</div>
                    </td>
                    <td class="<?= khongdau($tayNam['menh']) ?>">
                        <div><?= $cuuDieuInfo['so'][5] ?></div>
                        <div><?= $tayNam['name'] ?>(<?= $tayNam['menh'] ?>)</div>
                    </td>
                </tr>
                <tr>
                    <td class="<?= khongdau($chinhDong['menh']) ?>">
                        <div><?= $cuuDieuInfo['so'][6] ?></div>
                        <div><?= $chinhDong['name'] ?>(<?= $chinhDong['menh'] ?>)</div>
                    </td>
                    <td class="<?= khongdau($cuuDieuInfo['menh']) ?>">
                        <div><?= $soCuDieu ?></div>
                        <div><?= $cuuDieuInfo['name'] ?>(<?= $cuuDieuInfo['menh'] ?>)</div>
                    </td>
                    <td class="<?= khongdau($chinhTay['menh']) ?>">
                        <div><?= $cuuDieuInfo['so'][1] ?></div>
                        <div><?= $chinhTay['name'] ?>(<?= $chinhTay['menh'] ?>)</div>
                    </td>
                </tr>
                <tr>
                    <td class="<?= khongdau($dongBac['menh']) ?>">
                        <div><?= $cuuDieuInfo['so'][2] ?></div>
                        <div><?= $dongBac['name'] ?>(<?= $dongBac['menh'] ?>)</div>
                    </td>
                    <td class="<?= khongdau($chinhBac['menh']) ?>">
                        <div><?= $cuuDieuInfo['so'][4] ?></div>
                        <div><?= $chinhBac['name'] ?>(<?= $chinhBac['menh'] ?>)</div>
                    </td>
                    <td class="<?= khongdau($tayBac['menh']) ?>">
                        <div><?= $cuuDieuInfo['so'][0] ?></div>
                        <div><?= $tayBac['name'] ?>(<?= $tayBac['menh'] ?>)</div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="text-justify"><?= $luanGiaiCuuDieu; ?></div>
        <?php
        return ob_get_clean();
    }

    public function tinhDoCuuDieuDongTheQuai() {
        ob_start();
        ?>
        <h3 class="luan-giai-title">6. TINH ĐỒ CỬU DIỆU ĐÓNG THẾ QUÁI</h3>
        <div class="row row-collapse">
            <div class="col large-12">
                <div class="text-center">
                    <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/cuu-tinh-do.png" />
                </div>
            </div>
            <div class="col large-12">
                <div class="text-justify">
                    Khi lập một tinh bàn (hay trạch vận) của 1 căn nhà, sơn hướng, bộ cửu tinh này dùng để luận hung cát sơn hướng và theo từng cung, năm, ngoài ra còn dùng cho kiêm hướng, kiêm hướng nghĩa là không thuần hướng, chính hướng, mà lại lệch tọa độ sang bên phải hoặc bên trái trên 3 độ, gọi là kiêm hướng.<br>
                    Khi xử lý kiêm hướng thì cần phải dùng Thế quái (số thay thế). Nói về cách dùng kiêm hướng chính là 4 câu khẩu quyết trong “Thanh nang áo Ngữ” mà Dương quân Tùng đã viết để nói về cách dùng Thế quái như sau:<br>
                    NHÂM, MÃO, ẤT, MÙI, KHÔN, Cự môn tòng đầu xuất,<br> 
                    DẬU, TÂN, SỬU, CẤN, BÍNH, vị vị thị Phá Quân,<br>
                    CÀN, HỢI, THÌN, TỐN, TỴ, TUẤT, tận thị Vũ Khúc vị,<br>
                    GIÁP – QUÝ - TÝ - THÂN, Tham Lang nhất lộ hành.<br>
                    DẦN, NGỌ, CANH, ĐINH Hữu Bật tới<br>
                    Có nghĩa là:<br>
                    - Hướng NHÂM, MÃO, ẤT, MÙI, KHÔN, dùng sao Cự môn (số 2) thế.<br>
                    - Hướng DẬU, TÂN, SỬU, CẤN, BÍNH dùng sao Phá Quân (số 7) thế.<br>
                    - Hướng CÀN, HỢI, THÌN, TỐN, TỴ, TUẤT dùng sao Vũ Khúc (số 6) thế.<br>
                    - Hướng TÝ, QUÝ, GIÁP, THÂN, dùng sao Tham Lang (số 1) thế.<br>
                    - Hướng DẦN, NGỌ, CANH, ĐINH sẽ được sao Hữu Bật bay tới (số 9).<br>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public function batTrachTheo24SonHuong($tuTru) {
        ob_start();
        ?>
        <h3 class="luan-giai-title">7. LẬP BÁT TRẠCH THEO MỆNH QUÁI 24 SƠN HƯỚNG</h3>
        <p>Như quý vị thường biết khi xây nhà là dựa theo mệnh quái để lập lá số bát trạch để xây nhà. Thuật toán là nhà tọa cung xấu. Hướng tốt để đón sinh khí của trời đất, nên có trạch quẻ và sơn hướng. Hướng thì lấy theo cung đối diện của trạch quẻ tọa của công trình, trong mệnh quái (cung phi) và bát trạch được chia làm 2 phương đông và tây. (như quý vị thường nghe đông tứ mệnh hay tây tứ mệnh) theo quy luận của thuật toán này thì phương nào kết hợp với phương đó thì tốt, còn kết hợp khác phương thì xấu. Trong bát quái có 8 cung tượng trưng cho 4 phương 8 hướng của trời đất. Cách tính Thăng Long Đạo Quán có ghi công thức bên dưới. Còn mục này Thăng Long Đạo Quán xin phép chia sẻ kiến thức lập quẻ bát trạch cho 1 ngôi nhà. để khi xây dựng và bố trí các phong. Thờ, bếp, khách, ngủ, wc để tránh hung đoán cát. Khi xây 1 căn nhà quý vị không thể tránh toàn bộ mọi thứ được nếu tránh hết thì chắc không bao giờ xây được nhà. Quý vị chỉ cần tránh 10 quy tắc quan trọng trong bát trạch. Còn lại trấn giải là đủ</p>
        <?php if ($tuTru->menhQuaiArr['menh2'] == 'dong') : ?>
            <div class="tinhdo">
                <h3 class="red">SƠN NGỌ HƯỚNG TÝ – SƠN ĐINH HƯỚNG QUÝ (TOẠ LY HƯỚNG KHẢM) ĐÔNG</h3>
                <div class="row row-collapse">
                    <div class="col large-9">
                        <div class="text-center">
                            <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/dong_1.png" />
                        </div>
                    </div>
                    <div class="col large-3">
                        <div class="text-center">
                            <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/dong_1_1.png" />
                        </div>
                    </div>
                </div>
                <p>Dân gian thường cho rằng nhà hướng nam hoắc đông nam thì hầu như phong thủy đều tốt vì gió mát vào mùa hè và ấm vào mùa đông, nhưng hướng nam được chia thành ba sơn là Bính – Ngọ – Đinh, đương nhiên phong thủy nhà ở này sẽ có sự thay đổi theo thời gian các vận của ngôi nhà và vận của gia chủ, vậy cho nên 1 ngôi nhà sẽ có thời đông đúc và thưa thớt, 1 vận là 20 năm và có sự thay đổi trong 20 năm tới 30 năm. Vd: 1 ngôi nghà này 20 năm trước nhân đinh, tài lộc, nhiều nhưng 20 năm sau còn có 1 tới 2 người và ngược lại. Đó chính là vượng suy, nếu mỗi chúng ta biết và đáo sơn hướng thì ngôi nhà sẽ vượng khí lâu hơn, những nhà Tọa Ngọ Hướng Tý thì sẽ khá tốt cho gia chủ có bát tự thuộc Dụng, Hỷ Thần thuộc ngũ hành Kim Thủy.</p>
                <ul>
                    <li>A- Kiểu nhà Tọa Ngọ Hướng Tý</li>
                    <li>B- Tọa Đinh Hướng Quý hướng</li>
                </ul>
                <p>ở vận 8 hạ nguyên thuộc cục song tinh hội tọa. Sao vận bay tới hướng. Tốt cho tiền tài nhưng khống tốt cho sức khỏe. Về tiền tài là tốt nhưng không phải lúc nào cũng tốt và tốt về mọi mặt, đôi lúc hữu lộc nhưng chưa cso lộc tồn khi vận suy. Trừ khi sơn tọa có sơn thủy, (sau có nhà cao hơn và có sông, hồ lưu thông) thì tốt về nhân đinh và tiền tài vượng, dễ sinh con cháu văn chương, trí dũng, thông minh.</p>
                <p>Cửa chính nên đặt ở cung Ly sẽ tốt cho tài vận và người trong nhà, nhưng cũng lên chú ý hướng này nóng tính dễ cục xúc và không phải hợp ngũ hanh với tất cả mọi thanh viên. Còn mở cửa ở cung Tốn thì tốt con cái. Nên tránh mở cửa ở cung Cấn thì lục thân và tiền tài dễ gặp hung. Nếu có cửa ở các cung Càn – Chấn – Tốn thì các năm Ngọ – Mùi – Thân – Dậu nên có thêm người để được cát lành, đồng thời chú ý những năm Tuất – Hợi – Mão – Thìn sẽ dễ gặp chuyện thị phi phiền toái, nên không hơn thua, đúng sai, sống chậm để giải hung tinh mất, thiệt là được.</p>
                <p>Nhà tọa sơn hướng này thì Cung Càn và cung Chấn: sao Nhị Hắc bệnh phù tinh, sao Ngũ Hoàng sát tinh bay tới nên hai phương này, nếu có thủy và sơn hiểm trở thì sẽ khiến lục thân lục đục, nếu có gia chủ lên dùng bình phong để hóa giải. Còn khi Tọa Đinh, Quý Hướng, thì phương Hợi, Càn thì lục thân dễ ốm đau, thị phi.</p>
                <p>Nhà tọa sơn hướng này thì Cung Cấn: sao Thất Xích và sao Cửu Tử bay đến. tránh có ao, nước lớn ở phương vị đó, sẽ dễ mạng lại những diều không tốt cho những người phụ nữ trong gia đình.</p>
                <p>Nhà tọa sơn hướng này thì Cung Khôn và cung Đoài: sao Nhất Bạch và sao Lục Bạch bay đến. nếu Ở cung Khôn có thủy và cung Đoài có sơn lợi cho tài lộc và học hành của con cái được có danh.</p>
                <p>Nhà tọa sơn hướng này Cung Tốn: sao Tam Bích và sao Tứ Lục bay đến, Nếu có núi hặc nhà cao tầng, nhiều góc nhà (sát) sẽ ảnh hưởng tới trưởng nữ, dễ nặng thì dễ mắc bệnh về thần kinh. Còn nước chảy (sông, suối, mương, máng) thì dễ sinh dâm loạn.</p>
                <ul>
                    <li>C- Còn nhà tọa Bính hướng Nhâm</li>
                </ul>
                <p>Nhà tọa Bính hướng Nhâm thuộc vận 8 thuộc cục Song tinh đáo hướng. số 8 của vận 8 bay tới hương. Nếu hướng có thủy, nước chia nhiều nhánh, và có nui, nhà cao tầng thì gia chủ được cả nhân đinh và tài lộc. cung có cửu tử, Thất xích tọa, tuy là tương khắc nhưng Cửu tử là sinh khí hỏa tinh. Có thêm thủy thì vượng tài lộc. nhưng không nên có nhà cao tầng hoặc núi, sẽ dễ có tai họa, các bệnh ở mắt, não, dễ bất lợi cho con gái thứ.</p>
                <p>Nhà tọa Bính hướng Nhâm nên mở cửa ở cung Khảm thủy, Cấn thổ, tốt cho nhân đỉnh và tài lộc. Không nên mở cửa cung Tôn, Khôn, Đoài, Càn. Và để thêm cát tinh thì năm Tý thêm người để vượng cát. Còn những năm Sửu, Dần, Mão cũng tốt nhưng không bằng năm tý. Gia chủ cũng nên lưu ý: Những năm Ngọ, Mùi, Thân, Dậu, Tuất, Hợi dễ gặp chuyện thị phi phiền toái, gia chủ nên không hơn thua, đúng sai để tránh hạn.</p>
                <p>Nhà tọa Bính hướng Nhâm Cung Càn: Tam bích, Tứ lục đóng, thuộc suy tử sát tinh. Nếu có núi hoặc nhà cao tầng thì dễ trong lục thân có người vô tài nặng thị bại tài, dễ mắc các bệnh như gan, mật. con gái thì dễ làm nghề kỹ nữ. Hoặc tinh duyên lận đận.</p>
                <p>Nhà tọa Bính hướng Nhâm Cung Tốn, Đoài: Nhị hắc, Ngũ hoàng đóng, Nhị hắc là Bệnh phù tinh, Ngũ hoàng là sát tinh. Không nên có núi, nhà cao tầng, thì gia chủ chú ý về lục thân không vượng, dễ tật bệnh quanh năm, hoặc tai nạm hay kéo tới.</p>
                <p>Nhà tọa Bính hướng Nhâm Cung Khôn: thuộc Thất xích, Cửu tử. trước mặt có núi, nhà cao tầng thì cát, còn có thủy, sông, hồ lớn thì là hung, mệnh nữ có thể gặp chuyện thị phi, và bất hòa với nhau</p>
                <p>Nhà tọa Bính hướng Nhâm Cung Ly: Thất xích, cửu tử đóng, Hỏa khắc Kim. Nếu có thủy, dòng nước là cát, còn có núi, nhà cao tầng nhiều, thì dễ gặp tai họa, thị phi, nữ giới khi mang thai dễ dâm loạn. chú ý về bệnh tim, não, phổi, dạ dày, môi, mắt.</p>
                <p>Nhà tọa Bính hướng Nhâm Cung Cấn, Chấn: thuộc Nhất bạch, Lục bạch. Nếu cung Cấn, Chấn nếu có thủy và sơn, gia trung có người văn trí song toàn.</p>
            </div>
            <div class="tinhdo">
                <h3 class="red">SƠN DẬU HƯỚNG MÃO – TÂN SƠN ẤT HƯỚNG - (TOẠ ĐOÀI HƯỚNG CHẤN) ĐÔNG</h3>
                <div class="row row-collapse">
                    <div class="col large-9">
                        <div class="text-center">
                            <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/dong_2.png" />
                        </div>
                    </div>
                    <div class="col large-3">
                        <div class="text-center">
                            <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/dong_2_1.png" />
                        </div>
                    </div>
                </div>
                <ul>
                    <li>A- sơn Dậu hướng Mão</li>
                    <li>B- sơn Tân hướng Ất</li>
                </ul>
                <p>đang trong vận 8 hạ nguyên thuộc Song tinh hội tọa. Phương tọa có núi, nhà cao tầng, sau núi, nhà cao tầng lại có thủy (ao hồ) là cát tốt cho nhân đinh và tiền tài, hướng nhà có Tam bích, Tứ lục tọa đóng, là sát tinh, hướng trước mặt nên bằng phẳng là cát, còn nếu có sơn thủy, nhà cao tàng, cầu, dễ xuất hiện bị trộm cắp, lục thân trong gia trung dễ mắc bệnh gan mật, bệnh ở lưng.</p>
                <p>Cửa nhà ở cung Đoài, thì cát cho lục thân và tiền tài, còn ở cung Ly, lục thân sẽ có ngườ văn võ song toàn. Còn ở cung Cấn, Cửu vận tốt cho tài vượng, những cung khác không lên mở nếu phải mở nên nhờ chuyên gia xét và trấn giải. Những năm có thiên can là Mậu, Kỷ, Tân, Dậu thì gai chủ nên thêm người sẽ nhận thêm điều cát lành. Còn những năm Mùi, Thân, Tý, Mão, Thìn, Tỵ không nên thêm người thêm sẽ dễ gặp chuyện thị phi bất đồng trong gia trung.</p>
                <p>Cung Càn: Sao cửu tử tọa đóng, cửu tử là sao sinh khí. Nếu có núi, nhà cao tầng thì tốt cho lục thân, chủ về sống trường thọ, dễ có người làm luật sư, quan tòa, bác sỹ. nhưng hướng không lên có núi, nhà cao tầng hoặc dòng nước chảy thẳng, nếu gặp lên dùng bình phong để trấn không trong nhà gặp tai họa hao tiền, có kẻ dâm tà, người nhà dễ mắc bệnh huyết quản, tim, não, phổi, đại tràng, bệnh ở chân.</p>
                <p>Cung Khôn, Tốn, Khảm: 3 cung này thuộc sát tinh. 3 phương nên bằng phẳng không nên có nui hay nhà cao tầng, nếu có sơn thủy, (sông hồ, núi nhà cao tầng thì trong gia trung lục thân dễ gặp tai họa bất ngờ. </p>
                <p>Cung Ly: sao Nhất bạch, Lục bạch tọa đóng. Nếu có ao, hồ, có mảnh đất, gò đất, và có núi, nhà cao tầng ở xa, thì là cát tinh, trong gia trung sẽ có người văn võ song toàn, có phú quý.</p>
                <p>Cung Cấn: sao cửu tử tọa đóng, nếu có thủy tĩnh như ao đầm, hồ, thì là cát, trong gia trung sẽ có người tài giỏi. Cung này có hai sao cửu tử, Thất xích hội tụ, nếu bị ẩm ướt u tối, bẩn thỉu, bê bối, thì gia trung dễ có người đam mê tửu sắc dễ bê tha. Nếu có núi, nhà cao tầng thì hung dễ gặp hỏa hoạn, và dễ mắc các bệnh tỳ vị, phổi, huyết quản, tim, não.</p>
                <ul>
                    <li>C- Sơn Canh hướng Giáp</li>
                </ul>
                <p>trong vận 8 thuộc Song tinh hội hướng. sao vận bay tới hướng tạo ra Vũ khúc, ngũ hành Kim rắn gặp Thổ, thuộc cát lành phú quý. Nếu hướng có sông, hồ, ao, đầm bao quanh sau sông có núi, nhà cao tầng thì gia chủ hữu lộc lộc tồn. còn Tọa cần bằng phẳng, nếu co nui, nhà cao tầng thì dễ gia nghiệp suy thoái, lục thân hay gặp chuyện thị phi phiền toái, bất đồng quan điểm, mâu thuẫn lẫn nhau. Còn phản cung thủy, sơn, đường, cầu, cầu vượt, thì gia chủ dễ gặp những chuyện trong nhà có kẻ bất lương, hoặc gặp những điều tai ương. Nếu có núi, nhà cao tầng, nhiều tòa đan xen là hung, dễ bị tai nạn xe cộ, và mắc các bệnh ở chân, gan, phổi, cổ họng, đại tràng.</p>
                <p>Căn nhà thuộc Sơn Canh hướng Giáp thì nên mở cửa cung Chấn, tốt cho tiền tài và nhân đinh. Còn mở cửa cung Khảm, trong gia trung sẽ có người có tài văn nghệ sỹ, có ý trí, tài lộc và nhân đinh đều vượng. không lên mở cửa ở cung vị khác dễ gặp hung tinh. Nếu bắt buộc phải mở thì nên nhờ chuyên gia xem kỹ và hóa giải. gia chủ xin lưu ý thêm những Năm Tý, Mão có thêm người là cát lành. Còn những Năm Mùi, Thân cát thứ hai. Những năm còn lại thì không nên thêm người vì dễ gặp hung tinh.</p>
                <p>Cung Cấn: có sao Tam bích, Tứ lục tọa đóng, thuộc tổ hợp sát tinh. Để tránh hung tinh quấy phá nên có mặt bằng rộng, tránh có thủy, sơn, nhà cao tầng, hung tinh này ám chỉ về gia nghiệp dễ suy bại, dễ có người phải làm kỹ nữ, đạo tặc, ăn xin, và chú ý dễ có bệnh ở chân, tỳ vị, gan mật.</p>
                <p>Cung Khảm: có sao sơn Lục bạch, hướng Nhất bạch tọa đóng, là tổ hợp về Văn chương. Cung này nếu có sông suối, ao hồ, đầm hình tròn hoặc có minh đường, (gò đất) dòng nước phân 3 nhánh, thì gia chủ nhận được khí vượng, gia trung phúc lộc song toàn.</p>
                <p>Cung Tốn: có sao cửu tử tọa đóng. Nếu có núi, tòa nhà cao tầng, thì trong nhà ắt sinh ra người thông minh tháo vát làm những công việc như làm quan, pháp luật, quân sự. nhưng nếu có sông, hồ, đầm, ao (thủy) thì trong gia trung dễ có người nhà tàn tật, máu, thần kinh, bệnh chân tay, đốt sống.</p>
                <p>Cung Khôn: có sao Thất xích, Cửu tử tọa đóng, nếu có thủy (sông hồ ao đầm) từ năm 2024 tài vận hanh thông, vượng tài vượng đinh. Còn nếu có núi, nhà cao tầng thì dễ tiền tài xa sút, người mẹ dễ có bệnh, người nhà dễ bị bệnh về huyết, tử cung, tỳ vị.</p>
                <p>Cung Càn, Ly: có sao Nhị hắc, Ngũ hoàng tọa đóng, thuộc hung tinh. Phương này nếu có sự bằng phẳng, rộng, thì không sao nhưng có núi, nhà cao tầng và nước, sông ao hồ đầm, thì có trong lục thân phải sống cô độc, trong lục thân dễ bị bệnh như huyết quản, tim, não, chân, tỳ vị, mắt.</p>
            </div>
            <div class="tinhdo">
                <h3 class="red">SƠN CÀN HƯỚNG TỐN - Hợi hướng Tỵ - (TOẠ CẤN HƯỚNG TỐN) ĐÔNG</h3>
                <div class="row row-collapse">
                    <div class="col large-9">
                        <div class="text-center">
                            <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/dong_3.png" />
                        </div>
                    </div>
                    <div class="col large-3">
                        <div class="text-center">
                            <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/dong_3_1.png" />
                        </div>
                    </div>
                </div>
                <ul>
                    <li>A- Nhà tọa Càn hướng Tốn</li>
                    <li>B- Tọa Hợi hướng Tỵ</li>
                </ul>
                <p>trong vận 8 thuộc hạ nguyên thuộc Vượng sơn vượng hướng, nếu tọa có núi, nhà cao tầng, hướng có thủy như hơ, ao, suối, có hai dòng nước gặp nhau giao nhau, cửa hướng Tốn thì tốt cho nhân đinh và tài lộc. Còn mở cung Khôn, Chấn, thì sinh ra người có tài. Còn cửa ở cung Khảm, Ly, Đoài, thì dễ gặp thị phi phiền toái. Nhưng năm Tuất, Hợi, Thìn, Tỵ thêm người thì là đại cát. Còn những năm Mùi, Thân, Mão thì thuộc trung bình cát. Còn những năm khác thì không nên thêm người vì dễ gặp điều hung. </p>
                <p>Cung Chấn: có sao Nhị hắc, Cửu tử tọa chiếu. Nếu có thủy, ao hồ trong sạch thì chủ tài, lộc. Còn có núi, nhà cao tầng thì gia đình dễ có người kém thông minh, và dễ mắc các bệnh liên quan tới gan, tỳ, và mắt.</p>
                <p>Cung Đoài: có sao Ngũ hoàng, Thất xích. Thuộc hung tinh hội tọa. Nếu có địa hình bằng phẳng sạch sẽ thì giảm hung hại, còn có thủy, sơn (nhà cao tầng, ao hồ sông suối to mạnh trong nhà dễ phá tài, nhân đinh suy giảm, ốm đau bệnh tật, hao tiền của chú ý các bệnh đường hô hấp</p>
                <p>Cung Khảm: có sao Nhị hắc, Tứ lục, thuộc hung tinh tụ hội. Nếu có địa hình bằng phẳng sạch sẽ thì giảm hung hại. còn có thủy, sơn (nhà cao tầng, ao hồ sông suối to mạnh, nữ trong nhà dễ bị các bệnh lien quan tới bệnh nữ. Còn nếu có dòng nước chảy thẳng hoạc sát cua của sông (bên nở) gia đình dễ bị suy tài của, và dễ mắc các bệnh liên quan tới  xương, thận, máu.</p>
                <p>Cung Ly: có sao Tam bích, Ngũ hoàng tọa đóng. Thuộc hung tinh, nhưng nêu có núi, nhà cao tầng nhiều to cao sẽ hóa hung thành cát. Còn có thủy, sông, hồ to mạnh thì là hung người trong nhà dễ làm việc bất lương, chú ý các bệnh liên quan tới mắt, tim gan.</p>
                <p>Cung Khôn: có sao Nhất bạch, Tam bích tọa chiếu. Nếu có thủy, sông, hồ trong sách, tốt cho vượng tài lộc, còn có núi, nhà cao tầng là hung, người mẹ cần chú ý về sức khỏe, và các bệnh liên quan tới mắt. Còn nếu phương xa có núi, nhà cao tầng dễ trong nhà có người làm việc bất lương.</p>
                <ul>
                    <li>C- Nhà tọa ở Tuất hướng Thìn</li>
                </ul>
                <p>trong vận 8 hạ nguyên thuộc Thượng sơn hạ thủy (hung) thế này bị sao sơn đóng tại hướng, và sao hướng đóng tại sơn, một cách cụ hung nhưng có hung ắt có cát, chỉ cần sơn có ao hồ nước trong sạch, sau nước có núi là hóa hung thanh cát, sẽ tốt cho nhân đinh, tài lộc, cửa nhà mở tại Càn, Cấn, Đoài, sẽ nhận được tài lộc, nhân đinh vượng, các cung khách thì không nên mở nếu bắt buộc thì nên nhờ thầy xét và trấn giải. Nhưng năm Tuất, Hợi, Sửu, Dần, Thìn, Tỵ nếu thêm nhân đinh là cát, còn những năm Tý, Mão, Mùi, Thân. Không nên thêm người vì là hung.</p>
                <p>Cung Ly: có sao Nhị hắc, Tứ lục tọa đóng, thuộc hung tinh. Nếu có thế bằng phẳng thì sẽ không gặp hung hại. Còn nếu có sơn thủy, núi, aoo hồ cùng xung chiếu, thì người nữ dễ hung hãn, kinh doanh làm ăn dễ suy, nữ trong nhà chú ý các bệnh của phụ nữ</p>
                <p>Cung Đoài: có sao Cửu tử tọa đóng. Nếu có thủy, ao, hồ trong sạch tốt cho tài lộc vượng. Còn có núi, nhà cao tầng thì dễ bi suy bại về kinh tế và nhân đinh. </p>
                <p>Cung Cấn: có sao Tam bích, Nhất bạch tọa đóng. Nếu có ao hồ, trong sạch chủ về tài vượng. Còn có núi, nhà cao tầng thì dễ bi suy bại về kinh tế và nhân đinh. Dễ có người làm việc bất lương. 
                </p>
                <p>Cung Khảm: có sao Tam bích, Ngũ hoàng tọa đóng, thuộc suy tinh. Nếu có hình thế bằng phẳng sẽ không gặp hung hại, Còn có núi, nhà cao tầng, thủy như ao hồ sông  bẩn, còn bị xung chiếu với nhà trong nhà dễ có kẻ làm việc bất lương, dân anh chị, làm xấu hổ gia đình.</p>
                <p>Cung Khôn: có sao Tứ lục, Lục bạch tọa đóng, thuộc sát tinh. Nếu có thế bằng phẳng thì sẽ không gặp hung hại. Còn có núi, nhà cao tầng, thủy như ao hồ sông, to mạnh nước bẩn gia trung hay gặp thị phi, có cuộc sống khó khăn</p>
            </div>
            <div class="tinhdo">
                <h3 class="red">SƠN TÝ HƯỚNG NGỌ (TOẠ KHẢM HƯỚNG LY) ĐÔNG</h3>
                <div class="row row-collapse">
                    <div class="col large-9">
                        <div class="text-center">
                            <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/dong_4.png" />
                        </div>
                    </div>
                    <div class="col large-3">
                        <div class="text-center">
                            <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/dong_4_1.png" />
                        </div>
                    </div>
                </div>
                <ul>
                    <li>A- Quý sơn Đinh hướng</li>
                    <li>B- Sơn tý hướng ngọ</li>
                </ul>
                <p>trong vận 8 thuộc Song tinh hội hướng. Nếu có núi, nhà cao tầng và nước, ao hồ sông, đầm, thì gia chủ vượng cả nhân đinh và tài lộc. Sơn tọa có núi, nhà cào tầng thì vượng về nhân đinh. Nên mở cửa tại cung Ly, Đoài, tốt cho người sống trong nhà và có tiền của, còn cửa tại cung Càn, Tốn, Chấn, thì gia đình dễ gặp chuyện không như mong (hung hại). Những năm Ngọ, Mùi, Thân, Dậu, có thêm người là cát. Còn những năm khác thì không nên thêm người sẽ mang lại hung hại.</p>
                <p>Cung Tốn: có sao Tứ lục, Tam bích tọa đóng, hướng này nên bằng phẳng thì không có chuyện gi sẩy ra. Còn có núi, nhà cao tầng, nước, ao hồ đầm, sông là hung haị, trong gia đình dễ mắc bệnh liên quan tới gan mật, tâm lý, dễ có người làm việc bất lương, dễ đa dâm và bại tài.</p>
                <p>Cung Càn, cung Chấn: có sao Nhị hắc, Ngũ hoàng tọa đóng. hướng này nên bằng phẳng thì không có chuyện gi sẩy ra. Còn có núi, nhà cao tầng, nước, ao hồ đầm, sông là hung hai, gia đình dễ bị ốm đau bệnh tật, xui xẻo</p>
                <p>Cung Khảm, cung Cấn: có sao Thất xích, Cửu tử tọa đóng. ở cung Khảm có nước, ao, hồ, sông, đầm, cung Cấn có núi, nhà cao tầng thì là hung xấu cho người và của. Còn ngước lại cung Khảm có núi, nhà cao tầng, cung Cấn gặp nước, ao, hồ, đầm, sông trong nhà có người tướng mạo đẹp, làm những việc nhà nước, chính trị, quan sự. </p>
                <p>Cung Khôn, cung Đoài: có sao Nhất bạch, Lục bạch tọa đóng. ở cung Khôn có núi, nhà cao tầng, còn cung Đoài có nước, ao hồ, sông trong sạch, tốt cho nhân đinh và tài lộc như mong, trong nhà ắt có người giỏi về văn chương, trí dũng. </p>
                <ul>
                    <li>C- Nhà tọa Nhâm hướng Bính</li>
                </ul>
                <p>trong vận 8 thuộc Song tinh hội tọa. Ở phương tọa có gò đất cao to, hoặc có núi, nhà cao tầng, nước nhiều nhánh, thì vượng nhân đinh và tài lộc. Hướng có thất xích tọa đóng nếu có núi, nhà cao tầng, thủy, ao hồ, sông thì hung chú ý bệnh liên quan tới máu huyết. Còn sơn tọa có sao Cửu tử tọa đóng, phương này xa có núi và nhà cao tầng là cát lành. </p>
                <p>Nếu cửa mở tại cung Khảm, Chấn, Khôn là cát, không nên mở cửa cung Đoài vì sẽ hung, nam, thai phụ trong nhà sẽ bất lợi. Còn cửa ở cung Tốn, Càn, dễ gặp chuyện thị phi phiền toái, nhiều chuyện bất lợi tự ập tới vô cớ. Để thêm cát lành thì những năm Tý, Mão, Mùi, Thân gia chủ nên thêm người. Còn vào các năm như Dậu, Tuất, Hợi, Thìn, Tỵ thì không nên thêm người vì sẽ gặp hung họa.</p>
                <p>Cung Cấn: Sơn có sao Nhất bạch tọa chiếu, hướng có sao Lục bạch, tọa chiếu. Nếu có núi, nhà cao tầng to và nhiều tốt về tài giỏi và phú quý. Gia đình đón được nhiều niềm vui và hỷ lạc. </p>
                <p>Cung Khôn: sao cửu tử tọa đóng tại hướng nếu có nước, ao đầm nhiều nhánh, gia đình có nhiều tài lộc. Nhưng nếu có núi, nhà cao tầng to nhiều là hung, gia chủ lưu ý: các bệnh liên quan tới lá lách, dạ dày, tử cung.</p>
                <p>Cung Đoài, Tốn: có sao Ngũ hoàng, Nhị hắc, tọa đóng, nên có mặt bằng phẳng mới tránh được hung. Còn khi có núi, nhà cao tầng, nước, ao hồ, sông thì là hung gia chủ lưu ý: về những bệnh liên quan tới gan, phổi, hầu. </p>
                <p>Cung Càn: Sơn, hướng có sao Tam bích, Tứ lục, tọa đóng, nên có mặt bằng phẳng mới tránh được hung. Còn khi có núi, nhà cao tầng, nước, ao hồ, sông thì là hung, gia đình dễ mắc các bệnh liên quan tới gan mật, tim não, phổi, khi gặp vận xấu còn dễ có tính phóng túng, dâm đãng, vợ chồng bất đồng quan điểm, mỗi người một phách, dễ bại tài, của. </p>
                <p>Cung Chấn: Sơn, hướng có sao Lục bạch, Nhất bạch tọa đóng. Tốt cho nhân đinh và tiền tài được cát lợi. Nhưng cần có ao, hồ, sống có nước trong lành sạch sẽ thì trong gia đình sẽ có nhân tài về văn chương, dạy học.</p>
            </div>
        <?php endif; ?>
        <?php if ($tuTru->menhQuaiArr['menh2'] == 'tay') : ?>
            <div class="tinhdo">
                <h3 class="red">NHÀ SƠN KHÔN HƯỚNG CẤN – SƠN THÂN HƯỚNG DẦN (thượng sơn hạ thủy) (TOẠ KHÔN HƯỚNG CẤN) TÂY</h3>
                <div class="row row-collapse">
                    <div class="col large-9">
                        <div class="text-center">
                            <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/tay_1.png" />
                        </div>
                    </div>
                    <div class="col large-3">
                        <div class="text-center">
                            <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/tay_1_1.png" />
                        </div>
                    </div>
                </div>
                <ul>
                    <li>A- Nhà tọa Khôn hướng Cấn</li>
                    <li>B- Tọa Thân hướng Dần thuộc vận 8 hạ nguyên bị phạm Thượng sơn hạ thủy, nên sử dụng hình cục tọa không triều mãn. Đồng thời bàn này sơn tinh mãn bàn phản phục ngâm, nhưng toàn cục lại hợp Liên châu tam bàn quái. Nếu tọa có núi, nhà cao tầng, và hướng thủy sông, ao, hồ to rộng, thì là hung tinh gia trung làm ăn khó khăn, hao tài tốn của dễ khuynh gia bại sản, còn phụ nữ dễ mắc bệnh tinh thần. Nhưng quý vị cũng nên an tâm có hung ắt có cát, với thế thượng sơn hạ thủy này chỉ cần đáo sơn hướng là tài lộc và nhân đinh lại được vượng khí, việc này cũng không khó nhưng cần có chuyên gia thực hiện và áp dụng một số thuật toán khác để bổ trợ. Sẽ hóa hung thành cát.</li>
                </ul>
                <p>Nếu Cửa nhà ở cung Khôn, cung Chấn, thì chủ về tài vượng. Còn Mở cửa cung Tốn thì phát cả nhân đinh và tài lộc, những phương vị còn lại thì đều không tốt. Nhưng năm Mùi, Thân, Thìn, Tỵ nếu thêm người thì cát. Còn những năm còn lại khi thêm người sẽ không tốt.</p>
                <p>Cung Ly, có sao Lục bạch, Cửu tử tọa đóng. Nếu có núi, nhà cao tầng xa thì cát, tốt về trường thọ. Nhưng nếu có chùa miếu, thủy, sông lớn xung chiếu, dễ người trong nhà lo âu dẫn tới bệnh tật, nặng có thể bị trầm cảm, con trai trong dễ bị bệnh về máu, còn người trong nhà dễ có bệnh huyết quản, tim, não.</p>
                <p>Cung Khảm: có sao Thất xích, Nhất bạch, tọa đóng. Nếu có núi, nhà cao tầng xa thì cát, có thể trong nhà có người làm luật sư hoặc liên quan. Còn nếu có thủy xung thẳng, lục thân trong nhà nam/nữ dễ dâm đãng, loạn luân, và trong nhà dễ có bệnh tai, xương, phổi, thận.</p>
                <p>Cung Tốn: có sao Nhất bạch, Tứ lục tọa đóng. Nếu có dòng nước, thủy, ao hồ, sạch sẽ, trong nhà ắt có người học rộng tài cao, cong danh tài vận cát lành. Nhưng nếu có núi, nhà cao tầng lại là hung, thì trong nhà dễ có người tà dâm, đam mê tửu sắc.</p>
                <p>Cung Chấn: có sao cửu tử, Tam bích tọa đóng. Nếu có thủy (ao, hồ) sạch sẽ không bị uế tạc là cát. Từ năm 2024 tài lộc như mong, trong nhà có người trí tuệ song toàn. Nhưng nếu có núi, nhà cao tầng thì là hung, trong gia trung dễ nam, nữ tệ nam</p>
                <p>Cung Càn, Đoài: có sao thất xịch, tứ lục tọa đóng. Hai phương này nếu có hình thế bằng phẳng thì không sao. còn có dòng nước (thủy) núi, nhà cao tầng thì người nhà dễ có bệnh liên quan tới gan, tim, phổi, chú ý xe cộ.</p>
                <p>Hóa giải thế thượng sơn hạ thủy của sơn Khôn Cấn hướng </p>
                <p>Không nên mở cửa ờ hướng Cấn, đó là hung tinh thêm Ngũ Hoàng đại sát, nên tối kỵ không được mở</p>
                <p>Theo ngũ hành âm dương thì Hướng Khôn, Ly, Đoài phải là âm: nghĩa là không nên mở cửa to và rộng. Nếu bắt buộc làm cửa thì nên làn nhỏ</p>
                <p>Còn riêng Hướng Cấn, Chấn, Khảm, phải thuộc Dương, thì nên làm cửa lớn và to. Cửa lớn mở chính cung Mão sẽ cát. Khi lập cục cung Mão thuộc thành môn có sao Cửu Tử sinh đóng lên cát, trấn giải được thế Hạ Thủy nên hóa hung thành cát. </p>
                <p>Còn hướng Khôn, nên xây một bức bình phong cao tượng trưng cho SƠN. Và nên mở một cửa sổ để nạp khí cát. </p>
                <p>Còn hướng Cấn, nên để hành lang rộng dài một chút để đón vượng khí, đi tới thành môn Mão sẽ cát. </p>
                <p>Từ cửa chính bên tây trái nên nên xây hòn giả sơn, có thủy và chảy 24/24h sẽ cát, nếu có không gian và điều kiện nên làm một con đường quanh có từ cổng vào nhà</p>
                <p>Nhưng quý vị xin lưu ý: phúc lộc tại nhân, thành bại tại trí. Muốn giải hung phải có quả phúc dầy, muốn có quả phúc dầy phải tu tâm dưỡng tính hành thiên. </p>
                <ul>
                    <li><b>C- Nhà tọa ở Mùi hướng Sửu</b> ở vận 8 thuộc Vượng sơn vượng hướng là một thế tốt về tài lộc và nhân đinh, nhưng còn phải phụ thuộc vào hình thế bên ngoài như nào.</li>
                </ul>
                <p>Quý vị cũng nên lưu ý: thế này còn bị phạm phục ngâm, nếu hướng có thủy như ao hồ trong sạch, sơn có núi, nhà cao tầng thì sẽ giải được thế phản phục ngâm, hóa hung thành cát. Còn nếu bị phản sơn hướng thì là hung, dễ hao tài, tật bệnh. Sơn (tọa) có thủy, dễ bị các bệnh liên quan tới dạ dày, đốt sống, tử cung, cánh tay. Còn hướng có núi, nhà cao tầng thì dễ bệnh tât ở chân và bụng, lo âu buồn phiền.</p>
                <p>Nếu Cửa nhà ở cung Cấn, Càn tốt về nhân đinh công danh tài lộc, hữu lộc lộc tồn, thanh cao viên mãn. </p>
                <p>Nếu cửa ở cung Chân, Tốn, Khảm, Ly thuộc hung tinh, bắt buộc phải mở thì cần nhờ thây xét và trấn giải, những năm Sửu, Dần, Mùi, Thân, Tuất, Hợi gia chủ nên thêm nhân đinh để thêm cát lành. Và những Năm Mão, Thìn, Tỵ thì gia chủ không nên thêm nhân đinh sẽ hung hại.</p>
                <p>Cung Khảm: có sao Lục bạch, Cửu tử tọa đóng, nếu có núi, nhà cao tầng thì không sao, nhưng có thủy sông, ao đầm thì những người trong nhà dễ mắc các bệnh về não, xương, phổi, tim, dạ dày, những nam giới trong nhà cần chú ý, dễ có người bất hiếu, tâm địa xấu xa.</p>
                <p>Cung Đoài: có sao Cửu tử, Tam bích tọa đóng, nếu có thủy, ao, hồ, sạch sẽ thoáng mát thì gia đình có người thông minh, có trí. Còn nếu có núi, nhà cao tầng thì dễ trong nhà có người làm trộn, nữ dễ đa dâm.</p>
                <p>Cung Ly: có sao Thất xích, Nhất bạch, Nhất bạch tọa đóng. Nếu có ngọn núi, nhà cao tầng xa thì có người tài giỏi về pháp luật, luật sư, còn nếu có thủy, như ao, hồ thì trong nhà dễ có người dâm loạn, chú ý về đường hô hấp</p>
                <p>Cung Càn: có sao Nhất bạch, Tứ lục tọa đóng, Văn xương chiếu tới. Nếu có thủy như hồ ao trong sạch, gia đình sẽ có người văn chương trí dũng. Còn nếu phạm sát như khu tập thể cũ, nhà hoang, cầu đường thì trong nhà con cháu học hành dễ không như mong, nữ dễ tà dâm. </p>
                <p>Cung Tốn, Chấn: có sao thất xích, tứ lục, tam bích, lục bạch. Nếu bằng phẳng thì không sao, nhưng có nui, nhà cao tầng, thủy ao hồ sông rõ và mạnh thì dễ sinh con một bề, và chú ý các bệnh liên quan tới tâm lý, cổ, vai gáy, thoát vị.</p>
            </div>
            <div class="tinhdo">
                <h3 class="red">SƠN CẤN HƯỚNG KHÔN – DẦN – THÂN - (TOẠ CẤN HƯỚNG KHÔN) TÂY</h3>
                <div class="row row-collapse">
                    <div class="col large-9">
                        <div class="text-center">
                            <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/tay_2.png" />
                        </div>
                    </div>
                    <div class="col large-3">
                        <div class="text-center">
                            <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/tay_2_1.png" />
                        </div>
                    </div>
                </div>
                <ul>
                    <li>A- Nhà tọa Cấn hướng Khôn</li>
                    <li>B- Sơn Dần hướng Thân </li>
                </ul>
                <p>Nhà tọa sơn Cấn hướng Khôn và sơn Dần hướng Thân tại vận 8 hạ nguyên bị phạm Thượng sơn hạ thủy. Hướng có sao Nhị hắc tọa đóng, vận 8 cung khôn sao Ngũ hoàng tọa đóng, nếu có nước, sông, ao, hồ thì chủ về hung hại ám chỉ những việc hao tài tốn của, và dễ mắc các bệnh như đường hô hấp, hệ thần kinh. Còn sơn tọa có núi, nhà cao tầng, dễ bị không có con cháu nối dõi.</p>
                <p>Có sao Nhất bạch, Tứ lục, Thất xích, Nhị hắc; Ngũ hoàng, Bát bạch; Tam bích, Lục bạch, Cửu tử thành thế Tam bàn phụ mẫu, Cửu cung hướng lên phạm vào thế phục ngâm, vì vậy nếu xây nhà trên thế đất phẳng thì thuộc hung, để giảm sự hung hại này gia chủ có thể các cung Tốn, Ly, Khôn nên có núi, nhà cao tầng, thế đất cao, còn các cung Càn, Khảm, Cấn thì nên có nước như hồ ao, hòn non mộ, bể cá, bể bơi. Thì sẽ giảm được hung tinh khá nhiều. </p>
                <p>Trong thế này thì cung Cấn, Khảm, Ly mở cửa là cát, các cung Càn, Đoài, Chấn. Cung Tốn không nên mở cửa vì thuộc suy khí không tốt cho nhân đinh và tài lộc. Những năm có địa chi là Dần, Mùi, Thân, Thìn, Tỵ nên thêm nhân đinh để nhận cát lành, còn những năm khác thì không nên thêm nhân đinh sẽ dễ gặp hung hại.</p>
                <p>Cung Chấn: toạ có sao Cửu tử đóng, nếu có núi, nhà cao tầng ở xa, thì trong nhà dễ sinh người thông minh nhanh nhẹn. còn có nước, ao hồ, sông thì trưởng nam và trung nữ trông gia đình dễ gặp chuyện bất lợi. </p>
                <p>Cung Khảm: Hướng có sao Nhất bạch tạo đóng. Nếu có nước, sông hồ, ao đầm trong xanh thì gia đình gặp điều cát lành. Còn có núi, nhà cao tầng, cầu vượt thì dễ  gặp hung hại kéo tới.</p>
                <p>Cung Càn, Đoài: có sao Lục bạch, Tam bích, Thất xích, Tứ lục toạ chiếu thuộc sao hung (tử). Hai phương này nên bằng phẳng sẽ không gặp hung hại, còn khi có núi, nhà cao tầng, hồ, ao, sông suối, thì người trong nhà dễ mắc các bệnh ở chân, kheo, ảnh hưởng tới nhân đinh trong nhà, nhất là trưởng nữ.</p>
                <p>Cung Tốn: có sao Nhất bạch, Tứ lục toạ đóng. Nếu có núi, nhà cao tầng đẹp tráng lệ trong gia đình sẽ có người giỏi văn chương trí dũng.</p>
                <p>Cung Ly: có sao ngũ hoàng và nhị hắc toạ đóng, nếu có dòng nước nhỏ thì không sao. Còn có núi, nhà cao tầng thì những người già trong nhà nên chú ý về sức khoẻ, chú ý các bệnh về tim, và vùng đầu.</p>
                <p>Hóa giải thế thượng sơn hạ thuỷ của sơn Khôn Cấn hướng</p>
                <p>Nếu mở cửa ờ hướng Cấn sẽ gặp hung hoạ nhưng nếu nếu bắt buộc mở phải dùng bình phong để hoá giải. 
                    Còn các Hướng Khôn, Ly, Đoài, nên làm cửa nhỏ và thấp để tránh hung tinh. Còn Hướng Cấn, Chấn, Khảm thì lên làm cửa to để đón khí cát. Cửa nên mở ở toạ độ Mão. Cung này có sao Cửu Tử tốt cho lộc tài, ngoài ra Tạihướng Khôn, xây bức tường dài và cao tượng trưng cho SƠN. Do hướng tinh đáo Khôn, nên mở cửa sổ để nạp tài khí. Khu hướng Cấn, nên có đường, hành lang để tạo cát khí, cho cửa Mão, Trước cửa nhà (phía tay trái), nên làm một hòn giả sơn, có nước chảy và giữ trong sạch để hoá hung thành cát.</p>
                <ul>
                    <li>C- Nhà tọa Sửu hướng Mùi </li>
                </ul>
                <p>trong vận 8 thuộc Vượng sơn vượng hướng (cát). Để phát huy được sự cát lành cho nhân đinh và tài lộc thì hướng phải có nước, ao hồ, sông suối trong sạch, hoặc trước mặt đất thấp. Nếu tọa có núi, nhà cao tầng thì là cát, tốt cho nhân đinh và tài lộc. Nếu có nước, ao hồ, sông suối thì là hung hại, còn hướng có núi, nhà cao tầng cũng là hung hại tiền tài đều dễ suy bại, để có cát lành gia chủ nên mở cửa tại cung khôn, Khảm, Ly. Không nên mở cửa tại cung Càn, Đoài dễ người nhà mắc các bệnh liên quan tới gan. Để thêm phần cát lợi cho ngôi nhà thì những năm Mùi, Thân, Sửu, Dần, Tý, Ngọ nên thêm nhân đinh. Còn những năm khác thì không được cát. </p>
                <p>Tại Cung Ly: có sao Nhất bạch, Thất xích. Nếu có nước như ao đầm, sông suối, trong xanh dòng nước không rữ, và xung chiếu, đất trũng, chủ về cát lành cho tài và nhân đinh. còn có núi, nhà cao tầng gia đình dễ gặp hung hại, trong nhà dễ có người tửu sắc bất tài.</p>
                <p>Tại Cung Tốn, Chấn: có sao ngũ hoàng và thất xích toạ đóng, phương này nên bằng phẳng thì không có vấn đề gì nhiều, nhưng nếu có núi, nhà cao tầng, nước, ao, hồ, sông suối gia đình dễ gặp tai ương. Cung tốn có nước nam chú ý dễ gặp chuyện cần tu tâm gieo duyên để qua hạn. Riêng cung Chấn núi, nhà cao tầng, nước, ao, hồ, sông suối, chú ý kiện tụng, lao lý, rượu chè trai gái.</p>
                <p>Tại Cung Càn: toạ có sao Nhất bạch đóng, hướng có sao Tứ lục toạ đóng. Nên có núi, nhà cao tầng, thì trong nhà dế sinh ra người văn, trí, dũng công danh rộng mở. Nhưng nếu có nước mà còn mạnh thì trong nhà dễ sinh người dâm tà bê tha, vì sắc mà mất danh. </p>
                <p>Tại Cung Khảm: toạ có sao Lục bạch, hướng có sao cửu tử hoả kim tương khắc thuộc hung hại, để hoá hung tinh này gia chủ có thể sử dụng ngũ hành thổ để hoá hung thành cát. Nếu không hoá giải lâu ngày dễ sinh nghịch tử, chú ý các bệnh liên quan tới đường huyết. Nếu có bể cá ở trước mặt dễ đón cát khí.</p>
                <p>Tại Cung Đoài: toạ sao Cửu tử đóng, hướng có sao Tam bích toạ đóng, hai sao thuộc hệ sinh khí len là cát tinh. Nếu có núi, nhà cao tầng đẹp, sạch, gia đình sẽ sinh được người có tài có trí, thông minh nhanh nhẹn. Còn nếu có nước, ao, hồ, sông mạnh, rữ, bẩn trong nhà dễ có người dâm tà vì sắc mà dễ suy bại.</p>
            </div>
            <div class="tinhdo">
                <h3 class="red">SƠN MÃO HƯỚNG DẬU - (TOẠ CHẤN HƯỚNG ĐOÀI) TÂY</h3>
                <div class="row row-collapse">
                    <div class="col large-9">
                        <div class="text-center">
                            <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/tay_3.png" />
                        </div>
                    </div>
                    <div class="col large-3">
                        <div class="text-center">
                            <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/tay_3_1.png" />
                        </div>
                    </div>
                </div>
                <ul>
                    <li>A- Nhà tọa ở Mão sơn Dậu hướng</li>
                    <li>B- Ất sơn Tân hướng</li>
                </ul>
                <p>trong vận 8 thuộc thế Song tinh hội hướng. Nếu có núi, nhà cao tầng, ao hồ trong sạch thì tốt cho nhân đinh và tài lộc. Còn núi và nước có sát khí và bẩn là hung, trong nhà dễ sinh người bất lương. Để ngôi nhà có thêm trường khí cát lanh thì Cửa chính nên mở tại cung Đoài, còn cùng lắm có thể Mở ở cung Ly, Càn, tuy xấu lại là tốt. Không nên mở tại cung Chấn, Tốn, Khôn, Khảm thiếu sự cát lành, không tốt cho người già, phụ sản, cháu đích tôn. Nếu có thêm người thì hãy thêm những Năm Dậu, Mậu, Kỷ sẽ tốt.</p>
                <p>Cung Khảm, Tốn: có sao Nhị hắc, Ngũ hoàng toạ đóng, hai sao này thuộc hung tinh. Để tránh hung hại nên có mặt bằng, bằng phẳng, nếu có núi, nhà cao tầng và nước, ao hồ, sông, thì dễ bị cô quả và mắc những bệnh liên quan tới ung thư.</p>
                <p>Tại Cung Càn: có sao cửu tử bay tạo chiếu. Để nhận điều cát lành thì nên có dòng nước tròn như ao hồ, sạch sẽ, tốt cho nhân đinh và tài lộc, không nên có núi hoặc nhà cao tầng sẽ hung, nếu có thì hãy làm bình phong hoá giải. Trung cung: của thế này bị phạm nặng vậy cho nên muốn tốt thì cung càn cần bố trí nước để giải ách.</p>
                <p>Cung Cấn: có sao cửu tử tạo đóng. Nếu muốn có sự cái lành thì nên có núi, nhà cao tầng, không lên có nước như ao hồ sông lớn, sẽ gặp nhiều hung hại cho gia đình, </p>
                <p>Cung Ly: có sao Nhất bạch, Lục bạch toạ đóng, nếu xa xa có thấy núi, nhà cao tầng đẹp, không uế tạc trong nhà dễ sinh người học rộng tài cao. Nếu có người sinh vào năm Giáp Tý, Quý Mão sẽ thành danh.</p>
                <ul>
                    <li>C- Nhà tọa Giáp hướng Canh</li>
                </ul>
                <p>trong vận 8 thuộc thế Song tinh hội tọa. Để nhận nhân đinh và tài lộc vượng thì nên có núi, nhà cao tầng, và có ao hồ sông to và trong sạch. Hướng có sao Tam bích, Tứ lục, Lục bạch lục sơn vận. Thì Phương này nên bằng phẳng. Không nên có núi, nhà cao tầng, nước ao hồ sống suối, sẽ không tốt cho tài sản dễ đi xuống, dễ trong nhà có người làm chuyện bất lương. Để nhân đinh và tài lộc vượng thì nên mở Cửa tại cung Chấn, Khảm, để tránh hung hại thì không nên mở cửa cung Tốn, Đoài, Càn, Ly, dễ tài lộc suy. Để thêm cát lành thì những năm Mão, Tý nên thêm người, và lưu ý những năm Ngọ, Dậu, Tuất, Hợi không nên thêm người sẽ dễ nhận hung hại.</p>
                <p>Cung Càn, Cấn, Ly: có sao ngũ hoàng, tứ lục, nhị hắc. Để giảm hung hại thì nên bằng phẳng, tuyệt đối không nên có núi, nhà cao tầng, nước như ao hồ, sông suối. Nếu có thì trong gia đình dễ tổn thất về nhân đinh và tiền tài lộc. </p>
                <p>Cung Tốn: có sao Cửu tử, Thất xích. Chú ý dễ gặp thị phi của thất xích, để giải hung này thì hướng tinh Cửu tử nên có nước ở xa, nước nhỏ thì là cát giúp hoá giải thất xích. </p>
                <p>Cung Khảm: Có sao Nhất bạch, Lục bạch, toạ đóng. Cung này có núi, nhà cao tầng xa xa đẹp, sau này trong nhà sẽ có người làm quan, công việc của nhà nước được thuận lợi. Có lộc có tài nhưng để duy trì được thì không lên tham quan.</p>
                <p>Cung Khôn: có sao cửu tử và thất xích tạo đóng. sơn nên có núi, nhà cao tầng ở xa, không nên có nước, sông ao hồ, thì sẽ tốt về tiền tài và có thêm đất cát.</p>
            </div>
            <div class="tinhdo">
                <h3 class="red">SƠN THÌN HƯỚNG TUẤT – TỐN CÀN – TỴ HỢI. (TOẠ TỐN HƯỚNG CÀN) TÂY</h3>
                <div class="row row-collapse">
                    <div class="col large-9">
                        <div class="text-center">
                            <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/tay_4.png" />
                        </div>
                    </div>
                    <div class="col large-3">
                        <div class="text-center">
                            <img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/tay_4_1.png" />
                        </div>
                    </div>
                </div>
                <ul>
                    <li>A- Nhà tọa Thìn hướng Tuất</li>
                </ul>
                <p>trong vận 8 bị phạm Thượng sơn hạ thủy, dùng tọa không triều mãn để hoá giải là tốt nhất. hướng nên có núi, nhà cao tầng vừa vừa không được cao to hùng vĩ, đẹp và sạch sẽ, sau núi, nhà cao tầng có nước sẽ hoá hung thành cát, tốt cho nhân đinh và tài lộc. Còn Phương tọa cần có dòng nước bao quanh, như ao, đầm, sông trũng. Để nhận khí cát lành thì Cửa tai cung Càn, Tốn. Không nên Mở ở cung Khảm, Khôn, Cấn, Chấn, Ly sẽ gặp hung tinh nữ dễ gặp tai ách, gia đình kém dần. Để thêm điều cát lành thì những Năm Tuất, Hợi, Thìn, Tỵ nên thêm người. Còn nhưng năm còn lại thì không nên thêm người.</p>
                <p>Cung Ly: Có sao Nhị hắc, Tứ lục toạ đóng. Để không gặp hung hoạ thì Phương này nên bằng phẳng. Còn Nếu có núi, nhà cao tầng và nước, ao hồ sông suối dễ hao tài tốn của và mắc các bệnh liên quan tới tỳ, vị, tim, não. Còn Nếu có dòng nước chảy tới dễ có sinh người con bất hiếu.</p>
                <p>Cung Khảm: có sao Ngũ hoàng, Tam bích toạ đóng. Để không gặp hung hoạ thì Phương này nên bằng phẳng. Còn Nếu có núi, nhà cao tầng và nước, ao hồ sông suối, dễ hao tài mất tài và lưu ý dễ mắc các bệnh liên quan tới gan mật, tam kheo, phự nữ mang thai cần chú ý. </p>
                <p>Cung Chấn, Khôn: ngũ hoàng, thất xích, tứ lục, Để không gặp hung hoạ thì Phương này nên bằng phẳng. Còn Nếu có núi, nhà cao tầng và nước, ao hồ sông suối,
                    Dễ gặp chuyện thi phi, hao tài tốn của. thiệt hại tới nhân đinh và tài lộc</p>
                <p>Trung cung: có sao cửu tử nhập tù, cần được hoá giải không là tự năm 2024 gia đình dễ bị suy bại tài và nhân đinh. Để hoá giải thì tại cung Càn, Tốn nên có thuỷ, dòng nước chẩy sạch trong để giải cứu cho cửu tử. Tối kỵ khi có núi, nhà cao tầng sẽ bất lợi cho nhân đinh, tài lộc. </p>
                <ul>
                    <li>B- Nhà tọa Tốn hướng Càn </li>
                    <li>C- Toạ Tỵ hướng Hợi</li>
                </ul>
                <p>trong vận 8 thuộc Vượng sơn vượng hướng, hướng nên có dòng nước, sông ao hồ nước trong xanh, sạch sẽ, có minh đường, gò đất. Còn Tọa sơn có núi, nhà cao tầng cao đẹp không uế tạc, sẽ phát huy được ưu điểm của sơn hướng vượng nhân đinh và tài lộc. Nhưng cũng xin lưu ý cung Càn phạm phục ngâm. (không được có núi khác cao hơn đè) nếu không thì trụ cột ảnh hưởng tới sức khỏe, trí tuệ giảm sút. Đề tốt cho nhân đinh và tài lộc vượng thì Cửa nhà nên mở tại cung Càn, Tốn. Còn những cung Đoài, Khảm, Khôn, Ly, Chấn, Cấn, thuộc hung tinh không nên mở sẽ dễ giảm tài, và không tốt cho nữ giới. Để thêm phần cát lành thì nên thêm người vào những năm Tuất, Hợi, Thìn, Tỵ. Những năm khác thì không nên thêm người.</p>
                <p>Cung Khảm: có sao Tứ lục, Nhị hắc toạ đóng. Để tránh hung hại thì phương này nên bằng phẳng, tầm nhìn rộng, nếu có núi, nhà cao tầng, thủy như ao hồ sông suối còn bị sát thì gia đình dễ bại về nhân đinh và tiền của</p>
                <p>Cung Ly: có sao Tam bích, Ngũ hoàng toạ đóng, để giải hung thành cát thì nên có dòng nước như ao hồ sông nhưng phải sạch và trong lành, còn nếu có núi, nhà cao tầng thì trong nhà dễ sinh người làm việc bất lương, và dễ mắc các bệnh liên quan tới gan, mật, tim, và hệ thần kinh trung ương.</p>
                <p>Cung Chấn: có sao Nhị hắc và Cửu tử toạ đóng. Để tốt cho nhân đinh thì nên núi, nhà cao tầng, cao đẹp, không uê tạc. Nên tránh có nước, như sông suối, ao hồ vì sẽ phát huy những cái xấu như  tâm trí kem, xong lại thoái tài.</p>
                <p>Cung Đoài: có sao Ngũ hoàng, Thất xích toạ đóng, thuôc hung tinh, để hoá giải hung hai này thì nên mặt bằng bằng phẳng, nhìn được xa, con khi có sơn hoặc thuỷ thì sẽ phát huy được những cái xâu cái hung, xấu cho nhân đinh và tài vận. </p>
                <p>Cung Khôn: có sao Nhất bạch, Tam bích toạ đóng. Nếu muốn tốt cho nhân đinh và tài lộc vượng thì lên có núi, nhà cao tầng cao đẹp không uế tạc, có nước nhỏ thì hung hại không nhiều, nhưng Nếu có dòng nước có sát khí, con cháu trai dễ đi tha phương không về, người nhà thì chú ý tới những bệnh như gan, mật, thận, tử cung.</p>
            </div>
        <?php endif; ?>
        <?php
        return ob_get_clean();
    }

    public function thuongSonHaThuy() {
        ob_start();
        ?>
        <h3 class="luan-giai-title">8. THƯỢNG SƠN HẠ THỦY</h3>
        <div class="row row-collapse">
            <div class="col large-6">
                <div class="text-center">
                    <p><img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/tsht_1.jpg" /></p>
                </div>
            </div>
            <div class="col large-6">
                <div class="text-center">
                    <p><img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/tsht_2.jpg" /></p>
                </div>
            </div>
        </div>
        <div class="row row-collapse">
            <div><img style="max-width:250px;float:left" src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/tsht_3.png" /><p>Vd: quý vị xây dựng 1 căn nhà trong vận 8<br>
                    Số 8 của sơn bàn bay tới hướng, số 8 của hướng bàn bay tới sơn, tạo nên thế sơn thủy đáo nghịch. Gọi là thượng sơn hạ thủy. Sao quản sơn thì xuống biển, sao quản biển thì lên sơn.
                    Nếu số 8 đương lệnh của Sơn bàn không bay tới sơn mà bay tới hướng, còn vượng tinh của Hướng bàn không bay tới hướng mà bay tới sơn gọi là Thượng sơn hạ thủy. cách cục hung nhất trong phong thủy Huyền không, chủ hại đinh phá tài. (sơn quản nhân đinh, thủy quản tài lộc)<br>
                    Địa hình thích hợp để giải khi lập tinh bàn xây dựng bị phạm. với Thượng sơn hạ thủy là khu vực bằng phẳng, rộng rãi, phía sau có địa thế tương đối thấp, có khe suối dòng sông bao quanh, hoặc có ao hồ. Lưy ý khi xây dựng nên hướng để cửa hẹp có bình phong. Sơn thì nên để cửa rộng đón khí lành.<br>
                    Phía trước có địa hình tương đối cao, có rặng núi, gò đồi đẹp. Đối với khu vực thành thị, phía sau phải có bãi đất trống, hoặc đường đi phía trước tốt nhất là có nhà cao tầng.
                    Bãi đất tương đương với ao hồ, nhà cao tầng tương đương với đồi núi. Chỉ như vậy mới có thể tránh hung tìm cát. Nếu như vậy là có thể giải được 1 phần nào của thượng sơn hạ thủy</p>
            </div>
        </div>
        <div>
            <p>Cách tính: Thiên nguyên long. Địa nguyên long. Nhân nguyên long</p>
        </div>
        <div class="row row-collapse">
            <div class="col large-5">
                <div class="text-center">
                    <p><img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/tsht_4.png" /></p>
                </div>
            </div>
            <div class="col large-7">
                <div style="line-height: 2.0;">
                    <p>
                        <b>T viết tắt THIÊN NGUYÊN LONG: bao gồm 8 sơn:</b><br>
                        4 sơn dương: <span class="ml-10">(T) CÀN+</span><span class="ml-10">(T) KHÔN+</span><span class="ml-10">(T) CẤN+</span><span class="ml-10">(T) TỐN+</span><br>
                        4 sơn âm: <span class="ml-10">(T) TÝ-</span><span class="ml-10">(T) NGỌ-</span><span class="ml-10">(T) MÃO-</span><span class="ml-10">(T) DẬU–</span><br>
                        <b>Đ viết tắt  ĐỊA NGUYÊN LONG: bao gồm 8 sơn:</b><br>
                        4 sơn dương: <span class="ml-10">(Đ) GIÁP+</span><span class="ml-10">(Đ) CANH+</span><span class="ml-10">(Đ) NHÂM+</span><span class="ml-10">(Đ) BÍNH+</span><br>
                        4 sơn âm: <span class="ml-10">(Đ) THÌN-</span><span class="ml-10">(Đ) TUẤT-</span><span class="ml-10">(Đ) SỬU-</span><span class="ml-10">(Đ) MÙI-</span><br>
                        <b>N viết tắt NHÂN NGUYÊN LONG: bao gồm 8 sơn:</b><br>
                        4 sơn dương: <span class="ml-10">(N) DẦN+</span><span class="ml-10">(N) THÂN+</span><span class="ml-10">(N) TỴ+</span><span class="ml-10">(N) HỢI+.</span><br>
                        4 sơn âm: <span class="ml-10">(N) ẤT-</span><span class="ml-10">(N) TÂN-</span><span class="ml-10">(N) ĐINH-</span><span class="ml-10">(N) QUÝ-</span>
                    </p>
                </div>
            </div>
        </div>
        <p>Các sơn hướng thượng sơn hạ thủy vận 8 như : xấu nhưng chưa chắc xấu</p>
        <p>Khôn sơn Cấn hướng, Thân sơn Dần hướng<br>
            Cấn sơn Khôn hướng và Dần sơn Thân hướng<br>
            Tuất sơn Thìn hướng và Thìn sơn Tuất hướng
        </p>
        <p>Vd: BẢN TINH ĐỒ SƠN HƯỚNG - VẬN 8 Càn – Tốn</p>
        <div class="row">
            <div class="col large-5">
                <div class="text-center">
                    <p><img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/tsht_5.png" /></p>
                </div>
            </div>
            <div class="col large-7">
                <div>
                    <p>Sơn Càn thì lấy: đưa số 9 sơn (vận 8) vào trung cung – sau đó xem số 9 trong cửu tinh đồ cơ bản thuộc cung Ly, cung Ly có 3 sơn Bính, Ngọ, Đinh, cung Càn trùng với cung Ngọ = âm., đưa số 9 vào trung cung và phi tinh nghịch sau đó ghép vào bên trái của bản tinh đồ cửu vận. 
                        Hướng Tốn thì lấy: đưa số 7 của hướng (vận 8) vào trung cung – sau đó xem số 7 trong cửu tinh đồ cơ bản thuộc cung Đoài, cung Đoài có 3 sơn Canh, Dậu, Tân, cung Tốn trùng với cung Dậu = âm, đưa số 7 vào trung cung và phi tinh nghịch sau đó ghép vào bên trái của bản tinh đồ cửu vận.</p>
                </div>
            </div>
            <div class="col large-12">
                <ul class="red" style="list-style: decimal;">
                    <li>lập tinh bàn theo vận</li>
                    <li>Xác định sao sơn và hướng</li>
                    <li>Xác định sơn đó thuộc nguyên gi? Âm hay dương</li>
                    <li>So số của sơn với bản tinh đồ cơ bản để biết số sao sơn thuộc cung gi? Sau đó xét nguyên của sơn là âm hay dương</li>
                    <li>Dương thì phi tịnh thuận và âm thì phi tinh nghịch (như vd trên)</li>
                </ul>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public function thaiTueTuePha() {
        ob_start();
        ?>
        <h3 class="luan-giai-title">9. TRÁNH THÁI TUẾ, THÁI TUẾ PHI TINH, TUẾ PHÁ, TUẾ PHÁ PHI TINH</h3>
        <p>- Thái tuế theo năm – năm nào con giáp nàu thì thái tuế cung đó, tuế phá cung đối diện : vd năm 2020 canh tý = cung tý khảm là cung thái tuế. Tuế phá là ngọ</p>
        <p>- Thái tuế phi tinh, cách tính dựa vào cung của thái tuế sau đó xét trên bản tinh đồ cơ bản, số đó nằm ở cung nào thì cung đó là thái tuế phi tinh vd: 2020</p>
        <div class="row">
            <div class="col large-5">
                <div class="text-center">
                    <p><img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/tranh-thai-tue-1.jpg" /></p>
                </div>
            </div>
            <div class="col large-7">
                <div>
                    <p>Sơn Càn thì lấy: đưa số 9 sơn (vận 8) vào trung cung – sau đó xem số 9 trong cửu tinh đồ cơ bản thuộc cung Ly, cung Ly có 3 sơn Bính, Ngọ, Đinh, cung Càn trùng với cung Ngọ = âm., đưa số 9 vào trung cung và phi tinh nghịch sau đó ghép vào bên trái của bản tinh đồ cửu vận. 
                        Hướng Tốn thì lấy: đưa số 7 của hướng (vận 8) vào trung cung – sau đó xem số 7 trong cửu tinh đồ cơ bản thuộc cung Đoài, cung Đoài có 3 sơn Canh, Dậu, Tân, cung Tốn trùng với cung Dậu = âm, đưa số 7 vào trung cung và phi tinh nghịch sau đó ghép vào bên trái của bản tinh đồ cửu vận.</p>
                    <ul style="list-style:decimal;">
                        <li>Năm 2020 canh tý, thì cung tý khảm thuộc thái tuế. Muốn tính thái tuế phi tinh thì xét cung đó thuộc số mấy trong bản tinh đồ. Năm 2020 khảm tý thuộc số 1</li>
                        <li>Năm 2020 sao số 7 quản vậy đưa số 7 vào trung cung phi tinh thuận số 1 xuất hiện ở cung nào thì thái tuế phi tinh tọa cung đó. Theo bản tinh đồ thì thái tuế phi tinh tọa tại cung cấn. Tuế phá cung khôn</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col large-6">
                <table class="table table-calendar table-fixed">
                    <tr>
                        <td>6</td>
                        <td>2</td>
                        <td>4</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>7</td>
                        <td>9</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>3</td>
                        <td>8</td>
                    </tr>
                    <tr>
                        <td colspan="3"><span class="red">BẢNG PHI TINH THÁI TUẾ</span><td>
                    </tr>
                </table>
            </div>
            <div class="col large-6">
                <table class="table table-calendar table-fixed">
                    <tr>
                        <td>4</td>
                        <td>9</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>5</td>
                        <td>7</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>1</td>
                        <td>6</td>
                    </tr>
                    <tr>
                        <td colspan="3"><span class="red">BẢNG TINH ĐỒ CƠ BẢN</span><td>
                    </tr>
                </table>
            </div>
        </div>
        <p>THÁI TUẾ - TUẾ PHÁ</p>
        <p>- Thái tuế trong mệnh lý tính can chi thì sẽ là con giáp của mình( năm tuổi, tháng, ngày, giờ tuổi. Vd bạn tuổi mùi thì nhưng năm mùi tháng mùi,ngày, giờ mui gọi là thái tuế, ( xấu). Cong trong bát trạch xây dựng thái tuế được tính theo năm, dựa theo phi tinh để tìm ra thái tuế tọa cung nào, trong bát trạch khi xây dựng có thái tuế, tuế phá, và thái tuế, tuế phá phi tinh. Thái tuế trong xây dựng tính theo năm. Vd năm nay 2020 canh tý, thái tuế sẽ là cung khảm tý hướng bắc và tuế phá là phương đối diện là nam, năm 2020 thái tuế tại cung khảm nên làm nhà tránh cung khảm – ly</p>
        <p>- Thái tuế phi tinh: theo niên vận tính như sau – vd năm nay 2020 canh tý, tý thuộc cung khảm theo bản tinh đồ cơ bản thuộc số 1</p>
        <p>- Năm 2020 thuộc hạ nguyên vận 8 – sao số 9 vào trung cung và phi tinh thuận ta có hướng càn (1) thuộc thái tuế phi tinh</p>
        <p>- cách tính 1- xác định năm 2020 cung khảm theo bản tinh đồ cơ bản thuộc số 1. Bước 2 xác định năm 2020 số mấy đứng. = 2020 (số 9) đưa số 9 vào phi tinh ta có số 1 tại cung càn.</p>
        <p>Thái Tuế mang lại khi xây nhà phạm phải , gia chủ dễ gặp phải nhiều điều bất thuận, công việc khó khăn, sức khỏe suy kém, tình cảm lận đận, tiền bạc tổn hao, làm ăn khó khăn, dễ gặp chuyện buồn về tình cảm, mắc bệnh tật vậy nên khi xây dựng gia chủ nên tránh thái tuế </p>
        <p>Cách hóa giải </p>
        <p>Mỗi năm Thái Tuế lại thay đổi phương vị, có thể dựa vào từng năm mà biết được khi nào thì nhà mình nằm ở phương vị của Thái Tuế. Cụ thể như sau:</p>
        <br>
        <p>Nhà ở hướng Bắc: năm Tý phạm Thái Tuế.<br>
            Nhà ở hướng Đông Bắc: năm Sửu, Dần phạm Thái Tuế.<br>
            Nhà ở hướng Đông: năm Mão phạm Thái Tuế.<br>
            Nhà ở hướng Đông Nam: năm Thìn, Tị phạm Thái Tuế.</p>
        <br>
        <p>Nhà ở hướng Nam: năm Ngọ phạm Thái Tuế.<br>
            Nhà ở hướng Tây Nam: năm Mùi, Thân phạm Thái Tuế.<br>
            Nhà ở hướng Tây: năm Dậu phạm Thái Tuế.<br>
            Nhà ở hướng Tây Bắc: năm Tuất, Hợi phạm Thái Tuế.</p>
        <br>
        <p>Khi hướng nhà phạm Thái Tuế, gia chủ không nên quá lo lắng khi phát hiện trong năm nhà mình phạm Thái Tuế sát, bởi có thể hóa giải phần lớn tác động tiêu cực của Thái Tuế chỉ bằng việc lắp gương bát quái trước cửa chính. + Thái Tuế chính là sao Mộc (Mộc tinh)  nên chúng ta những vật phẩm bằng tự nhiên của ngũ hành hỏa sẽ giảm được sự hung hại của thái tuế</p>
        <?php
        return ob_get_clean();
    }

    public function thuTuSatChu() {
        ob_start();
        ?>
        <h3 class="luan-giai-title">10. NGÀY THỤ TỬ SÁT CHỦ</h3>
        <p>Các ngày xấy quý vị cần tránh khi làm động thổ hay làm việc lớn:<br>
            Tháng 1 – Tuất – Tỵ, Tháng 2 – Thìn Tý, Tháng 3 – Hợi Mùi, Tháng 4 – Tỵ Mão, Tháng 5 – Tý Nhâm, Tháng 6 – Ngọ Tuất,
            Tháng 7 – Sửu, Tháng 8 – Mùi Hợi, Tháng 9 – Dần Ngọ, Tháng 10 – Thân Dậu, Tháng 11 – Mão Dần, Tháng 12 – Dậu Thìn</p>
        <?php
        return ob_get_clean();
    }

    public function batSat($tuTru, $duNienArr) {
        ob_start();
        ?>
        <h3 class="luan-giai-title">11. BÁT SÁT (họa hại)</h3>
        <p>Khảm Long, Khôn Thỏ, Chấn sơn Hầu<br>
            Tốn Kê, Kiền Mã, Đoài  Xà đẩu<br>
            Cấn Hổ, Ly Trư, Vi sát diệu<br>
            Phạm chi mộ, trạch nhất tề hư
        </p>
        <p>- Của công trình chúng ta cần lưu ý như sau:<br>
            Cung quái là tọa chi là hướng. Tránh mở cửa, thủy tới thủy đi<br>
            Khảm sát thìn – khôn sát mão – chấn sát thân- tốn sát dậu – càn sát ngọ - đoài sát tỵ - cấn sát dần – ly sát hợi<br>
            Ý là nhà tọa cung khảm thì hướng thìn là bị sát, nên khi làm nhà cung khảm tránh mở cửa hướng thìn hay có đường nước vào hoạc ra tại thìn.
        </p>
        <p>(KHẢM) -tọa Bắc: Hướng Thìn là sát: Gây ra nhiều bệnh tật, vợ chồng bất hòa.<br>
            (LY) -tọa Nam: Hướng Hợi là sát: Gây cho anh em bất hòa, dễ gây sự với hàng xóm, bị người nhỏ nhen nói xấu, khó nuôi gia súc.<br>
            (CHẤN) -tọa Đông: Hướng Thân là sát: Hay mắc nghiện hút, dễ gặp tai họa, bị kìm kẹp ức chế.<br>
            (ĐOÀI) -tọa Tây: Hướng Tỵ là sát: Không được quý nhân phụ trợ, trên không kính dưới không nhường, con cái dễ mắc nghiện hút.<br>
            (KHÔN) -tọa Tây Nam: Hướng Mão là Sát: Dễ bị kẻ xấu quấy phá, trộm cướp mất tiền, tai nạn trọng thương.<br>
            (CẤN) -tọa Đông Bắc: Hướng Dần là sát: Gia đình bất hòa, Tài lộc eo hẹp<br>
            (TỐN) -tọa Đông Nam: Hướng Dậu là sát: Quan chức bị kìm kẹp khó ngóc đầu dậy, tổ tiên không phù trì, Thờ tổ tiên mà quỷ hưởng.<br>
            (CÀN) -tọa Tây Bắc: Hướng Ngọ là sát: Mất tình cảm, Bị đâm chém thương tích, mổ xẻ tang thương.
        </p>
        <h4 class="red">Khi bắt buộc phải phạm sát thì dùng Ma Phương cung phúc đức để trấn giải</h4>
        <?php
        $arrayBatSat = [
            'kham' => '(KHẢM) - tọa Bắc: Hướng Thìn là sát: nhà tọa cung Khảm thì hướng Thìn là bị sát, nên khi làm nhà cung Khảm tránh mở cửa hướng Thìn hay có đường nước vào hoắc ra tại Thìn. Gây ra nhiều bệnh tật, vợ chồng bất hòa. Nếu bắt buộc phải mở cửa hay đường nước thì dùng ma phương này trấn tại cung sát, sẽ hoá giải được một phần nào đó.',
            'ly' => '(LY) - tọa Nam: Hướng Hợi là sát: nhà tọa cung Ly thì hướng hợi là bị sát, nên khi làm nhà cung Ly tránh mở cửa hướng Hợi hay có đường nước vào hoắc ra tại Hợi. Gây cho anh em bất hòa, dễ gây sự với hàng xóm, bị người nhỏ nhen nói xấu, khó nuôi gia súc. Nếu bắt buộc phải mở cửa hay đường nước thì dùng ma phương này trấn tại cung sát, sẽ hoá giải được một phần nào đó.',
            'chan' => '(CHẤN) - tọa Đông: Hướng Thân là sát: nhà tọa cung Chấn thì hướng Thân là bị sát, nên khi làm nhà cung Chấn tránh mở cửa hướng Thân hay có đường nước vào hoắc ra tại Thân. Hay mắc nghiện hút, dễ gặp tai họa, bị kìm kẹp ức chế. Nếu bắt buộc phải mở cửa hay đường nước thì dùng ma phương này trấn tại cung sát, sẽ hoá giải được một phần nào đó.',
            'doai' => '(ĐOÀI) - tọa Tây: Hướng Tỵ là sát: nhà tọa cung Đoài thì hướng Tỵ là bị sát, nên khi làm nhà cung Đoài tránh mở cửa hướng Tỵ hay có đường nước vào hoắc ra tại Ty. Không được quý nhân phụ trợ, trên không kính dưới không nhường, con cái dễ mắc nghiện hút. Nếu bắt buộc phải mở cửa hay đường nước thì dùng ma phương này trấn tại cung sát, sẽ hoá giải được một phần nào đó.',
            'khon' => '(KHÔN) - tọa Tây Nam: Hướng Mão là Sát: nhà tọa cung Khôn thì hướng Mão là bị sát, nên khi làm nhà cung Khôn tránh mở cửa hướng Mão hay có đường nước vào hoắc ra tại Mão. Dễ bị kẻ xấu quấy phá, trộm cướp mất tiền, tai nạn trọng thương. Nếu bắt buộc phải mở cửa hay đường nước thì dùng ma phương này trấn tại cung sát, sẽ hoá giải được một phần nào đó.',
            'can2' => '(CẤN) -tọa Đông Bắc: Hướng Dần là sát: nhà tọa cung Cấn thì hướng Dần là bị sát, nên khi làm nhà cung Cấn tránh mở cửa hướng Dần hay có đường nước vào hoắc ra tại Dần. Gia đình bất hòa, Tài lộc eo hẹp. Nếu bắt buộc phải mở cửa hay đường nước thì dùng ma phương này trấn tại cung sát, sẽ hoá giải được một phần nào đó.',
            'ton' => '(TỐN) -tọa Đông Nam: Hướng Dậu là sát: nhà tọa cung Tốn thì hướng Dậu là bị sát, nên khi làm nhà cung Tốn tránh mở cửa hướng Dậu hay có đường nước vào hoắc ra tại Dậu. Quan chức bị kìm kẹp khó ngóc đầu dậy, tổ tiên không phù trì, Thờ tổ tiên mà quỷ hưởng. Nếu bắt buộc phải mở cửa hay đường nước thì dùng ma phương này trấn tại cung sát, sẽ hoá giải được một phần nào đó.',
            'can' => '(CÀN) - tọa Tây Bắc: Hướng Ngọ là sát: nhà tọa cung Càn thì hướng Ngọ là bị sát, nên khi làm nhà cung Càn tránh mở cửa hướng Ngọ hay có đường nước vào hoắc ra tại Ngọ. Mất tình cảm, Bị đâm chém thương tích, mổ xẻ tang thương. Nếu bắt buộc phải mở cửa hay đường nước thì dùng ma phương này trấn tại cung sát, sẽ hoá giải được một phần nào đó.'
        ];
        $toaHuong = $duNienArr[$tuTru->menhQuaiArr['menhquai']['name2']]['toa2'];
        ?>
        <div class="text-center">
            <p><img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/bat_sat_<?= $toaHuong ?>.png" /></p>
        </div>
        <p><?= $arrayBatSat[$toaHuong] ?></p>
        <?php ?>    
        <?php
        return ob_get_clean();
    }

    public function hoangTuyen($huong) {
        ob_start();
        ?>
        <h3 class="luan-giai-title">12. HOÀNG TUYỀN (ngũ quỷ)</h3>
        <p>Hoàng Tuyền là suối vàng, là nơi vô khí (tử khí): Nói một cách khác: Dương thế có đường đi của người dương thế. Dưới âm cũng có đường đi của người âm: (Hoàng là Vang, Tuyền là suối) Hoàng Tuyền xuất hiện ở Thiên Can</p>
        <p>Nhà phạm Hoàng Tuyền gây cho người mắc các bệnh ác tính như: ung thư, u cục ác tính, rối loại các tuyến nội tiết, rối loạn chức năng các tạng phủ, gây cho người có bệnh cảm giác như giả vờ, lúc có thuốc bệnh cũng không đỡ, không có thuốc bệnh lại khỏi.</p>
        <p>Gây cho người thích kiện tụng, thích đấu đá, tù đầy, chết chóc, nóng nảy, điên rồ, hoặc bị những họa không tự mình gây ra (họa vô đơn chí, không biết nguyên nhân) Hoặc mắc bệnh, Đông Tây y không phát hiện ra.</p>
        <p>Canh Đinh Khôn, thường thị Hoàng Tuyền<br>
            Ất Bính tu phòng, Tốn thủy tiêu<br>
            Giáp, Quý hướng trung ưu kiến Cấn<br>
            Tân Nhâm thủy lộ phụ dương Kiền<br>
        </p>
        <p>Mặt tiền hướng Canh – phương Khôn – nước tới là Cát – nước đi là Hung. (Hoàng Tuyền)<br>
            Mặt tiền hướng Đinh – phương Khôn – nước tới là Hung – nước đi là Cát. (Hoàng Tuyền) <br>
            Mặt tiền hướng Bính – phương Tốn – nước tới là Cát – nước đi là Hung. (Hoàng Tuyền) <br>
            Mặt tiền hướng Ất – phương Tốn – nước tới là Hung – nước đi là Cát. (Hoàng Tuyền) <br>
            Mặt tiền hướng Giáp – phương Cấn – nước tới là Cát – nước đi là Hung. (Hoàng Tuyền) <br>
            Mặt tiền hướng Quý – phương Cấn – nước tới là Hung – nước đi là Cát. (Hoàng Tuyền) <br>
            Mặt tiền hướng Nhâm – phương Càn – nước tới là Cát – nước đi là Hung. (Hoàng Tuyền) <br>
            Mặt tiền hướng Tân – phương Càn – nước tới là Hung – nước đi là Cát. (Hoàng Tuyền) <br>

            Nhà phạm Hoàng Tuyền gây cho người mắc các bệnh ác tính như: ung thư, u cục ác tính, rối loại các tuyến nội tiết, rối loạn chức năng các tạng phủ, gây cho người có bệnh cảm giác như giả vờ, lúc có thuốc bệnh cũng không đỡ, không có thuốc bệnh lại khỏi. <br>

            Gây cho người thích kiện tụng, thích đấu đá, tù đầy, chết chóc, nóng nảy, điên rồ, hoặc bị những họa không tự mình gây ra (họa vô đơn chí, không biết nguyên nhân) Hoặc mắc bệnh, Đông Tây y không phát hiện ra.<br>
        </p>
        <p class="red">Nếu bắt buộc phải phạm thì dùng ma phương cung sinh khí để trấn giải </p>
        <p class="red">Có thể tra theo bảng dưới để xem Hoàng Tuyền</p>
        <?php if (!empty($huong)) { ?>
            <?php if ($huong == 'canh' || $huong == 'khon') : ?>
                <div class="text-center">
                    <p><img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/hoang_tuyen_khon.png" /></p>
                </div>
            <?php elseif ($huong == 'binh' || $huong == 'at'): ?>
                <div class="text-center">
                    <p><img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/hoang_tuyen_ton.png" /></p>
                </div>
            <?php elseif ($huong == 'giap' || $huong == 'quy'): ?>
                <div class="text-center">
                    <p><img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/hoang_tuyen_can2.png" /></p>
                </div>
            <?php elseif ($huong == 'nham' || $huong == 'tan'): ?>
                <div class="text-center">
                    <p><img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/hoang_tuyen_can.png" /></p>
                </div>
            <?php endif; ?>
        <?php } else {
            ?>
            <div class="text-center">
                <p><img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/hoang_tuyen_can.png" /></p>
            </div>
            <div class="text-center">
                <p><img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/hoang_tuyen_can2.png" /></p>
            </div>
            <div class="text-center">
                <p><img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/hoang_tuyen_ton.png" /></p>
            </div>
            <div class="text-center">
                <p><img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/hoang_tuyen_khon.png" /></p>
            </div>
        <?php }
        ?>
        <?php
        return ob_get_clean();
    }

    public function hoangOc($namXem, $namSinh) {
        ob_start();
        ?>
        <h3 class="luan-giai-title">13. HOANG ỐC</h3>
        <p>Hoang có nghĩa là bỏ hoang, trống vắng. Ốc có nghĩa là nhà. Thế nên hạn này có nghĩa là ngôi nhà hoang, một vận hạn mà chúng ta cần tránh, kiêng kỵ khi xây nhà. Nếu làm nhà mà vạo hạn đúng cung xấu, sẽ dễ khiến cho công việc tiến hành hay gặp trắc trở, khó khăn. Cuộc sống sau này nghèo túng, làm ăn khó phát, sức khỏe, quan hệ gia đình ngày càng có nhiều vấn đề theo hướng tiêu cực.</p>
        <?php
        $tuoi = $namXem - $namSinh + 1;
        $arrayHoangOc = [
            1 => ['name' => 'Nhất cát', 'text' => 'Nhất Cát Làm nhà tuổi này sẽ có chốn an cư tốt, mọi việc hanh thông, thuận lợi (Nhất kiết an cư, thông vạn sự)'],
            2 => ['name' => 'Nhị Nghi', 'text' => 'Nhì Nghi: Làm nhà tuổi này sẽ có lợi, nhà cửa hưng vượng, giàu có (Nhì nghi tấn thất địa sinh tài).'],
            3 => ['name' => 'Tam địa sát', 'text' => 'Tam Địa Sát: Tuổi này làm nhà là phạm, gia chủ sẽ mắc bệnh tật (Tam sát nhơn do giai đắc mệnh).'],
            4 => ['name' => 'Tứ Tấn tài', 'text' => 'Tứ Tấn Tài: Làm nhà tuổi này thì phúc lộc sẽ tới (Tứ tấn tài chi phước lộc lai).'],
            5 => ['name' => 'Ngũ thọ tử', 'text' => 'Ngũ Thọ Tử: Tuổi này làm nhà là phạm, trong nhà chia rẽ, lâm vào cảnh tử biệt sinh ly (Ngũ tử ly thân phòng tử biệt).'],
            6 => ['name' => 'Lục hoang ốc', 'text' => 'Lục Hoang Ốc: Tuổi này làm nhà cũng bị phạm, khó mà thành đạt được (Lục ốc tạo gia bất khả thành).'],
            0 => ['name' => 'Lục hoang ốc', 'text' => 'Lục Hoang Ốc: Tuổi này làm nhà cũng bị phạm, khó mà thành đạt được (Lục ốc tạo gia bất khả thành).']
        ];
        $soHt = array_sum(str_split($tuoi)) % 6;
        if (isset($arrayHoangOc[$soHt])) {
            echo '<p class="bold">Sau khi xét tuổi của gia chủ (' . $tuoi . ' tuổi) với năm xem(' . $namXem . ') thì ta có:</p>';
            echo '<p class="red">' . $arrayHoangOc[$soHt]['text'] . '</p>';
            if (in_array($soHt, [3, 5, 6])) {
                echo '<p class="bold">Năm ' . $namXem . ' là năm xấu, nếu bắt buộc phải làm thì mượn tuổi, và khi nhập trạch họ phải về ở trước và sang tên chuyển nhượng</p>';
            }
        }
        ?>
        <br>
        <p>- Bạn có thể xem cách tính hoang ốc theo cách dưới đây:</p>
        <div class="text-center">
            <p><img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/hoang_oc.jpg" /></p>
        </div>
        <p>Cách tính <br>
            Hoang ốc có 6 cung bao gồm 3 cung tốt và 3 cung xấu, như sau: nhất cát – nhị nghi – tam địa sát – tứ tấn tài – ngũ thọ tử - lục hoang ốc<br>
            Lấy năm hiện tại trừ đi năm sinh + 1 tính hết hàng chục xong tới hàng đơn vị dừng ở đâu tính ở đó<br>
            Vd: năm nay 2020 tính cho nam sinh 1990 = 2020 – 1990 = 30 + 1 = 31 ta có tứ tấn tài, không phạm hoang ốc <br>
            Vd : năm nay 2020 tính cho nam sinh 1982 = 2020 – 1982 = 38 +1 = 39 ta có hoang ốc
        </p>
        <?php
        return ob_get_clean();
    }

    public function kimLau($namXem, $namSinh) {
        ob_start();
        ?>
        <h3 class="luan-giai-title">14. KIM LÂU</h3>
        <p>Kim Lâu là những năm không tốt, bất lợi cho việc khởi công xây nhà và cưới hỏi và những việc lớn. Bởi nếu thực hiện những công việc trọng đại này trong tuổi Kim lâu thì sẽ có những trắc trở khó khăn, trắc trở trái ý muốn sẽ xảy ra . và ngụy hại tới bản thân và những người thân xum quanh <br>
            Kim lâu gồm: 1 thân – 3 thê – 6 tử - 8 lục súc</p>
        <?php
        $kimLau = $namXem - $namSinh + 1;
        $kimLau = $kimLau % 9;

        $arrayKimLau = [
            1 => 'Tuổi Kim Lâu 1 ( Kim Lâu Thân): Làm nhà vào tuổi này thì bản thân người làm nhà sẽ bị hại ( ốm đau, bệnh tật, tai nạn…có thể chết người)',
            3 => 'Tuổi Kim Lâu 3 ( Kim Lâu Thê): Mang đến tai họa cho vợ về sức khỏe dễ ốm đau bệnh tật',
            6 => 'Tuổi Kim Lâu 6 ( Kim Lâu Tử): Mang hại cho con cái, sức khỏe học tập và làm ăn',
            8 => 'Tuổi Kim Lâu 8 ( Kim Lâu Lục Súc): Hại cho vật nuôi, làm ăn thất bát. Kinh tế đi xuống'
        ];
        if (in_array($kimLau, array_keys($arrayKimLau))) {
            echo '<p class="red">Năm ' . $namXem . ' bạn phạm kim lâu. (' . $arrayKimLau[$kimLau] . ')</p>';
        } else {
            echo '<p class="red">Năm ' . $namXem . ' bạn không phạm kim lâu</p>';
        }
        ?>
        <p>Cách tính Kim lâu đó như thế nào ? Đó là việc dựa vào nguyên lý Cửu Cung theo Cửu tinh đồ. Nếu bạn không có kiến thức về Phong Thủy thì có thể làm theo cách tính đơn giản như sau:</p>
        <div class="text-center">
            <p><img src="<?= get_stylesheet_directory_uri() ?>/images/nhacua/kimlau.png" /></p>
        </div>
        Cách tính:
        Lấy năm hiện tại trừ đi năm sinh + 1  chia cho 9 nếu số dư là 1368 thì bị phạm kim lâu <br>
        Vd: : năm nay 2020 tính cho nam sinh 1990 = 2020 – 1990 = 30 + 1 = 31 chia 9 =3 x 9 = 27 dư 4 không phạm kim lâu <br>
        Vd : năm nay 2020 tính cho nam sinh 1982 = 2020 – 1982 = 38 +1 = 39 chia 9 = 4 x 9 = 36 dư 3 phạm kim lâu thê <br>
        <br>
        Nếu bắt buộc phải làm thì mượn tuổi và khi nhập trạch họ phải về ở trước và sang tên chuyển nhượng<br> 
        <?php
        return ob_get_clean();
    }

    public function tamTai($tuTru, $namXem, $namXemInfo) {
        ob_start();
        ?>
        <h3 class="luan-giai-title">15. TAM TAI</h3>
        <p>Hạn tam tai chính là hạn của 3 năm liên tiếp. Tam có nghĩa ám chỉ 3 năm liền . Còn “Tai” nghĩa là tai họa, họa hại. Và trong một đời người như vậy cứ sau 12 năm thì lại gặp hạn tam tai một lần. Tức là cứ 12 năm thì có 3 năm liên tiếp gặp hạn tam tai. Điều này xảy ra được xem như là một quy luật. Của các địa chi
            Tam tai là 3 năm hạn liên tiếp gặp hạn. </p>
        <?php
        if (in_array($tuTru->chiNamSlug, ['than', 'ti', 'thin']) && in_array($namXemInfo['chi']['name'], ['thin', 'mao', 'dan'])) {
            echo '<p class="red">Năm ' . $namXem . ' bạn phạm tam tai</p>';
            echo '<p>Thân – Tý – Thìn (tam tai tại) Thìn Mão Dần: THUỶ TAI là tai họa do nước gây ra, như lũ lụt, sóng thần. Ngã nước, kinh doanh những mặt hàng liên quan tới nước cần chú ý dễ nhận thất bại. năm XẤU không nên xây nhà</p>';
        } elseif (in_array($tuTru->chiNamSlug, ['ty', 'dau', 'suu']) && in_array($namXemInfo['chi']['name'], ['suu', 'ti', 'hoi'])) {
            echo '<p class="red">Năm ' . $namXem . ' bạn phạm tam tai</p>';
            echo '<p>Tỵ - Dậu – Sửu (tam tai tại) Sửu Tý Hợi: KIM TAI chú ý: không nên kinh doanh kim khí, những đồ liên quan tới sắt thép, hoặc thể tĩnh, chú ý những vật làm từ kim loại, dễ gây sát thương. năm XẤU không nên xây nhà</p>';
        } elseif (in_array($tuTru->chiNamSlug, ['hoi', 'mao', 'mui']) && in_array($namXemInfo['chi']['name'], ['mui', 'ngo', 'ty'])) {
            echo '<p class="red">Năm ' . $namXem . ' bạn phạm tam tai</p>';
            echo '<p>Hợi – Mão – Mùi (tam tai tại ) Mùi Ngọ Tỵ: MỘC TAI. Chú ý về những cây trồng, không nên đầu tư tới gỗ, những cái mới bắt đầu thì không nên làm, vì làm sẽ dễ thất bại. năm XẤU không nên xây nhà</p>';
        } elseif (in_array($tuTru->chiNamSlug, ['dan', 'ngo', 'tuat']) && in_array($namXemInfo['chi']['name'], ['tuat', 'dau', 'than'])) {
            echo '<p class="red">Năm ' . $namXem . ' bạn phạm tam tai</p>';
            echo '<p>Dần – Ngọ - Tuất (tam tai tại) Tuất Dậu Thân: HOẢ TAI là tai họa do lửa cháy dễ cháy nhà, bỏng, tai nạn từ nhiệt gây ra. Dễ hấp tấp, nóng vội hỏng việc, không nên đầu tư quá lớn kinh doanh những ngành liên quan tới nhiệt, năm XẤU không nên xây nhà</p>';
        } else {
            echo '<p class="red">Năm ' . $namXem . ' bạn không phạm tam tai</p>';
            echo '<p>Nếu bắt buộc phải làm thì mượn tuổi và khi nhập trạch họ phải về ở trước và sang tên chuyển nhượng</p>';
        }
        ?>
        <?php
        return ob_get_clean();
    }

    /**
     * Check permissions for the posts.
     *
     * @param WP_REST_Request $request Current request.
     */
    public function get_items_permissions_check($request) {
        if (!current_user_can('read')) {
            return new \WP_Error('rest_forbidden', esc_html__('You cannot view the post resource.'), array('status' => $this->authorization_status_code()));
        }
        return true;
    }

    /**
     * Grabs the five most recent posts and outputs them as a rest response.
     *
     * @param WP_REST_Request $request Current request.
     */
    public function get_items($request) {
        $args = array(
            'post_per_page' => 5,
        );
        $posts = get_posts($args);
        $data = array();
        if (empty($posts)) {
            return rest_ensure_response($data);
        }
        foreach ($posts as $post) {
            $response = $this->prepare_item_for_response($post, $request);
            $data[] = $this->prepare_response_for_collection($response);
        }
        // Return all of our comment response data.
        return rest_ensure_response($data);
    }

    /**
     * Check permissions for the posts.
     *
     * @param WP_REST_Request $request Current request.
     */
    public function get_item_permissions_check($request) {
        if (!current_user_can('read')) {
            return new WP_Error('rest_forbidden', esc_html__('You cannot view the post resource.'), array('status' => $this->authorization_status_code()));
        }
        return true;
    }

    /**
     * Grabs the five most recent posts and outputs them as a rest response.
     *
     * @param WP_REST_Request $request Current request.
     */
    public function get_item($request) {
        $id = (int) $request['id'];
        $post = get_post($id);
        if (empty($post)) {
            return rest_ensure_response(array());
        }
        $response = $this->prepare_item_for_response($post, $request);
        // Return all of our post response data.
        return $response;
    }

    /**
     * Matches the post data to the schema we want.
     *
     * @param WP_Post $post The comment object whose response is being prepared.
     */
    public function prepare_item_for_response($post, $request) {
        $post_data = array();
        $schema = $this->get_item_schema($request);
        // We are also renaming the fields to more understandable names.
        if (isset($schema['properties']['id'])) {
            $post_data['id'] = (int) $post->ID;
        }
        if (isset($schema['properties']['content'])) {
            $post_data['content'] = apply_filters('the_content', $post->post_content, $post);
        }
        return rest_ensure_response($post_data);
    }

    /**
     * Prepare a response for inserting into a collection of responses.
     *
     * This is copied from WP_REST_Controller class in the WP REST API v2 plugin.
     *
     * @param WP_REST_Response $response Response object.
     *
     * @return array Response data, ready for insertion into collection data.
     */
    public function prepare_response_for_collection($response) {
        if (!($response instanceof WP_REST_Response)) {
            return $response;
        }
        $data = (array) $response->get_data();
        $server = rest_get_server();
        if (method_exists($server, 'get_compact_response_links')) {
            $links = call_user_func(array(
                $server,
                'get_compact_response_links',
                    ), $response);
        } else {
            $links = call_user_func(array(
                $server,
                'get_response_links',
                    ), $response);
        }
        if (!empty($links)) {
            $data['_links'] = $links;
        }
        return $data;
    }

    /**
     * Get our sample schema for a post.
     *
     * @return array The sample schema for a post
     */
    public function get_item_schema() {

        if ($this->schema) {
            // Since WordPress 5.3, the schema can be cached in the $schema property.
            return $this->schema;
        }
        $this->schema = array(
            // This tells the spec of JSON Schema we are using which is draft 4.
            '$schema' => 'http://json-schema.org/draft-04/schema#',
            // The title property marks the identity of the resource.
            'title' => 'page',
            'type' => 'object',
            // In JSON Schema you can specify object properties in the properties attribute.
            'properties' => array(
                'id' => array(
                    'description' => esc_html__('Unique identifier for the object.', 'my-textdomain'),
                    'type' => 'integer',
                    'context' => array(
                        'view',
                        'edit',
                        'embed',
                    ),
                    'readonly' => true,
                ),
                'content' => array(
                    'description' => esc_html__('The content for the object.', 'my-textdomain'),
                    'type' => 'string',
                ),
            ),
        );
        return $this->schema;
    }

    // Sets up the proper HTTP status code for authorization.
    public function authorization_status_code() {

        $status = 401;
        if (is_user_logged_in()) {
            $status = 403;
        }
        return $status;
    }

}
