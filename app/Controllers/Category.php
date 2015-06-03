<?php

namespace Controllers;

class Category extends \SlimController\SlimController
{

    public function indexAction($slug, $offset = 0)
    {
        try {

            // Get category
            $category = \Category::Find(['slug' => $slug, 'status' => 1]);

            if ($category['result'][0]) {
                // Get products
                $products = \Product::Find([
                    'limit'    => $this->app->config['app_per_page'],
                    'offset'   => $offset,
                    'category' => $category['result'][0]['id']
                ]);
    
                // Assign products
                $category['products'] = $products['result'];               
            } else {
                $this->app->redirect('404');
            }

        } catch(\Exception $e) {
            exit($e->getMessage());
        }

        // Build page
        $this->render('Views/Category', $category);
    }

}
