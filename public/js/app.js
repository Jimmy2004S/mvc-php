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
      if (event.state.page === "user/posts") {
        listarMisPosts();
      }
      if (event.state.page === "admin/users") {
        listarUsers();
      }
    }
  });

  //Navegaciones y eventos en links
  $("#home-link").on("click", function (e) {
    window.location.href = "/";
    history.replaceState({ page: "inicio" }, "Inicio", "inicio");
    listarPosts();
  });

  //Tendencias
  $("#tendencias-link").on("click", function (e) {
    window.location.href = "/posts/tendencias";
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

  //Mis posts
  $("#my-perfil-link").on("click", function (e) {
    window.location.href = "user/posts";
    history.replaceState({ page: "user/posts" }, "user/posts", "user/posts");
    listarMisPosts();
  });

  //Abrir model para crear post
  $("#add-post").on("click", function (e) {
    $("#post_id").val("");
    $("#post_title").val("");
    $("#post_description").val("");
    $("#miModal").modal("show");
    document.getElementById("btn-create-post").classList.remove("desaparece");
    document.getElementById("btn-update-post").classList.add("desaparece");
  });

  //Agregar post
  $("#post-form input[type=submit]").click(function(e){
    e.preventDefault(); // Prevenir el envío predeterminado del formulario
    var parametros = new FormData($('#post-form')[0]);
    console.log(parametros);
    crearPost(parametros);
  })

  // Mostrar la imagen selecionada
 const coverImageInput = document.getElementById("cover_image_input");
 if (coverImageInput) {
   coverImageInput.addEventListener("change", function (event) {
     var reader = new FileReader();
     reader.onload = function () {
       var output = document.getElementById("cover_image_preview");
       output.src = reader.result;
     };
     reader.readAsDataURL(event.target.files[0]);
   });
 }

  //Selecionar post
  $(document).on("click", ".select-post", function () {
    let post_id = $(this).closest(".card").attr("post-id");

    $.get("api/user/post/" + post_id)
      .done(function (response) {
        let post = JSON.parse(response);
        console.log(post);
        post.forEach((element) => {
          $("#post_id").val(element.id);
          $("#post_title").val(element.title);
          $("#post_description").val(element.description);
        });
        $("#miModal").modal("show");
        document.getElementById("btn-create-post").classList.add("desaparece");
        document
          .getElementById("btn-update-post")
          .classList.remove("desaparece");
      })
      .fail(function (error) {
        console.error("Error:", error.responseText);
        console.error("Status:", error.status);
      });
  });

  //Delete post
  $(document).on("click", ".delete-post", function () {
    if (confirm("Are you sure you want to delete this post?")) {
      let post_id = $(this).closest(".card").attr("post-id");
      $.ajax({
        url: "api/post/" + post_id + "/delete",
        type: "DELETE",
        success: function (response) {
          listarMisPosts();
        },
        error: function (xhr, status, error) {
          console.log(xhr.responseText);
        },
      });
    }
  });

  //Dar like a post
  $(document).on("click", ".like", function () {
    let post_id = $(this).closest(".card").attr("post-id");
    $.get("api/post/" + post_id + "/like")
      .done(function (response) {
        cargarFunciones();
      })
      .fail(function (error) {
        console.error("Error:", error.responseText);
        console.error("Status:", error.status);
      });
  });

  //Agregar usuario
  document
    .getElementById("form-user-register")
    .addEventListener("submit", registrarUsuario);

  //cambiar estado de usuario
  $(document).on("click", ".state", function () {
    let element = $(this)[0].parentElement.parentElement;
    let user_id = $(element).attr("userId");
    $.get("api/user/" + user_id + "/state")
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
      type: "POST",
      data: {
        search: search,
      },
    });

    let posts = JSON.parse(response);
    renderPosts(posts);
    console.log(posts);
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
      type: "POST",
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

async function listarMisPosts() {
  try {
    let response = await $.ajax({
      url: "api/user/posts",
      type: "GET",
    });
    let posts = JSON.parse(response);
    renderPosts(posts, true);
  } catch (error) {
    console.error("Error:", error.status, error.responseText);
  }
}

async function renderPosts(posts, misPosts = false) {
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
      let post_id = element.id;
      let fileResponse = await $.get("api/post/" + post_id + "/files");
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

  if (misPosts) {
    $("#my-posts").html(template);
  } else {
    $("#all-posts").html(template);
  }
}

function crearPost(parametros) {
  $.ajax({
    url: "api/post/create",
    method: "POST",
    data: parametros,
    processData: false,
    contentType: false,
    success: function (response) {
      console.log(response);
      listarMisPosts();
      $("#miModal").modal("hide");
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    },
  });
}

function inforRoleUser() {
  let select = document.getElementById("role");
  if (select.value === "Estudiante") {
    $("#register-student-infor").removeClass("desaparece");
    $("#register-teacher-infor").addClass("desaparece");
  } else if (select.value === "Profesor") {
    $("#register-student-infor").addClass("desaparece");
    $("#register-teacher-infor").removeClass("desaparece");
  }
}

function registrarUsuario(e) {
  e.preventDefault(); // Prevenir el envío predeterminado del formulario
  var parametros = new FormData($("#form-user-register")[0]);
  
  $.ajax({
    url: 'api/user/create',
    type: 'POST',
    data: parametros,
    processData: false,
    contentType: false,
    success: function(response) {
      console.log(response);
    },
    error: function(xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
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
        $("#home-link").addClass("active");
        listarPosts();
        history.replaceState({ page: "inicio" }, "Inicio", "inicio");
      } else if (url === "/posts/tendencias") {
        $("#tendencias-link").addClass("active");
        listarPostsTendencias();
        history.replaceState(
          { page: "posts/tendencias" },
          "Tendencias",
          "posts/tendencias"
        );
      } else if (url === "/user/posts") {
        $("#select-post").removeClass("desaparece");
        $("#delete-post").removeClass("desaparece");
        $("#my-perfil-link").addClass("active");
        listarMisPosts();
        history.replaceState(
          { page: "user/posts" },
          "user/posts",
          "user/posts"
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
