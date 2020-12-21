<?php

// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
// FORMULARIO DE MODIFICACION DE USUARIOS
?>
<div id='aviso'><b><?= (isset($msg))?$msg:"" ?></b></div>
<form name='MODIFICAR' method="POST" action="index.php?orden=Modificar">
      ID: <input type="text" name="id" size="10" value="<?= (isset($user))?$user:"" ?>" readonly><br>
      Nombre: <input type="text" name="nombre" value="<?= (isset($nombre))?$nombre:"" ?>" size="25" ><br>
      Contraseña: <input type="password" name="clave1" value="<?= (isset($clave1))?$clave1:"" ?>" size="15"><br>
      Confirmar Contraseña: <input type="password" name="clave2" value="<?= (isset($clave2))?$clave2:"" ?>" size="15"><br>
      Correo: <input type="text" name="mail" value="<?= (isset($mail))?$mail:"" ?>" size="15"><br>
      Estado: <br>
      <input type="radio" name="estado" value="A" <?= (isset($estado) && $estado == "A") ?  "checked" : "" ; ?>> Activo<br>
      <input type="radio" name="estado" value="B" <?= (isset($estado) && $estado == "B") ?  "checked" : "" ; ?>> Bloqueado<br>
      <input type="radio" name="estado" value="I" <?= (isset($estado) && $estado == "I") ?  "checked" : "" ; ?>> Inactivo<br>
      Tipo de Plan: <br>
      <input type="radio" name="nplan" value="0" <?= (isset($nplan) && $nplan == 0) ?  "checked" : "" ; ?>> Básico<br>
      <input type="radio" name="nplan" value="1" <?= (isset($nplan) && $nplan == 1) ?  "checked" : "" ; ?>> Profesional<br>
      <input type="radio" name="nplan" value="2" <?= (isset($nplan) && $nplan == 2) ?  "checked" : "" ; ?>> Premium<br>
      <input type="radio" name="nplan" value="3" <?= (isset($nplan) && $nplan == 3) ?  "checked" : "" ; ?>> Máster<br>

      <input type="submit" name="orden" value="Guardar cambios">
</form>
<?php 
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido
$contenido = ob_get_clean();
include_once "principal.php";

?>