<?php

namespace Src;

use Src\Validate;

class Cart
{
    protected $elements = [];
    //カートに対して、金額と数量はよく使われる物なので、メソッドから取り出した。
    protected $amount = 0;
    protected $totalQuantity = 0;

    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    //カート初期化
    public function init(){
        $this->elements=[];
        $this->amount = 0;
        $this->totalQuantity = 0;
    }
    
    public function add(Element $element)
    {
        //検証用クラス、商品をカートに追加する前に、商品データのチェックを行う。
        $validate=new Validate;
        if($validate->CheckProduct($element)){
            $this->elements[] = $element;
        }
    }
    
    public function show()
    {
        if (empty($this->elements)) {
            $result = 'お客様のショッピングカートに商品はありません。';
        } else {
            $result = '';
            //元々商品数が0のチャックを外した。カートに追加する際に、追加商品に対してチェックを行ったからです。
            foreach ($this->elements as $element) {
                //商品情報出す
                $title=$element->title;
                $price=$element->price;
                $quantity=$element->quantity;

                //出力結果不変が、見やすくなりました。
                $result .= $title . "\t" . $price . "\t" . $quantity . "\r\n";
                $this->amount += $element->getAmount();
                $this->totalQuantity += $quantity;
            }

            if ($this->totalQuantity) {
                $result .= '小計 ('.$this->totalQuantity.' 点): \\'.$this->amount;
            } else {
                $result = 'お客様のショッピングカートに商品はありません。';
            }
        }
        return $result;
    }

    //総金額や件数など他の画面で使うかもしれないため、マジック関数追加
    public function __get($name){
        return $this->$name;
    }
}
