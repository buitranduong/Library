<?php

namespace AnChoi;

use Automattic\WooCommerce\Client;
use WP_Query;

class Rest_Woo_Api
{

    public function __construct()
    {
        $this->namespace = '/woo/products';
        $this->resource_name = '/get';
    }

    // Register our routes.
    public function register_routes()
    {
        register_rest_route($this->namespace, '/' . $this->resource_name, array(
            // Here we register the readable endpoint for collections.
            array(
                'methods' => 'GET',
                'callback' => [
                    $this,
                    'events_get_callback',
                ],
                'args'     => [
                    'ngay'    => [
                        'required'          => true,
                        'validate_callback' => function($param, $request, $key) {
                            return is_numeric($param) && ($param >= 0 && $param <= 31);
                        },
                    ],
                    'thang'    => [
                        'required'          => true,
                        'validate_callback' => function($param, $request, $key) {
                            return is_numeric($param) && ($param >= 0 && $param <= 12);
                        },
                    ],
                    'nam'    => [
                        'required'          => true,
                        'validate_callback' => function($param, $request, $key) {
                            return is_numeric($param) && ($param >= 1900 && $param <= 2050);
                        },
                    ],
                    'gio'    => [
                        'required'          => true,
                        'validate_callback' => function($param, $request, $key) {
                            return is_numeric($param) && ($param >= 0 && $param <= 23);
                        },
                    ],
                    'phut'    => [
                        'required'          => true,
                        'validate_callback' => function($param, $request, $key) {
                            return is_numeric($param) && ($param >= 0 && $param <= 59);
                        },
                    ],
                    'gioitinh' => [
                        'required'          => true,
                        'validate_callback' => function($param, $request, $key) {
                            return in_array($param, ['nam', 'nu']);
                        },
                    ],
                ],
            ),
        ));
    }

