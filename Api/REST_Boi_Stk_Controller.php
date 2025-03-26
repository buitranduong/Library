<?php

namespace AnChoi;

use Laven\Timstk;
use Laven\TinhDiemSim;

class REST_Boi_Stk_Controller {

	// Here initialize our namespace and resource name.
	public $namespace;

	public $resource_name;

	public $schema;

	public function __construct () {
		$this->namespace     = '/sim-phong-thuy/v1';
		$this->resource_name = 'boi-stk';
	}

	// Register our routes.
	public function register_routes () {
		register_rest_route($this->namespace, '/' . $this->resource_name, array(
			// Here we register the readable endpoint for collections.
			array(
				'methods'  => 'GET',
				'callback' => [
					$this,
					'boi_stk',
				],
				'args'     => [
					'dob'    => [
						'required'          => true,
						'validate_callback' => function($param, $request, $key) {
							$dateOfBirthExploded = explode("-", $param);
							if (count($dateOfBirthExploded) != 3) {
								return false;
							}
							$date  = (1 <= $dateOfBirthExploded[0]) && ($dateOfBirthExploded[0] <= 31);
							$month = (1 <= $dateOfBirthExploded[1]) && ($dateOfBirthExploded[1] <= 12);
							$year  = (1900 <= $dateOfBirthExploded[2]) && ($dateOfBirthExploded[2] <= 2022);
							return $date && $month && $year;
						},
					],
					'hob'    => [
						'required'          => true,
						'validate_callback' => function($param, $request, $key) {
							return is_numeric($param) && ($param >= 0 && $param <= 23);
						},
					],
					'mob'    => [
						'required'          => true,
						'validate_callback' => function($param, $request, $key) {
							return is_numeric($param) && ($param >= 0 && $param <= 59);
						},
					],
					'stk'  => [
						'required'          => true,
					],
					'gender' => [
						'required'          => true,
						'validate_callback' => function($param, $request, $key) {
							return is_numeric($param) && ($param >= 0 && $param <= 1);
						},
					],
				],
				/*'permission_callback' => array(
					$this,
					'get_items_permissions_check',
				),*/
			),
			// Register our schema callback.
			'schema' => array(
				$this,
				'get_item_schema',
			),
		));
	}

