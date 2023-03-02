<?php
require_once 'layouts\app.php';
?>

<div class="justify-items-center text-center">
  <form id="uploadimg" method="POST" enctype="multipart/form-data">
    <div class="text-center my-5">

      <input type="file" onchange="onFileSelected(event)" accept="image/bmp" id="image" name="image" class="file-input file-input-bordered file-input-primary w-full max-w-xs" />

      <select name="filter" id="filter" class="select select-primary w-full max-w-xs">
        <option disabled selected>Selecione um Filtro</option>
        <option value="1">MAX</option>
        <option value="2">MIN</option>
        <option value="3">Moda</option>
        <option value="4">Pseudo Mediana</option>
        <option value="5">Mediana</option>
      </select>
      <a class="btn btn-outline btn-primary" id="btn-upload" type="button">Aplicar</a>

    </div>

  </form>

  <!-- CARREGA A DIV COM AS IMAGENS DE ENTRADA E SAIDA -->
  <div class="p-5">
    <?php include('../../src/views/layouts/images.php') ?>
  </div>

</div>
<script>
  // FORMULARIO EH PASSADO VIA AJAX PARA NAO SER NECESSARIO RECARREGAR A PAGINA
  $(document).on('click', '#btn-upload', function(event) {
    event.preventDefault();
    var form = $('#uploadimg')[0];
    var formData = new FormData(form);
    $.ajax({
      url: "../functions/n-r-filters.php",
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




  // FUNCAO PARA MOSTRAR A IMAGEM CARREGADA NA TELA

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