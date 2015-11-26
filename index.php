<!DOCTYPE HTML>
<html>
	<head>
		<title>Firme_Morfometriche</title>
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		
		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		
		<script type="text/javascript">
			var numForm;
                        var numFormRem=0;
                        var conta =0;
                        var formRemove="";
                        var i;
			var form;//="#form"+numForm;
			var link="http://localhost/esercizi/firme-morfometriche/server.php";

			function iclick(numForm){
						console.log(numForm);
                                                
                                                if(conta == numForm){
                                                    conta ++;
                                                }
                                               else
                                                {
                                                    console.log("_________________________________________________________________");
                                                    console.log("Conta: "+conta);
                                                    console.log("Numero Form: "+numForm);
                                                    numFormRem=numForm
                                                    i=++numFormRem;
                                                    console.log("Valore indice: "+i);
                                                    console.log(numForm);
                                                    while(i<=conta)
                                                    {
                                                  
                                                        formRemove="#form"+i;
                                                        console.log(formRemove+" Rimosso");
                                                        $(formRemove).remove();
                                                        i++;
                                                        
                                                    }
                                                    conta=numForm+1;;
                                                }
                                                console.log(numForm);
                                                 //conta ++;
                                                console.log("Parametro PHP:"+form);
                                                form ="#form"+numForm;
                                                //console.log("Parametro passare: "+numForm);
                                                console.log(form);
						dati = $(form).serialize();
                                                console.log(dati);
						
						
						$.ajax({
						  //Type of Ajax call (GET).
						  type: "POST",
						  //URL of the php resource, that generate the data of the chart.
						  url: link,
						  timeout:5000,
						  data: dati,
						  success: function(response)
						  {
							    console.log(dati);
								$("#forms").append(response);
						},
						error: function(){
							//If there are some problems with the Ajax call a message error will be generated.
							alert("Si e' verificato un errore con la chiamata Ajax, impossibile trovare file!");
						},
					});
				};
                                
                    
		</script>
		
		<style type="text/css">
			h3{
				text-align:center;
			}
		</style>
	</head>
	<body>
		<div class="col-md-4">
		</div>
		
		<div class="col-md-4" id="forms">
			<h3>PROVA FIRME MORFOMETRICHE</h3>
			<form class="form-group" id="form0">
		
			<select class="form-control" name="select[]" onchange='iclick(contatore.value)'>
				<option value=""/>
				<?php
					$cartella='Files';
					function estraiEstensione($filename,$conta) 
					{
						$ext = explode(".", $filename);
						return $ext[$conta];  
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
					
					$conta=0;//$conta=$_POST['contatore'];
					$riferimento='xxx';//$riferimento = implode($_POST['selezione']);
					$sez=array();
					$j=0;

					foreach($elencoFile as $file)
					{
							$sez[$j] = estraiEstensione($file,0);
							$j++;
					}
					
					$sez = array_unique($sez);
					foreach($sez as $sezioni)
					{
						echo ("<option value=\"$sezioni\">$sezioni</option>");
					}
				echo("</select>");
				
				echo("<input name=\"contatore\" type=\"hidden\" value=\"$conta\"></input>");
				echo("<input name=\"nomeCumulativo\" type=\"hidden\" value=\"\"></input>");
				$conta++;
					
								
				?>
			
		</form>
		
		</div>
		
		
		
	</body>
</html>
