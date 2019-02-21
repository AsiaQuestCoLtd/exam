<?php

namespace Src;

use Src\Product;

//親クラス：Productの形に設定しました。
//この書き方は元より良いなのか、悪いなのか、よく判断できない。
//extendsを使用する原因は：ElementはProductの変数を全部使うことが可能ので、extendsを使った方が良いと思います。
//まだ、パラメータの呼び出し、商品に関する設定も簡単にできると思います。
class Element extends Product{
    
    private $quantity;

    //数を設定用のメソッド、ここで条件チェックを行う。
    public function setQuantity($quantity){
        $validate=new Validate;
        if($validate->CheckNum($quantity,1,9)){
            $this->quantity=$quantity;
        }
    }

    //マジックメソッドでパラメータ返す
    public function __get($data){
        return $this->$data;
    }

    //金額用のメソッド追加
    public function getAmount(){
        return $this->quantity*$this->price;
    }
}
