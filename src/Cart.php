<?php

namespace App;

class Cart
{
    /**
     * @var array 商品カート
     */
    protected $elements = [];

    /**
     * コンストラクタ
     *
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    /**
     * 商品の追加
     * 
     * @param Element $element
     */
    public function add(Element $element)
    {
        $this->elements[] = $element;
    }

    /**
     * カート内容の取得
     * 
     * @return string
     */
    public function getElements()
    {
        if (empty($this->elements)) {
            $result = 'お客様のショッピングカートに商品はありません。';
        } else {
            $result = $this->formatElement();
        }

        return $result;
    }

    /**
     * カート内容の整形
     * 
     * @return string 商品名・価格・小計
     */
    public function formatElement()
    {
        $amount = 0;
        $totalQuantity = 0;
        $result = '';

        foreach ($this->elements as $element) {
            if (!$element->getQuantity()) {
                continue;
            } else {
                $result .= $element->getProduct()->getTitle() . "\t" . $element->getProduct()->getPrice() . "\t" . $element->getQuantity() . "\r\n";
                $amount += $element->getProduct()->getPrice() * $element->getQuantity();
                $totalQuantity += $element->getQuantity();
            }
        }

        if ($totalQuantity) {
            $result .= '小計 (' . $totalQuantity . ' 点): \\' . $amount;
        } else {
            $result = 'お客様のショッピングカートに商品はありません。';
        }

        return $result;
    }
}
