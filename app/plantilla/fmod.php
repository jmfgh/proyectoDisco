<?php

// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
// FORMULARIO DE MODIFICACION DE USUARIOS
?>
<div id='aviso'><b><?= (isset($msg))?$msg:"" ?></b></div>
<form name='MODIFICAR' method="POST" action="index.php?orden=Modificar">
      ID: <input type="text" name="id" size="10" value="<?= $user ?>" readonly><br>
      Nombre: <input type="text" name="nombre" value="<?= $nombre ?>" size="25" ><br>
      Contraseña: <input type="password" name="clave1" value="<?= $clave1 ?>" size="15"><br>
      Confirmar Contraseña: <input type="password" name="clave2" value="<?= $clave2 ?>" size="15"><br>
      Correo: <input type="email" name="mail" value="<?= $mail ?>" size="15"><br>
      Estado: <br>
      <input type="radio" name="estado" value="A" <?php echo ($estado == "A") ?  "checked" : "" ; ?>> Activo<br>
      <input type="radio" name="estado" value="B" <?php echo ($estado == "B") ?  "checked" : "" ; ?>> Bloqueado<br>
      <input type="radio" name="estado" value="I" <?php echo ($estado == "I") ?  "checked" : "" ; ?>> Inactivo<br>
      Tipo de Plan: <br>
      <input type="radio" name="nplan" value="0" <?php echo ($nplan == 0) ?  "checked" : "" ; ?>> Básico<br>
      <input type="radio" name="nplan" value="1" <?php echo ($nplan == 1) ?  "checked" : "" ; ?>> Profesional<br>
      <input type="radio" name="nplan" value="2" <?php echo ($nplan == 2) ?  "checked" : "" ; ?>> Premium<br>
      <input type="radio" name="nplan" value="3" <?php echo ($nplan == 3) ?  "checked" : "" ; ?>> Master<br>

      <input type="submit" name="orden" value="Guardar cambios">
</form>
<?php 
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido
$contenido = ob_get_clean();
include_once "principal.php";

?>