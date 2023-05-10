<?php include "tools.php";
//echo("upload.php\n");
//system("pwd");
//echo "\n";
$filepath=file_get_contents($tmppath."/ulinfo");
$filepath=str_replace("\n","",$filepath);
//exec("touch '".$filepath."'.sendcmdl");
//echo($filepath."\n");
if(!file_exists($filepath)){
    echo("Error: File not found!\n");
    return;
}
exec("echo ''>".$tmppath."/tmphead");
$codeget=exec("curl --form file=@'".$filepath."' 'upload-sg.send.cm/cgi-bin/upload.cgi?upload_type=file&utype=anon' > ".$tmppath."/tmphead");
//echo $codeget;
$codeget2=jsr($tmppath."/tmphead")[0];
//$codeget2=exec("cat ".$tmppath."/tmp/tmphead|jq|grep \"file_code\"");
$codefin=$codeget2['file_code'];
//echo($codefin."\n");
$link1='';
if($codefin=="undef"){
    error_log("Error: The file is banned by send.cm server!\n");
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
//echo($filepath.".sendcmdl");
echo("File link: ".$link2."\n");
jsw($ulfile_info,$filepath.".sendcmdl");
?>