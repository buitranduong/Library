<?php

namespace AnChoi;

use Automattic\WooCommerce\Client;
use WP_Query;

class Rest_Woo_List_Products_Api
{

    public function __construct()
    {
        $this->namespace = '/woo/products';
        $this->resource_name = '/lists';
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
                    
                ],
            ),
        ));
    }

    public function events_get_callback($data)
    {
		$nguHanhLabel = [
			'kim' => 'Kim',
			'moc' => 'Mộc',
			'thuy' => 'Thủy',
			'hoa' => 'Hỏa',
			'tho' => 'Thổ',
		];
		$params = $data->get_params();
		$page = !empty($params['page']) && is_numeric($params['page']) ? $params['page'] : 1;
		$limit = !empty($params['limit']) && is_numeric($params['limit']) && $params['limit'] <=10 ? $params['limit'] : 8;
		$offset = ($page-1) * $limit;
		
		$filter = !empty($params['filter']) ? $params['filter'] : false;
		
		if ($filter) {
			$queryParams = [
				'limit' => $limit,
				'offset' => $offset,
			];
			if (!empty($params['nguhanh']) && isset($nguHanhLabel[$params['nguhanh']])) {
				$queryParams['nguhanh'] = $params['nguhanh'];
			}
			if (!empty($params['orderby']) && in_array($params['orderby'], ['sales'])) {
				$queryParams['orderby'] = 'sales';
			}
			
			$productsList = $this->getProducts($queryParams);
			$results = [
				'success' => true,
				'products' => $productsList,
				'code' => 200
			];
			wp_send_json($results);
			wp_die();
		}


        $bestSellers = $this->getProducts([
            'type_vat_pham' => 'theo-nguoi',
			'orderby' => 'sales'
            //'menh' => $tuTru->chiNamSlug,
            //'nguhanh' => $attrNguHanh,
        ]);
        $productsKim = $this->getProducts([
            //'type_vat_pham' => 'treo-xe',
            'nguhanh' => 'kim',
        ]);
        $productsThuy = $this->getProducts([
            //'type_vat_pham' => 'phong-lam-viec',
            'nguhanh' => 'thuy',
        ]);
		$productsMoc = $this->getProducts([
            //'type_vat_pham' => 'phong-lam-viec',
            'nguhanh' => 'moc',
        ]);
        $productsHoa = $this->getProducts([
            //'type_vat_pham' => 'phong-lam-viec',
            'nguhanh' => 'hoa',
        ]);
		$productsTho = $this->getProducts([
            //'type_vat_pham' => 'phong-lam-viec',
           'nguhanh' => 'tho',
        ]);

        $results = [
            'success' => true,
            'products' => [
				[
					'id' =>'sales',
					'title' => 'Vật phẩm bán chạy',
					'items' => $bestSellers['items'],
					
				],
				[
					'id' =>'kim',
					'title' => 'Vật phẩm thuộc ngũ hành Kim',
					'items' => $productsKim['items'],
					
				],
				[
					'id' =>'thuy',
					'title' => 'Vật phẩm thuộc ngũ hành Thủy',
					'items' => $productsThuy['items'],
					
				],
				[
					'id' =>'moc',
					'title' => 'Vật phẩm thuộc ngũ hành Mộc',
					'items' => $productsMoc['items'],
					
				],
				[
					'id' =>'hoa',
					'title' => 'Vật phẩm thuộc ngũ hành Hỏa',
					'items' => $productsHoa['items'],
					
				],
				[
					'id' =>'tho',
					'title' => 'Vật phẩm thuộc ngũ hành Thổ',
					'items' => $productsTho['items'],
					
				],
			],
            'code' => 200
        ];

        wp_send_json($results);
        wp_die();
    }

    public function getProducts($args) {
        $number = 8;
        if ( isset( $args ) ) {
            $options = $args;

            if ( isset( $options['limit'] ) ) {
                $number = $options['limit'];
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
		$count = $results->found_posts;
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

        return [
			'items' => $items,
			'count' => $count,
			'num_pages' => ceil($count/$number),
		];
    }

}
