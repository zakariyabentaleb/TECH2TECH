<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login et Register</title>
    <link rel="stylesheet" href="/style2.css">
</head>
<body>
    <div class="container">
        
        <div class="form-container active" id="loginForm">
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
                <p>Pas encore de compte ? <a href="#" onclick="toggleForm('registerForm')">Créer un compte</a></p>
            </form>
        </div>

       
        <div class="form-container" id="registerForm">
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
                <div class="input-group">
                    <label for="register-role">Rôle :</label>
                    <select id="register-role" name="role">
                        <option value="writer" selected>Writer</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="submit-btn">S'inscrire</button>
                <p>Déjà un compte ? <a href="#" onclick="toggleForm('loginForm')">Se connecter</a></p>
            </form>
        </div>
    </div>

    <script>
        function toggleForm(formId) {
            document.getElementById('loginForm').classList.toggle('active');
            document.getElementById('registerForm').classList.toggle('active');
        }
    </script>
</body>
</html>
