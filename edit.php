<?php
require_once('dbConnect.php');


if(isset(($_GET['editId']))) {
    $editId = $_GET['editId'];
    $result = mysqli_query($conn, "SELECT * FROM tasks WHERE id = '$editId'");
    $row = mysqli_fetch_assoc($result);
    $title = $row['title'];
    $description = $row['description'];
}

if (isset($_POST['update_task'])) {
    $editId = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

     $sql = "UPDATE tasks SET title = '$title', description = '$description' WHERE id = '$editId'";

    if (mysqli_query($conn, $sql)) {
        header("Location: display.php");
        exit;
    } else {
        echo "Update failed: " . mysqli_error($conn);
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
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
        <form action="" method="post">
            <p class="text-center text-uppercase text-light fs-3 font-serif">Update Task Form</p>
            <input type="text" hidden name="id" id="id" value="<?php echo htmlspecialchars($editId); ?>">

            <div class="inputbox">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($title) ?>" placeholder="Enter Your Task Title" required>
            </div>

            <div class="inputbox">
                <label for="description">Description</label>
                <textarea name="description" id="description" placeholder="Enter Your Task Description"
                    required><?php echo htmlspecialchars($description) ?></textarea>
            </div>

            <div class="submitbtn">
                <input type="submit" name="update_task" value="Update Task" id="update_task">
            </div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>