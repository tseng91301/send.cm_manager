<?php include "tools.php";
$filename=file_get_contents($tmppath."/dlinfo");
$filename=str_replace("\n","",$filename);
if(!file_exists($filename.".sendcmdl")){
    echo("Error: File not found!");
    return;
}
$fileinfo=jsr($filename.".sendcmdl");
exec('curl -L https://send.cm/ -d "op=download2&id='.$fileinfo['codeid'].'" >> "'.$filename.'"');
?>