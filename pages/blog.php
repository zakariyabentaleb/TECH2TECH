
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
        a.id, 
        a.title, 
        a.content, 
        u.username AS user_name, 
        GROUP_CONCAT(t.name SEPARATOR ', ') AS tags
    FROM articles a
    JOIN users u ON a.user_id = u.id
    JOIN articletags at ON a.id = at.article_id
    JOIN tags t ON at.tag_id = t.id
    GROUP BY a.id, u.username;
";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
        <div class="card">
            <div class="user-info">
                <span class="user-name"><?php echo $row['user_name']; ?></span>
                <span class="post-date">Dec 15 (1 day ago)</span> 
            </div>
            <h2 class="post-title"><?php echo $row['title']; ?></h2>
            <p class="post-content"><?php echo $row['content']; ?></p>
            <div class="tags">
                <?php 
                // Affiche les tags associés à l'article
                $tags = explode(', ', $row['tags']);
                foreach ($tags as $tag) {
                    echo "<span>$tag</span> ";
                }
                ?>
            </div>
            <div class="reactions">
                🔥🙌😲💭🎉 15 Reactions • 2 Comments • <span>2 min read</span> 
            </div>
        </div>
        <?php
    }
} else {
    echo "0 results";
}

$conn->close();
?>
    </main>
</body>
</html>

