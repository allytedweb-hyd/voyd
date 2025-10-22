/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#classification",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a classification",
            },
        },
        {
            element: "#maker_min",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Mention minimum value",
            },
        },

        {
            element: "#maker_max",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Mention maximum value",
            },
        },

        {
            element: "#material_min",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Mention minimum value",
            },
        },

        {
            element: "#material_max",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Mention maximum value",
            },
        },
    ];

    console.log("validationsss---------------------", validationRules);

    //     $("#add-employee").click(function () {
    //         let IsFormValid = validateFormFields(validationRules);
    //         console.log("validationsss---------------------", IsFormValid);

    //         if (IsFormValid.length > 0) {
    //             swal.fire("Warning", "Enter Mandatory Fields", "warning");
    //             return;
    //         } else {
    //             $("#add-employee").hide();
    //             $("#submit-employee").show();
    //             $("#submit-employee").trigger("click");
    //         }
    //     });
    // });

    // $("#add-employee").click(function (e) {
    //     e.preventDefault();

    //     let IsFormValid = validateFormFields(validationRules);
    //     console.log("validationsss---------------------", IsFormValid);

    //     if (IsFormValid.length > 0) {
    //         Swal.fire("Warning", "Enter Mandatory Fields", "warning");
    //         return;
    //     }

    //     let makerMin = parseFloat($("#maker_min").val());
    //     let makerMax = parseFloat($("#maker_max").val());
    //     let materialMin = parseFloat($("#material_min").val());
    //     let materialMax = parseFloat($("#material_max").val());

    //     if (
    //         isNaN(makerMin) ||
    //         isNaN(makerMax) ||
    //         isNaN(materialMin) ||
    //         isNaN(materialMax)
    //     ) {
    //         Swal.fire(
    //             "Error",
    //             "Please enter valid numeric values for all min and max fields.",
    //             "error"
    //         );
    //         return;
    //     }

    //     if (makerMin > makerMax) {
    //         Swal.fire(
    //             "Error",
    //             "Maker Min value cannot be greater than Maker Max value.",
    //             "error"
    //         );
    //         return;
    //     }

    //     if (materialMin > materialMax) {
    //         Swal.fire(
    //             "Error",
    //             "Material Min value cannot be greater than Material Max value.",
    //             "error"
    //         );
    //         return;
    //     }

    //     $("#add-employee").hide();
    //     $("#submit-employee").show();
    //     $("#submit-employee").trigger("click");
    // });

    $("#add-employee").click(function (e) {
        e.preventDefault();

        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            Swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        }

        let makerMin = parseFloat($("#maker_min").val());
        let makerMax = parseFloat($("#maker_max").val());
        let materialMin = parseFloat($("#material_min").val());
        let materialMax = parseFloat($("#material_max").val());

        if (
            isNaN(makerMin) ||
            isNaN(makerMax) ||
            isNaN(materialMin) ||
            isNaN(materialMax)
        ) {
            Swal.fire(
                "Error",
                "Please enter valid numeric values for all min and max fields.",
                "error"
            );
            return;
        }

        if (makerMin > makerMax) {
            Swal.fire(
                "Error",
                "Maker Min value cannot be greater than Maker Max value.",
                "error"
            );
            return;
        }

        if (materialMin > materialMax) {
            Swal.fire(
                "Error",
                "Material Min value cannot be greater than Material Max value.",
                "error"
            );
            return;
        }

        if (makerMin === makerMax) {
            Swal.fire(
                "Error",
                "Maker Min and Max cannot be the same.",
                "error"
            );
            return;
        }

        if (materialMin === materialMax) {
            Swal.fire(
                "Error",
                "Material Min and Max cannot be the same.",
                "error"
            );
            return;
        }

        if (
            makerMin === makerMax &&
            makerMin === materialMin &&
            makerMin === materialMax
        ) {
            Swal.fire("Error", "All values cannot be the same.", "error");
            return;
        }

        $("#add-employee").hide();
        $("#submit-employee").show();
        $("#submit-employee").trigger("click");
    });
});
