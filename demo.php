<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
</head>

<body>
  
  <h1>Form Validation</h1>
  <form action="demo.php" method="post">
    Name: <input type="text" name="Name">
    <br>
    <br>
    Email: <input type="email" name="Email">
    <br>
    <br>
    Gender:
    <input type="radio" checked name="Gender" value="Male">Male
    <input type="radio" name="Gender" value="Female">Female
    <input type="radio" name="Gender" value="Other">Other
    <br>
    <br>
    <input type="submit" name="submit" value="Submit">
  </form>

  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "form";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input fields
    $Name = test_input($_POST["Name"]);
    $Email = test_input($_POST["Email"]);
    $Gender = test_input($_POST["Gender"]);

    // Check if email already exists in database
    $query = "SELECT COUNT(*) AS count FROM Info WHERE email='$Email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    if ($count > 0) {
      echo "Error: Email address already exists in the database.";
    } else {
      // Insert record into database
      $query = "INSERT INTO Info (Name, Email, Gender) VALUES ('$Name', '$Email', '$Password')";
      if (mysqli_query($conn, $query)) {
        echo "New record created successfully";
      } else {
        echo "Error: " . mysqli_error($conn);
      }
    }
  }

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  mysqli_close($conn);
  ?>

</body>

</html>
















if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input fields
    $Name = test_input($_POST["name"]);
    $Email = test_input($_POST["email"]);
    $Password = test_input($_POST["pwd"]);
    
    // Check if email already exists in database
    $query = "SELECT COUNT(*) AS count FROM Information WHERE Email='$Email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    if ($count > 0) {
      echo "Error: Email address already exists in the database.";
    } else {
      // Insert record into database
      $query = "INSERT INTO Information (Name, Email, Password) VALUES ('$Name', '$Email', '$Password')";
      if (mysqli_query($conn, $query)) {
        echo "New record created successfully";
      } else {
        echo "Error: " . mysqli_error($conn);
      }
    }
}
