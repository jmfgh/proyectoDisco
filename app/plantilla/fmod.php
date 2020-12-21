<?php

// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
// FORMULARIO DE MODIFICACION DE USUARIOS
?>
<div id='aviso'><b><?= (isset($msg))?$msg:"" ?></b></div>
<form name='MODIFICAR' method="POST" action="index.php?orden=Modificar">
      ID: <input type="text" name="id" size="10" value="<?= $user ?>" readonly disabled><br>
      Nombre: <input type="text" name="nombre" value="<?= $nombre ?>" size="25" ><br>
      Contraseña: <input type="password" name="clave" value="<?= $clave ?>" size="15"><br>
      Correo: <input type="text" name="mail" value="<?= $mail ?>" size="15"><br>
      Estado: <br>
      <input type="radio" name="estado" value="A" <?= ($estado == "A") ?  "checked" : "" ; ?>> Activo<br>
      <input type="radio" name="estado" value="B" <?= ($estado == "B") ?  "checked" : "" ; ?>> Bloqueado<br>
      <input type="radio" name="estado" value="I" <?= ($estado == "I") ?  "checked" : "" ; ?>> Inactivo<br>
      Tipo de Plan: <br>
      <input type="radio" name="nplan" value="0" <?= ($nplan == 0) ?  "checked" : "" ; ?>> Básico<br>
      <input type="radio" name="nplan" value="1" <?= ($nplan == 1) ?  "checked" : "" ; ?>> Profesional<br>
      <input type="radio" name="nplan" value="2" <?= ($nplan == 2) ?  "checked" : "" ; ?>> Premium<br>
      <input type="radio" name="nplan" value="3" <?= ($nplan == 3) ?  "checked" : "" ; ?>> Máster<br>

      <input type="submit" name="orden" value="Guardar cambios">
</form>
<?php 
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido
$contenido = ob_get_clean();
include_once "principal.php";

?>