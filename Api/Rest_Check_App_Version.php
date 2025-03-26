<?php

namespace AnChoi;

class Rest_Check_App_Version {

	const IS_IOS = 'IOS';
	const IS_ANDROID = 'ANDROID';
	const ANDROID_RELEASE_VERSION = '1.0.9';
	const IOS_RELEASE_VERSION = '1.0.9';

    public function __construct() {
        $this->namespace = '/check-app-version';
        $this->resource_name = 'get';
    }

    // Register our routes.
    public function register_routes() {
        register_rest_route($this->namespace, '/' . $this->resource_name, array(
            // Here we register the readable endpoint for collections.
            array(
                'methods' => 'GET',
                'callback' => [
                    $this,
                    'getVersion',
                ],
                'args' => [
                ],
            ),
        ));
    }

    public function getVersion($data) {
        $params = $data->get_params();

        $appVersion = isset($params['app_version']) ? $params['app_version'] : '1.0.0';
        $device_type = isset($params['device_type']) ? $params['device_type'] : '';
	    $hasNewVersion = false;
        if (($device_type == self::IS_IOS && $appVersion < self::IOS_RELEASE_VERSION) ||
	        ($device_type == self::IS_ANDROID && $appVersion < self::ANDROID_RELEASE_VERSION)) {
	        $hasNewVersion = true;
        }
	    return new \WP_REST_Response([
		    'code' => 'success',
		    'message' => '',
		    'status' => 200,
		    'data' => [
			    'hasNewVersion' => $hasNewVersion,
			    'forceUpdate' => true
		    ]
	    ]);
    }

}
