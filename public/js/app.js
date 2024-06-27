$(document).ready(function () {
  console.log("Hello world!");
  cargarFunciones();


  window.addEventListener('popstate', function(event) {
    if (event.state) {
      if(event.state.page === "inicio"){
        listarPosts()
      }
    }
  });

  //cambiar estado
  $(document).on("click", ".state", function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("userId");
    $.post("AdminController/cambiarEstadoUsuario", { id })
      .done(function (response) {
        listarUsers();
      })
      .fail(function (error) {
        console.error("Error:", error.responseText);
        console.error("Status:", error.status);
      });
  });

  //like
  $(document).on("click", ".like", function () {
    let post_id = $(this).closest(".card").attr("post-id");
    $.get("like", {
      post_id,
    })
      .done(function (response) {
        listarPosts();
      })
      .fail(function (error) {
        console.error("Error:", error.responseText);
        console.error("Status:", error.status);
      });
  });

  $("#search").keyup(function () {
    listarPosts();
  });

  $("#form-login").on("submit", function (e) {
    e.preventDefault(); // Prevenir el envío predeterminado del formulario
    var parametros = $(this).serialize(); // Serializar los datos del formulario
    login(parametros);
  });
});

function login(parametros) {
  $.ajax({
    url: "login",
    type: "POST",
    data: parametros,
    success: function (response) {
      response = JSON.parse(response);
      if (response.status === "success") {
        // Redirigir a la página correcta
        window.location.href = response.redirect;
      }
    },
    error: function (jqXHR) {
      // Manejar errores según el código de estado HTTP
      if (jqXHR.status === 500) {
        console("Error en la solicitud: " + jqXHR.responseText);
      } else if (jqXHR.status === 401) {
        alert("Error de inicio de sesión");
      } else {
        alert(
          "Hubo un problema con la solicitud. Por favor, inténtelo de nuevo más tarde."
        );
      }
    },
  });
}

async function listarPosts() {
  try {
    let search = $("#search").val();
    // Solicitar los posts
    let response = await $.ajax({
      url: "posts",
      type: "GET",
      data: {
        search: search,
      },
    });

    let posts = JSON.parse(response);
    let template = "";
    let postTemplate = $("#post-template").html(); // Obtener la plantilla desde el elemento oculto

    for (let element of posts) {
      // Reemplazar las variables en la plantilla con los datos del post
      let postHTML = postTemplate
        .replace("{{id}}", element.id)
        .replace("{{title}}", element.title)
        .replace("{{created_at}}", element.created_at)
        .replace("{{description}}", element.description)
        .replace("{{user_id}}", element.user_id)
        .replace("{{author}}", element.author)
        .replace("{{semester_student}}", element.semester_student)
        .replace("{{career_student}}", element.career_student)
        .replace("{{num_likes}}", element.num_likes);

      let buttonClass =
        element.user_liked === 1 ? "btn-danger" : "btn-outline-danger";
      postHTML = postHTML.replace("{{class}}", buttonClass);

      // Solicitar los archivos asociados al post
      try {
        let fileResponse = await $.get("posts/files", {
          post_id: element.id,
        });
        let files = JSON.parse(fileResponse);
        files.forEach((file) => {
          if (file.type == "cover_image") {
            postHTML = postHTML.replace("{{cover_image_path}}", file.path);
          }
          if (file.type == "pdf") {
            postHTML = postHTML
              .replace("{{pdf_path}}", file.path)
              .replace("{{pdf_name}}", file.file_name);
          }
        });
      } catch (error) {
        console.error("Error:", error);
        console.error("Error:", error.status, error.responseText);
      }
      template += postHTML;
    }

    $("#all-posts").html(template);
  } catch (error) {
    console.error("Error:", error.status, error.responseText);
  }
}

//Admin
function listarUsers() {
  $.ajax({
    url: "users",
    type: "GET",
    success: function (response) {
      let users = JSON.parse(response);
      let userTemplate = $("#user-template").html(); // Aquí obtenemos el contenido HTML de la plantilla

      let template = "";

      users.forEach(function (user) {
        // Crear una copia del template para cada usuario
        let userHTML = userTemplate
          .replace("{{id}}", user.id)
          .replace("{{code}}", user.code)
          .replace("{{user_name}}", user.user_name)
          .replace("{{role}}", user.role)
          .replace("{{email}}", user.email)
          .replace("{{state}}", user.state === "1" ? "Activo" : "Inactivo");

        // Modificar el botón dentro de userHTML basado en el estado del usuario
        let buttonText = user.state === "1" ? "Desactivar" : "Activar";
        let buttonClass =
          user.state === "1" ? "btn btn-danger" : "btn btn-success";

        userHTML = userHTML.replace("{{text}}", buttonText); // Reemplazar el texto del botón
        userHTML = userHTML.replace("{{class}}", buttonClass); // Reemplazar la clase del botón

        template += userHTML; // Agregar el HTML del usuario al template general
      });

      // Insertar el template generado en el tbody de la tabla
      $("#personasINadmin").html(template);
    },
    error: function (error) {
      console.log("status: " + error.status, "error: " + error.responseText);
    },
  });
}

function logueado(callback) {
  $.ajax({
    url: "logueado",
    type: "GET",
    success: function (response) {
      const user = JSON.parse(response);
      if (user) {
        callback(user.role_id); // Si el usuario es admin, ejecuta el callback con el rol del usuario
      } else {
        console.log("No hay login");
      }
    },
    error: function (error) {
      console.log("status: " + error.status, "error: " + error.responseText);
    },
  });
}

function urlActual() {
  // Obtener la URL actual del navegador
  let url = new URL(window.location.href);
  const pathname = url.pathname; // example "inicio/users"
  // Dividir la ruta después del dominio base por "/"
  const segments = pathname.split("/").filter((segment) => segment !== "");
  return segments;
}

function cargarFunciones() {
  logueado(function (role_id) {
    let url = urlActual();
    console.log(url)
    //Ejecutar funciones segun sea necesario
    if (role_id != 1) {
      if (url[0] === "inicio" || url.length === 0) {
        listarPosts();
        history.replaceState({ page: "inicio" }, "Inicio", "inicio");
      }
    } else {
      if (url[0] === "admin/users") {
        listarUsers();
      }
    }
  });
}








