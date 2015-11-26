<?php

$cartella='Files';

session_start();

function estraiEstensione($filename,$conta) 
{
	$retValue;
	$ext = explode(".", $filename);
	if(count($ext)>$conta)
	{
		$retValue = $ext[$conta];  
	}
	else
	{
		$retValue = "0";
	}
	
	
	return $retValue;
}

if($handle = opendir($cartella))
{
	while (($file = readdir($handle))!==false)
	{
		if ($file != "." && $file != "..")
		{
			$elencoFile[] = $file;
		} 
	}
	closedir($handle);
}
							
$conta=$_POST['contatore'];
$nomeCumulativo=$_POST['nomeCumulativo'];
$riferimento = implode($_POST['select']);
//echo $riferimento;
$elementi = array();

//caricamento primo indice = parametro seleect

$_SESSION['elementi']=$elementi;
$_SESSION['conta']=$conta;
$_SESSION['nomeCumulativo']=$nomeCumulativo;
$_SESSION['riferimento']=$riferimento;

if(strcmp($nomeCumulativo,"")!=0)
{
	$nomeCumulativo=$nomeCumulativo.".".$riferimento;
}
else
{
	$nomeCumulativo=$riferimento;
}
$sez=array();
$j=0;

if(strcmp($riferimento,"pdf")!=0)
{
foreach($elencoFile as $file)
{
		if(strcmp($riferimento,estraiEstensione($file,$conta))==0)
		{
			$sez[$j] = estraiEstensione($file,$conta+1);
			$j++;
		}
}
$conta++;
//$stringaS;
$stringaS = "<form class=\"form-group\" id=\"form$conta\" method=\"POST\">";
$stringaS = $stringaS."<select class=\"form-control\" name=\"select[]\" onchange='iclick(contatore.value)'>";
$sez = array_unique($sez);
$stringaS = $stringaS."<option selected></option>";
foreach($sez as $sezioni)
{
	$stringaS = $stringaS."<option value=\"$sezioni\">$sezioni</option>";
}

$stringaS= $stringaS."</select>";
$stringaS= $stringaS."<input type=\"hidden\" name=\"contatore\" value=$conta></input>";
$stringaS= $stringaS."<input name=\"nomeCumulativo\" type=\"hidden\" value=\"$nomeCumulativo\"></input>";
$stringaS= $stringaS."</form>";

echo $stringaS;
}







?>
