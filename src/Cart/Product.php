<?php

namespace App\Cart;

use App\AbstractProduct;

/**
 * カート処理に使用する商品クラス
 * Class Product
 */
class Product extends AbstractProduct
{
    /** @var int 数量 */
    private $quantity;

    public function __construct(string $title, int $price)
    {
        parent::__construct($title, $price);
    }

    /**
     * 数量を設定する
     * @return int quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * 数量を取得する
     * @return int quantity
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

}
