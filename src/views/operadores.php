<?php
require_once 'layouts\app.php';
?>

<div class="justify-items-center text-center">
  <form id="uploadimg" method="POST" enctype="multipart/form-data">
    <div class="text-center my-5 grid grid-cols-3 sm:grid-cols-3">

      <div>
        <input type="file" onchange="onFileSelected(event)" accept="image/bmp" id="image" name="image" class="file-input file-input-bordered file-input-primary w-full max-w-xs" />
      </div>

      <div>
        <select name="filter" id="filter" class="select select-primary w-full max-w-xs">
          <option disabled selected>Selecione um Operador</option>
          <option value="1">Laplaciano</option>
          <option value="2">Sobel</option>
          <option value="3">Prewitt</option>
        </select>
        <button type="submit" class="btn btn-outline btn-primary" id="btn-upload" type="button">Aplicar</submit>
      </div>

      <div>
        <label for="treshold">Treshold</label>
        <input type="number" min="0" max="255" id="treshold" name="treshold" placeholder="Treshold" class="input input-bordered input-primary w-full max-w-xs" />
      </div>
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
      url: "../functions/s-v-operators.php", // your request url
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