<?php

namespace AnChoi;

use Automattic\WooCommerce\Client;
use WP_Query;

class Rest_Woo_Single_Product_Api
{

    public function __construct()
    {
        $this->namespace = '/woo/product';
        $this->resource_name = '/id';
    }

    // Register our routes.
    public function register_routes()
    {
        register_rest_route($this->namespace, '/' . $this->resource_name . '/(?P<id>[\d]+)', array(
            // Notice how we are registering multiple endpoints the 'schema' equates to an OPTIONS request.
            array(
                'methods' => 'GET',
                'callback' => array($this, 'events_get_callback'),
                //'permission_callback' => array( $this, 'get_item_permissions_check' ),
            ),
            // Register our schema callback.
            //'schema' => array( $this, 'get_item_schema' ),
        ));
    }

    public function events_get_callback($data)
    {
		global $wpdb;
        //?ngay=06&thang=06&nam=1906&gio=03&phut=04&gioitinh=nam
        $params = $data->get_params();
        $product_id = !empty($params['id']) ? intval($params['id']) : 0;
        if (!$product_id) {
            $results = [
                'success' => true,
                'data' => [],
                'code' => 200
            ];

            wp_send_json($results);
            wp_die();
        }

        $product = wc_get_product($product_id);
		
		// if (is_a( $product, 'WC_Product_Variable' )) {
			// echo 222;
		// } else {
			// echo 111;
		// }
		//var_dump($product);die;
        //$current_products = $product->get_children();
		$term_obj_list = get_the_terms($product_id, 'product_cat' );
		$thumbId = get_post_thumbnail_id($product_id); 
		$thumb = [
			'id' => $thumbId,
			'main' => wp_get_attachment_image_src( $thumbId, 'post'),
			'meta' => get_post_meta($thumbId)
			
		];
		$product_info = [
            'name' => html_entity_decode($product->get_name()),
			'thumbInfo' => $thumb,
            'slug' => ($product->get_slug()),
			'categories' => $term_obj_list,
            'get_date_created' => ($product->get_date_created()),
            'image' => $product->get_image(),
			'image_url' => get_the_post_thumbnail_url($product_id),
            'detail' => html_entity_decode($product->get_description()),
			'regular_price' => $product->get_regular_price(),
            //'sale_price' => $product->get_sale_price(),
            'price' => $product->get_price(),
            'price_html' => html_entity_decode(strip_tags($product->get_price_html())),
            'is_on_sale' => $product->is_on_sale(),
            'is_on_sale' => $product->is_on_sale(),
            'product_id' => $product->get_id(),
        ];
		$items = [];
		$attributesExtra = $product->get_attributes();
		$extraInfo =[];
		foreach( $attributesExtra as $attr_name => $attr ){
			$extraInfo[$attr_name]['name'] = wc_attribute_label( $attr_name ); // attr label
			// or get_taxonomy( $attr_name )->labels->singular_name;

			$attrValue = [];
			foreach( $attr->get_terms() as $term ){

				$attrValue[] =  $term->name;
			}
			$extraInfo[$attr_name]['value'] = implode(',', $attrValue);
		}
		if (is_a( $product, 'WC_Product_Variable' )) {
			$available_variations = $product->get_available_variations();
			$attributes = wc_get_attribute_taxonomies();
			foreach ($attributes as $attribute) {
				$attribute->attribute_terms = get_terms(array(
					'taxonomy' => 'pa_'.$attribute->attribute_name,
					'hide_empty' => false,
				));
			}

			$listTax = [];
			$attributesLabels = [];
			foreach ($attributes as $tax) {
				if (!empty($tax->attribute_terms)) {
					foreach ($tax->attribute_terms as $item) {
						$attributesLabels['attribute_' . $item->taxonomy] = $tax->attribute_label;
						$listTax[$item->term_id] = [
							'tax' => 'attribute_' . $item->taxonomy,
							'name' => mb_strtoupper($item->name),
							'slug' => $item->slug,
						];
					}
				}
			}

			foreach( $available_variations as $i => $variation ) {
				//check if variation has stock or not 
				if ( $variation['is_in_stock'] ) {
					// Get max qty that user can purchase
					$max_qty = $variation['max_qty'];

					// Prepare availability html for stock available instance
					//$availability_html = '<p class="stock in-stock">' . $max_qty . ' units available for your purchase.' . '</p>';
					$stock = true;
					//$number_available = $max_qty;
				} else {
					// Prepare availability html for out of stock instance
					//$availability_html = '<p class="stock out-of-stock">Oops, we have no stock left.</p>';
					$stock = false;
					//$number_available = 0;
				}
				$attributesItems = [];
				foreach($variation['attributes'] as $key => $value) {
					$attributesItems[$key]['attribute'] = $key;
					$attributesItems[$key]['value'] = $value;
					foreach($listTax as $ii => $item) {
						if ($item['slug'] == $value && $key == $item['tax']) {
							$attributesItems[$key]['name'] = $item['name'];
							//break;
						}
					}
					
				}

				//$items[$i]['availability_html'] = $availability_html;
				//$items[$i]['number_available'] = $number_available;
				//$items[$i]['attributes'] = $variation['attributes'];
				$items[$i]['attributesItems'] = $attributesItems;
				$items[$i]['stock'] = $stock;
				$items[$i]['price'] = $variation['display_price'];
				$items[$i]['regular_price'] = $variation['display_regular_price'];
				$items[$i]['image'] = $variation['image'];
				$items[$i]['is_in_stock'] = $variation['is_in_stock'];
				$items[$i]['variation_id'] = $variation['variation_id'];
			}
		}
		$sql = 'select * from wrwerwp_postmeta where post_id=' . $product_id;
		//echo $sql;die;
		$post_metas = $wpdb->get_results($sql);
		$result = [
			'extraInfo' => array_values($extraInfo),
			'post_metas' => $post_metas,
			'attributesLabels' => $attributesLabels,
			'product_info' => $product_info,
			'variation' => $items,
		];

        wp_send_json($result);
        wp_die();
    }

}
