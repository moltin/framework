<?php

namespace Controllers;

class Category extends \SlimController\SlimController
{

    public function indexAction($slug, $offset = 0)
    {
        try {

            // Get category
            $result   = $this->app->moltin->get('category', ['slug' => $slug, 'status' => 1]);
            $category = $result['result'][0];

            // Get products
            $result = $this->app->moltin->get('products', [
                'category' => $category['id'],
                'status'   => 1,
                'limit'    => $this->app->config['app_per_page'],
                'offset'   => $offset
            ]);

            // Assign products
            $category['products'] = $result['result'];

        } catch(\Exception $e) {
            exit($e->getMessage());
        }

        // Build page
        $this->render('Views/Category', $category);
    }

}
