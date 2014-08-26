<?php

$server_ssh_folder = '/var/www/contenido_especial/';
$server_ssh_user = 'root';
$server_ssh_pass = '123qwe';
$ip_folder = "192.168.6.10";

$folder_local = "files/";
$config_file = '/home/vertice/urgent/sysUrgent/config.xml';
$config_file2 = '/home/vertice/urgent/tmpUrgent/spvUpdate.log';

echo '<html>';
echo '<head>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
echo '<title>Consulta config/player.</title>';

echo '<script type="text/javascript" src="validar_forma.js"></script>';
echo '<link rel="stylesheet" type="text/css" href="css/style.css" />';
echo '<div id="page-wrap" >';

echo '<textarea id="header">LISTA DE CONTENIDO --- (192.168.6.10)</textarea>';
echo '<div id="logo">';
echo '<img id="image" src="logo.jpg" alt="logo" />';
echo '</div>';

echo '</head>';
echo '<body>';

echo '<div style="height:650px;width:520px;border:5px solid #346;font:16px/26px Georgia, Garamond, Serif;overflow:auto;" id="lista-players">';
echo '</br>';
echo '<center><h3>SELECCIONAR ELEMENTOS</h3></center>';
echo '</br>';
echo '<input type="checkbox" onclick="marcar(this);" /><b>Seleccionar todos</b></br>';

echo '</br>';


/*
$fp = fopen( '/home/data.txt', 'w' );
fwrite( $fp, "a\n" );
fwrite( $fp, "bc\n\n\n" );
fclose( $fp );
*/

$file_2 = fopen("/home/repository/v4_edificios/repositorio/192.168.6.10/server.lst", "r") or exit("Unable to open file!");
//Output a line of the file until the end is reached
$renglones = 0;
while(!feof($file_2)) {
  $contador = 0;
  $cadena = fgets($file_2);
  echo '<input type="checkbox" name="renglones" value="'.$renglones++.'" >';
  for($i=0; $i < strlen($cadena); $i++) {
    if( $cadena[$i] == ',' )
      $contador++;
    if( $contador == 6 )
      break;
    if( $contador == 5 )
      echo $cadena[$i+1];
  }
  echo '</br>';
  //    echo fgets($file_2). "<br/>";
}

fclose($file_2);

echo '</div>';
echo '<input id="boton3" type="button" onclick="validate()" value="Enviar">';
echo '</body>';
echo '</html>';
?>