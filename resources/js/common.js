$(document).ready(function() {
    let url = window.location.origin;

    $('.review').submit(function(e) {
        e.preventDefault();
        let data = $(this).serializeArray();
        let comment = '';
        let vote = '';
        $.ajax({
            type: "POST",
            url: url + '/review',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function(response) {
                for (let i = 1; i <= 5; i++) {
                    if (i == response.data.vote) {
                        vote += `<i class="icon-smile voted" checked></i>`
                    } else {
                        vote += `<i class="icon-smile"></i>`
                    }
                }
                comment += `
                <div class="review_strip_single">
                    <small> - ${response.data.created_at} -</small>
                    <label>${response.data.name}</label>
                    <div class="rating">` +
                    vote +
                    `</div>
                    <p>
                        ${response.data.comment}
                    </p>
                </div>
                `;
                $('.comment').prepend(comment)
                console.log(response.data);
            }
        });
    });


    $('.logout').click(function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: url + '/logout',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function() {
                location.reload();
            }
        });
    });
});