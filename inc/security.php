<?php
function sanitize($var) {
	$var = htmlentities($var, ENT_QUOTES);
	$var = htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
	if(get_magic_quotes_gpc()) {
		$var = stripslashes($var);
	}
	return $var;
}

if(!function_exists('sanitize')) {
	function sanitize($var) {
		$var = htmlentities($var, ENT_QUOTES);
		$var = htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
		if(get_magic_quotes_gpc()) {
			$var = stripslashes($var);
		}
		return $var;
	}
}

if(!function_exists('intToTime')) {
	function intToTime($seconds, $format = '%d:%d') {
		if($seconds < 1) {
			return;
		}
		$hours = floor($seconds / (60 * 60));
		
		$divisor_for_minutes = $seconds % (60 * 60);
		$minutes = floor($divisor_for_minutes / 60);
		
		$divisor_for_seconds = $divisor_for_minutes % 60;
		$seconds = ceil($divisor_for_seconds);
		
		$obj = [
				"h" => (int) $hours,
				"m" => (int) $minutes,
				"s" => (int) $seconds
		];
		
		return sprintf($format, $obj['h'], $obj['m'], $obj['s']);
	}
}

function stripInput($text) {
	if(!is_array($text)) {
		$text = stripslashes(trim($text));
		$text = preg_replace('/(&amp;)+(?=\#([0-9]{2,3});)/i', '&', $text);
		$search = array(
				'&',
				'\"',
				"'",
				'\\',
				'\"',
				'\'',
				'<',
				'>',
				'&nbsp;'
		);
		$replace = array(
				'&amp;',
				'&quot;',
				'&#39;',
				'&#92;',
				'&quot;',
				'&#39;',
				'&lt;',
				'&gt;',
				' '
		);
		$text = str_replace($search, $replace, $text);
	} else {
		foreach($text as $key => $value) {
			$text[$key] = stripInput($value);
		}
	}
	return $text;
}

//Instalare
if (filesize("inc/config.php") == 0) { 
    echo "<meta http-equiv='refresh' content='0; URL=install.php'>";
}
else {
	$sqlHp = new mysqli(SQL_HP_HOST,  SQL_HP_USER,  SQL_HP_PASS);
	$sqlServ = new mysqli(SQL_HOST,  SQL_USER,  SQL_PASS);
  
	if ($sqlServ->connect_errno) {
		echo "<meta http-equiv='refresh' content='3; URL=offline.php'>";
		exit();
	}
	if ($sqlHp->connect_errno) {
		echo "<meta http-equiv='refresh' content='3; URL=offline.php'>";
		exit();
	}
}
