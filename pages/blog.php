
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
        <div class="card">
            <div class="user-info">
                <span class="user-name">Nozibul Islam</span>
                <span class="post-date">Dec 15 (1 day ago)</span>
            </div>
            <h2 class="post-title">Real-world projects in software engineering</h2>
            <div class="tags">
                <span>#softwareengineering</span>
                <span>#webdev</span>
                <span>#softwaredevelopment</span>
                <span>#programming</span>
            </div>
            <div class="reactions">
                🔥🙌😲💭🎉 15 Reactions • 2 Comments • <span>2 min read</span>
            </div>
        </div>
        <div class="card">
            <div class="user-info">
                <span class="user-name">Yan Levin</span>
                <span class="post-date">Dec 15 (1 day ago)</span>
            </div>
            <h2 class="post-title">What Do You Think About Feature-Sliced Design (FSD)?</h2>
            <div class="tags">
                <span>#discuss</span>
                <span>#webdev</span>
                <span>#javascript</span>
                <span>#programming</span>
            </div>
            <div class="reactions">
                🔥🙌😲💭🎉 10 Reactions • 3 Comments • <span>1 min read</span>
            </div>
        </div>
        <div class="card">
            <div class="user-info">
                <span class="user-name">Vsevolod</span>
                <span class="post-date">Dec 11 (5 days ago)</span>
            </div>
            <h2 class="post-title">Like Vim, but Helix</h2>
            <div class="tags">
                <span>#development</span>
                <span>#vscode</span>
                <span>#vim</span>
                <span>#productivity</span>
            </div>
            <div class="reactions">
                🔥🙌😲💭🎉 30 Reactions • 11 Comments • <span>3 min read</span>
            </div>
        </div>
        <div class="card">
            <div class="user-info">
                <span class="user-name">Yan Levin</span>
                <span class="post-date">Dec 15 (1 day ago)</span>
            </div>
            <h2 class="post-title">What Do You Think About Feature-Sliced Design (FSD)?</h2>
            <div class="tags">
                <span>#discuss</span>
                <span>#webdev</span>
                <span>#javascript</span>
                <span>#programming</span>
            </div>
            <div class="reactions">
                🔥🙌😲💭🎉 10 Reactions • 3 Comments • <span>1 min read</span>
            </div>
        </div>
        <div class="card">
            <div class="user-info">
                <span class="user-name">Yan Levin</span>
                <span class="post-date">Dec 15 (1 day ago)</span>
            </div>
            <h2 class="post-title">What Do You Think About Feature-Sliced Design (FSD)?</h2>
            <div class="tags">
                <span>#discuss</span>
                <span>#webdev</span>
                <span>#javascript</span>
                <span>#programming</span>
            </div>
            <div class="reactions">
                🔥🙌😲💭🎉 10 Reactions • 3 Comments • <span>1 min read</span>
            </div>
        </div>
        </div>
    </main>
</body>
</html>
