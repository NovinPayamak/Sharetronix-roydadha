<?php
	
	chdir(dirname(__FILE__));
	if( !isset($_SERVER['HTTP_HOST']) ) { $_SERVER['HTTP_HOST'] = '127.0.0.1'; }
	if( !isset($_SERVER['REQUEST_URI']) ) { $_SERVER['REQUEST_URI'] = '/'; }
	if( !isset($_SERVER['REMOTE_ADDR']) ) { $_SERVER['REMOTE_ADDR'] = '127.0.0.1'; }
	
	require_once('../helpers/func_main.php');
	
	require_once('../conf_system.php');

	require_once('/pdate.php');
	$_SERVER['HTTP_HOST']	= $C->OUTSIDE_DOMAIN;
	$_SERVER['REQUEST_URI'] = $C->OUTSIDE_SITE_URL;
	$C->DOMAIN			= $C->OUTSIDE_DOMAIN;
	
	@session_start();
	
	if( !isset($cache) ) { $cache = new cache(); }
	if( !isset($db1) ) { $db1 = new mysql($C->DB_HOST, $C->DB_USER, $C->DB_PASS, $C->DB_NAME); }
	if( !isset($db2) ) { $db2 = & $db1; }
	if( !isset($network)) {
		$network	= new network();
		$network->LOAD();
	}
		$user		= new user();
		
	$page		= new page();
    $page->_set_template();
	ini_set( 'error_reporting', E_ALL | E_STRICT );
	ini_set( 'display_errors', '1' );
	ini_set( 'max_execution_time',	10*60 );
	ini_set( 'memory_limit',	64*1024*1024 );
	

	$d = intval(pdate('d'));
	$m = intval(pdate('m'));
	$y = intval(pdate('Y'));
	$who = 1;
	
	$users = array();
	
	$r = $db2->query('SELECT * FROM rooydad WHERE  day="'.$d.'" AND month="'.$m.'" AND year="'.$y.'" ORDER BY id DESC ');
	//echo $db2->num_rows($r);
	if($db2->num_rows($r)>0){
	
		$t = $db2->query('SELECT id FROM users WHERE active="1"  AND id<>"'.$who.'" ORDER BY id DESC');
	//echo $db2->num_rows($t);
	


	while($o = $db2->fetch_object($r)){
		


	while($uid = $db2->fetch_object($t)){
	
if($u = $network->get_user_by_id($uid->id)){
SEND_SMS(decode_mobile_num($u->mobile_sms),$o->about."\r\n".$C->SITE_TITLE);
}	
	
	}
	}
	}
	exit;
?>