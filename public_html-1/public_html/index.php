<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title> SOA PROJE</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <script>
 wsUrl = "http://soaproject.tk/servisler.php?wsdl";

</script>





</head>
<body>

<div class="container">
<div class="page-header">
<h1>SOA PROJECT-Örnek Client </h1>
</div>
	<div class="row" id="giris-menu">
		<div class="col-md-5 ">
			<div class="panel panel-default">
				<div class="panel-heading">
					Üyelik
				</div>

				<div class="panel-body">
				<form class="form">
					<div class="form-group">
						<label for="kullaniciAdi">Kullanıcı Adı </label>
						<input class="form-control" type="text" id="kullaniciAdi" placeholder="Kullanıcı adınızı giriniz" required>
					</div>

					<div class="form-group">
						<label for="mail">Mail</label>
						<input class="form-control" type="text" id="mail" placeholder="Mail adresinizi giriniz" required>
					</div>

					<div class="form-group">
						<label for="sifre">Şifre </label>
						<input class="form-control" type="password" id="sifre" placeholder="Şifrenizi giriniz" required>
					</div>

					<div class="form-group">
						<label for="sifre-onay">Şifre Onay </label>
						<input class="form-control" type="password" id="sifre-onay" placeholder="Şifrenizi onaylayınız" required>
					</div>

				</form>

				<button type="button" class="btn btn-primary" id="uyeOlBtn">Kayıt Ol </button>
				<div id="uyari" class="alert alert-warning">
	  				<strong>Uyarı!</strong> <p id="uyari-mesaji"> </p>
				</div>
				<p id="response"> </p>
				</div>
			</div>
		</div>

		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading">
					Giriş
				</div>

				<div class="panel-body">
					<form class="form" id="giris-form">
						<div class="form-group">
							<label for="kullaniciAdiGiris">Kullanıcı Adı </label>
							<input class="form-control" name="kullaniciAdi" type="text" id="kullaniciAdiGiris" placeholder="Kullaıcı adınızı giriniz">

						</div>

						<div class="form-group">
							<label for="sifreGiris">Şifre </label>
							<input class="form-control" name="sifre" type="password" id="sifreGiris" placeholder="Şifre giriniz">
						</div>
					</form>
					<button type="button" class="btn btn-danger" id="girisBtn">Giriş </button>
					<div class="alert alert-success" id="giris-alert">
					  <strong>Giriş Başarılı!</strong> 
					</div>
				</div>

			</div>

		</div>
	</div>
	<div id="kullanici-bolum"   style="display:none;">
	<div class="row" >
		<div class="col-md-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<p id="kAdi"> </p>
					
				</div>
				<div class="panel-body">
					<button class="btn btn-danger" id="cikis-btn">Çıkış </button>
					<button type="button" class="btn btn-info " data-toggle="modal" data-target="#sifreBolum">Şifre Değiştir </button>
					<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#keyBolum">KEY </button>
				</div>
			</div>
		</div>
		<div class="col-md-5">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="form-group" id="tweet-input-div">
							<label for="tweet-input"> Mesajınız </label>
							<input type="text" id="tweet-input" placeholder="Mesajınızı buraya giriniz.." class="form-control">
							<button type="button" id="tweet-yolla" class="btn btn-primary">Gönder </button>
						</div>
					</div>
					
				</div>
		</div>
		<div class="col-md-5">
		<!--takip etme arama bölümü -->
		</div>
	


	</div>

		<div class="row">
			<div class="col-md-3">
			<div id="kullanicilar">

			</div>
			</div>

			<div class="col-md-5">
				<div class="panel panel-default" id="tweet-panel">
				<p id="tweet-durum"></p>
					
				</div>
			</div>
		</div>
	</div>

	<div id="sifreBolum" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Şifre Değiştir</h4>
      </div>
      <div class="modal-body">
      <form class="form">
	        <div class="form-group">
		        <label for="yeni-sifre">Yeni Şifre </label>
		        <input id="yeni-sifre" type="password" class="form-control">
	        </div>
	        <div class="form-group">
		        <label for="yeni-sifre-confirm">Tekrar giriniz </label>
		        <input id="yeni-sifre-confirm" type="password" class="form-control">
	        </div>

	        
        </form>
      </div>
      <div class="modal-footer">
      <button class="btn type="button" id="confirm-pwchange">Onayla</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Çıkış</button>
      </div>
    </div>

  </div>

