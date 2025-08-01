<?php
session_start();
$conn = new mysqli("localhost", "root", "", "roblox_site");
$username = $_POST["username"];
$password = $_POST["password"];

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    if (password_verify($password, $user["password"])) {
        $_SESSION["username"] = $username;
        header("Location: dashboard.php");
        exit();
    }
}
echo "Credenciales inválidas. <a href='login.html'>Volver</a>";
?>
