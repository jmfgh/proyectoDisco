<?php

// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
// FORMULARIO DE ALTA DE USUARIOS
?>
<div id='aviso'><b><?= (isset($msg))?$msg:"" ?></b></div>
<form name='ALTA' method="POST" action="index.php?orden=Alta">
      ID: <input type="text" name="user" size="10"><br>
      Nombre: <input type="text" name="nombre" size="25"><br>
      Contraseña: <input type="password" name="clave1" size="15"><br>
      Confirmar Contraseña: <input type="password" name="clave2" size="15"><br>
      Correo: <input type="text" name="mail" size="15"><br>
      Tipo de Plan: <br>
      <input type="radio" name="nplan" value="0" checked> Básico<br>
      <input type="radio" name="nplan" value="1"> Profesional<br>
      <input type="radio" name="nplan" value="2"> Premium<br>
      <input type="radio" name="nplan" value="3"> Máster<br>
      
      <input type="submit" name="orden" value="Registrarse">
</form>
<?php 
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido
$contenido = ob_get_clean();
include_once "principal.php";

?>