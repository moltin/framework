<?php

namespace Controllers;

class Category extends \SlimController\SlimController
{

    public function indexAction($slug, $offset = 0)
    {
        try {

            // Get category
            $category = $this->app->moltin->get('category', ['slug' => $slug, 'status' => 1])['result'][0];

            // Get products
            $products = $this->app->moltin->get('products', [
                'limit'    => $this->app->config['app_per_page'],
                'offset'   => $offset
            ]);

            // Assign products
            $category['products'] = $products['result'];

        } catch(\Exception $e) {
            exit($e->getMessage());
        }

        // Build page
        $this->render('Views/Category', $category);
    }

}
