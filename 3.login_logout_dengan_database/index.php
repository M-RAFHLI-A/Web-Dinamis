<!DOCTYPE html> 
<html lang="en"> 
	<head> 
		<meta charset="UTF-8"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Login</title> 
	</head> 

	<body> 
		<h1>Dafrat Nama Yang Ada di MySQL</h1>
		<h2>Form Data</h2> 
		
		<form action="proses_login.php" method="post"> 
			<label for="username">Username :</label> 
			<input type="text" id="username" name="username" required><br> <br>

			<label for="password">Password :</label> 
			<input type="password" id="password" name="password" required><br> <br>

			<input type="submit" value="Login"> 
		</form> <br>
	</body> 
</html>
