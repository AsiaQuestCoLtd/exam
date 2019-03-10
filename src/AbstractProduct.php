<?php

namespace App;

/**
 * 商品の抽象クラス
 * Class AbstractProduct
 */
abstract class AbstractProduct
{
    /** @var string 商品名 */
    private $title;
    /** @var int 商品価格 */
    private $price;

    public function __construct(string $title, int $price)
    {
        $this->title = $title;
        $this->price = $price;
    }

    /**
     * 商品名を取得する
     * @return string title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * 商品価格を取得する
     * @return int price
     */
    public function getPrice(): int
    {
        return $this->price;
    }
}
