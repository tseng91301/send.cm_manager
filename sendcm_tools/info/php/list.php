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
$a1=getcon($sendcmtmppath."/file");
$a1len=sizeof($a1);
$a1len--;
echo("\n\nList of uploaded files :\n");
for($a=0;$a<$a1len;$a++){
    echo(strval($a+1).": ");
    $fname=exec("cat ".$sendcmtmppath."/file/".$a1[$a]."/name");
    echo("'".$fname."' ");
    $flink=exec("cat ".$sendcmtmppath."/file/".$a1[$a]."/link");
    echo("Share Link: '".$flink."'\n");
}
?>
