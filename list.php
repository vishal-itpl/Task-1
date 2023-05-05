<!DOCTYPE html>
<html>
<head>
	<title>Table</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

	<div class="container my-5">
		<div class="card">
			<div class="card-header">
				<h2 style="text-align:center";>Listing</h2>
			</div>
			<div class="card-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Password</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						//connect to the database
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

						// SQL query to retrieve data from the database table
						$sql = "SELECT * FROM Information";

						// Execute the query and store the results in a variable
						$result = mysqli_query($conn, $sql);

						//check if there are any results
						if (!$result) {
							die("Error: " . mysqli_error($conn));
						}

						// Loop through the results and display the data in the HTML table
						while ($row = mysqli_fetch_assoc($result)) {
							echo "<tr>";
							echo "<td>" . $row["ID"] . "</td>";
							echo "<td>" . $row["Name"] . "</td>";
							echo "<td>" . $row["Email"] . "</td>";
							echo "<td>" . $row["Password"] . "</td>";
							echo "<td>";
							echo "<a href='edit.php?id=". $row['ID'] ."' class='btn btn-primary mr-2'>Edit</a>";
							echo "<a href='delete.php?id=". $row['ID'] ."' class='btn btn-danger' onClick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a>";
							echo "</td>";
							echo "</tr>";
						}

						// Close the database connection
						mysqli_close($conn);
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8
