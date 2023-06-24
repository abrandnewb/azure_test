<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <?php
    include("config.php");
    // Create connection
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT full_name, title FROM employee";
    $result = $conn->query($sql);
    ?>
    <div class="container">
        <h1>Employee Register</h1>
        
        <small>
            <?php echo date("M d, Y H:i"); ?>
        </small>
        <!-- form -->
        <form class="row g-3" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
        <div class="col-md-8">
            <label for="validationDefault01" class="form-label">Full name</label>
            <input type="text" class="form-control" name="name" id="validationDefault01" required>
        </div>
        <div class="col-md-8">
            <label for="validationDefault02" class="form-label">Job title</label>
            <input type="text" class="form-control" name="title" id="validationDefault02" required>
        </div>

        <div class="col-12">
            <button class="btn btn-primary" type="submit" name="submit_form">Submit</button>
        </div>
    </form>
        <!-- end form -->

        <!-- handle form submition -->
        <?php
            if(isset($_POST['submit_form'])) {
                $name = $_POST['name'];
                $title = $_POST['title'];
                
                $sql = "INSERT INTO employee (full_name, title) VALUES ('$name','$title')";
                if ($conn->query($sql) === TRUE) {
                    echo '<div class="alert alert-primary" role="alert">New record created successfully</div>';
                  } else {
                    echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div>';
                    echo "Error: " . $sql . "<br>" . $conn->error;
                  }
                  
            }
        ?>
        <!-- end handle form submition -->
        <!-- table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Title</th>
                </tr>
            </thead>
            <tbody>
        <?php 
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>". $row["full_name"]. "</td>
                    <td>" . $row["title"] . "</td>
                </tr>";
        }
        } else {
            echo "0 results";
        }
    ?>
            </tbody>
        </table>
        <!-- end table -->
    </div>
    <?php $conn->close(); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>