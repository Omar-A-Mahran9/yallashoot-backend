$('input[name="payment_type"]').on('change', function(){
    let paymentType = $(this).val();
    if(paymentType === 'cash' ){
        payment = 'Cash';
        $('.cash-only .form-select').prop('disabled', false);
        $('#next').html("{{__('Place order')}} <i class='fas fa-angle-double-right flip ms-2'></i>");
        $('.cash-only').removeClass('d-none');
        $('.finance-only').hide();

        if($(`#carCard .car-card`).length > 0){
            $(`#carCard`).show();
            $('#aboutCard').hide();
        }else{
            $('#aboutCard').show();
            $(`#carCard`).hide();
        }
    }else{
        payment = 'Finance';
        $('.cash-only .form-select').prop('disabled', true);
        $('#next').html("{{__('Next')}} <i class='fas fa-angle-double-right flip ms-2'></i>");
        $('.cash-only').addClass('d-none');
        $('.finance-only').show();
        $(`#carCard`).hide();
        $('#aboutCard').show();
    }
});

$("#first_installment_inp").change(function (e) {
    e.preventDefault();
    let percentage = $(this).val();
    $("#first_installment_amount").val(carPrice * (percentage / 100));
    });

$("#individual-form").submit(function (e) {
    e.preventDefault();

    submitFormByAjax(this);
});

$(".action.submit").click(function (e) {
    e.preventDefault();

    submitFormByAjax(document.getElementById('individual-form'));
});

function submitFormByAjax(from) {
    submitBtn = $(from).find("button[type='submit']");
    let paymentType = $("[name='payment_type']:checked").val();
    $("#individual-form").attr("action", `/car/${carId}/${colorId}/individual-${paymentType}`);
    $(".spinner-border").removeClass("d-none");

    ajaxSubmission({
        form: from,
        successCallback: function (response) {
            removeValidationMessages();
            if ($('[name="payment_method"]:checked').val() == 'online')
                submitPaymentGatewayFormWith(response.data);
            else{
                displayOrderSuccessAlertWithDataOf(response.data);
                window.scrollTo({top: 0, behavior: 'smooth'});
            }
        },
        errorCallback: function (response) {
            removeValidationMessages();

            if (response.status === 422)
                displayValidationMessages(response.responseJSON.errors , $(from));
            else
                errorAlert(response.responseJSON.message , 5000 );

            $(".spinner-border").addClass("d-none");
            submitBtn.attr('disabled',false)
        }
    });
}

function submitPaymentGatewayFormWith(paymentData) {
    let form = $("#payment-gateway");
    $.each(paymentData, function (key, value) {
        form.append(`<input type="text" name="${key}" value="${value}">`);
    });
    form.submit();
}

function displayOrderSuccessAlertWithDataOf(order) {
    $("#created-data").text(order.created_at);
    $("#address-data").text(order.address_details);
    $("#id-data").text(order.id);
    $("#payment-data").text(translate(order.payment_method) || translate(order.payment_type));
    $("#total-data").text(order.total_price);
    $("[type='submit'], .action.submit").hide();
    $(".info-step").hide();
    $(".cash-info").hide();
    $(".alert-container").show();
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.upload-btn-wrapper').css('background-image', 'url('+e.target.result +')');
            $('.upload-btn-wrapper .btn').text('');
            // $('.upload-btn-wrapper').hide();
            // $('.upload-btn-wrapper').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#bank_receipt_inp").change(function() {
    readURL(this);
});