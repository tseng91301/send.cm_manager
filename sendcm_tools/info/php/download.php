<?php include "tools.php";
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
$filename=file_get_contents($tmppath."/dlinfo");
if(!file_exists($filename.".sendcmdl")){
    echo("Error: File not found!");
    return;
}
$fileinfo=jsr($filename);
exec('curl -L https://send.cm/ -d "op=download2&id='.$fileinfo['id'].'" >> "'.$filename.'"');
?>