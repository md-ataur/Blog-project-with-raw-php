<?php

class Format{

	/* Date format */
	public function dateFormat($date){
		return date('F j, Y, g:i a', strtotime($date));
	}

	/* paragraph shorten */
	public function textShorten($text, $limit = 370){
		$text = $text.' ';
		$text = substr($text, 0, $limit);
		$text = substr($text, 0, strrpos($text, ' '));
		$text = $text."....";
		return $text;
	}

	public function validation($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function title(){
		$page  = $_SERVER['SCRIPT_FILENAME'];
		$title = basename($page, '.php');
		if ($title == 'index') {
			$title = 'home';
		}elseif ($title == 'contact') {
			$title = 'contact';
		}
		return $title = ucwords($title);
	}

	
}

?>