<?php

namespace AnChoi;

use \Laven\Constants\Constants;
use \Firebase\JWT\JWT;

class Rest_TuTru_Action {

    public function __construct() {
	    $this->namespace = '/tutru-action';
	    $this->resource_name = 'get';
    }

    // Register our routes.
    public function register_routes() {
        register_rest_route($this->namespace, '/' . $this->resource_name, array(
            // Here we register the readable endpoint for collections.
            array(
                'methods' => 'GET',
                'callback' => [
                    $this,
                    'events_tutru_action_callback',
                ],
                'args' => [
                ],
            ),
        ));
    }

    public function events_tutru_action_callback($data) {
        $params = $data->get_params();
        $ngaySinh = isset($params['day']) ? $params['day'] : false;
        if (!$ngaySinh) {
            return $this->responseData();
        }
        $genre = !empty($params['gender']) ? 1 : 0;
        $gioSinhArr = !empty($params['hour']) ? $params['hour'] : false;
        if (!$gioSinhArr) {
	        return $this->responseData();
        }
	    $gioSinhArr = explode(':', $gioSinhArr);
        $helper = new \Laven\Helpers\Helpers();

        $timezone = 7.0;
	    $ngaySinhArr = explode('-', $ngaySinh);
	    $ngaySinhFull = $ngaySinhArr[2] . '-' . $ngaySinhArr[1] . '-' . $ngaySinhArr[0];
        $tuTruGiaChu = new \Laven\LasoTutru($ngaySinhFull, (isset($gioSinhArr[0]) ? $gioSinhArr[0] : 1), (isset($gioSinhArr[1]) ? $gioSinhArr[1] : '00'), $genre, $timezone);
        $doVuong = $tuTruGiaChu->tinhDoVuong();
        $doVuongSuy = $tuTruGiaChu->tinhDoVuongSuy($doVuong);
        $total = array_sum($doVuongSuy['total']);
        $soNguHanh = floor($total * 0.4);
        $dungThan = $hyThan = $banMenhText = '';
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
        $kyThan = $tuTruGiaChu->biKhac($dungThan);
        $napAmGiaChu = $tuTru = $tuTruGiaChu->tinhNapAm();
        $color = [
            'kim' => '#800080',
            'thuy' => '#4682b4',
            'moc' => '#008000',
            'hoa' => '#ff0000',
            'tho' => '#696969',
        ];
	    $background = [
		    'kim' => '#9b259b',
		    'thuy' => '#7dafd8',
		    'moc' => '#18a018',
		    'hoa' => '#d10000',
		    'tho' => '#999999',
	    ];

        $results = [];

        $batTu = $tuTruGiaChu->tinhBatTu();
        $tietKhi = $tuTruGiaChu->getTietKhiHienTai();
        $cungMenhThaiNguyen = $tuTruGiaChu->tinhCungMenhThaiNguyen();
        $namAmLich = 'Năm ' . $tuTruGiaChu->canNamText . ' ' . $tuTruGiaChu->chiNamText . ', tháng ' . $tuTruGiaChu->canThangText . ' ' . $tuTruGiaChu->chiThangText .
                ', ngày ' . $tuTruGiaChu->canNgayText . ' ' . $tuTruGiaChu->chiNgayText . ', giờ ' . $tuTruGiaChu->canGioText . ' ' . $tuTruGiaChu->chiGioText;

        $tinhCach = [];
        $results = [
	        'ngay_sinh' => $batTu['menh'] . ' ' . $tuTruGiaChu->gioPhutSinh . ' ' . $tuTruGiaChu->ngayDuong . '/' . $tuTruGiaChu->thangDuong . '/' . $tuTruGiaChu->namDuong . '(' . $tuTruGiaChu->ngaythangAm[0] . '/' . $tuTruGiaChu->ngaythangAm[1] . '/' . $tuTruGiaChu->ngaythangAm[2] . ' âm lịch), Tiết khí ' . $tietKhi['name'],
			'am_lich' => $tuTruGiaChu->ngaythangAm[0] . '/' . $tuTruGiaChu->ngaythangAm[1] . '/' . $tuTruGiaChu->ngaythangAm[2],
			'tiet_khi' => $tietKhi['name'],
	        'image_con_giap' => get_stylesheet_directory_uri() . '/congiap/' . $tuTruGiaChu->chiNamSlug . '_active.png',
	        'nam_can_chi' => $tuTruGiaChu->canNamText . ' ' . $tuTruGiaChu->chiNamText,
	        'menh_nien' => $napAmGiaChu['nam']['menh'],
	        'menh_quai' => $tuTruGiaChu->menhQuaiArr['menhquai']['name'] . ', ' . $tuTruGiaChu->menhQuaiArr['menh'],
	        'thai_nguyen' => $cungMenhThaiNguyen['thai_nguyen']['can'] . ' ' . $cungMenhThaiNguyen['thai_nguyen']['chi'],
	        'cung_menh' => $cungMenhThaiNguyen['cung_menh']['can'] . ' ' . $cungMenhThaiNguyen['cung_menh']['chi'],
	        'bat_tu' => $namAmLich,
	        'menh' => $banMenhText,
	        'menh2' => $napAmGiaChu['nam']['ngu_hanh'],
	        'dung_than' => $tuTruGiaChu->convertSlugToText($dungThan),
	        'hy_than' => $tuTruGiaChu->convertSlugToText($hyThan),
	        'background' => $background,
        ];
        return $this->responseData($results);
    }

