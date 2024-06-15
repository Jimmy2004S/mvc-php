$(document).ready(function () {
  console.log("Hello world!");
  listarPosts();
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
