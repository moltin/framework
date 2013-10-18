<?php

namespace Middleware;

class Moltin extends \Slim\Middleware
{

	protected $config;

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
    		$category = $this->app->moltin->get('categories');
    		$category = $this->generate_tree($category);

    		// Get cart
    		if ( isset($_COOKIE['identifier']) ) {
    			$cart = $this->app->moltin->get('cart/'.$_COOKIE['identifier']);
    		}

    	} catch(\Exception $e) {
    		exit($e->getMessage());
    	}

    	// Assign to view
    	$this->app->view()->appendData([
    		'categories' => $category,
    		'cart'       => $cart
    	]);
    }

    protected function generate_tree($categories)
    {

        // Variables
        $tmp  = array();
        $tree = array();

        // Skip empty
        if ( empty($categories) ) { return; }

        // Start building
        foreach ($categories['result'] AS $category) {
            $tmp[$category['id']] = $category;
        }

        unset($categories);

        foreach ($tmp as $row) {

            if ( array_key_exists($row['parent']['id'], $tmp) ) {
                $tmp[$row['parent']['id']]['children'][] =& $tmp[$row['id']];
            }

            if ($row['parent']['id'] == 0 or $row['parent']['id'] === null ) {
                $tree[] =& $tmp[$row['id']];
            }

        }

        // Return
        return $tree;
    }

}
