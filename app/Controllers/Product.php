<?php

namespace Controllers;

class Product extends \SlimController\SlimController
{

    public function indexAction($slug)
    {
        try {
            $product = \Product::Find(['slug' => $slug, 'status' => 1]);

            if (! empty($product['result'][0])) {
                
            } else {
                $this->app->redirect('404');
            }
        } catch(\Exception $e) {
            exit($e->getMessage());
        }

        // Build page
        $this->render('Views/Product', $product['result'][0]);
    }

}
