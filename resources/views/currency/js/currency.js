(async () => {
  const httpModule = await import(`${base_url}/public/js/common-methods/http-requests.js`);
  const toastModule = await import(`${base_url}/public/js/common-methods/toasters.js`);

  // Use the imported functions
  const { ajaxPostRequest, ajaxGetRequest } = httpModule;
  const { errorMessage, successMessage } = toastModule;

  $(function () {
    //Click to Button

    $("#createNewCurrency").click(function () {
      $("#id").val("");
      $("#currencyForm").trigger("reset");
      $("#modelHeading").html("Create New Currency");
      $("#ajaxModel").modal("show");
    });

    // Click to Edit Button

    $("body").on("click", "#editCurrency", function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();
      var currency_id = $(this).data("id");
      ajaxGetRequest(base_url + "/currency/edit" + "/" + currency_id)
        .then(function (data) {
          $("#modelHeading").html("Edit Currency");
          const form = document.getElementById("currencyForm");
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

    $("#currencyForm").submit(function (e) {
      e.preventDefault();
      ajaxPostRequest(
        base_url + "/currency/store",
        $("#currencyForm").serialize()
      )
        .then(function (data) {
          $("#currencyForm").trigger("reset");
          $("#ajaxModel").modal("hide");
          initDataTablecurrency_table();
        })
        .catch(function (err) {
          errorMessage(err.message);
        });
    });

    //default

  $("body").on("click", "#default", function () {
    var currency_id = $(this).data("id");
    ajaxGetRequest(
      base_url + "/currency/default" + "/" + currency_id
    )
      .then(function (data) {
        initDataTablecurrency_table();
      })
      .catch(function (err) {
        errorMessage(err.message);
      });
  });
    // Delete Code

    $("body").on("click", "#deleteCurrency", function () {
      var currency_id = $(this).data("id");
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
            base_url + "/currency/destroy" + "/" + currency_id
          )
            .then(function (data) {
              successMessage(data.Message);
              initDataTablecurrency_table();
            })
            .catch(function (err) {
              errorMessage(err.message);
            });
        }
      });
    });
  });
})();
