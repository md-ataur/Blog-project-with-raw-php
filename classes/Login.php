<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
	
	class Login{

		public $db;
		public $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function loginAccess($username, $password){
			$username = $this->fm->validation($username);
			$password = $this->fm->validation($password);

			$username = mysqli_real_escape_string($this->db->link, $username);
			$password = mysqli_real_escape_string($this->db->link, $password);

			$query = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'";
			$result = $this->db->select($query);
			if ($result != false) {
				$value = $result->fetch_assoc();
				if ($value) {
					Session::set("login", true);
					Session::set("userId", $value['id']);
					Session::set("Name", $value['name']);
					Session::set("userName", $value['username']);
					Session::set("userRole", $value['role']);
					header("Location:index.php");
				}
				
			}else{
				$msg = "<span style='color:red; margin:0 0 10px; display: block;'> User or Password Invalid !</span>";
				return $msg;
			}
		}
	}
?>