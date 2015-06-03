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
        $modifier   = ( isset($_POST['modifier']) ? $_POST['modifier'] : array() );

        try {
            // Add to cart
            $result = \Cart::Insert($product,$quantity,$modifier);
        } catch(\Exception $e) {
            $this->app->flash('error', $e->getMessage());
            $this->app->redirect($_SERVER['HTTP_REFERER']);
        }

        // Flash and redirect
        if ( $result['status'] == 1 ) { $this->app->flash('success', 'Item added to cart'); }
        else { $this->app->flash('error', 'Error adding item to cart'); }
        $this->app->redirect('/cart');
    }

    public function updateAction($product, $quantity)
    {
        if ($quantity == 0) {
            $result = \Cart::Remove($product);
        } else {
            try {
                $result = \Cart::Update($product, ['quantity' => $quantity]);
            } catch(\Exception $e) {
                exit($e->getMessage());
            }
        }

        // Flash and redirect
        if ( $result['status'] == 1 ) { $this->app->flash('success', 'Item updated successfully'); }
        else { $this->app->flash('error', 'Error updating item'); }
        $this->app->redirect('/cart');

    }

    public function deleteAction($item)
    {
        try {
            // Remove the item
            $result = \Cart::Remove($item);
        } catch(\Exception $e) {
            exit($e->getMessage());
        }

        // Flash and redirect
        if ( $result['status'] == 1 ) { $this->app->flash('success', 'Item removed from cart'); }
        else { $this->app->flash('error', 'Error removing item from cart'); }
        $this->app->redirect($_SERVER['HTTP_REFERER']);
    }

}
