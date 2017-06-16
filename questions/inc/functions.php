<?php


function redirect($url){
    header('location:index.php'.$url);
}


function subfix($file)
{
    $data = explode('.', $file);
    return strtolower(end($data));
}

function removeArr($arr,$tmp)
{
    $arr= array_merge(array_diff($arr, array($tmp)));
    return $arr;
}
