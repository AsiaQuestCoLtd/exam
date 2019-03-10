<?php

namespace App\Cart;

use App\AppMessage;
use App\AppConst;

/**
 * カート処理に使用するクラス
 * Class Cart
 */
class Cart
{
    /** @var object 商品情報 */
    protected $products = [];

    public function __construct(array $products = [])
    {
        $this->products = $products;
    }

    /**
     * カート内に商品を追加する
     * @param Product products
     */    
    public function add(Product $product)
    {
        $this->products[] = $product;
    }

    /**
     * カート内の商品を表示する
     * @param object products
     * @return Array result
     */
    public function show()
    {
        if (empty($this->products)) {
            $result = AppMessage::MSG_CART_IS_EMPTY;
        } else {
            // カートに投入された商品が条件通りのものか確認
            $this->products = $this->checkProducts($this->products);
            // 合計金額
            $totalAmount = 0;
            // 数量(合計)
            $totalQuantity = 0;
            // 商品情報
            $result = '';
            // カート内の商品情報を取得
            $cartInfo = $this->getCartDetail($this->products);
            $result = $cartInfo['productInfo'];
            $totalAmount = $cartInfo['totalAmount'];
            $totalQuantity = $cartInfo['totalQuantity'];

            $result .= sprintf(AppMessage::MSG_CART_SUBTOTAL, $totalQuantity, $totalAmount);
        }
        return $result;
    }

    /**
     * カート内の商品情報を取得する
     * @param object products
     * @return Array result
     */
    public function getCartDetail($products)
    {
        $result = array(
            'productInfo' => '',
            'totalAmount' => 0,
            'totalQuantity' => 0,
        );

        foreach ($products as $product) {
            $quantity = $product->getQuantity();
            $result['productInfo'] .= $product->getTitle() . "\t"
                    . $product->getPrice() . "\t"
                    . $product->getQuantity() . PHP_EOL;
            $result['totalAmount'] += $product->getPrice() * $quantity;
            $result['totalQuantity'] += $quantity;
        }
        return $result;
    }

    /**
     * カートに投入する商品をチェックする
     * @param object products
     * @return object chkProducts
     */
    private function checkProducts($products)
    {
        $chkProducts;
        $judgeFlg = false;
        foreach ($products as $key => $value) {
            // 数量
            if (!($products[$key]->getQuantity() >= AppConst::PRODUCT_MIN_QUANTITY_NUM 
                  && $products[$key]->getQuantity() <= AppConst::PRODUCT_MAX_QUANTITY_NUM)) {
                $judgeFlg = true;
            }
            // 価格
            if (!($products[$key]->getPrice() >= AppConst::PRODUCT_MIN_PRICE_NUM 
                  && $products[$key]->getPrice() <= AppConst::PRODUCT_MAX_PRICE_NUM)) {
                $judgeFlg = true;
            }
            // 商品名
            if (!(mb_strlen($products[$key]->getTitle()) >= AppConst::PRODUCT_MIN_TITLE_LEN 
                  && mb_strlen($products[$key]->getTitle()) <= AppConst::PRODUCT_MAX_TITLE_LEN)) {
                $judgeFlg = true;
            }
            // 条件に沿わない商品を削除
            if ($judgeFlg) {
                unset($products[$key]);
                $judgeFlg = false;
            }
        }
        // indexの修正
        $chkProducts = array_values($products);
        return $chkProducts;
    }

}
