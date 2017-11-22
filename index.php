<!DOCTYPE HTML>
<html>
	<head>
		<title>Php opdrachten</title>
	</head>
	<body>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	<div class"contact_form">	
	First name:<input type="text" name="first_name"><br>
	Last name:<input type="text" name="last_name"><br>
	Gender:<select name="gender" name"gender">
	<option value="male">Male</option>
	<option value="female">Female</option>
	<option value="horse">horse</option>
	<option value="unicorn">Unicorn</option>
	</select><br>
	News:<input type="radio" name="news" value="news"><br>
	Email:<input type="text" name="email"><br>
	Message:<textarea name="messages" cols="30" rows="10"></textarea><br>
	<button type="submit" name="send" value="Submit">Send</button>
	</form>
	</div>
	<?php
		$hostname = 'localhost';
		$dbname = 'form';
		$username = 'root';
		$password = 'root';

		try {
		$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo 'Connected to database';
		}
		catch(PDOException $e)
		{
		echo $e->getMessage();
		}

		// define var's and set to empty values
		$first_name = $last_name = $gender = $news = $email = $messages = "";
		$sql = $dbh->prepare("INSERT INTO contact_form VALUES (0, :first_name, :last_name, :gender, :news, :email, :messages )");
		$sql->bindparam(':first_name', $first_name);
		$sql->bindparam(':last_name', $last_name);
		$sql->bindparam(':gender', $gender);
		$sql->bindparam(':news', $news);
		$sql->bindparam(':email', $email);
		$sql->bindparam(':messages', $messages);
        

		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$first_name = filter_input(INPUT_POST, "first_name");
			$last_name = filter_input(INPUT_POST, "last_name");
			$gender = filter_input(INPUT_POST, "gender");
			$news = filter_input(INPUT_POST, "news", FILTER_VALIDATE_BOOLEAN);
			$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
			$messages = filter_input(INPUT_POST, "messages");
			$sql->execute();
		}
?>



<?php
		echo "<h2>Your Input:</h2>";
		echo $first_name;
		echo "<br>";
		echo $last_name;
		echo "<br>";
		echo $gender;
		echo "<br>";
		echo $news;
		echo "<br>";
		echo $email;
		echo "<br>";
		echo $messages;
		
	?>

	</body>

</html>


