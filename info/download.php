<?php
function getcon($inppath){
    $bak=shell_exec("ls ".$inppath);
    $len=strlen($bak);
    $amo=0;
    $tm2=0;
    $files[$amo];
    for($a=0;$a<$len;$a++){
        if($bak[$a]=="\n"){
            $amo++;
            $a++;
            $tm2=0;
        }
        $files[$amo]="".$files[$amo].$bak[$a];
        $tm2++;
    }
    return($files);
}
$sendcmtmppath="~/.sendcmtools";
$filename=exec("cat ".$sendcmtmppath."/tmp/downloadingfile");
$a1=getcon($sendcmtmppath."/file");
$a1len=sizeof($a1);
$b2=0;
$b3=0;
for($a=0;$a<$a1len;$a++){
    $b1=exec("cat ".$sendcmtmppath."/file/".$a1[$a]."/name");
    if($b1==$filename){
        $b2=1;
        $b3=$a;
        break;
    }
}
if($b2==0){
    echo("Failed to download file, file not exsists.");
    return;
}else{
    $downid=exec("cat ".$sendcmtmppath."/file/".$b3."/codeid");
    $downpath=exec("cat ".$sendcmtmppath."/tmp/downloadedfilepath");
    if($downpath==''){
        $downpath="/tmp";
    }
    exec('curl -L https://send.cm/ -d "op=download2&id='.$downid.'" >> "'.$downpath.'"');
}
