//Delete function for all grids
$(document).ready(function () {
    $(".row-delete").click(function () {
        var href = $(this).data('href');
        var title = $(this).data('title');
        var delete_button = $(this).parentsUntil('tr').parent();
        if (!confirm('Do you want to delete ' + title + '?')) {
            return false;
        }
        $.ajax({
            url: href,
            type: 'DELETE',
            success: function (data) {
                if (data.type == 1) {
//                    new jBox('Notice', {
//                        content: data.message,
//                        color:'green',
//                    });

                    alert(data.message);
                    delete_button.remove();
                    // setTimeout("location.reload();",100);
                }
                else {
                    alert(data.message);
                    // new jBox('Notice', {
                    //     content: data.message,
                    //     color: 'yellow'
                    // });
                }
            }
        });
    });
});