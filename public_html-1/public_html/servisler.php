<?php 
require 'baglanti.php';
require_once("lib/nusoap.php");
$server = new soap_server();
$server->soap_defencoding = 'UTF-8';
$server->decode_utf8 = false;
$server->encode_utf8 = true;
$server->configureWSDL("Proje","urn:proje");
/*
$vt->baglantiOlustur();
$baglanti=$vt->baglanti;
*/


function kullaniciOlustur($k_ad,$pw,$mail)
{
	$baglanti=mysqli_connect("localhost","u834088604_burak","ps1oqmaq","u834088604_soa");
	$KomutKullaniciKontrol="select * from kullanici where kullaniciAdi='".$k_ad."' or eposta='".$mail."'";
	$kullaniciKontrolSorgu=mysqli_query($baglanti,$KomutKullaniciKontrol);
	$satirSayisi=mysqli_num_rows($kullaniciKontrolSorgu);
	if($satirSayisi==0)
	{
		$pw=sha1($pw);
		$key=sha1($mail.$pw);
		$sorgu="INSERT INTO kullanici(kullaniciAdi,sifre,eposta) values('".$k_ad."','".$pw."','".$mail."')";
		

		if(mysqli_query($baglanti,$sorgu))
			{
					$sorgu2="select kullaniciID from kullanici where kullaniciAdi='".$k_ad."'";
				$k_id_sonuc=mysqli_fetch_array(mysqli_query($baglanti,$sorgu2));
				$k_id=$k_id_sonuc[0];

			$sorgu5="INSERT INTO auth(kullaniciID,authKey) values(".$k_id.",'".$key."') ";
		   if(mysqli_query($baglanti,$sorgu5))
		   {
				return "Kayit basarili.";
		   }
		   else
		   	return "baasarisiz";
			}
		else

			{

				return "Islem basarisiz";
			}
	}

	else
	{
		return "Mail veya kullanici adiniz sisteme kayitli.";
	}

	mysqli_close($baglanti);
	
}

function giris($k_ad,$pw)
{
	$baglanti=mysqli_connect("localhost","u834088604_burak","ps1oqmaq","u834088604_soa");
	$pw=sha1($pw);
	$KomutKullaniciKontrol="select * from kullanici where kullaniciAdi='".$k_ad."' and sifre='".$pw."'";
	$kullaniciKontrolSorgu=mysqli_query($baglanti,$KomutKullaniciKontrol);
	$Keykomut="select auth.authKey from kullanici inner join auth on kullanici.kullaniciID=auth.kullaniciID where kullanici.kullaniciAdi='".$k_ad."'";
	$keysorgu=mysqli_query($baglanti,$Keykomut);
	$Key=mysqli_fetch_array($keysorgu);
	$satirSayisi=mysqli_num_rows($kullaniciKontrolSorgu);

	if($satirSayisi==1)
		
		return array(
            'Mesaj' => True,
            'KullaniciAdi' => $k_ad,
            'key' =>  $Key[0]   
                 );
	else 
		return new soap_fault('SOAP-ENV:Server', '', 'Kullanıcı bulunamadı', '');
	mysqli_close($baglanti);
}

