<?php 

for($i=1;$i<2000;$i++){
$mobile = urlencode("9028403587");
        	$username = urlencode("u6442");
 
           $msg_token = urlencode("8DnWEI");
            $sender_id = urlencode("SUPEDT");
            $message = urlencode("Dear Client, As we celebrate Diwali, let's hope that it brings us new opportunities to work together and prosper. Thanks & Regards, Super Editors, www.supereditors.in, info@supereditors.in, 02024430981/9028544114");
			$api = "http://mysms.exposys.in/api/send_transactional_sms.php?username=".$username."&msg_token=".$msg_token."&sender_id=".$sender_id."&message=".$message."&mobile=".$mobile."";
			$Message = htmlspecialchars($message);
			$curl = curl_init();
			curl_setopt($curl,CURLOPT_URL,$api);
			curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
			//curl_exec($curl);
			
			$response = curl_exec($curl);
$err = curl_error($curl);
if ($err) {
  echo "cURL Error #:" . $err;
  echo "<br>";
  echo $i;
} else {
  echo $response;
  echo "<br>";
  echo $i;
}
curl_close($curl);
}
?>