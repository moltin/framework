<?php

namespace Middleware;

class Moltin extends \Slim\Middleware
{

	public $config;

	public function __construct($config)
	{
		$this->config = $config;
	}

    public function call()
    {
        $this->app->hook('slim.before', array($this, 'sdkLoader'));
        $this->next->call();
    }

    public function sdkLoader()
    {
    	// Variables
    	$category = [];
    	$cart     = [];

	    // SDK
	    $this->app->moltin = new \Moltin\SDK\SDK(new \Moltin\SDK\Storage\Session(), new \Moltin\SDK\Request\CURL());

	    // SDK Authentication
	    $this->app->moltin->authenticate(new \Moltin\SDK\Authenticate\ClientCredentials(), [
	        'client_id'     => $this->config['api_client_id'],
	        'client_secret' => $this->config['api_client_secret']
	    ]);

    	try {
    		// Get categories
            $categories = $this->app->moltin->get('categories/tree');
        } catch(\Exception $e) {
            exit($e->getMessage());
        }

        try {
    		// Get cart
    		if ( isset($_COOKIE['identifier']) ) {
    			$cart = $this->app->moltin->get('cart/'.$_COOKIE['identifier']);
                $cart = $cart['result'];
    		}
    	} catch(\Exception $e) {
    		exit($e->getMessage());
    	}

        // add cart to app - so it can be accessed in controllers
        $this->app->cart = $cart;

    	// Assign to view
    	$this->app->view()->appendData([
    		'categories' => $categories['result'],
    		'cart'       => $cart
    	]);
    }

}
