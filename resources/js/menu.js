$(document).ready(function() {
    $("#user-menu").click(function(e) {
        console.log($(this).addClass('open'));
    });
});

$(document).ready(function() {
    $(".notifications-menu").click(function(e) {
        $('.notifications-menu').addClass('open');
    });
});