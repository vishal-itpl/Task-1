<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "task1";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Initialize variables
  $name = $email = $password = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize input
    $name = test_input($_POST["name"], $conn);
    $email = test_input($_POST["email"], $conn);
    $password = test_input($_POST["pwd"], $conn);

    // Check if email already exists
    $query = "SELECT COUNT(*) AS count FROM information WHERE Email='$email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    if ($name == '' || $email == '' || $password == ''){  
      echo("All fields are required");
      exit();
    }

    if ($count > 0) {
      echo "Error: Email address already exists in the database.";
    } else {
      // Update database
      $query = "INSERT INTO Information (Name, Email, Password) VALUES ('$name', '$email', '$password')";
      if (mysqli_query($conn, $query)) {
        echo "New record created successfully";
      } else {
        echo "Error: " . mysqli_error($conn);
      }
    }
  } else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get ID from query parameter
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    // Retrieve data for specified ID
    $query = "SELECT * FROM Information WHERE ID=$id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    // $row = mysqli_insert_id($result);

    // Set form values to retrieved data
    $name = $row['name'];
    $email = $row['email'];
    $password = $row['password'];
  }

  function test_input($data, $conn)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($conn, $data); // Escape special characters to prevent SQL injection
    return $data;
  }

  mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2 style="text-align:center;">Edit Form</h2>
        <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
                <label class="control-label col-sm-2" for="name">Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Enter Your Name" name="name"
                        value="<?php echo isset($Name) ? $Name: ''; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo isset($Email) ? $Email : ''; ?>">

                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Password:</label>
                <div class="col-sm-10">
                     <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd"
                        value="<?php echo isset($Password) ? $Password:''; ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label><input type="checkbox" name="remember"
                                <?php if (isset($Remember) && $Remember=="on") echo "checked";?>> Remember me</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="submit">Save</button>
                </div>
            </div>
        </form>
    </div>

</body>

</html>