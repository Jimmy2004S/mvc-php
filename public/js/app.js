$(document).ready(function () {
  console.log("Hello world!");
  listarPosts();
  listarUsers();
});

function listarPosts() {
  $.ajax({
    url: "PostsController/verPosts",
    type: "GET",
    success: function (response) {
      let posts = JSON.parse(response);
      console.log("parseado", posts);
      let template = "";
      let postTemplate = $("#post-template").html(); // Obtener la plantilla desde el elemento oculto
      posts.forEach((element) => {
        // Reemplazar las variables en la plantilla con los datos del post
        let postHTML = postTemplate
          .replace("{{id}}", element.id)
          .replace("{{title}}", element.title)
          .replace("{{created_at}}", element.created_at)
          .replace("{{description}}", element.description);

        template += postHTML;
      });
      $("#all-posts").html(template);
    },
    error: function (error) {
      console.log(error);
    },
  });
}

//Admin
function listarUsers() {
  $.ajax({
    url: "AdminController/verUsuarios",
    type: "GET",
    success: function (response) {
      let users = JSON.parse(response);
      console.log(users);
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
        let buttonClass = user.state === "1"? "btn btn-danger" : "btn btn-success";

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
