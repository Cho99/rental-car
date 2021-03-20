$(document).ready(function() {
    $("#user-menu").click(function(e) {
        console.log($('#user-menu').addClass('open'));
        $('#user-menu').addClass('open');
    });
});

$(document).ready(function() {
    $(".notifications-menu").click(function(e) {
        $('.notifications-menu').addClass('open');
    });
});