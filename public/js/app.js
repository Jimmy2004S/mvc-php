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
      posts.forEach((element) => {
        template += `
        <div class="col-sm-12 col-md-6">
            <div post-id="${element.id}" class="shadow-lg mb-5 bg-body-tertiary rounded card border-primary mb-3"
            style="height: 90%;">
                <div class="card-header">
                    <h4 class="card-title">${element.title}</h4>
                    <h6 class="card-subtitle text-muted">${element.created_at}</h6>
                </div>
                <img src="https://picsum.photos/400/200" alt="" />
                <div class="card-body">
                    <p class="card-text">${element.description}</p>
                    <a href="#" target="blank" class="card-link">Link 1</a>
                    <a href="#" class="card-link">Link 2</a>
                </div>
                <div class="card-footer text-muted d-flex">
                    <div class="col-10">
                        <p></p>
                    </div>
                    <div  class="col-2">
                        <p class="m-0"></p>
                    </div>
                </div>
            </div>
        </div>
        `;
        $("#all-posts").html(template);
      });
    },
    error: function (error) {
      console.log(error);
    },
  });
}
