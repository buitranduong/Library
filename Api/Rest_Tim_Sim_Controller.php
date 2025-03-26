<?php

namespace AnChoi;
use Laven\Timsim;
class Rest_Tim_Sim_Controller {

	public function __construct () {
		$this->namespace     = '/sim-phong-thuy/v1';
		$this->resource_name = 'tim-sim';
	}

	// Register our routes.
	public function register_routes () {
		register_rest_route($this->namespace, '/' . $this->resource_name, array(
			// Here we register the readable endpoint for collections.
			array(
				'methods'  => 'GET',
				'callback' => [
					$this,
					'tim_sim',
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

	public function tim_sim ($data) {
		$params                 = $data->get_params();		
		$dateOfBirthExploded    = explode("-", $params['dob']);
		$gioSinh                = $params['hob'];
		$phutSinh               = $params['mob'];
		$gioiTinhVal            = $params['gender'];
		$source					= isset($params['source']) ? $params['source'] : "";
		$ngaySinh               = $dateOfBirthExploded[0];
		$thangSinh              = $dateOfBirthExploded[1];
		$namSinh                = $dateOfBirthExploded[2];
		$ngaysinhFull           = $ngaySinh . '-' . $thangSinh . '-' . $namSinh;
		$tuTru                  = new \Laven\LasoTutru($ngaysinhFull, $gioSinh, $phutSinh, $gioiTinhVal, 7, "");
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
		$lasoInfo['chuTinh']    = $chuTinh;
		$lasoInfo['canTang']    = $canTang;
		$lasoInfo['nhatKien']   = $nhatKien;
		$lasoInfo['nguyetKien'] = $nguyetKien;
		$lasoInfo['napAm']      = $napAm;
		foreach ($canTang['nam'] as $canValue) :
			$tt                          = $tuTru->tinhCanTangThapThan($canValue);
			$vts                         = $tuTru->tinhCanTangVTS($canValue);
			$lasoInfo['can_tang']['nam'] = [
				'chu_tinh'  => $tt,
				'thap_than' => $vts,
			];
		endforeach;
		foreach ($canTang['ngay'] as $canValue) :
			$tt                           = $tuTru->tinhCanTangThapThan($canValue);
			$vts                          = $tuTru->tinhCanTangVTS($canValue);
			$lasoInfo['can_tang']['ngay'] = [
				'chu_tinh'  => $tt,
				'thap_than' => $vts,
			];
		endforeach;
		foreach ($canTang['gio'] as $canValue) :
			$tt                          = $tuTru->tinhCanTangThapThan($canValue);
			$vts                         = $tuTru->tinhCanTangVTS($canValue);
			$lasoInfo['can_tang']['gio'] = [
				'chu_tinh'  => $tt,
				'thap_than' => $vts,
			];
		endforeach;
		$listSao                  = $tuTru->tinhSao('nam');
		$arrDucTuquyNhan          = $tuTru->tinhDucTuQuyNhan('nam');
		$listSao                  = array_merge($listSao, $arrDucTuquyNhan);
		$listSao                  = array_unique($listSao);
		$lasoInfo['sao']['nam']   = $listSao;
		$listSao                  = $tuTru->tinhSao('thang');
		$arrDucTuquyNhan          = $tuTru->tinhDucTuQuyNhan('thang');
		$listSao                  = array_merge($listSao, $arrDucTuquyNhan);
		$listSao                  = array_unique($listSao);
		$lasoInfo['sao']['thang'] = $listSao;
		$listSao                  = $tuTru->tinhSao('ngay');
		$arrDucTuquyNhan          = $tuTru->tinhDucTuQuyNhan('ngay');
		$listSao                  = array_merge($listSao, $arrDucTuquyNhan);
		$listSao                  = array_unique($listSao);
		$listSao                  = $tuTru->tinhSao('gio');
		$arrDucTuquyNhan          = $tuTru->tinhDucTuQuyNhan('gio');
		$listSao                  = array_merge($listSao, $arrDucTuquyNhan);
		$listSao                  = array_unique($listSao);
		$lasoInfo['sao']['gio']   = $listSao;
		$doVuong                  = $tuTru->tinhDoVuong();
		$doVuongSuy               = $tuTru->tinhDoVuongSuy($doVuong);
		$total                    = array_sum($doVuongSuy['total']);
		$soNguHanh                = floor($total * 0.4);
		$dungThan                 = $hyThan = $banMenhText = '';
		$thanNhuoc                = false;
		if ($doVuongSuy['cung_phe'] >= $soNguHanh) {
			$banMenhText = 'Vượng ' . $doVuongSuy['ban_menh']['title'];
			$dungThan    = $doVuongSuy['ban_menh']['dung_than'];
			$hyThan      = $doVuongSuy['ban_menh']['hy_than'];
		}
		if ($doVuongSuy['cung_phe'] < $soNguHanh) {
			$banMenhText = 'Nhược ' . $doVuongSuy['ban_menh']['title'];
			$dungThan    = $doVuongSuy['ban_menh']['dung_than_2'];
			$hyThan      = $doVuongSuy['ban_menh']['hy_than_2'];
			$thanNhuoc   = true;
		}
		$dungThanId = $tuTru->getNguHanhId($dungThan);
		if ($thanNhuoc) {
			$khacDungThan = $tuTru->biKhac($dungThan);
		} else {
			$khacDungThan = $tuTru->tuongSinh($dungThan);
		}
		$khacDungThan      = $tuTru->getNguHanhId($khacDungThan);
		$hyThanId          = $tuTru->getNguHanhId($hyThan);
		$textDungThanVuong = 'Sau khi xét các mối tương tác sự,  xung, khắc, trợ, sinh, hao, hợp, hóa, tám thiên can địa chi của bốn trụ năm, tháng, ngày, giờ sinh. Qua công thức tính độ vượng của ngũ hành. Có thể thấy trong Tứ Trụ này có Thân VƯỢNG thuộc hành';
		$textDungThanNhuoc = 'Sau khi xét các mối tương tác sự,  xung, khắc, trợ, sinh, hao, hợp, hóa, tám thiên can địa chi của bốn trụ năm, tháng, ngày, giờ sinh. Qua công thức tính độ vượng của ngũ hành. Có thể thấy trong Tứ Trụ này có Thân NHƯỢC thuộc hành';
		$dungThanDuDoan    = '';
        if (!$thanNhuoc) {
            $dungThanDuDoan = '<p>' . $textDungThanVuong . ' '.$tuTru->convertSlugToText($doVuongSuy['ban_menh']['name']).'</p><p class="bold">Dụng Thần dự đoán là '.$tuTru->convertSlugToText($dungThan).', Hỷ Thần là '.implode(', ', array_map([$tuTru, 'convertSlugToText'], $hyThan)).' tùy vận</p>';
        } else {
            $dungThanDuDoan = '<p>' . $textDungThanNhuoc . ' '.$tuTru->convertSlugToText($doVuongSuy['ban_menh']['name']).'</p><p class="bold">Dụng Thần dự đoán là '.$tuTru->convertSlugToText($dungThan).', Hỷ Thần là '.implode(', ', array_map([$tuTru, 'convertSlugToText'], $hyThan)).' tùy vận</p>';
        }
		//$current_url = add_query_arg($_SERVER['QUERY_STRING'], '', home_url($wp->request));
		$array_price = [
			'1,2' => '1tr-2tr',
			'2,3' => '2tr-3tr',
			'3,5' => '3tr-5tr',
			'5,10' => '5tr-10tr',
			'10,0' => 'Trên 10tr',
		];
		$array_telco = [
			1 => 'Viettel',
			2 => 'Vinaphone',
			3 => 'Mobifone',
			4 => 'Vietnamobile',
			5 => 'Gmobile',
			8 => 'Itel Telecom',
		];
		$price = !empty($_GET['pc']) ? strip_tags($_GET['pc']) : '';
		$telco = !empty($_GET['t']) ? strip_tags($_GET['t']) : '';
		if (!array_key_exists($price, $array_price)) {
			$price = '';
		}
		if (!array_key_exists($telco, $array_telco)) {
			$telco = '';
		}

		$urlRemove = remove_query_arg(['pc', 't'], true);
		$timsim = new Timsim(['dungThanId' => $dungThanId, 'hyThanId' => $hyThanId, 'telco' => $telco, 'price' => $price, 'menhAmDuong' => $tuTru->menhAmDuong, 'source' => $source]);

		$listSim = $timsim->getSimByCondition();
		return new \WP_REST_Response([
			'batTu'              => $batTu,
			'textDungThanVuong' => $textDungThanVuong,
			'dungThanDuDoan'    => $dungThanDuDoan,
			'luanGiai' =>  [
				'can' => $tuTru->namAmlich['can']['luan_giai'],
				'chi' => $tuTru->namAmlich['chi']['luan_giai'],
				'napAm' => $tuTru->napAmLuanGiai[$napAm['nam']['ngu_hanh']],
				'cungMenh' => $cungMenhThaiNguyen['cung_menh']['info']
			],
			'thanVuongMenh' => $doVuongSuy['ban_menh']['name'],
			'banMenhText' => $banMenhText,
			'listSim' => array_slice($listSim, 0, 19)
		], 200);
	}
}
