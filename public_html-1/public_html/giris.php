<?php 


session_start();
$k_ad=$_POST['k_adi'];
$sifre=$_POST['sifre'];

if( !empty($k_ad) && !empty($sifre))
{

	$_SESSION['k_adi']=$k_ad;
	$_SESSION['sifre']=$sifre;
	
	
	
}

?>