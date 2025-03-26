<?php

namespace AnChoi;

use Laven\Timstk;

class REST_Tim_So_Tai_Khoan_Controller {

	// Here initialize our namespace and resource name.
	public $namespace;

	public $resource_name;

	public $schema;

	public function __construct () {
		$this->namespace     = '/so-tai-khoan-phong-thuy/v1';
		$this->resource_name = 'tim-so-tai-khoan';
	}

	// Register our routes.
	public function register_routes () {
		register_rest_route($this->namespace, '/' . $this->resource_name, array(
			// Here we register the readable endpoint for collections.
			array(
				'methods'  => 'GET',
				'callback' => [
					$this,
					'tim_so_tai_khoan',
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

	public function tim_so_tai_khoan ($data) {
		$params                 = $data->get_params();
		$dateOfBirthExploded    = explode("-", $params['dob']);
		$gioSinh                = $params['hob'];
		$phutSinh               = $params['mob'];
		$gioiTinhVal            = $params['gender'];
		$source                 = isset($params['source']) ? $params['source'] : "";
		$ngaySinh               = $dateOfBirthExploded[0];
		$thangSinh              = $dateOfBirthExploded[1];
		$namSinh                = $dateOfBirthExploded[2];
		$ngaysinhFull           = $ngaySinh . '-' . $thangSinh . '-' . $namSinh;
		$ngaysinhFull           = $ngaySinh . '-' . $thangSinh . '-' . $namSinh;
		$tuTru                  = new \Laven\LasoTutru($ngaysinhFull, $gioSinh, $phutSinh, $gioiTinhVal, 7, $hoTen);
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
		$khacDungThan = $tuTru->getNguHanhId($khacDungThan);
		$hyThanId     = $tuTru->getNguHanhId($hyThan);
		$timSTK       = new Timstk([
			'dungThanId'  => $dungThanId,
			'hyThanId'    => $hyThanId,
			'menhAmDuong' => $tuTru->menhAmDuong,
		]);
		$stkItems     = $timSTK->getSimByCondition();
		return new \WP_REST_Response([
			'stkItems' => $stkItems,
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
}
