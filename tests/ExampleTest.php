<?php

namespace Tests;

require("../common/core/config.php");
require("../common/core/include.php");
require("../vendor/autoload.php");

use Src\Cart;
use Src\Element;
use Src\Product;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @test
     */
    public function view()
    {
        $cart = new Cart();

        $expected = 'お客様のショッピングカートに商品はありません。';
        $this->assertEquals($expected, $cart->show());

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
    /*public function view()
    {
        $cart = new Cart();

        $expected = 'お客様のショッピングカートに商品はありません。';
        $this->assertEquals($expected, $cart->show());

        $element = new Element('Amazon Web Services 業務システム設計・移行ガイド', 3456);
        $element->setQuantity(1);
        $cart->add($element);

        $element = new Element('プログラマの数学第2版', 2376);
        $element->setQuantity(2);
        $cart->add($element);

        $expected = "Amazon Web Services 業務システム設計・移行ガイド\t3456\t1".PHP_EOL
                   ."プログラマの数学第2版\t2376\t2".PHP_EOL
                   ."小計 (3 点): \\8208";
        $this->assertEquals($expected, $cart->show());
    }*/
    
}
$test=new ExampleTest();
$test->view();
