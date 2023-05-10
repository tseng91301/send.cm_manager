<?php
    $infopath="~/.sendcmtool";
    $tmppath="/tmp/sendcmtool";
    function checkdir(){
        if(!file_exists($infopath)){
            echo "E1";
            exec("mkdir ".$infopath);
        }
        if(!file_exists($tmppath)){
            echo "E2";
            exec("mkdir ".$tmppath);
        }
    }
    function jsr($path){
        $in=file_get_contents($path);
        $out=json_decode($in,true);
        return $out;
    }
    function jsr2($cont){
        $out=json_decode($cont,true);
        return $out;
    }
    function jsw($con,$path){
        $in=json_encode($con);
        file_put_contents($path,$in);
        return 0;
    }
?>