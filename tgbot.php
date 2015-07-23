<?php

$updid = 0; // The last update_id from the server, this will be changed and used in sequential requests

$token = "put_token_here"; //Your bot's token

while(true){

$a = json_decode(file_get_contents("curl -s 'https://api.telegram.org/bot".$token."/getUpdates?timeout=15&offset=".$updid."&limit=100'"),true);

$nr = count(@$a["result"]);


if($a["ok"] != true){
	
	print_r($a);
	
}else{
	
	$a = $a["result"];

if($a != NULL && $nr > 0){
	
	$n = 0;
	
//	echo "\nHave results:".$nr."\n"; //Debug
	
	while($n != ($nr)){
				
		$updid = $a[$n]["update_id"]+1;
		
		//Some info extracted from the update
		
		$date = $a[$n]["message"]["date"];

		$to = $a[$n]["message"]["chat"]["id"];
		
		$msg = $a[$n]["message"];
		
		//Test feature, respond /ping with /pong
		
		if($msg == "/ping"){
			
			$msg_out = urlencode("/pong");
			
			file_get_contents("https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$to."&text=".$msg_out);
			
		}		
		
//		echo "."; //Debug

	$n++;
		
	}
	
}

}

}

?>
