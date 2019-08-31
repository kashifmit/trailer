$(document).ready(function () {
    
    $('.nav-trigger').on('click', this, function(){

        var icon = $(this).find('.fas');

        if ( icon.hasClass('fa-bars') ) {
            $(icon).removeClass('fa-bars').addClass('fa-times');
        }
        else {
            $(icon).removeClass('fa-times').addClass('fa-bars');
        }

        $('body').toggleClass('menu-collapsed');

    });
    
});
