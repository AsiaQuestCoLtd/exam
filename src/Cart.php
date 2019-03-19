<?php

namespace App;

class Cart
{
    /**
     * @var array
     */
    protected $elements = [];

    /**
     * 商品タイトル長さ条件　最小値/最大値
     */
    const PRODUCT_TITLE_LEN_MIN = 1;
    const PRODUCT_TITLE_LEN_MAX = 255;

    /**
     * 商品値段条件　最小値/最大値
     */
    const PRODUCT_PRICE_MIN = 0;
    const PRODUCT_PRICE_MAX = 99999;

    /**
     * 商品数量条件　最小値/最大値
     */
    const PRODUCT_QUANTITY_MIN = 1;
    const PRODUCT_QUANTITY_MAX = 9;

    /**
     * Cart constructor.
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    /**
     * @param Element $element
     * @return bool
     */
    public function add(Element $element)
    {
        if (!$this->checkProductConditions($element)) {
            return false;
        }

        $this->elements[] = $element;
    }

    /**
     * @return string
     */
    public function show(): string
    {
        if (empty($this->elements)) {
            return 'お客様のショッピングカートに商品はありません。';
        }

        $amount = 0;
        $totalQuantity = 0;

        $result = '';
        list($result, $amount, $totalQuantity) = $this->line($result, $amount, $totalQuantity);

        if ($totalQuantity) {
            $result .= '小計 (' . $totalQuantity . ' 点): \\' . $amount;
            return $result;
        }
        return 'お客様のショッピングカートに商品はありません。';
    }

    /**
     * @param string $result
     * @param $amount
     * @param $totalQuantity
     * @return array
     */
    public function line(string $result, $amount, $totalQuantity): array
    {
        foreach ($this->elements as $element) {
            $product_title = $element->getProduct()->getTitle();
            $product_price = $element->getProduct()->getPrice();
            $product_quantity = $element->getQuantity();

            $result .= $product_title . "\t" . $product_price . "\t" . $product_quantity . "\r\n";
            $amount += $product_price * $product_quantity;
            $totalQuantity += $product_quantity;
        }
        return array($result, $amount, $totalQuantity);
    }

    /**
     * 商品条件チェック
     * @param Element $element
     * @return bool
     */
    public function checkProductConditions(Element $element): bool
    {
        //商品タイトル長さ
        $product_title_len = mb_strlen($element->getProduct()->getTitle(), "UTF-8");

        if ($product_title_len < self::PRODUCT_TITLE_LEN_MIN
            || $product_title_len > self::PRODUCT_TITLE_LEN_MAX) {
            return false;
        }

        //商品値段
        $product_price = $element->getProduct()->getPrice();

        if ($product_price < self::PRODUCT_PRICE_MIN
            || $product_price > self::PRODUCT_PRICE_MAX) {
            return false;
        }

        //商品数
        $product_quantity = $element->getQuantity();

        if ($product_quantity < self::PRODUCT_QUANTITY_MIN
            || $product_quantity > self::PRODUCT_QUANTITY_MAX) {
            return false;
        }

        return true;
    }
}
