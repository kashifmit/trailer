$(document).ready(function () {
    
    $('.nav-trigger').on('click', this, function(){
        $('body').toggleClass('menu-collapsed');
    });

    $('.datepicker').datepicker();

    $('.selectable-box').select2();
    
});