    function responseData($data = []) {
        return new \WP_REST_Response([
            'code' => 'success',
            'message' => '',
            'status' => 200,
            'data' => $data
        ]);
    }

    function thienCanDiachi($canNh, $chiNh) {
        $array = [
            "kim_kim" => ["Bát Chuyên đồng khí", "Đồng mạng"],
            "kim_moc" => ["Chế nhật tiểu hung", "Can khắc Chi"],
            "kim_hoa" => ["Phạt nhật đại hung", "Chi khắc Can"],
            "kim_thuy" => ["Bảo nhật đại khiết", "Can sinh Chi"],
            "kim_tho" => ["Thoa nhật tiểu khiết", "Chi sinh Can"],
            "moc_moc" => ["Bát Chuyên đồng khí", "Đồng mạng"],
            "moc_thuy" => ["Thoa nhật tiểu khiết", "Chi sinh Can"],
            "moc_hoa" => ["Bảo nhật đại khiết", "Can sinh Chi"],
            "moc_tho" => ["Chế nhật tiểu hung", "Can khắc Chi"],
            "moc_kim" => ["Phạt nhật đại hung", "Chi khắc Can"],
            "thuy_thuy" => ["Bát Chuyên đồng khí", "Đồng mạng"],
            "thuy_kim" => ["Thoa nhật tiểu khiết", "Chi sinh Can"],
            "thuy_moc" => ["Bảo nhật đại khiết", "Can sinh Chi"],
            "thuy_hoa" => ["Chế nhật tiểu hung", "Can khắc Chi"],
            "thuy_tho" => ["Phạt nhật đại hung", "Chi khắc Can"],
            "hoa_hoa" => ["Bát Chuyên đồng khí", "Đồng mạng"],
            "hoa_kim" => ["Chế nhật tiểu hung", "Can khắc Chi"],
            "hoa_moc" => ["Thoa nhật tiểu khiết", "Chi sinh Can"],
            "hoa_thuy" => ["Phạt nhật đại hung", "Chi khắc Can"],
            "hoa_tho" => ["Bảo nhật đại khiết", "Can sinh Chi"],
            "tho_tho" => ["Bát Chuyên đồng khí", "Đồng mạng"],
            "tho_kim" => ["Bảo nhật đại khiết", "Can sinh Chi"],
            "tho_moc" => ["Phạt nhật đại hung", "Chi khắc Can"],
            "tho_thuy" => ["Chế nhật tiểu hung", "Can khắc Chi"],
            "tho_hoa" => ["Thoa nhật tiểu khiết", "Chi sinh Can"]
        ];

        return isset($array[$canNh . '_' . $chiNh]) ? $array[$canNh . '_' . $chiNh] : null;
    }

