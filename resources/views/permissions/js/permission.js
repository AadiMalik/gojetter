(async () => {
  const httpModule = await import(`${base_url}/public/js/common-methods/http-requests.js`);
  const toastModule = await import(`${base_url}/public/js/common-methods/toasters.js`);

  // Use the imported functions
  const { ajaxPostRequest, ajaxGetRequest } = httpModule;
  const { errorMessage, successMessage } = toastModule;

  $(function () {
    //Click to Button

    $("#createNewPermission").click(function () {
      $("#id").val("");
      $("#permissionForm").trigger("reset");
      $("#modelHeading").html("Create New Permission");
      $("#ajaxModel").modal("show");
    });

    // Click to Edit Button

    $("body").on("click", "#editPermission", function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();
      var permission_id = $(this).data("id");
      ajaxGetRequest(base_url + "/permissions/edit" + "/" + permission_id)
        .then(function (data) {
          $("#modelHeading").html("Edit Permission");
          const form = document.getElementById("permissionForm");
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

    $("#permissionForm").submit(function (e) {
      e.preventDefault();
      ajaxPostRequest(
        base_url + "/permissions/store",
        $("#permissionForm").serialize()
      )
        .then(function (data) {
          console.log(data)
          $("#permissionForm").trigger("reset");
          $("#ajaxModel").modal("hide");
          initDataTablepermission_table();
        })
        .catch(function (err) {
          errorMessage(err.message);
        });
    });

  });
})();
