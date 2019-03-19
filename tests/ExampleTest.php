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
    public function TestEmptyCart()
    {
        $cart = new Cart();

        $expected = 'お客様のショッピングカートに商品はありません。';
        $this->assertEquals($expected, $cart->show());
    }

    /**
     * @test 商品値段テスト　最小値/最大値
     */
    public function TestProductPrice()
    {
        //値段　＜　最小値段
        $arrProduct[] = array(
            "title"=>"Amazon Web Services 業務システム設計・移行ガイド",
            "price"=>-10,
            "quantity"=>5
        );

        $result   = $this->CreateCartShow($arrProduct);
        $expected = "お客様のショッピングカートに商品はありません。";
        $this->assertEquals($expected, $result);

        //値段　＞　最大値段
        $arrProduct[] = array(
            "title"=>"Amazon Web Services 業務システム設計・移行ガイド",
            "price"=>999999,
            "quantity"=>5
        );

        $result   = $this->CreateCartShow($arrProduct);
        $expected = "お客様のショッピングカートに商品はありません。";
        $this->assertEquals($expected, $result);
    }

    /**
     * @test 商品タイトルテスト　最小値/最大値
     */
    public function TestProductTitle()
    {
        //商品名 ＜　最小文字数
        $arrProduct[] = array(
            "title"=>"",
            "price"=>100,
            "quantity"=>5
        );

        $result   = $this->CreateCartShow($arrProduct);
        $expected = "お客様のショッピングカートに商品はありません。";
        $this->assertEquals($expected, $result);

        //商品名　＞　最大文字数
        $arrProduct[] = array(
            "title"=>"Amazon Web Services 業務システム設計・移行ガイドAmazon Web Services 業務システム設計・移行ガイドAmazon Web Services 業務システム設計・移行ガイドAmazon Web Services 業務システム設計・移行ガイドAmazon Web Services 業務システム設計・移行ガイドAmazon Web Services 業務システム設計・移行ガイドAmazon Web Services 業務システム設計・移行ガイドAmazon Web Services 業務システム設計・移行ガイドAmazon Web Services 業務システム設計・移行ガイドAmazon Web Services 業務システム設計・移行ガイドAmazon Web Services 業務システム設計・移行ガイド",
            "price"=>100,
            "quantity"=>5
        );

        $result   = $this->CreateCartShow($arrProduct);
        $expected = "お客様のショッピングカートに商品はありません。";
        $this->assertEquals($expected, $result);
    }

    /**
     * @test 商品数テスト　最小値/最大値
     */
    public function TestProductQuantity()
    {
        //商品数　＜　最小商品数
        $arrProduct[] = array(
            "title"=>"Amazon Web Services 業務システム設計・移行ガイド",
            "price"=>100,
            "quantity"=>0
        );

        $result   = $this->CreateCartShow($arrProduct);
        $expected = "お客様のショッピングカートに商品はありません。";
        $this->assertEquals($expected, $result);

        //商品数　＞　最大商品数
        $arrProduct[] = array(
            "title"=>"Amazon Web Services 業務システム設計・移行ガイド",
            "price"=>100,
            "quantity"=>20
        );

        $result   = $this->CreateCartShow($arrProduct);
        $expected = "お客様のショッピングカートに商品はありません。";
        $this->assertEquals($expected, $result);
    }

    /**
     * @test 正しい条件を登録するテスト
     */
    public function TestCorrectCart()
    {
        $arrProduct[] = array(
            "title"=>"Amazon Web Services 業務システム設計・移行ガイド",
            "price"=>3456,
            "quantity"=>1
        );

        $arrProduct[] = array(
            "title"=>"プログラマの数学第2版",
            "price"=>2376,
            "quantity"=>2
        );

        $result   = $this->CreateCartShow($arrProduct);
        $expected = "Amazon Web Services 業務システム設計・移行ガイド\t3456\t1".PHP_EOL
            ."プログラマの数学第2版\t2376\t2".PHP_EOL
            ."小計 (3 点): \\8208";
        $this->assertEquals($expected, $result);
    }

    /**
     * カート情報出力用メソット
     * @param array $arrProduct  自動初期化
     * @return string
     */
    public function CreateCartShow(array & $arrProduct): string
    {
        $cart = new Cart();

        foreach ($arrProduct as $num => $productData) {
            $product = new Product($productData["title"], $productData["price"]);
            $element = new Element($product, $productData["quantity"]);

            $cart->add($element);
        }

        $arrProduct = array();

        return $cart->show();
    }
}
