<?php
	// $localhost = "localhost";
	// $DBusername = "root";
	// $dbname = "foodex_new";
	// $pwd="";

	// $mysqlilink = @mysqli_connect($localhost,$DBusername,$pwd)or die('<center><div>wrong in connect with server</div>'.mysqli_connect_error()."</center>");


	// @mysqli_select_db($mysqlilink,$dbname)or die('<center><div>wrong in connect with database</div>'.mysqli_connect_error($mysqlilink)."</center>");

	// @mysqli_set_charset($mysqlilink,"UTF8")or die('<center><div>wrong </div>'.mysqli_connect_error($mysqlilink)."</center>");


    // Database connection settings
    $serverName = "DESKTOP-I92KCB1\SQLEXPRESS";
    $connectionOptions = array( "Database" => "Speed_Geer", "CharacterSet" => "UTF-8");

    $serverName = "DESKTOP-I92KCB1\SQLEXPRESS";
    $connectionOptions = array( "Database" => "Speed_Geer", 
                                "CharacterSet" => "UTF-8",
                                // "Uid" => "jayash",
                                // "PWD" => "123456"
                                );

    // Establishing the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);

	$mysqlilink = $conn;
    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }


	//  ======================  Start Path ============================
	//  ====================== =========== ============================

	// HTTP
	$PATH_SERVER 			= 'http://localhost/speedGear/';
	$PATH_PHOTOES 			= $PATH_SERVER . 'photoes/';


	$PATH_ADMIN 			= $PATH_SERVER . 'admin/';
	
	
	$PATH_ADMIN_INCLUDES 			= $PATH_ADMIN . 'includes/';
	$PATH_ADMIN_TEMPLATE 			= $PATH_ADMIN . 'template/';
	$PATH_ADMIN_PHOTOES 			= $PATH_ADMIN . 'photoes/';
	

	// DIR
	define('DIR_APPLICATION', 'C:/xampp/htdocs/speedGear/');
	define('DIR_PHOTOES', 'C:/xampp/htdocs/speedGear/photoes/');



	//  ======================  End  Path =============================
	//  ====================== =========== ============================


	//  ======================  Start Function ============================
	//  ====================== =============== ============================
	function getTitle() {

		global $pageTitle;

		if (isset($pageTitle)) {

			echo $pageTitle;

		} else {

			echo 'Default';

		}
	}


  function isLogin()
  {
	if(isset($_SESSION['user']))
	{
		if(isset($_SESSION['userType']))
		{
			if($_SESSION['userType'] == 'a' || $_SESSION['userType'] == 'r' || $_SESSION['userType'] == 'd')
			{
				return true;
			}
		}
	}
	return false;	
  }

  function getLoginType()
  {
	if(isLogin())
	{
		return $_SESSION['userType'];
	}
	else
	{
		return null;
	}
  }

  function isAdmin() { if(getLoginType() == 'a') return true; }
  function getLoginEmail() { return $_SESSION['user'] ;}

	//  ======================  End Function ============================
	//  ====================== ============= ============================
?>