<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="/style2.css">
</head>

<body>
    <div class="container">
        <div class="form-container active">
            <div class="form-header">
                <h2>Créez votre compte 🎉</h2>
                <p>Inscrivez-vous pour rejoindre la communauté.</p>
            </div>
            <form action="register.php" method="POST">
                <div class="input-group">
                    <label for="register-username">Nom d'utilisateur :</label>
                    <input type="text" id="register-username" name="username" placeholder="Entrez un nom d'utilisateur" required>
                </div>
                <div class="input-group">
                    <label for="register-email">Email :</label>
                    <input type="email" id="register-email" name="email" placeholder="Entrez votre email" required>
                </div>
                <div class="input-group">
                    <label for="register-password">Mot de passe :</label>
                    <input type="password" id="register-password" name="password" placeholder="Créez un mot de passe" required>
                </div>
                <button type="submit" class="submit-btn" name="sincrire">S'inscrire</button>
                <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
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

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["sincrire"])) {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $stmt = $connection->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Cet email est déjà utilisé.";
    } else {

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);


        $insert_stmt = $connection->prepare("INSERT INTO users (username, email,  password_hash ) VALUES (?, ?, ?)");
        $insert_stmt->bind_param("sss", $username, $email, $hashed_password);
        if ($insert_stmt->execute()) {

            $_SESSION["username"] = $username;
            $_SESSION["email"] = $email;
            $_SESSION["authenticated"] = true;


            header("Location: index.php");
            exit();
        } else {
            echo "Erreur lors de l'inscription.";
        }
        $insert_stmt->close();
    }
    $stmt->close();
}
?>