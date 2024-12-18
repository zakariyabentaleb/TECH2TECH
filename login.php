<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/style2.css">
</head>
<body>
    <div class="container">
        <div class="form-container active">
            <div class="form-header">
                <h2>Bienvenue 👋</h2>
                <p>Connectez-vous pour accéder à votre espace.</p>
            </div>
            <form action="login.php" method="POST">
                <div class="input-group">
                    <label for="login-email">Email :</label>
                    <input type="email" id="login-email" name="email" placeholder="Entrez votre email" required>
                </div>
                <div class="input-group">
                    <label for="login-password">Mot de passe :</label>
                    <input type="password" id="login-password" name="password" placeholder="Entrez votre mot de passe" required>
                </div>
                <button type="submit" class="submit-btn">Se connecter</button>
                <p>Pas encore de compte ? <a href="register.php">Créer un compte</a></p>
            </form>
        </div>
    </div>
</body>
</html>
<?php
session_start();

$connection = new mysqli("localhost", "root", "root", "blog");
if ($connection->connect_error) {
    die("Erreur de connexion : " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
    $password = trim($_POST["password"]);

    if ($email && $password) {
        $stmt = $connection->prepare("SELECT id, username, password_hash, role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($user_id, $username, $hashed_password, $role);

        if ($stmt->fetch() && password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $user_id;
            $_SESSION["username"] = $username;
            $_SESSION["email"] = $email;
            $_SESSION["authenticated"] = true;

            // Redirection en fonction du rôle de l'utilisateur
            if ($role === 'admin') {
                header("Location: admin.php");
            } else {
                header("Location: pages/blog.php");
            }
            exit();
        } else {
            $error = "Identifiants incorrects.";
        }
        $stmt->close();
    } else {
        $error = "Email ou mot de passe invalide.";
    }
}
?>
