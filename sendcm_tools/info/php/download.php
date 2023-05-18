<?php include "tools.php";
$filename=file_get_contents($tmppath."/dlinfo");
$filename=str_replace("\n","",$filename);
if(!file_exists($filename.".sendcmdl")){
    echo("Error: File property not found!\n");
    return;
}
$fileinfo=jsr($filename.".sendcmdl");
exec("mkdir '$filename-di'");
//echo('curl -L https://send.cm/ -d "op=download2&id='.$fileinfo['codeid'].'" > "'.$filename.'.zip"');
echo("Downloading files...\n");
$filenum=count($fileinfo['di_doc_inf']);
$fstr="";
for($a=0;$a<$filenum;$a++){
    echo("\n\n\nDownloading files".strval($a+1)."/$filenum...\n");
    $redurl=exec('curl -i https://send.cm/ -d "op=download2&id='.$fileinfo['di_doc_inf'][$a]['codeid'].'" |grep "location"');
    $redurl=explode(" ",$redurl)[1];
    //echo('curl -i https://send.cm/ -d "op=download2&id='.$fileinfo['di_doc_inf'][$a]['codeid'].'" |grep "location" |awk "{print $2}"');
    //echo($redurl);
    //echo('curl -L '.$redurl.'> "'.$filename.'-di/'.$fileinfo['di_doc_inf'][$a]['name'].'"');
    exec('curl -L '.$redurl.' --http1.1 --referer https://send.cm/ > "'.$filename.'-di/'.$fileinfo['di_doc_inf'][$a]['name'].'"');
    //echo('curl -L https://send.cm/ -d "op=download2&id='.$fileinfo['di_doc_inf'][$a]['codeid'].'" > "'.$filename.'-di/'.$fileinfo['di_doc_inf'][$a]['name'].'"');
    $fstr=$fstr.aes_decrypt(file_get_contents($filename.'-di/'.$fileinfo['di_doc_inf'][$a]['name']),$fileinfo['key']);
}
file_put_contents($filename.".zip",$fstr);
exec("rm -rf '$filename-di'");
if($fileinfo['t']){
    echo("Restoring a folder.\n");
    echo("unzipping zip file into folder...\n");
    exec("unzip '".$filename."' && rm '".$filename.".zip'");
}else{
    exec("mv '$filename.zip' '$filename'");
}
?>