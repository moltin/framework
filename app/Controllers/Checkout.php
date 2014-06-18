<?php

namespace Controllers;

class Checkout extends \SlimController\SlimController
{

    public function indexAction()
    {

        $identifier = $this->_identifier();

        // from order 405

        $fields = $this->app->moltin->fields('order');
        $customer = $this->app->moltin->fields('customer');
        $shipping = $this->app->moltin->get('shipping');
        $address = $this->app->moltin->fields('customer/63/address');
        $checkout = $this->app->moltin->get('cart/'.$identifier.'/checkout');
        $cart = $this->app->cart;

        unset($address['customer']);
        unset($customer['group']);

        // Cart already available globally, just build the page
        $this->render('Views/Checkout',[
            'title'     => 'Checkout',
            'fields'    => $fields,
            'address'   => $address,
            'cart'      => $cart,
            'shipping'  => $shipping['result'],
            'customer'  => $customer,
            'checkout'  => $checkout['result']
        ]);
    }

    public function processAction()
    {
        // create user

        // create shipping address

        // create billing address

        // create order
    }

    public function completeAction($product = null, $quantity = 1)
    {
        // Cart already available globally, just build the page
        $this->render('Views/Checkout', ['title' => 'Checkout']);
    }

    protected function _identifier()
    {
        if ( isset($_COOKIE['identifier']) ) { return $_COOKIE['identifier']; }

        $identifier = md5(uniqid());
        setcookie('identifier', $identifier, strtotime("+30 day"), '/');
        return $identifier;
    }

}
