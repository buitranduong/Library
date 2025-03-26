<?php

namespace AnChoi;

use \Laven\Constants\Constants;
use \Firebase\JWT\JWT;

class Rest_Daily_Action {

    public function __construct() {
        $this->namespace = '/daily-action';
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
                    'events_daily_action_callback',
                ],
                'args' => [
                ],
            ),
        ));
    }

	private function rawCurl ($url) {
		$ch = curl_init();
		curl_setopt($ch, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.108 Safari/537.36');
		//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_DNS_SERVERS, '1.1.1.1,8.8.8.8');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		$res = curl_exec($ch);
		curl_close($ch);
		return $res;
	}

    public function events_daily_action_callback($data) {
//	    $url = get_stylesheet_directory() . '/Sun-Moon-2200-2999/Sun-Moon-2980.html';
//	    //$url = 'https://www.informatik.uni-leipzig.de/~duc/amlich/DuLieu/Sun-Moon-2180.html';
//	    echo $url;
//	    $source = file_get_contents($url);
//	    include get_stylesheet_directory() . '/simple_html_dom.php';
//	    //$source = $this->rawCurl($url);
//	    $html = str_get_html($source);
//	    $data = [];
//	    $year = '';
//	    foreach ($html->find('table') as $index => $table) {
//		    foreach ($table->find('tr') as $index2 => $tr) {
//			    $i = 0;
//			    foreach ($tr->find('td') as $td) {
//				    $classes = explode(' ', $td->getAttribute('class'));
//				    if ($classes[0] == 'head') {
//					    $year = strip_tags($td->innertext);
//				    }
//				    $data[$year][$index2]['year'] = $year;
//				    $data[$year][$index2]['month'][] = $td->innertext;
//				    $i++;
//			    }
//
//		    }
//	    }
//
//	    //echo '<pre>';
//	    //var_dump($data);die;
//	    $data3 = [];
//	    $re = '/\w{2}\/\w{2} \w{2}:\w{2}/m';
//	    foreach ($data as $year => $val22) {
//		    $i = 0;
//	    	foreach ($val22 as $index2 => $val) {
//			    if (preg_match($re, $val['month'][0])) {
//			        $month = explode(' ', $val['month'][0]);
//			        $month2 = explode('/', $month[0]);
//			        $fullDate = $val['year'] .'-' . $month2[1] . '-' . $month2[0] . ' ' . $month[1] . ':00';
//				    $data3[$year][$i]['date'] = $fullDate;
//				    $data3[$year][$i]['index'] = $index2 - 2;
//					$i++;
//			    }
//		    }
//	    }
//	    //echo '<pre>';
//	    //var_dump($data3);die;
//	    global $wpdb;
//	    $table_name = $wpdb->prefix . 'tietkhi';
//	    $query = "INSERT INTO $table_name (`date`, `name`, `year`, `mua`, `phan`, `created_at`, `updated_at`, `index`) VALUES ";
//	    $insertValues = '';
//	    foreach ($data3 as $year => $value) {
//	    	foreach ($value as $value2) {
//		        $query .= "('".$value2['date']."', null, ".$year.", 'xxx', 2, '".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."', '".$value2['index']."'),";
//		    }
//	    }
//	    $query = substr($query, 0, -1);
//	    $wpdb->query($query);
//	    die;
        $params = $data->get_params();
        if (empty($params['token'])) {
            return $this->responseData();
        }
        try {
            $token = JWT::decode($params['token'], '123123132', array('HS256'));
        } catch (\UnexpectedValueException $e) {
            return $this->responseData();
        }

        $ngaySinh = isset($token->data->dob) ? $token->data->dob : false;
        if (!$ngaySinh) {
            return $this->responseData();
        }
        $genre = !empty($token->data->gender) ? 1 : 0;
        $ngaySinh = explode(' ', $ngaySinh);
        if (empty($ngaySinh[0])) {
            return $this->responseData();
        }
        $gioSinh = explode(':', $ngaySinh[1]);
        $helper = new \Laven\Helpers\Helpers();
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        if (!empty($params['date']) && preg_match('/^([0-2]\d|3[0-1])-(0\d|1[0-2])-(19|20)\d{2}$/', $params['date'])) {
            $dateArr = explode('-', $params['date']);
            $year = $dateArr[2];
            $month = $dateArr[1];
            $day = $dateArr[0];
        }
        $timezone = 7.0;
        $ngaySinhArr = explode('-', $ngaySinh[0]);
        $ngaySinhFull = $ngaySinhArr[2] . '-' . $ngaySinhArr[1] . '-' . $ngaySinhArr[0];
        $tuTruNgay = new \Laven\LasoTutru($day . '-' . $month . '-' . $year, 10, '00', 1, $timezone);
        $tuTruGiaChu = new \Laven\LasoTutru($ngaySinhFull, (isset($gioSinh[0]) ? $gioSinh[0] : 1), (isset($gioSinh[1]) ? $gioSinh[1] : '00'), $genre, $timezone);
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

        $napAmNgay = $tuTruNgay->tinhNapAm();
        $napAmNgay_Ngay = $napAmNgay['ngay']['ngu_hanh'];

        $napAmGiaChu = $tuTru = $tuTruGiaChu->tinhNapAm();
        $nguHanhMayMan = $dungThan;

        if ($dungThan == $tuTruGiaChu->tuongKhac($napAmNgay_Ngay)) {
            $nguHanhMayMan = $tuTruGiaChu->khacThanhSinh($napAmNgay_Ngay);
        }
        if ($napAmNgay_Ngay == $tuTruGiaChu->tuongKhac($dungThan)) {
            $nguHanhMayMan = $tuTruGiaChu->khacThanhSinh($dungThan);
        }
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
        if ($doVuongSuy['ban_menh']['name'] == 'moc') { // moc
            if (!$thanNhuoc) {
                $tinhCach = [
                    'Thuộc tính của người vượng ngũ hành MỘC',
                    'Quý gia chủ dễ có tính cách cứng rắn, cố chấp, bảo thủ, đã quyết việc gì là không từ bỏ. Sống có tham vọng tuy nhiên lại hay nóng giận vội vàng, nói xong mới nghĩ nên thường bị mất lòng. Làm ăn không lắm bắt được cơ hội, lại không nhận sự giúp đỡ, trợ giúp từ người khác nên có phát triển nhưng không mạnh. Ví như 1m2 trồng 1 cây là đủ, đây lại trồng tận 10 cây.',
                ];
            } else {
                $tinhCach = [
                    'Thuộc tính của người suy ngũ hành MỘC',
                    'Quý gia chủ trong công việc dễ thiếu sự phát triển và nghị lực do gặp khó khăn thì lùi bước, buông xuôi, ý chí kém lại thường suy nghĩ vội vàng. Cuộc sống của gia chủ thường mất phương hướng và định hướng vì không có người thân cận dẫn đường chỉ lối.'
                ];
            }
        }
        if ($doVuongSuy['ban_menh']['name'] == 'kim') { // kim
            if (!$thanNhuoc) {
                $tinhCach = [
                    'Thuộc tính của người vượng ngũ hành KIM',
                    'Quý gia chủ dễ có đức tính độc đoán, bướng bỉnh, cương quyết, khi đã xác định mục tiêu thì sẽ dốc lòng để đạt được. Là người tổ chức giỏi, nghiêm túc, quyết đoán, cứng nhắc nên kém linh động và không dễ nhận sự giúp đỡ từ mọi người xung quanh. Gia chủ sống mạnh mẽ, tự bắt mình vào những nguyên tắc sống cứng nhắc nên dễ sầu muộn.'
                ];
            } else {
                $tinhCach = [
                    'Thuộc tính của người suy ngũ hành KIM',
                    'Quý gia chủ là người có tính cách dụt dè, mềm yếu, nhu nhược, hay ỉ lại vào mọi người xung quanh. Tính cách nhanh nản, dễ buông xuôi nếu gặp khó khăn, trắc trở nên khó làm lên thành tựu. Tuy nhiên thỉnh thoảng có linh động trong việc giải quyết công việc nhưng hiệu quả thấp.'
                ];
            }
        }
        if ($doVuongSuy['ban_menh']['name'] == 'thuy') { // thuy
            if (!$thanNhuoc) {
                $tinhCach = [
                    'Thuộc tính của nười vượng ngũ hành THỦY',
                    'Quý gia chủ thông minh, tháo vát, là con người phức tạp bởi đôi khi thường xảo quyệt, lừa lọc để nhận lợi ích cho riêng mình. Đời sống tình cảm phong phú, nhiều ước mơ, mục tiêu nên thường cả thèm chóng chán, làm gần được lại mất do không quyết tâm, bỏ dở giữa chừng. Đặc biệt vào những năm suy càng làm càng mất do tính cách và tư duy như dòng nước lũ cuốn trôi mọi thứ.'
                ];
            } else {
                $tinhCach = [
                    'Thuộc tính của người suy ngũ hành THỦY',
                    'Quý gia chủ dễ có tư duy chậm chạp do trí nhớ kém, thiếu sự cẩn thận, làm mọi việc đều qua loa, dễ buông xuôi. Đời sống tình cảm thì thường khô khan, không lãng mạn nên khiến người bạn đồng hành thường không vừa ý. Tuy nhiên có 1 số người suy ngũ hành Thủy lại có tâm địa xấu sống nham hiểm, thích tranh giành quyền lực với mọi người và hay mất bình tĩnh. Phần lớn những người này thường không đạt được thành tựu như mong muốn.'
                ];
            }
        }
        if ($doVuongSuy['ban_menh']['name'] == 'hoa') { // hoa
            if (!$thanNhuoc) {
                $tinhCach = [
                    'Thuộc tính của người vượng ngũ hành HỎA',
                    'Quý gia chủ có ý chí mạnh mẽ, kiên cường, luôn tràn đầy năng lượng, nói là làm không cần đến sự giúp đỡ từ mọi người, sống có quy tắc, tham vọng. Khi làm việc thường có ý nghĩ “không nhất thì bét” nên luôn sẵn lòng chấp nhận rủi ro, dấn thân vào mạo hiểm. Là người chủ động, sáng tạo tính cách thẳng thắn, bộc trực, thật thà, không biết nói dối. Tuy nhiên gia chủ lại có nhược điểm khô khan dễ nóng vội, dễ bốc đồng và nhiều khi do thẳng thật quá nên có thể làm mất lòng mọi người xung quanh.',
                    'Nếu thân vượng Hỏa quá thì những đức tính đó cũng sẽ hại gia chủ vì hay dấn thân vào mạo hiểm, dễ bốc đồng, khô khan nóng vội, thẳng thắn. Nên thành công gần được lại mất do cái tôi quá lớn, tính cách bảo thủ gia trưởng vẫn biết không nên nhưng vẫn cố làm nên thường bỏ qua cơ hội tốt.'
                ];
            } else {
                $tinhCach = [
                    'Thuộc tính của người suy nhược ngũ hành HỎA',
                    'Quý gia chủ nhược ngũ hành Hỏa thường thiếu sự chủ động, quyết đoán, nhút nhát, nhu nhược, chậm chạp thường trần trừ suy nghĩ rất lâu. Nhiều khi vì suy nghĩ thấu đáo tới mức cơ hội qua mới có quyết định.'
                ];
            }
        }
        if ($doVuongSuy['ban_menh']['name'] == 'tho') { // tho
            if (!$thanNhuoc) {
                $tinhCach = [
                    'Thuộc tính của người vượng ngũ hành THỔ',
                    'Quý gia chủ có cái tôi, tự trọng, tự ái lớn, tinh thần vững chắc. Tuy nhiên tính cách lại chậm chạp, ỉ lại, suy nghĩ thường hay trì trệ, bảo thủ cố chấp. Vậy nên thường hay bỏ qua cơ hội tốt do nhu nhược không tự đưa ra được đáp án và mất thời gian suy nghĩ quá nhiều. Tính cách gia chủ còn khô khan, ăn nói không dễ nghe nên thường sống cô quạnh, ít bạn tri kỷ.',
                ];
            } else {
                $tinhCach = [
                    'Thuộc tính của người suy nhượng ngũ hành thổ',
                    'Quý gia chủ tính cách thường nhu nhược, dễ lay động, không có sự quyết đoán. Do không tự tin vào bản thân, thiếu chính kiến, không có lập trường. Và với tính cách cả thèm chóng chán nên không đạt được thành tựu cao trong công việc cũng như cuộc sống.'
                ];
            }
        }
        $results['co_ban'][1] = [
            'title' => 'Tổng quan về thông tin mệnh chủ',
            'data' => [
                'ngay_sinh' => $batTu['menh'] . ' ' . $tuTruGiaChu->gioPhutSinh . ' ' . $tuTruGiaChu->ngayDuong . '/' . $tuTruGiaChu->thangDuong . '/' . $tuTruGiaChu->namDuong . '(' . $tuTruGiaChu->ngaythangAm[0] . '/' . $tuTruGiaChu->ngaythangAm[1] . '/' . $tuTruGiaChu->ngaythangAm[2] . ' âm lịch), Tiết khí ' . $tietKhi['name'],
                'image_con_giap' => get_stylesheet_directory_uri() . '/congiap/' . $tuTruGiaChu->chiNamSlug . '_active.png',
                'nam_can_chi' => $tuTruGiaChu->canNamText . ' ' . $tuTruGiaChu->chiNamText,
                'menh_nien' => $napAmGiaChu['nam']['menh'],
                'menh_quai' => $tuTruGiaChu->menhQuaiArr['menhquai']['name'] . ', ' . $tuTruGiaChu->menhQuaiArr['menh'],
                'thai_nguyen' => $cungMenhThaiNguyen['thai_nguyen']['can'] . ' ' . $cungMenhThaiNguyen['thai_nguyen']['chi'],
                'cung_menh' => $cungMenhThaiNguyen['cung_menh']['can'] . ' ' . $cungMenhThaiNguyen['cung_menh']['chi'],
                'bat_tu' => $namAmLich,
                'menh' => $banMenhText,
	            'menh2' => $napAmGiaChu['nam']['ngu_hanh'],
                'dung_than' => [
                    'text' => 'Dụng thần',
                    'color' => $color[$dungThan],
                    'text' => $tuTruGiaChu->convertSlugToText($dungThan),
                ],
                'hy_than' => [
                    'text' => 'Hỷ thần',
                    'color' => $color[$hyThan],
                    'text' => $tuTruGiaChu->convertSlugToText($hyThan),
                ],
            ]
        ];
        $results['co_ban'][2] = [
            'title' => 'Luận cơ bản về tính cách mệnh chủ',
            'data' => $tinhCach
        ];

        $soMayMan = [
            'kim' => [
                'number' => '6, 7',
                'text' => 'Số 6 và số 7 mang ngũ hành Kim, đại diện cho sự kiên cường, tích cực, ấm áp, may mắn, dễ gặp người trượng nghĩa. Hôm nay số 6 - 7 sẽ là số may mắn của quý gia chủ, nhưng cần lưu ý không được lạm dụng con số may mắn này tới những chuyện phi pháp.',
                'color' => $color['kim'],
            ],
            'thuy' => [
                'number' => '0, 1',
                'text' => 'Số 0 và số 1 mang ngũ hành Thuỷ, đại diện cho sự phát triển, nuôi dưỡng và sức sống, hy vọng, dễ gặp hiền tài trợ giúp. Hôm nay số 0 - 1 sẽ là số may mắn của quý gia chủ, nhưng lưu ý không được lạm dụng con số may mắn này tới những chuyện phi pháp.',
                'color' => $color['thuy'],
            ],
            'moc' => [
                'number' => '3, 4',
                'text' => 'Số 3 và số 4 mang ngũ hành Mộc, đại diện cho sự kiên cường, phát triển, sinh sôi, nảy nở, vững mạnh, dễ gặp được người có đạo đức, thương người giúp đỡ. Hôm nay số 3 - 4 sẽ là số may mắn của quý gia chủ, nhưng lưu ý là không được lạm dụng con số may mắn này tới những chuyện phi pháp.',
                'color' => $color['moc'],
            ],
            'hoa' => [
                'number' => '9',
                'text' => 'Số 9 mang ngũ hành Hoả, đại diện cho sức mạnh dũng mãnh, mạnh mẽ. Con số mang lại may mắn, gặp hung hóa cát, dễ gặp thần tài bổ trợ. Hôm nay số 9 sẽ là số may mắn của quý gia chủ, nhưng lưu ý không được lạm dụng con số may mắn này tới những chuyện phi pháp.',
                'color' => $color['hoa'],
            ],
            'tho' => [
                'number' => '2, 5, 8',
                'text' => 'Số 2 – 5 – 8 mang ngũ hành Thổ, đại diện cho sự bền vững, chắc chắn, bao bọc, trợ giúp, có quý nhân phù trợ. Hôm nay số 2 – 5 – 8, sẽ là số may mắn của quý gia chủ, nhưng cần lưu ý không được lạm dụng con số may mắn này với những chuyện phi pháp.',
                'color' => $color['tho'],
            ],
        ];
        $giaChu['so_may_man'] = isset($soMayMan[$nguHanhMayMan]) ? $soMayMan[$nguHanhMayMan] : '';

        $napAmGiaChu_Nam = $napAmGiaChu['nam']['ngu_hanh'];
        $napAmGiaChu_Ngay = $napAmGiaChu['ngay']['ngu_hanh'];
        // nam
        if ($napAmNgay_Ngay == $tuTruGiaChu->tuongSinh($napAmGiaChu_Nam) || $napAmNgay_Ngay == $napAmGiaChu_Nam) { // sinh tro
            $giaChu['suc_khoe'][] = 'Sức khỏe của quý gia chủ trong khung giờ từ 5h tới 15h thuộc sinh khí nên khá tốt, nhưng khi ra ngoài cần chú ý thời tiết.';
        }
        if ($napAmNgay_Ngay == $tuTruGiaChu->tuongKhac($napAmGiaChu_Nam) || $napAmGiaChu_Nam == $tuTruGiaChu->tuongSinh($napAmNgay_Ngay)) { // khac hao
            $giaChu['suc_khoe'][] = 'Quý gia chủ cần chú ý sức khoẻ, trong khoảng thời gian từ 5h tới 15h.';
        }
        // ngay
        if ($napAmNgay_Ngay == $tuTruGiaChu->tuongSinh($napAmGiaChu_Nam) || $napAmNgay_Ngay == $napAmGiaChu_Nam) { // sinh tro
            $giaChu['suc_khoe'][] = 'Sức khoẻ của quý gia chủ trong khung giờ từ 15h tới hết ngày, thuộc sinh khí nên khá tốt, nhưng khi ra ngoài cần chú ý thời tiết.';
        }
        if ($napAmNgay_Ngay == $tuTruGiaChu->tuongKhac($napAmGiaChu_Nam) || $napAmGiaChu_Nam == $tuTruGiaChu->tuongSinh($napAmNgay_Ngay)) { // khac hao
            $giaChu['suc_khoe'][] = 'Quý gia chủ cần chú ý sức khỏe trong khoảng thời gian từ 15h tới hết ngày.';
        }

        // cong viec
        $diachiNgay_Ngay = $tuTruNgay->chiNgaySlug;
        $diachiNgay_Ngay_NguHanh = $tuTruNgay->chiInfo['ngay']['name'];
        $diachiNgay_Nam = $tuTruNgay->chiNamSlug;
        $diachiNgay_Nam_NguHanh = $tuTruNgay->chiInfo['nam']['name'];
        //Gia chu
        $diachiGiaChu_Ngay = $tuTruGiaChu->chiNgaySlug;
        $diachiGiaChu_Ngay_NguHanh = $tuTruGiaChu->chiInfo['ngay']['name'];
        $diachiGiaChu_Nam = $tuTruGiaChu->chiNamSlug;
        $diachiGiaChu_Nam_NguHanh = $tuTruGiaChu->chiInfo['nam']['name'];

        if ($diachiGiaChu_Nam == $tuTruGiaChu->diaChiLucXung[$diachiNgay_Ngay] ||
                $diachiNgay_Ngay == $tuTruGiaChu->diaChiLucXung[$diachiGiaChu_Nam] ||
                $diachiNgay_Ngay_NguHanh == $tuTruGiaChu->tuongKhac($diachiGiaChu_Nam_NguHanh) ||
                $diachiGiaChu_Nam_NguHanh == $tuTruGiaChu->tuongKhac($diachiNgay_Ngay_NguHanh)) {
            $giaChu['suc_khoe'][] = 'Về mặt công việc quý gia chủ cần chú ý có thể gặp xung đột, cãi vã hoặc bị phá đám.';
        }
        if ($diachiGiaChu_Nam_NguHanh == $tuTruGiaChu->tuongSinh($diachiNgay_Ngay_NguHanh) || $diachiGiaChu_Nam_NguHanh == $diachiNgay_Ngay_NguHanh) {
            $giaChu['suc_khoe'][] = 'Trong hung có cát quý gia chủ dễ có quý nhân phù trợ, giúp đỡ nên mọi khó khăn, vất vả đều sẽ qua đi.';
        }

        // ngay
        if ($diachiGiaChu_Ngay == $tuTruGiaChu->diaChiLucXung[$diachiNgay_Ngay] ||
                $diachiNgay_Ngay == $tuTruGiaChu->diaChiLucXung[$diachiGiaChu_Ngay] ||
                $diachiNgay_Ngay_NguHanh == $tuTruGiaChu->tuongKhac($diachiGiaChu_Ngay_NguHanh) ||
                $diachiGiaChu_Ngay_NguHanh == $tuTruGiaChu->tuongKhac($diachiNgay_Ngay_NguHanh)) {
            $giaChu['suc_khoe'][] = 'Quý gia chủ cần chú ý dễ có kẻ tiểu nhân quấy phá, chơi xấu đâm sau lưng làm ảnh hưởng đến cuộc sống và công việc.';
        }
        if ($diachiGiaChu_Ngay_NguHanh == $tuTruGiaChu->tuongSinh($diachiNgay_Ngay_NguHanh) || $diachiGiaChu_Ngay_NguHanh == $diachiNgay_Ngay_NguHanh) {
            $giaChu['suc_khoe'][] = 'Nếu có gặp chuyện nhưng vẫn có quý nhân trợ giúp hoá hung thành cát. Mọi việc sẽ dần trở về với quỹ đạo ban đầu và phát triển tốt hơn.';
        }

        // tinh duyen
        $thienCanNgay = $tuTruNgay->canNgaySlug;
        $thienCanNgay_NH = $tuTruNgay->canInfo['ngay']['name'];
        $giaChu_TC_Nam = $tuTruGiaChu->canNamSlug;
        $giaChu_TC_Nam_NH = $tuTruGiaChu->canInfo['nam']['name'];
        $giaChu_TC_Ngay = $tuTruGiaChu->canNgaySlug;
        $giaChu_TC_Ngay_NH = $tuTruGiaChu->canInfo['ngay']['name'];

        if ($thienCanNgay == $tuTruGiaChu->thienCanXung[$giaChu_TC_Nam] ||
                $giaChu_TC_Nam == $tuTruGiaChu->thienCanXung[$thienCanNgay] ||
                $thienCanNgay_NH == $tuTruGiaChu->tuongKhac($giaChu_TC_Nam_NH) || $giaChu_TC_Nam_NH == $tuTruGiaChu->tuongKhac($thienCanNgay_NH)) { // xung khac
            $giaChu['tinh_duyen'][] = 'Hôm nay chuyện tình cảm của quý gia chủ không được tốt lắm, có thể xảy ra mâu thuẫn, cãi vã vậy nên cần điềm đạm, nhẫn nhịn để tránh bất đồng.';
        }
        if ($giaChu_TC_Nam_NH == $tuTruGiaChu->tuongSinh($thienCanNgay_NH) || $thienCanNgay_NH == $giaChu_TC_Nam_NH) { //sinh tro
            $giaChu['tinh_duyen'][] = 'Chuyện tình cảm nhân duyên của quý gia chủ được cát lợi, có thể gặp được ý trung nhân.';
        }
        if ($thienCanNgay == $tuTruGiaChu->thienCanXung[$giaChu_TC_Ngay] ||
                $giaChu_TC_Ngay == $tuTruGiaChu->thienCanXung[$thienCanNgay] ||
                $thienCanNgay_NH == $tuTruGiaChu->tuongKhac($giaChu_TC_Ngay_NH) || $giaChu_TC_Ngay_NH == $tuTruGiaChu->tuongKhac($thienCanNgay_NH)) { // xung khac
            $giaChu['tinh_duyen'][] = 'Chuyện tình cảm của quý gia chủ dễ không hòa thuận cần sự hài hoà, thấu hiểu nhau hơn. Tránh đưa ra quyết định khi tranh cãi, nổi nóng có có thể làm bạn đưa ra quyết định sai lầm.';
        }
        if ($giaChu_TC_Ngay_NH == $tuTruGiaChu->tuongSinh($thienCanNgay_NH) || $thienCanNgay_NH == $giaChu_TC_Ngay_NH) { //inh tro
            $giaChu['tinh_duyen'][] = 'Nếu hôm nay chuyện tình cảm của quý gia chủ có sự cố, xảy ra tranh chấp, cãi vã thì không cần quá lo lắng vì mọi chuyện sẽ ổn và cát lành.';
        }

        // dia chi
        if ($diachiNgay_Ngay == $tuTruGiaChu->diaChiLucXung[$diachiGiaChu_Ngay] ||
                $diachiGiaChu_Ngay == $tuTruGiaChu->diaChiLucXung[$diachiNgay_Ngay] ||
                $diachiNgay_Ngay == $tuTruGiaChu->diaChiHinh[$diachiGiaChu_Ngay] ||
                $diachiGiaChu_Ngay == $tuTruGiaChu->diaChiHinh[$diachiNgay_Ngay] ||
                $diachiNgay_Ngay == $tuTruGiaChu->diaChiPha[$diachiGiaChu_Ngay] ||
                $diachiGiaChu_Ngay == $tuTruGiaChu->diaChiPha[$diachiNgay_Ngay] ||
                $diachiNgay_Ngay == $tuTruGiaChu->diaChiHai[$diachiGiaChu_Ngay] ||
                $diachiGiaChu_Ngay == $tuTruGiaChu->diaChiHai[$diachiNgay_Ngay] ||
                $diachiNgay_Ngay_NguHanh == $tuTruGiaChu->tuongKhac($diachiGiaChu_Ngay_NguHanh) ||
                $diachiGiaChu_Ngay_NguHanh == $tuTruGiaChu->tuongKhac($diachiNgay_Ngay_NguHanh)) {
            $giaChu['gia_dao'][] = 'Ngày hôm nay quý gia chủ cần sự bao dung, độ lượng, thấu hiểu, với mọi người trong gia đình để tránh sự cãi vã, mâu thuẫn không hay xảy ra.';
        }
        if ($diachiGiaChu_Ngay_NguHanh == $tuTruGiaChu->tuongSinh($diachiNgay_Ngay_NguHanh)) {
            $giaChu['gia_dao'][] = 'Ngày hôm nay quý gia chủ có nhiều niềm vui về gia đạo, có những tin vui không ngờ từ người thân.';
        }

        if (in_array($napAmNgay_Ngay, [$dungThan, $hyThan])) {
            $giaChu['tai_loc'][] = 'Hôm nay quý gia chủ dễ nhận được tài lộc từ người xung quanh mang lại, có quý nhân phù trợ. Nhưng cũng không nên chủ quan.';
        }
        if (in_array($napAmNgay_Ngay, [$kyThan])) {
            $giaChu['tai_loc'][] = 'Về tài lộc hôm nay quý gia chủ dễ bị lợi dụng dẫn đến thất thoát tiền bạc, cần sự đề phòng cẩn trọng.';
        }
        if ($dungThan == $tuTruNgay->canInfo['ngay']['name']) {
            $giaChu['tai_loc'][] = 'Từ 5h sáng tới 16h quý gia chủ sẽ gặp cát lành, quý gia chủ dễ có tin vui và trong khoảng thời gian này bạn sẽ gặp may mắn trong mọi chuyện. Tuy nhiên không nên chủ quan mà đưa ra các quyết định sai lầm.';
        }
        if ($dungThan == $tuTruNgay->chiInfo['ngay']['name']) {
            $giaChu['tai_loc'][] = 'Từ 16h tới 22h là khoảng thời gian cát lành, quý gia chủ dễ đón nhận được nhiều niềm vui, nhưng không nên chủ quan.';
        }
        if ($kyThan == $tuTruNgay->chiInfo['ngay']['name']) {
            $giaChu['tai_loc'][] = 'Trong thời điểm từ 16h tới hết ngày, quý gia chủ nên cẩn trọng đề phòng kẻ gian để tránh bị lợi dụng, tiền mất tật mang.';
        }
        if ($kyThan == $tuTruNgay->canInfo['ngay']['name']) {
            $giaChu['tai_loc'][] = 'Trong thời điểm từ 5h tới 16h quý gia chủ nên đề phòng kẻ tiểu nhân quấy phá, tránh xa chuyện của người khác để không vướng vào thị phi.';
        }

        $huongDep = [
            'kim' => 'Cung CÀN hướng TÂY BẮC. Cung ĐOÀI hướng TÂY.',
            'thuy' => 'Cung KHẢM hướng BẮC.',
            'moc' => 'Cung CHẤN hướng ĐÔNG. Cung TỐN hướng ĐÔNG NAM.',
            'hoa' => 'Cung LY hướng NAM.',
            'tho' => 'Cung CẤN hướng ĐÔNG BẮC. Cung KHÔN hướng TÂY NAM.'
        ];
        if ($tuTruNgay->canInfo['ngay']['name'] == $dungThan) {
            $giaChu['huong'][] = 'Hôm nay QUÝ GIA CHỦ sẽ dễ gặp quý nhân phù trợ tại phương ' . $huongDep[$dungThan] . ' tới. Lúc này gia chủ cần có lòng lương thiện, không làm hại người khác để đón quý nhân.';
        }
        if ($tuTruNgay->canInfo['ngay']['name'] == $kyThan) {
            $giaChu['huong'][] = 'Hôm nay quý gia chủ cần chú ý đề phòng những người xung quanh vì có thể gặp kẻ tiểu nhân lợi dụng hoặc chơi xấu sau lưng, có thể tại phương: ' . $huongDep[$kyThan] . ' tới. Gia chủ không nên có tâm hại người nhưng cần có tâm phòng bị người để tránh rước họa vào thân.';
        }
        if ($tuTruNgay->chiInfo['ngay']['name'] == $dungThan) {
            $giaChu['huong'][] = 'Hôm nay quý gia chủ sẽ gặp nhiều thuận lợi, cát lành, nên thực hiện làm ăn, ký kết giao dịch hay mở rộng các mối quan hệ đều đạt được hiệu quả như mong muốn. Tuy nhiên không vì vậy mà chủ quan để xảy ra những sai sót không đáng có.';
        }
        if ($tuTruNgay->chiInfo['ngay']['name'] == $kyThan) {
            $giaChu['huong'][] = 'Hôm nay quý gia chủ cần chú ý dễ có kẻ tiểu nhân quấy phá, chơi xấu. Để tránh gặp phải những bất trắc, thị phi không đáng có thì nên chú ý một chút.';
        }
        if ($napAmNgay_Ngay == $dungThan) {
            $giaChu['huong'][] = 'Hôm nay quý gia chủ dễ nhận được tin vui từ phương xa như từ bạn bè, người thân trong gia đình đi làm ăn xa hay công việc ở phương xa của bạn có tiến triển tốt.';
        }
        if ($napAmNgay_Ngay == $kyThan) {
            $giaChu['huong'][] = 'QUÝ GIA CHỦ cần chú ý: tới những cuộc gọi điện thoại, cần cân nhắc kỹ trước khi quyết định.';
        }
        if ($diachiNgay_Ngay == $tuTruGiaChu->diaChiLucXung[$diachiGiaChu_Ngay] || $diachiGiaChu_Ngay == $tuTruGiaChu->diaChiLucXung[$diachiNgay_Ngay]) {
            $giaChu['huong'][] = 'QUÝ GIA CHỦ chú ý: cần mệm mại, thấu hiểu nhịn nhường để tránh va chạm.';
        }
        if ($diachiNgay_Ngay == $tuTruGiaChu->diaChiHinh[$diachiGiaChu_Ngay] || $diachiGiaChu_Ngay == $tuTruGiaChu->diaChiHinh[$diachiNgay_Ngay]) {
            $giaChu['huong'][] = 'QUÝ GIA CHỦ cần cảnh giác những người xung quanh.';
        }
        if ($diachiNgay_Ngay == $tuTruGiaChu->diaChiPha[$diachiGiaChu_Ngay] || $diachiGiaChu_Ngay == $tuTruGiaChu->diaChiPha[$diachiNgay_Ngay]) {
            $giaChu['huong'][] = 'QUÝ GIA CHỦ cần đề phòng có người phá đám.';
        }
        if ($diachiNgay_Ngay == $tuTruGiaChu->diaChiHai[$diachiGiaChu_Ngay] || $diachiGiaChu_Ngay == $tuTruGiaChu->diaChiHai[$diachiNgay_Ngay]) {
            $giaChu['huong'][] = 'QUÝ GIA CHỦ cần đề phòng có kẻ ném đá dấu tay.';
        }

        $anUong = [
            'kim' => 'Hôm nay quý gia chủ nên dùng những thực phẩm thuộc ngũ hành Kim như: gạo trắng, sữa, kem, pho mát trắng, hành tây, tỏi, hẹ, củ cải, súp lơ, đậu phụ, ngó sen, lê, su hào, quế, bạc hà, ngải cứu, kinh giới, lá hương thảo, húng tây, hành lá, đinh hương, hạt cây, rau mùi và rau mùi hạt, rau mùi tây, cây hồi, thì là, mù tạt, cải ngựa, húng quế. Những thực phẩm này đều có thuộc tính của ngũ hành kim có thể bổ trợ cho quý gia chủ có được sức khỏe, may mắn, hanh thông.',

            'thuy' => 'Hôm nay quý gia chủ nên dùng những thực phẩm thuộc ngũ hành Thuỷ gồm: cá tươi, cá muối, thịt muối, trứng cá, thịt lợn, trứng, đậu, rong biển, nước tương, quả sung, xôi, cà tím, cải xoăn, lúa hoang, quả óc chó. Những loại thực phẩm này có thể bổ trợ cho quý gia chủ mệnh Thủy có được sức khỏe, may mắn, hanh thông.',

            'moc' => 'Hôm nay quý gia chủ nên dùng những thực phẩm thuộc ngũ hành Mộc. Ví dụ như: thịt gà, gan, lúa mì, rau cải, bông cải xanh, giá, măng tây và cần tây, trái cây như chanh, cam, bưởi, mận, dứa, các thực phẩm có vị chua như giấm, sữa chua, kim chi, dưa chua, ô liu. Những thực phẩm này có thể bổ trợ cho quý gia chủ mệnh Mộc có được sức khỏe, may mắn, hanh thông.',

            'hoa' => 'Hôm nay quý gia chủ nên dùng những thực phẩm thuộc ngũ hành Hỏa như thịt cừu, thịt nai, thịt chó, mật gấu, trái cây như mít, cà chua, mơ, mận, dâu tây, hạt tiêu, ớt nóng, hạt tiêu đen, rượu, bia, cà phê, trà và những đồ uống nên men. Vì những thực phẩm này có thể bổ trợ cho quý anh chị ngày hôm nay có một sức khỏe tốt, mọi việc hanh thông.',

            'tho' => 'Hôm nay quý gia chủ nên sử dụng những thực phẩm thuộc ngũ hành Thổ gồm: thịt bò, thịt trâu, thịt ngỗng, các loại ngũ cốc như hạt kê, gạo tẻ, lúa mạch, đường, mía, ngô, yến mạch, dưa hấu, táo ngọt, nho, đào, cà rốt, bắp cải, khoai tây, khoai lang, chuối, đậu bắp, khoai môn, củ cải đường, nấm, dưa chuột, hạnh nhân, dừa, đu đủ, xoài, đậu lăng, mật ong, siro cây lá Phong, siro gạo. Những thực phẩm này có thể bổ trợ cho quý anh chị ngày hôm nay có thể giúp cho công việc đạt được như mong cầu, may mắn và sức khoẻ dồi dào.'
        ];
        $giaChu['an_uong'] = isset($anUong[$nguHanhMayMan]) ? $anUong[$nguHanhMayMan] : null;
        $nguoiHopTac = [
            'ti' => 'Sửu, Thân, Thìn, Hợi',
            'suu' => 'Tý, Tỵ, Dậu, Hợi',
            'dan' => 'Ngọ, Tuất, Mão, Hợi',
            'mao' => 'Tuất, Hợi, Mùi, Dần',
            'thin' => 'Dậu, Thân, Tý, Mão',
            'ty' => 'Thân, Dậu, Sửu, Ngọ',
            'ngo' => 'Mùi, Tuất, Tỵ, Dần',
            'mui' => 'Ngọ, Hợi, Mão, Mùi',
            'than' => 'Tỵ, Tý, Dậu, Thìn',
            'dau' => 'Thìn, Tỵ, Sửu, Thân',
            'tuat' => 'Dần, Ngọ, Mão Dậu',
            'hoi' => 'Dần, Mão, Mùi, Tý',
        ];
        $nguoiXung = [
            'ti' => 'Ngọ, Mão, Dậu, Mùi',
            'suu' => 'Mùi, Tuất, Thìn, Ngọ',
            'dan' => 'Thân, Tỵ, Hợi',
            'mao' => 'Dậu, Tý, Ngọ, Thìn',
            'thin' => 'Tuất, Thìn, Sửu, Mão',
            'ty' => 'Hợi, Thân, Dần',
            'ngo' => 'Tý, Ngọ, Mão, Sửu',
            'mui' => 'Sửu, Tuất, Tý',
            'than' => 'Dần, Tỵ, Hợi',
            'dau' => 'Mão, Dậu, Tý, Tuất',
            'tuat' => 'Dậu, Mùi, Sửu, Thìn',
            'hoi' => 'Dần, Thân, Tỵ, Hợi',
        ];
        $phongthuyText = [
            'kim' => 'Hôm nay đá thạch anh tóc trắng có nguồn năng lượng cực mạnh do thiên nhiên tạo hóa và hấp thụ linh khí tinh hoa của trời đất, nên giúp người sở hữu vượng về tài lộc, may mắn. Ngoài ra nó còn giúp người đeo giảm căng thẳng, mệt mỏi từ đó công việc thuận lợi, vận mệnh hanh thông.',

            'thuy' => 'Hôm nay quý gia chủ nên dùng đá thạch anh tóc đen, giúp cho sức khỏe, thần thái và tư duy được hanh thông, xua tan tà khí, tránh tà thuật và bùa ngải. Ngoài ra quý gia chủ còn nhận được sự bình an, hạnh phúc viên mãn, phúc khang an thái, đắc tài sai lộc.',

            'moc' => 'Hôm nay đá thạch anh tóc xanh sẽ giúp quý gia chủ có nguồn năng lượng vượng khí, sảng khoái. Giảm lo âu, mệt mỏi, căng thẳng, mất ngủ, trầm cảm. Từ đó giúp tinh thần luôn lạc quan, tâm an trí vững, may mắn hanh thông.',

            'hoa' => 'Hôm nay đá thạch anh tóc đỏ tăng khả năng tăng cường hệ thống miễn dịch giúp cải thiện chứng đau đầu, trầm cảm, mệt mỏi. Ngoài ra nó còn làm giảm cơn đau xương khớp, đau dạ dày, xua tan tà khí, đón những trường khí vượng giúp gia chủ đắc sinh khí – vượng thiên y – tọa tài lộc.',

            'tho' => 'Hôm nay thạch anh tóc vàng giúp quý gia chủ giảm stress, thêm sự quyết đoán, ý chí mạnh mẽ, giải tỏa căng thẳng, lưu thông khí huyết. Giúp ích cho việc phát triển bản thân, công việc dễ đạt được thành công như mong muốn, vạn sự hanh thông quang đạt.',
        ];
        $giaChu['tuoi_hop'] = 'Nếu quý gia chủ gặp gỡ hay giao tiếp với những người tuổi ' . $nguoiHopTac[$tuTruGiaChu->chiNamSlug] . ' sẽ dễ gặp nhiều điều hanh thông, may mắn';
        $giaChu['tuoi_khong_hop'] = 'Nếu quý gia chủ gặp gỡ hay giao tiếp với những người tuổi ' . $nguoiXung[$tuTruGiaChu->chiNamSlug] . ' sẽ dễ gặp nhiều điều không như mong, dễ va chạm, hoặc gặp những thị phi, phiền toái, làm ăn không hợp...';
        $giaChu['mau_sac_trang_phuc_vppt'] = [
            'text' => 'Sau khi xét sinh trợ tiết hao giữa bản mệnh và ngày, những vật phẩm ' . $tuTruNgay->convertSlugToText($nguHanhMayMan) . ' sẽ giúp quý anh chị hoá hung thành cát, giảm được tai ương, hoạn nạn. Và thêm phần may mắn hanh thông.',
            'image' => get_stylesheet_directory_uri() . '/images/da/' . $nguHanhMayMan . '.png',
            'values' => $phongthuyText[$nguHanhMayMan]
        ];

        $ngayCanChi = $tuTruNgay->canNgayText . ' ' . $tuTruNgay->chiNgayText;

        $hourArr = [];
        foreach (Constants::$gioDataChi as $key => $val) {
            if (strtolower($tuTruNgay->chiNgayText) == strtolower($val[0])) {
                $hourArr = $val;
                break;
            }
        }
        $hourArrInfo = [];
        $arrChiSlug = array_map('khongdau', Constants::$chiArr); // loai bo dau
        if (!empty($hourArr)) {
            unset($hourArr[0]);
            for ($i = 1; $i <= 12; $i++) {
                $slug = khongdau(($hourArr[$i]));
                $index = array_search($slug, $arrChiSlug);
                $key = Constants::$gioData[$i]['hd'] ? 'hoang_dao' : 'hac_dao';
                $hourArrInfo[$key][] = [
                    'hour_name' => $hourArr[$i],
                    'hour_zodiac' => ($index * 2 + 23) % 24 . 'h-' . (($index * 2 + 1) % 24) . 'h',
                    'hour_info' => Constants::$gioData[$i]];
            }
        }

        //echo $helper->jdToDateTEXT($ngayJulius);die;
        $thangAm = (int) $tuTruNgay->ngaythangAm[1];
        $ngayAm = (int) $tuTruNgay->ngaythangAm[0];
        $ngayHoangDaoThang = isset(Constants::$ngayHoangDao[$thangAm]) ? array_map('khongdau', Constants::$ngayHoangDao[$thangAm]) : [];
        $ngayHacDaoThang = isset(Constants::$ngayHacDao[$thangAm]) ? array_map('khongdau', Constants::$ngayHacDao[$thangAm]) : [];
        $hoangDao = $hacDao = '';
        if (array_search(khongdau($tuTruNgay->chiNgayText), $ngayHoangDaoThang) !== false) {
            $hoangDao = 'Hoàng đạo';
        }
        if (array_search(khongdau($tuTruNgay->chiNgayText), $ngayHacDaoThang) !== false) {
            $hacDao = 'Hắc đạo';
        }
        $gioHoangDao = $gioHacDao = [];
        foreach ($hourArrInfo['hoang_dao'] as $hr) {
            $gioHoangDao[] = $hr['hour_name'] . '(' . $hr['hour_zodiac'] . ')';
        }
        foreach ($hourArrInfo['hac_dao'] as $hr) {
            $gioHacDao[] = $hr['hour_name'] . '(' . $hr['hour_zodiac'] . ')';
        }

        $kinhDoMatTroi = round($helper->KinhDoMatTroi(23, 59, $day, $month, $year), 2);
        $kt = $helper->getKDIndex(Constants::$matTroi, $kinhDoMatTroi);

        $ngayCanchiSlug = $tuTruNgay->canNgaySlug . '-' . $tuTruNgay->chiNgaySlug;
        $ngayInfo = Constants::$ngayInfoArr[$ngayCanchiSlug];

        $saoTotArr = [];
        foreach (Constants::$saoTot as $sao) {
            $key = khongdau($sao['thutu'][$thangAm]);
            if (in_array($key, [$tuTruNgay->canNgaySlug, $tuTruNgay->chiNgaySlug, $ngayCanchiSlug])) {
                $saoTotArr[] = $sao['ten'] . ': ' . $sao['tinhchat'];
            }
        }
        $saoXauArr = [];
        foreach (Constants::$saoXau as $sao) {
            $key = khongdau($sao['thutu'][$thangAm]);
            if (in_array($key, [$tuTruNgay->canNgaySlug, $tuTruNgay->chiNgaySlug, $ngayCanchiSlug])) {
                $saoXauArr[] = $sao['ten'] . ': ' . $sao['tinhchat'];
            }
        }
        $ngayXuatHanh = [];
        foreach (Constants::$ngayXuatHanh as $ngay) {
            if (in_array($thangAm, $ngay['thang']) && in_array($ngayAm, $ngay['ngay'])) {
                $ngayXuatHanh = $ngay;
                break;
            }
        }
        $gioXuatHanh = $helper->tinhGioXuatHanh($ngayAm, $thangAm);

        $dongCong = Constants::$dongCong[$thangAm][$tuTruNgay->chiNgaySlug];
	    $thangAm = $helper->Thang($day, $month, $year, $timezone);
	    $ngayJulius = $helper->jdFromDate($day, $month, $year);
	    $indexNgayChi = ($ngayJulius + 1) % 12;
	    $ngayChi = isset(Constants::$canchi[$indexNgayChi]['chi']) ? Constants::$canchi[$indexNgayChi]['chi'] : '';
	    $ngayChi = str_replace(['Tý', 'tý', 'TÝ'], ['ti', 'ti', 'ti'], $ngayChi);
	    $ngayChiSlug = khongdau($ngayChi);
	    $thangAmTruc = Constants::$thangAmTruc[$thangAm];
	    $chiIndex = array_search($ngayChiSlug, $thangAmTruc);
	    $trucInfo = Constants::$trucArr[$chiIndex];
        //$tru = Constants::$truArr[$tuTruNgay->chiNgaySlug];

        $namAmLichNgay = 'Năm ' . $tuTruNgay->canNamText . ' ' . $tuTruNgay->chiNamText . ', tháng ' . $tuTruNgay->canThangText . ' ' . $tuTruNgay->chiThangText . ', ngày ' . $tuTruNgay->canNgayText . ' ' . $tuTruNgay->chiNgayText;

        $ngocHap = '';
        foreach (Constants::$menh as $menh) {
            $canchi = khongdau($menh['ten']);
            if ($canchi == $ngayCanchiSlug) {
                $ngocHap = $menh;
                break;
            }
        }

        $gioXauTot = [];
        foreach ($gioXuatHanh as $gioXh) {
            $gioXauTot[khongdau($gioXh['status'])][] = $gioXh['name'] . '(' . $gioXh['canh'] . ')';
        }

        $giaChu['gio_tot'] = 'Giờ tốt: Hôm nay quý gia chủ có thể xem xét những giờ tốt này theo lục nhâm thuần phong để gặp được nhiều may mắn hanh thông: ' . implode(', ', $gioXauTot['tot']) . '. Nếu quý gia chủ không thể theo những giờ trên thì bắt đầu đi hay làm thì nên chọn trang phục hoặc vật phẩm trợ mệnh thuộc ngũ hành ('.$tuTruGiaChu->convertSlugToText($dungThan).', '.$tuTruGiaChu->convertSlugToText($hyThan).') để tránh tai ương.';

		$textHuongHung = !empty($ngayInfo['hacthan_huonghung']) && $ngayInfo['hacthan_huonghung'] != 'Tại Thiên' ? 'Hôm nay quý gia chủ không nên đi về hướng: ' . $ngayInfo['hacthan_huonghung'] . ' vì theo thuật toán hướng này thuộc hung tinh, dễ gặp những chuyện không như mong muốn. ' : '';

        $giaChu['tranh_xui'] = [
	        $textHuongHung. 'Quý gia chủ nên chọn trang phục và vật phẩm ngũ hành ' . $tuTruNgay->convertSlugToText($nguHanhMayMan) . ' để thêm phần loại bỏ đi chuyện xui xẻo không đáng sẩy ra. Đồng thời quý gia chủ khi làm việc lớn nên tránh khung giờ ' . implode(', ', $gioHacDao) . ' để tránh chuyện thị phi giúp cho công việc được hanh thông. Và cần chú ý tới những tuổi có địa chi là ' . implode(', ', $ngayInfo['tuoixung']) . '. Nên cẩn trọng với những gia chủ có địa chị này để tránh những chuyện không đáng xảy ra.'
        ];
        $giaChu['viec_nen_lam'] = 'Hôm nay quý gia chủ nên đi về hướng: ' . mb_strtoupper($ngayInfo['taithan']) . ' vì theo thuật toán hướng này thuộc cát tinh, dễ gặp những điều may mắn. Và quý gia chủ nên sử dụng màu ' . $tuTruNgay->convertSlugToText($nguHanhMayMan) . ' để thêm năng lượng cát lành bổ trợ cho chân mệnh. Đồng thời quý gia chủ khi làm việc lớn nên chọn khung giờ ' . implode(', ', $gioHoangDao) . ' để tránh chuyện thị phi giúp cho công việc được hanh thông. Và kết hợp với các tuổi có địa chi là ' . $nguoiHopTac[$tuTruGiaChu->chiNamSlug] . ' những gia chủ này có thể là quý nhân trong ngày hôm nay của gia chủ.';

        $results['co_ban'][3] = [
            'title' => 'Thông tin cơ bản hôm nay',
            'data' => [
                'duong_lich' => \Laven\Helpers\Helpers::convertDayVn($tuTruNgay->namDuong . '-' . $tuTruNgay->thangDuong . '-' . $tuTruNgay->ngayDuong) . ', ngày ' . $tuTruNgay->ngayDuong . '/' . $tuTruNgay->thangDuong . '/' . $tuTruNgay->namDuong,
                'am_lich' => $namAmLichNgay,
                'ngay_duong' => $tuTruNgay->ngayDuong . '/' . $tuTruNgay->thangDuong . '/' . $tuTruNgay->namDuong,
                'ngay_am' => $tuTruNgay->ngaythangAm[0] . '/' . $tuTruNgay->ngaythangAm[1] . '/' . $tuTruNgay->ngaythangAm[2],
                'menh_ngay' => $ngocHap['diengiai'],
                'mat_troi' => $kt,
                'hoang_dao' => [
                    'name' => 'Hoàng đạo',
                    'values' => $gioHoangDao,
                ],
                'hac_dao' => [
                    'name' => 'Hắc đạo',
                    'values' => $gioHacDao,
                ],
                'nen_lam' => $trucInfo['nen_lam'],
                'khong_nen_lam' => $trucInfo['kieng'],
                'tuoi_xung' => $ngayInfo['tuoixung'],
                'han_chan_ngoc_hap' => [
                    'name' => 'Hán Chân Quân Ngọc Hạp',
                    'y_nghia' => isset($ngocHap['ynghia']) ? $ngocHap['ynghia'] : ''
                ],
//                'ngu_hanh_thien_can_dia_chi' => [
//                    'name' => 'NGŨ HÀNH CỦA THIÊN CAN - ĐỊA CHI',
//                    'thien_can' => $tuTruNgay->canInfo['ngay']['title'],
//                    'dia_chi' => $tuTruNgay->chiInfo['ngay']['title'],
//                    'values' => $this->thienCanDiachi($tuTruNgay->canInfo['ngay']['name'], $tuTruNgay->chiInfo['ngay']['name'])
//                ],
                'sao' => [
                    'tot' => $saoTotArr,
                    'xau' => $saoXauArr
                ],
//                'khong_minh' => [
//                    'name' => 'Theo Khổng Minh',
//                    'data' => [
//                        'name' => isset($ngayXuatHanh['name']) ? $ngayXuatHanh['name'] : null,
//                        "y_nghia" => $ngayXuatHanh['ynghia'],
//                        'status' => $ngayXuatHanh['stt']
//                    ]
//                ],
//                'ly_thuan_phong' => [
//                    [
//                        'name' => 'Theo Lý Thuần Phong',
//                        'data' => $gioXuatHanh
//                    ]
//                ],
                //'con_nuoc' => $this->tinhConNuoc($tuTruNgay->ngaythangAm[0]),
            ],
        ];
        $cungMenhSlug = khongdau($cungMenhThaiNguyen['cung_menh']['chi']);
        $results['co_ban'][4] = $this->luanGiaiCungMenh($cungMenhSlug);
        $results['luan_giai'][1] = [
            'title' => 'Tiết khí',
            'data' => $kt['tiet'],
        ];
        $results['luan_giai'][2] = [
            'title' => 'Giờ xuất hành theo Lục Nhâm Thuần Phong',
            'data' => $gioXuatHanh,
        ];
        $results['luan_giai'][3] = [
            'title' => 'Lịch xuất hành theo Khổng Minh',
            'data' => [
                'name' => isset($ngayXuatHanh['name']) ? $ngayXuatHanh['name'] : null,
                "y_nghia" => $ngayXuatHanh['ynghia'],
                'status' => $ngayXuatHanh['stt']
            ],
        ];
        $results['luan_giai'][4] = [
            'title' => 'Hướng xuất hành',
            'data' => [
                'tai_than' => [
                    'name' => 'Tài thần',
                    'values' => $ngayInfo['taithan'],
                ],
                'hac_than' => [
                    'name' => 'Hạc thần (Hướng Hung)',
                    'values' => $ngayInfo['hacthan_huonghung'],
                ],
                'khong_vong' => [
                    'name' => 'Không vong (Giờ Hung)',
                    'values' => $ngayInfo['khongvong_gio_hung'],
                ],
                'gio_kiet' => [
                    'name' => 'Giờ Kiết',
                    'values' => $ngayInfo['giokiet'],
                ],
            ],
        ];
        $results['luan_giai'][5] = [
            'title' => 'Con số may mắn của bạn hôm nay là gì?',
            'data' => $giaChu['so_may_man'],
        ];
        $results['luan_giai'][6]['title'] = 'Sức khỏe, công việc, tình duyên, gia đạo, tài lộc';
        if (!empty($giaChu['tai_loc'])) {
            $results['luan_giai'][6]['data'][] = [
                'name' => 'Tài lộc',
                'values' => $giaChu['tai_loc'],
            ];
        }
        if (!empty($giaChu['gia_dao'])) {
            $results['luan_giai'][6]['data'][] = [
                'name' => 'Gia đạo',
                'values' => $giaChu['gia_dao'],
            ];
        }
        if (!empty($giaChu['tinh_duyen'])) {
            $results['luan_giai'][6]['data'][] = [
                'name' => 'Tình duyên',
                'values' => $giaChu['tinh_duyen'],
            ];
        }
        if (!empty($giaChu['suc_khoe'])) {
            $results['luan_giai'][6]['data'][] = [
                'name' => 'Sức khỏe',
                'values' => $giaChu['suc_khoe'],
            ];
        }
        if (!empty($giaChu['cong_viec'])) {
            $results['luan_giai'][6]['data'][] = [
                'name' => 'Công việc',
                'values' => $giaChu['cong_viec'],
            ];
        }
        
        $results['luan_giai'][7] = [
            'title' => 'Hôm nay hợp hay xung với tuổi của bạn',
            'data' => $giaChu['huong'],
        ];
        $results['luan_giai'][8] = [
            'title' => 'Hôm nay tuổi có phạm kỵ gì không',
            'data' => [
                'thu_tu_sat_chu' => $this->thuTuSatChu($tuTruNgay),
                'ngay_sat' => $this->tinhNgaySat($tuTruNgay, $tuTruGiaChu),
                'thai_tue' => $this->tinhThaiTue($tuTruNgay, $tuTruGiaChu),
            ],
        ];
        $results['luan_giai'][9] = [
            'title' => 'Hôm nay hợp hay xung với tuổi của bạn',
            'data' => [
                'may_man' => $giaChu['tuoi_hop'],
                'xui' => $giaChu['tuoi_khong_hop'],
            ],
        ];
        $results['luan_giai'][10] = [
            'title' => 'Hôm nay xuất hành như thế nào?',
            'data' => [
                [
                    'name' => 'Hướng tốt',
                    'values' => 'Hướng tốt: Hôm nay quý gia chủ xuất hành theo những phương vị này sẽ gặp nhiều may mắn hanh thông: (' . $ngayInfo['hythan'] . ', ' . $ngayInfo['taithan'] . '). Nếu khi ra đường quý gia chủ không thể đi theo những hướng trên thì tiến một bước xong lùi ba bước và đi thẳng theo hướng đó để tránh tai ương.'
                ],
                [
                    'name' => 'Giờ tốt',
                    'values' => $giaChu['gio_tot']
                ],
            ],
        ];
        $results['luan_giai'][11] = [
            'title' => 'Hôm nay nên kiêng gì? Nên làm gì?',
            'data' => [
                [
                    'name' => 'Kiêng gì để tránh xui',
                    'values' => $giaChu['tranh_xui'],
                ],
                [
                    'name' => 'Nên làm gì để lấy may',
                    'values' => $giaChu['viec_nen_lam']
                ]
            ],
        ];
        $results['luan_giai'][12] = [
            'title' => 'Món ăn & đồ uống',
            'data' => $giaChu['an_uong'],
        ];
        $results['luan_giai'][13] = [
            'title' => 'Màu sắc, Trang phục và vật phẩm phong thuỷ',
            'data' => $giaChu['mau_sac_trang_phuc_vppt'],
        ];

        $results['background'] = $background;

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
        if ($tuTruGiaChu->chiNamSlug == $lasoTuTruNgay->diaChiHinh[$chiNam]) {
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
