<?php
session_start();
if ($_SESSION["role"] !== "admin") {
    header("Location: /pages/blog.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - TECH2TECH</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
   
    <div class="sidebar">
        <h1>TECH2TECH</h1>
        <ul>
            <li>🏠 Accueil</li>
            <li>📝 Gérer les Articles</li>
            <li>📊 Statistiques</li>
            <li>⚙️ Paramètres</li>
            <li>🚪 Déconnexion</li>
        </ul>
    </div>
    
   
    <div class="content">
        <header>
            <h2>Bienvenue, Administrateur 
            <?php
                  session_start();
                 if (isset($_SESSION["username"])) {
                    $username = $_SESSION["username"];
                } else {
                    $username = "Guest"; 
                }
                echo  $username; 
                ?>
            </h2>
            <a href="/pages/addpost.php" class="add-button">+ Ajouter un Article</a>
        </header>

   
        <div class="articles">
            <div class="article-card">
                <h3>Projet en ingénierie logicielle</h3>
                <p>#webdev #softwaredevelopment</p>
                <p>🔥 15 Réactions · 2 Commentaires · 2 min</p>
            
                <div class="admin-actions">
                    <button class="edit-btn">✏️ Modifier</button>
                    <button class="delete-btn">🗑 Supprimer</button>
                </div>
            </div>
            <div class="article-card">
                <h3>Feature-Sliced Design</h3>
                <p>#javascript #programming</p>
                <p>🔥 10 Réactions · 1 Commentaire · 1 min</p>
                <div class="admin-actions">
                    <button class="edit-btn">✏️ Modifier</button>
                    <button class="delete-btn">🗑 Supprimer</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
