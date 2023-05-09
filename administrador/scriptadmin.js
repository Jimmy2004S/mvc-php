$(document).ready(function(){

    listarPersonas();

    function listarPersonas(){
        $.ajax({
            url: '../Datos/persona/ListarPersonas.php',
            type: 'GET',
            success: function(response){
                let personas = JSON.parse(response);
                let template ='';
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
                    template +=  `
                        <tr persona-codigo="${element.codigo}">
                            <td> ${element.codigo}</td>
                            <td>${element.nombre} .' '. ${element.apellido}</td>
                            <td>${element.tipo_persona}</td>
                            <td>${element.email}</td>
                            <td>${element.telefono}</td>
                            <td>${element.estado}</td>
                            <td>
                                ${desactivarButton}
                                ${activarButton}
                            </td>
                        </tr>
                    `
                });
                $('#personasINadmin').html(template);
            }
        })
    }

    //Activar persona
    $(document).on('click' , '.activar' , function(){
        let element = $(this)[0].parentElement.parentElement;
        let codigo =  $(element).attr('persona-codigo');
        $.post('datos/activarPersona.php' , {codigo} , function(response) {
            listarPersonas();
        })
    });

    //Desactivar persona
    $(document).on('click' , '.desactivar' , function(){
        let element = $(this)[0].parentElement.parentElement;
        let codigo =  $(element).attr('persona-codigo');
        $.post('datos/desactivarPersona.php' , {codigo} , function(response){
            listarPersonas();
        });
    });

});