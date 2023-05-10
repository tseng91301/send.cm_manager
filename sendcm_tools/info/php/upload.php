<?php include "tools.php";
$uplhost="upload-sg.send.cm";
//echo("upload.php\n");
//system("pwd");
//echo "\n";
$ulinfo=jsr($tmppath."/ulinfo");
$filepath=$ulinfo['filepath'];
//echo($filepath);
//exec("touch '".$filepath."'.sendcmdl");
//echo($filepath."\n");
$filepath2=$filepath;
if(!file_exists($filepath)){
    echo("Error: File not found!\n");
    return;
}
if($ulinfo['t']){
    exec("zip '".$filepath.".zip' '".$filepath."/'*");
    $filepath2=$filepath2.".zip";
}
exec("echo ''>".$tmppath."/tmphead");
$codeget=exec("curl --form file=@'".$filepath2."' '".$uplhost."/cgi-bin/upload.cgi?upload_type=file&utype=anon' > ".$tmppath."/tmphead");
//echo $codeget;

$codeget2=jsr($tmppath."/tmphead")[0];
//$codeget2=exec("cat ".$tmppath."/tmp/tmphead|jq|grep \"file_code\"");
$codefin=$codeget2['file_code'];
//echo($codefin."\n");
$link1='';
if($codefin=="undef"){
    error_log("Error: The file is banned by send.cm server!\n");
    echo("Detailed information: ".file_get_contents($tmppath."/tmphead")."\n");
    error_log("Upload failed...");
    file_put_contents($filepath.".sendcmdl","error1");
    return 0;
}else{
    //echo($codefin);
    $link1=exec("curl 'https://send.cm/?op=upload_result&st=OK&fn=".$codefin."'|grep '<textarea class=\"form-control wd-400\" rows=\"3\">https://send.cm/d/'");
}
//echo($link1);
$ulfile_info;
$link1len=strlen($link1);
$link2='';
$linktmp1=0;
for($a=0;$a<$link1len;$a++){
    if($linktmp1==0){
        if($link1[$a]==">"){
            $linktmp1=1;
        }
    }else{
        $link2.=$link1[$a];
    }
}
$ulfile_info['link']=$link2;
$ulfile_info['upload_time']=time();
$ulfile_info['last_update_time']=time();
$ulfile_info['codeid']=$codefin;
$ulfile_info['t']=$ulinfo['t'];
if($ulinfo['t']){
    exec("rm '".$filepath.".zip'");
}

//echo($filepath.".sendcmdl");
echo("File link: ".$link2."\n");
jsw($ulfile_info,$filepath.".sendcmdl");
?>