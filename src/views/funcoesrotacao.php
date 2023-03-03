<?php
require_once 'layouts/app.php';
?>
<!-- action="../functions/rotacoes.php" -->

<div class="justify-items-center text-center">
  <form id="uploadimg" method="POST" enctype="multipart/form-data">
    <div class="text-center my-5">

      <input type="file" onchange="onFileSelected(event)" accept="image/*" id="image" name="image" class="file-input file-input-bordered file-input-primary w-full max-w-xs" />

      <select name="option" id="option" class="select select-primary w-full max-w-xs">
        <option disabled selected>Selecione um Filtro</option>
        <option value="1">Horario</option>
        <option value="2">Anti-Horario</option>
        <option value="3">180</option>
        <option value="4">Espelhamento Vertical</option>
        <option value="5">Espelhamento Horizontal</option>
      </select>
      <button type="submit" class="btn btn-outline btn-primary" id="btn-upload" type="button">Aplicar</a>

    </div>

  </form>

  <!-- CARREGA A DIV COM AS IMAGENS DE ENTRADA E SAIDA -->
  <div class="p-5">
    <?php include('../../src/views/layouts/images.php') ?>
  </div>

</div>
<script>
  $(document).on('click', '#btn-upload', function(event) {
    event.preventDefault();
    var form = $('#uploadimg')[0];
    var formData = new FormData(form);
    $.ajax({
      url: "../functions/h-k-rotations.php",
      data: formData,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function(data) {
        var img = document.getElementById("output");
        //img.setAttribute('src', data);
        $('#output').html(data);
      },
      error: function() {

      }
    });

  });



  function onFileSelected(event) {
    var selectedFile = event.target.files[0];
    var reader = new FileReader();

    var imgtag = document.getElementById("input");
    imgtag.title = selectedFile.name;

    reader.onload = function(event) {
      imgtag.src = event.target.result;
    };

    reader.readAsDataURL(selectedFile);
  }
</script>