<?php 
$kullaniciAdi=$_POST['kullaniciAdi'];
session_start();
 $_SESSION['kullaniciadi']=$kullaniciAdi;
 print   $_SESSION['kullaniciadi'];






?>