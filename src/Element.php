<?php

namespace Src;

use Src\Product;

class Element
{
    private $product;

    private $quantity;

    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function __get($data){
        return $this->$data;
    }
}
/*class Element extends Product{
    
    private $quantity;

    public function __construct($title,$price){
        parent::init($title,$price);
    }

    public function setQuantity($quantity){
        if($this->CheckNum($quantity,1,9)){
            $this->quantity=$quantity;
        }
    }

    public function __get($data){
        return $this->$data;
    }
    public function getAmount(){
        return $this->quantity*$this->price;
    }
}*/
