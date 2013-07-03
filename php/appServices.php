<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	
	$my_file = dirname(__FILE__).'/../'.'players.txt';	
	
	switch ($_GET['action']) {
	
		case "getUser":
				
			$file = fopen($my_file, "r+") or exit("Unable to open file!");
			$playerFound = false;
			//Output a line of the file until the end is reached
			while(!feof($file))
			{
				$string =  fgets($file);
				$playerId = explode(" ",$string);
				
				if ($playerId[0] == $_GET['parameters']['playerId'])
				{
					$playerFound = true;
				}	
			}
			
			if ($playerFound == false) 
			{
				fwrite($file,$_GET['parameters']['playerId'].' 0000000000000000'."\n");
				
			}
			fclose($file);			
			
			$resp['status'] = "ok"; 
			$resp['id'] = $_GET['parameters']['playerId']; 
			echo json_encode($resp);
				
		break;
		
		case "getUserProgress":
		
			$player = 'none';
			
			$file = fopen($my_file, "r") or exit("Unable to open file!");
			
			while(!feof($file))
			{
				$string =  fgets($file);
				$playerId = explode(" ",$string);
				
				if(count($playerId) > 1){
				
					if ($playerId[0] == $_GET['parameters']['playerId'])
					{
						$player = $playerId;
					}					
				}				
			}
			
			if($player == 'none'){
				$resp['status'] = "error"; 
				$resp['playerId'] = ''; 
				$resp['playerProgress'] = ''; 
				echo json_encode($resp);
			}
			else
			{
				$resp['status'] = "ok"; 
				$resp['playerId'] = $player[0]; 
				$resp['playerProgress'] = trim(preg_replace('/\s+/', ' ', $player[1])); 
				echo json_encode($resp);
			}
			
		
		break;
		
		case "UpdateUserProgress":
		
			$file = fopen($my_file, "r+") or exit("Unable to open file!");
			while(!feof($file))
			{
				/*save the pointer in the beginning of the each line*/
				$beginningLine = ftell($file);
				
				$string =  fgets($file);
				$playerId = explode(" ",$string);
				
				if ($playerId[0] == $_GET['parameters']['playerId'])
				{					
					/*move the pointer in the beginning of the line*/
					/*becasue fgets point to end of the line*/
					fseek($file,$beginningLine);
					/*this write works  because  the line if the same length of the original */
					fwrite($file,$playerId[0].' '.$_GET['parameters']['playerProgress']."\n");
				}	
			}
		
			$resp['status'] = "ok"; 
			echo json_encode($resp);
		break;
  
	}
	
	
?>