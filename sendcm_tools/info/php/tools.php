<?php
    include "fileconvert.php";
    $tmppath="/tmp/sendcmtool";
    //echo ($tmppath."\n");
    function checkdir($path){
        if(!file_exists($path)){
            echo "E2\n";
            exec("mkdir ".$path."\n");
        }
    }
    checkdir($tmppath);
    function jsr($path){
        $in=file_get_contents($path);
        $out=json_decode($in,true);
        return $out;
    }
    function jsr2($cont){
        $out=json_decode($cont,true);
        return $out;
    }
    function jsw($con,$path){
        $in=json_encode($con);
        file_put_contents($path,$in);
        return 0;
    }
    function aes_encrypt($strin,$key){
        //https://cola.workxplay.net/encrypt-and-decrypt-data-in-php-using-aes-example/
        $hash_string = $key;
        $hash = hash('SHA384', $hash_string, true);
        $app_cc_aes_key = substr($hash, 0, 32);
        $app_cc_aes_iv = substr($hash, 32, 16);

        $data = $strin;

        $padding = 16 - (strlen($data) % 16);
        $data .= str_repeat(chr($padding), $padding);
        $encrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $app_cc_aes_key, $data, MCRYPT_MODE_CBC, $app_cc_aes_iv);

        $encrypt_text = base64_encode($encrypt);
        
        return $encrypt_text;
    }
    function aes_decrypt($strin,$key){
        //https://cola.workxplay.net/encrypt-and-decrypt-data-in-php-using-aes-example/
        $strin=base64_decode($strin);
        $hash_string = $key;
        $hash = hash('SHA384', $hash_string, true);
        $app_cc_aes_key = substr($hash, 0, 32);
        $app_cc_aes_iv = substr($hash, 32, 16);
        $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $app_cc_aes_key, $strin, MCRYPT_MODE_CBC, $app_cc_aes_iv);
        $padding = ord($data[strlen($data) - 1]);
        $decrypt_text = substr($data, 0, -$padding);
        return $decrypt_text;
    }
    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
    function bbbbb(){
        return 0;
    }
?>