<?php 
	
	/**
	 * 
	 */
	class db 
	{
		public $servername='';
		public $username = "";
		public $password = "";
		public $nameDB = "";
		
		function __construct()
		{
			$this->servername = "rdd-bd.cqtvq7d22yp2.us-east-2.rds.amazonaws.com"; 
			$this->username = "root"; 
			$this->password = "&tTgR8UA"; 
			$this->nameDB = "rdd"; 
		}
	}
