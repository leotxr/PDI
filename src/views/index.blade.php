<?php
require_once 'layouts\app.blade.php';
?>
<div class="justify-items-center text-center">
  <form id="uploadimg" action="functions/negativo.php" method="POST" enctype="multipart/form-data">
    <div class="text-center">

      <input type="file" onchange="onFileSelected(event)" accept="image/bmp" id="image" name="image" class="m-20 file-input file-input-bordered file-input-primary w-full max-w-xs" />
      <a class="btn btn-outline btn-primary" id="btn-upload" type="button">Aplicar</a>

    </div>

  <div class="flex w-full h-full lg:flex-row content-center bg-base-100">
    <div class="grid flex-grow h-32 card bg-base-300 rounded-box place-items-center">
      <label for="input">Imagem Original</label>
      <div>
        <img max-w='500px' max-h='500px' id="input" src="">
      </div>
    </div>
    <div class="divider lg:divider-horizontal">-></div>
    <div class="grid flex-grow h-32 card bg-base-300 rounded-box place-items-center">
    <label for="input">Filtro aplicado</label>
      <div>
        <img max-w='500px' max-h='500px' id="output" src="">
      </div>
    </div>
  </div>

  </form>
</div>
<script>
  
  $(document).on('click', '#btn-upload', function(event) {
    event.preventDefault();
    var form = $('#uploadimg')[0];
    var formData = new FormData(form);
    // Set header if need any otherwise remove setup part
    $.ajax({
      url: "../functions/binarizacao.php", // your request url
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