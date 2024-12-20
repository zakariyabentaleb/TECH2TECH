<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Details</title>
    <link rel="stylesheet" href="/articledetail.css">
    <style>
        /* Global styles */

        .sidebar {
            width: 200px;
            background-color: #fff;
            padding: 15px;
            top: 60px;
            left: 0;
            height: calc(135vh - 60px);
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 10px 0;
            font-size: 1em;
            color: #333;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .sidebar ul li:hover {
            background-color: #f0f0f0;
        }

        .main {
            margin-top: -58%;
            margin-left: 220px;
            padding: 15px;
            background-color: #f4f4f9;
            min-height: 100vh;
        }

        .article-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .article-details h1 {
            font-size: 2em;
            color: #0056b3;
            margin-bottom: 10px;
        }

        .article-details p {
            font-size: 1.1em;
            margin-bottom: 10px;
        }

        .tags {
            margin-top: 15px;
        }

        .tags span {
            display: inline-block;
            margin: 5px 5px 0 0;
            padding: 5px 10px;
            background-color: #e1f5fe;
            color: #0277bd;
            border-radius: 15px;
            font-size: 0.9em;
        }

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

        footer {
            text-align: center;
            padding: 10px 20px;
            background-color: #0e68a4;
            color: #fff;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

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
                $username = $_SESSION["username"] ?? "Guest";
                echo $username;
                ?>
                <div class="dropdown">
                    <a href="/login.php">Logout</a>
                </div>
            </span>
        </div>
    </header>
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
    <section class="section">
        <main class="main">
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

            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $article_id = intval($_GET['id']);
                $sql = "
                SELECT 
                    a.title AS article_title, 
                    a.content AS article_content, 
                    u.username AS user_name, 
                    GROUP_CONCAT(t.name SEPARATOR ', ') AS tags
                FROM articles a
                JOIN users u ON a.user_id = u.id
                LEFT JOIN articletags at ON a.id = at.article_id
                LEFT JOIN tags t ON at.tag_id = t.id
                WHERE a.id = $article_id
                GROUP BY a.id;
            ";

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $user_name = $row['user_name'];
            ?>
                    <div class="article-details">
                        <h1><?php echo $row['article_title']; ?></h1>
                        <p><?php echo nl2br($row['article_content']); ?></p>
                        <div class="tags">
                            <strong>Tags:</strong>
                            <?php
                            $tags = explode(', ', $row['tags']);
                            foreach ($tags as $tag) {
                                echo "<span>$tag</span>";
                            }
                            ?>
                        </div>
                    </div>
            <?php
                } else {
                    echo "<p>Article not found.</p>";
                }
            } else {
                echo "<p>Invalid article ID.</p>";
            }

            $conn->close();

            ?>
            <div class="comments-section">
                <h2>Top comments (3)</h2>

                <div class="comment">
                    <div class="comments-section">
                        <h2>Top comments (3)</h2>

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

                        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                            $article_id = intval($_GET['id']);

                            $sql = "
            SELECT 
                comments.content AS comment_content,
                users.username AS commenter_username
            FROM comments
            INNER JOIN users ON comments.user_id = users.id
            WHERE comments.article_id = $article_id
           ;";

                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<div class='comment'>
                        <h3 class='comment-header'>" . $row['commenter_username'] . "</h3>
                        <p>" . nl2br($row['comment_content']) . "</p>
                      </div>";
                                }
                            } else {
                                echo "<p>No comments yet.</p>";
                            }
                        } else {
                            echo "<p>Invalid article ID.</p>";
                        }

                        $conn->close();
                        ?>
                    </div>
                    <div class="add-comment">
                        <form method="POST" action="article_details.php?id=<?php echo $_GET['id']; ?>">
                            <textarea name="comment_content" placeholder="Add to the discussion..."></textarea>
                            <button type="submit" name="submit_comment">Post Comment</button>
                        </form>
                    </div>
                    <?php
                    // Handle comment submission
                    if (isset($_POST['submit_comment']) && isset($_POST['comment_content'])) {
                        $comment_content = trim($_POST['comment_content']);
                        $article_id = intval($_GET['id']);
                        $user_id = $_SESSION['user_id']; // Assuming you're storing the user_id in the session

                        if (!empty($comment_content)) {
                            // Connexion à la base de données
                            $servername = "localhost";
                            $username = "root";
                            $password = "root";
                            $dbname = "blog";
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Insert the new comment into the database
                            $sql = "INSERT INTO comments (article_id, user_id, content) VALUES ($article_id, $user_id, ?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $comment_content); // "s" is for string
                            $stmt->execute();

                            if ($stmt->affected_rows > 0) {
                                echo "<p>Comment posted successfully!</p>";
                            } else {
                                echo "<p>Error posting comment.</p>";
                            }

                            $stmt->close();
                            $conn->close();
                        } else {
                            echo "<p>Please write a comment before submitting.</p>";
                        }
                    }
                    ?>

                </div>
        </main>
        <div class="profile-card">
            <div class="header"></div>
            <div class="profile">
                <h1>YOUCODER</h1>
                <h2 class="name"><?php echo $user_name; ?></h2>
                <button class="follow-btn">Follow</button>
            </div>
            <div class="details">
                <p class="bio">
                    Silicon Forest Developer/hacker. I write about Generative AI, DevOps, and Linux mostly.
                    Once held the world record for being the youngest person alive.
                </p>
                <p class="info"><strong>Location:</strong> SAFI,MAROC</p>
                <p class="info"><strong>Work:</strong> FULL STACK DEVLOPER </p>
                <p class="info"><strong>Joined:</strong> Dec 20, 2024</p>
            </div>
        </div>

    </section>

    <footer>
        © 2024 TECH2TECH. All rights reserved.
    </footer>
</body>

</html>