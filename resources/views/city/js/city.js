(async () => {
  const httpModule = await import(`${base_url}/public/js/common-methods/http-requests.js`);
  const toastModule = await import(`${base_url}/public/js/common-methods/toasters.js`);

  // Use the imported functions
  const { ajaxPostRequest, ajaxGetRequest } = httpModule;
  const { errorMessage, successMessage } = toastModule;

  $(function () {
    //Click to Button

    $("#createNewCity").click(function () {
      $("#id").val("");
      $("#cityForm").trigger("reset");
      $("#modelHeading").html("Create New City");
      $("#ajaxModel").modal("show");
    });

    // Click to Edit Button

    $("body").on("click", "#editCity", function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();
      var city_id = $(this).data("id");
      ajaxGetRequest(base_url + "/city/edit" + "/" + city_id)
        .then(function (data) {
          $("#modelHeading").html("Edit City");
          const form = document.getElementById("cityForm");
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

    $("#cityForm").submit(function (e) {
      e.preventDefault();
      ajaxPostRequest(
        base_url + "/city/store",
        $("#cityForm").serialize()
      )
        .then(function (data) {
          $("#cityForm").trigger("reset");
          $("#ajaxModel").modal("hide");
          initDataTablecity_table();
        })
        .catch(function (err) {
          errorMessage(err.message);
        });
    });

    //status

  $("body").on("click", "#active", function () {
    var city_id = $(this).data("id");
    ajaxGetRequest(
      base_url + "/city/status" + "/" + city_id
    )
      .then(function (data) {
        initDataTablecity_table();
      })
      .catch(function (err) {
        errorMessage(err.message);
      });
  });
    // Delete Code

    $("body").on("click", "#deleteCity", function () {
      var city_id = $(this).data("id");
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
            base_url + "/city/destroy" + "/" + city_id
          )
            .then(function (data) {
              successMessage(data.Message);
              initDataTablecity_table();
            })
            .catch(function (err) {
              errorMessage(err.message);
            });
        }
      });
    });
  });
})();
