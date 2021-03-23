<?php
namespace App;

require_once('CheckValue.php');

class Cart
{
    protected $elements = [];

    const NO_ITEMS_IN_SHOPPING_CART = 'お客様のショッピングカートに商品はありません。';

    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    public function add(Element $element)
    {
        $this->elements[] = $element;
    }

    /**
     * showメソッド
     * 
     * カートの中身を返す
     * 
     * @return string カート中身
     */
    public function show(): string
    {
        return empty($this->elements) ? self::NO_ITEMS_IN_SHOPPING_CART :
                                        $this->getCartContent($this->elements);
    }

    /**
     * getCartContentメソッド
     * 
     * カート内の商品情報を加工する
     * 
     * @param array $elements 商品情報を保存する配列
     * 
     * @return string カート内の商品情報
     */
    protected function getCartContent($elements): string
    {
        /**
         * 変数の初期化
         * 
         * @var int    $amount         商品価格合計
         * @var int    $totalQuantity  商品点数合計
         * @var string $result         カート内の商品情報
         */
        $amount = 0;
        $totalQuantity = 0;
        $result = '';

        // 商品ごとに情報を加工する
        foreach ($elements as $element) {
            // 商品点数
            $quantity = $element->getQuantity();
            // 商品単価
            $price    = $element->getProduct()->getPrice();
            // 商品名
            $title    = $element->getProduct()->getTitle();

            // 商品点数が0
            // もしくは
            // 商品点数、商品単価、商品名　いずれの値が設けた条件外の場合　スルー
            if ($this->checkProductValue($quantity, $price, $title)) continue;

            // 商品情報を結合
            $result .= $title . "\t" . $price . "\t" . $quantity . "\r\n"; 
            // 商品価格を加算
            $amount += $price * $quantity;
            // 商品点数を加算
            $totalQuantity += $quantity;
        }

        // 商品点数の合計＞０の場合、商品価格合計と商品点数合計を商品情報に追加
        if ($totalQuantity) {
            $result .= '小計 ('.$totalQuantity.' 点): \\'.$amount;
        // それ以外の場合、カート内に商品がない旨のメッセージをセット
        } else {
            $result = self::NO_ITEMS_IN_SHOPPING_CART;
        }

        return $result;
    }

    /**
     * checkProductValueメソッド
     * 
     * 商品点数、商品単価、商品名の値をチェックする
     * 
     * @param int    $quantity 商品点数 
     * @param int    $price    商品単価
     * @param string $title    商品名
     * 
     * @return bool
     */
    protected function checkProductValue($quantity, $price, $title): bool
    {
        return !$quantity                            ||
               !CheckValue::checkQuantity($quantity) || 
               !CheckValue::checkPrice($price)       || 
               !CheckValue::checkTitle($title);
    }
}