function tweetAt($key,$mesaj){
	$baglanti=mysqli_connect("localhost","u834088604_burak","ps1oqmaq","u834088604_soa");
	$keySorgu="select kullaniciID from auth where authKey='".$key."'";
	
	$getKey=mysqli_query($baglanti,$keySorgu);
	$kullaniciID=mysqli_fetch_array($getKey);
	if(mysqli_num_rows($getKey)==1)
	{
			$text="INSERT INTO tweet(kullaniciID,icerik,Tarih) values(".$kullaniciID[0].",'".$mesaj."',CURDATE()) ";
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
		return new soap_fault('SOAP-ENV:Server', '', 'Kullanıcı bulunamadı', '');

	mysqli_close($baglanti);

}

function tweetSil($key,$tweetID)
{

$baglanti=mysqli_connect("localhost","u834088604_burak","ps1oqmaq","u834088604_soa");
	$keySorgu="select kullaniciID from auth where authKey='".$key."'";
	
	$getKey=mysqli_query($baglanti,$keySorgu);
	$kullaniciID=mysqli_fetch_array($getKey);
	if(mysqli_num_rows($getKey)==1)
	{
		$tweetkontrolkomut="SELECT * from tweet where tweetID=".$tweetID." and kullaniciID=".$kullaniciID[0];
		$tweetkontrolsorgu=mysqli_query($baglanti,$tweetkontrolkomut);
		if(mysqli_num_rows($tweetkontrolsorgu)==1)
		{
			$text="DELETE FROM tweet where tweetID=".$tweetID;
		
	if(mysqli_query($baglanti,$text))
	{
		return "Tweet silindi";
	}
	else
	{
		return "Başarısız";
	}
		}

		else
			return "Bu tweete erisim hakkiniz bulunmamaktadır.";

		}
	else 
		return new soap_fault('SOAP-ENV:Server', '', 'Kullanıcı bulunamadı', '');

	mysqli_close($baglanti);

}



function takibiBirak($key,$takipedilen)
{
$baglanti=mysqli_connect("localhost","u834088604_burak","ps1oqmaq","u834088604_soa");
$keySorgu="select kullaniciID from auth where authKey='".$key."'";
	
	$getKey=mysqli_query($baglanti,$keySorgu);
	$kullaniciID=mysqli_fetch_array($getKey);

	if(mysqli_num_rows($getKey)==1)
	{


		$takipedilenKomut="select kullaniciID from kullanici where kullaniciAdi='".$takipedilen."'";
		
	$takipedilenID=mysqli_fetch_array(mysqli_query($baglanti,$takipedilenKomut));
		$takipkontrolKomut="select takipID from takipci where takipciID=".$kullaniciID[0]." and takipedilenID=".$takipedilenID[0];
		$takipID=mysqli_fetch_array(mysqli_query($baglanti,$takipkontrolKomut));
		$takipID=$takipID[0];
		if(mysqli_num_rows(mysqli_query($baglanti,$takipkontrolKomut))==1)
		{
			$takipSorgu="DELETE FROM  takipci where takipID=".$takipID;
			if(mysqli_query($baglanti,$takipSorgu))
				return "Kullanici takibi sona erdi.";
			else
				return "Hata";
		}
		else
		{
			return "Takip edilen kullanıcı bulunamadı";
		}

		
	}

	else
		return new soap_fault('SOAP-ENV:Server', '', 'Kullanıcı bulunamadı', '');

	mysqli_close($baglanti);



}
function takipEt($key,$takipedilen)
{
$baglanti=mysqli_connect("localhost","u834088604_burak","ps1oqmaq","u834088604_soa");
$keySorgu="select kullaniciID from auth where authKey='".$key."'";
	
	$getKey=mysqli_query($baglanti,$keySorgu);
	$kullaniciID=mysqli_fetch_array($getKey);

	if(mysqli_num_rows($getKey)==1)
	{


		$takipedilenKomut="select kullaniciID from kullanici where kullaniciAdi='".$takipedilen."'";
		$takipedilenID=mysqli_fetch_array(mysqli_query($baglanti,$takipedilenKomut));

		$takipkontrolKomut="select * from takipci where takipciID=".$kullaniciID[0]." and takipedilenID=".$takipedilenID[0];
		if(mysqli_num_rows(mysqli_query($baglanti,$takipkontrolKomut))==0)
		{
			$takipSorgu="INSERT INTO takipci(takipedilenID,takipciID,takipTarih) values(".$takipedilenID[0].",".$kullaniciID[0].",CURDATE())";
			if(mysqli_query($baglanti,$takipSorgu))
				return "Kullanici takip edildi.";
			else
				return "Hata";
		}
		else
		{
			return "Bu kullaniciyi zaten takip ediyorsunuz";
		}

		
	}

	else
		return new soap_fault('SOAP-ENV:Server', '', 'Kullanıcı bulunamadı', '');

	mysqli_close($baglanti);

}

function sifreDegistir($key,$newPw)
{
$baglanti=mysqli_connect("localhost","u834088604_burak","ps1oqmaq","u834088604_soa");
$keySorgu="select kullaniciID from auth where authKey='".$key."'";
	
	$getKey=mysqli_query($baglanti,$keySorgu);
	$kullaniciID=mysqli_fetch_array($getKey);
	$kullaniciID=$kullaniciID[0];

	if(mysqli_num_rows($getKey)==1)
	{
	
		$newPw=sha1($newPw);

		$updatekomut="UPDATE kullanici SET sifre='".$newPw."' where kullaniciID=".$kullaniciID;
		if(mysqli_query($baglanti,$updatekomut))
			return "Sifreniz basariyla guncellendi";
		else
			return "Islem hatasi";
		

		
	}

	else
		return new soap_fault('SOAP-ENV:Server', '', 'Kullanıcı bulunamadı', '');

	mysqli_close($baglanti);

}
function favoriEkle($key,$tweetID)
{
$baglanti=mysqli_connect("localhost","u834088604_burak","ps1oqmaq","u834088604_soa");
$keySorgu="select kullaniciID from auth where authKey='".$key."'";
	
	$getKey=mysqli_query($baglanti,$keySorgu);
	$kullaniciID=mysqli_fetch_array($getKey);
	$kullaniciID=$kullaniciID[0];

	if(mysqli_num_rows($getKey)==1)
	{
		$komut="INSERT INTO favori(tweetID,kullaniciID) values(".$tweetID.",".$kullaniciID.")";
		$komutkontrol="SELECT * from favori where tweetID=".$tweetID." and kullaniciID=".$kullaniciID;
		$sorgukontrol=mysqli_query($baglanti,$komutkontrol);
		if(mysqli_num_rows($sorgukontrol)==0)
		{
				if(mysqli_query($baglanti,$komut))
			{
				return "Favoriye Alındı";
			}
			else
				return "Hata";
		}
		else
		{
			return "Daha önceden favoriye alınmış.";

		}
		
	}

	else
		return new soap_fault('SOAP-ENV:Server', '', 'Kullanıcı bulunamadı', '');

	mysqli_close($baglanti);

}
function onerilenKullanicilariListele($key)
{
$baglanti=mysqli_connect("localhost","u834088604_burak","ps1oqmaq","u834088604_soa");
$keySorgu="select kullaniciID from auth where authKey='".$key."'";
	
	$getKey=mysqli_query($baglanti,$keySorgu);
	$kullaniciID=mysqli_fetch_array($getKey);
	$kullaniciID=$kullaniciID[0];

	if(mysqli_num_rows($getKey)==1)
	{
		$kullanicilar=array();
		$kullaniciKomut="SELECT k.kullaniciID,k.kullaniciAdi, IF( t.takipciID =".$kullaniciID.", 1 , 0 ) AS  takip_durumu FROM kullanici k left JOIN takipci t ON t.takipedilenID = k.kullaniciID and t.takipciID=".$kullaniciID." where k.kullaniciID not in (".$kullaniciID.")  order by takip_durumu asc";
		//or t.takipciID IS NULL
		$kullaniciSorgu=mysqli_query($baglanti,$kullaniciKomut);
		$i=0;
		while($sonuc=mysqli_fetch_array($kullaniciSorgu))
		{
			$kullanicilar[$i]=array(
				"kullaniciID"=>$sonuc['kullaniciID'],
				"kullaniciAd"=>$sonuc['kullaniciAdi'],
				"takipDurumu"=>$sonuc['takip_durumu']
				);
			$i+=1;
		}
		return $kullanicilar;


	}

	else
		return new soap_fault('SOAP-ENV:Server', '', 'Kullanıcı bulunamadı', '');

	mysqli_close($baglanti);

}


function tweetleriListele($key)
{

	$baglanti=mysqli_connect("localhost","u834088604_burak","ps1oqmaq","u834088604_soa");
	$keySorgu="select kullaniciID from auth where authKey='".$key."'";
	
	$getKey=mysqli_query($baglanti,$keySorgu);
	$kullaniciID=mysqli_fetch_array($getKey);           
	$kullaniciID=$kullaniciID[0];
	if(mysqli_num_rows($getKey)==1)
	{
		$tweetler=array();
	  $komut="SELECT * from tweet  inner join kullanici on tweet.kullaniciID=kullanici.kullaniciID     
where kullanici.kullaniciID=".$kullaniciID." or kullanici.kullaniciID IN (select takipedilenID from takipci where takipciID=".$kullaniciID.")   ORDER BY tweet.tweetID DESC";
	  $sorgu=mysqli_query($baglanti,$komut);
	  $i=0;
	  while($sonuc=mysqli_fetch_array($sorgu))
	  {
	  	$tweetler[$i]=array(
	  		"KullaniciAdi"=>$sonuc["kullaniciAdi"],
	  		"tweetID"=>$sonuc["tweetID"],
	  		"Mesaj"=>$sonuc['icerik']
	  		);
	  	$i+=1;


	  }

	  return $tweetler;
	}
	else 
		return new soap_fault('SOAP-ENV:Server', '', 'Kullanıcı bulunamadı', '');

	mysqli_close($baglanti);
}




$server->wsdl->addComplexType(
'tweetArray',
'complextType',
'array',
'',
'SOAP-ENC:Array',
array(),
array(array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:tweet[]')), 'tns:tweet'
	);
$server->wsdl->addComplexType(
'tweet',
'complextType',
'struct',
'sequence',
'',
array(
	'KullaniciAdi'=>array('name'=>'KullaniciAdi','type'=>"xsd:string"),
	'tweetID'=>array('name'=>'tweetID','type'=>"xsd:integer"),
	'Mesaj'=>array('name'=>"mesaj",'type'=>"xsd:string")
	)


	);

$server->wsdl->addComplexType(
'kullaniciArray',
'complextType',
'array',
'',
'SOAP-ENC:Array',
array(),
array(array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Kullanici[]')),'tns:Kullanici'
	);

$server->wsdl->addComplexType(
'KullaniciGirisData',
'complextType',
'struct',
'sequence',
'',

array(
	'Mesaj'=>array('name'=>'Mesaj','type'=>"xsd:boolean"),
	'KullaniciAdi'=>array('name'=>'kullaniciAdi','type'=>"xsd:string"),
	'key'=>array('name'=>'key','type'=>"xsd:string")
	)
	);

$server->wsdl->addComplexType(
'Kullanici',
'complextType',
'struct',
'sequence',
'',
array(
	'kullaniciID'=>array('name'=>'ID','type'=>"xsd:integer"),
	'kullaniciAd'=>array('name'=>'kullaniciAdi','type'=>"xsd:string"),
	'takipDurumu'=>array('name'=>'takipdurumu','type'=>"xsd:boolean")
	
	)
	);
$server->register('onerilenKullanicilariListele',
	array('key'=>"xsd:string"),
	array('return'=>"tns:kullaniciArray"),
	'urn:proje',
	'urn:proje#onerilenKullanicilariListele',
	'rpc',
	'encoded',
	'Onerilen kisileri listeler'

	);

$server->register('tweetleriListele',
	array('key'=>"xsd:string"),
	array('Tweetler'=>"tns:tweetArray"),
	'urn:proje',
	'urn:proje#tweetleriListele',
	'rpc',
	'encoded',
	'tweetleri listeler'


	);


$server->register('kullaniciOlustur',//php deki fonksiyonun adı
	array('k_ad'=>"xsd:string",'pw'=>"xsd:string",'mail'=>"xsd:string"),//parametreleri oluşturur
	array("Mesaj"=>'xsd:string'),//geriye dönen değer
	'urn:proje',//namespace
	'urn:proje#kullaniciOlustur',//operasyon adı
	'rpc',//ne şekilde yollanıcığı
	'encoded',//xml haline getiriyor
	'Kullaniciyi sisteme eklemeye yarayan servis'//
	);

$server->register('favoriEkle',//php deki fonksiyonun adı
	array('key'=>"xsd:string",'tweetID'=>"xsd:integer"),//parametreleri oluşturur
	array("Mesaj"=>'xsd:string'),//geriye dönen değer
	'urn:proje',//namespace
	'urn:proje#favoriEkle',//operasyon adı
	'rpc',//ne şekilde yollanıcığı
	'encoded',//xml haline getiriyor
	'Tweetleri favoriye almaya yarayan '//
	);

$server->register('sifreDegistir',
	array('key'=>"xsd:string",'newPw'=>"xsd:string"),
	array("Mesaj"=>"xsd:string"),
	'urn:proje',
	'urn:proje#sifreDegistir',
	'rpc',
	'encoded',
	'Sifre degistirme operasyonu'

	);
//


$server->register('giris',
		array('k_ad'=>"xsd:string",'pw'=>"xsd:string"),
		array("Kullanici"=>'tns:KullaniciGirisData'),

	'urn:proje',//namespace
	'urn:proje#giris',//operasyon adı
	'rpc',//ne şekilde yollanıcığı
	'encoded',//xml haline getiriyor
	'Kullanicinin sisteme giris yapmasina yarayan servis'//
	);
//

$server->register('tweetAt',
	array('key'=>"xsd:string",'mesaj'=>"xsd:string"),
	array('return'=>"xsd:string"),
	'urn:proje',//namespace
	'urn:proje#tweetAt',//operasyon adı
	'rpc',//ne şekilde yollanıcığı
	'encoded',//xml haline getiriyor
	'Kullanicinin atmasini saglayan yarayan servis'
		);

$server->register('tweetSil',
		array('key'=>"xsd:string",'tweetID'=>"xsd:integer"),
	array('return'=>"xsd:string"),
	'urn:proje',//namespace
	'urn:proje#tweetSil',//operasyon adı
	'rpc',//ne şekilde yollanıcığı
	'encoded',//xml haline getiriyor
	'Kullanicinin tweet silmesini sağlayan operasyon'

	);

$server->register('takipEt',
	array('key'=>"xsd:string",'takipedilen'=>"xsd:string"),
	array('Mesaj'=>"xsd:string"),
	'urn:proje',
	'urn:proje#takipEt',
	'rpc',
	'encoded',
	'Kullanici takip etme servisi'


	);

$server->register('takibiBirak',
	array('key'=>"xsd:string",'takipedilen'=>"xsd:string"),
	array('Mesaj'=>"xsd:string"),
	'urn:proje',
	'urn:proje#takibiBirak',
	'rpc',
	'encoded',
	'Kullanici takibini sona erdiren servis'


	);




$server->service(file_get_contents("php://input"));

?>