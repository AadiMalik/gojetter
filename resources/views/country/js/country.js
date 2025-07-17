(async () => {
  const httpModule = await import(`${base_url}/public/js/common-methods/http-requests.js`);
  const toastModule = await import(`${base_url}/public/js/common-methods/toasters.js`);

  // Use the imported functions
  const { ajaxPostRequest, ajaxGetRequest } = httpModule;
  const { errorMessage, successMessage } = toastModule;

  $(function () {
    //Click to Button

    $("#createNewCountry").click(function () {
      $("#id").val("");
      $("#countryForm").trigger("reset");
      $("#modelHeading").html("Create New Country");
      $("#ajaxModel").modal("show");
    });

    // Click to Edit Button

    $("body").on("click", "#editCountry", function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();
      var country_id = $(this).data("id");
      ajaxGetRequest(base_url + "/country/edit" + "/" + country_id)
        .then(function (data) {
          $("#modelHeading").html("Edit Country");
          const form = document.getElementById("countryForm");
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

    $("#countryForm").submit(function (e) {
      e.preventDefault();
      ajaxPostRequest(
        base_url + "/country/store",
        $("#countryForm").serialize()
      )
        .then(function (data) {
          $("#countryForm").trigger("reset");
          $("#ajaxModel").modal("hide");
          initDataTablecountry_table();
        })
        .catch(function (err) {
          errorMessage(err.message);
        });
    });

    //status

  $("body").on("click", "#active", function () {
    var country_id = $(this).data("id");
    ajaxGetRequest(
      base_url + "/country/status" + "/" + country_id
    )
      .then(function (data) {
        initDataTablecountry_table();
      })
      .catch(function (err) {
        errorMessage(err.message);
      });
  });
    // Delete Code

    $("body").on("click", "#deleteCountry", function () {
      var country_id = $(this).data("id");
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
            base_url + "/country/destroy" + "/" + country_id
          )
            .then(function (data) {
              successMessage(data.Message);
              initDataTablecountry_table();
            })
            .catch(function (err) {
              errorMessage(err.message);
            });
        }
      });
    });
  });
})();