	public function boi_stk ($data) {
		$params                 = $data->get_params();
		$dateOfBirthExploded    = explode("-", $params['dob']);
		$gioSinh                = $params['hob'];
		$phutSinh               = $params['mob'];
		$gioiTinhVal            = $params['gender'];
		$soDienThoai            = strip_tags($params['stk']);
		$ngaySinh               = $dateOfBirthExploded[0];
		$thangSinh              = $dateOfBirthExploded[1];
		$namSinh                = $dateOfBirthExploded[2];
		$ngaysinhFull           = $ngaySinh . '-' . $thangSinh . '-' . $namSinh;
		$tuTru                  = new \Laven\LasoTutru($ngaysinhFull, $gioSinh, $phutSinh, $gioiTinhVal, 7, 'Vô danh khách');
		$batTu                  = $tuTru->tinhBatTu();
		$tietKhi                = $tuTru->getTietKhiHienTai();
		$cungMenhThaiNguyen     = $tuTru->tinhCungMenhThaiNguyen();
		$chuTinh                = $tuTru->tinhChuTinh();
		$canTang                = $tuTru->tinhCanTang();
		$nhatKien               = $tuTru->tinhNhatKien();
		$nguyetKien             = $tuTru->tinhNguyetKien();
		$vtsTru                 = $tuTru->vongTrangSinhTru();
		$daiVan                 = $tuTru->tinhDaiVan();
		$daiVanList             = $tuTru->tinhDaiVanTieuVan();
		$napAm                  = $tuTru->tinhNapAm();
		$render                 = true;
		$nguHanhThaiNguyen      = $tuTru->tinhNapAmThaiNguyen($cungMenhThaiNguyen['thai_nguyen']['can'] . $cungMenhThaiNguyen['thai_nguyen']['chi']);
		$lasoInfo               = [];
		$namAmLich              = 'Năm ' . $tuTru->canNamText . ' ' . $tuTru->chiNamText . ', tháng ' . $tuTru->canThangText . ' ' . $tuTru->chiThangText . ', ngày ' . $tuTru->canNgayText . ' ' . $tuTru->chiNgayText . ', giờ ' . $tuTru->canGioText . ' ' . $tuTru->chiGioText;
		$doVuong                = $tuTru->tinhDoVuong();
		$doVuongSuy             = $tuTru->tinhDoVuongSuy($doVuong);
		$total                  = array_sum($doVuongSuy['total']);
		$soNguHanh              = floor($total * 0.4);
		$dungThan               = $hyThan = $banMenhText = '';
		$lasoInfo               = [];
		$lasoInfo['chuTinh']    = $chuTinh;
		$lasoInfo['canTang']    = $canTang;
		$lasoInfo['nhatKien']   = $nhatKien;
		$lasoInfo['nguyetKien'] = $nguyetKien;
		$lasoInfo['napAm']      = $napAm;
		$thanNhuoc              = false;
		if ($doVuongSuy['cung_phe'] >= $soNguHanh) {
			$banMenhText = 'Vượng <span class="' . $doVuongSuy['ban_menh']['name'] . '">' . $doVuongSuy['ban_menh']['title'] . '</span>';
			$dungThan    = $doVuongSuy['ban_menh']['dung_than'];
			$hyThan      = $doVuongSuy['ban_menh']['hy_than'];			
		}
		if ($doVuongSuy['cung_phe'] < $soNguHanh) {
			$banMenhText = 'Nhược <span class="' . $doVuongSuy['ban_menh']['name'] . '">' . $doVuongSuy['ban_menh']['title'] . '</span>';
			$dungThan    = $doVuongSuy['ban_menh']['dung_than_2'];
			$hyThan      = $doVuongSuy['ban_menh']['hy_than_2'];
			$thanNhuoc   = true;
		}
		$doVuongSuy['ban_menh']['hy_than_text'] = $tuTru->convertSlugToText($doVuongSuy['ban_menh']['hy_than']);
		$doVuongSuy['ban_menh']['dung_than_text'] = $tuTru->convertSlugToText($doVuongSuy['ban_menh']['dung_than']);
		$dungThanId       = $tuTru->getNguHanhId($dungThan);
		$hyThanId         = $tuTru->getNguHanhId($hyThan);
		$diem             = 0;
		$nguHanhBanMenh   = $doVuongSuy['ban_menh']['name'];
		$menhChuGiaiNghia = '';
		if (!$thanNhuoc) { // vượng
			if ($nguHanhBanMenh == 'kim') {
				$menhChuGiaiNghia = '<p>Mệnh này dễ có tính Độc đoán, cương quyết, dốc lòng để đạt được mục tiêu, có sự Tổ chức giỏi, quyết đoán, nhưng có thể kém linh động, trong cuộc sống cũng như công việc rất nghiêm túc và không dễ nhận sự giúp đỡ, tính cách mạnh mẽ, cứng nhắc, nội tâm hay sầu muộn. Đôi lúc rất Bướng bỉnh, nhất bét, cứng ngoài mềm trong. Mệnh này muốn tốt lên dùng Số Tài khoản hoặc những vật phẩm phong thủy có ngũ hành thuộc HỎA hoặc THỦY để trợ mệnh giúp mệnh có sự cân bằng để phát triển. Cộng thêm phương vị và nghành nghề, nỗ lực dưỡng ưu sửa khuyết, tâm an trí vững để vận thông.</p>';
			}
			if ($nguHanhBanMenh == 'thuy') {
				$menhChuGiaiNghia = '<p>Mệnh này có trí thông minh, tháo vát, nhưng đôi lúc dễ xảo quyệt, có cuộc sống phức tạp. đời sống tình cảm phong phú, nhiều ước mơ nên mục tiêu dễ cả thèm chóng chán. Làm gần được lại mất do bỏ qua. Dễ bao la bồng bềnh, nhưng năm suy càng làm càng mất do tính cách và tư duy, như dòng nước lũ quẩn chôi mọi thứ. Mệnh này muốn tốt lên dùng Số Tài khoản hoặc những vật phẩm phong thủy có ngũ hành thuộc THỔ hoặc MỘC để trợ mệnh giúp mệnh có sự cân bằng để phát triển. Cộng thêm phương vị và nghành nghề, nỗ lực dưỡng ưu sửa khuyết, tâm an trí vững để vận thông.</p>';
			}
			if ($nguHanhBanMenh == 'moc') {
				$menhChuGiaiNghia = '<p>Mệnh này dễ cố chấp, bảo thủ, cứng rắn, đã quyết việc gì là không từ bỏ, tham vọng, nóng giận vội vàng, nói xong mới nghĩ hay bị mất lòng, làm ăn không lắm bắt được cơ hội, khái tính, sinh sôi nhiều nhưng yếu, ví như 1 m2 trồng 1 cây là đủ, đây lại trồng tận 10 cây. Mệnh này muốn tốt lên dùng Số Tài khoản hoặc những vật phẩm phong thủy có ngũ hành thuộc THỦY hoặc KIM để trợ mệnh giúp mệnh có sự cân bằng để phát triển. Cộng thêm phương vị và nghành nghề, nỗ lực dưỡng ưu sửa khuyết, tâm an trí vững để vận thông.</p>';
			}
			if ($nguHanhBanMenh == 'hoa') {
				$menhChuGiaiNghia = '<p>Mệnh này dễ nói là làm khái tính, quy tắc, không nhất thì bét luôn sẵn lòng chấp nhận rủi ro, dấn thân và mạo hiểm. Chủ động và tham vọng. thẳng thắn, bộc trực và thật thà. Không nói dối, khô khan dễ nóng vội, thẳng thắn, thô thẳng thật, sáng tạo, nhưng dễ bốc đồng, chí mạnh mẽ, kiên cường, luôn tràn đầy năng lượng.Cũng do đó nếu thân vượng hỏa quá thì nhưng đức tính đó cũng sẽ hại họ, dấn thân và mạo hiểm, khô khan dễ nóng vội, thẳng thắn, thô thẳng thật, dễ bốc đồng. Nên gần được lại mất vì cái tôi mà bỏ qua cơ hội, cũng vẫn biết không nên nhưng vẫn có làm, bảo thủ gia trưởng. Mệnh này muốn tốt lên dùng Số Tài khoản hoặc những vật phẩm phong thủy có ngũ hành thuộc THỦY hoặc THỔ để trợ mệnh giúp mệnh có sự cân bằng để phát triển. Cộng thêm phương vị và nghành nghề, nỗ lực dưỡng ưu sửa khuyết, tâm an trí vững để vận thông.</p>';
			}
			if ($nguHanhBanMenh == 'tho') {
				$menhChuGiaiNghia = '<p>Mệnh này dễ Có cái tôi, tự trọng, tự ái, tinh thần vững chắc. Thành chậm chạp, ỉ lại, trì trệ, bảo thủ cố chấp, khô cằn và cô quạnh, nhu nhược, 
hay bỏ qua cơ hội và tư duy quá suy tư, Mệnh này muốn tốt lên dùng Số Tài khoản hoặc những vật phẩm phong thủy có ngũ hành thuộc MỘC hoặc KIM để trợ mệnh giúp mệnh có sự cân bằng để phát triển. Cộng thêm phương vị và nghành nghề, nỗ lực dưỡng ưu sửa khuyết, tâm an trí vững để vận thông.</p>';
			}
		} else {
			if ($nguHanhBanMenh == 'kim') {
				$menhChuGiaiNghia = '<p>Mệnh này dễ Mền yếu, nhiều khi hay cà nể thành nhu nhược, xong cái gì cũng từ từ thành ỉ lại, khi gặp khó khăn thì dễ nhanh nản trí, cũng hay có tính dụt dè, lúc vui vượng thế cũng linh động nhưng hiệu quả hơi thấp chính vì vậy, Mệnh này muốn tốt lên dùng Số Tài khoản hoặc những vật phẩm phong thủy có ngũ hành thuộc KIM hoặc THỔ để trợ mệnh giúp mệnh có sự cân bằng để phát triển. Cộng thêm phương vị và nghành nghề, nỗ lực dưỡng ưu sửa khuyết, tâm an trí vững để vận thông.</p>';
			}
			if ($nguHanhBanMenh == 'thuy') {
				$menhChuGiaiNghia = '<p>Mệnh này dễ có tư duy chậm chạp, đời sống khô cằn, trí nhớ khá kém, hay vội vàng thiếu sự cận thận, hay qua loa, dễ buông xuôi, đôi lúc có tất xấu dễ nham hiểm, và khi gặp sự cố dễ hay mất bình tĩnh. Đôi lúc khi bị dồn vào đường cùng hay có tâm địa xấu sẽ rất mưu mô, nhưng sau khi có lại công tâm trả lại những gì bản thân đã làm sai, và thích tranh giành quyền lực, và kết quả không được gi? Mệnh này muốn tốt lên dùng Số Tài khoản hoặc những vật phẩm phong thủy có ngũ hành thuộc THỦY hoặc KIM để trợ mệnh giúp mệnh có sự cân bằng để phát triển. Cộng thêm phương vị và nghành nghề, nỗ lực dưỡng ưu sửa khuyết, tâm an trí vững để vận thông.</p>';
			}
			if ($nguHanhBanMenh == 'moc') {
				$menhChuGiaiNghia = '<p>Mệnh này dễ Thiếu sự phát triểm và nghị lực, gắp khó khăn lùi bước, ý chí kém, vội vàng và buông xuôi, cuộc sống mất phương hướng và định hướng. Mệnh này muốn tốt lên dùng Số Tài khoản hoặc những vật phẩm phong thủy có ngũ hành thuộc MỘC hoặc THỦY để trợ mệnh giúp mệnh có sự cân bằng để phát triển. Cộng thêm phương vị và nghành nghề, nỗ lực dưỡng ưu sửa khuyết, tâm an trí vững để vận thông.</p>';
			}
			if ($nguHanhBanMenh == 'hoa') {
				$menhChuGiaiNghia = '<p>Mệnh này dễ Thiếu sự quyết đoán, trần trừ, nhút nhát, chậm chạp, suy nghĩ thấu đáo tới mức cơ hội qua mới có quyết định, thiếu sự chủ động nhu nhược. Mệnh này muốn tốt lên dùng Số Tài khoản hoặc những vật phẩm phong thủy có ngũ hành thuộc HỎA hoặc MỘC để trợ mệnh giúp mệnh có sự cân bằng để phát triển. Cộng thêm phương vị và nghành nghề, nỗ lực dưỡng ưu sửa khuyết, tâm an trí vững để vận thông.</p>';
			}
			if ($nguHanhBanMenh == 'tho') {
				$menhChuGiaiNghia = '<p>Mệnh này Dễ lay động, không có sự quyết đoán do dự và tự ti, bảo thủ, nhu nhược, thiếu chứng kiếm, nửa vời cả thèm chóng chán, không có lập trường. Mệnh này muốn tốt lên dùng Số Tài khoản hoặc những vật phẩm phong thủy có ngũ hành thuộc THỔ hoặc HỎA để trợ mệnh giúp mệnh có sự cân bằng để phát triển. Cộng thêm phương vị và nghành nghề, nỗ lực dưỡng ưu sửa khuyết, tâm an trí vững để vận thông.</p>';
			}
		}
		$tinhDiemSim        = new TinhDiemSim($soDienThoai, $dungThanId, $hyThanId);
		$doVuongSim         = $tinhDiemSim->tinhDoVuongSim();
		$simKhiThienMenhSim = '';
		if ($doVuongSim['ngu_hanh_sim']['id'] == $dungThanId) {
			$diem += 5;
		} elseif ($doVuongSim['ngu_hanh_sim']['id'] == $hyThanId) {
			$diem += 4;
		}
		if ($doVuongSim['ngu_hanh_sim']['slug'] == 'kim') {
			$simKhiThienMenhSim = '<p>-Số Tài Khoản mệnh KIM dùng cho chủ sự có dụng thần hoặc hỷ thần là KIM. (chủ sự thân vượng là MỘC – hoặc THỔ và dùng cho chủ sự khuyết nhược KIM)</p>';
		}
		if ($doVuongSim['ngu_hanh_sim']['slug'] == 'thuy') {
			$simKhiThienMenhSim = '<p>-Số Tài Khoản mệnh THỦY dùng cho chủ sự có dụng thần hoặc hỷ thần là THỦY. (chủ sự thân vượng là HỎA – hoặc KIM và dùng cho chủ sự khuyết nhược THỦY)</p>';
		}
		if ($doVuongSim['ngu_hanh_sim']['slug'] == 'moc') {
			$simKhiThienMenhSim = '<p>-Số Tài Khoản mệnh MỘC dùng cho chủ sự có dụng thần hoặc hỷ thần là MỘC. (chủ sự thân vượng là THỔ – hoặc THỦY và dùng cho chủ sự khuyết nhược MỘC)</p>';
		}
		if ($doVuongSim['ngu_hanh_sim']['slug'] == 'hoa') {
			$simKhiThienMenhSim = '<p>-Số Tài Khoản mệnh HỎA dùng cho chủ sự có dụng thần hoặc hỷ thần là HỎA. (chủ sự thân vượng là KIM – hoặc MỘC và dùng cho chủ sự khuyết nhược HỎA)</p>';
		}
		if ($doVuongSim['ngu_hanh_sim']['slug'] == 'tho') {
			$simKhiThienMenhSim = '<p>-Số Tài Khoản mệnh THỔ dùng cho chủ sự có dụng thần hoặc hỷ thần là THỔ. (chủ sự thân vượng là THỦY – hoặc HỎA và dùng cho chủ sự khuyết nhược THỔ)</p>';
		}
		$duNien          = $tinhDiemSim->tinhDuNien();
		$diem            += $duNien['diem'];
		$duNienText      = "Số Tài Khoản của bạn có " . $duNien['total'] . " cặp số " . ($duNien['total'] > 0 ? '(' . implode(', ', $duNien['cap_so']) . ')' : '' . " thuộc du niên");
		$duNienGiaiNghia = '';
		if (in_array('sinh_thien_dien', $duNien['title'])) {
			$duNienGiaiNghia .= "<p>- Số Tài khoản này có chứa những cặp số thuộc Năng lượng Sinh Diên Niên, nên mệnh Số Tài khoản được Đắc đại cát, ngoài việc bổ trợ về kinh doanh phát đạt và có những mối quan hệ cát lành, thì năg lượng sinh diên niên còn hóa giải được những chủ sự phạm phải ngũ quỷ trong bát trạch, kết hôn, số CMTND số nhà, số xe bị phạm ngũ quỷ.</p>";
		}
		if (in_array('sinh_dien', $duNien['title']) || in_array('sinh_sinh', $duNien['title']) || in_array('sinh_phuc', $duNien['title'])) {
			$duNienGiaiNghia .= '<p>- Số Tài khoản này có chứa những cặp số thuộc Năng lượng Sinh Diên, nên mệnh Số Tài khoản được Đắc đại cát, ngoài việc bổ trợ về kinh doanh phát đạt và có những mối quan hệ cát lành, thì năg lượng sinh diên còn hóa giải được, những chủ sự phạm phải họa hại (thị phi phiền toái) trong bát trạch, kết hôn, số CMTND số nhà, số xe bị phạm họa hại (thị phi phiền toái).</p>';
		}
		if (in_array('sinh_khi', $duNien['title'])) {
			$duNienGiaiNghia .= '<p>- Số Tài khoản này có chứa những cặp số thuộc năng lượng sinh khí, nên mệnh Số Tài khoản được Đắc Sinh Khí bảo trợ Sức khỏe, Thúc đẩy quan hệ hợp tác, gặp gỡ được Qúy nhân.</p>';
		}
		if (in_array('dien_nien', $duNien['title'])) {
			$duNienGiaiNghia .= '<p>- Số Tài khoản này có chứa những cặp số thuộc năng lượng sinh khí, nên mệnh Số Tài khoản được Tọa Phúc Đức Ân Duệ thúc đẩy Công danh để Thăng quan tiến chức, tinh thần thoải mái và gia đạo được êm ấm.</p>';
		}
		if (in_array('thien_y', $duNien['title'])) {
			$duNienGiaiNghia .= '<p>- Số Tài khoản này có chứa những cặp số thuộc năng lượng sinh khí, nên mệnh Số Tài khoản được Vượng Thiên Y kích Tài sinh Lộc, Củng cố Địa vị và gia tăng May mắn.</p>';
		}
		if (in_array('phuc_vi', $duNien['title'])) {
			$duNienGiaiNghia = '<p>- Số Tài khoản này có chứa những cặp số thuộc năng lượng sinh khí, nên mệnh Số Tài khoản được Trợ Phục Vị Viên Mãn giúp Sự nghiệp, Tiền Bạc và Tình cảm được bền vững,Gia đình bình an, tính toán thuận lợi.</p>';
		}
		$amDuong     = $tinhDiemSim->tinhamduong();
		$diem        += $amDuong['diem'];
		$amDuongList = [];
		foreach ($amDuong['day_so'] as $key => $val) {
			$amDuongList[] = [
				'color'  => $val['color'],
				'number' => $val['number'],
				'text'	=> $val['text'],
			];
		}
		$amDuongKetLuan = [
			'am'    => $amDuong['am'] . ' số mang vận âm',
			'duong' => $amDuong['duong'] . ' số mang vận dương',
		];
		if (($tuTru->menhAmDuong == 0 && $amDuong['menh'] === 1) || ($tuTru->menhAmDuong == 1 && $amDuong['menh'] === 0)) {
			$diem += 1;
		}
		if (is_numeric($amDuong['menh']) && $tuTru->menhAmDuong == $amDuong['menh']) {
			$diem -= 1;
		}
		$color = "color: #000";
		$html  = '<div class="sp-nh" style="display:inline-block;width:100%">';
		//var_dump($doVuongSim['list']);
		foreach ($doVuongSim['list'] as $k => $v) {
			switch ($v['slug']) {
				case 'kim':
					$color = "color: #FFE900";
					break;
				case 'moc':
					$color = "color: #29DF53";
					break;
				case 'thuy':
					$color = "color: #2F7BFF";
					break;
				case 'hoa':
					$color = "color: #FF0064";
					break;
				case 'tho':
					$color = "color: #AFAFAF";
					break;
			}
			$html .= "<span class='sp-nh-item' style='font-weight:bold'>" . $v['number'] . "(<span style='$color'>" . $v['nguhanh'] . "</span>)&nbsp;&nbsp;&nbsp;&nbsp;</span>";
		}
		$html  .= '</div>';
		$arrs  = [];
		$count = count($doVuongSim['list']);
		for ($i = 0; $i < $count; $i ++) {
			if (isset($doVuongSim['list'][$i + 1]['slug'])) {
				$arrs[] = ($tinhDiemSim->sinhkhac($doVuongSim['list'][$i]['slug'], $doVuongSim['list'][$i + 1]['slug']));
			}
		}
		$dems = 0;
		$demk = 0;
		foreach ($arrs as $v) {
			if (isset($v['sinh'])) {
				$dems ++;
			} elseif (isset($v['khac'])) {
				$demk ++;
			}
		}
		if ($dems > 0 && $demk == 0) {
			$diem += 1;
		} elseif ($dems > 0 && $demk > 0) {
			$diem += 0.5;
		}
		$nguHanhSinhKhac = '<p>-Theo chiều từ trái qua phải(chiều thuận của sự phát triển) xảy ra : <b>' . $dems . '</b> quan hệ tương sinh,
				<b>' . $demk . '</b> quan hệ tương khắc</p>';
		if (($dems - $demk) <= - 2) {
			$diem            -= 0.25;
			$nguHanhSinhKhac = "<p>Tỉ lệ tương sinh khắc quá cao, số tài khoản này không tốt. (-0.25 điểm)</p>";
		}
		$queDichBatQuai['label']    = 'Tiến hành tách số ' . $soDienThoai . ' thành quẻ Thượng và quẻ Hạ rồi phối quẻ theo nguyên tắc của Dịch Học ta được quẻ kép';
		$quedich                    = $tinhDiemSim->tinhquedichSoTk();
		$diem                       += $quedich['diem'];
		$queDichBatQuai['ten_que']  = 'Quẻ dịch: ' . $quedich['tengoi'];
		$queDichBatQuai['hinh_anh'] = get_stylesheet_directory_uri() . '/images/quedich/' . $quedich['name'] . '.png';
		$queDichBatQuai['y_nghia']  = 'Quẻ này mang ý nghĩa:' . $quedich['ynghia'];
		$queDichBatQuai['ket_luan'] = 'Quẻ này là một quẻ: ' . $quedich['status'];
		$canTangNamSinh             = '';
		if (!empty($canTang['nam'])) {
			foreach ($canTang['nam'] as $canValue) {
				$tt                          = $tuTru->tinhCanTangThapThan($canValue);
				$vts                         = $tuTru->tinhCanTangVTS($canValue);
				$lasoInfo['can_tang']['nam'] = [
					'chu_tinh'  => $tt,
					'thap_than' => $vts,
				];
				if ($tt != '') {
					$canTangNamSinh = '<div class="ct2 ct-chu-tinh">' . $tt . '</div>';
					if ($vts != '') {
						$canTangNamSinh .= '<div class="ct2 ct-thap-than">' . $vts . '</div>';
					};
					$canTangNamSinh = '<div class="col small-4">
						<div class="ct uppercase ' . khongdau($canValue) . '">' . $canValue . '</div>' . $canTangNamSinh . '</div>';
				}
			}
		}
		$canTangThangSinh = '';
		if (!empty($canTang['thang'])) {
			foreach ($canTang['thang'] as $canValue) {
				$tt                            = $tuTru->tinhCanTangThapThan($canValue);
				$vts                           = $tuTru->tinhCanTangVTS($canValue);
				$lasoInfo['can_tang']['thang'] = [
					'chu_tinh'  => $tt,
					'thap_than' => $vts,
				];
				if ($tt != '') {
					$canTangThangSinh .= '<div class="ct2 ct-chu-tinh">' . $tt . '</div>';
				}
				if ($vts != '') {
					$canTangThangSinh .= '<div class="ct2 ct-thap-than">' . $vts . '</div> ';
				}
				$canTangThangSinh = '<div class="col small-4">
								<div class="ct uppercase <?= khongdau($canValue) ?>">' . $canValue . '</div>' . $canTangThangSinh . '</div>';
			}
		}
		$canTangNgaySinh = '';
		if (!empty($canTang['ngay'])) {
			foreach ($canTang['ngay'] as $canValue) {
				$tt                           = $tuTru->tinhCanTangThapThan($canValue);
				$vts                          = $tuTru->tinhCanTangVTS($canValue);
				$lasoInfo['can_tang']['ngay'] = [
					'chu_tinh'  => $tt,
					'thap_than' => $vts,
				];
				if ($tt != '') {
					$canTangNgaySinh .= '<div class="ct2 ct-chu-tinh">' . $tt . '</div>';
				}
				if ($vts != '') {
					$canTangNgaySinh .= '<div class="ct2 ct-thap-than">' . $vts . '</div>';
				}
				$canTangNgaySinh = '<div class="col small-4">
						<div class="ct uppercase' . khongdau($canValue) . '">' . $canValue . '</div>' . $canTangNgaySinh . '</div>';
			}
		}
		$canTangGioSinh = '';
		if (!empty($canTang['gio'])) {

			foreach ($canTang['gio'] as $canValue) {
				$tt                          = $tuTru->tinhCanTangThapThan($canValue);
				$vts                         = $tuTru->tinhCanTangVTS($canValue);
				$lasoInfo['can_tang']['gio'] = [
					'chu_tinh'  => $tt,
					'thap_than' => $vts,
				];
				if ($tt != '') {
					$canTangGioSinh .= '<div class="ct2 ct-chu-tinh">' . $tt . '</div>';
				}
				if ($vts != '') {
					$canTangGioSinh .= '<div class="ct2 ct-thap-than">' . $vts . '</div>';
				}
				$canTangGioSinh = '<div class="col small-4">
						<div class="ct uppercase ' . khongdau($canValue) . '">' . $canValue . '</div>' . $canTangGioSinh . '</div>';
			}
		}
		$listSaoNamSinhText     = '';
		$listSao                = $tuTru->tinhSao('nam');
		$arrDucTuquyNhan        = $tuTru->tinhDucTuQuyNhan('nam');
		$listSao                = array_merge($listSao, $arrDucTuquyNhan);
		$listSao                = array_unique($listSao);
		$lasoInfo['sao']['nam'] = $listSao;
		if (!empty($listSao)) {
			foreach ($listSao as $dt) {
				$class              = in_array(khongdau($dt), $tuTru->saoDepArr) ? 'most-star' : '';
				$listSaoNamSinhText .= '<div class="star ' . $class . '">' . $dt . '</div>';
			}
		}
		$listSaoThangSinhText     = '';
		$listSao                  = $tuTru->tinhSao('thang');
		$arrDucTuquyNhan          = $tuTru->tinhDucTuQuyNhan('thang');
		$listSao                  = array_merge($listSao, $arrDucTuquyNhan);
		$listSao                  = array_unique($listSao);
		$lasoInfo['sao']['thang'] = $listSao;
		if (!empty($listSao)) {
			foreach ($listSao as $dt) {
				$class                = in_array(khongdau($dt), $tuTru->saoDepArr) ? 'most-star' : '';
				$listSaoThangSinhText .= '<div class="star ' . $class . '">' . $dt . '</div>';
			}
		}
		$listSaoNgaySinhText     = '';
		$listSao                 = $tuTru->tinhSao('ngay');
		$arrDucTuquyNhan         = $tuTru->tinhDucTuQuyNhan('ngay');
		$listSao                 = array_merge($listSao, $arrDucTuquyNhan);
		$listSao                 = array_unique($listSao);
		$lasoInfo['sao']['ngay'] = $listSao;
		if (!empty($listSao)) {
			foreach ($listSao as $dt) {
				$class               = in_array(khongdau($dt), $tuTru->saoDepArr) ? 'most-star' : '';
				$listSaoNgaySinhText .= '<div class="star ' . $class . '">' . $dt . '</div>';
			}
		}
		$listSaoGioSinhText     = '';
		$listSao                = $tuTru->tinhSao('gio');
		$arrDucTuquyNhan        = $tuTru->tinhDucTuQuyNhan('gio');
		$listSao                = array_merge($listSao, $arrDucTuquyNhan);
		$listSao                = array_unique($listSao);
		$lasoInfo['sao']['gio'] = $listSao;
		if (!empty($listSao)) {
			foreach ($listSao as $dt) {
				$class              = in_array(khongdau($dt), $tuTru->saoDepArr) ? 'most-star' : '';
				$listSaoGioSinhText .= '<div class="star ' . $class . '">' . $dt . '</div>';
			}
		}
		$daivan        = $daiVanList[0];
		$thapThanText  = '';
		foreach ($daivan['nam'] as $keyDv => $dvn) {
			$thapThanText .= '<p class="tt-thapthan" data-slug="' . khongdau($dvn['thapthan']) . '">' . $keyDv . '-' . $dvn['can_chi'] . '-' . '<span class="' . khongdau($dvn['thapthan']) . '">' . $dvn['thapthan'] . '</span></p>';
		}
		$daivan          = $daiVanList[1];
		$thapthanNamText = '';
		foreach ($daivan['nam'] as $keyDv => $dvn) {
			$thapthanNamText .= '<p class="tt-thapthan" data-slug="' . khongdau($dvn['thapthan']) . '">' . $keyDv . '-' . $dvn['can_chi'] . '-' . '<span class="' . khongdau($dvn['thapthan']) . '">' . $dvn['thapthan'] . '</span></p>';
		}
		$daivan        = $daiVanList[2];
		$daivanNamText = '';
		foreach ($daivan['nam'] as $keyDv => $dvn) {
			$daivanNamText .= '<p class="tt-thapthan" data-slug="' . khongdau($dvn['thapthan']) . '">' . $keyDv . '-' . $dvn['can_chi'] . '-' . '<span class="' . khongdau($dvn['thapthan']) . '">' . $dvn['thapthan'] . '</span></p>';
		}
		$daivan      = $daiVanList[3];
		$daiVanThang = '';
		foreach ($daivan['nam'] as $keyDv => $dvn) {
			$daiVanThang .= '<p class="tt-thapthan" data-slug="' . khongdau($dvn['thapthan']) . '">' . $keyDv . '-' . $dvn['can_chi'] . '-' . '<span class="' . khongdau($dvn['thapthan']) . '">' . $dvn['thapthan'] . '</span></p>';
		}
		$daivan     = $daiVanList[4];
		$daiVanNgay = '';
		foreach ($daivan['nam'] as $keyDv => $dvn) {
			$daiVanNgay .= '<p class="tt-thapthan" data-slug="' . khongdau($dvn['thapthan']) . '">' . $keyDv . '-' . $dvn['can_chi'] . '-' . '<span class="' . khongdau($dvn['thapthan']) . '">' . $dvn['thapthan'] . '</span></p>';
		}
		$daivan        = $daiVanList[5];
		$thapThanThang = '';
		foreach ($daivan['nam'] as $keyDv => $dvn) {
			$thapThanThang .= '<p class="tt-thapthan" data-slug="' . khongdau($dvn['thapthan']) . '">' . $keyDv . ' - ' . $dvn['can_chi'] . ' - ' . '<span class="' . khongdau($dvn['thapthan']) . '">' . $dvn['thapthan'] . '</span></p>';
		}
		$daivan       = $daiVanList[6];
		$thapThanNgay = '';
		foreach ($daivan['nam'] as $keyDv => $dvn) {
			$thapThanNgay .= '<p class="tt-thapthan" data-slug="' . khongdau($dvn['thapthan']) . '">' . $keyDv . '-' . $dvn['can_chi'] . '-' . '<span class="' . khongdau($dvn['thapthan']) . '">' . $dvn['thapthan'] . '</span></p>';
		}
		$daivan   = $daiVanList[7];
		$phatCuoi = '';
		foreach ($daivan['nam'] as $keyDv => $dvn) {
			$phatCuoi .= '<p class="tt-thapthan" data-slug="' . khongdau($dvn['thapthan']) . '">' . $keyDv . '-' . $dvn['can_chi'] . '-' . '<span class="' . khongdau($dvn['thapthan']) . '">' . $dvn['thapthan'] . '</span></p>';
		}
		 $pattern = "/(00000|11111|22222|33333|44444|55555|66666|77777|88888|99999)$/"; // Ngũ quy
		if (preg_match($pattern, $soDienThoai)) {
			$diem += 2;
		}
		return new \WP_REST_Response([
			'batTu'              => $batTu,
			'tietKhi'            => $tietKhi,
			'cungMenhThaiNguyen' => $cungMenhThaiNguyen,
			'chuTinh'            => $chuTinh,
			'canTang'            => $canTang,
			'nhatKien'           => $nhatKien,
			'nguyetKien'         => $nguyetKien,
			'vongTrangSinhTru'   => $vtsTru,
			'daiVan'             => $daiVan,
			'napAm'              => $napAm,
			'nguHanhThaiNguyen'  => $nguHanhThaiNguyen,
			'namAmLich'          => $namAmLich,
			'doVuongSuy'         => $doVuongSuy,
			'soNguHanh'          => $soNguHanh,
			'dungThan'           => $dungThan,
			'hyThan'             => $hyThan,
			'banMenhText'        => $banMenhText,
			'lasoInfo'           => $lasoInfo,
			'soDienThoai'        => $soDienThoai,
			'menhChuGiaiNghia'   => $menhChuGiaiNghia,
			'simKhiThienMenhSim' => $simKhiThienMenhSim,
			'menhQuai'           => [
				'ten'   => !empty($tuTru->menhQuaiArr['menhquai']['name']) ? $tuTru->menhQuaiArr['menhquai']['name'] : "",
				'class' => $tuTru->menhQuaiArr['menhquai']['class'],
				'menh'  => !empty($tuTru->menhQuaiArr['menhquai']['menh']) ? $tuTru->menhQuaiArr['menhquai']['menh'] : "",
			],
			'diem'               => $diem,
			'duNien'             => $duNienText,
			'duNienGiaiNghia'    => $duNienGiaiNghia,
			'amDuongList'        => $amDuongList,
			'amDuongKetLuan'     => $amDuongKetLuan,
			'nguHanhTuongPhoi'   => [
				'color'           => $color,
				'html'            => $html,
				'nguHanhSinhKhac' => $nguHanhSinhKhac,
			],
			'queDichBatQuai'     => $queDichBatQuai,
			'es' => Timstk::getStkDetail($soDienThoai),
			'tuTru' => $tuTru
		], 200);
	}

