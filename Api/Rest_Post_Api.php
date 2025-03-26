<?php

namespace AnChoi;

class Rest_Post_Api {

    public function __construct() {
        $this->namespace = '/post';
    }

    // Register our routes.
    public function register_routes() {
        register_rest_route($this->namespace, '/post-by-cat', array(
            // Here we register the readable endpoint for collections.
            array(
                'methods' => 'POST',
                'callback' => [
                    $this,
                    'events_insert_callback',
                ],
                'args' => [
                    'id'    => [
                        'required' => true,
                        'validate_callback' => function($param, $request, $key) {
                            return is_numeric($param);
                        },
                    ],
                    'page'    => [
                        'validate_callback' => function($param, $request, $key) {
                            return is_numeric($param);
                        },
                    ],
                ],
            ),
        ));
    }

    public function events_insert_callback($data) {
        $params = $data->get_params();
        $id = $params['id'];
        $page = isset($params['page']) ? $params['page'] : 1;
        $offset = ($page - 1) * 10;
        global $wpdb;

        $sql = 'SELECT wrwerwp_posts.ID, wrwerwp_posts.post_title
FROM wrwerwp_posts
LEFT JOIN wrwerwp_term_relationships ON (wrwerwp_posts.ID = wrwerwp_term_relationships.object_id)
LEFT JOIN wrwerwp_term_taxonomy ON (wrwerwp_term_relationships.term_taxonomy_id = wrwerwp_term_taxonomy.term_taxonomy_id)
WHERE wrwerwp_term_taxonomy.term_id IN ('.$id.')
GROUP BY wrwerwp_posts.ID order by wrwerwp_posts.ID DESC LIMIT ' . $offset . ',10';

	    $data = $wpdb->get_results($sql);

        return new \WP_REST_Response([
            'message' => 'Success',
            'status' => 200,
            'data' => $data
        ]);
    }

}
