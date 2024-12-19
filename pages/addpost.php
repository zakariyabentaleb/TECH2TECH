<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Editor</title>
    <link rel="stylesheet" href="/style1.css">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
</head>
<body>
<div class="editor-container">
    <header>
        <h1>TECH2TECH</h1>
        <span>Create Post</span>
    </header>
    <form method="post" action="" id="postForm">
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

            <!-- Quill Editor Container -->
            <div id="editor">
                <!-- Initial content can be set here -->
            </div>

            <!-- Hidden input for submitting the content -->
            <input type="hidden" name="content" id="contentInput" required>

        </div>
        <div>
            <button type="submit" class="publish-button">Publish</button>
        </div>
    </form>
</div>

<!-- Include the Quill library -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

<!-- Initialize Quill editor -->
<script>
  const quill = new Quill('#editor', {
    theme: 'snow'
  });

  // Capture the content before form submission
  const form = document.getElementById('postForm');
  form.addEventListener('submit', function(e) {
    // Set the content of the hidden input field before submitting
    const content = quill.root.innerHTML;
    document.getElementById('contentInput').value = content;
  });
</script>

</body>
</html>

<?php
session_start();
$connection = new mysqli("localhost", "root", "root", "blog");

if (isset($_SESSION["user_id"], $_POST["tags"], $_POST["titre"], $_POST["content"])) {
    $id = $_SESSION["user_id"];
    $tagid = $_POST["tags"];
    $titre = $_POST["titre"];
    $content = $_POST["content"];
    
    // Insert article into the database
    $stmt = $connection->prepare("INSERT INTO articles (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $id, $titre, $content);  // Correct binding for string and string
    $stmt->execute();

    $article_id = $connection->insert_id;

    // Insert article tags
    $stmt = $connection->prepare("INSERT INTO articletags (article_id, tag_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $article_id, $tagid);
    $stmt->execute();

    // Redirect after successful submission
    header("Location: blog.php");
}
?>
