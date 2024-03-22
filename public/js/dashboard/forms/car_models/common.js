let parentModelsSp = $("#parent-model-sp");
let brandsSp       = $("#brand-sp");

$(document).ready( () => {

    brandsSp.change( function (event,selectedModelId = null) {

        let selectedBrandId = $(this).val();

        $.ajax({
            url:`/get-brand-parent-models/${selectedBrandId}` ,
            method:"GET",
            success: (response) => {

                parentModelsSp.empty();

                parentModelsSp.append(`<option></option>`);

                response['models'].forEach( ( model ) => {
                    parentModelsSp.append(`<option value="${ model['id'] }" > ${ model['name'] } </option>`)
                });

                parentModelsSp.val( selectedModelId )

            }
        });

    });

})