	/**
	 * Check permissions for the posts.
	 *
	 * @param WP_REST_Request $request Current request.
	 */
	public function get_items_permissions_check ($request) {
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
	public function get_items ($request) {
		$args  = array(
			'post_per_page' => 5,
		);
		$posts = get_posts($args);
		$data  = array();
		if (empty($posts)) {
			return rest_ensure_response($data);
		}
		foreach ($posts as $post) {
			$response = $this->prepare_item_for_response($post, $request);
			$data[]   = $this->prepare_response_for_collection($response);
		}
		// Return all of our comment response data.
		return rest_ensure_response($data);
	}

	/**
	 * Check permissions for the posts.
	 *
	 * @param WP_REST_Request $request Current request.
	 */
	public function get_item_permissions_check ($request) {
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
	public function get_item ($request) {
		$id   = (int) $request['id'];
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
	public function prepare_item_for_response ($post, $request) {
		$post_data = array();
		$schema    = $this->get_item_schema($request);
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
	public function prepare_response_for_collection ($response) {
		if (!($response instanceof WP_REST_Response)) {
			return $response;
		}
		$data   = (array) $response->get_data();
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
	public function get_item_schema () {

		if ($this->schema) {
			// Since WordPress 5.3, the schema can be cached in the $schema property.
			return $this->schema;
		}
		$this->schema = array(
			// This tells the spec of JSON Schema we are using which is draft 4.
			'$schema'    => 'http://json-schema.org/draft-04/schema#',
			// The title property marks the identity of the resource.
			'title'      => 'page',
			'type'       => 'object',
			// In JSON Schema you can specify object properties in the properties attribute.
			'properties' => array(
				'id'      => array(
					'description' => esc_html__('Unique identifier for the object.', 'my-textdomain'),
					'type'        => 'integer',
					'context'     => array(
						'view',
						'edit',
						'embed',
					),
					'readonly'    => true,
				),
				'content' => array(
					'description' => esc_html__('The content for the object.', 'my-textdomain'),
					'type'        => 'string',
				),
			),
		);
		return $this->schema;
	}

	// Sets up the proper HTTP status code for authorization.
	public function authorization_status_code () {

		$status = 401;
		if (is_user_logged_in()) {
			$status = 403;
		}
		return $status;
	}
}