</div>
	<div id="keyBolum" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">KEY</h4>
      </div>
      <div class="modal-body">
      <form class="form">
	        <div class="form-group">
		        <label for="key-input">KEY </label>
		        <input id="key-input" type="input" class="form-control">
	        </div>
   
        </form>
      </div>
      <div class="modal-footer">
      
        <button type="button" class="btn btn-default" data-dismiss="modal">Çıkış</button>
      </div>
    </div>

  </div>
  
</div>

	</div>
</div>
<script>
wsUrl = "http://soaproject.tk/servisler.php?wsdl";
isLogin=false;
 function kullaniciOlusturmaCagri()
{


var kullaniciAdi=$("#kullaniciAdi").val();
var sifre=$("#sifre").val();
var sifreonay=$("#sifre-onay").val();
var mail=$("#mail").val();

if(sifre==sifreonay)
{
	

		$("#uyari").show();
		$("#uyari").attr("class","alert alert-success");
		
		soapRequest= 
		'<? echo '<?xml version="1.0" encoding="UTF-8" ?> ' ; ?> <SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="urn:proje" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"> <SOAP-ENV:Body> <ns1:kullaniciOlustur> <k_ad xsi:type="xsd:string">'+kullaniciAdi+'</k_ad> <pw xsi:type="xsd:string">'+sifre+'</pw> <mail xsi:type="xsd:string">'+mail+'</mail> </ns1:kullaniciOlustur> </SOAP-ENV:Body> </SOAP-ENV:Envelope>';
            

                $.ajax({
                    type: "POST",//servise yolluycaz
                    url: wsUrl,//wsdl in konumu
                    contentType: "text/xml",//wsdlin içerği
                    dataType: "xml",//wsdlin türü
                    data: soapRequest,//zarfın içeriği
                    success: processSuccess,
                    error: processError
                });

        function processSuccess(data, status, req) {
            if (status == "success")
                $("#uyari-mesaji").text($(req.responseXML).find("Mesaj").text());
        }

        function processError(data, status, req) {
            alert(req.responseText + " " + status);
        }  

}
else
{
	$("#uyari").show();
	$("#uyari-mesaji").text("Lütfen şifrenizi onaylayınız.");
}
}

function sifreDegistirmeServisi(key,newPw)
{

var sifre=$("#yeni-sifre").val();
var sifre_conf=$("#yeni-sifre-confirm").val();
	if(sifre==sifre_conf)
	{
		var soapRequest='<? echo '<?xml version="1.0" encoding="UTF-8" ?> ' ; ?><SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="urn:proje" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"><SOAP-ENV:Body><ns1:sifreDegistir><key xsi:type="xsd:string">'+authKey+'</key><newPw xsi:type="xsd:string">'+sifre+'</newPw></ns1:sifreDegistir></SOAP-ENV:Body></SOAP-ENV:Envelope>';


                $.ajax({
                    type: "POST",//servise yolluycaz
                    url: wsUrl,//wsdl in konumu
                    contentType: "text/xml",//wsdlin içerği
                    dataType: "xml",//wsdlin türü
                    data: soapRequest,//zarfın içeriği
                    success: processSuccess,
                    error: processError
                });

        function processSuccess(data, status, req) {
            if (status == "success")
                alert("başarılı");
        }

        function processError(data, status, req) {
            alert(req.responseText + " " + status);
        }  

	


	}

}

