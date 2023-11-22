<?php
//Definir constantes de utilidad
define( 'SITE_DDBB', 'localhost');
define( 'ADMIN_USER', 'root');
define( 'ADMIN_PASSWORD', 'root');
define( 'DATABASE_NAME', 'moviesite');
define( 'URL', $_SERVER['REQUEST_URI']);
define( 'URL_SITE', "http://localhost:8080/VelezBeatrizDeberes/");
define( 'URL_RETURN', "http://localhost:8080/VelezBeatrizDeberes/index.php");


//Conexión a la BBDD
$bbdd = @new mysqli(SITE_DDBB, ADMIN_USER, ADMIN_PASSWORD, DATABASE_NAME);

    if($bbdd->connect_errno){
        die('Error de Connexión número ' . $bbdd->connect_errno . ', ' . $bbdd->connect_error);
    } else {
        ?>
            <!-- <p>¡Connexión establecida con éxito, navega a tu gusto!</p> -->
        <?php
        require('includes.php');
    }

?>