<?php

// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();

?>
<form name='DETALLES' method="POST" action="index.php?orden=VerUsuarios">
      ID: <?= $user ?><br>
      Nombre: <?= $nombre ?><br>
      Contraseña: <?= $clave ?><br>
      Correo: <?= $mail ?><br>
      Estado: <?= $estado ?><br>
      Tipo de Plan: <?= $nplan ?><br>

      <input type="submit" name="orden" value="Volver">
</form>
<?php 
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido
$contenido = ob_get_clean();
include_once "principal.php";

?>