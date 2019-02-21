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

        $element = new Element('Amazon Web Services 業務システム設計・移行ガイド', 3456);
        $element->setQuantity(4);
        $cart->add($element);

        $element = new Element('プログラマの数学第2版', 2376);
        $element->setQuantity(2);
        $cart->add($element);

        $expected = "Amazon Web Services 業務システム設計・移行ガイド\t3456\t4".PHP_EOL
                   ."プログラマの数学第2版\t2376\t2".PHP_EOL
                   ."小計 (6 点): \\18576";

        $this->assertEquals($expected, $cart->show());

        echo "<br>";

        //テストパタン生成

        //1.金額は1より小さいの場合
        echo "金額は0より小さいの場合,'お客様のショッピングカートに商品はありません。'を出力";
        $cart->init();
        $element = new Element("Amazon Web Services 業務システム設計・移行ガイド",-10);
        $element->setQuantity(5);
        $cart->add($element);
        $expected="お客様のショッピングカートに商品はありません。";
        $this->assertEquals($expected,$cart->show());

        //2.金額は99999より大きいの場合
        echo "金額は99999より大きいの場合,'お客様のショッピングカートに商品はありません。'を出力";
        $cart->init();
        $element = new Element("Amazon Web Services 業務システム設計・移行ガイド",9999999);
        $element->setQuantity(5);
        $cart->add($element);
        $expected="お客様のショッピングカートに商品はありません。";
        $this->assertEquals($expected,$cart->show());

        //3.数は1より小さいの場合
        echo "数は1より小さいの場合,'お客様のショッピングカートに商品はありません。'を出力";
        $cart->init();
        $element = new Element("Amazon Web Services 業務システム設計・移行ガイド",100);
        $element->setQuantity(0);
        $cart->add($element);
        $expected="お客様のショッピングカートに商品はありません。";
        $this->assertEquals($expected,$cart->show());
        
        //4.数は9より大きいの場合
        echo "数は9より大きいの場合,'お客様のショッピングカートに商品はありません。'を出力";
        $cart->init();
        $element = new Element("Amazon Web Services 業務システム設計・移行ガイド",100);
        $element->setQuantity(20);
        $cart->add($element);
        $expected="お客様のショッピングカートに商品はありません。";
        $this->assertEquals($expected,$cart->show());

        //5.文字数は1より小さいの場合
        echo "文字数は1より小さいの場合,'お客様のショッピングカートに商品はありません。'を出力";
        $cart->init();
        $element = new Element("",100);
        $element->setQuantity(8);
        $cart->add($element);
        $expected="お客様のショッピングカートに商品はありません。";
        $this->assertEquals($expected,$cart->show());

        //6.文字数は255より大きいの場合
        echo "文字数は255より大きいの場合,'お客様のショッピングカートに商品はありません。'を出力";
        $cart->init();
        $element = new Element("Amazon Web Services 業務システム設計・移行ガイドAmazon Web Services 業務システム設計・移行ガイドAmazon Web Services 業務システム設計・移行ガイドAmazon Web Services 業務システム設計・移行ガイドAmazon Web Services 業務システム設計・移行ガイドAmazon Web Services 業務システム設計・移行ガイドAmazon Web Services 業務システム設計・移行ガイドAmazon Web Services 業務システム設計・移行ガイドAmazon Web Services 業務システム設計・移行ガイドAmazon Web Services 業務システム設計・移行ガイドAmazon Web Services 業務システム設計・移行ガイド",100);
        $element->setQuantity(8);
        $cart->add($element);
        $expected="お客様のショッピングカートに商品はありません。";
        $this->assertEquals($expected,$cart->show());

        echo "正しい場合：";
        $cart->init();
        $element = new Element('Amazon Web Services 業務システム設計・移行ガイド', 1000);
        $element->setQuantity(8);
        $cart->add($element);

        $element = new Element('プログラマの数学第2版', 500);
        $element->setQuantity(5);
        $cart->add($element);

        $expected = "Amazon Web Services 業務システム設計・移行ガイド\t1000\t8".PHP_EOL
                   ."プログラマの数学第2版\t500\t5".PHP_EOL
                   ."小計 (13 点): \\10500";

        $this->assertEquals($expected, $cart->show());

    }
    
}
$test=new ExampleTest();
$test->view();
