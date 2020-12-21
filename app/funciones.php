<?php

function comprobarValoresModificar($nombre, $clave1, $clave2, $mail, $nplan){
    $msg = "";
    
    if($clave1 == $clave2){
        if(comprobarContra($clave1)){
        }else{
            $msg = "ERROR: Contraseña inválida";
        }
    }else{
        $msg = "ERROR: Las contraseñas no coinciden";
    }
    
    if(1 === preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $mail)){
    }else{
        $msg = "ERROR: Formato de correo inválido";
    }
    
    if($nplan < 0 || $nplan > 3 ){
        $msg = "ERROR: Ese tipo de plan se encuentra disponible.";
    }
    
    return $msg;
}


function comprobarValoresAlta($user, $nombre, $clave1, $clave2, $mail, $nplan){
    $msg = "";
    
    if(strlen($user) >= 5 && strlen($user) <= 10 && !comprobarUsuario($user)){
    }else{
        $msg = "ERROR: Usuario no válido";
    }
    
    if($clave1 == $clave2){
        if(comprobarContra($clave1)){
        }else{
            $msg = "ERROR: Contraseña inválida";
        }
    }else{
        $msg = "ERROR: Las contraseñas no coinciden";
    }
    /*
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $msg = "ERROR: Formato de correo inválido";
    }
    */
    if($nplan < 0 || $nplan > 3 ){
        $msg = "ERROR: Ese tipo de plan no se encuentra disponible.";
    }
    
    return $msg;
}
    
function comprobarUsuario($user){
    if (isset($_SESSION['tusuarios'][$user])){
        return true;
    }else{
        return false;
    }
}

function comprobarContra($clave){
    return (estaVacio($clave) && longitud($clave) && hayMayusculas($clave) && hayMinusculas($clave) && hayDigito($clave) && hayNoAlfanumerico($clave));
}

function estaVacio ($valor) {
    return !empty(trim($valor));
}

function longitud ($valor) {
    return (strlen($valor) >= 8 && strlen($valor) <= 15);
}

function hayMayusculas ($valor){
    for ($i=0; $i<strlen($valor); $i++){
        if ( ctype_upper($valor[$i]) )
            return true;
    }
    return false;
}

function hayMinusculas ($valor){
    for ($i=0; $i<strlen($valor); $i++){
        if ( ctype_lower($valor[$i]))
            return true;
    }
    return false;
}

function hayDigito ($valor){
    for ($i=0; $i<strlen($valor); $i++){
        if ( ctype_digit($valor[$i]) )
            return true;
    }
    return false;
}

function hayNoAlfanumerico ($valor){
    for ($i=0; $i<strlen($valor); $i++){
        if ( !ctype_alnum($valor[$i]) )
            return true;
    }
    return false;
}

function limpiarEntrada(string $entrada):string{
    $salida = trim($entrada); // Elimina espacios antes y después de los datos
    $salida = stripslashes($salida); // Elimina backslashes \
    $salida = htmlspecialchars($salida); // Traduce caracteres especiales en entidades HTML
    return $salida;
}
// Función para limpiar todos elementos de un array
function limpiarArrayEntrada(array &$entrada){
    
    foreach ($entrada as $key => $value ) {
        $entrada[$key] = limpiarEntrada($value);
    }
}