<?php 

class VeriTabani{

	public $baglanti;

	function baglantiOlustur()
	{
		if($this->baglanti==null)
		{
			 $this->baglanti=mysqli_connect("localhost","u834088604_burak","ps1oqmaq","u834088604_soa");
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