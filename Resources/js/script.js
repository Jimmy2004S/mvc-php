$(document).ready(function(){
      console.log('Hellow word');
  //     listarPersonas();
  //     listarMisProyectos();
  //     listarMisGrupos();
  //     proyectosTendencias();
  //     buscarProyectos();

  //     function buscarProyectos() {
  //       let search = $('#search').val();
  //       $.ajax({
  //         url: '../Datos/proyectos/filtrarProyectos.php',
  //         type: 'POST',
  //         data: {
  //           search: search
  //         },
  //         //dataType: 'json',
  //         success: function(response) {
  //           let proyectos = JSON.parse(response);
  //           like = '';
  //           infor_persona = '';
  //           let template ='';
  //           proyectos.forEach(element => {
  //             if(element.dio_like == 1){
  //               like =`
  //               <button type="button" class="btn btn-danger">
  //                 <i class="nolike fa-sharp fa-regular fa-heart"></i>
  //               </button>
  //               `
  //             }else{
  //               like =`
  //               <button type="button" class="btn btn-outline-danger">
  //                 <i class="like fa-sharp fa-regular fa-heart"></i>
  //               </button>
  //               `            
  //             }
  //             if(element.tipo_persona == 'Profesor'){
  //               infor_persona =`
  //               <p> Departmento de  ${element.departamento} </p>
  //               `  
  //             }else{
  //               infor_persona =`
  //               <p>${element.carrera} /  semestre ${element.semestre}  </p>
  //               `  
  //             }
  //             template +=  `
  //               <div class="col-sm-12 col-md-6">
  //                 <div codigo-proyecto="${element.codigo}" class="shadow-lg mb-5 bg-body-tertiary rounded card border-primary mb-3" style="height: 90%;">
  //                   <div class="card-header">
  //                     <h4 class="card-title">${element.nombre}</h4>
  //                     <h6 class="card-subtitle mb-2 text-muted">${element.fecha_inicio}</h6>
  //                   </div>
  //                   <div class="card-body">
  //                     <p class="card-text">${element.descripcion}</p>
  //                     <a href="../Archivos/${element.archivo}" target="blank" class="card-link">${element.archivo}</a>
  //                   </div>
  //                   <div class="card-footer text-muted d-flex">
  //                     <div class="col-10">
  //                       <p> ${element.nombre_lider} </p>
  //                       ${infor_persona}
  //                     </div>
  //                     <div  class="col-2">
  //                       ${like}
  //                       <p class="m-0"> ${element.likes} like </p>
  //                     </div>
  //                   </div>
  //                 </div>
  //               </div>
  //             `
  //           });
  //           $('#allproject').html(template);
  //         },
  //         error: function(xhr, status, error) {
  //           console.log("Error:", xhr.responseText);
  //         }
  //       });
  //     }

  //     $('#search').keyup(function() {
  //       buscarProyectos();
  //       proyectosTendencias();
  //     });

  //   //Agregar al grupo
    

  //   function proyectosTendencias(){
  //     let search = $('#search').val();
  //       $.ajax({
  //         url: '../Datos/proyectos/tendencias.php',
  //         type: 'POST',
  //         data: {
  //           search: search
  //         },
  //         //dataType: 'json',
  //         success: function(response) {
  //           let proyectos = JSON.parse(response);
  //           like = '';
  //           infor_persona = '';
  //           let template ='';
  //           proyectos.forEach(element => {
  //             if(element.dio_like == 1){
  //               like =`
  //               <button type="button" class="btn btn-danger">
  //                 <i class="nolike fa-sharp fa-regular fa-heart"></i>
  //               </button>
  //               `
  //             }else{
  //               like =`
  //               <button type="button" class="btn btn-outline-danger">
  //                 <i class="like fa-sharp fa-regular fa-heart"></i>
  //               </button>
  //               `            
  //             }
  //             if(element.tipo_persona == 'Profesor'){
  //               infor_persona =`
  //               <p> Deapartmento de  ${element.departamento} </p>
  //               `  
  //             }else{
  //               infor_persona =`
  //               <p>${element.carrera} /  semestre ${element.semestre}  </p>
  //               `  
  //             }
  //             template +=  `
  //               <div class="col-sm-12 col-md-6">
  //                 <div codigo-proyecto="${element.codigo}" class="shadow-lg mb-5 bg-body-tertiary rounded card border-primary mb-3" style="height: 90%;">
  //                   <div class="card-header">
  //                     <h4 class="card-title">${element.nombre}</h4>
  //                     <h6 class="card-subtitle mb-2 text-muted">${element.fecha_inicio}</h6>
  //                   </div>
  //                   <div class="card-body">
  //                     <p class="card-text">${element.descripcion}</p>
  //                     <a href="../Archivos/${element.archivo}" target="blank" class="card-link">${element.archivo}</a>
  //                   </div>
  //                   <div class="card-footer text-muted d-flex">
  //                     <div class="col-10">
  //                       <p> ${element.nombre_lider} </p>
  //                       ${infor_persona}
  //                     </div>
  //                     <div class="col-2">
  //                       ${like}
  //                       <p class="m-0"> ${element.likes} like </p>
  //                     </div>
  //                   </div>
  //                 </div>
  //               </div>
  //             `
  //           });
  //           $('#tendencias').html(template);
  //         },
  //         error: function(xhr, status, error) {
  //           console.log("Error:", xhr.responseText);
  //         }
  //       });
  //   }

  //   //Dar like a proyecto
  //   $(document).on('click' , '.like' , function(){
  //     let element = $(this)[0].parentElement.parentElement.parentElement.parentElement;
  //     let codigo =  $(element).attr('codigo-proyecto');
  //     $.post('../Datos/proyectos/actualizar_likes.php' , {codigo} , function(response) {
  //       console.log(response);
  //       buscarProyectos();
  //       proyectosTendencias();
  //     });
  //   });
    
  //     //Quitar like a proyecto
  //   $(document).on('click' , '.nolike' , function(){
  //       let element = $(this)[0].parentElement.parentElement.parentElement.parentElement;
  //       let codigo =  $(element).attr('codigo-proyecto');
  //       $.post('../Datos/proyectos/quitarLike.php' , {codigo} , function(response) {
  //         buscarProyectos();
  //         proyectosTendencias();
  //       });
  //   });

  //   function listarMisProyectos(){
  //     $.ajax({
  //       url: '../Datos/proyectos/listarXPersona.php',
  //       type: 'GET',
  //       success: function(response){
  //           let proyectos = JSON.parse(response);
  //           let template ='';
  //           proyectos.forEach(element => {
  //               template +=  `
  //                 <div class="col-sm-12 col-md-6">
  //                   <div codigo-proyecto="${element.codigo}"  class="shadow-lg mb-5 bg-body-tertiary rounded card border-primary mb-3" style="height: 90%;">
  //                     <div class="card-header">
  //                       <h4 class="card-title">${element.nombre}</h4>
  //                       <h6 class="card-subtitle mb-2 text-muted">${element.fecha_inicio}</h6>
  //                     </div>
  //                     <div class="card-body">
  //                       <p class="card-text">${element.descripcion}</p>
  //                       <a href="../Archivos/${element.archivo}" target="_blank" class="card-link">${element.archivo}</a>
  //                       <div id="container-select" class=" d-flex justify-content-end mt-3">
  //                         <button type="button" class="btn btn-outline-danger">
  //                           <i class="eliminar fa-solid fa-trash"></i>
  //                         </button>
  //                         <button type="button" class="ms-3 btn btn-outline-dark">
  //                           <i class="seleccionar fa-solid fa-hand-pointer"></i>
  //                         </button>
  //                         <a href="../reporte.php?codigo=${element.codigo}" target="_blank" class="card-link ms-3">
  //                           <i class="fa-solid fa-download m-2"> </i>
  //                         </a>
  //                       </div>
  //                     </div>
  //                   </div>
  //                 </div>
  //               `
  //           });
  //           $('#my-projects').html(template);
  //       }
  //     })
  //   }

  //   //Eliminar proyecto
  //   $(document).on('click' , '.eliminar' , function(){
  //     let element = $(this)[0].parentElement.parentElement.parentElement.parentElement;
  //     let codigo =  $(element).attr('codigo-proyecto');
  //     $.post('../Datos/proyectos/eliminar.php' , {codigo} , function(response){
  //       console.log(response);
  //       listarMisProyectos();
  //     });
  //   });

  //    //Descargar certificado
  //    $(document).on('click' , '.descargar' , function(){
  //     let element = $(this)[0].parentElement.parentElement.parentElement.parentElement;
  //     let codigo =  $(element).attr('codigo-proyecto');
  //     $.post('../reporte.php' , {codigo} , function(response){
  //     });
  //   });

  //   //Seleccionar proyecto
  //   $(document).on('click' , '.seleccionar' , function(){
  //     //Tomar el elemento y su atributo codigo proyecto
  //     let element = $(this)[0].parentElement.parentElement.parentElement.parentElement;
  //     let codigo =  $(element).attr('codigo-proyecto');
  //     //Preparar el formulario para modificar
  //     $('#miModal').modal('show');
  //     document.getElementById("btn-registrar").classList.add("hide");
  //     document.getElementById("btn-modificar").classList.remove("hide");

  //       $.post('../Datos/proyectos/listar‼Codigo.php', { codigo }, function(response) {
  //         let proyecto = JSON.parse(response);
  //         // Actualizar IU
  //         $('#codigoProyecto').val(proyecto.codigo);
  //         $('#nombreProyecto').val(proyecto.nombre);
  //         $('#descripcion').val(proyecto.descripcion);
  //         if(proyecto.codigo_grupo == null ){
  //           $('#miSelectGrupo').val('seleccione un grupo');
  //         }else{
  //           $('#miSelectGrupo').val(proyecto.codigo_grupo);
  //         }
  //         $('#codigoPersona').val(proyecto.codigo_lider_proyecto);
  //         $('#nombreArchivo').text(proyecto.archivo);
  //       });
  //   });
    
  //   //Agregar o modificar proyecto
  //   $('#form-addProject input[type="submit"]').click(function(e) {
  //     e.preventDefault();
  //     var accion = $(this).val();
  //     console.log("acción seleccionada: " + accion);
  
  //     // Crea un objeto FormData
  //     var parametros = new FormData($('#form-addProject')[0]);
  //     // Seleccionar URL según la acción
  //     var url = "";
  //     if (accion === 'Registrar') {
  //         url = '../Datos/proyectos/agregar.php';
  //     } else if (accion === 'Modificar') {
  //         url = '../Datos/proyectos/modificar.php';
  //     } else {
  //         console.log("Error: Acción no reconocida");
  //         return;
  //     }
  
  //     // Envía la petición AJAX
  //     $.ajax({
  //         url: url,
  //         method: 'POST',
  //         data: parametros,
  //         processData: false,
  //         contentType: false,
  //         success: function(response) {
  //             console.log(response);
  //             listarMisProyectos();
  //         }
  //     });
  //     $('#miModal').modal('hide');
  //   });


  //   let personas = null;
  //   function listarPersonas(){
  //     $.ajax({
  //         url: '../Datos/persona/ListarPersonas.php',
  //         type: 'GET',
  //         success: function(response){
  //           personas = JSON.parse(response);    
  //         }
  //     })   
  // }

  // function listarMisGrupos(){ 
  //   $.ajax({
  //     url: '../Datos/grupos/MisGrupos.php',
  //     type: 'GET',
  //     success: function(response){
  //       let grupos = JSON.parse(response);
  //       let template ='';
  //       grupos.forEach(element => {
  //         let codigoGrupo = element.codigo_grupo;
  //         $.ajax({
  //           url: '../Datos/grupos/miembros.php',
  //           type: 'POST',
  //           data: { codigoGrupo },
  //           success: function(response){
  //             let miembros = JSON.parse(response);
  //             let template2 = '';
  //             miembros.forEach(element2 => {
  //               template2 +=  ` 
  //                 <p> ${element2.miembro} ${element2.codigo_persona} </p>
  //               `;
  //             });
  //             template +=  ` 
  //               <div class="col-sm-12 col-md-6">
  //                 <div codigo-grupo="${codigoGrupo}" class="card h-90 border-primary mb-3">
  //                   <div class="card-header">
  //                     <h4 class="card-title">${element.nombre}</h4>
  //                   </div>
  //                   <div class="card-body">
  //                     <div id="miembros-${codigoGrupo}">
  //                       ${template2}
  //                     </div>
  //                     <div class="d-flex justify-content-end mt-3">
  //                       <button class="btn btn-secondary">
  //                         <i class="eliminar fa-solid fa-trash"></i>
  //                       </button>
  //                       <button class="ms-2 btn btn-danger">
  //                         <i class="ver-grupo fa-solid fa-hand-pointer"></i>
  //                       </button>
  //                     </div>
  //                   </div>
  //                 </div>
  //               </div>
  //             `;
  //             $('#my-grupos').html(template);
  //           }
  //         });
  //       });
  //     }
  //   });
  // }
  

  //  //Seleccionar grupo
  //  $(document).on('click' , '.ver-grupo' , function(){
  //   //Tomar el elemento y su atributo codigo proyecto
  //   let element = $(this)[0].parentElement.parentElement.parentElement.parentElement;
  //   let codigo =  $(element).attr('codigo-grupo');
  //   //Preparar el formulario para modificar
  //   $('#miModalG').modal('show');
  //   document.getElementById("btn-registrar-G").classList.add("hide");
  //   document.getElementById("btn-modificar-G").classList.remove("hide");

  //     $.post('../Datos/grupos/MisGrupos.php', { codigo }, function(response) {
  //       console.log(response);
  //       let grupo = JSON.parse(response);
  //       console.log(grupo);
  //       // Actualizar IU
  //       $('#codigoGrupoG').val(response.codigo_grupo);
  //       $('#nombreGrupoG').val(grupo.nombre);
  //     });
  // });

  // //Abrir agregar proyecto
  // $('#add-project').click(function() {
  //   $('#miModal').modal('show');
  //   document.getElementById("btn-registrar").classList.remove("hide");
  //   document.getElementById("btn-modificar").classList.add("hide");
    
  //   if ($('#codigoProyecto').val().length > 0) {
  //     $('#codigoProyecto').val("");
  //     $('#nombreProyecto').val("");
  //     $('#descripcion').val("");
  //     $('#miSelectGrupo').val("");
  //     $('#codigoPersona').val("");
  //     $('#nombreArchivo').text("");
  //   }
  // });

  // //Abrir form report
  // $('#report').click(function() {
  //   $('#miModalC').modal('show');
  //   if ($('#subject').val().length > 0) {
  //     $('#subject').val("");
  //     $('#messagge').val("");
  //   }
  // });

  // //Enviar report
  // $('#form-report input[type="submit"]').click(function(e) {
  //   e.preventDefault();
  //   // Crea un objeto FormData
  //   const postDATA = {
  //     subject: $("#subject").val(),
  //     messagge: $("#messagge").val()
  //   }

  //   console.log(postDATA);
  //   // Envía la petición AJAX
  //   $.ajax({
  //       url: "../enviarCorreo.php",
  //       method: 'POST',
  //       data: postDATA,
  //       success: function(response) {
  //         console.log(response);
  //       }
  //   });
  //   $('#miModalC').modal('hide');
  // });

  // // Obtener la URL de la página actual
  // var currentUrl = window.location.href;
  // // Comparar la URL con las URLs de los enlaces del menú
  // if (currentUrl.includes("tendencias.php")) {
  //   $("#tendencias-link").addClass("active");
  // } else if (currentUrl.includes("misProject.php")) {
  //   $("#portfolio-link").addClass("active");
  // } else if (currentUrl.includes("misGrupos.php")) {
  //   $("#groups-link").addClass("active");
  // }
});



