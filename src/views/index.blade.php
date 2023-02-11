<?php
require_once 'layouts\app.blade.php';
?>

<div class="justify-items-center text-center">
  <form id="uploadimg" method="POST" enctype="multipart/form-data">
    <div class="text-center my-5">

      <input type="file" onchange="onFileSelected(event)" accept="image/bmp" id="image" name="image" class="file-input file-input-bordered file-input-primary w-full max-w-xs" />

      <select name="filter" id="filter" class="select select-primary w-full max-w-xs">
        <option disabled selected>Selecione um Filtro</option>
        <option value="1">Negativo</option>
        <option value="2">Binarizacao</option>
        <option value="3">Log</option>
        <option value="4">Log Invertido</option>
        <option value="5">Raiz</option>
        <option value="6">Potencia</option>
      </select>
      <a class="btn btn-outline btn-primary" id="btn-upload" type="button">Aplicar</a>

    </div>

    <div id="pdp" class="justify-items-center text-center border grid grid-cols-3">
      <div id="x"></div>
      <div id="y"></div>
      <div id="color"></div>
    </div>

  </form>

  <div class="flex w-full h-full lg:flex-row content-center bg-base-100 pb-10">
    <div class="grid flex-grow h-flex card bg-base-300 rounded-box place-items-center">
      <label for="input">Imagem Original</label>
      <div>
        <img max-w='500px' max-h='500px' id="input" name="input" src="">
      </div>
    </div>
    <div class="divider lg:divider-horizontal"></div>
    <div class="grid flex-grow h-flex card bg-base-300 rounded-box place-items-center">
      <label for="input">Filtro aplicado</label>
      <div id="output">
        <!--<img max-w='500px' max-h='500px' id="output" src="">-->

      </div>
    </div>
  </div>
</div>
<script>
  $(document).on('click', '#btn-upload', function(event) {
    event.preventDefault();
    var form = $('#uploadimg')[0];
    var formData = new FormData(form);
    //filter - $("#filter").val();
    // Set header if need any otherwise remove setup part
    $.ajax({
      url: "../functions/filters.php", // your request url
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

  $(document).ready(function(e) {
    $("#input").mousemove(function(event) {
      var relX = event.pageX - $(this).offset().left; //posicao de x
      var relY = event.pageY - $(this).offset().top; //posicao de y
      relX = Math.ceil(relX);
      relY = Math.ceil(relY);
      $("#x").text(relX); //imprime na DIV
      $("#y").text(relY); //imprime na DIV

     

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