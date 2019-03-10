<?php

namespace Tests;

use App\AppMessage;
use App\Cart\Cart;
use App\Cart\Product;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase {

    /**
     * @test
     */
    public function view()
    {
        $cart = new Cart();

        $expected = AppMessage::MSG_CART_IS_EMPTY;
        $this->assertEquals($expected, $cart->show());
        
        // 既定の入力値(写真の1つ目の商品)(数量確認(最小値条件内(境界値)))
        $title = 'Amazon Web Services 業務システム設計・移行ガイド';
        $price = 3456;
        $quantity = 1;
        $this->addCart($cart, $title, $price, $quantity);

        // 数量確認(一部例題を使用)
        // 数量確認(最小値条件外)
        $title = 'リーダブルコード ―より良いコードを書くためのシンプルで実践的なテクニック';
        $price = 2592;
        $quantity = 0;
        $this->addCart($cart, $title, $price, $quantity);
        // 数量確認(最大値条件外)
        $quantity = 10;
        $this->addCart($cart, $title, $price, $quantity);
        // 数量確認(最大値条件内(境界値))
        $quantity = 9;
        $this->addCart($cart, $title, $price, $quantity);

        // 価格確認
        // 価格確認(最小値条件外)
        $title = 'プリンシプル オブ プログラミング3年目までに身につけたい一生役立つ101の原理原則';
        $price = -1;
        $quantity = 1;
        $this->addCart($cart, $title, $price, $quantity);
        // 価格確認(最大値条件外)
        $price = 100000;
        $this->addCart($cart, $title, $price, $quantity);
        // 価格確認(最小値条件内(境界値))
        $price = 0;
        $this->addCart($cart, $title, $price, $quantity);
        // 価格確認(最大値条件内(境界値))
        $title = 'プリンシプル オブ プログラミング3年目までに身につけたい一生役立つ101の原理原則 第2版';
        $price = 99999;
        $this->addCart($cart, $title, $price, $quantity);

        // 商品名確認
        // 商品名確認(最小値条件外)
        $title = '';
        $price = 1;
        $quantity = 1;
        $this->addCart($cart, $title, $price, $quantity);
        // 商品名確認(最大値条件外)
        $title = 'あいうえおかきくけこさしすせそたちつてとなにぬねのはひふへほまみむめもやいゆえよabcdefghijklmnopqrstuvwxyz@#$%あいうえおかきくけこさしすせそたちつてとなにぬねのはひふへほまみむめもやいゆえよabcdefghijklmnopqrstuvwxyz@#$%あいうえおかきくけこさしすせそたちつてとなにぬねのはひふへほまみむめもやいゆえよabcdefghijklmnopqrstuvwxyz@#$%あいうえおかきくけこさしすせそたちつてとなにぬねのはひふへほまみむめもやいゆえよaiueo亜';
        $this->addCart($cart, $title, $price, $quantity);
        // 商品名確認(最小値条件内(境界値))
        $title = 'Ａ';
        $this->addCart($cart, $title, $price, $quantity);
        // 商品名確認(最大値条件内(境界値))
        $title = 'あいうえおかきくけこさしすせそたちつてとなにぬねのはひふへほまみむめもやいゆえよabcdefghijklmnopqrstuvwxyz@#$%あいうえおかきくけこさしすせそたちつてとなにぬねのはひふへほまみむめもやいゆえよabcdefghijklmnopqrstuvwxyz@#$%あいうえおかきくけこさしすせそたちつてとなにぬねのはひふへほまみむめもやいゆえよabcdefghijklmnopqrstuvwxyz@#$%あいうえおかきくけこさしすせそたちつてとなにぬねのはひふへほまみむめもやいゆえよaiueo';
        $this->addCart($cart, $title, $price, $quantity);

        // 既定の入力値(写真の2つ目の商品)
        $title = 'プログラマの数学第2版';
        $price = 2376;
        $quantity = 2;
        $this->addCart($cart, $title, $price, $quantity);

        $expected = "Amazon Web Services 業務システム設計・移行ガイド\t3456\t1" . PHP_EOL
                . "リーダブルコード ―より良いコードを書くためのシンプルで実践的なテクニック\t2592\t9" . PHP_EOL
                . "プリンシプル オブ プログラミング3年目までに身につけたい一生役立つ101の原理原則\t0\t1" . PHP_EOL
                . "プリンシプル オブ プログラミング3年目までに身につけたい一生役立つ101の原理原則 第2版\t99999\t1" . PHP_EOL
                . "Ａ\t1\t1" . PHP_EOL
                . "あいうえおかきくけこさしすせそたちつてとなにぬねのはひふへほまみむめもやいゆえよabcdefghijklmnopqrstuvwxyz@#$%あいうえおかきくけこさしすせそたちつてとなにぬねのはひふへほまみむめもやいゆえよabcdefghijklmnopqrstuvwxyz@#$%あいうえおかきくけこさしすせそたちつてとなにぬねのはひふへほまみむめもやいゆえよabcdefghijklmnopqrstuvwxyz@#$%あいうえおかきくけこさしすせそたちつてとなにぬねのはひふへほまみむめもやいゆえよaiueo\t1\t1" . PHP_EOL
                . "プログラマの数学第2版\t2376\t2" . PHP_EOL
                . "小計 (16 点): \\131537";
        $this->assertEquals($expected, $cart->show());
    }

    /**
     * カートに商品を設定する
     * @param object cart
     * @param string title
     * @param int price
     * @param int quantity
     */
    public function addCart($cart, $title, $price, $quantity)
    {
        $product = new Product($title, $price);
        $product->setQuantity($quantity);
        $cart->add($product);
    }

}
