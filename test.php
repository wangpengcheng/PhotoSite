<?php
	function curPageURL() {    
		$pageURL = 'http';    
		$pageURL .= "://";    
		if ($_SERVER["SERVER_PORT"] != "80"){
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];    
		}else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		 $result=parse_url($pageURL);
		return $result;
	}
	$temp=curPageURL()["path"];
	$result=explode('/', $temp);
	//echo $result["path"];//'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$last=count($result);
	print_r(($result[$last-1]=="test.php"));
?>