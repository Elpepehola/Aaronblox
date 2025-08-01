<?php
$conn = new mysqli("localhost", "root", "", "roblox_site");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Registro - Roblox 2007</title>
</head>
<body>
  <h2>Registrarse</h2>
  <form method="POST">
    <label>Usuario:</label><br>
    <input type="text" name="username" required><br>
    <label>Contraseña:</label><br>
    <input type="password" name="password" required><br><br>
    <input type="submit" value="Registrarse">
  </form>
</body>
</html>
