<?php

namespace AnChoi;

use Automattic\WooCommerce\Client;

class Rest_Woo_Order_Api
{

    public function __construct()
    {
        $this->namespace = '/woo/orders';
        $this->resource_name = '/create';
    }

    // Register our routes.
    public function register_routes()
    {
        register_rest_route($this->namespace, '/' . $this->resource_name, array(
            // Here we register the readable endpoint for collections.
            array(
                'methods' => 'POST',
                'callback' => [
                    $this,
                    'events_get_callback',
                ],
                'args' => [],
            ),
        ));
    }

    public function events_get_callback($data)
    {
        $params = $data->get_params();


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://thanglongdaoquan.vn/wp-json/wc/v3/orders?consumer_key='.WOO_COMSUMER_KEY.'&consumer_secret='.WOO_COMSUMER_SECRET,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $results = [
            'success' => true,
            'data' => json_decode($response),
            'code' => 200
        ];
        wp_send_json($results);
        wp_die();
    }

}
