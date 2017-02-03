<?php 
$key=$_POST['key'];
$lasttweet=$_POST['lasttweet'];


$baglanti=mysqli_connect("localhost","u834088604_burak","ps1oqmaq","u834088604_soa");
$keySorgu="select kullaniciID from auth where authKey='".$key."'";
	
	$getKey=mysqli_query($baglanti,$keySorgu);
	$kullaniciID=mysqli_fetch_array($getKey);
	$kullaniciID=$kullaniciID[0];

	if(mysqli_num_rows($getKey)==1)
	{
	
	

		$tweetler=array();
	  $komut="SELECT tweet.tweetID,kullanici.kullaniciAdi,tweet.icerik from tweet inner join kullanici on tweet.kullaniciID=kullanici.kullaniciID and tweet.tweetID>".$lasttweet."  where kullanici.kullaniciID=".$kullaniciID." or kullanici.kullaniciID IN (select takipedilenID from takipci where takipciID=".$kullaniciID.")   ORDER BY tweet.tweetID DESC";
	  $html="";
	  if(mysqli_num_rows($sorgu=mysqli_query($baglanti,$komut))>=1)
	  {
		  	
		  	 while($sonuc=mysqli_fetch_array($sorgu))
		  {
		  	$html.='<div class="panel-heading" style="background-color:#FAA2A2;"><b>'.$sonuc['kullaniciAdi'].'</b></div>  <div class="panel-body">'.$sonuc['icerik'].' </div> <div class="panel-footer "id="fav-bol'.$sonuc['tweetID'].'"> </div>';
		 


		  }

	 
	  }
	 echo $html;

		
	}

	mysqli_close($baglanti);





?>