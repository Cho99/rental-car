var url = window.location.href;
$('#form').submit(function(e) {
    e.preventDefault();
    var name = $('#namecategory').val();
    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        data: {
            'name': name
        },
        success: function(response) {
            $("#example2_wrapper").empty();
            $('#livesearch').html(response);
            var name = $('#namecategory').val('');
            $(".error").text('');
            $('.close').click();
        },
        error: function(error) {
            $(".error").text(error.responseJSON.errors.name);
        }
    });
})