//FUNCOES PONTA DE PROVA ENTRADA E SAIDA

$(document).ready(function (e) {
  // ponta de prova imagem de entrada
  $("#input").mousemove(function (event) {
    var relX = event.pageX - $(this).offset().left; //posicao de x
    var relY = event.pageY - $(this).offset().top; //posicao de y
    relX = Math.ceil(relX);
    relY = Math.ceil(relY);
    $("#xin").text('X = ' + relX); //imprime na DIV
    $("#yin").text('Y = ' + relY); //imprime na DIV



  });

  //ponta de prova imagem de saida
  $("#output").mousemove(function (event) {
    var relX = event.pageX - $(this).offset().left; //posicao de x
    var relY = event.pageY - $(this).offset().top; //posicao de y
    relX = Math.ceil(relX);
    relY = Math.ceil(relY);
    $("#xout").text('X = ' + relX); //imprime na DIV
    $("#yout").text('Y = ' + relY); //imprime na DIV
  });
});
