<?php
// ------------------------------------------------
// Controlador que realiza la gestión de usuarios
// ------------------------------------------------
include_once 'config.php';
include_once 'modeloUser.php';
include_once 'funciones.php';

//Registrar nuevo usuario
function ctlUserRegistroUsuario() {
    $user  = "";
    $nombre  = "";
    $clave1   = "";
    $clave2   = "";
    $mail = "";
    $nplan = "";
    $estado = "A";
    $msg = "";
    
    if ( $_SERVER['REQUEST_METHOD'] == "POST"){
        
        if(empty($_POST['user']) || empty($_POST['nombre']) || empty($_POST['clave1']) || empty($_POST['clave2'])||empty($_POST['mail'])||empty($_POST['nplan'])){
            $msg = VACIO;
        }else{
            limpiarArrayEntrada($_POST); //Evito la posible inyecci�n de c�digo
            
            $user  = $_POST['user'];
            $nombre  = $_POST['user'];
            $clave1   = $_POST['user'];
            $clave2   = $_POST['user'];
            $mail = $_POST['user'];
            $nplan= $_POST['user'];
            $estado= "A"; //Vuelvo a asignarlo por si acaso intenta modificarlo en el html
            $msg = comprobarValoresAlta($user, $nombre, $clave1, $clave2, $mail, $nplan);
            
            if($msg == ""){
                if(modeloUserAdd($user, [$clave1, $nombre, $mail, $nplan, $estado])){
                    $msg = "Nuevo Administrador Registrado";
                    header('Refresh:1; Location:index.php?orden=VerUsuarios'.urldecode($msg));
                }else{
                    $msg = "ERROR: No se ha podido completar el registo.";
                }
            }
        }
    }

    include_once 'plantilla/freg.php';
}

/*
 * Inicio Muestra o procesa el formulario (POST)
 */

function  ctlUserInicio(){
    $msg = "";
    $user ="";
    $clave ="";
    if ( $_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_POST['user']) && isset($_POST['clave'])){
            $user = $_POST['user'];
            $clave = $_POST['clave'];
            if ( modeloOkUser($user,$clave)){
                $_SESSION['user'] = $user;
                $_SESSION['tipouser'] = modeloObtenerTipo($user);
                if ( $_SESSION['tipouser'] == 3){
                    $_SESSION['modo'] = GESTIONUSUARIOS;
                    header('Location:index.php?orden=VerUsuarios');
                }
                else {
                  // Usuario normal;
                  // PRIMERA VERSIÓN SOLO USUARIOS ADMISTRADORES
                  $msg="Error: Acceso solo permitido a usuarios Administradores.";
                  unset($_SESSION['user']);
                  // $_SESSION['modo'] = GESTIONFICHEROS;
                  // Cambio de modo y redireccion a verficheros
                }
            }
            else {
                $msg="Error: usuario y contraseña no válidos.";
           }  
        }
    }
    
    include_once 'plantilla/facceso.php';
}

function ctlUserAlta(){
    $user  = "";
    $nombre  = "";
    $clave1   = "";
    $clave2   = "";
    $mail = "";
    $nplan = "";
    $estado = "I";
    $msg = "";
    
    if ( $_SERVER['REQUEST_METHOD'] == "POST"){
        
        if(empty($_POST['user']) || empty($_POST['nombre']) || empty($_POST['clave1']) || empty($_POST['clave2'])||empty($_POST['mail'])||empty($_POST['nplan'])){
            $msg = VACIO;
        }else{
            limpiarArrayEntrada($_POST); //Evito la posible inyecci�n de c�digo
            
            $user  = $_POST['user'];
            $nombre  = $_POST['user'];
            $clave1   = $_POST['user'];
            $clave2   = $_POST['user'];
            $mail = $_POST['user'];
            $nplan= $_POST['user'];
            $estado= "I"; //Vuelvo a asignarlo por si acaso intenta modificarlo en el html
            $msg = comprobarValoresAlta($user, $nombre, $clave1, $clave2, $mail, $nplan);
            
            if($msg == ""){
                if(modeloUserAdd($user, [$clave1, $nombre, $mail, $nplan, $estado])){
                    $msg = "Nuevo Usuario Registrado";
                    header('Refresh:1; Location:index.php?orden=VerUsuarios'.urldecode($msg));
                }else{
                    $msg = "ERROR: No se ha podido completar el registo.";
                }
            }
        }
    }
    
    include_once 'plantilla/fnuevo.php';
}

function ctlUserDetalles(){
    
    $user = $_GET['id'];
    $datosusuario = modeloUserGet($user);
    $clave = $datosusuario[0];
    $nombre = $datosusuario[1];
    $mail = $datosusuario[2];
    $nplan= PLANES[$datosusuario[3]];
    $estado= ESTADOS[$datosusuario[4]];
    
    include_once 'plantilla/fdetalles.php';
    
}

function ctlUserModificar(){
    
    if ( $_SERVER['REQUEST_METHOD'] == "GET"){
        $datosusuario = modeloUserGet($_GET['id']);
        
        $user = $_GET['id'];
        $nombre = $datosusuario[0];
        $clave1 = $datosusuario[1];
        $clave2 = $datosusuario[1];
        $mail = $datosusuario[2];
        $nplan= $datosusuario[3];
        $estado= $datosusuario[4];
    }
    
    if ( $_SERVER['REQUEST_METHOD'] == "POST"){
        
        if(empty($_POST['user']) || empty($_POST['nombre']) || empty($_POST['clave1']) || empty($_POST['clave2'])||empty($_POST['mail'])||empty($_POST['nplan'])){
            $msg = VACIO;
        }else{
            limpiarArrayEntrada($_POST); //Evito la posible inyecci�n de c�digo
            
            $user  = $_POST['user'];
            $nombre  = $_POST['user'];
            $clave1   = $_POST['user'];
            $clave2   = $_POST['user'];
            $mail = $_POST['user'];
            $nplan= $_POST['user'];
            $estado= "I"; //Vuelvo a asignarlo por si acaso intenta modificarlo en el html
            $msg = comprobarValoresModificar($nombre, $clave1, $clave2, $mail, $nplan);
            
            if($msg == ""){
                if(modeloUserUpdate($user, [$clave1, $nombre, $mail, $nplan, $estado])){
                    $msg = "Datos Actualizados";
                    header('Location:index.php?orden=VerUsuarios'.urldecode($msg));
                }else{
                    $msg = "ERROR: No se ha podido completar el registo.";
                }
            }
        }
    }
    
  include_once 'plantilla/fmod.php';
    
}

function ctlUserBorrar(){
    $user = $_GET['id'];
    modeloUserDel($user);
}

// Cierra la sesión y vuelva los datos
function ctlUserCerrar(){
    session_destroy();
    modeloUserSave();
    header('Location:index.php');
}

// Muestro la tabla con los usuario 
function ctlUserVerUsuarios (){
    // Obtengo los datos del modelo
    $usuarios = modeloUserGetAll(); 
    // Invoco la vista 
    include_once 'plantilla/verusuariosp.php';
   
}