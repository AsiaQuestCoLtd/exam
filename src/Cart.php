<?php

namespace Src;

use Src\Validate;

class Cart
{
    protected $elements = [];

    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    public function add(Element $element)
    {
        //検証用クラス、商品をカートに追加する前に、商品データのチェック行う。
        $validate=new Validate;
        if($validate->CheckProduct($element)){
            $this->elements[] = $element;    
        }
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
    }*/
    public function show()
    {
        if (empty($this->elements)) {
            $result = 'お客様のショッピングカートに商品はありません。';
        } else {
            $amount = 0;
            $totalQuantity = 0;

            $result = '';
            //元々商品数が空のチャックを外した。カートに追加する際に、追加商品に対してチェックしたからです。
            foreach ($this->elements as $element) {
                //商品情報出す
                $title=$element->title;
                $price=$element->price;
                $quantity=$element->quantity;

                //出力結果不変が、見やすくなりました。
                $result .= $title . "\t" . $price . "\t" . $quantity . "\n";
                $amount += $element->getAmount();
                $totalQuantity += $quantity;
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

    //カート初期化
    public function init(){
        $this->elements=[];
    }

}
