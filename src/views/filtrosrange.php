<?php
require_once 'layouts\app.php';
?>

<div class="justify-items-center text-center">
  <form id="uploadimg" method="POST" enctype="multipart/form-data">
    <div class="text-center my-5">

      <input type="file" onchange="onFileSelected(event)" accept="image/bmp" id="image" name="image" class="file-input file-input-bordered file-input-primary w-full max-w-xs" />

      <select name="option" id="option" class="select select-primary w-full max-w-xs">
        <option disabled selected>Selecione um Filtro</option>
        <option value="1">Expansao</option>
        <option value="2">Compressao</option>
      </select>
      <!--<a class="btn btn-outline btn-primary" id="btn-upload" type="button">Aplicar</a>-->

    </div>

    <div class="text-center grid grid-cols-2 gap-4 sm:grid-cols-2 max-w-lg">
      <label for="const">
        Constante de inclinacao
        <input type="range" name="const" id="const" min="1" max="3" value="" class="range range-warning" />
        <div class="w-full flex justify-between text-xs px-2">
          <span>1</span>
          <span>2</span>
          <span>3</span>
        </div>
        <div id="valcons"></div>
      </label>

      <label for="soma">
        Variavel de Soma
        <input type="range" name="soma" id="soma" min="0" max="32" value="" class="range range-warning" />
        <div id="valsoma"></div>
      </label>
    </div>

  </form>

  <!-- CARREGA A DIV COM AS IMAGENS DE ENTRADA E SAIDA -->
  <div class="p-5">
    <?php include('../../src/views/layouts/images.php') ?>
  </div>

</div>
<script>
  $(document).on('change', '#soma', function(event) {
    event.preventDefault();
    var form = $('#uploadimg')[0];
    var formData = new FormData(form);
    $.ajax({
      url: "../functions/i-expcompress.php", // your request url
      data: formData,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function(data) {
        var img = document.getElementById("output");
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