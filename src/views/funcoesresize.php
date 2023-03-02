<?php
require_once 'layouts\app.php';
?>
<!-- action="../functions/rotacoes.php" -->

<div class="justify-items-center text-center">
  <form id="uploadimg" method="POST" action="../functions/d-e-resize.php" enctype="multipart/form-data">
  somente jpeg
    <div class="grid sm:grid-cols-4 gap-2 m-3">
      
      <div class="p-2">
        <input type="file" onchange="onFileSelected(event)" accept="image/jpeg" id="image" name="image" class="file-input file-input-bordered file-input-primary w-full max-w-xs" />
      </div>

      <div class="p-2">
        <select name="filter" id="filter" class="select select-primary w-full max-w-xs">
          <option disabled selected>Selecione um Filtro</option>
          <option value="1">Bilinear</option>
          <option value="2">Vizinho mais proximo</option>
        </select>
      </div>

      <div class="p-2">
        <select name="option" id="option" class="select select-primary w-full max-w-xs">
          <option disabled selected>Selecione um Tamanho</option>
          <option value="1">512x512</option>
          <option value="2">1024x1024</option>
        </select>
      </div>

      <div class="m-2">
        <button type="submit" class="btn btn-outline btn-primary" id="btn-upload" type="button">Aplicar</a>
      </div>

    </div>



  </form>

  <div class="flex w-full h-full lg:flex-row content-center bg-base-100 pb-10">
    <div class="grid flex-grow h-flex card bg-base-300 rounded-box place-items-center">
      <label for="input">Imagem Original</label>
      <div>
        <img max-w='500px' max-h='500px' id="input" src="">
      </div>
    </div>

  </div>
</div>
<script>
  /*
  $(document).on('click', '#btn-upload', function(event) {
    event.preventDefault();
    var form = $('#uploadimg')[0];
    var formData = new FormData(form);
    //filter - $("#filter").val();
    // Set header if need any otherwise remove setup part
    $.ajax({
      url: "../functions/rotacoes.php", // your request url
      data: formData,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function(data) {
        var img = document.getElementById("output");
        img.setAttribute('src', data);
      },
      error: function() {

      }
    });

  });
  */


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