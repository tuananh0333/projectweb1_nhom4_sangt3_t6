<?php 
	class User
	{
		// Properties
		public $id = "";
		public $pass = "";

		// Methods
		function __construct($id, $pass)
		{
			$this->id = $id;
			$this->pass = password_hash($pass, PASSWORD_DEFAULT);
		}

		public function getID()
		{
			return $this->id;
		}

		public function login($id, $pass)
		{
			if ($id = "admin" && password_verify($pass, password_hash("123456", PASSWORD_DEFAULT)))
			{			
				session_start();
				$_SESSION["user"] = $this->id;
				$_SESSION["pass"] = $this->pass;
				header("location:index.php");
				exit();
			}
			else
			{
				echo '<div style="text-align: center; color: red; padding-top: 10px;">Sai ID hoặc pass. Vui lòng nhập lại!</div>';
			}
		}
	}
 ?>