    public function tinhConNuoc($ngayAL) {
        $conNuocArr = [
            1 => ["Tý", "Ngọ", "Mão", "Dậu"],
            2 => ["Tý", "Ngọ", "Mão", "Dậu"],
            3 => ["Tý", "Ngọ", "Mão", "Dậu"],
            4 => ["Sửu", "Mùi", "Thìn", "Tuất"],
            5 => ["Sửu", "Mùi", "Thìn", "Tuất"],
            6 => ["Dần", "Thân", "Tỵ", "Hợi"],
            7 => ["Dần", "Thân", "Tỵ", "Hợi"],
            8 => ["Dần", "Thân", "Tỵ", "Hợi"],
            9 => ["Mão", "Dậu", "Tý", "Ngọ"],
            10 => ["Mão", "Dậu", "Tý", "Ngọ"],
            11 => ["Thìn", "Tuất", "Sửu", "Mùi"],
            12 => ["Thìn", "Tuất", "Sửu", "Mùi"],
            13 => ["Thìn", "Tuất", "Sửu", "Mùi"],
            14 => ["Tỵ", "Hợi", "Dần", "Thân"],
            15 => ["Tỵ", "Hợi", "Dần", "Thân"],
            16 => ["Tý", "Ngọ", "Mão", "Dậu"],
            17 => ["Tý", "Ngọ", "Mão", "Dậu"],
            18 => ["Tý", "Ngọ", "Mão", "Dậu"],
            19 => ["Sửu", "Mùi", "Thìn", "Tuất"],
            20 => ["Sửu", "Mùi", "Thìn", "Tuất"],
            21 => ["Dần", "Thân", "Tỵ", "Hợi"],
            22 => ["Dần", "Thân", "Tỵ", "Hợi"],
            23 => ["Dần", "Thân", "Tỵ", "Hợi"],
            24 => ["Mão", "Dậu", "Tý", "Ngọ"],
            25 => ["Mão", "Dậu", "Tý", "Ngọ"],
            26 => ["Thìn", "Tuất", "Sửu", "Mùi"],
            27 => ["Thìn", "Tuất", "Sửu", "Mùi"],
            28 => ["Thìn", "Tuất", "Sửu", "Mùi"],
            29 => ["Tỵ", "Hợi", "Dần", "Thân"],
            30 => ["Tỵ", "Hợi", "Dần", "Thân"],
        ];
        $gio = [
            "Tý" => "23h-01h",
            "Sửu" => "01h-03h",
            "Dần" => "03h-05h",
            "Mão" => "05h-07h",
            "Thìn" => "07h-09h",
            "Tỵ" => "09h-11h",
            "Ngọ" => "11h-13h",
            "Mùi" => "13h-15h",
            "Thân" => "15h-17h",
            "Dậu" => "17h-19h",
            "Tuất" => "19h-21h",
            "Hợi" => "21h-23h",
        ];


        $conNuoc = $conNuocArr[$ngayAL];
        return [
            'nuoc_len' => [
                'name' => 'Nước lên',
                'data' => [
                    $conNuoc[0] . ' (' . $gio[$conNuoc[0]] . ')',
                    $conNuoc[1] . ' (' . $gio[$conNuoc[1]] . ')',
                ]
            ],
            'nuoc_rong' => [
                'name' => 'Nước ròng',
                'data' => [
                    $conNuoc[2] . ' (' . $gio[$conNuoc[2]] . ')',
                    $conNuoc[3] . ' (' . $gio[$conNuoc[3]] . ')',
                ]
            ],
        ];
    }

    function thuTuSatChu($lasoTuTruNgay) {
        $arrayMonthSat = [
            1 => [
                'tuat',
                'ty',
            ],
            2 => [
                'thin',
                'ti',
            ],
            3 => [
                'hoi',
                'mui',
            ],
            4 => [
                'ty',
                'mao',
            ],
            5 => [
                'ti',
                'than',
            ],
            6 => [
                'ngo',
                'tuat',
            ],
            7 => ['suu'],
            8 => [
                'mui',
                'hoi',
            ],
            9 => [
                'dan',
                'ngo',
            ],
            10 => [
                'than',
                'dau',
            ],
            11 => [
                'mao',
                'dan',
            ],
            12 => [
                'dau',
                'thin',
            ],
        ];
        if (isset($arrayMonthSat[$lasoTuTruNgay->ngaythangAm[1]]) && in_array($lasoTuTruNgay->chiNgaySlug, $arrayMonthSat[$lasoTuTruNgay->ngaythangAm[1]])) {
            return 'Ngày thụ tử sát chủ (Quý gia chủ ngày hôm nay cần cẩn trọng, chú ý hơn vào sức khỏe, công việc mà mình định làm và những người thân cận xung quanh. Có thể gia chủ sẽ phải gánh chịu tai vạ “từ trên trời rơi xuống”.)';
        }

        return 'Không phạm';
    }

