<?php

namespace AnChoi;

class Rest_Insert_Order {

    public function __construct() {
        $this->namespace = '/order';
        $this->resource_name = 'add';
    }

    // Register our routes.
    public function register_routes() {
        register_rest_route($this->namespace, '/' . $this->resource_name, array(
            // Here we register the readable endpoint for collections.
            array(
                'methods' => 'POST',
                'callback' => [
                    $this,
                    'events_insert_callback',
                ],
                'args' => [
                    'phone'    => [
                        'required' => true,
                    ],
                    'name'    => [
                        'required' => true,
                    ],
                ],
            ),
        ));
    }

    public function events_insert_callback($data) {
        $params = $data->get_params();
	    global $wpdb;
        $defaults = array(
            'so_sim' => null,
            'phone' => null,
            'name' => null,
            'price' => null,
            'note' => null,
            'source' => null,
            'type' => 0,
            'mb' => 0,
            'sp' => 0,
            'buy' => 0,
			'address' => '',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        );

        $paramsSanitext = [
            'so_sim' => isset($params['so_sim']) ? sanitize_text_field($params['so_sim']) : '',
            'phone' => isset($params['phone']) ? sanitize_text_field($params['phone']) : '',
            'name' => isset($params['name']) ? sanitize_text_field($params['name']) : '',
            'price' => isset($params['price']) ? sanitize_text_field($params['price']) : '',
            'note' => isset($params['note']) ? sanitize_text_field($params['note']) : '',
            'type' => isset($params['stk_stt']) ? sanitize_text_field($params['stk_stt']) : '',
            'mb' => isset($params['mb']) ? sanitize_text_field($params['mb']) : '',
            'address' => isset($params['address']) ? sanitize_text_field($params['address']) : '',
            'source' => 'APP',
            'sp' => isset($params['mb']) && $params['mb'] == 1 ? 1 : 0,
            'buy' => isset($params['buy']) && $params['buy'] == 1 ? 1 : 0,
        ];

        $args = wp_parse_args($paramsSanitext, $defaults);

        $table_name = $wpdb->prefix . 'sim_orders';
        if ($wpdb->insert($table_name, $args)) {
            return new \WP_REST_Response([
                'message' => 'Success',
                'status' => 200,
                'id' => $wpdb->insert_id
            ]);
        }
        exit;
    }

}