function favorilereEkle(tweetID)
{
var soapRequest='<? echo '<?xml version="1.0" encoding="UTF-8" ?> ' ; ?><SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="urn:proje" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"><SOAP-ENV:Body><ns1:favoriEkle><key xsi:type="xsd:string">'+authKey+'</key><tweetID xsi:type="xsd:integer">'+tweetID+'</tweetID></ns1:favoriEkle></SOAP-ENV:Body></SOAP-ENV:Envelope>';

$.ajax({
                    type: "POST",//servise yolluycaz
                    url: wsUrl,//wsdl in konumu
                    contentType: "text/xml",//wsdlin içerği
                    dataType: "xml",//wsdlin türü
                    data: soapRequest,//zarfın içeriği
                    success: processSuccess,
                    error: processError
                });

        function processSuccess(data, status, req) {
            if (status == "success")
            {
            	alert("Favoriye Alındı");
            }
            
	
                 
                
        }

        function processError(data, status, req) {
            alert(req.responseText + " " + status);
        }  

}
function kullaniciListele()
{
var soapRequest='<? echo '<?xml version="1.0" encoding="UTF-8" ?> ' ; ?><SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="urn:proje" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"><SOAP-ENV:Body><ns1:onerilenKullanicilariListele><key xsi:type="xsd:string">'+authKey+'</key></ns1:onerilenKullanicilariListele></SOAP-ENV:Body></SOAP-ENV:Envelope>';
$.ajax({
                    type: "POST",//servise yolluycaz
                    url: wsUrl,//wsdl in konumu
                    contentType: "text/xml",//wsdlin içerği
                    dataType: "xml",//wsdlin türü
                    data: soapRequest,//zarfın içeriği
                    success: processSuccess,
                    error: processError
                });

        function processSuccess(data, status, req) {
        	
            if (status == "success")
                $('item', req.responseXML).each(function(){

                    kullaniciID = $('kullaniciID', this).text();
                     kullaniciAd = $('kullaniciAd', this).text();
                     durum=$('takipDurumu',this).text();
                     
                    // butn=$('<button  type="button"  class="btn">Favorilere Ekle</button>').click(function () { favorilereEkle(id);$(this).attr('disabled',true); })
                     html2='<div class="panel-heading"><b>'+kullaniciAd+'</b></div>';
                     if(durum=="true")
                     {
                     	html2+=' <button class="btn btn-danger unfollow" id="'+kullaniciAd+'"> Takibi Bırak </button> ';
                     } 
                     else
                     {
                     	html2+=' <button class="btn btn-primary follow" id="'+kullaniciAd+'"> Takip et</button> ';
                     }
                     //pointid="#fav-bol"+String(id);
                  
                     $("#kullanicilar").append(html2);
                       //$(pointid).append(butn);
                       	         $('.unfollow').each(function(index){
						$(this).on("click", function(){
		       					 takibiBirak($(this).attr('id'));
		     
		      
		    	});
            });
                    $('.follow').each(function(index){
						$(this).on("click", function(){
		       					 takipEt($(this).attr('id'));
		     
		      
		    	});
            });
                });


        }

        function processError(data, status, req) {
            alert(req.responseText + " " + status);
        }  




}

