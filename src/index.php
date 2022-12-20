<?php
require_once 'layouts\app.php';
?>

<div class="text-center">
  <form action="functions/negativo.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" class="m-20 file-input file-input-bordered file-input-primary w-full max-w-xs" />
    <button class="btn btn-outline btn-primary" type="submit">Enviar</button>
  </form>
</div>

<div class="text-center">
  <img src="" name="image" id="img">
</div>