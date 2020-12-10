<!DOCTYPE html>
<html>
<head>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
	<title>Test Application</title>
</head>
<body>
	<div class="container">

		<hr>

		<form action="\test\test.php" method="post">
			<div class="form-group">
				<label for="name">Name:</label>
				<input autofocus type="text" class="form-control" id="name" name="user-name" placeholder="Name">
			</div>

			<div class="form-group">
				<label for="dob">DOB:</label>
				<input type="date" class="form-control" id="dob" name="dob">
			</div>

			<div class="form-group">
				<label for="comment">Description:</label>
				<textarea rows="3" class="form-control" id="comment" name="comment"  placeholder="Remarks / Comments"></textarea>
			</div>
			<br>
			<div class="form-group">
				<input id="submit" type="submit" class="form-control">
			</div>
		</form>


		<?php
			if (isset($_POST['user-name']) && isset($_POST['dob']) && isset($_POST['comment'])) {
				$servername = "localhost";
				$username = "root";
				$password = "";
				$db = "rsp";

				$conn = new mysqli($servername, $username, $password, $db);

				$userName = $conn->real_escape_string($_POST["user-name"]);
				$dob = $conn->real_escape_string($_POST["dob"]);
				$description = $conn->real_escape_string($_POST["comment"]);


				if ($userName == '' || $dob == '' || $description == '') {
					echo "<script>alert('All Fields are Mandatory')</script>";
				} else {
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}
	
					if(!$conn->query("INSERT INTO users(name, dob, description) VALUES('$userName', '$dob', '$description')")) {
						echo $conn->error;
					} else {
						echo "<script>alert('Data Uploaded Succesfully !')</script>";
					}
				}
			}
		?>

		<table class="table" {float : left}>
			<thread>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Name</th>
					<th scope="col">DOB</th>
					<th scope="col">Description</th>
				</tr>
			</thread>

			<?php
				$servername = "localhost";
				$username = "root";
				$password = "";
				$db = "rsp";

				$conn = new mysqli($servername, $username, $password, $db);

				$data = $conn->query("SELECT * FROM rsp.users;");
				while ($row = $data->fetch_assoc()) {
					echo "<tr><th scope='row'>" . $row['id']. " </th>";
					echo "<td>" . $row['name']. " </td>";
					echo "<td>" . $row['dob']. " </td>";
					echo "<td>" . $row['description']. " </td></tr>";
				}
			?>
		</table>

	</div>
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>