<?php

declare(strict_types=1);

namespace App\controllers;

use App\dataProviders\ArrayProductsDataProvider;
use App\exceptions\InvalidValueException;
use App\observer\Cart;
use App\observer\Logger;

class CartController extends BaseController
{
    private Cart $cart;
    private Logger $logger;

    public function __construct()
    {
        parent::__construct();
        session_start();

        $data = new ArrayProductsDataProvider();
        $this->logger = new Logger();

        if (isset($_SESSION['cart'])) {
            $this->cart = $_SESSION['cart'];
        } else {
            $this->cart = new Cart($data);
            $this->cart->attach($this->logger);
        }
    }

    public function index(): void
    {
        if (isset($_POST['addItem']) && isset($_POST['productId'])) {
            try {
                $productId = (int)$_POST['productId'];
                $this->cart->addItem($productId);
            } catch (InvalidValueException $e) {
                echo $e->getMessage();
            }
        }

        if (isset($_POST['removeCart']) && isset($_POST['productId'])) {
            try {
                $productId = (int)$_POST['productId'];
                $this->cart->removeItem($productId);
            } catch (InvalidValueException $e) {
                echo $e->getMessage();
            }
        }

        $_SESSION['cart'] = $this->cart;

        $items = $this->cart->getItems();
        $this->view('cart', ['items' => $items]);
    }
}
