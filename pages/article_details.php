<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Layout</title>
    <link rel="stylesheet" href="/style.css">
</head>
<style>
        .user-avatar {
            position: relative;
            cursor: pointer;
        }

        .dropdown {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .dropdown a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #333;
        }

        .dropdown a:hover {
            background-color: #f0f0f0;
        }

        .user-avatar:hover .dropdown {
            display: block;
        }
    </style>
<body>
    <header>
        <div class="logo">TECH2TECH</div>
        <input type="text" placeholder="Search..." class="search-bar">
        <a href="/pages/addpost.php"><button class="create-post-btn">Create Post</button></a>
        <div class="icons">
            <span class="bell">🔔</span>
            <span class="user-avatar">
                  <?php
                  session_start();
                 if (isset($_SESSION["username"])) {
                    $username = $_SESSION["username"];
                } else {
                    $username = "Guest"; 
                }
                echo $username; 
                ?>
                <div class="dropdown">
                    <a href="/login.php">Logout</a>
                </div>
            </span>
        </div>
    </header>
    <main>
    <aside class="sidebar">
        <ul>
            <li>🏠 Home</li>
            <li>➕ DEV++</li>
            <li>📚 Reading List</li>
            <li>🎙️ Podcasts</li>
            <li>🎥 Videos</li>
            <li>🏷️ Tags</li>
            <li>💡 DEV Help</li>
            <li>🛍️ Forem Shop</li>
            <li>❤️ Advertise on DEV</li>
            <li>🏆 DEV Challenges</li>
            <li>✨ DEV Showcase</li>
            <li>🖥️ About</li>
            <li>📞 Contact</li>
            <li>📖 Guides</li>
            <li>🤔 Software Comparisons</li>
        </ul>
    </aside>
    <div class="all">
    

<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "blog";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifiez si un ID d'article est passé en paramètre
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $article_id = intval($_GET['id']);

    // Requête pour récupérer les détails de l'article
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
        WHERE a.id = $article_id
        GROUP BY a.id, u.username;
    ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $row['article_title']; ?></title>
        </head>
        <body>
           
                <h1><?php echo $row['article_title']; ?></h1>
           
            <main>
                <div class="article-details">
                    <p><strong>Author:</strong> <?php echo $row['user_name']; ?></p>
                    <p><strong>Content:</strong> <?php echo $row['article_content']; ?></p>
                    <div class="tags">
                        <strong>Tags:</strong>
                        <?php 
                        if (!empty($row['tags'])) {
                            $tags = explode(', ', $row['tags']);
                            foreach ($tags as $tag) {
                                echo "<span>$tag</span> ";
                            }
                        } else {
                            echo "<span>No tags available</span>";
                        }
                        ?>
                    </div>
                </div>
            </main>
        </body>
        </html>
        <?php
    } else {
        echo "Article not found.";
    }
} else {
    echo "Invalid article ID.";
}

$conn->close();
?>

    </main>
</body>
</html>


