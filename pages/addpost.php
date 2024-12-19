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
        <div class="post-editor">
            <input type="text" class="post-title" placeholder="New post title here..." />
            <select name="existing_voiture" class="tags-input" id="existing_voiture">
      <option value="" disabled selected>Add up to 4 tags...</option>
      <?php
      $connection = new mysqli("localhost","root","root","blog");
      $tags = $connection->query("SELECT id, name FROM tags");
      while ($tag = $tags->fetch_assoc()) {
          echo "<option value='{$tag['id']}'>{$tag['name']}</option>";
      }
      ?>
    </select>
            <textarea placeholder="Write your post content here..."></textarea>
        </div>
        <div>
  
            <button class="publish-button">Publish</button>
      
    </div>
    </div>
    
</body>
</html>
