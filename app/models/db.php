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
			$this->servername = "localhost"; 
			$this->username = "root"; 
			$this->password = ""; 
			$this->nameDB = "rdd"; 
		}
	}
