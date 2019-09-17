$(document).ready(function () {
    
    $('.nav-trigger').on('click', this, function(){
        $('body').toggleClass('menu-collapsed');
    });

    $('.nav-overlay').on('click', this, function(){
        $('body').removeClass('menu-collapsed');
    });

    $('.datepicker').datepicker();

    $('.selectable-box').select2();
    
});
