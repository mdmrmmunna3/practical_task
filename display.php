<?php
require_once("dbConnect.php");
$message = '';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM tasks WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $message = 'Task deleted successfully.';
    } else {
        $message = 'Something went wrong while deleting task: ' . $conn->error;
    }
    //     $id = $_POST["delete"];
// $conn->query("DELETE FROM tasks WHERE id = '$id'");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .task_btn {
            margin-top: 20px;
        }

        .task_btn a {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            background-color: green;
            color: white;
            font-weight: 600;
            font-family: sans-serif;
            text-decoration: none;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <div class="task_btn">
        <a href="insert.php">Add New Task</a>
    </div>

    <div class="toast align-items-center" id="successToast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <?php echo htmlspecialchars($message); ?>
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>

    <div class="table_container container mt-5">
        <p class="text-center text-uppercase fs-2 text-primary font-serif">Display All Tasks</p>
        <table class="table table-dark table-striped-columns" id="allTask">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once("dbConnect.php");

                $getData = "SELECT * FROM tasks";
                $result = mysqli_query($conn, $getData);

                if ($result && mysqli_num_rows($result) > 0) {
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $checked = $row["status"] ? "checked disabled" : "";
                        echo "<tr>";
                        echo "<th scope='row'>" . $count++ . "</th>";
                        echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
                        echo "<td data-status-id='" . $row["id"] . "'>" . ($row["status"] ? "1" : "0") . "</td>";
                        echo "<td>
                            <input type='checkbox' class='status-checkbox' data-id='" . $row["id"] . "' $checked>
                            <a href='edit.php?editId=" . $row["id"] . "' class='btn btn-sm btn-secondary ms-2'>Edit</a>
                            <a href='?delete=" . $row["id"] . "' class='btn btn-sm btn-danger ms-2' onclick=\"return confirm('Are you sure you want to delete this task?');\">Delete</a>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No tasks found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.status-checkbox').forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const taskId = this.getAttribute('data-id');
                const status = this.checked ? 1 : 0;

                fetch('update_status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + taskId + '&status=' + status,
                })
                    .then(response => response.text())
                    .then(data => {
                        console.log(data);
                        if (status === 1) {
                            checkbox.disabled = true;

                            // Update status cell text
                            const statusCell = document.querySelector(`[data-status-id='${taskId}']`);
                            if (statusCell) {
                                statusCell.textContent = "1";
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const message = "<?php echo addslashes($message); ?>";
            if (message.trim() !== '') {
                const toastEl = document.getElementById('successToast');
                const toast = new bootstrap.Toast(toastEl);
                toast.show();

                // Redirect to after 
                if (message.includes("Successfully")) {
                    setTimeout(() => {
                        window.location.href = "display.php";
                    }, 1000);
                }
            }
        });

    </script>
    <script src="script.js"></script>
</body>

</html>