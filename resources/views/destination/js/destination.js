(async () => {
  const httpModule = await import(`${base_url}/public/js/common-methods/http-requests.js`);
  const toastModule = await import(`${base_url}/public/js/common-methods/toasters.js`);

  // Use the imported functions
  const { ajaxPostRequest, ajaxGetRequest } = httpModule;
  const { errorMessage, successMessage } = toastModule;

  $(function () {
    //Click to Button

    $("#createNewDestination").click(function () {
      $("#id").val("");
      $("#destinationForm").trigger("reset");
      $("#modelHeading").html("Create New Destination");
      $("#ajaxModel").modal("show");
    });

    // Click to Edit Button

    $("body").on("click", "#editDestination", function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();
      var destination_id = $(this).data("id");
      ajaxGetRequest(base_url + "/destination/edit" + "/" + destination_id)
        .then(function (data) {
          $("#modelHeading").html("Edit Destination");
          const form = document.getElementById("destinationForm");
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

    $("#destinationForm").submit(function (e) {
      e.preventDefault();
      ajaxPostRequest(
        base_url + "/destination/store",
        $("#destinationForm").serialize()
      )
        .then(function (data) {
          $("#destinationForm").trigger("reset");
          $("#ajaxModel").modal("hide");
          initDataTabledestination_table();
        })
        .catch(function (err) {
          errorMessage(err.message);
        });
    });

    //status

  $("body").on("click", "#active", function () {
    var destination_id = $(this).data("id");
    ajaxGetRequest(
      base_url + "/destination/status" + "/" + destination_id
    )
      .then(function (data) {
        initDataTabledestination_table();
      })
      .catch(function (err) {
        errorMessage(err.message);
      });
  });
    // Delete Code

    $("body").on("click", "#deleteDestination", function () {
      var destination_id = $(this).data("id");
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
            base_url + "/destination/destroy" + "/" + destination_id
          )
            .then(function (data) {
              successMessage(data.Message);
              initDataTabledestination_table();
            })
            .catch(function (err) {
              errorMessage(err.message);
            });
        }
      });
    });
  });
})();
