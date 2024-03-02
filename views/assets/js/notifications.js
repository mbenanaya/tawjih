$(function() {

    function loadNotifications() {
        var student_id = $('#student_id').val()
        $.ajax({
            type: "post",
            url: "./controllers/NotificationsController.php",
            data: { student_id: student_id, action: "showNotifs" },
            dataType: "json",
            success: function(data) {
                $('#notifs_list').html(data.notifications)
                $('#all_notifs').html(data.notifications)
                $('#count').html(data.count)
                $('#allNotifsModal .view_all').remove()
                $('#allNotifsModal .dropdown-divider').remove()
                $('#all_notifs li').css({
                    'margin-top': '0.3rem',
                    'margin-bottom': '0.3rem',
                    'border-radius': '.4rem',
                })
                $('#all_notifs .dropdown-header').css({ 'font-size': '1.25rem', 'padding-top': '.75rem', 'padding-bottom': '.75rem' })
            },
            error: function(xhr, text, error) {
                console.log(text, error)
            }
        });
    }

    loadNotifications();

    setInterval(function() {
        loadNotifications();
    }, 5000);

    $(document).on('click', '.notif_concours', function() {
        var id_notif = $(this).data('id');
        var student_id = $('#student_id').val()

        $.ajax({
            type: "post",
            url: "./controllers/NotificationsController.php",
            data: { id_notif: id_notif, student_id: student_id, action: "updNotStatus" },
            success: function(data) {
                loadNotifications();
            },
            error: function(xhr, text, error) {
                console.log(error)
            }
        });
    });

});