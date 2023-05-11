<?php
    function divide_doc($path,$sizeeach=1000000){
        $divide_dir=$path."-di";
        exec("mkdir '".$divide_dir."'");
        $fstr=file_get_contents($path);
        $chunks = str_split($fstr, $sizeeach);
        $amo=count($chunks);
        $di_detail=[];
        for($a=0;$a<$amo;$a++){
            $rdn=generateRandomString(16);
            file_put_contents($divide_dir."/".$rdn,$chunks[$a]);
            $di_detail[$a]=[];
            $di_detail[$a]['name']=$rdn;
        }
        return $di_detail;
    }
    function compound_doc($path,$di_docs){
        $compound_dir=$path."-di";
        $dinum=count($di_docs);
        $cpstr="";
        for($a=0;$a<$dinum;$a++){
            $cpstr=$cpstr.$di_docs[$a];
        }
        file_put_contents($path,$cpstr);
        return 1;
    }
    
    