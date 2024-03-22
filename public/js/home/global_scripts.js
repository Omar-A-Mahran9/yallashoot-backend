let removeValidationMessages = function() {
    /** Remove All Validation Messages **/

    let errorElements = $('.invalid-feedback');

    errorElements.html('').css('display','none');

    $('form .form-control').removeClass('is-invalid is-valid') // remove validation borders

}

let displayValidationMessages = function(errors, trailing = "") {
    removeValidationMessages();

    $('#submitted-form .form-control').addClass('is-valid') // remove validation borders

    /** Display All Validation Messages **/
    $.each(errors, function(elementId, errorMessage) {

        elementId = elementId.replaceAll('.','_');

        let errorInput   = $("#" + elementId + '_inp'+ trailing );
        let errorElement = $("#" + elementId + trailing);

        if (errorElement != null)
            errorElement.html(errorMessage).css('display','block')
        if (errorInput   != null)
            errorInput.addClass('is-invalid')

    });

    /** scroll to the first error element **/
    let firstErrorElementId = Object.keys(errors)[0].replaceAll('.','_');

    let firstErrorElement   = document.getElementById(firstErrorElementId + trailing);

    firstErrorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });


}


/** Begin :: System Alerts  **/


let errorAlert = function(message = __("something went wrong"), time = 5000) {
    return new swal({
        text: __(message),
        icon: "error",
        buttonsStyling: false,
        showConfirmButton: false,
        timer: time,
        customClass: {
            confirmButton: "btn fw-bold btn-primary",
        }
    });
}

let successAlert = function(message = __("Operation done successfully") , timer = 2000) {

    return new swal({
        text: message,
        icon: "success",
        buttonsStyling: false,
        showConfirmButton: false,
        timer: timer
    });

}

let warningAlert        = function(title , message , time = 5000) {
    return new swal.fire({
        title: __(title),
        text: __(message),
        icon: "warning",
        showConfirmButton: false,
        timer: time
    });
}

let loadingAlert  = function(message = __("Loading...") ) {

    return  new swal({
        text: message,
        icon: "info",
        buttonsStyling: false,
        showConfirmButton: false,
        timer: 2000
    });

}

let favLoadingAlert = function (message = __("Loading...")) {
    return new swal({
        text: message,
        icon: "",
        html: `
            <div class="p-5">
                <i class="fas fa-heart fa-2x mb-4" style="color: red;"></i><br>
                <h5>${message}</h5>
            </div>
        `,
        buttonsStyling: false,
        showConfirmButton: false,
        timer: 3000,
    });
};

let getImagePath = function(directory,imageName) {

    return imagesBasePath + '/' + directory + '/' + imageName;
}

/** End :: System Alerts  **/


