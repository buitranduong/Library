<?php

namespace AnChoi;

class Rest_Insert_Order_MemberShip {

    public function __construct() {
        $this->namespace = '/register_membership';
        $this->resource_name = 'add';
    }

    // Register our routes.
    public function register_routes() {
        register_rest_route($this->namespace, '/' . $this->resource_name, array(
            array(
                'methods' => 'POST',
                'callback' => [
                    $this,
                    'events_insert_callback',
                ],
                'args' => [
                    'name'      => [
                        'required'          => true,
                        'validate_callback' => function($param, $request, $key) {
                            return !empty($param);
                        },
                    ],
                    'phone'    => [
                        'required' => true,
                        'validate_callback' => function($param, $request, $key) {
                            return !empty($param) && preg_match('/0\w{9}$/m', $param);
                        },
                    ],

                ],
            ),
        ));
    }
    function events_insert_callback($data) {
        global $wpdb;
        $params = $data->get_params();
        $item = null;
        $services = get_field('services', 'option');
        if (!empty($services) && !empty($params['payment_item'])) {
            $item = $services['items'][$params['payment_item']];
        }
        $defaults = array(
            'id'         => null,
            'name'         => '',
            'phone' => null,
            'payment_item' => null,
            'type' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'deleted_at' => date('Y-m-d H:i:s'),
        );

        $args = [
            'name'         => sanitize_text_field($params['name']),
            'phone' => sanitize_text_field($params['phone']),
        ];
        if (isset($item)) {
            $args['payment_item'] = $item['title'] . '['.$item['price'].']';
        }
        $args       = wp_parse_args( $args, $defaults );
        $table_name = $wpdb->prefix . 'member_payments';
        if ($wpdb->insert($table_name, $args)) {
            return new \WP_REST_Response([
                'message' => 'Success',
                'status' => 200,
                'id' => $wpdb->insert_id
            ]);
        }
        return new \WP_REST_Response([
            'message' => 'Error',
            'status' => 400,
        ]);
    }
}