function tweetleriAl()
{
var soapRequest='<? echo '<?xml version="1.0" encoding="UTF-8" ?> ' ; ?><SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="urn:proje" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"><SOAP-ENV:Body><ns1:tweetleriListele><key xsi:type="xsd:string">'+authKey+'</key></ns1:tweetleriListele></SOAP-ENV:Body></SOAP-ENV:Envelope>';
$.ajax({
                    type: "POST",//servise yolluycaz
                    url: wsUrl,//wsdl in konumu
                    contentType: "text/xml",//wsdlin içerği
                    dataType: "xml",//wsdlin türü
                    data: soapRequest,//zarfın içeriği
                    success: processSuccess,
                    error: processError
                });

        function processSuccess(data, status, req) {
        	i=0;
            if (status == "success")
                $('item', req.responseXML).each(function(){

                    kullaniciAd = $('KullaniciAdi', this).text();
                     icerik = $('Mesaj', this).text();
                     id=$('tweetID',this).text();
                     if(i==0)
                		sontweetid=id;
                     butn=$('<button  type="button" id="'+id+'"   class="btn fav-btn">Favorilere Ekle</button>');

                     butn2=$('<button  type="button" id="'+id+'"   class="btn btn-danger  pull-right sil-btn">Sil</button>');
                    
                     html='<div class="panel-heading"><b>'+kullaniciAd+'</b></div>  <div class="panel-body">'+icerik+' </div> <div class="panel-footer "id="fav-bol'+id+'"> </div>';
                     pointid="#fav-bol"+String(id);
                  
                     $("#tweet-panel").append(html);
                       $(pointid).append(butn);
                       if(kullaniciGirisAdi==kullaniciAd)
                       {
                       	$(pointid).append(butn2);
                       }
				 
					
					
					i+=1;
					
					
				
					
                 
                });
   $('.sil-btn').each(function(index){
 $(this).on("click", function(){
		        // For the boolean value
		       tweetSil(parseInt($(this).attr("id")));
		        // For the mammal value
		      
		    	});
            });

            $('.fav-btn').each(function(index){
 $(this).on("click", function(){
		        // For the boolean value
		        favorilereEkle(parseInt($(this).attr('id')));
		        // For the mammal value
		      
		    	});
            });
        }

        function processError(data, status, req) {
            alert(req.responseText + " " + status);
        }  




}
function tweetSil(tweetID)
{

var soapRequest='<? echo '<?xml version="1.0" encoding="UTF-8" ?> ' ; ?><SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="urn:proje" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"><SOAP-ENV:Body><ns1:tweetSil><key xsi:type="xsd:string">'+authKey+'</key><tweetID xsi:type="xsd:integer">'+tweetID+'</tweetID></ns1:tweetSil></SOAP-ENV:Body></SOAP-ENV:Envelope>';


                $.ajax({
                    type: "POST",//servise yolluycaz
                    url: wsUrl,//wsdl in konumu
                    contentType: "text/xml",//wsdlin içerği
                    dataType: "xml",//wsdlin türü
                    data: soapRequest,//zarfın içeriği
                    success: processSuccess,
                    error: processError
                });

        function processSuccess(data, status, req) {
            if (status == "success")
                alert("tweet silindi");
        }

        function processError(data, status, req) {
            alert(req.responseText + " " + status);
        }  


}
function yeniTweetler(key,lasttweetID)
{

	var datastring="key="+key+"&lasttweet="+parseInt(lasttweetID);
 $.ajax({
                    type: "POST",
                    url: "new.php",      
                    data: datastring,
                    success:function(response){
                    	if(response!=null)
                    	{
                    		$("#tweet-durum").html(response);
                    	}
                    	else
                    	{
                    		
                    	}

                    }
                    
                });


}
function GirisServisiCagri(k_ad,sifre)
{
 kullaniciGirisAdi=k_ad;
var kullaniciGirisSifre=sifre;

if(kullaniciGirisSifre!=null && kullaniciGirisSifre!=null)
{
	 
		$("#uyari").attr("class","alert alert-success");
	var soapRequest='<? echo '<?xml version="1.0" encoding="UTF-8" ?> ' ; ?> <SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="urn:proje" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"><SOAP-ENV:Body><ns1:giris><k_ad xsi:type="xsd:string">'+kullaniciGirisAdi+'</k_ad><pw xsi:type="xsd:string">'+kullaniciGirisSifre+'</pw></ns1:giris></SOAP-ENV:Body></SOAP-ENV:Envelope>';
 $.ajax({
                    type: "POST",//servise yolluycaz
                    url: wsUrl,//wsdl in konumu
                    contentType: "text/xml",//wsdlin içerği
                    dataType: "xml",//wsdlin türü
                    data: soapRequest,//zarfın içeriği
                    success: processSuccess,
                    error: processError
                });

        function processSuccess(data, status, req) {
            if (status == "success")
            {
                
                isLogin=$(req.responseXML).find("Mesaj").text();
                if(isLogin=="true")
                {
                	authKey=$(req.responseXML).find("key").text();
                	$("#giris-alert").html("<strong>Giriş Başarılı!</strong> ")
                	$("#giris-alert").show(400,function(){
                			$("#giris-menu").slideUp(500);
                			$("#kullanici-bolum").slideDown(500);
                			$("#kAdi").text(kullaniciGirisAdi);
                	var datastring="k_adi="+kullaniciGirisAdi+"&sifre="+kullaniciGirisSifre;
                	tweetleriAl(authKey);
                	kullaniciListele();
                	$("#key-input").val(authKey);


                	 $.ajax({
                    type: "POST",//servise yolluycaz
                    url: "giris.php",//wsdl in konumu         
                    data: datastring,//zarfın içeriği
                    
                });
                	});
                	
                	
                }
                else
                {
                	$("#giris-alert").show();
                	$("#giris-alert").html("<strong>Hata!</strong> ")
                }
            }
        }

        function processError(data, status, req) {
            alert("Kullanıcı Bulunamadı");
        }  

}
}

