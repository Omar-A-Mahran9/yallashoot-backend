var brandSp = $(`#brandSp`);
var modelSp = $(`#modelSp`);
var categorySp = $(`#categorySp`);
var carSp = $(`#carSp`);


brandSp.change(function () {

    let selectedBrandId = jQuery(this).val();

    $.ajax({
        url: `/get-brand-parent-models/${selectedBrandId}`,
        method: "GET",
        success: (response) => {

            modelSp.empty();
            modelSp.removeAttr('disabled');

            // modelSp.append(
            // `<option value="" disabled selected>{{ __('Car model') }}</option>`);

            response['models'].forEach((model) => {
                modelSp.append(
                    `<option value="${ model['id'] }" > ${ model['name'] } </option>`
                    )
            });

        }
    });

});


modelSp.on('change',function(){
    
    let selectedModelId = jQuery(this).val();

    $.ajax({
        url:`/get-model-categories/${selectedModelId}`,
        method:'GET',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: (res) => {
            categorySp.empty();
            categorySp.removeAttr('disabled');

            // categorySp.append(
            // `<option value="" disabled selected>{{ __('Car category') }}</option>`);

            response['categories'].forEach((category) => {
                categorySp.append(
                    `<option value="${ category['id'] }" > ${ category['name'] } </option>`
                    )
            });
        }
    });
});


categorySp.on('change',function(){
    
    let selectedCategoryId = jQuery(this).val();

    $.ajax({
        url:`/get-category-cars/${selectedCategoryId}`,
        method:'GET',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: (res) => {
            carSp.empty();
            carSp.removeAttr('disabled');

            // carSp.append(
            // `<option value="" disabled selected>{{ __('Car') }}</option>`);

            response['cars'].forEach((car) => {
                carSp.append(
                    `<option value="${ car['id'] }" > ${ car['name'] } </option>`
                    )
            });
        }
    });
});

carSp.on('change',function(){
    let car_id = $(this).find(':selected').val();
    $(`#carSp option[value="${car_id}"],#carSp_2 option[value="${car_id}"]`).attr('selected',true)
    $(`input[name="car_id"]`).val(car_id)

    $.ajax({
        url:`/select-car-purchase/${car_id}`,
        method:'GET',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data : {},
        success: (res) => {
            $(`#carCard`).html(res);
            $(`#carCard`).show();
        }
    });
});

$('.submitted-calculator-for-car-form').submit(function (event) {

    event.preventDefault();
    let form      = $(this);
    let submitBtn = form.find("button[type='submit']");
    let formData  = new FormData( this );
    let loadingSpinner = form.find('.loading-spinner')
    submitBtn.attr('disabled',true);
    loadingSpinner.removeClass('d-none');

    $.ajax({
        method:form.attr('method'),
        url:form.attr('action'),
        data:formData,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        processData:false,
        contentType: false,
        cache: false,
        enctype: 'multipart/form-data',
        success:function (response) {
            $('.calculation-for-car-result').show();
            $('#car-selected-for-calculation').html(response.car);
            $('#calculation-for-car-result-bank-name').text(response.bank.name);
            $('#calculation-for-car-result-bank-image').attr('src',`/storage/Images/Banks/${response.bank.image}`);
            $('#calculation-for-car-result-monthly-installment').text(Math.round(response.monthly_installment));
            $('#calculation-for-car-result-installment').text(response.years)
            if(response.lwest_monthly_installment != null){
                $('.calculation-for-car-result-lowest-monthly-installment').text(Math.round(response.lwest_monthly_installment.monthlyInstallment));
                $('#lwest_monthly_installment').show();
            }
            if(response.lwest_monthly_installment == null){
                $('#lwest_monthly_installment').hide();
            }
            $('.submitted-calculator-for-car-form').hide();
        },
        error:function (response) {

            removeValidationMessages();

            if (response.status === 422)
                displayValidationMessages(response.responseJSON.errors , form.data('trailing'));
            else
                errorAlert({ time: 5000 })
        },
        complete:function () {
            submitBtn.attr('disabled',false);
            loadingSpinner.addClass('d-none');
        }
    });
})

$('#calculate-installments-again,#calculate-installments-back-btn').on('click',function(){
    $('#calculation-installment-result-contanier').hide();
    $('.submitted-calculator-for-car-form').show();
});