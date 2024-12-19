<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Editor</title>
    <link rel="stylesheet" href="/style1.css">
</head>
<body>
<div class="editor-container">
    <header>
        <h1>TECH2TECH</h1>
        <span>Create Post</span>
    </header>
    <form method="post" action="">
        <div class="post-editor">
            <input 
                type="text" 
                class="post-title" 
                name="titre" 
                placeholder="New post title here..." 
                required 
            />
            <select 
                class="tags-input" 
                name="tags" 
                id="tags" 
                required
            >
                <option value="" disabled selected>Add up to 4 tags...</option>
                <?php
                $connection = new mysqli("localhost", "root", "root", "blog");
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }
                $tags = $connection->query("SELECT id, name FROM tags");
                while ($tag = $tags->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($tag['id'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($tag['name'], ENT_QUOTES, 'UTF-8') . "</option>";
                }
                ?>
            </select>
            <textarea 
                placeholder="Write your post content here..." 
                name="content" 
                required
            ></textarea>
        </div>
        <div>
            <button 
                type="submit" 
                class="publish-button"
            >
                Publish
            </button>
        </div>
    </form>
</div>

    
</body>
</html>
<?php
session_start();
  $connection = new mysqli("localhost","root","root","blog");
if(isset( $_SESSION["user_id"],$_POST["tags"],$_POST["titre"],$_POST["content"])){
   $id=$_SESSION["user_id"];
   $tagid=$_POST["tags"];
  $titre=$_POST["titre"];
  $content =$_POST["content"];
  $stmt= $connection -> prepare("insert into articles (user_id,title,content) values (?,?,?)");
  $stmt->execute([$id,$titre,$content]);

  $article_id = $connection->insert_id;

    $stmt = $connection->prepare("INSERT INTO articletags (article_id, tag_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $article_id, $tagid);
    $stmt->execute();

    header("Location: blog.php");
}
?>
