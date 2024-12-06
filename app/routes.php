<?php

return [
    '/' => ['controller' => 'Home', 'action' => 'index', 'method' => ['GET', 'POST']],
    '/about' => ['controller' => 'About', 'action' => 'index', 'method' => 'GET'],
    '/contact' => ['controller' => 'Contact', 'action' => 'index', 'method' => 'GET'],
    '/product/(?P<id>\d+)' => ['controller' => 'Product', 'action' => 'show', 'method' => 'GET'],
];