    public function events_get_callback($data)
    {
        //?ngay=06&thang=06&nam=1906&gio=03&phut=04&gioitinh=nam
        $params = $data->get_params();

        $ngaysinhFull = $params['ngay'] . '-' . $params['thang'] . '-' . $params['nam'];
        $gioiTinhVal = $params['gioitinh'] == 'nam' ? 1 : 0;
        $tuTru = new \Laven\LasoTutru($ngaysinhFull, $params['gio'], $params['phut'], $gioiTinhVal, 7, '');
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

        $doVuong = $tuTru->tinhDoVuong();
        $doVuongSuy = $tuTru->tinhDoVuongSuy($doVuong);
        $total = array_sum($doVuongSuy['total']);
        $soNguHanh = floor($total * 0.4);
        $dungThan = $hyThan = $banMenhText = '';
        $thanNhuoc = false;
        if ($doVuongSuy['cung_phe'] >= $soNguHanh && $doVuongSuy['cung_phe'] >= 50) {
            $banMenhText = '<p>Vượng ' . $doVuongSuy['ban_menh']['title'] . '</p>';
        } else {
            $banMenhText = '<p>Nhược ' . $doVuongSuy['ban_menh']['title'] . '</p>';
            $thanNhuoc = true;
        }
        $dungThan = $doVuongSuy['ban_menh']['dung_than'];
        $hyThan = $doVuongSuy['ban_menh']['hy_than'];

        $textDungThanVuong = 'Sau khi xét các mối tương tác sự,  xung, khắc, trợ, sinh, hao, hợp, hóa, tám thiên can địa chi của bốn trụ năm, tháng, ngày, giờ sinh. Qua công thức tính độ vượng của ngũ hành. Có thể thấy trong Tứ Trụ này có Thân VƯỢNG thuộc hành';
        $textDungThanNhuoc = 'Sau khi xét các mối tương tác sự,  xung, khắc, trợ, sinh, hao, hợp, hóa, tám thiên can địa chi của bốn trụ năm, tháng, ngày, giờ sinh. Qua công thức tính độ vượng của ngũ hành. Có thể thấy trong Tứ Trụ này có Thân NHƯỢC thuộc hành';

        $menhChu = [
            'title' => 'Tổng quan về thông tin mệnh chủ',
            'data' => [
                'ngay_sinh' => $batTu['menh'] . ' ' . $tuTru->gioPhutSinh . ' ' . $tuTru->ngayDuong . '/' . $tuTru->thangDuong . '/' . $tuTru->namDuong . '(' . $tuTru->ngaythangAm[0] . '/' . $tuTru->ngaythangAm[1] . '/' . $tuTru->ngaythangAm[2] . ' âm lịch), Tiết khí ' . $tietKhi['name'],
                'image_con_giap' => 'http://api.thanglongdaoquan.vn/uploads/congiap/' . $tuTru->chiNamSlug . '_active.png',
                'nam_can_chi' => $tuTru->canNamText . ' ' . $tuTru->chiNamText,
                'menh_nien' => $napAm['nam']['menh'],
                'menh_quai' => $tuTru->menhQuaiArr['menhquai']['name'] . ', ' . $tuTru->menhQuaiArr['menh'],
                'thai_nguyen' => $cungMenhThaiNguyen['thai_nguyen']['can'] . ' ' . $cungMenhThaiNguyen['thai_nguyen']['chi'],
                'cung_menh' => $cungMenhThaiNguyen['cung_menh']['can'] . ' ' . $cungMenhThaiNguyen['cung_menh']['chi'],
                'bat_tu' => $namAmLich,
                'menh' => $banMenhText,
                'menh3' => $doVuongSuy['ban_menh']['name'],
                'menh2' => $napAm['nam']['ngu_hanh'],
                'dung_than' => [
                    'title' => 'Dụng thần',
                    'text' => $tuTru->convertSlugToText($dungThan),
                ],
                'hy_than' => [
                    'title' => 'Hỷ thần',
                    'text' => implode(',', array_map([$tuTru, 'convertSlugToText'], $hyThan)),
                ],
            ]
        ];
		
        $attrNguHanh = $dungThan . ',' . implode(',', $hyThan);

        $vatPhamDeoNguoi = $this->getProducts([
            'type_vat_pham' => 'theo-nguoi',
            'menh' => $tuTru->chiNamSlug,
            'nguhanh' => $attrNguHanh,
        ]);
        $vatPhamTreoXe = $this->getProducts([
            'type_vat_pham' => 'treo-xe',
            'nguhanh' => $attrNguHanh,
        ]);
        $vatPhamPhongLamViec = $this->getProducts([
            'type_vat_pham' => 'phong-lam-viec',
            'nguhanh' => $attrNguHanh,
        ]);
        $vatPhamPhongKhach = $this->getProducts([
            'type_vat_pham' => 'phong-khach',
            'nguhanh' => $attrNguHanh,
        ]);

        $results = [
            'success' => true,
            'data' => [
                'menh_chu' => $menhChu,
                'products' => [
                    [
                        'title' => 'Vật phẩm đeo trên người',
                        'items' => $vatPhamDeoNguoi
                    ],
                    [
                        'title' => 'Vật phẩm treo xe',
                        'items' => $vatPhamTreoXe
                    ],
                    [
                        'title' => 'Vật phẩm đặt phòng làm việc',
                        'items' => $vatPhamPhongLamViec
                    ],
                    [
                        'title' => 'Vật phẩm phòng khách',
                        'items' => $vatPhamPhongKhach
                    ],
                ]
            ],
            'code' => 200
        ];

        wp_send_json($results);
        wp_die();
        // ====================================================

        $authorization = 'Basic ' . base64_encode("" . WOO_COMSUMER_KEY . ":" . WOO_COMSUMER_SECRET . "");


        $response = wp_remote_get(

            add_query_arg(
                $params,
                'https://thanglongdaoquan.vn/wp-json/wc/v2/products',
            ),
            array(
                'headers' => array(
                    'Authorization' => $authorization
                ),
            )
        );
        $results = [
            'success' => true,
            'data' => [],
            'code' => 200
        ];
        $products = [];
        if( 'OK' === wp_remote_retrieve_response_message( $response ) ) {
            $body = wp_remote_retrieve_body($response);
            $products = json_decode($body);
        }

        wp_send_json($results);
        wp_die();
    }

