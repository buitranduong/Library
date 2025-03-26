<?php

namespace AnChoi;

class Rest_Insert_Su_kien {

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
            'type' => 0,
            'mb' => 0,
        );

        $paramsSanitext = [
            'so_sim' => isset($params['so_sim']) ? sanitize_text_field($params['so_sim']) : '',
            'phone' => isset($params['phone']) ? sanitize_text_field($params['phone']) : '',
            'name' => isset($params['name']) ? sanitize_text_field($params['name']) : '',
            'price' => isset($params['price']) ? sanitize_text_field($params['price']) : '',
            'note' => isset($params['note']) ? sanitize_text_field($params['note']) : '',
            'type' => isset($params['stk_stt']) ? sanitize_text_field($params['stk_stt']) : '',
            'mb' => isset($params['mb']) ? sanitize_text_field($params['mb']) : '',
        ];

        $args = wp_parse_args($paramsSanitext, $defaults);

        $table_name = $wpdb->prefix . 'tietkhi';
        if ($wpdb->insert($table_name, $args)) {
            echo 'sukien id: ' . $wpdb->insert_id;
        }
        exit;
    }

}
