<?php 

class VeriTabani{

	public $baglanti;

	function baglantiOlustur()
	{
		if($this->baglanti==null)
		{
			 $this->baglanti=mysqli_connect("localhost","root"," ","u834088604_soa");
		}

		else
		{
			return $this->baglanti;
		}

	}

	function baglantiKapat()
	{
		mysqli_close($this->baglanti);
	}
}

$vt=new VeriTabani();






?>