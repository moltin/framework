<?php

    return [

        '/'                                   => 'Home:index',
        '/category/:slug'                     => 'Category:index',
        '/product/:slug'                      => 'Product:index',
        '/cart/insert(/:product)(/:quantity)' => 'Cart:insert'

    ];
