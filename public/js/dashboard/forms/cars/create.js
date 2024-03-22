let brandsSp = $("#brand-sp");
let modelsSp = $("#model-sp");
let priceFieldInp = $("#price-field-val");
let priceInp = $("#price_inp");
let discountInp = $("#discount_price_inp");
let carColorsDiv = $("#car-colors");
let previouslySelected = [];

$(document).ready(() => {
    brandsSp.change(function () {
        let selectedBrandId = $(this).val();
        let selectedBrandName = brands.find(
            (brand) => brand.id == selectedBrandId
        ).name;
    });

    $("#discount-price-switch").change(function () {
        discountInp.prop("disabled", !$(this).prop("checked"));
    });

    $("#other-radio-btn").click(function () {
        $("#price-other-modal").modal("show");
    });

    $("#price-other-text-btn").click(function () {
        let priceFieldVal = $("#other_text_" + locale.trim() + "_inp").val();
        priceFieldInp.text(priceFieldVal);
        $("#price-other-modal").modal("hide");
    });

    priceInp.keyup(() => changePriceField());

    discountInp.keyup(function () {
        if (parseInt($(this).val()) >= parseInt(priceInp.val())) {
            $(this).val("");
            warningAlert(__("Discount price must be smaller than the price"));
        }

        changePriceField();
    });

    $(document).on("click", "[id*=images_upload_btn]", function () {
        $(this).prev().trigger("click");
    });

    $(document).on("change", "[id*=_images_inp]", function () {
        let filesNumber = $(this)[0].files.length;
        $(this)
            .next()
            .html(
                `<i class="bi bi-upload fs-8" ></i> ${filesNumber} ${
                    filesNumber === 1 ? "file" : "files"
                } selected`
            );
    });
});

function changePriceField() {
    if (discountInp.val() && priceInp.val()) {
        priceFieldInp.html(
            `<span>${discountInp.val() + currency}  <del> ${
                priceInp.val() + currency
            } </del> </span>`
        );
    } else if (priceInp.val()) {
        priceFieldInp.html(priceInp.val() + currency);
    }
}

let validateStep = async (successCallback) => {
    nextBtn.attr("disabled", true).attr("data-kt-indicator", "on");

    // await tinymce.get("tinymce_description_ar").execCommand("mceSave");
    // await tinymce.get("tinymce_description_en").execCommand("mceSave");

    var filesArray = myDropzone.files.map(function (file) {
        return file;
    });

    let formData = new FormData(document.getElementById("submitted-form"));

    filesArray.forEach(function (file) {
        formData.append("car_Images[]", file);
    });

    $.ajax({
        url: "/dashboard/car-validate",
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: formData,
        contentType: false,
        processData: false,
        success: () => {
            // myDropzone.processQueue();
            successAlert().then(() =>
                window.location.replace("/dashboard/cars")
            );
            removeValidationMessages();
        },
        error: (response) => {
            removeValidationMessages();

            if (response.status === 422)
                displayValidationMessages(response.responseJSON.errors);
            else if (response.status === 403) unauthorizedAlert();
            else errorAlert({ time: 5000 });

            if (
                response.status === 422 &&
                (response.responseJSON.errors["other_text_ar"] ||
                    response.responseJSON.errors["other_text_en"])
            )
                $("#price-other-modal").modal("show");
        },
        complete: () => {
            nextBtn.attr("disabled", false).removeAttr("data-kt-indicator");
        },
    });
};
