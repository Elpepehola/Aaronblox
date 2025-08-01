<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.html");
    exit();
}
$conn = new mysqli("localhost", "root", "", "roblox_site");
$username = $_SESSION["username"];
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$user_id = $user["id"];

$avatarFilename = "avatars/" . $username . ".png";
if (!file_exists($avatarFilename)) {
    $avatarFilename = "avatars/default.png";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi ROBLOX - <?php echo htmlspecialchars($username); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Barra superior con banner y botón "Play Now" -->
        <div class="top-bar">
            <img src="images/banner.jpg" alt="Banner de Roblox" usemap="#banner-map" class="banner">
            <map name="banner-map">
                <area shape="rect" coords="0,0,240,80" href="login.html" alt="Login">
                <area shape="rect" coords="840,10,1010,70" href="games.html" alt="Jugar ahora">
            </map>
        </div>

        <!-- Barra azul de navegación (usada desde el archivo que proporcionaste) -->
        <div class="nav-bar">
            <a href="myroblox.php">Mi ROBLOX</a> |
            <a href="games.html">Juegos</a> |
            <a href="catalog.html">Catálogo</a> |
            <a href="people.html">Personas</a> |
            <a href="buildersclub.html">Club de Constructores</a> |
            <a href="forum.html">Foro</a> |
            <a href="news.html">Noticias</a> |
            <a href="parents.html">Padres</a> |
            <a href="help.html">Ayuda</a>
        </div>

        <!-- Contenido dinámico del perfil -->
        <div class="profile-box" style="margin: 20px auto; background: white; border: 2px solid #a8a8a8; width: 650px; padding: 20px;">
            <div class="profile-header" style="background-color: #c3d9ff; padding: 10px; font-size: 18px; font-weight: bold;">
                Perfil de <?php echo htmlspecialchars($username); ?>
            </div>
            <div class="profile-content" style="display: flex; gap: 20px; margin-top: 15px;">
                <div class="avatar" style="width: 120px; height: 120px; border: 1px solid #aaa; background-color: #ddd;">
    <img src="<?php echo $avatarFilename; ?>" alt="Avatar de <?php echo htmlspecialchars($username); ?>" width="120" height="120">
</div>
                <div class="user-info" style="font-size: 14px;">
                    <p><strong>Nombre de Usuario:</strong> <?php echo htmlspecialchars($username); ?></p>
                    
                    <p><strong>ID de Usuario:</strong> #<?php echo $user_id; ?></p>
                    <p><strong>Miembro desde:</strong> 2008-01-01</p>
                    <p><strong>Último inicio de sesión:</strong> <?php echo date("Y-m-d"); ?></p>
                    <p><strong>Rango:</strong> Invitado</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
