<?php

namespace Tests;

use App\Cart;
use App\Element;
use App\Product;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    protected $cart;

    protected function setUp()
    {
        $this->cart = new Cart();
    }

    /**
     * カート内容取得のテスト
     * 
     * @test
     */
    public function view()
    {
        $expected = 'お客様のショッピングカートに商品はありません。';
        $this->assertEquals($expected, $this->cart->getElements());
    }

    /**
     * 商品追加のテスト
     * 
     * @test
     */
    public function add()
    {
        $product = new Product('Amazon Web Services 業務システム設計・移行ガイド', 3456);
        $element = new Element($product, 1);

        $this->cart->add($element);

        $product = new Product('プログラマの数学第2版', 2376);
        $element = new Element($product, 2);

        $this->cart->add($element);

        $expected = "Amazon Web Services 業務システム設計・移行ガイド\t3456\t1" . PHP_EOL
            . "プログラマの数学第2版\t2376\t2" . PHP_EOL
            . "小計 (3 点): \\8208";
        $this->assertEquals($expected, $this->cart->getElements());
    }
}
