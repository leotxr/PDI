<div class="flex w-full h-full lg:flex-row content-center bg-base-100 pb-10">
    <div class="grid flex-grow h-flex card bg-base-300 rounded-box place-items-center">
        <label for="input">Imagem Original</label>
        <div>
            <img max-w='500px' max-h='500px' id="input" name="input" src="">
        </div>
        <!-- DIV mostrando ponta de prova da imagem de entrada -->
        <div id="pdpinput" class="text-center border grid grid-cols-2">
            <div id="xin" class="px-5"></div>
            <div id="yin" class="px-5"></div>
        </div>
    </div>
    <div class="divider lg:divider-horizontal"></div>
    <div class="grid flex-grow h-flex card bg-base-300 rounded-box place-items-center">
        <label for="input">Filtro aplicado</label>
        <div id="output">
            <!--<img max-w='500px' max-h='500px' id="output" src="">-->
        </div>
        <!-- DIV mostrando ponta de prova da imagem de saida -->
        <div id="pdpoutput" class="text-center border grid grid-cols-2">
            <div id="xout" class="px-5"></div>
            <div id="yout" class="px-5"></div>
        </div>
    </div>
</div>