<?php

echo '<html>';
echo '<head>';
echo '<title>Ultimo enviado</title>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
echo '</head>';


$folder_local = "files/";
$config_file_name = 'config.xml';

$xml_file_in=simplexml_load_file( $folder_local.$config_file_name );
//print_r( $xml_file_in );

echo "<h1>Fecha de envío:</h1>";
echo $xml_file_in[0][ 'dlog' ]."</br>";

echo "<h1>Configuración: </h1>";
echo "Prioridad: <b>".$xml_file_in[0][ 'pr' ]."</b>";
echo "</br>";
echo "Inicio: <b>".$xml_file_in[0][ 'di' ]." ... ".$xml_file_in[0][ 'hi' ]."</b>";
echo "</br>";
echo "Término: <b>".$xml_file_in[0][ 'de' ]." ... ".$xml_file_in[0][ 'he' ]."</b>";
echo "</br>";


echo "<h1>Players:</h1>";
for( $i = 0; $i < count( $xml_file_in->ip ) ; $i++ ) {
  echo $xml_file_in->ip[$i][ 'value' ];
  echo "</br>";
}

echo "</br>";
echo "<h1>Archivos:</h1>";
for( $i = 0; $i < count( $xml_file_in->file ) ; $i++ ) {
  echo "<b>".$xml_file_in->file[$i][ 'name' ]."</b>";
  echo "</br>";
  echo $xml_file_in->file[$i][ 'mds' ];
  echo "</br>";
  echo "</br>";
}

echo '</html>';

?>
