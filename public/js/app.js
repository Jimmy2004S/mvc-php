$(document).ready(function () {
  console.log("Hello world!");
  // Inicializar la aplicación según la URL actual
  cargarFunciones();
  window.addEventListener("popstate", function (event) {
    console.log("inicio entre");
    if (event.state) {
      if (event.state.page === "inicio") {
        listarPosts();
      }
      if (event.state.page === "posts/tendencias") {
        listarPosts();
      }
      if (event.state.page === "admin/users") {
        listarUsers();
      }
    }
  });

  //Navegaciones y eventos en links
  $("#home-link").on("click", function (e) {
    history.replaceState({ page: "inicio" }, "Inicio", "inicio");
    listarPosts();
  });
  $("#tendencias-link").on("click", function (e) {
    history.replaceState(
      { page: "posts/tendencias" },
      "posts/tendencias",
      "posts/tendencias"
    );
    listarPostsTendencias();
  });

  $("#form-login").on("submit", function (e) {
    e.preventDefault(); // Prevenir el envío predeterminado del formulario
    var parametros = $(this).serialize(); // Serializar los datos del formulario
    login(parametros);
  });

  //Busqueda de posts
  $("#search").keyup(function () {
    listarPosts();
  });

  //Dar like a post
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

  //cambiar estado de usuario
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
});

function login(parametros) {
  $.ajax({
    url: "api/login",
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
      url: "api/posts",
      type: "GET",
      data: {
        search: search,
      },
    });

    let posts = JSON.parse(response);
    renderPosts(posts);
  } catch (error) {
    console.error("Error:", error.status, error.responseText);
  }
}

async function listarPostsTendencias() {
  try {
    let search = $("#search").val();
    // Solicitar los posts
    let response = await $.ajax({
      url: "api/posts/trends",
      type: "GET",
      data: {
        search: search,
      },
    });

    let posts = JSON.parse(response);
    renderPosts(posts);
  } catch (error) {
    console.error("Error:", error.status, error.responseText);
  }
}

async function renderPosts(posts) {
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
      let fileResponse = await $.get("api/posts/files", {
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
}

//Admin
function listarUsers() {
  $.ajax({
    url: "api/users",
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
    url: "api/logueado",
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

function cargarFunciones() {
  logueado(function (role_id) {
    let url = window.location.pathname;
    //Ejecutar funciones segun el rol y la url
    if (role_id != 1) {
      if (url === "/inicio" || url === "/") {
        listarPosts();
        history.replaceState({ page: "inicio" }, "Inicio", "inicio");
      } else if (url === "/posts/tendencias") {
        console.log("entre");
        listarPostsTendencias();
        history.replaceState(
          { page: "posts/tendencias" },
          "Tendencias",
          "posts/tendencias"
        );
      }
    } else {
      if (url === "/admin/inicio") {
        history.replaceState({ page: "admin/inicio" }, "", "admin/inicio");
      } else if (url === "/admin/users") {
        listarUsers();
        history.replaceState({ page: "admin/users" }, "Users", "admin/users");
      }
    }
  });
}
