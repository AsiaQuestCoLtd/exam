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
    public function view()
    {
        /**
         * テストケース1
         * 
         * カートに何も入っていない場合
         */
        $cart_1 = new Cart();

        $expected_1 = 'お客様のショッピングカートに商品はありません。';
        $this->assertEquals($expected_1, $cart_1->show());

        /**
         * テストケース2
         * 
         * 通常商品が入っている場合
         */
        $cart_2 = new Cart();
        
        $product_2 = new Product('Amazon Web Services 業務システム設計・移行ガイド', 3456);
        $element_2 = new Element($product_2, 1);

        $cart_2->add($element_2);

        $product_2 = new Product('プログラマの数学第2版', 2376);
        $element_2 = new Element($product_2, 2);

        $cart_2->add($element_2);

        $expected_2 = "Amazon Web Services 業務システム設計・移行ガイド\t3456\t1\r\n"
                   ."プログラマの数学第2版\t2376\t2\r\n"
                   ."小計 (3 点): \\8208";
        $this->assertEquals($expected_2, $cart_2->show());

        /**
         * テストケース3
         * 
         * 商品点数が設けた条件外の場合
         */
        $cart_3 = new Cart();
        
        $product_3 = new Product('Amazon Web Services 業務システム設計・移行ガイド', 3456);
        $element_3 = new Element($product_3, 0);

        $cart_3->add($element_3);

        $product_3 = new Product('プログラマの数学第2版', 2376);
        $element_3 = new Element($product_3, 10);

        $cart_3->add($element_3);

        $expected_3 = 'お客様のショッピングカートに商品はありません。';
        $this->assertEquals($expected_3, $cart_3->show());

        /**
         * テストケース4
         * 
         * 商品単価が設けた条件外の場合
         */
        $cart_4 = new Cart();
        
        $product_4 = new Product('Amazon Web Services 業務システム設計・移行ガイド', 100001);
        $element_4 = new Element($product_4, 1);

        $cart_4->add($element_4);

        $product_4 = new Product('プログラマの数学第2版', 2376);
        $element_4 = new Element($product_4, 2);

        $cart_4->add($element_4);

        $expected_4 = "プログラマの数学第2版\t2376\t2\r\n"
                    ."小計 (2 点): \\4752";
        $this->assertEquals($expected_4, $cart_4->show());

        /**
         * テストケース5
         * 
         * 商品名が設けた条件外の場合
         */
        $cart_5 = new Cart();
        
        $title = <<<EOF
                Amazon Web Services 業務システム設計・移行ガイド あああああああああああああああ
                ああああああああああああああああああああああああああああああああああああああああああ
                ああああああああああああああああああああああああああああああああああああああああああ
                ああああああああああああああああああああああああああああああああああああああああああ
                ああああああああああああああああああああああああああああああああああああああああああ
                ああああああああああああああああああああああああああああああああああああああああああ
EOF;
        $product_5 = new Product($title, 3456);
        $element_5 = new Element($product_5, 1);

        $cart_5->add($element_5);

        $product_5 = new Product('', 2376);
        $element_5 = new Element($product_5, 2);

        $cart_5->add($element_5);

        $expected_5 = 'お客様のショッピングカートに商品はありません。';
        $this->assertEquals($expected_5, $cart_5->show());

        /**
         * テストケース6
         * 
         * 商品点数合計が０の場合
         */
        $cart_6 = new Cart();
        
        $product_6 = new Product('Amazon Web Services 業務システム設計・移行ガイド', 3456);
        $element_6 = new Element($product_6, 0);

        $cart_6->add($element_6);

        $product_6 = new Product('プログラマの数学第2版', 2376);
        $element_6 = new Element($product_6, 0);

        $cart_6->add($element_6);

        $expected_6 = 'お客様のショッピングカートに商品はありません。';
        $this->assertEquals($expected_6, $cart_6->show());
    }
}
