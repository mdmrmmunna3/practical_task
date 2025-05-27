// $(document).ready(function () {
//     reloadTasks();
//     $('#taskFrom').on('submit', function (e) {
//         e.preventDefault();

//         $.post('insert.php', {
//             title: $('#title').val(),
//             description: $('#description').val()
//         }, function (res) {
//             if (res.trim() === 'success') {
//                 window.location.href = 'display.php';
//             } else {
//                 alert(res);
//             }
//         });
//     });

//     function reloadTasks() {
//         $.get('display.php', function(data) {
//             $('#allTask').html(data);
//         })
//     }

//     $(document).on('click', '#delete', function() {
//         if(confirm('Delete this task?')) {
//             const id = $(this).data('id');
//             $.post('display.php', {id}, reloadTasks);
//         }
//     })
// })