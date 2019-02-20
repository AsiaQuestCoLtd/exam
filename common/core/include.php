<?php
function readClass($class_name){
    $class_name=strtolower($class_name);
    $class=explode("\\",$class_name);
    foreach($class as $key => $val){
        if($key!=count($class)-1){
            $path.=$val."/";
        }else{
            $val=ucfirst($val);
            $path.=$val.".php";
        }
    }
    if(file_exists(DOCUMENT_ROOT."/".DIR_ROOT."/".$path)){
        require_once DOCUMENT_ROOT."/".DIR_ROOT."/".$path;
    }
}
spl_autoload_register("readClass");