    public function getProducts($args) {
        $number = 8;
        if ( isset( $args ) ) {
            $options = $args;

            if ( isset( $options['products'] ) ) {
                $number = $options['products'];
            }

            $show = ''; // featured, onsale.
            if ( isset( $options['show'] ) ) {
                $show = $options['show'];
            }

            $orderby = 'date';
            $order   = 'desc';
            if ( isset( $options['orderby'] ) ) {
                $orderby = $options['orderby'];
            }
            if ( isset( $options['order'] ) ) {
                $order = $options['order'];
            }
            if ( $orderby == 'menu_order' ) {
                $order = 'asc';
            }

            $tags = '';
            if ( isset( $options['tags'] ) ) {
                if ( is_numeric( $options['tags'] ) ) {
                    $options['tags'] = get_term( $options['tags'] )->slug;
                }
                $tags = $options['tags'];
            }

            $offset = '';
            if ( isset( $options['offset'] ) ) {
                $offset = $options['offset'];
            }
        }

        $query_args = array(
            'posts_per_page'      => $number,
            'post_status'         => 'publish',
            'post_type'           => 'product',
            'no_found_rows'       => false,
            'ignore_sticky_posts' => 1,
            'order'               => $order,
            'product_tag'         => $tags,
            'offset'              => $offset,
            'meta_query'          => WC()->query->get_meta_query(), // @codingStandardsIgnoreLine
            'tax_query'           => WC()->query->get_tax_query(), // @codingStandardsIgnoreLine
        );

        switch ( $show ) {
            case 'featured':
                $query_args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                    'operator' => 'IN',
                );
                break;
            case 'onsale':
                $query_args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
                break;
        }

        switch ( $orderby ) {
            case 'menu_order':
                $query_args['orderby'] = 'menu_order';
                break;
            case 'title':
                $query_args['orderby'] = 'name';
                break;
            case 'date':
                $query_args['orderby'] = 'date';
                break;
            case 'price':
                $query_args['meta_key'] = '_price'; // @codingStandardsIgnoreLine
                $query_args['orderby']  = 'meta_value_num';
                break;
            case 'rand':
                $query_args['orderby'] = 'rand'; // @codingStandardsIgnoreLine
                break;
            case 'sales':
                $query_args['meta_key'] = 'total_sales'; // @codingStandardsIgnoreLine
                $query_args['orderby']  = 'meta_value_num';
                break;
            default:
                $query_args['orderby'] = 'date';
        }

        $query_args = ux_maybe_add_category_args( $query_args, $options['cat'], 'IN' );

        if ( isset( $options['out_of_stock'] ) && $options['out_of_stock'] === 'exclude' ) {
            $product_visibility_term_ids = wc_get_product_visibility_term_ids();
            $query_args['tax_query'][]   = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'term_taxonomy_id',
                'terms'    => $product_visibility_term_ids['outofstock'],
                'operator' => 'NOT IN',
            );
        }
        if (!empty($args['advancedFilter'])) {
            $query_args['tax_query'][]   = array(
                'taxonomy' 		=> $args['advancedFilter'][1],
                'terms' 		=> [$args['advancedFilter'][2]],
                'field' 		=> 'term_id',
            );
            $query_args['tax_query']['relation'] = 'AND';
        }
        if (!empty($args['nguhanh'])) {
            $query_args['tax_query'][]   = array(
                'taxonomy' 		=> 'pa_menh',
                'terms' 		=> explode(',', $args['nguhanh']),
                'field' 		=> 'slug',
            );
            $query_args['tax_query']['relation'] = 'AND';
        }
        if (!empty($args['menh'])) {
            $query_args['tax_query'][]   = array(
                'taxonomy' 		=> 'pa_tuoi',
                'terms' 		=> explode(',', $args['menh']),
                'field' 		=> 'slug',
            );
            $query_args['tax_query']['relation'] = 'AND';
        }
        if (!empty($args['type_vat_pham'])) {
            $query_args['tax_query'][]   = array(
                'taxonomy' 		=> 'pa_loai-vat-pham',
                'terms' 		=> explode(',', $args['type_vat_pham']),
                'field' 		=> 'slug',
            );
            $query_args['tax_query']['relation'] = 'AND';
        }
//var_dump($query_args);die;
        $results = new WP_Query( $query_args );
        $items = [];
        if ($results->have_posts()) {
            $index = 0;
            while ( $results->have_posts() ) {
                $results->the_post();
                global $product;
                $items[$index]['id'] = get_the_ID();
                $items[$index]['title'] = html_entity_decode(get_the_title());
                $items[$index]['regular_price'] = $product->get_regular_price();
                $items[$index]['sale_price'] = $product->get_sale_price();
                $items[$index]['price'] = $product->get_price();
                $items[$index]['price_html'] = html_entity_decode(strip_tags($product->get_price_html()));
                $items[$index]['short_description'] = html_entity_decode($product->get_short_description());
                $items[$index]['image'] = get_the_post_thumbnail_url();
                $items[$index]['is_on_sale'] = $product->is_on_sale();
                $index++;
            }
        }

        return $items;
    }

}
