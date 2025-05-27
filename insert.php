<?php
require_once('dbConnect.php');

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $message = '';

    $task = "INSERT INTO tasks(title, description) VALUES(?, ?)";
    $stmt = $conn->prepare($task);

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $title, $description);

    if ($stmt->execute()) {
        $message = "Task Created Successfully!";
        // header("location:display.php");
        // exit;
    } else {
        $message = "Task creation failed: " . $stmt->error;
    }

    $stmt->close();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <style>
        form {
            width: 600px;
            /* height: 600px; */
            margin: 0 auto;
            padding: 40px;
            background-color: gray;
            border-radius: 8px;
        }

        .inputbox {
            color: white;
        }

        .inputbox input {
            width: 100%;
            padding-left: 5px;
        }

        .inputbox textarea {
            width: 100%;
            padding-left: 5px;
        }

        .inputbox label {
            margin: 4px;
        }

        .submitbtn {
            margin-top: 10px;
        }
    </style>
</head>



<body>
    <div>
        <nav class="navbar container-fluid navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto  mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="homepage.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="insert.php">Add Task</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="display.php">Tasks</a>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>
    </div>
    <div>
        <form action="" method="post" id="taskFrom">
            <p class="text-center text-uppercase text-light fs-3 font-serif">Insert Task Form</p>

            <div class="inputbox">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" placeholder="Enter Your Task Title" required>
            </div>

            <div class="inputbox">
                <label for="description">Description</label>
                <textarea name="description" id="description" placeholder="Enter Your Task Description"
                    required></textarea>
            </div>

            <div class="submitbtn">
                <input type="submit" name="submit" value="Submit" id="submit">
            </div>
        </form>
    </div>

    <div class="toast align-items-center" id="successToast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <?php echo htmlspecialchars($message); ?>
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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

</body>

</html>