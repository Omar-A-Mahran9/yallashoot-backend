$('#form_repeater').repeater({
    initEmpty: false,
    isFirstItemUndeletable: true,
    show: function () {
        $(this).slideDown();
        $(this).find('input').prop('readonly',false);
        $(this).find('.status-order').html( $('.status-order').length + ' - ' + __("Name in arabic") )
    },

    hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
    }
});
