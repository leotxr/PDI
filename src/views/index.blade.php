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
      </select>
      <a class="btn btn-outline btn-primary" id="btn-upload" type="button">Aplicar</a>

    </div>

    <div class="justify-items-center text-center border">
      <ul class="menu menu-horizontal bg-base-100 rounded-box">
        <li>
          <a>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
          </a>
        </li>
        <li>
          <a>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </a>
        </li>
        <li>
          <a>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
          </a>
        </li>
      </ul>
    </div>

  </form>

  <div class="flex w-full h-full lg:flex-row content-center bg-base-100 pb-10">
    <div class="grid flex-grow h-flex card bg-base-300 rounded-box place-items-center">
      <label for="input">Imagem Original</label>
      <div>
        <img max-w='500px' max-h='500px' id="input" src="">
      </div>
    </div>
    <div class="divider lg:divider-horizontal"></div>
    <div class="grid flex-grow h-flex card bg-base-300 rounded-box place-items-center">
      <label for="input">Filtro aplicado</label>
      <div>
        <img max-w='500px' max-h='500px' id="output" src="">
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