    function tinhNgaySat($lasoTuTruNgay, $lasoTuTru) {
        if (in_array($lasoTuTru->chiNamSlug, [
                    'than',
                    'ti',
                    'thin',
                ])) {
            if ($lasoTuTruNgay->chiNgaySlug == 'mui') {
                return 'Bạn gặp ngày sát tại ngày (Mùi) (Công việc lớn, các mối quan hệ quan trọng trong ngày hôm nay quý gia chủ nên cẩn trọng nhiều hơn. Không nên quyết định vội vàng hay xử lý qua loa. Nó có thể ảnh hưởng đến kết quả cuối cùng mà bạn đạt được.)';
            }
        }

        return 'Không phạm';
    }

    function tinhThaiTue($lasoTuTruNgay, $tuTruGiaChu) {
        $chiNam = $lasoTuTruNgay->chiNamSlug;
        $results = [];
        if ($tuTruGiaChu->chiNamSlug == $chiNam) {
            $results[] = 'Thái tuế: Ngày hôm nay bạn có thể gặp phải thị phi, phiền toái hoặc vạ lây từ người khác. Vậy nên hãy suy nghĩ kỹ trước khi nói, tránh tranh luận gay gắt hoặc tham gia vào các sự kiện không đáng.';
        }
        if ($tuTruGiaChu->chiNamSlug == $lasoTuTruNgay->diaChiHai[$chiNam]) {
            $results[] = 'Hại thái tuế: Kẻ tiểu nhân có thể quấy phá, chơi xấu làm ảnh hưởng đến cuộc sống và công việc của quý gia chủ trong ngày hôm nay.';
        }
        if ($tuTruGiaChu->chiNamSlug == $lasoTuTruNgay->diaChiLucXung[$chiNam]) {
            $results[] = 'Xung thái tuế: Hôm nay bạn sẽ không gặp nhiều may mắn, vậy nên để tránh xung đột, cãi vã hay đưa ra các quyết định sai lầm thì nếu việc không quan trọng thì nên để ngày mai giải quyết.';
        }
        if ($tuTruGiaChu->chiNamSlug == $lasoTuTruNgay->diachiHinh[$chiNam]) {
            $results[] = 'Hình thái tuế: Quý gia chủ cần chú ý đề phòng và cảnh giác những người xung quanh. Có thể họ sẽ mang tới những chuyện không may mắn hoặc gây bất lợi cho cuộc sống, công việc.';
        }
        if (in_array($tuTruGiaChu->chiNgaySlug, ['than', 'ti', 'thin']) && in_array($lasoTuTruNgay->chiInfo['nam']['name'], ['thin', 'mao', 'dan'])) {
            $results[] = 'Thân – Tý – Thìn (tam tai tại) Thìn Mão Dần: THUỶ TAI là tai họa do nước gây ra, như lũ lụt, sóng thần. Ngã nước, kinh doanh những mặt hàng liên quan tới nước cần chú ý dễ nhận thất bại. năm XẤU không nên xây nhà';
        } elseif (in_array($tuTruGiaChu->chiNgaySlug, ['ty', 'dau', 'suu']) && in_array($lasoTuTruNgay->chiInfo['nam']['name'], ['suu', 'ti', 'hoi'])) {
            $results[] = 'Tỵ - Dậu – Sửu (tam tai tại) Sửu Tý Hợi: KIM TAI chú ý: không nên kinh doanh kim khí, những đồ liên quan tới sắt thép, hoặc thể tĩnh, chú ý những vật làm từ kim loại, dễ gây sát thương. năm XẤU không nên xây nhà';
        } elseif (in_array($tuTruGiaChu->chiNgaySlug, ['hoi', 'mao', 'mui']) && in_array($lasoTuTruNgay->chiInfo['nam']['name'], ['mui', 'ngo', 'ty'])) {
            $results[] = 'Hợi – Mão – Mùi (tam tai tại ) Mùi Ngọ Tỵ: MỘC TAI. Chú ý về những cây trồng, không nên đầu tư tới gỗ, những cái mới bắt đầu thì không nên làm, vì làm sẽ dễ thất bại. năm XẤU không nên xây nhà';
        } elseif (in_array($tuTruGiaChu->chiNgaySlug, ['dan', 'ngo', 'tuat']) && in_array($lasoTuTruNgay->chiInfo['nam']['name'], ['tuat', 'dau', 'than'])) {
            $results[] = 'Dần – Ngọ - Tuất (tam tai tại) Tuất Dậu Thân: HOẢ TAI là tai họa do lửa cháy dễ cháy nhà, bỏng, tai nạn từ nhiệt gây ra. Dễ hấp tấp, nóng vội hỏng việc, không nên đầu tư quá lớn kinh doanh những ngành liên quan tới nhiệt, năm XẤU không nên xây nhà';
        }

        return !empty($results) ? $results : ['Không phạm'];
    }

