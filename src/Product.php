<?php

namespace App;

class Product
{
    /**
     * @var string 商品名
     */
    private $title;

    /**
     * @var int 商品価格
     */
    private $price;

    /**
     * コンストラクタ
     *
     * @param string $title
     * @param string $price
     */
    public function __construct(string $title, int $price)
    {
        $this->title = $title;
        $this->price = $price;
    }

    /**
     * 商品名取得
     * 
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * 商品価格取得
     * 
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }
}
