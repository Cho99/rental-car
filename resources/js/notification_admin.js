var url = window.location.origin;

function callApiNotification() {
    $.ajax({
        url: url + '/admin/notification',
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            var number = 0;
            var data = [];

            if (res.data.length != '') {
                res.data.map(function(list) {
                    if (list.read_at == null) {
                        number++;
                    }

                    data = JSON.parse(list.data);

                    $('.number-noti').text(number);
                    $('.number-noti-message').text(`Bạn có ${number} thông báo chưa đọc`);

                    $('.noti-data').prepend(
                        `<li>
                            <a href="${url + '/admin/detail-notification/' + list.id}">
                                <i class="fa fa-user text-red"></i>
                                <b> ${data.user_name} </b>
                                ${data.content} : ${data.license_plates}
                            </a>
                        </li>`
                    );
                });
            }

            if (number == 0 || res.data.length == '') {
                $('.number-noti').text('');
                $('.number-noti-message').text(`Bạn chưa có thông báo nào`);
                $('.noti-data').text('');
            }

            getNotification(number);
        },
    })
}

callApiNotification();

function getNotification(number) {
    Echo.channel('my-channel')
        .listen('RegisterCarEvent', (e) => {
            number++;
            console.log(e);
            $.ajax({
                url: url + '/admin/notification-for-admin',
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    var userId = res.user_id;
                    var usersId = e.message.users;
                    var checkPusher = false;

                    usersId.map(function(index) {
                        if (userId == index) {
                            checkPusher = true;
                        }
                    })

                    if (checkPusher) {
                        $('.noti-data').empty();
                        callApiNotification();
                    }
                },
            })
        });
}