$(document).ready(function () {

    /** Start :: change "price word" and "SAR WORD" translations from car components  **/
    $('.currency-value').html( ' ' + __(currency) );
    $('.price-word').html( __('Price') + ' ' );
    /** End   :: change "price word" and "SAR WORD" translations from car components  **/

    /** Start :: add remove from favourites  **/
    $(document).on('click','.favourite-btn', function (event) {

        event.preventDefault();

        let carId            = $(this).data('car-id');
        let status = jQuery(this).attr("data-checked");
        favLoadingAlert(
            __(
                status == 0 ? "Adding car to FAV" : "Removing car from FAV"
            )
        );

        $.ajax({
            url:'/add-remove-favourite',
            method:'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data : { carId , addedToFavourite: $(this).data('checked') },
            success: (res) => {

                if(res.count == 0)
                   $('#favIcon').removeClass('text-danger');
                else
                   $('#favIcon').addClass('text-danger');

                if ( $(this).attr('data-checked') == 1 )
                {
                    $(this).attr('data-checked',0);
                    $(this).removeClass('active')
                    window.location.reload();
                }
                else
                {
                    $(this).attr('data-checked',1);
                    $(this).addClass('active')
                }

            }
        });

    });
    /** End   :: add remove from favourites  **/

    /** Start :: ajax request form  **/
    $('.submitted-form').submit(function (event) {

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
            success:function () {
                // remove all validation messages
                removeValidationMessages();

                // reset the form
                    form.trigger('reset');
                    $('select').val(null);
                // reset the form

                successAlert( form.data('success-message') ).then( () => {
                    if ( form.data('redirection-url') !== "#" )
                        window.location.replace( form.data('redirection-url') )
                });
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
    /** End   :: ajax request form  **/

    /** customizing select2 message */

    if( $('select').length )
    {

        $('select').select2({
            "language": {
            "noResults": function(){ return __("No results found"); }
            }
        })

    }

    var ua = window.navigator.userAgent;
    var IS_IPAD = ua.match(/iPad/i) != null,
    IS_IPHONE = !IS_IPAD && ((ua.match(/iPhone/i) != null) || (ua.match(/iPod/i) != null)),
    IS_IOS = IS_IPAD || IS_IPHONE,
    IS_ANDROID = !IS_IOS && ua.match(/android/i) != null,
    IS_MOBILE = IS_IOS || IS_ANDROID;
    if(IS_IPAD || IS_IPHONE || IS_IOS || IS_ANDROID || IS_MOBILE){
        $(`.a_facebook`).on('click',function(e){
            e.preventDefault();
            try{
                window.location.href = $(this).attr('href');
                // window.location.href = `facebook://profile/100063830442436`;
            }catch(error){
                window.location.href = $(this).attr('href');
            }
        })

        $(`.a_youtube`).on('click',function(e){
            e.preventDefault();
            try{
                let youtube = removeTrailingSlash(String($(`.a_youtube`).attr('href')));
                youtube = youtube.substring(youtube.lastIndexOf("/") + 1);
                window.location.href = `youtube://channel/${youtube}`;
            }catch(error){
                window.location.href = $(this).attr('href');
            }
        })

        $(`.a_tiktok`).on('click',function(e){
            e.preventDefault();
            try{
                let tiktok = removeTrailingSlash(String($(`.a_tiktok`).attr('href')));
                tiktok = tiktok.substring(tiktok.lastIndexOf("/") + 1);
                window.location.href = `tiktok://@mostafa.ashraf14`;
            }catch(error){
                window.location.href = $(this).attr('href');
            }
        })

        $(`.a_whatsapp`).on('click',function(e){
            e.preventDefault();
            try{
                let whatsapp =  removeTrailingSlash(String($(`.a_whatsapp`).attr('href')));
                whatsapp = whatsapp.substring(whatsapp.lastIndexOf("/") + 1);
                window.location.href = `whatsapp://send?phone=${whatsapp}`
            }catch(error){
                window.location.href = $(this).attr('href');
            }
        })

        $(`.a_instagram`).on('click',function(e){
            e.preventDefault();
            try{
                let instagram =  removeTrailingSlash(String($(`.a_instagram`).attr('href')));
                instagram = instagram.substring(instagram.lastIndexOf("/") + 1);
                window.location.href = `instagram://user?username=${instagram}`
            }catch(error){
                window.location.href = $(this).attr('href');
            }
        })

        $(`.a_linkedin`).on('click',function(e){
            e.preventDefault();
            try{
                let linkedin =  removeTrailingSlash(String($(`.a_linkedin`).attr('href')));
                linkedin = linkedin.substring(linkedin.lastIndexOf("/") + 1);
                window.location.href = `linkedin://profile/company/${linkedin}`
            }catch(error){
                window.location.href = $(this).attr('href');
            }
        })

        $(`.a_snapchat`).on('click',function(e){
            e.preventDefault();
            try{
                let snapchat =  removeTrailingSlash(String($(`.a_snapchat`).attr('href')));
                snapchat = snapchat.substring(snapchat.lastIndexOf("/") + 1);
                window.location.href = `snapchat://add/${snapchat}`;
            }catch(error){
                window.location.href = $(this).attr('href');
            }
        })

        $(`.a_twitter`).on('click',function(e){
            e.preventDefault();
            try{
                let twitter =  removeTrailingSlash(String($(`.a_twitter`).attr('href')));
                twitter = twitter.substring(instagram.lastIndexOf("/") + 1);
                window.location.href = `twitter://${twitter}`;
            }catch(error){
                window.location.href = $(this).attr('href');
            }
        })
    }

    function removeTrailingSlash(str) {
        return str.replace(/\/+$/, '');
    }

})
