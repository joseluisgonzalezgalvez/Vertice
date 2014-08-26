<?php

$server_ssh_folder = '/var/www/contenido_especial/';
$server_ssh_user = 'root';
$server_ssh_pass = '123qwe';

$folder_local = "files/";
$config_file = '/home/vertice/urgent/sysUrgent/config.xml';
$config_file2 = '/home/vertice/urgent/tmpUrgent/spvUpdate.log';

echo '<html>';
echo '<head>';
echo '<title>Consulta config/player.</title>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
echo '</head>';


/*
  Establecemos la conexion con cada server
  de donde traeremos el XML de
  configuracion.
*/
$i = 1;
foreach( $_POST[ 'ipsC' ] as $ip_e ) {
  /*  echo '<h3><a href="http://'.$ip_e.'/configuracion_especial/spvUpdate.log">Estado actual del player'.$ip_e.'</a></h3>';*/
  $connection = ssh2_connect( $ip_e, 22);
  if( ssh2_auth_password( $connection, $server_ssh_user, $server_ssh_pass ) ) {
    echo "Se ha establecido la conexion SSH con ".$ip_e;
    /* Traemos el archivo con scp_recv */
    if( ssh2_scp_recv( $connection, $config_file, $folder_local.'configRemote.xml' ) ) {
      echo "<h2>".$i++.". Configuración especial de ".$ip_e.":</h2>";
    
      /* Ahora leemos el archivo recibido */
      $xml_file_in = simplexml_load_file( $folder_local.'configRemote.xml' );  
      
      echo "<h3>Fecha de envío:</h3>";
      echo $xml_file_in[0][ 'dlog' ]."</br>";
      
      echo "<h3>Configuración: </h3>";
      echo "Prioridad: <b>".$xml_file_in[0][ 'pr' ]."</b>";
      echo "</br>";
      echo "Inicio: <b>".$xml_file_in[0][ 'di' ]." ... ".$xml_file_in[0][ 'hi' ]."</b>";
      echo "</br>";
      echo "Término: <b>".$xml_file_in[0][ 'de' ]." ... ".$xml_file_in[0][ 'he' ]."</b>";
      echo "</br>";
      
      echo "<h3>Players:</h3>";
      for( $j = 0; $j < count( $xml_file_in->ip ) ; $j++ ) {
	echo $xml_file_in->ip[$j][ 'value' ];
	echo "</br>";
      }
      
      echo "</br>";
      echo "<h3>Archivos:</h3>";
      for( $k = 0; $k < count( $xml_file_in->file ) ; $k++ ) {
	echo "<b>".$xml_file_in->file[$k][ 'name' ]."</b>";
	echo "</br>";
	echo $xml_file_in->file[$k][ 'mds' ];
	echo "</br>";
	echo "</br>";
      }
    }
    else
      echo "<h2>".$i++.". No fue posible consultar el archivo de configuración del player ".$ip_e."</h2></br>";    
    if( ssh2_scp_recv( $connection, $config_file2, $folder_local.'configRemote.log' ) ) {
      echo "<h2>Estado actual de ".$ip_e.":</h2>";
      $file_2 = fopen("files/configRemote.log", "r") or exit("Unable to open file!");
      //Output a line of the file until the end is reached
      while(!feof($file_2))
	{
	  echo fgets($file_2). "<br />";
	}
      fclose($file);
    }
    else
      echo "<h2>".$i++.". No fue posible consultar el archivo de estado del player ".$ip_e."</h2></br>";    
  }
  else 
    echo "<h2>".$i++.". ERROR, no se pudo establecer la conexion SSH con ".$ip_e."</h2>";
  echo "------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</br>";
  //$i++;
  ssh2_exec( $connection, 'exit' );
}
echo '<html>';
?>