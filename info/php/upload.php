<?php include "tools.php";
$filepath=file_get_contents($tmppath."/ulinfo");
//echo($filepath);
if(!file_exists($filepath)){
    echo("Error: File not found!");
    return;
}
exec("echo ''>".$tmppath."/tmphead");
$codeget=exec("curl --form file=@'".$filepath."' 'upload-sg.send.cm/cgi-bin/upload.cgi?upload_type=file&utype=anon' >> ".$tmppath."/tmphead");
echo $codeget;
$codeget2=jsr2($codeget);
//$codeget2=exec("cat ".$tmppath."/tmp/tmphead|jq|grep \"file_code\"");
//echo($codeget2);
$codefin=$codeget2['file_code'];
$link1='';
if($codefin=="undef"){
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

jsw($ulfile_info,$filepath);
?>