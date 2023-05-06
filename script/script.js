function accion(){
    var ancla = document.getElementsByClassName('ancla-nav');
    for(var i=0 ; i < ancla.length; i++){
        ancla[i].classList.toggle('desaparece')
    }
}

function loginUsuario(){
    var administrador = document.getElementsByClassName('administrador');
    for(var i=0 ; i < administrador.length; i++){
        administrador[i].classList.toggle('desaparece')
    }
}

function mostrarAlerta(mensaje, encabezado) {
    if (encabezado == null) {
      encabezado = "Alerta";
    }
    alert(encabezado + ": " + mensaje);
  }

//Informacion complementaria para registrar persona
    function inforTipoPersona() {
        var select = document.getElementById("tipous");
        var opcionSeleccionada = select.options[select.selectedIndex].value;
        var informacion1 = document.getElementById("informacion1");
        var informacion2 = document.getElementById("informacion2");
        
        if (opcionSeleccionada == "Estudiante") {
          informacion1.style.display = "block";
          informacion2.style.display = "none";
        } else if (opcionSeleccionada == "Profesor") {
          informacion1.style.display = "none";
          informacion2.style.display = "block";
        } else {
          informacion1.style.display = "none";
          informacion2.style.display = "none";
        }
      }
 
    function like(){
        var botonLike = document.getElementById("boton-like");
        botonLike.addEventListener("click", function() {
        botonLike.classList.toggle("liked");
      });
    }

    function buscarTabla() {
      // Obtener el valor del campo de búsqueda
      var input = document.getElementById("buscar");
      var filtro = input.value.toUpperCase();
    
      // Obtener la tabla y las filas
      var tabla = document.getElementById("tabla");
      var filas = tabla.getElementsByTagName("tr");
    
      // Recorrer todas las filas y mostrar aquellas que coincidan con la búsqueda
      for (var i = 0; i < filas.length; i++) {
        if(i==0){
          continue; // omitir la primera fila (encabezados)
        }
        var celdas = filas[i].getElementsByTagName("td");
        var mostrarFila = false;
        for(var j=0; j<celdas.length; j++){
          var celda = celdas[j];
          if (celda) {
            var textoCelda = celda.textContent || celda.innerText;
            if (textoCelda.toUpperCase().indexOf(filtro) > -1) {
              mostrarFila = true;
              break;
            }
          }
        }
        if(mostrarFila){
          filas[i].style.display = "";
        } else {
          filas[i].style.display = "none";
        }
      }
    }
    
    function enviarLike() {
      $(document).ready(function() {
        $('.btn-like').click(function() {
          var proyecto_id = $(this).data('proyecto-id');
          var url = '../Datos/proyectos/actualizar_likes.php';
          var data = {
            proyecto_id: proyecto_id
          };
          $.post(url, data, function(response) {
            // Actualiza la UI para mostrar el nuevo número de likes
            $('.proyecto[data-proyecto-id="' + proyecto_id + '"] .num-likes').text(response.likes);
          });
        });
      });      
    }
    
    
    
    
      
      
      