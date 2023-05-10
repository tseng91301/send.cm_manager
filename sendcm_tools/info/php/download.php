<?php include "tools.php";
$filename=file_get_contents($tmppath."/dlinfo");
$filename=str_replace("\n","",$filename);
if(!file_exists($filename.".sendcmdl")){
    echo("Error: File property not found!");
    return;
}
$fileinfo=jsr($filename.".sendcmdl");
//echo('curl -L https://send.cm/ -d "op=download2&id='.$fileinfo['codeid'].'" > "'.$filename.'.zip"');
echo("Downloading...");
exec('curl -L https://send.cm/ -d "op=download2&id='.$fileinfo['codeid'].'" > "'.$filename.'.zip"');
if($fileinfo['t']){
    echo("Restoring a folder.\n");
    echo("unzipping zip file into folder...\n");
    exec("unzip '".$filename."' && rm '".$filename.".zip'");
}
?>