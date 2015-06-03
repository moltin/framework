<?php

namespace Controllers;

class Home extends \SlimController\SlimController
{

    public function indexAction()
    {

        // Get products
        $products = \Product::Find([
            'limit'    => 9,
            'featured' => 1,
            'status'   => 1
        ]);

        // Get collections
        $collections = \Collection::Find([
            'status'    => 1,
        ]);

        // Get currencies
        $currencies = \Currency::Find([
            'status'    => 1,
        ]);

        //echo "<pre>";
        //print_r($products);
        //exit;

        $this->render('Views/Home', [
        	'title' 		=> 'Home',
        	'products' 		=> $products['result'],
        	'collections' 	=> $collections['result'], 
        	'currencies' 	=> $currencies['result']
        ]);
    }

    public function pageAction($page)
    {
        try {
            // Get page
            $page = \Entry::Get('page', ['slug' => $page, 'status' => 1])['result'];
        } catch(\Exception $e) {
            $this->app->flash('error', $e->getMessage());
            $this->render('Views/404', [
        		'title' => '404'
        	]);
        	exit;
        }

        $this->render('Views/Page', [
        	'title' => $page['result']['title'],
        	'page' 	=> $page['result'],
        ]);
    }

}
