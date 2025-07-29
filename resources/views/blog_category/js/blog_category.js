(async () => {
  const httpModule = await import(`${base_url}/public/js/common-methods/http-requests.js`);
  const toastModule = await import(`${base_url}/public/js/common-methods/toasters.js`);

  // Use the imported functions
  const { ajaxPostRequest, ajaxGetRequest } = httpModule;
  const { errorMessage, successMessage } = toastModule;

  $(function () {
    //Click to Button

    $("#createNewBlogCategory").click(function () {
      $("#id").val("");
      $("#blog_categoryForm").trigger("reset");
      $("#modelHeading").html("Create New Blog Category");
      $("#ajaxModel").modal("show");
    });

    // Click to Edit Button

    $("body").on("click", "#editBlogCategory", function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();
      var blog_category_id = $(this).data("id");
      ajaxGetRequest(base_url + "/blog-category/edit" + "/" + blog_category_id)
        .then(function (data) {
          $("#modelHeading").html("Edit Blog Category");
          const form = document.getElementById("blog_categoryForm");
          for (let index = 0; index < form.length; index++) {
            const element = form[index];
            if (element && element.value != "Save" && element.name != "id")
              element.value = data[element.name];
            if (element.name == "id") element.value = data.id;
          }
          $("#ajaxModel").modal("show");
        })
        .catch(function (err) {
          // Run this when promise was rejected via reject()
          errorMessage(err.message);
        });
    });

    // Save/Update Code

    $("#blog_categoryForm").submit(function (e) {
      e.preventDefault();
      ajaxPostRequest(
        base_url + "/blog-category/store",
        $("#blog_categoryForm").serialize()
      )
        .then(function (data) {
          $("#blog_categoryForm").trigger("reset");
          $("#ajaxModel").modal("hide");
          initDataTableblog_category_table();
        })
        .catch(function (err) {
          errorMessage(err.message);
        });
    });

    //status

  $("body").on("click", "#active", function () {
    var blog_category_id = $(this).data("id");
    ajaxGetRequest(
      base_url + "/blog-category/status" + "/" + blog_category_id
    )
      .then(function (data) {
        initDataTableblog_category_table();
      })
      .catch(function (err) {
        errorMessage(err.message);
      });
  });
    // Delete Code

    $("body").on("click", "#deleteBlogCategory", function () {
      var blog_category_id = $(this).data("id");
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          ajaxGetRequest(
            base_url + "/blog-category/destroy" + "/" + blog_category_id
          )
            .then(function (data) {
              successMessage(data.Message);
              initDataTableblog_category_table();
            })
            .catch(function (err) {
              errorMessage(err.message);
            });
        }
      });
    });
  });
})();
