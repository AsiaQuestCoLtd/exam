<?php

namespace Src;

use Src\Validate;

class Product
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
}

/*class Product extends Validate{
    protected $title;
    protected $price;
    public function init($title,$price){
        if($this->CheckStr($title,1,255)){
            $this->title=$title;
        }
        if($this->CheckNum($price,0,9999)){
            $this->price=$price;
        }
    }
}*/


