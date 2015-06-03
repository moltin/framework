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

        unset($_SESSION);

        // Load the SDK
        $moltin = new \Moltin\SDK\SDK(new \Moltin\SDK\Storage\Session(), new \Moltin\SDK\Request\CURL(), [
            'url'      => ( isset($this->config['moltin_api_url']) ? $this->config['moltin_api_url'] : null ),
            'auth_url' => ( isset($this->config['moltin_api_auth_url']) ? $this->config['moltin_api_auth_url'] : null ),
            'version'  => ( isset($this->config['moltin_api_version']) ? $this->config['moltin_api_version'] : null )
        ]);

        \Moltin::Authenticate('ClientCredentials', [
            'client_id'     => $this->config['api_client_id'],
            'client_secret' => $this->config['api_client_secret']
        ]);

    	try {
    		// Get categories
            $categories = \Category::Tree(['status' => 1]);
        } catch(\Exception $e) {
            exit($e->getMessage());
        }

        try {
            // Get cart contents
    		$cart = \Cart::Contents()['result'];
    	} catch(\Exception $e) {
    		exit($e->getMessage());
    	}

        try {
            // Get pages
            $pages = \Entry::Find('page', ['status' => 1])['result'];
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
