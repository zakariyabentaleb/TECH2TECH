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
        <?php
        // Connexion à la base de données
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "blog";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "
               SELECT 
    a.id AS article_id, 
    a.title AS article_title, 
    a.content AS article_content, 
    u.username AS user_name, 
    GROUP_CONCAT(t.name SEPARATOR ', ') AS tags
FROM articles a
JOIN users u 
    ON a.user_id = u.id
LEFT JOIN articletags at 
    ON a.id = at.article_id
LEFT JOIN tags t 
    ON at.tag_id = t.id
GROUP BY a.id, u.username;

            ";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row=$result->fetch_assoc()) {
            $user_name = $row['user_name'];
        ?>
            <div class="articles">
                <div class="article-card">
                    <h3><?php echo $row['article_title']; ?></h3>
                    <p>Tags: <?php echo $row['tags']; ?></p>
                    <p>Author: <?php echo $row['user_name']; ?></p>

                    <div class="admin-actions">
                        <a href="/delete-article.php?id=<?=$row["article_id"]?>" class="delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');">🗑 Supprimer </a>
                    </div>
                </div>
            </div>
        <?php
        } +

        $conn->close();
    }
        ?>
    </div>

</body>

</html>