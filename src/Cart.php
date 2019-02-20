<?php

namespace Src;

class Cart
{
    protected $elements = [];

    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    public function add(Element $element)
    {
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
                if (! $element->quantity){
                    continue;
                } else {
                    $result .= $element->product->title . "\t" . $element->product->price . "\t" . $element->quantity . "\n";
                    $amount += $element->product->price * $element->quantity;
                    $totalQuantity += $element->quantity;
                }
            }

            if ($totalQuantity) {
                $result .= '小計 ('.$totalQuantity.' 点): \\'.$amount;
            } else {
                $result = 'お客様のショッピングカートに商品はありません。';
            }
        }
        echo "<pre>";
        print_r($result);
        echo "</pre>";
        return $result;
    }
    /*public function show()
    {
        if (empty($this->elements)) {
            $result = 'お客様のショッピングカートに商品はありません。';
        } else {
            $amount = 0;
            $totalQuantity = 0;

            $result = '';
            foreach ($this->elements as $element) {
                if (! $element->quantity) {
                    continue;
                } else {
                    $title=$element->title;
                    $price=$element->price;
                    $quantity=$element->quantity;

                    $result .= $title . "\t" . $price . "\t" . $quantity . "\n";
                    $amount += $element->getAmount();
                    $totalQuantity += $quantity;
                }
            }

            if ($totalQuantity) {
                $result .= '小計 ('.$totalQuantity.' 点): \\'.$amount;
            } else {
                $result = 'お客様のショッピングカートに商品はありません。';
            }
        }
echo "<pre>";
print_r($result);
echo "</pre>";
        return $result;
    }*/

}
