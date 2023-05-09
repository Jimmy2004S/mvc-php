$(document).ready(function(){
      console.log('Hellow word');

      listarProyectos();
      listarMisProyectos();
      //Devolver busqueda
    $('#search').keyup(function() {
        let search = $('#search').val();
        $.ajax({
          url: '../Datos/persona/filtrarPersona.php',
          type: 'POST',
          data: {
            search: search
          },
          dataType: 'json',
          success: function(response) {
            console.log(response);
          },
          error: function(xhr, status, error) {
            console.log("Error:", xhr.responseText);
          }
        });
    });
      
      
    //Agregar al grupo
    $(document).ready(function() {
      $('#form-addGrupo').submit(function(e){
        e.preventDefault();
        const postDATA = {
          name: $('#nombreGrupo').val()
        };
        console.log(postDATA);
      });
    });    

    //Listar todos los proyectos
    function listarProyectos(){
      $.ajax({
        url: '../Datos/proyectos/listar.php',
        type: 'GET',
        success: function(response){
            let proyectos = JSON.parse(response);
            let template ='';
            proyectos.forEach(element => {
                template +=  `
                  <div class="col-sm-12 col-md-6">
                    <div codigo-proyecto="${element.codigo}" class="card border-primary mb-3">
                      <div class="card-header">
                        <h4 class="card-title">${element.nombre}</h4>
                        <h6 class="card-subtitle mb-2 text-muted">${element.fecha_inicio}</h6>
                      </div>
                      <div class="card-body">
                        <p class="card-text">${element.descripcion}</p>
                        <a href="../Archivos/${element.archivo}" target="blank" class="card-link">${element.archivo}</a>
                        <div class="d-flex justify-content-end mt-3">
                          <p> ${element.likes} likes </p>
                          <button class="btn btn-success ms-2">
                            <i class="like fa-sharp fa-regular fa-heart"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                `
            });
            $('#allproject').html(template);
        }
      })
    }
    //Dar like a proyecto
    $(document).on('click' , '.like' , function(){
      let element = $(this)[0].parentElement.parentElement.parentElement.parentElement;
      let codigo =  $(element).attr('codigo-proyecto');
      $.post('../Datos/proyectos/actualizar_likes.php' , {codigo} , function(response) {
        listarProyectos();
      });
    });
    
    function listarMisProyectos(){
      $.ajax({
        url: '../Datos/proyectos/listarXPersona.php',
        type: 'GET',
        success: function(response){
            let proyectos = JSON.parse(response);
            let template ='';
            proyectos.forEach(element => {
                template +=  `
                  <div class="col-sm-12 col-md-6">
                    <div codigo-proyecto="${element.codigo}" class="card border-primary mb-3">
                      <div class="card-header">
                        <h4 class="card-title">${element.nombre}</h4>
                        <h6 class="card-subtitle mb-2 text-muted">${element.fecha_inicio}</h6>
                      </div>
                      <div class="card-body">
                        <p class="card-text">${element.descripcion}</p>
                        <a href="../Archivos/${element.archivo}" target="_blank" class="card-link">${element.archivo}</a>
                        <div class="d-flex justify-content-end mt-3">
                          <button class="btn btn-secondary">
                            <i class="eliminar fa-solid fa-trash"></i>
                          </button>
                          <button class="ms-2 btn btn-danger">
                            <i class="seleccionar fa-solid fa-hand-pointer"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                `
            });
            $('#my-projects').html(template);
        }
      })
    }
    //Eliminar proyecto
    $(document).on('click' , '.eliminar' , function(){
      let element = $(this)[0].parentElement.parentElement.parentElement.parentElement;
      let codigo =  $(element).attr('codigo-proyecto');
      $.post('../Datos/proyectos/eliminar.php' , {codigo} , function(response){
        console.log(response);
        listarMisProyectos();
      });
    });
    //Seleccionar proyecto
    $(document).on('click' , '.seleccionar' , function(){
      let element = $(this)[0].parentElement.parentElement.parentElement.parentElement;
      let codigo =  $(element).attr('codigo-proyecto');
      $.post('../Datos/proyectos/listar‼Codigo.php' , {codigo} , function(response){
          let proyecto = JSON.parse(response);
          console.log(proyecto);
          // Actualizar IU
          $('#codigoProyecto').val(proyecto.codigo);
          $('#nombreProyecto').val(proyecto.nombre);
          $('#descripcion').val(proyecto.descripcion);
          $('#miSelectGrupo').val(proyecto.codigo_grupo);
          $('#codigoPersona').val(proyecto.codigo_lider_proyecto);
          $('#nombreArchivo').text(proyecto.archivo);
      }); 
    });
    
    /*
   $('#form-addProject').submit(function(e){
      e.preventDefault();
        // Crea un objeto FormData
      const formData = {
        nombre: $('#nombreProyecto').val(),
        archivo: $('#archivo')[0].files[0]
      }

      console.log(formData);
      // Envía la petición AJAX
      $.ajax({
          url: '../Datos/proyectos/agregar.php',
          method: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
          console.log(response);
        }
      });
   });
   */
    
});


function accion(){
    var ancla = document.getElementsByClassName('ancla-nav');
    for(var i=0 ; i < ancla.length; i++){
        ancla[i].classList.toggle('desaparece')
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
        var informacion1 = document.getElementById("estudiante");
        var informacion2 = document.getElementById("profesor");
        
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
    

    
    
    
      
      
      