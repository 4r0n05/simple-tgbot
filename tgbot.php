<?php

$updid = 0; // The last update_id from the server, this will be changed and used in sequential requests

$token = ""; //Your bot's token

while(true){

//	echo "API request...";

	$a = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getUpdates?timeout=15&offset=".$updid."&limit=100"),true);

	if($a["ok"] != true){
		
		print_r($a);
		
	}else{
		
		$a = $a["result"];
		
		$nr = count($a);

	if($a != NULL && $nr > 0){
		
		$n = 0;
		
//		echo "Have results:".$nr; //Debug
		
		while($n != ($nr)){
					
			$updid = $a[$n]["update_id"]+1;
			
			//Some info extracted from the update
			
			$to = $a[$n]["message"]["chat"]["id"];
			
			$msg = $a[$n]["message"]["text"];
			
			//Test feature, respond /ping with /pong
						
			if($msg == "/ping"){
				
				$msg_out = urlencode("/pong");
				
				file_get_contents("https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$to."&text=".$msg_out);
				
			}		
			
//			echo "."; //Debug

			$n++;
				
			}
		
		}

	}

}

?>
