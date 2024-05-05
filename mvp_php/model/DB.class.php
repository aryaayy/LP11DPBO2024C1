<?php


/******************************************
Asisten Pemrogaman 13
 ******************************************/
class DB
{
	var $db_host = ''; // host
	var $db_user = ''; // user basis data
	var $db_password = ''; // password
	var $db_name = ''; // nama basis data
	var $db_link = ''; // nama basis data
	var $result = 0;

	function __construct($db_host = '', $db_user = '', $db_password = '', $db_name = '')
	{
		// konstruktor
		$this->db_host = $db_host;
		$this->db_user = $db_user;
		$this->db_password = $db_password;
		$this->db_name = $db_name;
	}

	function open()
	{
		// membuka koneksi
		$this->db_link = mysqli_connect($this->db_host, $this->db_user, $this->db_password, $this->db_name);
	}

	function execute($query = "")
	{
		// mengeksekusi query
		$this->result = mysqli_query($this->db_link, $query);

		return $this->result;
	}

	function executeAffected($query = "")
	{
		// mengeksekusi query
		$this->result = mysqli_query($this->db_link, $query);
		mysqli_affected_rows($this->db_link);

		return mysqli_affected_rows($this->db_link);
	}

	function getResult()
	{
		// mengambil ekseskusi query
		return mysqli_fetch_array($this->result);
	}

	function close()
	{
		// menutup koneksi
		mysqli_close($this->db_link);
	}
}