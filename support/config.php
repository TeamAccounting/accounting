<?php
	session_start();
	define("APPNAME","Accounting System");
	error_reporting(E_ALL);
	//define("BACKUP_PATH", "C:\\xampp\\htdocs\\SGTSI_AccountingSystem\\DatabaseBackups\\");
	//$server_name='accounting.sparkglobaltech.com/';
	$database = 'accounting1';
	$username = 'root';
	$password = '';
	
	//UI//
	function addHead($pageTitle=APPNAME,$DirectoryLevel=0){
		require_once str_repeat('../',$DirectoryLevel).'templates/head.php';
	}
	
	function addFoot($DirectoryLevel=0){
		require_once str_repeat('../',$DirectoryLevel).'templates/footer.php';
	}
	
	function addSideBar($DirectoryLevel=0){
		require_once str_repeat('../',$DirectoryLevel).'templates/sidebar.php';
	}
	function addNavBar($DirectoryLevel=0){
		require_once str_repeat('../',$DirectoryLevel).'templates/navbar.php';
	}
	
	///Alerting
	
	function setAlert($content=NULL,$alerttype='danger'){
		$_SESSION[APPNAME]['alertcontent'] = $content;
		$_SESSION[APPNAME]['alerttype'] = $alerttype;
	}
	
	function Alert(){
		if(isset($_SESSION[APPNAME]['alertcontent'])){
			include_once('templates/alert.php');
		}
	}
	
	function unsetAlert(){
		$_SESSION[APPNAME]['alertcontent'] = NULL;
		$_SESSION[APPNAME]['alerttype'] = NULL;
	}
	//END ALERT//
	//END UI//
	
	//Navigation//
	function redirect($url)
	{
		header("location:".$url);
	}
	
	function loggedId(){
	if(isset($_SESSION[APPNAME]['UserName'])){
			return true;
		}else{
			return false;
		}
	}
	
	//End Navigation
	
	//Password Encryption Same as other Configs//
	function encryptIt( $q ) {
	    $cryptKey  = 'JPB0rGtIn5UB1xG03efyCp';
	    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
	    return( $qEncoded );
	}
	function decryptIt( $q ) {
	    $cryptKey  = 'JPB0rGtIn5UB1xG03efyCp';
	    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
	    return( $qDecoded );
	}
	//End Password Encryption//
	
	//Database//
	require_once("class.myPDO.php");
	$connection = new myPDO($database,$username,$password);
	
	/*
	function backUp($server_name,$username,$database,$mysqldumppath="C:/xampp/mysql/bin/"){
		
		
		$cmd = $mysqldumppath."mysqldump --routines -h ".$server_name." -u ".$username." ".$database." > " . BACKUP_PATH."". date("Ymd")."_".$database.".sql";
		echo exec($cmd);
		
	}
	
	function restore($server_name,$username,$database,$filename,$mysqldumppath="C:/xampp/mysql/bin/"){
		$restore_file  = "C:\\xampp\\htdocs\\SGTSI_AccountingSystem\\DatabaseBackups\\".$filename;
		

		$cmd = $mysqldumppath."mysql -h $server_name -u $username $database < $restore_file";
		exec($cmd);
	}*/
	
	//END Data
	function makeOptions($array, $placeholder="", $val=null, $disable="", $checked_value=null)
{
    $options="";
        // if(!empty($placeholder)){
    $options.="<option value='{$val}'>{$placeholder}</option>";
        // }
    foreach ($array as $row) {
        list($value, $display) = array_values($row);
        if ($checked_value!=null && $checked_value==$value) {
            $options.="<option value='".htmlspecialchars($value)."' checked $disable>".htmlspecialchars($display)."</option>";
        } else {
            $options.="<option value='".htmlspecialchars($value)."' $disable>".htmlspecialchars($display)."</option>";
        }
    }
    return $options;
}
?>