function takipEt(kullaniciAdi)
{

		var soapRequest='<? echo '<?xml version="1.0" encoding="UTF-8" ?> ' ; ?><SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="urn:proje" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"><SOAP-ENV:Body><ns1:takipEt><key xsi:type="xsd:string">'+authKey+'</key><takipedilen xsi:type="xsd:string">'+kullaniciAdi+'</takipedilen></ns1:takipEt></SOAP-ENV:Body></SOAP-ENV:Envelope>';

		$.ajax({
   type: "POST",//servise yolluycaz
                    url: wsUrl,//wsdl in konumu
                    contentType: "text/xml",//wsdlin içerği
                    dataType: "xml",//wsdlin türü
                    data: soapRequest,//zarfın içeriği
                    success: processSuccess,
                    error: processError

		});

		  function processSuccess(data, status, req) {
            if (status == "success")
                $("#"+kullaniciAdi).attr("class","btn btn-danger unfollow");
            $("#"+kullaniciAdi).text("Takibi Bırak");
          
        }

        function processError(data, status, req) {
            alert(req.responseText + " " + status);
        } 



}

function takibiBirak(kullaniciAdi)
{

		var soapRequest='<? echo '<?xml version="1.0" encoding="UTF-8" ?> ' ; ?><SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="urn:proje" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"><SOAP-ENV:Body><ns1:takibiBirak><key xsi:type="xsd:string">'+authKey+'</key><takipedilen xsi:type="xsd:string">'+kullaniciAdi+'</takipedilen></ns1:takibiBirak></SOAP-ENV:Body></SOAP-ENV:Envelope>';

		$.ajax({
   type: "POST",//servise yolluycaz
                    url: wsUrl,//wsdl in konumu
                    contentType: "text/xml",//wsdlin içerği
                    dataType: "xml",//wsdlin türü
                    data: soapRequest,//zarfın içeriği
                    success: processSuccess,
                    error: processError

		});

		  function processSuccess(data, status, req) {
            if (status == "success")
                $("#"+kullaniciAdi).attr("class","btn btn-primary follow");
            $("#"+kullaniciAdi).text("Takip Et");
            
            
        }

        function processError(data, status, req) {
            alert(req.responseText + " " + status);
        } 



}
function tweetGonderServis()
{
	var mesaj=$("#tweet-input").val();
	if(mesaj!=null)
	{
		var soapRequest='<? echo '<?xml version="1.0" encoding="UTF-8" ?> ' ; ?><SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="urn:proje" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"><SOAP-ENV:Body><ns1:tweetAt><key xsi:type="xsd:string">'+authKey+'</key><mesaj xsi:type="xsd:string">'+mesaj+'</mesaj></ns1:tweetAt></SOAP-ENV:Body></SOAP-ENV:Envelope>';


                $.ajax({
                    type: "POST",//servise yolluycaz
                    url: wsUrl,//wsdl in konumu
                    contentType: "text/xml",//wsdlin içerği
                    dataType: "xml",//wsdlin türü
                    data: soapRequest,//zarfın içeriği
                    success: processSuccess,
                    error: processError
                });

        function processSuccess(data, status, req) {
            if (status == "success")
                alert("başarılı");
        }

        function processError(data, status, req) {
            alert(req.responseText + " " + status);
        }  

	


	}

}


$(function()
{
	authKey=null;
	sontweetid=null;
	
	$("#giris-alert").hide();
	$("#kullanici-bolum").hide();
	$("#uyari").hide();
	$("#cikis-btn").click(function(){
		$.ajax({
			type:"POST",
			url:"/cikis.php",
			success:function(data){
					location.reload();
				}
			});
		});


	
$("#uyeOlBtn").click(kullaniciOlusturmaCagri);
$("#girisBtn").click(function(){
	GirisServisiCagri($("#kullaniciAdiGiris").val(),$("#sifreGiris").val());
});
$("#tweet-yolla").click(tweetGonderServis);
$("#confirm-pwchange").click(sifreDegistirmeServisi);

setInterval(function(){ yeniTweetler(authKey,sontweetid); }, 3000);
});



 </script>
<?php 
ini_set('short_open_tag', 0);
session_start();
 if(!empty($_SESSION['k_adi']) && !empty($_SESSION['sifre']))
{
	
	echo '<script>GirisServisiCagri("'.$_SESSION['k_adi'].'","'.$_SESSION['sifre'].'")</script>';
}


?>

</body>

</html>