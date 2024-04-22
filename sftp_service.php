<?php

class SftpService
{
	public static function uploadFile($sendFileName, $sendFilePath){
    $path = "/TARGET_FILE_PATH/";
		$targetFilePath = 'sftp://IP-ADDRESS'. $path . $sendFileName;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_SFTP);
		curl_setopt($ch, CURLOPT_SSH_AUTH_TYPES, CURLSSH_AUTH_ANY);
		curl_setopt($ch, CURLOPT_USERPWD,"USER_NAME:USER_PASSWORD" );
		curl_setopt($ch, CURLOPT_PORT, YOUR_PORT_NUMBER);
		curl_setopt($ch, CURLOPT_UPLOAD, true);                                
		curl_setopt($ch, CURLOPT_INFILE, fopen($sendFilePath, 'r'));         
		curl_setopt($ch, CURLOPT_INFILESIZE, filesize($sendFilePath));       
		curl_setopt($ch, CURLOPT_URL, $targetFilePath);                
		
		$ret = curl_exec($ch);
		
		$info = curl_getinfo($ch);

    if(curl_errno($ch)) {
      log_info("ERROR => ". json_encode($info));
      log_info("ERROR => ". json_encode(curl_error($ch)));
    }
		
		curl_close($ch);
		
		if($ret) {
		    return true;
		}else{
      return false;
    }
    
	}

}