// function accion(){
//     var ancla = document.getElementsByClassName('ancla-nav');
//     for(var i=0 ; i < ancla.length; i++){
//         ancla[i].classList.toggle('desaparece');
//     }
// }


// function mostrarAlerta(mensaje, encabezado) {
//     if (encabezado == null) {
//       encabezado = "Alerta";
//     }
//     alert(encabezado + ": " + mensaje);
//   }

// //Informacion complementaria para registrar persona
//     function inforTipoPersona() {
//         var select = document.getElementById("tipous");
//         var opcionSeleccionada = select.options[select.selectedIndex].value;
//         var informacion1 = document.getElementById("estudiante");
//         var informacion2 = document.getElementById("profesor");
        
//         if (opcionSeleccionada == "Estudiante") {
//           informacion1.style.display = "block";
//           informacion2.style.display = "none";
//         } else if (opcionSeleccionada == "Profesor") {
//           informacion1.style.display = "none";
//           informacion2.style.display = "block";
//         } else {
//           informacion1.style.display = "none";
//           informacion2.style.display = "none";
//         }
//       }
 

//     function buscarTabla() {
//       // Obtener el valor del campo de búsqueda
//       var input = document.getElementById("buscar");
//       var filtro = input.value.toUpperCase();
    
//       // Obtener la tabla y las filas
//       var tabla = document.getElementById("tabla");
//       var filas = tabla.getElementsByTagName("tr");
    
//       // Recorrer todas las filas y mostrar aquellas que coincidan con la búsqueda
//       for (var i = 0; i < filas.length; i++) {
//         if(i==0){
//           continue; // omitir la primera fila (encabezados)
//         }
//         var celdas = filas[i].getElementsByTagName("td");
//         var mostrarFila = false;
//         for(var j=0; j<celdas.length; j++){
//           var celda = celdas[j];
//           if (celda) {
//             var textoCelda = celda.textContent || celda.innerText;
//             if (textoCelda.toUpperCase().indexOf(filtro) > -1) {
//               mostrarFila = true;
//               break;
//             }
//           }
//         }
//         if(mostrarFila){
//           filas[i].style.display = "";
//         } else {
//           filas[i].style.display = "none";
//         }
//       }
//     }
    

    
    
    
      
      
      