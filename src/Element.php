<?php

namespace App;

class Element
{
    /**
     * @var Product 商品
     */
    private $product;

    /**
     * @var int 個数
     */
    private $quantity;

    /**
     * コンストラクタ
     *
     * @param Procuct $product
     * @param int $quantity
     */
    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    /**
     * 商品取得
     *
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * 商品数取得
     *
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
