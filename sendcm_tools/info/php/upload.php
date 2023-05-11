<?php include "tools.php";
$uplhost="upload-sg.send.cm";

$ulinfo=jsr($tmppath."/ulinfo");
$filepath=$ulinfo['filepath'];
$filepath2=$filepath;
if(!file_exists($filepath)){
    echo("Error: File not found!\n");
    return;
}
if($ulinfo['t']){
    exec("zip '".$filepath.".zip' '".$filepath."/'*");
    $filepath2=$filepath2.".zip";
}

//divide file and upload
$di_doc_inf=divide_doc($filepath2);
$di_doc_num=count($di_doc_inf);
$keygen=generateRandomString(20);//Generate key
for($a=0;$a<$di_doc_num;$a++){
    //encrypt file
    echo("\n\n\nUploading file ".strval($a+1)."/$di_doc_num...\n");
    $encstr=aes_encrypt(file_get_contents($filepath2."-di/".$di_doc_inf[$a]['name']),$keygen);
    file_put_contents($filepath2."-di/".$di_doc_inf[$a]['name'],$encstr);
    //upload file
    $cloud_inf=upload_host($uplhost,$filepath2."-di/".$di_doc_inf[$a]['name'],$tmppath);
    $di_doc_inf[$a]['link']=$cloud_inf['link'];
    $di_doc_inf[$a]['codeid']=$cloud_inf['codeid'];
}
$ulfile_info['key']=$keygen;
$ulfile_info['di_doc_inf']=$di_doc_inf;
$ulfile_info['upload_time']=time();
$ulfile_info['last_update_time']=time();
$ulfile_info['t']=$ulinfo['t'];
if($ulinfo['t']){
    exec("rm '".$filepath.".zip'");
}
exec("rm -rf '$filepath-di'");
jsw($ulfile_info,$filepath.".sendcmdl");

function upload_host($host,$f_path,$t_path){
    exec("echo ''>$t_path/tmphead");
    exec("curl --form file=@'$f_path' '$host/cgi-bin/upload.cgi?upload_type=file&utype=anon' > $t_path/tmphead");
    //echo $codeget;
    $codeget2=jsr($t_path."/tmphead")[0];
    //$codeget2=exec("cat ".$tmppath."/tmp/tmphead|jq|grep \"file_code\"");
    $codefin=$codeget2['file_code'];
    //echo($codefin."\n");
    $link1='';
    if($codefin=="undef"){
        error_log("Error: The file is banned by send.cm server!\n");
        echo("Detailed information: ".file_get_contents($t_path."/tmphead")."\n");
        error_log("Upload failed...");
        file_put_contents($f_path.".sendcmdl","error1");
        $ret=[];
        $ret['codeid']=$codefin;
        return $ret;
    }else{
        //echo($codefin);
        $link1=exec("curl 'https://send.cm/?op=upload_result&st=OK&fn=".$codefin."'|grep '<textarea class=\"form-control wd-400\" rows=\"3\">https://send.cm/d/'");
    }
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
    $ret=[];
    $ret['codeid']=$codefin;
    $ret['link']=$link2;
    return $ret;
}
?>