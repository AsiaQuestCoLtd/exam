<?php

namespace Src;

/*class Product
{
    private $title;

    private $price;

    public function __construct(string $title, int $price)
    {
        $this->title = $title;
        $this->price = $price;
    }

    public function __get($data){
        return $this->$data;
    }
}*/

//商品に関する親クラス。
class Product{
    protected $title;
    protected $price;
    public function __construct($title,$price){
        //検証用クラス読み込み
        $validate=new Validate;

        //タイトルと価額を設定する、ここで、条件をチェックする。
        if($validate->CheckStr($title,1,255)){
            $this->title=$title;
        }
        if($validate->CheckNum($price,0,9999)){
            $this->price=$price;
        }
    }
}


