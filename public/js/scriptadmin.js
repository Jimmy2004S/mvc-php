$(document).ready(function () {
  listarPersonas();

  //Seleccionar persona
  $(document).on("click", ".selecciona", function () {
    //Tomar el elemento y su atributo codigo proyecto
    let element = $(this)[0].parentElement.parentElement.parentElement;
    let codigo = $(element).attr("persona-codigo");
    //Preparar el formulario para modificar

    $.post(
      "AdminController/verUsuario",
      { codigo },
      function (response) {
        let persona = JSON.parse(response);
        console.log(persona);
        // Actualizar IU
        $("#nombre").val(persona.nombre);
        $("#apellido").val(persona.apellido);
        $("#identificacion").val(persona.identificacion);
        $("#email").val(persona.email);
        $("#telefono").val(persona.telefono);
        $("#tipous").val(persona.tipo_persona);
      }
    );
    $("#miModalA").modal("show");
  });

  //cambiar estado
  $(document).on("click", ".estado", function () {
    let element = $(this)[0].parentElement.parentElement;
    let codigo = $(element).attr("persona-codigo");
    $.post(
      "AdminController/cambiarEstadoUsuario",
      { codigo },
      function (response) {
        console.log(response);
        listarPersonas();
      }
    );
  });
});

function listarPersonas() {
  $.ajax({
    url: "AdminController/verUsuarios",
    type: "GET",
    success: function (response) {
      let personas = JSON.parse(response);
      let template = "";
      personas.forEach((element) => {
        let activarButton = "";
        let desactivarButton = "";
        if (element.estado === "Activo") {
          desactivarButton = `
                        <button class="estado btn btn-primary w-80">
                            Desactivar
                        </button>
                    `;
        } else {
          activarButton = `
                        <button class="estado btn btn-danger w-80">
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
      $("#personasINadmin").html(template);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
      // Manejo del error en el cliente
      alert("Error en el servidor: " + jqXHR.responseText);
    },
  });
}
