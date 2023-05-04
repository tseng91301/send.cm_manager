<?php
$sendcmtmppath="~/.sendcmtools";
$filepath=exec("cat ".$sendcmtmppath."/tmp/uploadingfile");
//echo($filepath);
exec("echo ''>".$sendcmtmppath."/tmp/tmphead");
$codeget=exec("curl --form file=@'".$filepath."' 'upload-sg.send.cm/cgi-bin/upload.cgi?upload_type=file&utype=anon' >> ".$sendcmtmppath."/tmp/tmphead");
$codeget2=exec("cat ".$sendcmtmppath."/tmp/tmphead|jq|grep \"file_code\"");
//echo($codeget2);
$codeget3=explode(":",$codeget2);
$codeget4=$codeget3[1];
//echo($codeget4);
$codeget4len=strlen($codeget4);
$starttmp=0;
$codefin='';
for($a=0;$a<$codeget4len;$a++){
    if($starttmp==0){
        if($codeget4[$a]=="\""){
            $starttmp=1;
        }
    }else if($starttmp==1){
        if($codeget4[$a]=="\""){
            $starttmp=0;
        }else{
            $codefin.=$codeget4[$a];
        }
    }
}
//echo($codefin);
$link1='';
if($codefin=="undef"){
    exec("echo 'error1' > ".$sendcmtmppath."/tmp/filelink");
    return 0;
}else{
    //echo($codefin);
    $link1=exec("curl 'https://send.cm/?op=upload_result&st=OK&fn=".$codefin."'|grep '<textarea class=\"form-control wd-400\" rows=\"3\">https://send.cm/d/'");
}
//echo($link1);
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

$fileid=getnewid($sendcmtmppath."/file");
$filename1=explode("/",$filepath);
$dd=sizeof($filename1);
$filename=$filename1[$dd-1];
//echo($filename);
exec("mkdir ".$sendcmtmppath."/file"."/".$fileid);
exec("echo '".$filename."' > ".$sendcmtmppath."/file"."/".$fileid."/name");
exec("echo '".time()."' > ".$sendcmtmppath."/file"."/".$fileid."/time");
exec("echo '".$link2."' > ".$sendcmtmppath."/file"."/".$fileid."/link");
exec("echo '".$codefin."' > ".$sendcmtmppath."/file"."/".$fileid."/codeid");

exec("echo '".$link2."' > ".$sendcmtmppath."/tmp/filelink");

function getnewid($path){
    $tmp=0;
    $find=0;
    while($find==0){
        $idf=strval($tmp);
        if(exec("ls ".$path."|grep '\<".$idf."\>'")==""){
            $find=1;
        }else{
            $tmp++;
        }
    }
    return(strval($tmp));
}
?>