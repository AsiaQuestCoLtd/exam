<?php

namespace Tests;

use App\Cart;
use App\Element;
use App\Product;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @test
     */
    public function emptyCart()
    {
        $cart = new Cart();

        $expected = 'お客様のショッピングカートに商品はありません。';
        $this->assertEquals($expected, $cart->show());
    }

    /**
     * @test
     */
    public function Cart()
    {
        $cart = new Cart();

        $product = new Product('Amazon Web Services 業務システム設計・移行ガイド', 3456);
        $element = new Element($product, 1);

        $cart->add($element);

        $product = new Product('プログラマの数学第2版', 2376);
        $element = new Element($product, 2);

        $cart->add($element);

        $expected = "Amazon Web Services 業務システム設計・移行ガイド\t3456\t1".PHP_EOL
            ."プログラマの数学第2版\t2376\t2".PHP_EOL
            ."小計 (3 点): \\8208";
        $this->assertEquals($expected, $cart->show());
    }
}
