<?php
    $tmppath="/tmp/sendcmtool";
    //echo ($tmppath."\n");
    function checkdir($path){
        if(!file_exists($path)){
            echo "E2\n";
            exec("mkdir ".$path."\n");
        }
    }
    checkdir($tmppath);
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