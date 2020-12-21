<?php
session_start();
include_once 'app/config.php';
include_once 'app/controlerFile.php';
include_once 'app/controlerUser.php';
include_once 'app/modeloUser.php';

// Inicializo el modelo
modeloUserInit();

// Enrutamiento
// Relaci�n entre peticiones y funci�n que la va a tratar
// Versi�n sin POO no manejo de Clases ni objetos
$rutasUser = [
    "Inicio"      => "ctlUserInicio",
    "Alta"        => "ctlUserAlta",
    "Detalles"    => "ctlUserDetalles",
    "Modificar"   => "ctlUserModificar",
    "Borrar"      => "ctlUserBorrar",
    "Cerrar"      => "ctlUserCerrar",
    "VerUsuarios" => "ctlUserVerUsuarios"
];
// Si no hay usuario a Inicio
if (!isset($_SESSION['user'])){
    //Dar de alta nuevo usuario
    if(isset($_GET['orden']) && $_GET['orden'] == "Alta"){
        $procRuta = "ctlUserAlta";
    }else{
        $procRuta = "ctlUserInicio";
    }
    
} else {
    if ( $_SESSION['modo'] == GESTIONUSUARIOS){
        if (isset($_GET['orden'])){
            // La orden tiene una funcion asociada 
            if ( isset ($rutasUser[$_GET['orden']]) ){
                $procRuta =  $rutasUser[$_GET['orden']];
            }
            else {
                // Error no existe función para la ruta
                header('Status: 404 Not Found');
                echo '<html><body><h1>Error 404: No existe la ruta <i>' .
                    $_GET['ctl'] .
                    '</p></body></html>';
                    exit;
            }
        }
        else {
            $procRuta = "ctlUserVerUsuarios";
        }
    }
    // Usuario Normal PRIMERA VERSION SIN ACCIONES
    else {
       $procRuta= "ctlUserInicio";    
    }
}

// Llamo a la función seleccionada
$procRuta();




