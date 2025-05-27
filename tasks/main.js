$(document).ready(function () {
    reloadTasks();
    $('#taskFrom').on('submit', function (e) {
        e.preventDefault();
        $.post('add_task.php', $(this).serialize(), function () {
            reloadTasks();
            $('$taskFrom')[0].reset();
        })
    });

    function reloadTasks() {
        $.get('display.php', function(data) {
            $('#allTask').html(data);
        })
    }

    $(document).on('click', '#delete', function() {
        if(confirm('Delete this task?')) {
            const id = $(this).data('id');
            $.post('display.php', {id}, reloadTasks);
        }
    })
})