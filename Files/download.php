<?php
// definisco una variabile con il percorso alla cartella
// in cui sono archiviati i file
$dir = "Files/";



// Recupero il nome del file dalla querystring
// e lo accodo al percorso della cartella del download
$file = $_POST['filename'];

/*
// controllo la sintassi del file richiesto
if (!preg_match('/^[a-z0-9]+\.[a-z]{2,3}$/i',$fn)) {
  $fn = false;
}else{
	*/
  $file = $dir . $file;  
//}

//echo ($file);

  
// verifico che il file esista
if (!file_exists($file))
{
  // se non esiste stampo un errore
  echo "Il file non esiste!";
}else{
  // Se il file esiste...
  // Imposto gli header della pagina per forzare il download del file
  header("Cache-Control: public");
  header("Content-Description: File Transfer");
  header("Content-Disposition: attachment; filename= " . $file);
  header("Content-Transfer-Encoding: binary");
  // Leggo il contenuto del file
  readfile($file);
}

?>