    function ngayDacBiet() {
        global $wpdb;
        $date = date('Y-m-01');
        $table_name = $wpdb->prefix . 'sukien';
        $sql = "SELECT content,date_event, status, (CASE status
    WHEN 1 THEN 'QT'
    WHEN 0 THEN 'VN'
  END) as status_title, DATE_FORMAT(date_event, '%m-%d') as cur_monday FROM {$table_name} WHERE DATE_FORMAT(date_event, '%m-%d') = DATE_FORMAT('" . $date . "','%m-%d');";
        $my_db_result = $wpdb->get_results($sql);

        return $my_db_result;
    }

    function luanGiaiCungMenh($cungMenh) {
    	$cungMenhLuanGiai = [
    		'ti' => ['title' => 'Cung Mệnh Tý', 'data' => 'Quý gia chủ thuộc cung mệnh Thiên quý tinh với đức tính chí khí quật cường, không chịu khuất phục trước khó khăn, trở ngại. Là người sống trượng nghĩa, luôn hết lòng vì mọi người xung quanh và có cuộc sống cao sang quyền quý. Gia chủ có lộc làm ăn buôn bán kinh doanh nếu chọn đúng nghề, đúng thời điểm và phương vị thì hữu lộc lộc tồn.'],

		    'suu' => ['title' => 'Cung Mệnh Sửu', 'data' => 'Quý gia chủ thuộc Cung mệnh Thiên ách tinh thì dễ phải xa quê hương lập nghiệp mới phát triển. Cuộc sống giai đoạn tiền vận dễ vất vả gian truân, nhưng sau an nhàn thảnh thơi không giàu cũng thuộc nhà sang. Bắt đầu vào trung vận (sau 38 tuổi) cuộc sống phát triển theo chiều hướng tốt hơn, hữu lộc lộc tồn.'],

		    'dan' => ['title' => 'Cung Mệnh Dần', 'data' =>'Quý gia chủ thuộc cung mệnh Thiên quyền tinh nên có trí thông minh, tháo vát, cuộc sống trong tương lai có nhiều triển vọng làm lên nghiệp lớn. Thời trung niên có quyền chức hoặc cán bộ lãnh đạo, làm chủ, làm sếp. Nhưng quý gia chủ cần chú ý giữ vững đạo đức, tâm luôn hướng thiện để tránh lao lý.'],

		    'mao' => ['title' => 'Cung Mệnh Mão', 'data' =>'Quý gia chủ thuộc cung mệnh Thiên xá tịnh là người thông minh, có ý chí và rất trọng nhân nghĩa nhưng lại xem thường tiền tài, vật chất. Là người sống trong sáng cao thượng, nhưng lúc cuộc sống phát triển dễ kiêu ngạo. Để giữ được lộc và hữu lộc gia chủ cần có thêm sự cảm thông và hòa đồng với mọi người xung quanh như vậy cuộc sống mới an nhiên, bình an.'],

		    'thin' => ['title' => 'Cung Mệnh Thìn', 'data' =>'Quý gia chủ thuộc cung mệnh Thiên như tinh trong cuộc sống cũng như công việc dễ có sự thay đổi, dễ hay suy nghĩ và có thể đưa ra nhiều phương án, phương pháp để xử lý mọi sự việc. Trong tình cảm thì nhiều khi lắm mối tối nằm không vậy nên gia chủ cần có chính kiến. Đặc biệt cần chú ý lòng tốt lại dễ làm thân nhu nhược, lấy tâm làm móng, lấy trí làm tường để có cuộc sống an nhiên, bình an.'],

		    'ty' => ['title' => 'Cung Mệnh Tỵ', 'data' =>'Quý gia chủ thuộc cung mệnh Thiên văn tinh dễ có năng khiếu về văn chương, nghệ thuật nên sự nghiệp văn chương sáng lạn. Nữ giới cung mệnh này dễ gặp duyên lành, nhưng cần chú ý giữ đạo để tránh mắc sai lầm trong tửu sắc. Luôn giữ vững ý chí thì cuộc sống sẽ hanh thông, gặp nhiều may mắn.'],

		    'ngo' => ['title' => 'Cung Mệnh Ngọ', 'data' =>'Quý gia chủ thuộc cung mệnh Thiên phúc tinh thuộc kiểu người có cuộc sống vinh hoa phú quý, thanh nhàn yên vui. Nhưng để cuộc sống bình an, hạnh phúc lâu dài thì gia chủ nên tu tâm hướng thiện, bao dung độ lượng, cảm thông, gieo duyên thiện lành, cần kiệm liêm chính để giữ phước báu.'],

		    'mui' => ['title' => 'Cung Mệnh Mùi', 'data' =>'Quý gia chủ thuộc cung mệnh Thiên dịch cuộc sống dễ phải buôn ba vất vả, rời xa quê cha đất tổ lập nghiệp mới có cuộc sống phát triển.Cuộc sống vất vả trước nhưng về sau có của ăn của để. Gia chủ cần tu tâm tích đức, gieo duyên thiện lành, cần kiệm liêm chính thì sau 38 tuổi cuộc sống sẽ an nhàn thảnh thơi.'],

		    'than' => ['title' => 'Cung Mệnh Thân', 'data' =>'Quý gia chủ thuộc cung mệnh Thiên cô tinh cuộc sống dễ cô quạnh do không chịu nhờ vả, phiền lụy ai, sống nghiêm khắc, cũng hòa đồng nhưng hơi câu lệ. Nếu là nữ mệnh dễ sát chồng, cuộc sống cô quạnh, gia chủ nên tu tâm, tạo phúc, trợ duyên để sau này có cuộc sống thanh cao viên mãn.'],

			'dau' => ['title' => 'Cung Mệnh Dậu', 'data' =>'Quý gia chủ thuộc cung mệnh Thiên bí tinh nên tính tình thường thẳng thắn, có gì nói đấy mà khoogn suy nghĩ trước sau nên dễ gặp vạ miệng, thị phi không đáng có. Ngoài ra tính cách còn nóng vội, hay thích lo chuyện bao đồng, rất thích giúp đỡ người khác nhưng dễ nhiều chuyện. Gia chủ muốn có cuộc sống tốt hơn thì cần tu khẩu tu tâm và khi gặp thời vận vượng nếu biết nắm bắt thì sẽ gặp được nhiều điều tốt đẹp cả trong sự nghiệp lẫn cuộc sống.'],

		    'tuat' => ['title' => 'Cung Mệnh Tuất', 'data' =>'Quý gia chủ thuộc cung mệnh Thiên nghệ tinh thì thường là người thông minh, nhanh nhẹn, đa tài đa nghệ, nhưng dễ hùa theo mọi người mà không có chính kiến riêng. Là người cái gì cũng biết, cũng làm được nhưng không giỏi, không chuyên sâu nên khó thành danh. Để có cuộc sống như mong muốn quý gia chủ nên có chính kiến riêng, tập trung phát triển 1 năng khiếu, kết hợp với ngành nghề, phương vị quý nhân để phát triển bản thân. Có như vậy sẽ giúp cho cuộc sống vinh hoa phú quý như mong muốn.'],

		    'hoi' => ['title' => 'Cung Mệnh Hợi', 'data' =>'Quý gia chủ thuộc cung mệnh Thiên thọ tinh thường là người có một lòng nhân từ, thông minh và nhanh nhẹn. Thú vui trong cuộc sống là được giúp đỡ mọi người. Gia chủ thích cuộc sống bình an, không phải bon chen ganh đua với đời, ghét xô xát tranh giành để nhận lấy lợi nhuận. Do có tâm hướng thiện nên nếu gia chủ làm nhiều việc tốt, giúp ích cho đời thì sẽ có cuộc sống như mong muốn.'],
	    ];

    	return isset($cungMenhLuanGiai[$cungMenh]) ? $cungMenhLuanGiai[$cungMenh] : [];
    }

}
