<?php
namespace Src;
class Validate{
    public function CheckNum($data,$min,$max){
        if($min<=$data&&$max>=$data){
            return true;
        }else{
            return false;
        }
    }
    public function CheckStr($data,$min,$max){
        $length=mb_strlen($data, 'UTF-8');
        if($min<=$length&&$max>=$length){
            return true;
        }else{
            return false;
        }
    }

    /*public function Checkdata($title,$price,$quantity){
        if($this->CheckStr($title,1,255)&&$this->CheckNum($price,0,99999)&&$this->CheckNum($quantity,1,9)){
            return true;
        }else{
            return false;
        }
    }*/
}