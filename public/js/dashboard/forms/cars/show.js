let brandsSp = $("#brand-sp");
let modelsSp = $("#model-sp");
let colorsSp = $("#colors-sp");
let drivingModeSp = $("#driving-mode-sp");
let priceFieldInp = $("#price-field-val");
let priceInp = $("#price_inp");
let discountInp = $("#discount_price_inp");
let carColorsDiv = $("#car-colors");
let undoDeleteBtn = $("#undo-delete-image");
let previouslySelected = [];
let updatedColorsImages = {};
let duplicatedImages = {};

$(document).ready(() => {
    undoDeleteBtn.click(function () {
        let restoredImage = deletedColorsImages.pop();

        let previousImagesArray = JSON.parse(
            updatedColorsImages[restoredImage["color_id"].toString()][
                restoredImage["type"] + "_images"
            ]
        );

        previousImagesArray.push(restoredImage["image"]);

        updatedColorsImages[restoredImage["color_id"].toString()][
            restoredImage["type"] + "_images"
        ] = JSON.stringify(previousImagesArray);

        if (isDuplicating)
            duplicatedImages[restoredImage["color_id"].toString()][
                restoredImage["type"] + "_images"
            ] = previousImagesArray;

        $(
            `#${cleanImageName(restoredImage["image"])}-deleted-image`
        ).removeClass("d-none");

        if (deletedColorsImages.length === 0) {
            undoDeleteBtn.prop("disabled", true);
        } else {
            undoDeleteBtn.prop("disabled", false);
            $("#no-images-text").addClass("d-none");
        }
    });

    $("#discount-price-switch").change(function () {
        discountInp.prop("disabled", !$(this).prop("checked"));
    });

    $("#save-imgs-btn").click(function () {
        Object.entries(updatedColorsImages).map((color) => {
            let colorId = color[0];
            let imagesKey = Object.keys(color[1])[0];
            let images = color[1][imagesKey];

            let colorIndex = carColors.findIndex(
                (color) => color["color_id"] == colorId
            );

            carColors[colorIndex][imagesKey] = images;
        });

        $("#edit-images-modal").modal("hide");
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
                `<i class="bi bi-upload fs-8" ></i> ${filesNumber} ${__(
                    "File selected"
                )}`
            );
    });
});

let changePriceField = () => {
    if (discountInp.val() && priceInp.val()) {
        priceFieldInp.html(
            `<span>${discountInp.val() + currency}  <del> ${
                priceInp.val() + currency
            } </del> </span>`
        );
    } else if (priceInp.val()) {
        priceFieldInp.html(priceInp.val() + currency);
    }
};

let openImagesModal = (type, colorId) => {
    $("#modal-title").text(
        type === "outer" ? __("Outer images") : __("Inner images")
    );

    let selectedColorIndex = carColors.findIndex(
        (color) => color["color_id"] == colorId
    );
    let images = JSON.parse(carColors[selectedColorIndex][type + "_images"]);

    $("#images-container").empty();

    if (images.length > 0) $("#no-images-text").addClass("d-none");
    else $("#no-images-text").removeClass("d-none");

    images.forEach((image) => {
        let imageContainerId = cleanImageName(image) + "-deleted-image";

        $("#images-container").append(`

                <div class="col-md-3 col-12 my-4 text-center" id="${imageContainerId}">

                <div class="image-input image-input-outline" >

                <div class="image-input-wrapper w-100px h-100px" style="background-image: url('${getImagePathFromDirectory(
                    image,
                    "Cars"
                )}'); background-size:contain;"></div>

                    <!-- begin :: Delete button -->
                    <label
                        onclick="deleteColorImage('${selectedColorIndex}','${image}', '${type}')"
                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="change"
                        title="${__("Delete image")}">
                        <i class="bi bi-trash-fill fs-7 text-danger"></i>
                    </label>
                    <!-- end   :: Delete button -->

                </div>
                <!--end::Image input-->

                </div>`);
    });

    $("#edit-images-modal").modal("show");
};

let deleteColorImage = (deletedColorIndex, deletedImage, type) => {
    let deletedColor = Object.create(carColors[deletedColorIndex]);

    deletedColorsImages.push({
        color_id: deletedColor["color_id"],
        image: deletedImage,
        type,
    }); // add the deleted image to deletedColorsImages array to use it in undo operation

    let deletedImages = deletedColorsImages
        .filter((color) => color["color_id"] == deletedColor["color_id"])
        .map((obj) => obj["image"]);
    let images = JSON.parse(deletedColor[type + "_images"]); // get the outer/inner images from the deleted color object and parse the json array
    let filteredImages = images.filter(
        (image) => !deletedImages.includes(image)
    ); // return new outer/inner images array without the deletedImage
    deletedColor[type + "_images"] = JSON.stringify(filteredImages); // update the deletedColor outer/inner images array with the filtered one

    type === "inner"
        ? delete deletedColor.outer_images
        : delete deletedColor.inner_images;

    updatedColorsImages[deletedColor["color_id"]] = {
        ...updatedColorsImages[deletedColor["color_id"]],
        ...deletedColor,
    }; // push the updated color to the updatedColorsImages array

    $(`#${cleanImageName(deletedImage)}-deleted-image`).addClass("d-none"); // hide the deleted image

    undoDeleteBtn.prop("disabled", false); // enable the undo button

    let noElementsVisible = $(`[id*=-deleted-image]`)
        .map(function () {
            // check if all elements is invisible
            return this.getAttribute("class");
        })
        .get()
        .every((element) => element.includes("d-none"));

    if (noElementsVisible)
        // if all elements has d-none class so make the no images text visible
        $("#no-images-text").removeClass("d-none");
    else $("#no-images-text").addClass("d-none");

    if (isDuplicating) {
        duplicatedImages[deletedColor["color_id"]][type + "_images"] =
            duplicatedImages[deletedColor["color_id"]][type + "_images"].filter(
                (image) => image !== deletedImage
            );
    }
};

let validateStep = async (successCallback) => {
    nextBtn.attr("disabled", true).attr("data-kt-indicator", "on");

    await tinymce.get("tinymce_description_ar").execCommand("mceSave");
    await tinymce.get("tinymce_description_en").execCommand("mceSave");
    var filesArray = myDropzone.files.map(function (file) {
        return file;
    });
    let formData = new FormData(document.getElementById("submitted-form"));
    filesArray.forEach(function (file) {
        formData.append("car_Images[]", file);
    });
    $.ajax({
        url: "/dashboard/car-validate/" + carId,
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: formData,
        contentType: false,
        processData: false,
        success: () => {
            removeValidationMessages();
            myDropzone.processQueue();

            window.location.replace("/dashboard/cars");
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

var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
    autoProcessQueue: false,
    url: "/", // Set the url for your upload script location
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    paramName: "car_Images", // The name that will be used to transfer the file
    maxFiles: 10,
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    clickable: false, // enable clicking to add files
    addRemoveLinks: false, // allow removing files

    accept: function (file, done) {
        if (file.name == "wow.jpg") {
            done("Naha, you don't.");
        } else {
            done();
        }
    },
});
setDropzoneImages(myDropzone);

let cleanImageName = (image) => {
    return image.replaceAll("/", "").replaceAll(".", "").replaceAll(" ", "");
};
