<?php
namespace Src;
class Validate{
    public function CheckNum($data,$min,$max){
        if($data==""){
            return false;
        }
        if($min<=$data&&$max>=$data){
            return true;
        }else{
            return false;
        }
    }
    public function CheckStr($data,$min,$max){
        if($data==""){
            return false;
        }
        $length=mb_strlen($data, 'UTF-8');
        if($min<=$length&&$max>=$length){
            return true;
        }else{
            return false;
        }
    }

    public function CheckProduct($product){
        if($this->CheckNum($product->quantity,1,9)&&$this->CheckNum($product->price,0,99999)&&$this->CheckStr($product->title,1,255)){
            return true;
        }else{
            return false;
        }
    }
}