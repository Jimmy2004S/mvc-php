$(document).ready(function(){

    listarPersonas();

    function listarPersonas() {
        $.ajax({
            url: '?url=AdminController/verUsuarios',
            type: 'GET',
            success: function(response) {
                let personas = JSON.parse(response);
                let template = '';
                personas.forEach(element => {
                    let activarButton = '';
                    let desactivarButton = '';
                    if (element.estado === 'Activo') {
                        desactivarButton = `
                            <button class="desactivar btn btn-primary w-80">
                                Desactivar
                            </button>
                        `;
                    } else {
                        activarButton = `
                            <button class="activar btn btn-danger w-80">
                                Activar
                            </button>
                        `;
                    }
                    template += `
                        <tr persona-codigo="${element.codigo}">
                            <td>${element.codigo}</td>
                            <td>${element.nombre} ${element.apellido}</td>
                            <td>${element.tipo_persona}</td>
                            <td>${element.email}</td>
                            <td>${element.telefono}</td>
                            <td>${element.estado}</td>
                            <td>
                                ${desactivarButton}
                                ${activarButton}
                                <button type="button" class="ms-3 btn btn-outline-dark">
                                    <i class="selecciona fa-solid fa-hand-pointer"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                });
                $('#personasINadmin').html(template);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
                // Manejo del error en el cliente
                alert("Error en el servidor: " + jqXHR.responseText);
            }
        });
    }
    

    //     //Seleccionar persona
    //     $(document).on('click' , '.selecciona' , function(){
    //         //Tomar el elemento y su atributo codigo proyecto
    //         let element = $(this)[0].parentElement.parentElement.parentElement;
    //         let codigo =  $(element).attr('persona-codigo');
    //         //Preparar el formulario para modificar

    //           $.post('../Datos/persona/ListarPersonas.php', { codigo }, function(response) {
    //             let persona = JSON.parse(response);
    //             console.log(persona)
    //             // Actualizar IU
    //             $('#nombre').val(persona.codigo);
    //             $('#apellido').val(persona.nombre);
    //             $('#descripcion').val(persona.apellido);
    //             $('#miSelectGrupo').val(persona.codigo_grupo);
    //             $('#codigoPersona').val(persona.codigo_lider_persona);
    //             $('#nombreArchivo').text(persona.archivo);
    //           });
    //           $('#miModalA').modal('show');
    //       });

    // //Activar persona
    // $(document).on('click' , '.activar' , function(){
    //     let element = $(this)[0].parentElement.parentElement;
    //     let codigo =  $(element).attr('persona-codigo');
    //     $.post('datos/activarPersona.php' , {codigo} , function(response) {
    //         console.log(response);
    //         listarPersonas();
    //     })
    // });

    // //Desactivar persona
    // $(document).on('click' , '.desactivar' , function(){
    //     let element = $(this)[0].parentElement.parentElement;
    //     let codigo =  $(element).attr('persona-codigo');
    //     $.post('datos/desactivarPersona.php' , {codigo} , function(response){
    //         console.log(response);
    //         listarPersonas();
    //     });
    // });

});