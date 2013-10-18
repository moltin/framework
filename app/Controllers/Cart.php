<?php

namespace Controllers;

class Cart extends \SlimController\SlimController
{

    public function indexAction()
    {
        // Cart already available globally, just build the page
        $this->render('Views/Cart', ['title' => 'Cart']);
    }

    public function insertAction($product = null, $quantity = 1)
    {
        // Variables
        $product    = ( $product === null && isset($_POST['product']) ? ( 0 + $_POST['product'] ) : ( 0 + $product ) );
        $quantity   = ( $quantity === null && isset($_POST['quantity']) ? ( 0 + $_POST['quantity'] ) : ( 0 + $quantity ) );
        $identifier = $this->_identifier();

        try {

            // Get the product
            $result = $this->app->moltin->get('product', ['id' => $product, 'status' => 1]);

            // Add to cart
            $result = $this->app->moltin->post('cart/'.$identifier, [
                'id'       => $result['result']['id'],
                'quantity' => $quantity,
                'name'     => $result['result']['title'],
                'price'    => $result['result']['price']
            ]);

        } catch(\Exception $e) {
            exit($e->getMessage());
        }

        // Flash and redirect
        if ( $result['status'] == 1 ) { $this->app->flash('success', 'Item added to cart'); }
        else { $this->app->flash('error', 'Error adding item to cart'); }
        $this->app->redirect('/cart');
    }

    public function updateAction($product, $quantity)
    {
        // Variables
        $identifier = $this->_identifier();

        try {

            $result = $this->app->moltin->put('cart/'.$identifier.'/item/'.$product, ['quantity' => $quantity]);

        } catch(\Exception $e) {
            exit($e->getMessage());
        }

        // Flash and redirect
        if ( $result['status'] == 1 ) { $this->app->flash('success', 'Item updated successfully'); }
        else { $this->app->flash('error', 'Error updating item'); }
        $this->app->redirect('/cart');

    }

    public function deleteAction($item)
    {
        // Variables
        $identifier = $this->_identifier();

        try {

            // Remove the item
            $result = $this->app->moltin->delete('cart/'.$identifier.'/item/'.$item);

        } catch(\Exception $e) {
            exit($e->getMessage());
        }

        // Flash and redirect
        if ( $result['status'] == 1 ) { $this->app->flash('success', 'Item removed from cart'); }
        else { $this->app->flash('error', 'Error removing item from cart'); }
        $this->app->redirect($_SERVER['HTTP_REFERER']);
    }

    protected function _identifier()
    {
        if ( isset($_COOKIE['identifier']) ) { return $_COOKIE['identifier']; }

        $identifier = md5(uniqid());
        setcookie('identifier', $identifier, strtotime("+30 day"), '/');
        return $identifier;
    }

}
