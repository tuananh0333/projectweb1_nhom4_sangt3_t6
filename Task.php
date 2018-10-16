<?php 
	/**
	* 
	*/
	class Task
	{
		public $name;
		public $time;
		public $user;
		public $description = "";

		function __construct($_name, $_user, $_time, $_description)
		{
			$this->name = $_name;
			$this->user = $_user;
			$this->time = $_time;
			$this->description = $_description;
		}

		public function getName()
		{
			return $this->name;
		}
		public function getTime()
		{
			return $this->time;
		}
		public function getUser()
		{
			return $this->user;
		}
		public function getDescription()
		{
			return $this->description;
		}
	}
 ?>