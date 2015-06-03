<?php

namespace Controllers;

class Checkout extends \SlimController\SlimController
{

    public function indexAction()
    {
        if ($_POST) {
            $order = \Cart::Order([
              'gateway' => 'dummy',
              'customer' => [
                'first_name'  => 'Jon',
                'last_name'   => 'Doe',
                'email'       => 'jon.doe@gmail.com'
              ],
              'bill_to' => [
                'first_name'  => 'Jon',
                'last_name'   => 'Doe',
                'address_1'   => '123 Sunny Street',
                'address_2'   => 'Sunnycreek',
                'city'        => 'Sunnyvale',
                'county'      => 'California',
                'country'     => 'US',
                'postcode'    => 'CA94040',
                'phone'       => '6507123124'
              ],
              'ship_to'  => 'bill_to',
              'shipping' => 'free_shipping'
            ]);
        }

        $checkout = \Cart::Checkout();
        $address  = \Address::Fields();

        // Cart already available globally, just build the page
        $this->render('Views/Checkout',[
            'title'     => 'Checkout',
            'checkout'  => $checkout['result'],
            'address'   => $address
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
