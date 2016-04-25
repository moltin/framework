<?php

namespace Controllers;

class Collection extends \SlimController\SlimController
{

    public function indexAction($slug, $offset = 0)
    {
        try {

            // Get collection
            $collection = \Collection::Find(['slug' => $slug, 'status' => 1]);

            if ($collection['result'][0]) {
                // Get products
                $products = \Product::Find([
                    'limit'    => $this->app->config['app_per_page'],
                    'offset'   => $offset,
                    'collection' => $collection['result'][0]['id']
                ]);
    
                // Assign products
                $collection['products'] = $products['result'];               
            } else {
                $this->app->redirect('404');
            }

        } catch(\Exception $e) {
            exit($e->getMessage());
        }

        // Build page
        $this->render('Views/Collection', $collection);
    }

}
