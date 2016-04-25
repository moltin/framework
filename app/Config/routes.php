<?php

    return [

        '/'                                   => 'Home:index',

        '/category/:slug'                     => 'Category:index',

        '/collection/:slug'                   => 'Collection:index',

        '/product/:slug'                      => 'Product:index',

        '/cart'                               => 'Cart:index',
        '/cart/insert(/:product)(/:quantity)' => 'Cart:insert',
        '/cart/update(/:product)(/:quantity)' => 'Cart:update',
        '/cart/delete/:item'                  => 'Cart:delete',

        '/checkout'			                  => 'Checkout:index',
        '/checkout/complete'			      => 'Checkout:complete',

        '/:page'                              => 'Home:page',

    ];
