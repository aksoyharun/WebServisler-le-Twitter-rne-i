<?php 
require 'baglanti.php';
require_once("lib/nusoap.php");
$server = new soap_server();
$server->configureWSDL("Proje","urn:proje");
/*
$vt->baglantiOlustur();
$baglanti=$vt->baglanti;
*/

class Kullanici{
	private $kullanici=null;

public	function kullaniciOlustur($k_ad,$pw,$mail)
{
	$baglanti=mysqli_connect("localhost","u834088604_burak","ps1oqmaq","u834088604_soa");
	$KomutKullaniciKontrol="select * from kullanici where kullaniciAdi='".$k_ad."' or eposta='".$mail."'";
	$kullaniciKontrolSorgu=mysqli_query($baglanti,$KomutKullaniciKontrol);
	$satirSayisi=mysqli_num_rows($kullaniciKontrolSorgu);
	if($satirSayisi==0)
	{
		$pw=sha1($pw);
		$sorgu="INSERT INTO kullanici(kullaniciAdi,sifre,eposta) values('".$k_ad."','".$pw."','".$mail."')";
		if(mysqli_query($baglanti,$sorgu))
			{
				return "Kayıt başarılı.";
			}
		else

			{

				return "İşlem başarısız";
			}
	}

	else
	{
		return "Mail veya kullanıcı adınız sisteme kayıtlı.";
	}

	mysqli_close($baglanti);
	
}

public function giris($k_ad,$pw)
{
	$baglanti=mysqli_connect("localhost","u834088604_burak","ps1oqmaq","u834088604_soa");
	$pw=sha1($pw);
	$KomutKullaniciKontrol="select * from kullanici where kullaniciAdi='".$k_ad."' or sifre=".$pw."'";
	$kullaniciKontrolSorgu=mysqli_query($baglanti,$KomutKullaniciKontrol);
	$satirSayisi=mysqli_num_rows($kullaniciKontrolSorgu);
	if($satirSayisi==1)
	{
		$this->kullanici=$k_ad;
		return "Basarili";
	}
	else 
		return "Basarisiz";
	}

public function tweetAt($k_ad,$mesaj){
	if(!empty($this->kullanici))
	{


	$baglanti=mysqli_connect("localhost","u834088604_burak","ps1oqmaq","u834088604_soa");
	
	$text="INSERT INTO tweet(kullaniciID,icerik,Tarih) values(15,'".$mesaj."',CURDATE()) ";
	if(mysqli_query($baglanti,$text))
	{
		return "Tweet atıldı";
	}
	else
	{
		return "Başarısız";
	}
	}
	else
	return "Giriş  başarısız";			

}

}





if (isset($_GET['wsdl'])) {
    // This is to autogenerate the WSDL based off of our main API class
    $autodiscover = new Zend_Soap_AutoDiscover();
    $autodiscover->setClass('Kullanici','', null,$_SERVER['PHP_SELF']);
    $autodiscover->handle();
     
} else {
     
    $options = array('uri' => 'urn:Kullanici',
                       'location' => 'http://soaproject.tk/deneme.php?wsdl');
     
    $server = new SoapServer(null, $options);
    $server->setClass('Kullanici');
    $server->handle();
     
}

?>