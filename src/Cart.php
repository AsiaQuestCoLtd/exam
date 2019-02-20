<?php

namespace App;

class Cart
{
    protected $elements = [];

    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    public function add(Element $element)
    {
        // add comment
        $this->elements[] = $element;
    }

    public function show()
    {
        if (empty($this->elements)) {
            $result = 'お客様のショッピングカートに商品はありません。';
        } else {
            $amount = 0;
            $totalQuantity = 0;

            $result = '';
            foreach ($this->elements as $element) {
                if (! $element->getQuantity()) {
                    continue;
                } else {
                    $result .= $element->getProduct()->getTitle() . "\t" . $element->getProduct()->getPrice() . "\t" . $element->getQuantity() . "\r\n";
                    $amount += $element->getProduct()->getPrice() * $element->getQuantity();
                    $totalQuantity += $element->getQuantity();
                }
            }

            if ($totalQuantity) {
                $result .= '小計 ('.$totalQuantity.' 点): \\'.$amount;
            } else {
                $result = 'お客様のショッピングカートに商品はありません。';
            }
        }

        return $result;
    }
}
