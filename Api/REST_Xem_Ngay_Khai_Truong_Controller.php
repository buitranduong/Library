<?php

namespace AnChoi;
class REST_Xem_Ngay_Khai_Truong_Controller {

	public $namespace;

	public $resource_name;

	public $schema;

	public function __construct () {
		$this->namespace     = '/xem-ngay/v1';
		$this->resource_name = 'khai-truong';
	}

	public function register_routes () {
		register_rest_route($this->namespace, '/' . $this->resource_name, array(
			// Here we register the readable endpoint for collections.
			array(
				'methods'  => 'GET',
				'callback' => [
					$this,
					'xem_ngay',
				],
				'args'     => [
					'ngay'     => [
						'required'          => true,
						'validate_callback' => function($param, $request, $key) {
							return $param >= 1 && $param <= 31;
						},
					],
					'ngay_x'   => [
						'required'          => true,
						'validate_callback' => function($param, $request, $key) {
							return $param >= 1 && $param <= 31;
						},
					],
					'thang'    => [
						'required'          => true,
						'validate_callback' => function($param, $request, $key) {
							return $param >= 1 && $param <= 12;
						},
					],
					'thang_x'  => [
						'required'          => true,
						'validate_callback' => function($param, $request, $key) {
							return $param >= 1 && $param <= 12;
						},
					],
					'nam'      => [
						'required'          => true,
						'validate_callback' => function($param, $request, $key) {
							return $param >= 1900 && $param <= 2050;
						},
					],
					'nam_x'    => [
						'required'          => true,
						'validate_callback' => function($param, $request, $key) {
							return $param >= 1900 && $param <= 2050;
						},
					],
					'gio'      => [
						'required'          => true,
						'validate_callback' => function($param, $request, $key) {
							return $param >= 0 && $param <= 23;
						},
					],
					'gio_x'    => [
						'required'          => true,
						'validate_callback' => function($param, $request, $key) {
							return $param >= 0 && $param <= 23;
						},
					],
					'phut'     => [
						'required'          => true,
						'validate_callback' => function($param, $request, $key) {
							return $param >= 0 && $param <= 59;
						},
					],
					'gioitinh' => [
						'required'          => true,
						'validate_callback' => function($param, $request, $key) {
							return in_array($param, [
								'nam',
								'nu',
							]);
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

	public function xem_ngay ($data) {
		$params             = $data->get_params();
		$hoTen              = isset($params['hoten']) && strip_tags($params['hoten']) != '' ? sanitize_text_field($params['hoten']) : '';
		$ngaySinh           = isset($params['ngay']) ? preg_replace("/[^0-9]/", "", $params['ngay']) : false;
		$thangSinh          = isset($params['thang']) ? preg_replace("/[^0-9]/", "", $params['thang']) : false;
		$namSinh            = isset($params['nam']) ? preg_replace("/[^0-9]/", "", $params['nam']) : false;
		$gioSinh            = isset($params['gio']) ? preg_replace("/[^0-9]/", "", $params['gio']) : false;
		$phutSinh           = isset($params['phut']) ? preg_replace("/[^0-9]/", "", $params['phut']) : '';
		$gioiTinh           = isset($params['gioitinh']) && $params['gioitinh'] == 'nu' ? 'nu' : 'nam';
		$gioiTinhVal        = $gioiTinh == 'nam' ? 1 : 0;
		$ngayXem            = isset($params['ngay_x']) ? preg_replace("/[^0-9]/", "", $params['ngay_x']) : false;
		$thangXem           = isset($params['thang_x']) ? preg_replace("/[^0-9]/", "", $params['thang_x']) : false;
		$namXem             = isset($params['nam_x']) ? preg_replace("/[^0-9]/", "", $params['nam_x']) : false;
		$gioXem             = isset($params['gio_x']) ? preg_replace("/[^0-9]/", "", $params['gio_x']) : false;
		$ngaySinhFull       = $ngaySinh . '-' . $thangSinh . '-' . $namSinh;
		$ngayXemFull        = $ngayXem . '-' . $thangXem . '-' . $namXem;
		$lasoTuTru          = new \Laven\LasoTutru($ngaySinhFull, $gioSinh, $phutSinh, $gioiTinhVal, 7, $hoTen);
		$batTu              = $lasoTuTru->tinhBatTu();
		$tietKhi            = $lasoTuTru->getTietKhiHienTai();
		$cungMenhThaiNguyen = $lasoTuTru->tinhCungMenhThaiNguyen();
		$doVuong            = $lasoTuTru->tinhDoVuong();
		$doVuongSuy         = $lasoTuTru->tinhDoVuongSuy($doVuong);
		$total              = array_sum($doVuongSuy['total']);
		$soNguHanh          = floor($total * 0.4);
		$dungThan           = $hyThan = $banMenhText = '';
		$nguHanhVuong       = $lasoTuTru->nguHanhVuong($doVuongSuy);
		$thanNhuoc          = false;
		if ($doVuongSuy['cung_phe'] >= $soNguHanh) {
			$banMenhText  = 'Vượng ' . $doVuongSuy['ban_menh']['title'];
			$dungThan     = $doVuongSuy['ban_menh']['dung_than'];
			$hyThan       = $doVuongSuy['ban_menh']['hy_than'];
			$khacDungThan = $lasoTuTru->tuongSinh($dungThan);
		}
		if ($doVuongSuy['cung_phe'] < $soNguHanh) {
			$banMenhText  = 'Nhược ' . $doVuongSuy['ban_menh']['title'];
			$dungThan     = $doVuongSuy['ban_menh']['dung_than_2'];
			$hyThan       = $doVuongSuy['ban_menh']['hy_than_2'];
			$thanNhuoc    = true;
			$khacDungThan = $lasoTuTru->biKhac($dungThan);
		}
		$hyThanId               = $lasoTuTru->getNguHanhId($hyThan);
		$namAmLich              = 'Năm ' . $lasoTuTru->canNamText . ' ' . $lasoTuTru->chiNamText . ', tháng ' . $lasoTuTru->canThangText . ' ' . $lasoTuTru->chiThangText . ', ngày ' . $lasoTuTru->canNgayText . ' ' . $lasoTuTru->chiNgayText . ', giờ ' . $lasoTuTru->canGioText . ' ' . $lasoTuTru->chiGioText;
		$napAm                  = $lasoTuTru->tinhNapAm();
		$lasoTuTruNgay          = new \Laven\LasoTutru($ngayXemFull, $gioXem, '00', 0, 7, '');
		$batTuNgay              = $lasoTuTruNgay->tinhBatTu();
		$tietKhiNgay            = $lasoTuTruNgay->getTietKhiHienTai();
		$cungMenhThaiNguyenNgay = $lasoTuTruNgay->tinhCungMenhThaiNguyen();
		$doVuongNgay            = $lasoTuTruNgay->tinhDoVuong();
		$doVuongSuyNgay         = $lasoTuTruNgay->tinhDoVuongSuy($doVuongNgay);
		$totalNgay              = array_sum($doVuongSuyNgay['total']);
		$soNguHanhNgay          = floor($totalNgay * 0.4);
		$dungThanNgay           = $dungThanNgay = $banMenhTextNgay = '';
		$nguHanhVuongNgay       = $lasoTuTruNgay->nguHanhVuong($doVuongSuyNgay);
		$thanNhuocNgay          = false;
		if ($doVuongSuyNgay['cung_phe'] >= $soNguHanhNgay) {
			$banMenhTextNgay  = 'Vượng ' . $doVuongSuyNgay['ban_menh']['title'];
			$dungThanNgay     = $doVuongSuyNgay['ban_menh']['dung_than'];
			$hyThanNgay       = $doVuongSuyNgay['ban_menh']['hy_than'];
			$khacDungThanNgay = $lasoTuTruNgay->tuongSinh($dungThanNgay);
		}
		if ($doVuongSuyNgay['cung_phe'] < $soNguHanhNgay) {
			$banMenhTextNgay  = 'Nhược ' . $doVuongSuyNgay['ban_menh']['title'];
			$dungThanNgay     = $doVuongSuyNgay['ban_menh']['dung_than_2'];
			$hyThanNgay       = $doVuongSuyNgay['ban_menh']['hy_than_2'];
			$thanNhuocNgay    = true;
			$khacDungThanNgay = $lasoTuTruNgay->biKhac($dungThanNgay);
		}
		$hyThanNgayId  = $lasoTuTruNgay->getNguHanhId($hyThanNgay);
		$namAmLichNgay = 'Năm ' . $lasoTuTruNgay->canNamText . ' ' . $lasoTuTruNgay->chiNamText . ', tháng ' . $lasoTuTruNgay->canThangText . ' ' . $lasoTuTruNgay->chiThangText . ', ngày ' . $lasoTuTruNgay->canNgayText . ' ' . $lasoTuTruNgay->chiNgayText . ', giờ ' . $lasoTuTruNgay->canGioText . ' ' . $lasoTuTruNgay->chiGioText;
		$napAmNgay     = $lasoTuTruNgay->tinhNapAm();
		$ngayDuong     = $lasoTuTruNgay->ngayDuong . '/' . $lasoTuTruNgay->thangDuong . '/' . $lasoTuTruNgay->namDuong;
		$ngayAm        = $lasoTuTruNgay->ngaythangAm[0] . '/' . $lasoTuTruNgay->ngaythangAm[1] . '/' . $lasoTuTruNgay->ngaythangAm[2];
		if (!empty($lasoTuTru->menhQuaiArr['menhquai']['name'])) {
			$menhQuai = [
				'class' => $lasoTuTru->menhQuaiArr['menhquai']['class'],
				'name'  => $lasoTuTru->menhQuaiArr['menhquai']['name'],
			];
		} else {
			$menhQuai = [
				'class' => 'red',
				'name'  => $lasoTuTru->menhQuaiArr['menh'],
			];
		}
		$luanGiai      = [
			'thiencan' => [
				'sinh' => [
					'nam'   => '<p>- Khi thiên can trụ năm thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt cho gia đạo thuận hoà, bản thân với bố mẹ, cô dì chú bác của Chủ Sự yêu quý, trợ giúp. Thuộc ngày may mắn, cát lành.
Sinh ám chỉ về ngũ hành (Kim, Thủy, Mộc, Hỏa, Thổ) của các thiên can địa chi khi gặp nhau, tính theo hệ tương sinh của ngũ hành can chi. Khi có sự tương sinh Thì Gia Chủ nhận được sự hỗ trợ, nâng đỡ, bù đắp, nhẹ nhàng, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng tổ ấm, yêu thương tôn trọng lẫn nhau. Tuy nhiên bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh. <span class="red">TỐT</span></p>',
					'thang' => '<p>- Khi thiên can trụ tháng thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt cho gia đạo thuận hoà, bản thân với anh chi em trong nhà yêu quý, trợ giúp. Thuộc ngày may mắn, cát lành.
Vạn vật trong cuộc sống đều được phát sinh ra từ 5 yếu tố cơ bản Kim, Mộc, Thủy, Hỏa, Thổ và chúng được gọi là ngũ hành. Theo quy luật tương sinh của ngũ hành bạn sẽ nhận được nhiều sự giúp đỡ, hỗ trợ của mọi người xung quanh. Mọi lĩnh vực bạn làm đều diễn ra thuận lợi, hanh thông. Tuy nhiên bạn cần cố gắng hơn nữa bởi các thuật số chỉ mang lại 1 phần nhỏ với mỗi bản mệnh, phần lớn còn lại do bạn cố gắng tạo ra. <span class="red">TỐT</span></p>',
					'ngay'  => '<p>- Khi thiên can trụ ngày thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt cho Gia Chủ. Thuộc ngày may mắn, cát lành, công việc hanh thông, làm gì cũng thuận. 
Ngũ hành tương sinh là các mệnh tương sinh hỗ trợ, thúc đẩy nhau phát triển. Khi có sự tương sinh thì chủ sự nhận được nhiều sự nâng đỡ, đùm bọc của mọi người xung quanh giúp cho công việc, cuộc sống dễ dàng hơn. Trong tình yêu thì nhận được sự yêu thương, tôn trọng, đối xử nhẹ nhàng của người bạn đời. Tuy nhiên để xác định được hung hay cát thì bạn cần dựa vào các yếu tố của các mục khác nữa. Và thuật số chỉ mang lại phần nhỏ cho vận mệnh, phần lớn còn lại dựa vào những cố gắng, nỗ lực của bạn. <span class="red">TỐT</span></p>',
					'gio'   => '<p>- Khi thiên can trụ giờ thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt cho Gia Chủ. Thuộc ngày may mắn, cát lành, công việc hanh thông, tốt cho con cái sau này khoẻ mạnh.
Khi có sự tương sinh chủ sự sẽ nhận được nhiều may mắn, yêu thương, giúp đỡ mọi người xung quanh trong công việc, cuộc sống. Tuy nhận được nhiều sự nâng đỡ từ mọi người nhưng bạn cũng vẫn cần cố gắng. Bởi vận mệnh của bạn tốt hay xấu phụ thuộc rất nhiều vào sự cố gắng của bản mệnh. <span class="red">TỐT</span></p>',
				],
				'khac' => [
					'nam'   => '<p>- Khi thiên can trụ năm thuộc Khắc: Xấu cho việc Khai Trương và Xấu cho gia đạo khó thuận hoà, bản thân với bố mẹ, cô dì chú bác của Chủ Sự dễ bất đồng quan điểm, mọi việc chưa thông.
Khi vợ chồng bị hai thiên can khắc nhau sẽ dễ gặp sự đối lập, sát phạt, khắc khẩu, bất đồng quan điểm, giống như nước với lửa. Sự góp ý của mình khiến họ khó chịu, sẽ xảy ra những tranh cãi. Nhưng quý vị cũng lên quá lo lắng bởi có khắc ắt có sinh, chỉ là do quý vị chưa biết cách hóa giải. Việc hóa giải không khó nhưng thuật toán hay phong thủy chỉ hỗ trợ được quý vị phần nhỏ, phần lớn còn lại là do chính bản thân quý vị mong muốn, nỗ lực để xây dựng và vun đắp tổ ấm của chính mình. Gia chủ có thể dùng ngũ hành thông quan sẽ hóa hung thành cát. Nếu bản thân chưa an tâm thì bạn có thể liên hệ với chuyên gia để tìm cách hóa giải chi tiết và hiệu quả. <span class="red">XẤU</span></p>',
					'thang' => '<p>- Khi thiên can trụ tháng thuộc Khắc: Xấu cho việc Khai Trương và Xấu cho gia đạo khó thuận hoà, bản thân với anh chị em  của Chủ Sự dễ bất đồng quan điểm, mọi việc chưa thông.
Ngũ hành tương khắc là nói đến sự xung khắc giữa các hành với nhau. Hay gọi đúng tên bản chất của sự tương khắc là hành này khống chế và làm cho hành kia bị suy yếu, ảnh hưởng xấu. Tuy nhiên khi gặp vấn đề này bạn cũng không cần quá lo lắng, bởi có khắc ắt có sinh, chỉ là do quý vị chưa biết cách hóa giải. Việc hóa giải không hề khó nhưng thuật toán hay phong thủy chỉ hỗ trợ bạn được 1 phần, còn lại là do chính bản thân bạn. Để bản thân thêm an tâm thì bạn có thể liên hệ với các chuyên gia để hóa giải vận hạn xấu của bản mệnh. <span class="red">XẤU</span></p>',
					'ngay'  => '<p>- Khi thiên can trụ ngày thuộc Khắc: Xấu cho việc Khai Trương và Xấu cho gia đạo khó thuận hoà, chồng/vợ dễ bất đồng quan điểm, mọi việc chưa thông. Nếu ngũ hành tương sinh được hiểu là bồi đắp nuôi dưỡng của hành này cho hành kia. Thì ngũ hành tương khắc có nghĩa là sự đối lập, khắc chế, làm hao tổn lẫn nhau của 2 hành. Nhưng bạn cũng cần hiểu rằng có khắc ắt có sinh, nên khi 2 hành không hợp nhau chưa chắc đã là điều xấu. Vì vậy bạn không nên quá bận tâm bởi hung hay cát còn phải dựa vào rất nhiều yếu tố. Thuật số hay phong thủy chỉ mang đến phần nhỏ vận mệnh, phần lớn còn lại do sự nỗ lực của bạn. Nếu để an tâm hơn thì có thể liên hệ với các chuyên gia để hóa giải vận hạn. <span class="red">XẤU</span></p>',
					'gio'   => '<p>- Khi thiên can trụ giờ thuộc Khắc: Xấu cho việc Khai Trương và Xấu cho gia đạo khó thuận hoà, chồng/vợ, con cái dễ bất đồng quan điểm, mọi việc chưa thông.
Tương khắc được hiểu là sự khắc chế, bài trừ, đối lập, kìm hãm sự phát triển của nhau. Hóa giải được sự tương khắc này sẽ sinh ra những điều tốt đẹp, vì có khắc ắt có sinh. Tuy nhiên việc hóa giải chỉ hỗ trợ được bạn 30%, 70% còn lại dựa vào những cố gắng của bạn. Vì vậy nên cách hóa giải tốt nhất đó chính là dựa vào chính sự nỗ lực của bản thân sẽ làm thay đổi vận mệnh. (Ở mục này hung hay cát cũng chưa nói lên điều gì? Bởi còn rất nhiều yếu tố của các mục khác tạo lên và thuật số chỉ mạng lại phần nhỏ với vận mệnh. Phần lớn còn lại là do chính quý vị nỗ lực tạo ra)  <span class="red">XẤU</span></p>',
				],
				'tro'  => [
					'nam'   => '<p>- Khi thiên can trụ năm thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt cho gia đạo thuận hoà, bản thân với bố mẹ, cô dì chú bác của Chủ Sự được nhận sự nâng đỡ. Thuộc ngày may mắn, cát lành.
Giống như 2 vợ chồng cùng ngũ hành. Ví dụ: chồng là Lộ Bàng Thổ vợ cũng là Lộ Bàng Thổ, hoặc Bích Thượng Thổ với Lộ Bàng Thổ… Trong ngũ hành thì sự tương trợ tốt ngần bằng tương sinh, tương sinh được ví như bố mẹ, còn tương trợ được ví như anh em, ám chỉ về ngũ hành (Kim, Thủy, Mộc, Hỏa, Thổ) của mệnh niên khi gặp nhau, tính theo hệ cùng ngũ hành, của ngũ hành mệnh niên của hai bên gặp nhau. Khi có sự tương trợ Thì Gia Chủ nhận được sự hỗ trợ, nâng đỡ, bù đắp, nhẹ nhàng, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng tổ ấm, yêu thương tôn trọng lẫn nhau. Tuy nhiên bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh. <span class="red">TỐT</span></p>',
					'thang' => '<p>- Khi thiên can trụ tháng thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt cho gia đạo thuận hoà, bản thân với anh chi em của Chủ Sự được nhận sự nâng đỡ. Thuộc ngày may mắn, cát lành.
Tương trợ là khi bạn gặp được mệnh niên phù hợp với mệnh của mình, người ta hay gọi đó là quý nhân. Khi gặp được mệnh tương trợ mọi việc bạn thực hiện đều dễ dàng, thuận lợi hơn từ sự nghiệp, tài vận đến tình cảm. Tuy nhiên để có được kết quả tốt nhất thì bạn cần cố gắng rất nhiều. Và những thuật số chỉ mang đến phần nhỏ vận mệnh, phần lớn còn lại đều dựa vào chính bản thân bạn. <span class="red">TỐT</span></p>',
					'ngay'  => '<p>- Khi thiên can trụ ngày thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt cho vợ chồng thuận hoà, bảo nhau làm ăn, hỗ trợ trong công việc cũng như cuộc sống. Thuộc ngày may mắn, cát lành.
Tương trợ là ám chỉ việc giúp đỡ, hỗ trợ lẫn nhau của 2 niên mệnh. Khi gặp được niên mệnh phù hợp với mệnh của bạn thân bạn sẽ nhận được nhiều sự nâng đỡ, chỉ bảo con đường đi đúng đắn, chính xác. Vì vậy nên vận thế của bạn ngày càng hanh thông, thuận lợi. Tuy nhiên để xác định được hung hay cát thì bạn cần dựa vào các yếu tố của các mục khác nữa. Và thuật số chỉ mang lại một phần nhỏ cho vận mệnh, phần lớn còn lại dựa vào những cố gắng, nỗ lực của bạn. <span class="red">TỐT</span></p>',
					'gio'   => '<p>- Khi thiên can trụ giờ thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt cho vợ chồng và con cái, dễ có con tài giỏi. Thuộc ngày may mắn, cát lành. Trong ngũ hành (Kim, Thủy, Mộc, Hỏa, Thổ) thì sự tương trợ tốt ngần bằng tương sinh, tương sinh được ví như bố mẹ, còn tương trợ ví như anh em của mệnh niên khi gặp nhau. Tính theo ngũ hành mệnh niên của hai bên gặp nhau, khi có sự tương trợ thì chủ sự nhận được sự hỗ trợ, nâng đỡ, bù đắp, nhẹ nhàng, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng tổ ấm, yêu thương tôn trọng lẫn nhau. (Ở một mục này hung hay cát cũng chưa nói lên điều gì? Bởi còn rất nhiều yếu tố của các mục khác tạo lên và thuật số chỉ mạng lại tới phần nhỏ, phần lớn là do chính quý vị tạo ra). <span class="red">TỐT</span></p>',
				],
				'hao'  => [
					'nam'   => '<p>- Khi thiên can trụ năm thuộc Hao: không Tốt không xấu cho việc Khai Trương và Tuy không xấu nhưng cũng không tốt, bản thân với bố mẹ, cô dì chú bác của Chủ Sự dửng dưng với nhau. Và bản thân hay bị hao tổn.
Hao nghĩa là bản thân vợ hoặc chồng sinh trợ cho nhau. Ví dụ: vợ thiên can thuộc ngũ hành Mộc mà chồng thiên can thuộc ngũ hành Hỏa, thì chồng được sinh còn vợ bị hao, trong kết hôn hao được tính là tốt như sinh. Trong ngũ hành sự Hao được ví như người cho đi, bản thân mình phải sinh ra và nuôi dưỡng. Trong hôn nhân khi gặp Hao thì cũng như hệ tương sinh, ám chỉ về ngũ hành (Kim, Thủy, Mộc, Hỏa, Thổ) của mệnh niên khi gặp nhau, tính theo hệ tương sinh của ngũ hành mệnh niên của hai bên gặp nhau. Khi có sự tương sinh Thì Gia Chủ nhận được sự hỗ trợ, nâng đỡ, bù đắp, nhẹ nhàng, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng tổ ấm, yêu thương tôn trọng lẫn nhau. Tuy nhiên bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh.
</p>',
					'thang' => '<p>- Khi thiên can trụ tháng thuộc Hao: không Tốt không xấu cho việc Khai Trương và Tuy không xấu nhưng cũng không tốt, bản thân với anh chi em trong nhà dửng dưng với nhau. Và bản thân hay bị hao tổn.
Hao nghĩa là bản thân vợ hoặc chồng sinh trợ cho nhau. Trong kết hôn hao được tính là tốt như sinh. Trong ngũ hành sự Hao được ví như người cho đi, bản thân mình phải sinh ra và nuôi dưỡng. Trong hôn nhân khi gặp Hao thì cũng như hệ tương sinh, ám chỉ về ngũ hành Kim, Thủy, Mộc, Hỏa, Thổ của mệnh niên khi gặp nhau. Khi có sự tương sinh Thì Gia Chủ nhận được sự hỗ trợ, nâng đỡ, bù đắp, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng tổ ấm, yêu thương tôn trọng lẫn nhau. Tuy nhiên bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh.
</p>',
					'ngay'  => '<p>- Khi thiên can trụ ngày thuộc Hao: không Tốt không xấu cho việc Khai Trương và Tuy không xấu nhưng cũng không tốt, chồng vợ dễ dửng dưng với nhau. Và bản thân hay bị hao tổn, thiệt thòi.
Hao nghĩa là bản thân vợ hoặc chồng sinh trợ cho nhau. Ví dụ: vợ thiên can thuộc ngũ hành Mộc mà chồng thiên can thuộc ngũ hành Hỏa, thì chồng được sinh còn vợ bị hao. Sự Hao được ví như người cho đi, bản thân mình phải sinh ra và nuôi dưỡng. Trong kết hôn hao được tính là tốt như sinh. Trong hôn nhân khi gặp Hao thì cũng như hệ tương sinh, ám chỉ vợ chồng nhận được sự hỗ trợ, nâng đỡ, bù đắp, nhẹ nhàng, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng tổ ấm, yêu thương tôn trọng lẫn nhau. Tuy nhiên bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh.
</p>',
					'gio'   => '<p>- Khi thiên can trụ giờ thuộc Hao: không Tốt không xấu cho việc Khai Trương và Tuy không xấu nhưng cũng không tốt, bản thân bố mẹ với các con dửng dưng với nhau. Và bản thân hay bị hao tổn vì con cái. Hao nghĩa là bản thân vợ hoặc chồng sinh trợ cho nhau, sự Hao được ví như người cho đi, bản thân mình phải sinh ra và nuôi dưỡng. Ví dụ: vợ thiên can thuộc ngũ hành Mộc mà chồng thiên can thuộc ngũ hành Hỏa, thì chồng được sinh còn vợ bị hao. Trong kết hôn hao được tính là tốt như sinh. Ám chỉ vợ chồng nhận được sự hỗ trợ, nâng đỡ, bù đắp, nhẹ nhàng, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng tổ ấm, yêu thương tôn trọng lẫn nhau. Tuy nhiên bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh.</p>',
				],
				'xung' => [
					'nam'   => '<p>- Khi thiên can trụ năm thuộc xung: xấu cho việc Khai Trương và xấu cho gia đạo, khó thuận hoà. Bản thân với bố mẹ, cô dì chú bác của Chủ Sự dễ nói xấu nhau sau lưng. Sau này do đó mà vợ chồng phật ý nhau.
Xung ám chỉ mọi việc không đồng thuận với nhau, có nhiều ý kiến đối lập. Thiên can của chủ sự bị xung thì mọi việc không được như mong muốn. Mang đến nhiều điều rủi ro, không may mắn, cản trở công việc làm ăn, cuộc sống của chủ sự. Nếu nhỡ có ngày giờ không đẹp thì bạn cũng không cần quá lo lắng. Bởi còn rất nhiều yếu tố của các mục khác tạo nên và thuật số chỉ mang tính chất dự đoán một phần và các phần còn lại do quý vị tạo ra. Để có thể an tâm hơn bạn có thể liên hệ với chuyên gia để hóa giải.  <span class="red">XẤU</span></p>',
					'thang' => '<p>- Khi thiên can trụ tháng thuộc xung: xấu cho việc Khai Trương và xấu cho gia đạo, khó thuận hoà. Bản thân với anh chi em trong nhà dễ nói xấu nhau sau lưng. Sau này do đó mà vợ chồng phật ý, không vui với nhau.
Xung là chỉ sự xung khắc, có nhiều ý kiến trái ngược với nhau về tính cách, quan điểm và phong cách sống, làm việc. Thiên can của chủ sự bị xung dẫn đến công việc không đạt được kết quả như mong muốn thì bạn cũng không cần quá lo lắng. Vì mọi vật sinh ra và tồn tại đều có những ưu, khuyết điểm khác nhau. Mọi việc thành hay bại đều do bản thân mình, các thuật số chỉ mang tính chất dự đoán. Để có thể an tâm hơn cho công việc của mình thì bạn có thể liên hệ với các chuyên gia để hóa giải. Kính chúc quý gia chủ vạn sự an nhiên, hanh thông, hạnh phúc viên mãn. <span class="red">XẤU</span></p>',
					'ngay'  => '<p>- Khi thiên can trụ ngày thuộc xung: xấu cho việc Khai Trương và xấu cho gia đạo, khó thuận hoà. Bản thân chồng/vợ chấp nhau trong cuộc sống. Sau này do đó mà vợ chồng hay để ý, nhỏ mọn với nhau.
Xung ám chỉ một sự việc dễ đối lập nhau, không đồng thuận, đồng lòng, ai cũng có cái lý của mình. Vì không có tiếng nói chung nên dễ mỗi người một phách. Khi thiên can của chủ sự bị xung sự việc có thể không được như mong đợi. Vạn vật khi sinh ra và cùng tồn tại nên sẽ có cái ưu khuyết của riêng mình, trong đây không có sự đúng sai hơn thua mà là sự xây dựng bổ trợ. Vạn sự khởi từ tâm nhân, kính chúc quý gia chủ vạn sự an nhiên, hạnh phúc viên mãn hanh thông. (Ở mục này hung hay cát cũng chưa nói lên điều gì? Bởi còn rất nhiều yếu tố của các mục khác tạo lên và thuật số chỉ mạng lại phần ít với mỗi quý vị phần nhiều là do chính quý vị tạo ra). <span class="red">XẤU</span></p>',
					'gio'   => '<p>- Khi thiên can trụ giờ thuộc xung: xấu cho việc Khai Trương và Xấu cho gia đạo chồng/vợ, con cái dễ bất đồng khắc khẩu lẫn nhau. Xung ám chỉ một sự việc dễ đối lập nhau, không đồng thuận, đồng lòng. Ai cũng có cái lý của mình, chưa có tiếng nói chung, dễ mỗi người một phách. Đôi lúc cái mình nghĩ sẽ tốt cho họ nhưng lại hại họ. Vợ chồng khi thiên can bị xung hãy đặt mình vào đối phương để suy nghĩ, bao dung, độ lượng, sẻ chia ắt giải được sự xung này. Vạn vật khi sinh ra và cùng tồn tại nên sẽ có cái ưu khuyết của riêng mình. Trong đây không có sự đúng sai hơn thua mà là sự xây dựng bổ trợ, hỗ trợ lẫn nhau, giúp nhau hoàn thiện và tốt hơn. Bạn cũng nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh 1 phần nhỏ và phần lớn còn lại là do sự cố gắng của chính bản thân chủ mệnh. Vạn sự khởi từ tâm nhân, chúc gia đình của gia chủ vạn sự an nhiên, hạnh phúc viên mãn hanh thông. <span class="red">XẤU</span></p>',
				],
				'hoa'  => [
					'nam'   => '<p>- Khi thiên can trụ năm thuộc hoá: Tốt cho việc Khai Trương và Tốt cho gia đạo thuận hoà. Bản thân với bố mẹ, cô dì chú bác của Chủ Sự có sự hoà hợp giúp đớ nhau trong cuộc sống cũng như công việc. Tình trạng hợp hóa là do khi thiên can của vợ/chồng kết hợp với địa chi của một trong 2 người tạo thành sự hợp hóa. Ám chỉ sự việc đồng lòng, thấu hiểu, hỗ trợ, tưong trợ, phù trợ, đồng cam cộng khổ, hiển vinh, thành đạt, thuận buồm xuôi gió. Nhưng quý vị cũng lên lưu ý: cái gì tốt quá hay vương quá cũng không hay, dễ sinh ra sự vui chơi xa đọa, xa sỉ, tự cao. Và bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh. <span class="red">TỐT</span></p>',
					'thang' => '<p>- Khi thiên can trụ tháng thuộc hoá: Tốt cho việc Khai Trương và Tốt cho gia đạo thuận hoà. Bản thân với anh chi em trong nhà có sự hoà hợp giúp đớ nhau trong cuộc sống có thể cùng anh chị em làm chung.
Hợp hóa chính là sự đồng lòng, hỗ trợ của mọi người xung quanh khiến cho công việc của bạn thuận lợi, dễ dàng hơn. Tuy nhiên bạn cũng cần nhớ rằng các thuật số này chỉ mang lại phần nhỏ đối với vận mệnh, phần lớn còn lại do sự năng lực cả bạn mà tạo thành. Không nên chủ quan, tự cao, tự đại mà khiến cho mọi việc không được tiến triển như ý muốn, gặp nhiều trắc trở. <span class="red">TỐT</span></p>',
					'ngay'  => '<p>- Khi thiên can trụ ngày thuộc hoá: Tốt cho việc Khai Trương và Tốt cho gia đạo thuận hoà, chồng/vợ có sự hoà hợp giúp đỡ nhau trong cuộc sống. Tốt cho công việc sau này được vạn sự như mong muốn. Sự hợp hóa được tạo nên nhờ sự kết hợp giữa thiên can địa chi của chủ mệnh với thiên can địa chi của ngày giờ muốn xem. Tình trạng hợp hóa sẽ giúp cho công việc của bạn nhận được sự giúp đỡ, tương trợ của mọi người rất nhiều. Điều này sẽ giúp cho công việc diễn ra thuận lợi, dễ dàng đạt được thành công như mong muốn. Tuy nhiên bạn cần chú ý các thuật số này chỉ mang lại phần nhỏ cho vận mệnh, phần lớn còn lại do chính bản thân bạn tạo lên. <span class="red">TỐT</span></p>',
					'gio'   => '<p>- Khi thiên can trụ giờ thuộc hoá: Tốt cho việc Khai Trương và Tốt cho Gia Chủ. Thuộc ngày may mắn, cát lành, công việc hanh thông. Tốt cho con cái sau này khoẻ mạnh, trợ giúp có hiếu với bề trên.
Tình trạng hợp hóa là do khi thiên can, địa chi của gia chủ kết hợp với thiên can, địa chi của năm, tháng, ngày, giờ cần xem tạo thành sự hợp hóa. Ám chỉ việc đồng lòng, thấu hiểu, hỗ trợ, tương trợ, phù trợ, đồng cam cộng khổ, hiển vinh, thành đạt, thuận buồm xuôi gió. Nhưng quý vị cũng lên lưu ý: cái gì tốt quá hay vương quá cũng không hay, dễ sinh ra sự vui chơi xa đọa, xa sỉ, tự cao, (Ở mục này hung hay cát cũng chưa nói lên điều gì? Bởi còn rất nhiều yếu tố của các mục khác tạo lên và thuật số chỉ mạng lại phần nhỏ với mỗi quý vị. Phần lớn là do chính quý vị tạo ra). <span class="red">TỐT</span></p>',
				],
				'hop'  => [
					'nam'   => '<p>- Khi thiên can trụ năm thuộc hợp: cũng có thể nói là tốt cho việc khai trương và có thể gọi tốt cho gia đạo thuận hoà. Bản thân với bố mẹ, cô dì chú bác của Chủ Sự được sự trợ giúp nhưng cũng dễ bị khắc khẩu.
Khi thiên can của vợ chồng hợp ám chỉ là một sự cát lành và rất đáng hoan hỷ. Tượng trưng cho sự hòa hợp, thấu hiểu, thuận hòa, đồng sức, đồng lòng, trên báo dưới nghe báo nhau làm ăn và cùng xây dựng tổ ấm. Nhưng quý vị cũng lên chú ý: cái gì tốt quá hay vương quá cũng không hay, dễ sinh ra sự vui chơi xa đọa, xa sỉ, tự cao. Và bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh. <span class="red">TỐT</span></p>',
					'thang' => '<p>- Khi thiên can trụ tháng thuộc hợp: cũng có thể nói là tốt cho việc khai trương và có thể gọi tốt cho gia đạo thuận hoà, bản thân với anh chi em trong nhà được sự trợ giúp nhưng cũng dễ bị khắc khẩu. Bên cạnh 2 quy luật cơ bản là tương sinh và tương khắc, trong ngũ hành còn có mối quan hệ tương hợp nữa. Nó mang lại nhiều sự hòa hợp, thấu hiểu, đồng lòng chứ không có khả năng thúc đẩy để phát triển và mang đến những lợi ích cụ thể cho chủ mệnh. Để nhận định mối quan hệ tương sinh hay tương khắc thì còn do cách nhìn và cảm nhận của bạn nữa. Các thuật số này chỉ mang đến phần nhỏ cho vận mệnh, phần lớn còn lại do sự cố gắng, nổ lực của bản thân bạn. <span class="red">TỐT</span></p>',
					'ngay'  => '<p>- Khi thiên can trụ ngày thuộc hợp: cũng có thể nói là tốt cho việc khai trương và có thể gọi tốt cho gia đạo, chồng/vợ hoà thuận vì cùng nhau làm ăn, nhưng cũng dễ bị khắc khẩu. Ngũ hành tương hợp là mối quan hệ không tốt cũng không xấu, không sinh cũng không khắc. Nó không thể thúc đẩy và mang đến những lợi ích mà là sự hòa hợp, đồng lòng của 2 niên mệnh. Nó giúp cho chủ sự có cuộc sống, tình cảm, gia đạo thuận lợi, ít mâu thuẫn, tranh chấp. Tuy nhiên để biết được 1 bản mệnh gặp hung hay cát phải dựa vào rất nhiều yếu tố. Các thuật số này chỉ mang đến 1 phần vận mệnh của bạn, còn lại phải dựa vào những nỗ lực của bạn trong cuộc sống. <span class="red">TỐT</span></p>',
					'gio'   => '<p>- Khi thiên can trụ giờ thuộc hợp: Tốt vợ chồng và con cái, dễ có con tài giỏi. Thuộc ngày may mắn, cát lành, nhưng cũng dễ khắc khẩu với nhau, nói thì vâng nhưng kệ không thực hiện. Hợp là chỉ sự hòa hợp, thấu hiểu, đồng lòng trong việc làm ăn, xây dựng tổ ấm. Chủ sự khi gặp ngũ hành này thì thường có cuộc sống thuận lợi, ít cãi vã, bất đồng quan điểm. Tuy nhiên cần chú ý cái gì tốt quá cũng không hay dễ sinh ra cảm giác tự cao, ăn chơi xa đọa. Tuy nhiên bạn cần nhớ rằng các thuật số này chỉ mang đến phần nhỏ cho vận mệnh, phần lớn còn lại dựa vào sự cố gắng của bản thân. <span class="red">TỐT</span></p>',
				],
			],
			'diachi'   => [
				'sinh' => [
					'nam'   => '<p>- Khi địa chi trụ năm thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt cho gia đạo thuận hoà, bản thân với bố mẹ, cô dì chú bác của Chủ Sự yêu quý, trợ giúp. Thuộc ngày may mắn, cát lành. Sinh ám chỉ về ngũ hành (Kim, Thủy, Mộc, Hỏa, Thổ) của các thiên can địa chi khi gặp nhau, tính theo hệ tương sinh của ngũ hành can chi. Khi có sự tương sinh Thì Gia Chủ nhận được sự hỗ trợ, nâng đỡ, bù đắp, nhẹ nhàng, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng tổ ấm, yêu thương tôn trọng lẫn nhau. Tuy nhiên bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh. <span class="red">TỐT</span></p>',
					'thang' => '<p>- Khi địa chi trụ tháng thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt cho gia đạo thuận hoà, bản thân với anh chi em trong nhà yêu quý, trợ giúp. Thuộc ngày may mắn, cát lành. Khi có sự tương sinh chủ sự sẽ nhận được nhiều may mắn, yêu thương, giúp đỡ mọi người xung quanh trong công việc, cuộc sống. Tuy nhận được nhiều sự nâng đỡ từ mọi người nhưng bạn cũng vẫn cần cố gắng. Bởi vận mệnh của bạn tốt hay xấu phụ thuộc rất nhiều vào sự cố gắng của bản mệnh. <span class="red">TỐT</span></p>',
					'ngay'  => '<p>- Khi địa chi trụ ngày thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt cho Gia Chủ. Thuộc ngày may mắn, cát lành, công việc hanh thông, làm gì cũng thuận. Vạn vật trong cuộc sống đều được phát sinh ra từ 5 yếu tố cơ bản Kim, Mộc, Thủy, Hỏa, Thổ và chúng được gọi là ngũ hành. Theo quy luật tương sinh của ngũ hành bạn sẽ nhận được nhiều sự giúp đỡ, hỗ trợ của mọi người xung quanh. Mọi lĩnh vực bạn làm đều diễn ra thuận lợi, hanh thông. Tuy nhiên bạn cần cố gắng hơn nữa bởi các thuật số chỉ mang lại 1 phần nhỏ với mỗi bản mệnh, phần lớn còn lại do bạn cố gắng tạo ra. <span class="red">TỐT</span></p>',
					'gio'   => '<p>- Khi địa chi trụ giờ thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt cho Gia Chủ. Thuộc ngày may mắn, cát lành, công việc hanh thông, tốt cho con cái sau này khoẻ mạnh. Sinh ám chỉ về ngũ hàng Kim, Thủy, Mộc, Hỏa, Thổ của các thiên can địa chi khi gặp nhau, tính theo hệ tương sinh của ngũ hành can chi. Khi có sự tương sinh thì chủ sự nhận được sự hỗ trợ, nâng đỡ, bù đắp, nhẹ nhàng, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, yêu thương tôn trọng lẫn nhau. (Ở mục này hung hay cát cũng chưa nói lên điều gì? Bởi còn rất nhiều yếu tố của các mục khác tạo lên. Và thuật số chỉ mạng lại một phần nhỏ với mỗi bản mệnh, phần lớn còn lại là do chính quý vị tạo ra). <span class="red">TỐT</span></p>',
				],
				'khac' => [
					'nam'   => '<p>- Khi địa chi trụ năm thuộc Khắc: Xấu cho việc Khai Trương và Xấu cho gia đạo khó thuận hoà, bản thân với bố mẹ, cô dì chú bác của Chủ Sự dễ bất đồng quan điểm, mọi việc chưa thông. Khi vợ chồng bị hai thiên can khắc nhau sẽ dễ gặp sự đối lập, sát phạt, khắc khẩu, bất đồng quan điểm, giống như nước với lửa. Sự góp ý của mình khiến họ khó chịu, sẽ xảy ra những tranh cãi. Nhưng quý vị cũng lên quá lo lắng bởi có khắc ắt có sinh, chỉ là do quý vị chưa biết cách hóa giải. Việc hóa giải không khó nhưng thuật toán hay phong thủy chỉ hỗ trợ được quý vị phần nhỏ, phần lớn còn lại là do chính bản thân quý vị mong muốn, nỗ lực để xây dựng và vun đắp tổ ấm của chính mình. Gia chủ có thể dùng ngũ hành thông quan sẽ hóa hung thành cát. Nếu bản thân chưa an tâm thì bạn có thể liên hệ với chuyên gia để tìm cách hóa giải chi tiết và hiệu quả. <span class="red">XẤU</span></p>',
					'thang' => '<p>- Khi địa chi trụ tháng thuộc Khắc: Xấu cho việc Khai Trương và Xấu cho gia đạo khó thuận hoà, bản thân với anh chị em  của Chủ Sự dễ bất đồng quan điểm, mọi việc chưa thông. Nếu ngũ hành tương sinh được hiểu là bồi đắp nuôi dưỡng của hành này cho hành kia. Thì ngũ hành tương khắc có nghĩa là sự đối lập, khắc chế, làm hao tổn lẫn nhau của 2 hành. Nhưng bạn cũng cần hiểu rằng có khắc ắt có sinh, nên khi 2 hành không hợp nhau chưa chắc đã là điều xấu. Vì vậy bạn không nên quá bận tâm bởi hung hay cát còn phải dựa vào rất nhiều yếu tố. Thuật số hay phong thủy chỉ mang đến phần nhỏ vận mệnh, phần lớn còn lại do sự nỗ lực của bạn. Nếu để an tâm hơn thì có thể liên hệ với các chuyên gia để hóa giải vận hạn. <span class="red">XẤU</span></p>',
					'ngay'  => '<p>- Khi địa chi trụ ngày thuộc Khắc: Xấu cho việc Khai Trương và Xấu cho gia đạo khó thuận hoà, chồng/vợ dễ bất đồng quan điểm, mọi việc chưa thông. Ngũ hành tương khắc là nói đến sự xung khắc giữa các hành với nhau. Hay gọi đúng tên bản chất của sự tương khắc là hành này khống chế và làm cho hành kia bị suy yếu, ảnh hưởng xấu. Tuy nhiên khi gặp vấn đề này bạn cũng không cần quá lo lắng, bởi có khắc ắt có sinh, chỉ là do quý vị chưa biết cách hóa giải. Việc hóa giải không hề khó nhưng thuật toán hay phong thủy chỉ hỗ trợ bạn được 1 phần, còn lại là do chính bản thân bạn. Để bản thân thêm an tâm thì bạn có thể liên hệ với các chuyên gia để hóa giải vận hạn xấu của bản mệnh.
<span class="red">XẤU</span></p>',
					'gio'   => '<p>- Khi địa chi trụ giờ thuộc Khắc: Xấu cho việc Khai Trương và Xấu cho gia đạo khó thuận hoà, chồng/vợ, con cái dễ bất đồng quan điểm, mọi việc chưa thông. Khi chủ sự bị hai thiên can khắc nhau sẽ dễ gặp sự đối lập, sát phạt, khắc khẩu, bất đồng quan điểm, có thể sự góp ý của mình khiến họ khó chịu, giống như lửa với nước. Nhưng quý vị cũng lên lưu ý, có khắc ắt có sinh, chỉ là do quý vị chưa biết cách hóa giải mà thôi. Việc hóa giải không khó nhưng thuật toán hay phong thủy chỉ hỗ trợ được quý vị phần nhỏ còn lại là do chính bản thân quý vị mong muốn, nỗ lực để xây dựng và vun đắp tổ ấm của chính mình. Gia chủ dùng ngũ hành thông quan sẽ hóa hung thành cát. <span class="red">XẤU</span></p>',
				],
				'tro'  => [
					'nam'   => '<p>- Khi địa chi trụ năm thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt cho gia đạo thuận hoà, bản thân với bố mẹ, cô dì chú bác của Chủ Sự được nhận sự nâng đỡ. Thuộc ngày may mắn, cát lành. Tương trợ là khi bạn gặp được mệnh niên phù hợp với mệnh của mình, người ta hay gọi đó là quý nhân. Khi gặp được mệnh tương trợ mọi việc bạn thực hiện đều dễ dàng, thuận lợi hơn từ sự nghiệp, tài vận đến tình cảm. Tuy nhiên để có được kết quả tốt nhất thì bạn cần cố gắng rất nhiều. Và những thuật số chỉ mang đến phần nhỏ vận mệnh, phần lớn còn lại đều dựa vào chính bản thân bạn. <span class="red">TỐT</span></p>',
					'thang' => '<p>- Khi địa chi trụ tháng thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt cho gia đạo thuận hoà, bản thân với anh chi em trong nhà được nhận sự nâng đỡ. Thuộc ngày may mắn, cát lành. Giống như 2 vợ chồng cùng ngũ hành. Ví dụ: chồng là Lộ Bàng Thổ vợ cũng là Lộ Bàng Thổ, hoặc Bích Thượng Thổ với Lộ Bàng Thổ… Trong ngũ hành thì sự tương trợ tốt ngần bằng tương sinh, tương sinh được ví như bố mẹ, còn tương trợ được ví như anh em, ám chỉ về ngũ hành (Kim, Thủy, Mộc, Hỏa, Thổ) của mệnh niên khi gặp nhau, tính theo hệ cùng ngũ hành, của ngũ hành mệnh niên của hai bên gặp nhau. Khi có sự tương trợ Thì Gia Chủ nhận được sự hỗ trợ, nâng đỡ, bù đắp, nhẹ nhàng, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng tổ ấm, yêu thương tôn trọng lẫn nhau. Tuy nhiên bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh <span class="red">TỐT</span></p>',
					'ngay'  => '<p>- Khi địa chi trụ ngày thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt vợ chồng thuận hoà, bảo nhau làm ăn, hỗ trợ trong công việc cũng như cuộc sống. Thuộc ngày may mắn, cát lành. Trong ngũ hành (Kim, Thủy, Mộc, Hỏa, Thổ) thì sự tương trợ tốt ngần bằng tương sinh, tương sinh được ví như bố mẹ, còn tương trợ ví như anh em của mệnh niên khi gặp nhau. Tính theo ngũ hành mệnh niên của hai bên gặp nhau, khi có sự tương trợ thì chủ sự nhận được sự hỗ trợ, nâng đỡ, bù đắp, nhẹ nhàng, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng tổ ấm, yêu thương tôn trọng lẫn nhau. (Ở một mục này hung hay cát cũng chưa nói lên điều gì? Bởi còn rất nhiều yếu tố của các mục khác tạo lên và thuật số chỉ mạng lại tới phần nhỏ, phần lớn là do chính quý vị tạo ra). <span class="red">TỐT</span></p>',
					'gio'   => '<p>- Khi địa chi trụ giờ thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt vợ chồng và con cái, dễ có con tài giỏi. Thuộc ngày may mắn, cát lành. Tương trợ là ám chỉ việc giúp đỡ, hỗ trợ lẫn nhau của 2 niên mệnh. Khi gặp được niên mệnh phù hợp với mệnh của bạn thân bạn sẽ nhận được nhiều sự nâng đỡ, chỉ bảo con đường đi đúng đắn, chính xác. Vì vậy nên vận thế của bạn ngày càng hanh thông, thuận lợi. Tuy nhiên để xác định được hung hay cát thì bạn cần dựa vào các yếu tố của các mục khác nữa. Và thuật số chỉ mang lại một phần nhỏ cho vận mệnh, phần lớn còn lại dựa vào những cố gắng, nỗ lực của bạn. <span class="red">TỐT</span></p>',
				],
				'hao'  => [
					'nam'   => '<p>- Khi địa chi trụ năm thuộc Hao: không Tốt không xấu cho việc Khai Trương và Tuy không xấu nhưng cũng không tốt, bản thân với bố mẹ, cô dì chú bác của Chủ Sự dửng dưng với nhau. Và bản thân hay bị hao tổn. Hao nghĩa là bản thân vợ hoặc chồng sinh trợ cho nhau. Trong kết hôn hao được tính là tốt như sinh. Trong ngũ hành sự Hao được ví như người cho đi, bản thân mình phải sinh ra và nuôi dưỡng. Trong hôn nhân khi gặp Hao thì cũng như hệ tương sinh, ám chỉ về ngũ hành Kim, Thủy, Mộc, Hỏa, Thổ của mệnh niên khi gặp nhau. Khi có sự tương sinh Thì Gia Chủ nhận được sự hỗ trợ, nâng đỡ, bù đắp, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng tổ ấm, yêu thương tôn trọng lẫn nhau. Tuy nhiên bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh.</p>',
					'thang' => '<p>- Khi địa chi trụ tháng thuộc Hao: không Tốt không xấu cho việc Khai Trương và Tuy không xấu nhưng cũng không tốt, bản thân với anh chi em trong nhà dửng dưng với nhau. Và bản thân hay bị hao tổn. Hao nghĩa là bản thân vợ hoặc chồng sinh trợ cho nhau. Ví dụ: vợ thiên can thuộc ngũ hành Mộc mà chồng thiên can thuộc ngũ hành Hỏa, thì chồng được sinh còn vợ bị hao. Sự Hao được ví như người cho đi, bản thân mình phải sinh ra và nuôi dưỡng. Trong kết hôn hao được tính là tốt như sinh. Trong hôn nhân khi gặp Hao thì cũng như hệ tương sinh, ám chỉ vợ chồng nhận được sự hỗ trợ, nâng đỡ, bù đắp, nhẹ nhàng, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng tổ ấm, yêu thương tôn trọng lẫn nhau. Tuy nhiên bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh.</p>',
					'ngay'  => '<p>- Khi địa chi trụ ngày thuộc Hao: không Tốt không xấu cho việc Khai Trương và Tuy không xấu nhưng cũng không tốt, chồng vợ dễ dửng dưng với nhau. Và bản thân hay bị hao tổn, thiệt thòi. Hao nghĩa là bản thân vợ hoặc chồng sinh trợ cho nhau, sự Hao được ví như người cho đi, bản thân mình phải sinh ra và nuôi dưỡng. Ví dụ: vợ thiên can thuộc ngũ hành Mộc mà chồng thiên can thuộc ngũ hành Hỏa, thì chồng được sinh còn vợ bị hao. Trong kết hôn hao được tính là tốt như sinh. Ám chỉ vợ chồng nhận được sự hỗ trợ, nâng đỡ, bù đắp, nhẹ nhàng, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng tổ ấm, yêu thương tôn trọng lẫn nhau. Tuy nhiên bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh. </p>',
					'gio'   => '<p>- Khi địa chi tru giờ thuộc Hao: không Tốt không xấu cho việc Khai Trương và Tuy không xấu nhưng cũng không tốt, bản thân bố mẹ với các con dửng dưng với nhau. Và bản thân hay bị hao tổn vì con. Hao nghĩa là bản thân vợ hoặc chồng sinh trợ cho nhau. Ví dụ: vợ thiên can thuộc ngũ hành Mộc mà chồng thiên can thuộc ngũ hành Hỏa, thì chồng được sinh còn vợ bị hao, trong kết hôn hao được tính là tốt như sinh. Trong ngũ hành sự Hao được ví như người cho đi, bản thân mình phải sinh ra và nuôi dưỡng. Trong hôn nhân khi gặp Hao thì cũng như hệ tương sinh, ám chỉ về ngũ hành (Kim, Thủy, Mộc, Hỏa, Thổ) của mệnh niên khi gặp nhau, tính theo hệ tương sinh của ngũ hành mệnh niên của hai bên gặp nhau. Khi có sự tương sinh Thì Gia Chủ nhận được sự hỗ trợ, nâng đỡ, bù đắp, nhẹ nhàng, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng tổ ấm, yêu thương tôn trọng lẫn nhau. Tuy nhiên bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh.</p>',
				],
				'xung' => [
					'nam'   => '<p>- Khi địa chi trụ năm thuộc xung: xấu cho việc Khai Trương và Xấu cho gia đạo, khó thuận hoà, bản thân với bố mẹ, cô dì chú bác của Chủ Sự dễ nói xấu nhau sau lưng. Sau này do đó mà vợ chồng phật ý nhau. Xung là chỉ sự xung khắc, có nhiều ý kiến trái ngược với nhau về tính cách, quan điểm và phong cách sống, làm việc. Mọi vật sinh ra và tồn tại đều có những ưu, khuyết điểm khác nhau. Mọi việc thành hay bại đều do bản thân mình, các thuật số chỉ mang tính chất dự đoán. Để có thể an tâm hơn cho công việc của mình thì bạn có thể liên hệ với các chuyên gia để hóa giải. Kính chúc quý gia chủ vạn sự an nhiên, hanh thông, hạnh phúc viên mãn. <span class="red">XẤU</span></p>',
					'thang' => '<p>- Khi địa chi trụ tháng thuộc xung: xấu cho việc Khai Trương và Xấu cho gia đạo, khó thuận hoà, bản thân với anh chi em trong nhà dễ nói xấu nhau sau lưng. Sau này do đó mà vợ chồng không vừa ý nhau. Xung ám chỉ sự dễ đối lập nhau, không đồng thuận, đồng lòng, ai cũng có cái lý của mình. Không có tiếng nói chung nên dẫn đến mỗi người một cách làm dẫn đến không đạt được kết quả như mong muốn. Vạn vật khi sinh ra và cùng tồn tại nên sẽ có cái ưu khuyết của riêng mình, trong đây không có sự đúng sai hơn thua mà là sự xây dựng bổ trợ. Ở mục này hung hay cát cũng chưa nói lên điều gì? Bởi còn rất nhiều yếu tố của các mục khác tạo lên và thuật số chỉ mạng lại phần ít với mỗi quý vị phần nhiều là do chính quý vị tạo ra. <span class="red">XẤU</span></p>',
					'ngay'  => '<p>- Khi địa chi trụ ngày thuộc xung: xấu cho việc Khai Trương và xấu cho gia đạo, khó thuận hoà, bản thân chồng/vợ chấp nhau trong cuộc sống. Sau này do đó mà vợ chồng hay để ý, nhỏ mọn với nhau.
Xung ám chỉ một sự việc dễ đối lập nhau, không đồng thuận, đồng lòng. Ai cũng có cái lý của mình, chưa có tiếng nói chung, dễ mỗi người một phách. Đôi lúc cái mình nghĩ sẽ tốt cho họ nhưng lại hại họ. Vợ chồng khi thiên can bị xung hãy đặt mình vào đối phương để suy nghĩ, bao dung, độ lượng, sẻ chia ắt giải được sự xung này. Bạn cũng nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh 1 phần nhỏ và phần lớn còn lại là do sự cố gắng của chính bản thân chủ mệnh. Vạn sự khởi từ tâm nhân, chúc gia đình của gia chủ vạn sự an nhiên, hạnh phúc viên mãn hanh thông. <span class="red">XẤU</span></p>',
					'gio'   => '<p>- Khi địa chi trụ giờ thuộc xung: xấu cho việc Khai Trương và Xấu cho gia đạo chồng/vợ, con cái dễ bất đồng khắc khẩu lẫn nhau. Xung ám chỉ mọi việc không đồng thuận với nhau, có nhiều ý kiến đối lập. không mang lại kết quả được như mong muốn. Mang đến nhiều điều rủi ro, không may mắn, cản trở công việc làm ăn, cuộc sống của nhau. Nhưng bạn cũng đừng quá lo lắng. bởi còn rất nhiều yếu tố của các mục khác tạo nên và thuật số chỉ mang tính chất dự đoán một phần và các phần còn lại do quý vị tạo ra. Để có thể an tâm hơn bạn có thể liên hệ với chuyên gia để hóa giải. <span class="red">XẤU</span></p>',
				],
				'hoa'  => [
					'nam'   => '<p>- Khi địa chi trụ năm thuộc hoá: Tốt cho việc Khai Trương và Tốt cho gia đạo thuận hoà, bản thân với bố mẹ, cô dì, chú bác của Chủ Sự có sự hoà hợp giúp đỡ lẫn nhau trong cuộc sống cũng như công việc.
Sự hợp hóa được tạo nên nhờ sự kết hợp giữa thiên can địa chi của chủ mệnh với thiên can địa chi của ngày giờ muốn xem. Tình trạng hợp hóa sẽ giúp cho công việc của bạn nhận được sự giúp đỡ, tương trợ của mọi người rất nhiều. Điều này sẽ giúp cho công việc diễn ra thuận lợi, dễ dàng đạt được thành công như mong muốn. Tuy nhiên bạn cần chú ý các thuật số này chỉ mang lại phần nhỏ cho vận mệnh, phần lớn còn lại do chính bản thân bạn tạo lên. <span class="red">TỐT</span></p>',
					'thang' => '<p>- Khi địa chi trụ tháng thuộc hoá: Tốt cho việc Khai Trương và Tốt cho gia đạo thuận hoà, bản thân với anh chi em trong nhà có sự hoà hợp giúp đỡ lẫn nhau trong cuộc sống, có thể cùng anh chị em làm ăn chung. Hợp hóa chính là sự đồng lòng, hỗ trợ của mọi người xung quanh khiến cho công việc của bạn thuận lợi, dễ dàng hơn. Tuy nhiên bạn cũng cần nhớ rằng các thuật số này chỉ mang lại phần nhỏ đối với vận mệnh, phần lớn còn lại do sự năng lực cả bạn mà tạo thành. Không nên chủ quan, tự cao, tự đại mà khiến cho mọi việc không được tiến triển như ý muốn, gặp nhiều trắc trở. <span class="red">TỐT</span></p>',
					'ngay'  => '<p>- Khi địa chi trụ ngày thuộc hoá: Tốt cho việc Khai Trương và Tốt cho gia đạo thuận hoà, chồng/vợ có sự hoà hợp giúp đỡ nhau trong cuộc sống, tốt cho công việc sau này được vạn sự như mong muốn. Tình trạng hợp hóa là do khi thiên can, địa chi của gia chủ kết hợp với thiên can, địa chi của năm, tháng, ngày, giờ cần xem tạo thành sự hợp hóa. Ám chỉ việc đồng lòng, thấu hiểu, hỗ trợ, tương trợ, phù trợ, đồng cam cộng khổ, hiển vinh, thành đạt, thuận buồm xuôi gió. Nhưng quý vị cũng lên lưu ý: cái gì tốt quá hay vương quá cũng không hay, dễ sinh ra sự vui chơi xa đọa, xa sỉ, tự cao, (Ở mục này hung hay cát cũng chưa nói lên điều gì? Bởi còn rất nhiều yếu tố của các mục khác tạo lên và thuật số chỉ mạng lại phần nhỏ với mỗi quý vị. Phần lớn là do chính quý vị tạo ra). <span class="red">TỐT</span></p>',
					'gio'   => '<p>- Trương và Tốt cho Gia Chủ. Thuộc ngày may mắn, cát lành, công việc hanh thông. Tốt cho con cái sau này khoẻ mạnh, trợ giúp có hiếu với người lớn tuổi trong nhà. Tình trạng hợp hóa là do khi thiên can của vợ/chồng kết hợp với địa chi của một trong 2 người tạo thành sự hợp hóa. Ám chỉ sự việc đồng lòng, thấu hiểu, hỗ trợ, tưong trợ, phù trợ, đồng cam cộng khổ, hiển vinh, thành đạt, thuận buồm xuôi gió. Nhưng quý vị cũng lên lưu ý: cái gì tốt quá hay vương quá cũng không hay, dễ sinh ra sự vui chơi xa đọa, xa sỉ, tự cao. Và bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh. <span class="red">TỐT</span></p>',
				],
				'hop'  => [
					'nam'   => '<p>- Khi địa chi trụ năm thuộc hợp: cũng có thể nói là tốt cho việc khai trương và có thể gọi tốt cho gia đạo thuận hoà, bản thân với bố mẹ, cô dì, chú bác của Chủ Sự được sự trợ giúp nhưng cũng dễ bị khắc khẩu. Bên cạnh 2 quy luật cơ bản là tương sinh và tương khắc, trong ngũ hành còn có mối quan hệ tương hợp nữa. Nó mang lại nhiều sự hòa hợp, thấu hiểu, đồng lòng chứ không có khả năng thúc đẩy để phát triển và mang đến những lợi ích cụ thể cho chủ mệnh. Để nhận định mối quan hệ tương sinh hay tương khắc thì còn do cách nhìn và cảm nhận của bạn nữa. Các thuật số này chỉ mang đến phần nhỏ cho vận mệnh, phần lớn còn lại do sự cố gắng, nổ lực của bản thân bạn. <span class="red">TỐT</span></p>',
					'thang' => '<p>- Khi địa chi trụ tháng thuộc hợp: cũng có thể nói là tốt cho việc khai trương và có thể gọi tốt cho gia đạo thuận hoà, bản thân với anh chi em trong nhà được sự trợ giúp nhưng cũng dễ bị khắc khẩu. Khi thiên can của vợ chồng hợp ám chỉ là một sự cát lành và rất đáng hoan hỷ. Tượng trưng cho sự hòa hợp, thấu hiểu, thuận hòa, đồng sức, đồng lòng, trên báo dưới nghe báo nhau làm ăn và cùng xây dựng tổ ấm. Nhưng quý vị cũng lên chú ý: cái gì tốt quá hay vương quá cũng không hay, dễ sinh ra sự vui chơi xa đọa, xa sỉ, tự cao. Và bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh. <span class="red">TỐT</span></p>',
					'ngay'  => '<p>- Khi địa chi trụ ngày thuộc hợp: cũng có thể nói là tốt cho việc khai trương và có thể gọi tốt cho gia đạo, chồng/vợ hoà thuận vì nhau, cùng làm ăn, nhưng cũng dễ bị khắc khẩu. Hợp là chỉ sự hòa hợp, thấu hiểu, đồng lòng trong việc làm ăn, xây dựng tổ ấm. Chủ sự khi gặp ngũ hành này thì thường có cuộc sống thuận lợi, ít cãi vã, bất đồng quan điểm. Tuy nhiên cần chú ý cái gì tốt quá cũng không hay dễ sinh ra cảm giác tự cao, ăn chơi xa đọa. Tuy nhiên bạn cần nhớ rằng các thuật số này chỉ mang đến phần nhỏ cho vận mệnh, phần lớn còn lại dựa vào sự cố gắng của bản thân.
<span class="red">TỐT</span></p>',
					'gio'   => '<p>- Khi địa chi trụ giờ thuộc hợp: Tốt vợ chồng và con cái, dễ có con tài giỏi. Thuộc ngày may mắn, cát lành, nhưng cũng dễ khắc khẩu với nhau, nói thì vâng nhưng không thực hiện. Ngũ hành tương hợp là mối quan hệ không tốt cũng không xấu, không sinh cũng không khắc. Nó không thể thúc đẩy và mang đến những lợi ích mà là sự hòa hợp, đồng lòng của 2 niên mệnh. Nó giúp cho chủ sự có cuộc sống, tình cảm, gia đạo thuận lợi, ít mâu thuẫn, tranh chấp. Tuy nhiên để biết được 1 bản mệnh gặp hung hay cát phải dựa vào rất nhiều yếu tố. Các thuật số này chỉ mang đến 1 phần vận mệnh của bạn, còn lại phải dựa vào những nỗ lực của bạn trong cuộc sống. <span class="red">TỐT</span></p>',
				],
				'pha'  => [
					'nam'   => '<p>- Khi địa chi trụ năm thuộc phá: là xấu cho việc Khai Trương và Gia Đạo bản thân với bố mẹ, cô dì chú bác của Chủ Sự dễ chọc phá nhau, bằng mặt không bằng lòng. Sau này do đó mà vợ chồng phật ý nhau. Phá ám chỉ có nhiều sự ngăn cản, đối lập với nhau, cản trở công việc. Nếu thực hiện làm ăn chung với nhau thì thường có những ý kiến trái chiều, không đồng nhất ý kiến khiến việc giải quyết các vấn đề không tốt. Nó có thể làm ảnh hưởng đến kết quả, hao tổn tiền bạc của bạn. Nếu ở gần nhau sẽ dễ sinh ra chia ly, đau khổ dành cho bạn. Nhưng quý vị cũng lên lưu ý, có hung ắt có cát, chỉ là do quý vị chưa biết cách hóa giải mà thôi. Việc hóa giải không khó nhưng thuật toán hay phong thủy chỉ hỗ trợ được quý vị một phần nhỏ còn phần lớn là do chính bản thân quý vị mong muốn, nỗ lực để xây dựng và vun đắp tổ ấm của chính mình. Gia chủ dùng ngũ hành thông quan sẽ hóa hung thành cát. <span class="red">XẤU</span></p>',
					'thang' => '<p>- Khi địa chi trụ tháng thuộc phá: là xấu cho việc Khai Trương và Xấu cho gia đạo, bản thân với anh chi em trong nhà dễ chọc phá nhau, bằng mặt không bằng lòng. Sau này do đó mà vợ chồng không vui, không vừa ý với nhau. Phá là thường không tìm được tiếng nói chung, hay xảy ra mâu thuẫn và dễ cãi vã nhau trong những cuộc tranh luận. Vì vậy nên thường không đạt được hiệu quả như mong muốn. Nếu ở với nhau lâu dài có thể khiến cãi vã, chia ly. Nhiều khi còn khiến bản cảm thấy mệt mỏi, khó chịu. Nhưng bạn cũng cần hiểu rằng có hung ắt có cát, nên khi 2 hành không hợp nhau chưa chắc đã là điều xấu. Vì vậy bạn không nên quá bận tâm bởi hung hay cát còn phải dựa vào rất nhiều yếu tố. Thuật số hay phong thủy chỉ mang đến phần nhỏ vận mệnh, phần lớn còn lại do sự nỗ lực của bạn. Nếu để an tâm hơn thì có thể liên hệ với các chuyên gia để hóa giải vận hạn. <span class="red">XẤU</span></p>',
					'ngay'  => '<p>- Khi địa chi trụ ngày thuộc phá: là xấu cho việc Khai Trương và Gia Đạo chồng/vợ dễ bị bên ngoài tác động vào mà trở nên không thuận hoà, dễ gặp khó khăn, đi sai đường trong làm ăn nếu tâm trí không vững. Phá chính là thường xuyên xảy ra mâu thuẫn, có những ý tưởng, đề xuất trái ngược nhau khiến cho các mâu thuẫn không được giải quyết triệt để do không có tiếng nói chung. Vì vậy nên việc làm ăn sẽ trở nên khó khăn, không đạt được hiệu quả như mong muốn. Còn chuyện tình cảm sẽ gặp nhiều bất lợi, cảm thấy khó chịu, ngột ngạt dẫn đến không được hạnh phúc. Tuy nhiên khi gặp vấn đề này bạn cũng không cần quá lo lắng, bởi có hung ắt có cát, chỉ là do quý vị chưa biết cách hóa giải. Việc hóa giải không hề khó nhưng thuật toán hay phong thủy chỉ hỗ trợ bạn được 1 phần, còn lại là do chính bản thân bạn. Để bản thân thêm an tâm thì bạn có thể liên hệ với các chuyên gia để hóa giải vận hạn xấu của bản mệnh. <span class="red">XẤU</span></p>',
					'gio'   => '<p>- Khi địa chi trụ giờ thuộc phá: là xấu cho việc Khai Trương và Gia Đạo chồng/vợ con cái dễ không thuận hoà, con cái dễ phá của, tiền tài của bố mẹ, làm bố mẹ hao tiền bạc. Khi địa chi tương phá dễ thường không tìm được tiếng nói chung trong cuộc sống gia đình, hay xảy ra mâu thuẫn và dễ cãi vã nhau trong những cuộc tranh luận. Vợ chồng dễ xảy ra mâu thuẫn là thường có lý tưởng và suy nghĩ hoàn toàn đối lập nhau. Có nhiều sự ngăn cản, cản trở lẫn nhau, vợ chồng có làm ăn chung thì dễ có những ý kiến trái chiều khiến mọi việc không đi tới đâu. Ngoài ra còn có sự kìm hãm, làm ăn khó khăn, vợ chồng ở gần sẽ dễ sinh ra mỗi người một phòng. Nếu ở với nhau thì cần có những biện pháp giải phá. Nhưng có hung ắt có cát, quan trọng là chúng ta nhìn nhận ra và muốn có sự tốt đẹp hơn là hóa giải được. Và bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh.
 <span class="red">XẤU</span></p>',
				],
				'hai'  => [
					'nam'   => '<p>- Khi địa chi trụ năm thuộc hại: Là xấu cho khai trương và gia đạo, bản thân với bố mẹ, cô dì, chú bác của Chủ Sự dễ vì cái trước mắt mà bỏ qua tình nghĩa, nặng về vật chất hơn. Cũng vì điều này mà vợ chồng hay buồn vui thất thường. Người xưa quan niệm rằng khi chọn ngày mà phạm Lục hại sẽ khó được bền vững, chủ sự thường xuyên cãi cọ, gia đình lục đục, con cái dễ theo bố me mà hư hỏng. Gia đình mỗi người một phách, ai cũng có lý của người đó, không có tiếng nói chung. Đôi khi còn vô tinh hại nhau vì sự ích kỷ của bản thân và cái tôi của mình. Thậm chí trường hợp nặng còn khiến kinh doanh thất bát, làm ăn thua lỗ, tán gia bại sản và hại lẫn nhau. Nhưng quý vị lên lưu ý có hung ắt có cát, chỉ hung khi chúng ta không biết phương pháp giải quyết hoặc không muốn giải quyết mà thôi. (Ở mục này hung hay cát cũng chưa nói lên điều gì? Bởi còn rất nhiều yếu tố của các mục khác tạo lên và thuật số chỉ mạng lại phần nhỏ với mỗi bản mệnh. Phần lớn là do chính cố gắng, nỗ lực của quý vị tạo ra).  <span class="red">XẤU</span></p>',
					'thang' => '<p>- Khi địa chi trụ tháng thuộc hại: Xấu cho khai trương và gia đạo, bản thân với anh chi em trong nhà dễ vì cái trước mắt mà bỏ qua tình nghĩa, nặng về vật chất hơn. Cũng vì điều này mà vợ chồng hay buồn vui thất thường. Lục hại chính là mỗi người sẽ có một ý kiến riêng, trái chiều với nhau. Lý tưởng, suy nghĩ, phong cách sống không đồng nhất với nhau khiến cho gia đình không hạnh phúc, công việc làm ăn khó khăn. Nếu bị ảnh hưởng nặng còn làm hao tổn nhiều tiền bạc, phá sản, gia đình lục đục không hạnh phúc. Nhiều khi có thể vô tình hãm hại nhau để bản thân đạt được những lợi ích riêng. Để hóa giải vận hạn này không khó, chỉ cần bạn mong muốn và tìm hướng giải quyết cho các vấn đề này. Các thuật số hay phong thủy chỉ mang lại một phần nhỏ ảnh hưởng đến vận mệnh, phần lớn còn lại do chính bản thân bạn cố gắng tạo ra. <span class="red">XẤU</span></p>',
					'ngay'  => '<p>- Khi địa chi trụ ngày thuộc hại: Là xấu cho khai trương và gia đạo, chồng/vợ dễ vì cái bên ngoài mà bỏ qua cái cốt lõi, nặng về vật chất hơn. Xong lại hay bi quan, tới đâu thì tới, xây thì xây, mà không xây thì đừng. 
Phạm lục hại sẽ khiến cho gia đình không được hạnh phúc, yên ấm do cãi vã, mâu thuẫn các quan điểm, cách sống. Mỗi người trong gia đình sẽ có 1 ý kiến riêng, không đồng nhất quan điểm nên nhiều khi có thể vô tình làm tổn hại lẫn nhau. Thậm chí trong trường hợp nặng còn khiến tán gia bại sản, hãm hại lẫn nhau. Tuy nhiên bạn cũng cần lưu ý có hung ắt có cát nên mọi việc đều có thể hóa giải nếu trong tâm bạn muốn giải quyết vấn đề này 1 cách trọn vẹn, đúng đắn. Và bạn cũng cần nhớ rằng thuật số hay phong thủy chỉ mang đến phần nhỏ vận mệnh, phần lớn còn lại do sự nỗ lực của bạn. Nếu để an tâm hơn thì có thể liên hệ với các chuyên gia để hóa giải vận hạn. <span class="red">XẤU</span></p>',
					'gio'   => '<p>- Khi địa chi trụ giờ thuộc hại: Là  xấu cho khai trương và gia đạo, chồng/vợ con cái dễ mất của vào những việc không đâu. Vì con cái mà bố mẹ, hao tiền của “con dại cái mang”.
Phá là thường không tìm được tiếng nói chung, hay xảy ra mâu thuẫn và dễ cãi vã nhau trong những cuộc tranh luận. Vì vậy nên thường không đạt được hiệu quả như mong muốn. Nếu ở với nhau lâu dài có thể khiến cãi vã, chia ly. Nhiều khi còn khiến bản cảm thấy mệt mỏi, khó chịu. Nhưng bạn cũng cần hiểu rằng có hung ắt có cát, nên khi 2 hành không hợp nhau chưa chắc đã là điều xấu. Vì vậy bạn không nên quá bận tâm bởi hung hay cát còn phải dựa vào rất nhiều yếu tố. Thuật số hay phong thủy chỉ mang đến phần nhỏ vận mệnh, phần lớn còn lại do sự nỗ lực của bạn. Nếu để an tâm hơn thì có thể liên hệ với các chuyên gia để hóa giải vận hạn. <span class="red">XẤU</span></p>',
				],
				'hinh' => [
					'nam'   => '<p>- Khi địa chi trụ năm thuộc hình: Là Xấu cho khai trương và gia đạo, bản thân với bố mẹ, cô dì, chú bác của Chủ Sự dễ vì cái trước mắt mà bỏ qua tình nghĩa, hay chiếu tướng nhau. Vì người ngoài mà quên người nhà, cũng bởi điều này mà vợ chồng bị tác động tâm lý không tốt. Hình là chỉ chủ mệnh có thể gặp phải tai ương, những vấn đề liên quan đến pháp lý. Ngoài ra việc này còn ảnh hưởng đến những người thân trong gia đình khiến cho hóa khí gia đạo kém. Tuy nhiên bạn không cần quá lo lắng vì nếu bạn nhìn nhận được vấn đề đúng sai và có hướng giải quyết nhanh chóng. Thì mọi vận hung đều hóa cát lành. Vì vậy nên thuật số này chỉ mang lại phần nhỏ vận mệnh, phần lớn còn lại do chính bạn tạo ra. <span class="red">XẤU</span></p>',
					'thang' => '<p>- Khi địa chi trụ tháng thuộc hình: Là Xấu cho khai trương và gia đạo, bản thân với anh chi em trong nhà dễ chiếu tướng nhau, vì người ngoài mà quên người nhà, chỉ nhìn được cái trước mắt. Lúc cần mới nhìn đến nhau để nhờ sự giúp đỡ. Trong hôn nhân ám chỉ sự, lời ra tiếng vào dễ sinh ra những vấn đề dính tới pháp luật, dễ đối chọi lại nhau. Ngoài việc vợ chồng còn liên quan tới con cái, bố mẹ và con tổn hại lẫn nhau. Ám chỉ dễ có sự hiểm trở, tai ương, quan họa, họ đối sự với mình như nào thì mình đáp lại. Khi tận cùng còn dễ vì bản thân mà lấy oán báo ân, vợ chồng tự làm tổn hại lẫn nhau, đôi lúc dễ tự có sự nhiễu loạn. Nhưng có hung ắt có cát, quan trọng là chúng ta nhìn nhận ra và muốn có sự tốt đẹp hơn là hóa giải được. Tuy nhiên bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh. <span class="red">XẤU</span></p>',
					'ngay'  => '<p>- Khi địa chi trụ ngày thuộc hình: Là Xấu cho khai trương và gia đạo, bản thân chồng/vợ dễ chiếu tướng nhau, tốt và nghe lời người ngoài hơn người nhà, xem nhẹ lẫn nhau. Vợ chồng cần thấu hiểu sẻ chia với nhau, luôn biết nhận lỗi về mình, sẽ hoá giải được điều xấu này.
Trong xét ngày hung cát Hình ám chỉ sự, lời ra tiếng vào dễ sinh ra những vấn đề dính tới pháp luật, dễ đối chọi lại nhau. Ngoài việc chủ sự còn liên quan tới con cái, bố mẹ và con tổn hại lẫn nhau. Nó làm ảnh hưởng rất nhiều đến công việc, cuộc sống tình cảm của gia đình. Cách hóa giải tốt nhất tình trạng này chính là sự nhìn nhận và cố gắng muốn mọi việc trở nên tốt hơn. Và các thuật số này chỉ mang phần nhỏ cho vận mệnh, phần lớn còn lại là do sự cố gắng từ chính chủ mệnh. <span class="red">XẤU</span></p>',
					'gio'   => '<p>- Khi địa chi trụ giờ thuộc hình: Là Xấu cho khai trương và gia đạo, bản thân chồng/vợ con cái dễ chiếu tướng nhau, tốt và nghe lời người ngoài hơn người nhà, xem nhẹ lẫn nhau. Gia đình cần thấu hiểu sẻ chia, bao dung và vì nhau, sẽ hoá giải được điều xấu này. Hình chính là ám chỉ dễ có sự hiểm trở, tai ương, tai họa dẫn đến cửa quan. Với tính cách của bạn thì họ đối sử với mình như nào thì mình đáp lại như vậy. Chính vì vậy nhiều khi tự làm tổn hại lẫn nhau, đôi lúc có sự nhiể loạn, do vì bản thân mà lấy oán báo ânNhưng bạn cần lưu ý có hung ắt có cát, quan trọng là chúng ta nhìn nhận ra và muốn có sự tốt đẹp hơn là hóa giải được. (Ở mục này hung hay cát cũng chưa nói lên điều gì? Bởi còn rất nhiều yếu tố của các mục khác tạo lên và thuật số chỉ mạng lại phần nhỏ, phần lớn là do chính quý vị cố gắng tạo ra).<span class="red">XẤU</span></p>',
				],
			],
			'nap_am'   => [
				'sinh' => [
					'nam'   => '<p>- Khi nạp âm trụ năm thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt cho gia đạo thuận hoà, bản thân với bố mẹ, cô dì, chú bác của Chủ Sự yêu quý, trợ giúp. Thuộc ngày may mắn, cát lành. Sinh ám chỉ về ngũ hành (Kim, Thủy, Mộc, Hỏa, Thổ) của các thiên can địa chi khi gặp nhau, tính theo hệ tương sinh của ngũ hành can chi. Khi có sự tương sinh Thì Gia Chủ nhận được sự hỗ trợ, nâng đỡ, bù đắp, nhẹ nhàng, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng tổ ấm, yêu thương tôn trọng lẫn nhau. Tuy nhiên bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh. <span class="red">TỐT</span></p>',
					'thang' => '<p>- Khi nạp âm trụ tháng thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt cho gia đạo thuận hoà, bản thân với anh chi em trong nhà yêu quý, trợ giúp. Thuộc ngày may mắn, cát lành. Ngũ hành tương sinh là các mệnh tương sinh hỗ trợ, thúc đẩy nhau phát triển. Khi có sự tương sinh thì chủ sự nhận được nhiều sự nâng đỡ, đùm bọc của mọi người xung quanh giúp cho công việc, cuộc sống dễ dàng hơn. Trong tình yêu thì nhận được sự yêu thương, tôn trọng, đối xử nhẹ nhàng của người bạn đời. Tuy nhiên để xác định được hung hay cát thì bạn cần dựa vào các yếu tố của các mục khác nữa. Và thuật số chỉ mang lại phần nhỏ cho vận mệnh, phần lớn còn lại dựa vào những cố gắng, nỗ lực của bạn. <span class="red">TỐT</span></p>',
					'ngay'  => '<p>- Khi nạp âm trụ ngày thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt cho Gia Chủ. Thuộc ngày may mắn, cát lành, công việc hanh thông, làm gì cũng thuận. Khi có sự tương sinh chủ sự sẽ nhận được nhiều may mắn, yêu thương, giúp đỡ mọi người xung quanh trong công việc, cuộc sống. Tuy nhận được nhiều sự nâng đỡ từ mọi người nhưng bạn cũng vẫn cần cố gắng. Bởi vận mệnh của bạn tốt hay xấu phụ thuộc rất nhiều vào sự cố gắng của bản mệnh. <span class="red">TỐT</span></p>',
					'gio'   => '<p>- Khi nạp âm trụ giờ thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt cho Gia Chủ. Thuộc ngày may mắn, cát lành, công việc hanh thông. Tốt cho con cái sau này khoẻ mạnh. Sinh ám chỉ về ngũ hàng Kim, Thủy, Mộc, Hỏa, Thổ của các thiên can địa chi khi gặp nhau, tính theo hệ tương sinh của ngũ hành can chi. Khi có sự tương sinh thì chủ sự nhận được sự hỗ trợ, nâng đỡ, bù đắp, nhẹ nhàng, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, yêu thương tôn trọng lẫn nhau. (Ở mục này hung hay cát cũng chưa nói lên điều gì? Bởi còn rất nhiều yếu tố của các mục khác tạo lên. Và thuật số chỉ mạng lại một phần nhỏ với mỗi bản mệnh, phần lớn còn lại là do chính quý vị tạo ra). <span class="red">TỐT</span></p>',
				],
				'khac' => [
					'nam'   => '<p>- Khi nạp âm trụ năm thuộc Khắc: Xấu cho việc Khai Trương và Xấu cho gia đạo khó thuận hoà, bản thân với bố mẹ, cô dì chú bác của Chủ Sự dễ bất đồng quan điểm, mọi việc chưa thông. Khi vợ chồng bị hai thiên can khắc nhau sẽ dễ gặp sự đối lập, sát phạt, khắc khẩu, bất đồng quan điểm, giống như nước với lửa. Sự góp ý của mình khiến họ khó chịu, sẽ xảy ra những tranh cãi. Nhưng quý vị cũng lên quá lo lắng bởi có khắc ắt có sinh, chỉ là do quý vị chưa biết cách hóa giải. Việc hóa giải không khó nhưng thuật toán hay phong thủy chỉ hỗ trợ được quý vị phần nhỏ, phần lớn còn lại là do chính bản thân quý vị mong muốn, nỗ lực để xây dựng và vun đắp tổ ấm của chính mình. Gia chủ có thể dùng ngũ hành thông quan sẽ hóa hung thành cát. Nếu bản thân chưa an tâm thì bạn có thể liên hệ với chuyên gia để tìm cách hóa giải chi tiết và hiệu quả. <span class="red">XẤU</span></p>',
					'thang' => '<p>- Khi nạp âm trụ tháng thuộc Khắc: Xấu cho việc Khai Trương và Xấu cho gia đạo khó thuận hoà, bản thân với anh chị em của Chủ Sự dễ bất đồng quan điểm, mọi việc chưa thông. Nếu ngũ hành tương sinh được hiểu là bồi đắp nuôi dưỡng của hành này cho hành kia. Thì ngũ hành tương khắc có nghĩa là sự đối lập, khắc chế, làm hao tổn lẫn nhau của 2 hành. Nhưng bạn cũng cần hiểu rằng có khắc ắt có sinh, nên khi 2 hành không hợp nhau chưa chắc đã là điều xấu. Vì vậy bạn không nên quá bận tâm bởi hung hay cát còn phải dựa vào rất nhiều yếu tố. Thuật số hay phong thủy chỉ mang đến phần nhỏ vận mệnh, phần lớn còn lại do sự nỗ lực của bạn. Nếu để an tâm hơn thì có thể liên hệ với các chuyên gia để hóa giải vận hạn. <span class="red">XẤU</span></p>',
					'ngay'  => '<p>- Khi nạp âm trụ ngày thuộc Khắc: Xấu cho việc Khai Trương và Xấu cho gia đạo khó thuận hoà, chồng/vợ dễ bất đồng quan điểm, mọi việc chưa thông. Tương khắc được hiểu là sự khắc chế, bài trừ, đối lập, kìm hãm sự phát triển của nhau. Hóa giải được sự tương khắc này sẽ sinh ra những điều tốt đẹp, vì có khắc ắt có sinh. Tuy nhiên việc hóa giải chỉ hỗ trợ được bạn 30%, 70% còn lại dựa vào những cố gắng của bạn. Vì vậy nên cách hóa giải tốt nhất đó chính là dựa vào chính sự nỗ lực của bản thân sẽ làm thay đổi vận mệnh. (Ở mục này hung hay cát cũng chưa nói lên điều gì? Bởi còn rất nhiều yếu tố của các mục khác tạo lên và thuật số chỉ mạng lại phần nhỏ với vận mệnh. Phần lớn còn lại là do chính quý vị nỗ lực tạo ra). <span class="red">XẤU</span></p>',
					'gio'   => '<p>- Khi nạp âm trụ giờ thuộc Khắc: Xấu cho việc Khai Trương và Xấu cho gia đạo khó thuận hoà, chồng/vợ, con cái dễ bất đồng quan điểm, mọi việc chưa thông. Ngũ hành tương khắc là nói đến sự xung khắc giữa các hành với nhau. Hay gọi đúng tên bản chất của sự tương khắc là hành này khống chế và làm cho hành kia bị suy yếu, ảnh hưởng xấu. Tuy nhiên khi gặp vấn đề này bạn cũng không cần quá lo lắng, bởi có khắc ắt có sinh, chỉ là do quý vị chưa biết cách hóa giải. Việc hóa giải không hề khó nhưng thuật toán hay phong thủy chỉ hỗ trợ bạn được 1 phần, còn lại là do chính bản thân bạn. Để bản thân thêm an tâm thì bạn có thể liên hệ với các chuyên gia để hóa giải vận hạn xấu của bản mệnh. <span class="red">XẤU</span></p>',
				],
				'tro'  => [
					'nam'   => '<p>- Khi nạp âm trụ năm thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt cho gia đạo thuận hoà, bản thân với bố mẹ, cô dì chú bác của Chủ Sự được nhận sự nâng đỡ. Thuộc ngày may mắn, cát lành. Giống như 2 vợ chồng cùng ngũ hành. Ví dụ: chồng là Lộ Bàng Thổ vợ cũng là Lộ Bàng Thổ, hoặc Bích Thượng Thổ với Lộ Bàng Thổ… Trong ngũ hành thì sự tương trợ tốt ngần bằng tương sinh, tương sinh được ví như bố mẹ, còn tương trợ được ví như anh em, ám chỉ về ngũ hành (Kim, Thủy, Mộc, Hỏa, Thổ) của mệnh niên khi gặp nhau, tính theo hệ cùng ngũ hành, của ngũ hành mệnh niên của hai bên gặp nhau. Khi có sự tương trợ Thì Gia Chủ nhận được sự hỗ trợ, nâng đỡ, bù đắp, nhẹ nhàng, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng tổ ấm, yêu thương tôn trọng lẫn nhau. Tuy nhiên bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh. <span class="red">TỐT</span></p>',
					'thang' => '<p>- Khi nạp âm trụ tháng thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt cho gia đạo thuận hoà, bản thân với anh chi em trong nhà được nhận sự nâng đỡ. Thuộc ngày may mắn, cát lành. Tương trợ là khi bạn gặp được mệnh niên phù hợp với mệnh của mình, người ta hay gọi đó là quý nhân. Khi gặp được mệnh tương trợ mọi việc bạn thực hiện đều dễ dàng, thuận lợi hơn từ sự nghiệp, tài vận đến tình cảm. Tuy nhiên để có được kết quả tốt nhất thì bạn cần cố gắng rất nhiều. Và những thuật số chỉ mang đến phần nhỏ vận mệnh, phần lớn còn lại đều dựa vào chính bản thân bạn. <span class="red">TỐT</span></p>',
					'ngay'  => '<p>- Khi nạp âm trụ ngày thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt vợ chồng thuận hoà, bảo nhau làm nhau ăn, hỗ trợ trong công việc cũng như cuộc sống. Thuộc ngày may mắn, cát lành. Tương trợ là ám chỉ việc giúp đỡ, hỗ trợ lẫn nhau của 2 niên mệnh. Khi gặp được niên mệnh phù hợp với mệnh của bạn thân bạn sẽ nhận được nhiều sự nâng đỡ, chỉ bảo con đường đi đúng đắn, chính xác. Vì vậy nên vận thế của bạn ngày càng hanh thông, thuận lợi. Tuy nhiên để xác định được hung hay cát thì bạn cần dựa vào các yếu tố của các mục khác nữa. Và thuật số chỉ mang lại một phần nhỏ cho vận mệnh, phần lớn còn lại dựa vào những cố gắng, nỗ lực của bạn. <span class="red">TỐT</span></p>',
					'gio'   => '<p>- Khi nạp âm trụ giờ thuộc Sinh/Trợ: Tốt cho việc Khai Trương và Tốt vợ chồng và con cái, dễ có con tài giỏi. Thuộc ngày may mắn, cát lành. Trong ngũ hành (Kim, Thủy, Mộc, Hỏa, Thổ) thì sự tương trợ tốt ngần bằng tương sinh, tương sinh được ví như bố mẹ, còn tương trợ ví như anh em của mệnh niên khi gặp nhau. Tính theo ngũ hành mệnh niên của hai bên gặp nhau, khi có sự tương trợ thì chủ sự nhận được sự hỗ trợ, nâng đỡ, bù đắp, nhẹ nhàng, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng tổ ấm, yêu thương tôn trọng lẫn nhau. (Ở một mục này hung hay cát cũng chưa nói lên điều gì? Bởi còn rất nhiều yếu tố của các mục khác tạo lên và thuật số chỉ mạng lại tới phần nhỏ, phần lớn là do chính quý vị tạo ra). <span class="red">TỐT</span></p>',
				],
				'hao'  => [
					'nam'   => '<p>- Khi nạp âm trụ năm thuộc Hao: không Tốt không xấu cho việc Khai Trương và Tuy không xấu nhưng cũng không tốt, bản thân với bố mẹ, cô dì chú bác của Chủ Sự dửng dưng với nhau và bản thân hay bị hao tổn. Hao nghĩa là bản thân vợ hoặc chồng sinh trợ cho nhau. Ví dụ: vợ thiên can thuộc ngũ hành Mộc mà chồng thiên can thuộc ngũ hành Hỏa, thì chồng được sinh còn vợ bị hao. Sự Hao được ví như người cho đi, bản thân mình phải sinh ra và nuôi dưỡng. Trong kết hôn hao được tính là tốt như sinh. Trong hôn nhân khi gặp Hao thì cũng như hệ tương sinh, ám chỉ vợ chồng nhận được sự hỗ trợ, nâng đỡ, bù đắp, nhẹ nhàng, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng tổ ấm, yêu thương tôn trọng lẫn nhau. Tuy nhiên bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh.</p>',
					'thang' => '<p>- Khi nạp âm trụ tháng thuộc Hao: không Tốt không xấu cho việc Khai Trương và Tuy không xấu nhưng cũng không tốt, bản thân với anh chi em trong nhà dửng dưng với nhau và bản thân hay bị hao tổn. Hao nghĩa là bản thân vợ hoặc chồng sinh trợ cho nhau, sự Hao được ví như người cho đi, bản thân mình phải sinh ra và nuôi dưỡng. Ví dụ: vợ thiên can thuộc ngũ hành Mộc mà chồng thiên can thuộc ngũ hành Hỏa, thì chồng được sinh còn vợ bị hao. Trong kết hôn hao được tính là tốt như sinh. Ám chỉ vợ chồng nhận được sự hỗ trợ, nâng đỡ, bù đắp, nhẹ nhàng, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng tổ ấm, yêu thương tôn trọng lẫn nhau. Tuy nhiên bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh.</p>',
					'ngay'  => '<p>- Khi nạp âm trụ ngày thuộc Hao: không Tốt không xấu cho việc Khai Trương và Tuy không xấu nhưng cũng không tốt, chồng vợ dễ dửng dưng với nhau và bản thân hay bị hao tổn, thiệt thòi. Hao nghĩa là bản thân vợ hoặc chồng sinh trợ cho nhau. Ví dụ: vợ thiên can thuộc ngũ hành Mộc mà chồng thiên can thuộc ngũ hành Hỏa, thì chồng được sinh còn vợ bị hao, trong kết hôn hao được tính là tốt như sinh. Trong ngũ hành sự Hao được ví như người cho đi, bản thân mình phải sinh ra và nuôi dưỡng. Trong hôn nhân khi gặp Hao thì cũng như hệ tương sinh, ám chỉ về ngũ hành (Kim, Thủy, Mộc, Hỏa, Thổ) của mệnh niên khi gặp nhau, tính theo hệ tương sinh của ngũ hành mệnh niên của hai bên gặp nhau. Khi có sự tương sinh Thì Gia Chủ nhận được sự hỗ trợ, nâng đỡ, bù đắp, nhẹ nhàng, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng tổ ấm, yêu thương tôn trọng lẫn nhau. Tuy nhiên bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh.</p>',
					'gio'   => '<p>- Khi nạp âm trụ giờ thuộc Hao: không Tốt không xấu cho việc Khai Trương và Tuy không xấu nhưng cũng không tốt, bản thân bố mẹ với các con dửng dưng với nhau và bản thân hay bị hao tổn vì con. Hao nghĩa là bản thân vợ hoặc chồng sinh trợ cho nhau. Trong kết hôn hao được tính là tốt như sinh. Trong ngũ hành sự Hao được ví như người cho đi, bản thân mình phải sinh ra và nuôi dưỡng. Trong hôn nhân khi gặp Hao thì cũng như hệ tương sinh, ám chỉ về ngũ hành Kim, Thủy, Mộc, Hỏa, Thổ của mệnh niên khi gặp nhau. Khi có sự tương sinh Thì Gia Chủ nhận được sự hỗ trợ, nâng đỡ, bù đắp, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng tổ ấm, yêu thương tôn trọng lẫn nhau. Tuy nhiên bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh.</p>',
				],
			],
			'thai_tue' => [
				'pha'  => [
					'nam'   => '<p>- Khi địa chi trụ năm thuộc Tuế phá: Là xấu cho khai trương và gia đạo, bản thân với bố mẹ, cô dì chú bác của Chủ Sự dễ chọc phá nhau, bằng mặt không bằng lòng. Sau này do đó mà vợ chồng phật ý nhau. Phá là thường không tìm được tiếng nói chung, hay xảy ra mâu thuẫn và dễ cãi vã nhau trong những cuộc tranh luận. Vì vậy nên thường không đạt được hiệu quả như mong muốn. Nếu ở với nhau lâu dài có thể khiến cãi vã, chia ly. Nhiều khi còn khiến bản cảm thấy mệt mỏi, khó chịu. Nhưng bạn cũng cần hiểu rằng có hung ắt có cát, nên khi 2 hành không hợp nhau chưa chắc đã là điều xấu. Vì vậy bạn không nên quá bận tâm bởi hung hay cát còn phải dựa vào rất nhiều yếu tố. Thuật số hay phong thủy chỉ mang đến phần nhỏ vận mệnh, phần lớn còn lại do sự nỗ lực của bạn. Nếu để an tâm hơn thì có thể liên hệ với các chuyên gia để hóa giải vận hạn. <span class="red">XẤU</span></p>',
					'thang' => '<p>- Khi địa chi trụ tháng thuộc Tuế phá: Là xấu cho khai trương và gia đạo, bản thân với anh chi em trong nhà dễ chọc phá nhau, bằng mặt không bằng lòng. Sau này do đó mà vợ chồng không vừa ý, hài lòng với nhau. Phá ám chỉ có nhiều sự ngăn cản, đối lập với nhau, cản trở công việc. Nếu thực hiện làm ăn chung với nhau thì thường có những ý kiến trái chiều, không đồng nhất ý kiến khiến việc giải quyết các vấn đề không tốt. Nó có thể làm ảnh hưởng đến kết quả, hao tổn tiền bạc của bạn. Nếu ở gần nhau sẽ dễ sinh ra chia ly, đau khổ dành cho bạn. Nhưng quý vị cũng lên lưu ý, có hung ắt có cát, chỉ là do quý vị chưa biết cách hóa giải mà thôi. Việc hóa giải không khó nhưng thuật toán hay phong thủy chỉ hỗ trợ được quý vị một phần nhỏ còn phần lớn là do chính bản thân quý vị mong muốn, nỗ lực để xây dựng và vun đắp tổ ấm của chính mình. Gia chủ dùng ngũ hành thông quan sẽ hóa hung thành cát.<span class="red">XẤU</span></p>',
					'ngay'  => '<p>- Khi địa chi trụ ngày thuộc Tuế phá: Là xấu cho khai trương và gia đạo, chồng/vợ dễ bị bên ngoài tác động vào mà trở nên không thuận hoà, dễ gặp khó khăn trong làm ăn nếu tâm trí không vững. Khi địa chi tương phá dễ thường không tìm được tiếng nói chung trong cuộc sống gia đình, hay xảy ra mâu thuẫn và dễ cãi vã nhau trong những cuộc tranh luận. Vợ chồng dễ xảy ra mâu thuẫn là thường có lý tưởng và suy nghĩ hoàn toàn đối lập nhau. Có nhiều sự ngăn cản, cản trở lẫn nhau, vợ chồng có làm ăn chung thì dễ có những ý kiến trái chiều khiến mọi việc không đi tới đâu. Ngoài ra còn có sự kìm hãm, làm ăn khó khăn, vợ chồng ở gần sẽ dễ sinh ra mỗi người một phòng. Nếu ở với nhau thì cần có những biện pháp giải phá. Nhưng có hung ắt có cát, quan trọng là chúng ta nhìn nhận ra và muốn có sự tốt đẹp hơn là hóa giải được. Và bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh. <span class="red">XẤU</span></p>',
					'gio'   => '<p>- Khi địa chi trụ giờ thuộc Tuế phá: Là xấu cho gia đạo, chồng/vợ con cái dễ không thuận hoà, con cái dễ phá tiền bạc của bố mẹ, làm bố mẹ hao tiền của. Phá chính là thường xuyên xảy ra mâu thuẫn, có những ý tưởng, đề xuất trái ngược nhau khiến cho các mâu thuẫn không được giải quyết triệt để do không có tiếng nói chung. Vì vậy nên việc làm ăn sẽ trở nên khó khăn, không đạt được hiệu quả như mong muốn. Còn chuyện tình cảm sẽ gặp nhiều bất lợi, cảm thấy khó chịu, ngột ngạt dẫn đến không được hạnh phúc. Tuy nhiên khi gặp vấn đề này bạn cũng không cần quá lo lắng, bởi có hung ắt có cát, chỉ là do quý vị chưa biết cách hóa giải. Việc hóa giải không hề khó nhưng thuật toán hay phong thủy chỉ hỗ trợ bạn được 1 phần, còn lại là do chính bản thân bạn. Để bản thân thêm an tâm thì bạn có thể liên hệ với các chuyên gia để hóa giải vận hạn xấu của bản mệnh. <span class="red">XẤU</span></p>',
				],
				'hai'  => [
					'nam'   => '<p>- Khi địa chi trụ năm thuộc Tuế hại: Là xấu cho khai trương và gia đạo, bản thân với bố mẹ, cô dì chú bác của Chủ Sự dễ vì cái trước mắt mà bỏ qua tình nghĩa, nặng về vật chất hơn. Cũng vì điều này mà vợ chồng hay buồn vui thất thường. Mối quan hệ vợ chồng trong hôn nhân người xưa quan niệm rằng hôn nhân phạm Lục hại sẽ khó được bền vững. Vợ chồng thường xuyên cãi cọ, gia đình lục đục, con cái dễ theo bố mẹ mà hư hỏng. Thậm chí trường hợp nặng còn khiến kinh doanh thất bát, làm ăn thua lỗ, tán gia bại sản và hại lẫn nhau. Mỗi người một phách, ai cũng có lý của người đó, không có tiếng nói chung. Đôi khi còn vô tinh hại nhau vì sự ích kỷ của bản thân và cái tôi của mình. Nhưng quý vị lên lưu ý: có hung ắt có cát, chi hung khi chúng ta không biết phương pháp giải quyết hoặc không muốn giải quyết, vợ chồng đã để tình trạng này quá lâu, nhạt mầu và không cần gì nữa, tới đâu thì tới. Tuy nhiên bạn nên nhớ rằng mục này hung hay cát chưa nói lên điều gì. Nó chỉ phản ánh một phần nhỏ và phần lớn còn lại là do sự cố gắng, nỗ lực của chính bản thân chủ mệnh. Nếu muốn để bản thân an tâm hơn thì có thể liên hệ với các chuyên gia để tìm cách hóa giải. <span class="red">XẤU</span></p>',
					'thang' => '<p>- Khi địa chi trụ tháng thuộc Tuế hại: Là xấu cho khai trương và gia đạo bản thân với anh chi em trong nhà dễ vì cái trước mắt mà bỏ qua tình nghĩa, nặng về vật chất hơn. Cũng vì điều này mà vợ chồng hay buồn vui thất thường. Chọn phải ngày lục hại khi tiến hành các công việc quan trọng sẽ khiến cho công việc không được bền vững. Công việc làm ăn thì hao tốn nhiều tiền của, có thể dẫn tới phá sản. Cuộc sống gia đình thì có thể thường xuyên cãi vã, mâu thuẫn khiến cho hòa khí kém, gia đình không được hạnh phúc. Khi gặp vận hạn này bạn cũng không cần quá lo lắng. Bởi có hung ắt có cát, mọi việc trong cuộc sống đều hóa cát lành khi bạn biết nhìn nhận, đánh giá mọi vấn đề. Và thuật số chỉ ảnh hưởng 1 phần nhỏ đến vận mệnh của bạn, những lỗ lực, cố gắng trong cuộc sống mới quyết định được vận của bạn là hung hay cát. <span class="red">XẤU</span></p>',
					'ngay'  => '<p>- Khi địa chi trụ ngày thuộc Tuế hại: Là xấu cho khai trương và gia đạo, chồng/vợ dễ vì cái bên ngoài mà bỏ qua cái cốt lõi, nặng về vật chất hơn. Bên cạnh đó lại hay bi quan, tới đâu thì tới, xây thì xây, mà không xây thì đừng. Phạm lục hại sẽ khiến cho gia đình không được hạnh phúc, yên ấm do cãi vã, mâu thuẫn các quan điểm, cách sống. Mỗi người trong gia đình sẽ có 1 ý kiến riêng, không đồng nhất quan điểm nên nhiều khi có thể vô tình làm tổn hại lẫn nhau. Thậm chí trong trường hợp nặng còn khiến tán gia bại sản, hãm hại lẫn nhau. Tuy nhiên bạn cũng cần lưu ý có hung ắt có cát nên mọi việc đều có thể hóa giải nếu trong tâm bạn muốn giải quyết vấn đề này 1 cách trọn vẹn, đúng đắn. Và bạn cũng cần nhớ rằng thuật số hay phong thủy chỉ mang đến phần nhỏ vận mệnh, phần lớn còn lại do sự nỗ lực của bạn. Nếu để an tâm hơn thì có thể liên hệ với các chuyên gia để hóa giải vận hạn. <span class="red">XẤU</span></p>',
					'gio'   => '<p>- Khi địa chi trụ giờ thuộc Tuế hại: Là xấu cho khai trương và gia đạo, chồng/vợ con cái dễ mất của vào những việc không đâu. Vì con cái mà bố mẹ, hao tiền của “con dại cái mang”. Lục hại chính là mỗi người sẽ có một ý kiến riêng, trái chiều với nhau. Lý tưởng, suy nghĩ, phong cách sống không đồng nhất với nhau khiến cho gia đình không hạnh phúc, công việc làm ăn khó khăn. Nếu bị ảnh hưởng nặng còn làm hao tổn nhiều tiền bạc, phá sản, gia đình lục đục không hạnh phúc. Nhiều khi có thể vô tình hãm hại nhau để bản thân đạt được những lợi ích riêng. Để hóa giải vận hạn này không khó, chỉ cần bạn mong muốn và tìm hướng giải quyết cho các vấn đề này. Các thuật số hay phong thủy chỉ mang lại một phần nhỏ ảnh hưởng đến vận mệnh, phần lớn còn lại do chính bản thân bạn cố gắng tạo ra. <span class="red">XẤU</span></p>',
				],
				'hinh' => [
					'nam'   => '<p>- Khi địa chi trụ năm thuộc Tuế hình: Là xấu cho khai trương và gia đạo, bản thân với bố mẹ, cô dì chú bác của Chủ Sự dễ vì cái trước mắt mà bỏ qua tình nghĩa, hay chiếu tướng nhau, vì người ngoài mà quên người nhà. Cũng vì điều này mà vợ chồng bị tác động tâm lý. Hình là chỉ chủ mệnh có thể gặp phải tai ương, những vấn đề liên quan đến pháp lý. Ngoài ra việc này còn ảnh hưởng đến những người thân trong gia đình khiến cho hóa khí gia đạo kém. Tuy nhiên bạn không cần quá lo lắng vì nếu bạn nhìn nhận được vấn đề đúng sai và có hướng giải quyết nhanh chóng. Thì mọi vận hung đều hóa cát lành. Vì vậy nên thuật số này chỉ mang lại phần nhỏ vận mệnh, phần lớn còn lại do chính bạn tạo ra. <span class="red">XẤU</span></p>',
					'thang' => '<p>- Khi địa chi trụ tháng thuộc Tuế hình: Là xấu cho khai trương và gia đạo, bản thân với anh chi em trong nhà dễ chiếu tướng nhau, vì người ngoài mà quên người nhà, chỉ nhìn được cái lợi trước mắt. Những lúc cần mới tìm đến sự giúp đỡ của nhau. Hình chính là ám chỉ dễ có sự hiểm trở, tai ương, tai họa dẫn đến cửa quan. Với tính cách của bạn thì họ đối sử với mình như nào thì mình đáp lại như vậy. Chính vì vậy nhiều khi tự làm tổn hại lẫn nhau, đôi lúc có sự nhiể loạn, do vì bản thân mà lấy oán báo ân. Nhưng bạn cần lưu ý có hung ắt có cát, quan trọng là chúng ta nhìn nhận ra và muốn có sự tốt đẹp hơn là hóa giải được. (Ở mục này hung hay cát cũng chưa nói lên điều gì? Bởi còn rất nhiều yếu tố của các mục khác tạo lên và thuật số chỉ mạng lại phần nhỏ, phần lớn là do chính quý vị cố gắng tạo ra. <span class="red">XẤU</span></p>',
					'ngay'  => '<p>- Khi địa chi trụ ngày thuộc Tuế hình: Là xấu cho khai trương và gia đạo, bản thân chồng/vợ dễ chiếu tướng nhau, tốt và nghe lời người ngoài hơn người nhà, xem nhẹ lẫn nhau. Vợ chồng cần thấu hiểu sẻ chia với nhau, luôn biết nhận lỗi về mình, sẽ hoá giải được. Hình là chỉ chủ mệnh có thể gặp phải tai ương, những vấn đề liên quan đến pháp lý. Ngoài ra việc này còn ảnh hưởng đến những người thân trong gia đình khiến cho hóa khí gia đạo kém. Tuy nhiên bạn không cần quá lo lắng vì nếu bạn nhìn nhận được vấn đề đúng sai và có hướng giải quyết nhanh chóng. Thì mọi vận hung đều hóa cát lành. Vì vậy nên thuật số này chỉ mang lại phần nhỏ vận mệnh, phần lớn còn lại do chính bạn tạo ra.<span class="red">XẤU</span></p>',
					'gio'   => '<p>- Khi địa chi trụ giờ thuộc Tuế hình: Là xấu cho khai trương và gia đạo, bản thân chồng/vợ con cái dễ chiếu tướng nhau, tốt và nghe lời người ngoài hơn người nhà, xem nhẹ lẫn nhau. Gia đình cần thấu hiểu sẻ chia, bao dung nhau hơn và nghĩ đến nhau, sẽ hoá giải được. Trong xét ngày hung cát Hình ám chỉ sự, lời ra tiếng vào dễ sinh ra những vấn đề dính tới pháp luật, dễ đối chọi lại nhau. Ngoài việc chủ sự còn liên quan tới con cái, bố mẹ và con tổn hại lẫn nhau. Nó làm ảnh hưởng rất nhiều đến công việc, cuộc sống tình cảm của gia đình. Cách hóa giải tốt nhất tình trạng này chính là sự nhìn nhận và cố gắng muốn mọi việc trở nên tốt hơn. Và các thuật số này chỉ mang phần nhỏ cho vận mệnh, phần lớn còn lại là do sự cố gắng từ chính chủ mệnh. <span class="red">XẤU</span></p>',
				],
				'pham' => [
					'nam'   => '<p>- Khi trụ năm thuộc phạm Thái Tuế: Xấu cho khai trương và gia đạo, khó thuận hoà, bản thân với bố mẹ, chồng/vợ bất an, dễ bất đồng quan điểm. Mọi việc chưa thông. làm ăn thua lỗ, tiền mất tật mang. Theo năm tháng, ngày, giờ sinh hạn Thái Tuế là tuổi (con giáp của quý vị). Ví dụ: quý vị tuổi Tý thì năm Tý gọi là năm Thái Tuế. Khi gặp năm tháng, ngày, giờ sinh Thái Tuế còn gọi là năm tháng, ngày, giờ sinh tuổi, thì lúc đó gia chủ trong cuộc sống, công việc dễ có biến động, dễ buồn bực, bệnh tật. Nhiều khi gặp chuyện thị phi không đâu tự kéo đến, đôi lúc làm phúc lại phải tội. Cách trấn an đơn giản nhất là dùng thẻ bài Thái Tuế có thể giảm bớt được một phần nào đó nhưng cũng chỉ giải quyết được một phần rất nhỏ. Nếu quý vị kết hợp thêm với phong thủy cải vận bổ khuyết thì có khả năng hóa giải được lớn hơn. Tuy nhiên phần lớn còn lại do chính quý vị, cần kiệm liêm chính, tâm an trí vững ắt vận thông. <span class="red">XẤU</span></p>',
					'thang' => '<p>- Khi trụ tháng thuộc phạm Thái Tuế: Xấu cho khai trương và gia đạo, khó thuận hoà, bản thân chồng/vợ bất an, dễ bất đồng quan điểm, với anh chị em trong nhà. Mọi việc chưa thông, làm ăn thua lỗ, tiền mất tật mang. Theo năm tháng, ngày, giờ sinh hạn Thái Tuế là tuổi (con giáp của quý vị). Gia chủ trong cuộc sống, công việc dễ có biến động, dễ buồn bực, bệnh tật. Nhiều khi gặp chuyện thị phi không đâu tự kéo đến, đôi lúc làm phúc lại phải tội. Cách trấn an đơn giản nhất là dùng thẻ bài Thái Tuế có thể giảm bớt được một phần nào đó nhưng cũng chỉ giải quyết được một phần rất nhỏ. Nếu quý vị kết hợp thêm với phong thủy cải vận bổ khuyết thì có khả năng hóa giải được lớn hơn. Tuy nhiên phần lớn còn lại do chính quý vị, cần kiệm liêm chính, tâm an trí vững ắt vận thông. <span class="red">XẤU</span></p>',
					'ngay'  => '<p>- Khi trụ ngày thuộc phạm Thái Tuế: Xấu cho khai trương và gia đạo, khó thuận hoà, bản thân chồng/vợ bất an, gặp chuyện không thuận, dễ bất đồng quan điểm với nhau, mọi việc chưa thông. Theo năm tháng, ngày, giờ sinh hạn Thái Tuế là tuổi (con giáp của quý vị). Lúc đó gia chủ trong cuộc sống, công việc dễ có biến động, dễ buồn bực, bệnh tật. Nhiều khi gặp chuyện thị phi không đâu tự kéo đến, đôi lúc làm phúc lại phải tội. Cách trấn an đơn giản nhất là dùng thẻ bài Thái Tuế có thể giảm bớt được một phần nào đó nhưng cũng chỉ giải quyết được một phần rất nhỏ. Nếu quý vị kết hợp thêm với phong thủy cải vận bổ khuyết thì có khả năng hóa giải được lớn hơn. Tuy nhiên phần lớn còn lại do chính quý vị, cần kiệm liêm chính, tâm an trí vững ắt vận thông. <span class="red">XẤU</span></p>',
					'gio'   => '<p>- Khi trụ giờ thuộc phạm Thái Tuế: Xấu cho khai trương và sau này bản thân chồng/vợ, gặp chuyện không thuận, dễ bất đồng quan điểm với nhau, mọi việc chưa thông. Theo năm tháng, ngày, giờ sinh hạn Thái Tuế là tuổi (con giáp của quý vị). Ví dụ: quý vị tuổi Tý thì năm Tý gọi là năm Thái Tuế. Khi gặp năm tháng, ngày, giờ sinh Thái Tuế còn gọi là năm tháng, ngày, giờ sinh tuổi, thì lúc đó gia chủ trong cuộc sống, công việc dễ có biến động, dễ buồn bực, bệnh tật. Nhiều khi gặp chuyện thị phi không đâu tự kéo đến, đôi lúc làm phúc lại phải tội. Cách trấn an đơn giản nhất là dùng thẻ bài Thái Tuế có thể giảm bớt được một phần nào đó nhưng cũng chỉ giải quyết được một phần rất nhỏ. Nếu quý vị kết hợp thêm với phong thủy cải vận bổ khuyết thì có khả năng hóa giải được lớn hơn. Tuy nhiên phần lớn còn lại do chính quý vị, cần kiệm liêm chính, tâm an trí vững ắt vận thông.<span class="red">XẤU</span></p>',
				],
				'xung' => [
					'nam'   => '<p>- Khi trụ năm thuộc xung Thái Tuế: Là xấu cho khai trương và gia đạo, khó thuận hoà, bản thân với bố mẹ, cô dì chú bác của Chủ Sự dễ nói xấu nhau sau lưng. Sau này do đó mà vợ chồng phật ý nhau. Xung là chỉ sự xung khắc, có nhiều ý kiến trái ngược với nhau về tính cách, quan điểm và phong cách sống, làm việc. Khi chọn ngày mà thiên can của chủ sự bị xung dẫn đến việc của bạn không đạt được kết quả như mong muốn thì bạn cũng không cần quá lo lắng. Vì mọi vật sinh ra và tồn tại đều có những ưu, khuyết điểm khác nhau. Mọi việc thành hay bại đều do bản thân mình, các thuật số chỉ mang tính chất dự đoán. Để có thể an tâm hơn cho công việc của mình thì bạn có thể liên hệ với các chuyên gia để hóa giải. Kính chúc quý gia chủ vạn sự an nhiên, hanh thông, hạnh phúc viên mãn.<span class="red">XẤU</span></p>',
					'thang' => '<p>- Khi trụ tháng thuộc xung Thái Tuế: Xấu cho khai trương và gia đạo, khó thuận hoà, bản thân với anh chi em trong nhà dễ nói xấu nhau sau lưng, sau này do đó mà vợ chồng không vừa ý, hài lòng nhau. Xung ám chỉ mọi việc không đồng thuận với nhau, có nhiều ý kiến đối lập. Khi chọn ngày mà thiên can của chủ sự bị xung thì mọi việc không được như mong muốn. Mang đến nhiều điều rủi ro, không may mắn, cản trở công việc làm ăn, cuộc sống của chủ sự. Bởi vậy nên bạn cần lựa chọn được ngày giờ đẹp, hợp với bản mệnh. Nếu nhỡ chọn phải ngày giờ thực hiện không đẹp thì bạn cũng không cần quá lo lắng. Bởi còn rất nhiều yếu tố của các mục khác tạo nên và thuật số chỉ mang tính chất dự đoán một phần và các phần còn lại do quý vị tạo ra. Để có thể an tâm hơn bạn có thể liên hệ với chuyên gia để hóa giải. <span class="red">XẤU</span></p>',
					'ngay'  => '<p>- Khi trụ ngày thuộc xung Thái Tuế: Là xấu cho khai trương và gia đạo, khó thuận hoà, bản thân chồng/vợ chấp nhau trong cuộc sống. Sau này do đó mà vợ chồng hay để ý, nhỏ mọn với nhau. Xung là chỉ sự xung khắc, có nhiều ý kiến trái ngược với nhau về tính cách, quan điểm và phong cách sống, làm việc. Khi chọn ngày mà thiên can của chủ sự bị xung dẫn đến việc của bạn không đạt được kết quả như mong muốn thì bạn cũng không cần quá lo lắng. Vì mọi vật sinh ra và tồn tại đều có những ưu, khuyết điểm khác nhau. Mọi việc thành hay bại đều do bản thân mình, các thuật số chỉ mang tính chất dự đoán. Để có thể an tâm hơn cho công việc của mình thì bạn có thể liên hệ với các chuyên gia để hóa giải. Kính chúc quý gia chủ vạn sự an nhiên, hanh thông, hạnh phúc viên mãn. <span class="red">XẤU</span></p>',
					'gio'   => '<p>- Khi trụ giờ thuộc xung Thái Tuế: Là xấu cho khai trương và gia đạo chồng/vợ, con cái dễ bất đồng khắc khẩu lẫn nhau. Xung ám chỉ một sự việc dễ đối lập nhau, không đồng thuận, đồng lòng, ai cũng có cái lý của mình. Vì không có tiếng nói chung nên dễ mỗi người một phách. Khi chọn ngày mà thiên can của chủ sự bị xung sự việc có thể không được như mong đợi. Vạn vật khi sinh ra và cùng tồn tại nên sẽ có cái ưu khuyết của riêng mình, trong đây không có sự đúng sai hơn thua mà là sự xây dựng bổ trợ. Vạn sự khởi từ tâm nhân, kính chúc quý gia chủ vạn sự an nhiên, hạnh phúc viên mãn hanh thông. (Ở mục này hung hay cát cũng chưa nói lên điều gì? Bởi còn rất nhiều yếu tố của các mục khác tạo lên và thuật số chỉ mạng lại phần ít với mỗi quý vị phần nhiều là do chính quý vị tạo ra.<span class="red">XẤU</span></p>',
				],
				'khac' => [
					'nam'   => '<p>- Khi trụ năm thuộc khắc Thái Tuế: Xấu cho khai trương và gia đạo, khó thuận hoà, bản thân với bố mẹ, cô dì chú bác của Chủ Sự dễ bất đồng quan điểm, mọi việc chưa thông. Khi vợ chồng bị hai thiên can khắc nhau sẽ dễ gặp sự đối lập, sát phạt, khắc khẩu, bất đồng quan điểm, giống như nước với lửa. Sự góp ý của mình khiến họ khó chịu, sẽ xảy ra những tranh cãi. Nhưng quý vị cũng lên quá lo lắng bởi có khắc ắt có sinh, chỉ là do quý vị chưa biết cách hóa giải. Việc hóa giải không khó nhưng thuật toán hay phong thủy chỉ hỗ trợ được quý vị phần nhỏ, phần lớn còn lại là do chính bản thân quý vị mong muốn, nỗ lực để xây dựng và vun đắp tổ ấm của chính mình. Gia chủ có thể dùng ngũ hành thông quan sẽ hóa hung thành cát. Nếu bản thân chưa an tâm thì bạn có thể liên hệ với chuyên gia để tìm cách hóa giải chi tiết và hiệu quả.<span class="red">XẤU</span></p>',
					'thang' => '<p>- Khi trụ tháng thuộc khắc Thái Tuế: Xấu cho khai trương và gia đạo, khó thuận hoà, bản thân với anh chi em trong nhà dễ bất đồng quan điểm, mọi việc chưa thông. Ngũ hành tương khắc là nói đến sự xung khắc giữa các hành với nhau. Hay gọi đúng tên bản chất của sự tương khắc là hành này khống chế và làm cho hành kia bị suy yếu, ảnh hưởng xấu. Tuy nhiên khi gặp vấn đề này bạn cũng không cần quá lo lắng, bởi có khắc ắt có sinh, chỉ là do quý vị chưa biết cách hóa giải. Việc hóa giải không hề khó nhưng thuật toán hay phong thủy chỉ hỗ trợ bạn được 1 phần, còn lại là do chính bản thân bạn. Để bản thân thêm an tâm thì bạn có thể liên hệ với các chuyên gia để hóa giải vận hạn xấu của bản mệnh. <span class="red">XẤU</span></p>',
					'ngay'  => '<p>- Khi trụ ngày thuộc khắc Thái Tuế: Xấu cho khai trương và gia đạo, khó thuận hoà, chồng/vợ dễ bất đồng quan điểm, mọi việc chưa thông. Tương khắc được hiểu là sự khắc chế, bài trừ, đối lập, kìm hãm sự phát triển của nhau. Hóa giải được sự tương khắc này sẽ sinh ra những điều tốt đẹp, vì có khắc ắt có sinh. Tuy nhiên việc hóa giải chỉ hỗ trợ được bạn 30%, 70% còn lại dựa vào những cố gắng của bạn. Vì vậy nên cách hóa giải tốt nhất đó chính là dựa vào chính sự nỗ lực của bản thân sẽ làm thay đổi vận mệnh. (Ở mục này hung hay cát cũng chưa nói lên điều gì? Bởi còn rất nhiều yếu tố của các mục khác tạo lên và thuật số chỉ mạng lại phần nhỏ với vận mệnh. Phần lớn còn lại là do chính quý vị nỗ lực tạo ra). <span class="red">XẤU</span></p>',
					'gio'   => '<p>- Khi trụ giờ thuộc khắc Thái Tuế: Xấu cho khai trương và gia đạo, khó thuận hoà, chồng/vợ, con cái dễ bất đồng quan điểm, mọi việc chưa thông. Nếu ngũ hành tương sinh được hiểu là bồi đắp nuôi dưỡng của hành này cho hành kia. Thì ngũ hành tương khắc có nghĩa là sự đối lập, khắc chế, làm hao tổn lẫn nhau của 2 hành. Nhưng bạn cũng cần hiểu rằng có khắc ắt có sinh, nên khi 2 hành không hợp nhau chưa chắc đã là điều xấu. Vì vậy bạn không nên quá bận tâm bởi hung hay cát còn phải dựa vào rất nhiều yếu tố. Thuật số hay phong thủy chỉ mang đến phần nhỏ vận mệnh, phần lớn còn lại do sự nỗ lực của bạn. Nếu để an tâm hơn thì có thể liên hệ với các chuyên gia để hóa giải vận hạn. <span class="red">XẤU</span></p>',
				],
			],
		];
		$compareArr    = [];
		$luanGiaiArr   = [];
		$menhChuCanChi = [
			'can_slug' => $lasoTuTru->canNamSlug,
			'chi_slug' => $lasoTuTru->chiNamSlug,
			'canInfo'  => $lasoTuTru->canInfo['nam'],
			'chiInfo'  => $lasoTuTru->chiInfo['nam'],
		];
		$menhNam       = [
			'can_slug' => $lasoTuTruNgay->canNamSlug,
			'chi_slug' => $lasoTuTruNgay->chiNamSlug,
			'canInfo'  => $lasoTuTruNgay->canInfo['nam'],
			'chiInfo'  => $lasoTuTruNgay->chiInfo['nam'],
		];
		$tuongPha      = [
			'ti'   => 'dau',
			'dau'  => 'ti',
			'ngo'  => 'mao',
			'mao'  => 'ngo',
			'than' => 'ty',
			'ty'   => 'than',
			'dan'  => 'hoi',
			'hoi'  => 'dan',
			'thin' => 'suu',
			'suu'  => 'thin',
			'tuat' => 'mui',
			'mui'  => 'tuat',
		];
		$tuongHai      = [
			'ti'   => 'mui',
			'mui'  => 'ti',
			'suu'  => 'ngo',
			'ngo'  => 'suu',
			'dan'  => 'ty',
			'ty'   => 'dan',
			'mao'  => 'thin',
			'thin' => 'mao',
			'than' => 'hoi',
			'hoi'  => 'than',
			'dau'  => 'tuat',
			'tuat' => 'dau',
		];
		$thaiTue       = [];
		$arrayTuTru    = [
			'nam'   => 'Năm',
			'thang' => 'tháng',
			'ngay'  => 'ngày',
			'gio'   => 'giờ',
		];
		foreach ($arrayTuTru as $key => $val) {
			$canSlug    = 'can' . ucfirst($key) . 'Slug';
			$chiSlug    = 'chi' . ucfirst($key) . 'Slug';
			$menhCanchi = [
				'can_slug' => $lasoTuTruNgay->$canSlug,
				'chi_slug' => $lasoTuTruNgay->$chiSlug,
				'canInfo'  => $lasoTuTruNgay->canInfo[$key],
				'chiInfo'  => $lasoTuTruNgay->chiInfo[$key],
			];
			$soSanh     = \Laven\TinhHopHoa::run($menhChuCanChi, $menhCanchi);
			if ($lasoTuTru->$canSlug == $lasoTuTru->thienCanXung[$lasoTuTruNgay->canNamSlug] || $lasoTuTruNgay->canNamSlug == $lasoTuTru->thienCanXung[$lasoTuTru->$canSlug]) {
				$luanGiaiArr['thiencan'][$key][] = $luanGiai['thiencan']['xung'][$key];
				$compareArr['thiencan'][$key][]  = [
					'status' => 'Xấu',
					'name'   => 'Xung',
				];
			}
			if ($lasoTuTru->canInfo[$key]['name'] == $lasoTuTru->tuongSinh($lasoTuTruNgay->canInfo['nam']['name']) || $lasoTuTruNgay->canInfo['nam']['name'] == $lasoTuTru->tuongSinh($lasoTuTru->canInfo[$key]['name'])) {
				$luanGiaiArr['thiencan'][$key][] = $luanGiai['thiencan']['sinh'][$key];
				$compareArr['thiencan'][$key][]  = [
					'status' => 'Tốt',
					'name'   => 'Sinh',
				];
			}
			if (empty($thienCanHoa) && ($lasoTuTru->canInfo[$key]['name'] == $lasoTuTru->tuongKhac($lasoTuTruNgay->canInfo['nam']['name']) || $lasoTuTruNgay->canInfo['nam']['name'] == $lasoTuTru->tuongKhac($lasoTuTru->canInfo[$key]['name']))) {
				$luanGiaiArr['thiencan'][$key][] = $luanGiai['thiencan']['khac'][$key];
				$compareArr['thiencan'][$key][]  = [
					'status' => 'Xấu',
					'name'   => 'Khắc',
				];
			}
			if ($soSanh['thiencan']['hop']) {
				$luanGiaiArr['thiencan'][$key][] = $luanGiai['thiencan']['hop'][$key];
				$compareArr['thiencan'][$key][]  = [
					'status' => 'Tốt',
					'name'   => 'Hợp',
				];
			}
			if ($soSanh['thiencan']['hoa']) {
				$luanGiaiArr['thiencan'][$key][] = $luanGiai['thiencan']['hoa'][$key];
				$compareArr['thiencan'][$key][]  = [
					'status' => 'Tốt',
					'name'   => 'Hóa',
				];
			}
			// ========================= DIA CHI =========================
			if ($lasoTuTru->$chiSlug == $lasoTuTru->diaChiLucXung[$lasoTuTruNgay->chiNamSlug] || $lasoTuTruNgay->chiNamSlug == $lasoTuTru->diaChiLucXung[$lasoTuTru->$chiSlug]) {
				$luanGiaiArr['diachi'][$key][] = $luanGiai['diachi']['xung'][$key];
				$thaiTue['xung'][]             = $val;
				$compareArr['diachi'][$key][]  = [
					'status' => 'Xấu',
					'name'   => 'Xung',
				];
			}
			if ($lasoTuTru->chiInfo[$key]['name'] == $lasoTuTru->tuongSinh($lasoTuTruNgay->chiInfo['nam']['name']) || $lasoTuTruNgay->chiInfo['nam']['name'] == $lasoTuTru->tuongSinh($lasoTuTru->chiInfo[$key]['name'])) {
				$luanGiaiArr['diachi'][$key][] = $luanGiai['diachi']['sinh'][$key];
				$compareArr['diachi'][$key][]  = [
					'status' => 'Tốt',
					'name'   => 'Sinh',
				];
			}
			if (empty($diaChiHoa) && ($lasoTuTru->chiInfo[$key]['name'] == $lasoTuTru->tuongKhac($lasoTuTruNgay->chiInfo['nam']['name']) || $lasoTuTruNgay->chiInfo['nam']['name'] == $lasoTuTru->tuongKhac($lasoTuTru->chiInfo[$key]['name']))) {
				$luanGiaiArr['diachi'][$key][] = $luanGiai['diachi']['khac'][$key];
				$compareArr['diachi'][$key][]  = [
					'status' => 'Xấu',
					'name'   => 'Khắc',
				];
			}
			if ($soSanh['diachi']['hop']) {
				$luanGiaiArr['diachi'][$key][] = $luanGiai['diachi']['hop'][$key];
				$compareArr['diachi'][$key][]  = [
					'status' => 'Tốt',
					'name'   => 'Hợp',
				];
			}
			if (!empty($soSanh['diachi']['hoa'])) {
				$luanGiaiArr['diachi'][$key][] = $luanGiai['diachi']['hoa'][$key];
				$compareArr['diachi'][$key][]  = [
					'status' => 'Tốt',
					'name'   => 'Hóa',
				];
			}
			if ($lasoTuTru->$chiSlug == $lasoTuTru->diaChiHinh[$lasoTuTruNgay->chiNamSlug] || $lasoTuTruNgay->chiNamSlug == $lasoTuTru->diaChiHinh[$lasoTuTru->$chiSlug]) {
				$luanGiaiArr['diachi'][$key][] = $luanGiai['diachi']['hinh'][$key];
				$compareArr['diachi'][$key][]  = [
					'status' => 'Xấu',
					'name'   => 'Hình',
				];
			}
			if ((isset($tuongPha[$lasoTuTru->$chiSlug]) && $tuongPha[$lasoTuTru->$chiSlug] == $lasoTuTruNgay->chiNamSlug) || isset($tuongPha[$lasoTuTruNgay->chiNamSlug]) && $tuongPha[$lasoTuTruNgay->chiNamSlug] == $lasoTuTru->$chiSlug) {
				$luanGiaiArr['diachi'][$key][] = $luanGiai['diachi']['pha'][$key];
				$thaiTue['hinh'][]             = $val;
				$compareArr['diachi'][$key][]  = [
					'status' => 'Xấu',
					'name'   => 'Phá',
				];
			}
			if ((isset($tuongHai[$lasoTuTru->$chiSlug]) && $tuongHai[$lasoTuTru->$chiSlug] == $lasoTuTruNgay->chiNamSlug) || isset($tuongHai[$lasoTuTruNgay->chiNamSlug]) && $tuongHai[$lasoTuTruNgay->chiNamSlug] == $lasoTuTru->$chiSlug) {
				$luanGiaiArr['diachi'][$key][] = $luanGiai['diachi']['hai'][$key];
				$thaiTue['hai'][]              = $val;
				$compareArr['diachi'][$key][]  = [
					'status' => 'Xấu',
					'name'   => 'Hại',
				];
			}
		}
		$satStr = '';
		if (in_array($lasoTuTru->chiNamSlug, [
			'than',
			'ti',
			'thin',
		])) {
			if ($lasoTuTruNgay->chiNamSlug == 'mui') {
				$satStr                         = '<p>Bạn gặp sát tại năm (Mùi)</p>';
				$compareArr[$val]['sat']['nam'] = true;
			}
			if ($lasoTuTruNgay->chiThangSlug == 'mui') {
				$satStr                           = '<p>Bạn gặp sát tại tháng (Mùi)</p>';
				$compareArr[$val]['sat']['thang'] = true;
			}
			if ($lasoTuTruNgay->chiNgaySlug == 'mui') {
				$satStr                          = '<p>Bạn gặp sát tại ngày (Mùi)</p>';
				$compareArr[$val]['sat']['ngay'] = true;
			}
			if ($lasoTuTruNgay->chiGioSlug == 'mui') {
				$satStr                         = '<p>Bạn gặp sát tại giờ (Mùi)</p>';
				$compareArr[$val]['sat']['gio'] = true;
			}
			if (empty($compareArr[$val]['sat'])) {
				$satStr = '<p class="red">Không gặp ngày sát</p>';
			}
		} else {
			$satStr = '<p class="red">Không gặp ngày sát</p>';
		}
		$kimLauChuSu  = $namXem - $namSinh + 1;
		$kimLauChuSu  = $kimLauChuSu % 9;
		$arrayThaiTue = [];
		if ($lasoTuTru->chiNamSlug == $lasoTuTruNgay->chiNamSlug) {
			$arrayThaiTue['nam'] = 'Năm';
		}
		if ($lasoTuTru->chiNamSlug == $lasoTuTruNgay->chiThangSlug) {
			$arrayThaiTue['thang'] = 'Tháng';
		}
		if ($lasoTuTru->chiNamSlug == $lasoTuTruNgay->chiNgaySlug) {
			$arrayThaiTue['ngay'] = 'Ngày';
		}
		if ($lasoTuTru->chiNamSlug == $lasoTuTruNgay->chiGioSlug) {
			$arrayThaiTue['gio'] = 'Giờ';
		}
		foreach ($arrayTuTru as $key => $val) {
			if ($napAm['nam']['ngu_hanh'] == $lasoTuTru->tuongSinh($napAmNgay[$key]['ngu_hanh'])) {
				$luanGiaiArr['nguhanh'][$key][] = $luanGiai['nap_am']['sinh'][$key];
				$compareArr['nguhanh'][$key][]  = [
					'status' => 'Tốt',
					'name'   => 'Sinh',
				];
			}
			if ($napAmNgay[$key]['ngu_hanh'] == $lasoTuTru->tuongSinh($napAmNgay['nam']['ngu_hanh'])) {
				$luanGiaiArr['nguhanh'][$key][] = $luanGiai['nap_am']['hao'][$key];
				$compareArr['nguhanh'][$key][]  = [
					'status' => 'Không tốt',
					'name'   => 'Hao',
				];
			}
			if ($napAm[$key]['ngu_hanh'] == $lasoTuTru->tuongKhac($napAmNgay[$key]['ngu_hanh']) || $napAmNgay[$key]['ngu_hanh'] == $lasoTuTru->tuongKhac($napAm[$key]['ngu_hanh'])) {
				$luanGiaiArr['nguhanh'][$key][] = $luanGiai['nap_am']['khac'][$key];
				$compareArr['nguhanh']['nam'][] = [
					'status' => 'Xấu',
					'name'   => 'Khắc',
				];
			}
			if (($napAm['nam']['ngu_hanh'] == $napAmNgay[$key]['ngu_hanh']) || $napAmNgay[$key]['ngu_hanh'] == $lasoTuTru->tuongKhac($napAm['nam']['ngu_hanh'])) {
				$luanGiaiArr['nguhanh'][$key][] = $luanGiai['nap_am']['tro'][$key];
				$compareArr['nguhanh']['nam'][] = [
					'status' => 'Xấu',
					'name'   => 'Trợ',
				];
			}
			if ($napAm['nam']['ngu_hanh'] == $napAmNgay[$key]['ngu_hanh']) {
				$luanGiaiArr['nguhanh'][$key][] = '<p>Trụ ' . $val . ' Trợ: trợ nghĩa là gia chủ có nạp âm(nạp âm) cùng ngũ hành với giờ ngày tháng năm gia chủ chọn vd; gia chủ nạp âmlà Lộ Bàng Thổ và ngày chọn nạp âm là Lộ Bàng Thổ. Hoặc Bích Thượng Thổ với Lộ Bàng Thổ. Vv… trong ngũ hành thì sự tương trợ tốt ngần bằng tương sinh, tương sinh ví như bố mẹ, còn tương trợ ví như anh em, ám chỉ về ngũ hành (kim, thủy, mộc, hỏa, thổ.) của nạp âm khi gặp nhau, tính theo hệ cùng ngũ hành, của ngũ hành nạp âm của hai bên gặp nhau, khi có sự tương trợ thì gia chủ nhận được sự hỗ trợ, nâng đỡ, bù đắp, nhẹ nhàng, yêu thương, đùm bọc giúp nhau trong mọi lĩnh vực, cùng xây dựng, yêu thương tôn trọng. (ở một mục này hung hay cát cũng chưa nói lên điều gi? Bới còn rất nhiều yếu tố của các mục khác tạo lên, và thuật số chỉ mạng lại 40% với mỗi quý vị. 60% là do chính quý vi tạo ra). <span class="red">TỐT</span></p>';
				$compareArr['nguhanh']['nam'][] = [
					'status' => 'Tốt',
					'name'   => 'Trợ',
				];
			}
		}
		$thienCan = '';
		if (!empty($luanGiaiArr['thiencan'])) {
			foreach ($luanGiaiArr['thiencan'] as $key => $val) {
				$thienCan = implode('', $val);
			}
		}
		$diaChi = '';
		if (!empty($luanGiaiArr['diachi'])) {
			foreach ($luanGiaiArr['diachi'] as $key => $val) {
				$diaChi = implode('', $val);
			}
		}
		$menhNien = '';
		if (!empty($luanGiaiArr['nguhanh'])) {
			foreach ($luanGiaiArr['nguhanh'] as $key => $val) {
				$menhNien = implode('', $val);
			}
		}
		$phamThaiTue = [];
		if (!empty($arrayThaiTue)) {
			$phamThaiTue[] = '<p>- Phạm thái tuế: ' . implode(', ', $arrayThaiTue) . '</p>';
			$phamThaiTue[] = '<p>- Phạm Thái Tuế: theo năm tháng, ngày, giờ sinh hạn Thái Tuế là tuổi (con giáp của quý vị, VD: quý vị tuổi tý thì năm tý gọi là năm thái tuế) khi gặp năm tháng, ngày, giờ sinh thái tuế còn gọi là năm tháng, ngày, giờ sinh tuổi, thì lúc đó gia chủ trong cuộc sống công việc dễ có biến động, dễ buồn bực, dễ có bệnh tật, nhiều khi gặp chuyện thị phi không đâu tự kéo đến, đôi lục làm phúc lại phải tội, cách trấn an đơn giản nhất là dùng thẻ bài thái tuế có thể giảm bớt được một phần nào đó nhưng cũng chỉ giải quyết được 10% nếu quý vị kết hợp thêm với phong thủy cải vận bổ khuyết thì có khả năng được 35% số còn lại do chính quý vị, cần kiệm liêm chính, tâm an trí vững ắt vận thông...</p>';
		}
		$xungThaiTue = [];
		if (!empty($thaiTue)) {
			foreach ($thaiTue as $key => $tu) {
				foreach ($tu as $key2 => $val) {
					if ($key2 == 'xung') {
						$xungThaiTue[] = '<p class="red">- Bạn bị Xung Thái Tuế: ' . implode(', ', $val) . '</p>';
						$xungThaiTue[] = '<p>- Xung Thái Tuế: xung thái tuế tính theo địa chị trong bộ xung khác hình phá hại, sẽ không nặng trực diên như phạm thái tuế (năm tuổi) như theo Năm tháng, ngày, giờ đều phải chị hạn Thái Tuế xung tuổi con giáp của quý vị, trong năm tất sẽ có những chuyện kém may mắn như phải chuyển nhà, chuyển công việc, bạn bè phản bội, bệnh tật, phá sản, gây thù kết oán… Xung ở đây chỉ cục diện Lục xung, bao gồm Tý Ngọ tương xung, Sửu Mùi tương xung, Dần Thân tương xung, Mão Dậu tương xung, Thìn Tuất tương xung, Tỵ Hợi tương xung. <span class="red">XẤU</span></p>';
					}
					if ($key2 == 'hinh') {
						$xungThaiTue[] = '<p class="red">- Bạn bị Hình Thái Tuế: ' . implode(', ', $val) . '</p>';
						$xungThaiTue[] = '<p>- Hình Thái Tuế: Năm tháng, ngày, giờ sinh hạn Thái Tuế hình với tuổi cầm tinh, vd như gai chủ tuổi tý gặp năm mão, nên tổi tý bị năm mão hình… bản mệnh cẩn thận kẻo vướng họa kiện tụng, tiểu nhân hãm hại, bị phạt tiền, mất việc, bản thân và người nhà sức khỏe có vấn đề… Hình Thái Tuế, hay còn được gọi là Thiên xung chỉ trường hợp người có tuổi con giáp cách con giáp lưu niên 6 năm, chịu ảnh hưởng Hình khắc, tức Thiên xung với lưu niên Thái Tuê. XẤU. (nếu bắt buộc phải làm xin liên hệ với chuyên gia để hóa giải). <span class="red">XẤU</span></p>';
					}
					if ($key2 == 'hai') {
						$xungThaiTue[] = '<p class="red">- Bạn bị Hại Thái Tuế: ' . implode(', ', $val) . '</p>';
						$xungThaiTue[] = '<p>- Hại Thái Tuế: Năm hạn Thái Tuế hại tuổi cầm tinh, tính theo địa chi vd: năm 2021 thuộc năm sửu thì tuôi ngọ tương hại với sửu, án chỉ năm sửu người tuôi ngọ có mootj năm đó dễ có kẻ tiểu nhân quấy phá, hay bị nói xấu, chơi xấu sau lưng, phị phi phiền toái tự kéo đến, nhưng chưa đến nỗi nặng nề nhưng cũng cần chú ý một chút. <span class="red">XẤU</span></p>';
					}
				}
			}
		}
		if (empty($arrayThaiTue) && empty($thaiTue)) {
			$xungThaiTue[] = '<p class="red">Không phạm phải thái tuế</p>';
		}
		$chan_menh_ket_luan = '';
		if ($lasoTuTru->canInfo['nam']['name'] == $khacDungThan) {
			$chan_menh_ket_luan = '<p>- Sau khi xét mệnh cục của chủ sự qua ngũ hành can chi bốn trụ giờ ngày tháng năm sinh ta có, thân vương, thân suy, dụng hỷ thần của chủ sự là kỵ thần, lên thuộc hệ xấu, thiếu sự tương trợ lẫn nhau, dễ có sự mâu thuẫn bất đồng với nhau, nhưng cũng tùy theo thời vận và khoảng mùa trong năm mà xét hung nặng nhẹ. Để hóa giải vấn đề này chủ sự cần có ngũ hành thông quan để chuyển hung thành cát, vấn đề này không thể qua loa được vậy nên quý vị liên hệ với chuyên gia của web để hóa giải (miễn phí) do là kỵ thần lên thuộc <span class="red">XẤU</span></p>';
		}
		$kimLauGioiThieu = '<p>Kim Lâu là những năm không tốt, bất lợi cho việc khởi công xây nhà và cưới hỏi và những việc lớn. Bởi nếu thực hiện những công việc trọng đại này trong tuổi Kim lâu thì sẽ có những trắc trở khó khăn, trắc trở trái ý muốn sẽ xảy ra . và ngụy hại tới bản thân và những người thân xum quanh Kim lâu gồm: 1 thân – 3 thê – 6 tử - 8 lục súc</p>';
		$kimLauKetLuan   = '';
		if ($kimLauChuSu == 1) {
			$kimLauKetLuan = '<p>- Năm ' . $namXem . ' phạm Kim Lâu Thân: Gia chủ năm nay phạm phải kim lâu không tốt cho việc cưới hỏi hay làm nhà. Làm nhà vào tuổi này thì bản thân người làm nhà sẽ bị hại ( ốm đau, bệnh tật, tai nạn…có thể chết người) còn nếu trong hôn nhân dễ đổ vỡ hay bất đồng trong cuộc sống gia đình, nên rất kỵ nếu bạn phạm phải Kim Lâu 1. Nhưng nếu phạm phải kim lâu mà bắt buộc phải cưới hỏi hay làm nhà thì dân gian vẫn có cách hóa giải, nhưng chữa bệnh vẫn không bằng phòng bệnh nên quý vị có thể cân nhắc. Còn quý vị cũng không lên lo lắng vì có hung ắt có cát. Ắt có cách hóa giải.<span class="red">Xấu</span></p>';
		}
		if ($kimLauChuSu == 3) {
			$kimLauKetLuan = '<p>- Năm ' . $namXem . ' phạm Kim Lâu Thê: Gia chủ năm nay phạm phải kim lâu không tốt cho việc cưới hỏi hay làm nhà. Năm nay gia chủ phạm kim lâu thê, sẽ dễ Mang lại tai họa cho chủ sự của mình, những điều không như mong chuyện thì phi, phiền toái, ốm đau, thua lỗ, tranh chấp. vv… Nhưng nếu phạm phải kim lâu mà bắt buộc phải cưới hỏi hay làm nhà thì dân gian vẫn có cách hóa giải, nhưng chữa bệnh vẫn không bằng phòng bệnh nên quý vị có thể cân nhắc. Còn quý vị cũng không lên lo lắng vì có hung ắt có cát. Ắt có cách hóa giải...<span class="red">Xấu</span></p>';
		}
		if ($kimLauChuSu == 6) {
			$kimLauKetLuan = '<p>- Năm ' . $namXem . ' phạm Kim Lâu Tử: Gia chủ năm nay phạm phải kim lâu không tốt cho việc cưới hỏi hay làm nhà. Mang hại cho con cái, vì năm nay gia chủ phạm phải kim lâu tử (con) con cái dễ ốm đau, bệnh tật, hoặc gắp những điều xui xeo, Nhưng nếu phạm phải kim lâu mà bắt buộc phải cưới hỏi hay làm nhà thì dân gian vẫn có cách hóa giải, nhưng chữa bệnh vẫn không bằng phòng bệnh nên quý vị có thể cân nhắc. Còn quý vị cũng không lên lo lắng vì có hung ắt có cát. Ắt có cách hóa giải. XẤU. (nếu bắt buộc phải làm xin liên hệ với chuyên gia để hóa giải)<span class="red">Xấu</span></p>';
		}
		if ($kimLauChuSu == 8) {
			$kimLauKetLuan = '<p>- Năm ' . $namXem . ' phạm Kim Lâu Lục Súc: Gia chủ năm nay phạm phải kim lâu không tốt cho việc cưới hỏi hay làm nhà. Hại cho vật nuôi, làm ăn thất bát. Khi xưa khi phạm kim lâu súc sẽ ảnh hưởng tới vật nuôi vì chúng ta thuộc thuần nông, vật nuôi là đầu cơ nghiệp, (trâu, bò) vậy cho lên kim lâu súc thuộc kinh tế thời nay, nếu khi phạm kim lâu này quý vị không tránh được thì dễ làm ăn thua nỗ, mất nhiều hơn được, Nhưng nếu phạm phải kim lâu mà bắt buộc phải cưới hỏi hay làm nhà thì dân gian vẫn có cách hóa giải, nhưng chữa bệnh vẫn không bằng phòng bệnh nên quý vị có thể cân nhắc. Còn quý vị cũng không lên lo lắng vì có hung ắt có cát. Ắt có cách hóa giải.<span class="red">Xấu</span></p>';
		}
		if (!in_array($kimLauChuSu, [
			1,
			3,
			6,
			8,
		])) {
			echo '<p class="red">Năm ' . $kimLauChuSu . ' tuổi của bạn không phạm kim lâu.</p>';
		}
		$ngaySatGioiThieu = '<p>- Sát được tính theo tam hợp cục, khi chúng ta làm lễ vu quy hay làm việc lớn. Để tránh sự hung hại không đáng có, khi phạm sát làm việc dễ nửa chừng gần được lại mất, dễ hiểu lầm, gặp cơ hội nhưng không nắm bắt được mà có gặp gỡ dễ gặp hung tinh</p>';
		if (in_array($lasoTuTruNgay->ngaythangAm[0], [
			1,
			29,
			30,
		])) {
			$ngaySoc = '<p class="red">Ngày xem ' . $ngayXemFull . ' dương lịch tức ' . $ngayAm . ' âm lịch phạm vào ngày sóc</p>';
		} else {
			$ngaySoc = '<p class="red">Ngày xem ' . $ngayXemFull . ' dương lịch tức ' . $ngayAm . ' âm lịch không phạm vào ngày sóc</p>';
		}
		$arrayMonthSat = [
			1  => [
				'tuat',
				'ty',
			],
			2  => [
				'thin',
				'ti',
			],
			3  => [
				'hoi',
				'mui',
			],
			4  => [
				'ty',
				'mao',
			],
			5  => [
				'ti',
				'than',
			],
			6  => [
				'ngo',
				'tuat',
			],
			7  => ['suu'],
			8  => [
				'mui',
				'hoi',
			],
			9  => [
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
			$compareArr['thutu_satchu'] = true;
			$thuTuSatChu                = '<p class="red">Ngày xem ' . $ngayXemFull . ' dương lịch tức ' . $ngayAm . ' âm lịch phạm thụ tử sát chủ</p>';
		} else {
			$thuTuSatChu = '<p class="red">Ngày xem ' . $ngayXemFull . ' dương lịch tức ' . $ngayAm . ' âm lịch không phạm thụ tử sát chủ</p>';
		}
		return new \WP_REST_Response([
			'code'    => 'success',
			'message' => '',
			'status' => 200,
			'data'    => [
				'anh_con_giap'                  => get_stylesheet_directory_uri() . '/congiap/' . $lasoTuTru->chiNamSlug . '_active.png',
				'menh_chu'                      => $batTu['menh'],
				'gio_sinh'                      => $lasoTuTru->gioSinh,
				'phut_sinh'                     => $lasoTuTru->phutSinh,
				'ngay_duong'                    => $lasoTuTru->ngayDuong,
				'thang_duong'                   => $lasoTuTru->thangDuong,
				'nam_duong'                     => $lasoTuTru->namDuong,
				'gio_phut_sinh'                 => $lasoTuTru->gioPhutSinh,
				'ngay_am'                       => $lasoTuTru->ngaythangAm[0],
				'thang_am'                      => $lasoTuTru->ngaythangAm[1],
				'nam_am'                        => $lasoTuTru->ngaythangAm[2],
				'tiet_khi'                      => $tietKhi['name'],
				'nam_can_chi'                   => $lasoTuTru->canNamText . ' ' . $lasoTuTru->chiNamText,
				'menh_nien'                     => $napAm['nam']['menh'],
				'menh_quai'                     => $menhQuai,
				'thai_nguyen'                   => $cungMenhThaiNguyen['thai_nguyen']['can'] . ' ' . $cungMenhThaiNguyen['thai_nguyen']['chi'],
				'cung_menh'                     => $cungMenhThaiNguyen['cung_menh']['info'],
				'cung_menh_can_chi'             => $cungMenhThaiNguyen['cung_menh']['can'] . ' ' . $cungMenhThaiNguyen['cung_menh']['chi'],
				'bat_tu'                        => $namAmLich,
				'menh'                          => $banMenhText,
				'dung_than'                     => [
					'class' => $dungThan,
					'text'  => $lasoTuTru->convertSlugToText($dungThan),
				],
				'hy_than'                       => [
					'class' => $hyThan,
					'text'  => $lasoTuTru->convertSlugToText($hyThan),
				],
				'can_chi_am_lich'               => $namAmLichNgay,
				'can_chi_duong_lich'            => $lasoTuTruNgay->gioSinh . ' giờ, ' . $ngayDuong,
				'can_chi_gio_sinh_am_lich_text' => $lasoTuTruNgay->hourToText($lasoTuTruNgay->gioSinh),
				'thien_can_ket_luan'            => $thienCan,
				'dia_chi_ket_luan'              => $diaChi,
				'menh_nien_ket_luan'            => $menhNien,
				'pham_thai_tue'                 => $phamThaiTue,
				'xung_thai_tue'                 => $xungThaiTue,
				'chan_menh_ket_luan'            => $chan_menh_ket_luan,
				'kim_lau_gioi_thieu'            => $kimLauGioiThieu,
				'kim_lau_ket_luan'              => $kimLauKetLuan,
				'ngay_sat_gioi_thieu'           => $ngaySatGioiThieu,
				'ngay_sat_ket_luan'             => $satStr,
				'ngay_soc_ket_luan'             => $ngaySoc,
				'thu_tu_sat_chu'                => $thuTuSatChu,
			],
		]);
	}
}
