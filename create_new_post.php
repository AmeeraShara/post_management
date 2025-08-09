<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);

    if ($stmt->execute()) {
        header("Location: view_post.php");
        exit();
    } else {
        $error = "Error creating post.";
    }
}

include 'header.php';
?>

<style>
.btn-ash {
    background-color: #d3d3d3;
    border: 1px solid #ccc;
    color: #000;
}
.btn-ash:hover {
    background-color: #c0c0c0;
    color: #000;
}
.form-container {
    max-width: 800px;
    margin: 50px auto; 
    padding: 50px 40px; 
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color: #f9f9f9; 
    box-shadow: 0 2px 12px rgba(0,0,0,0.1);
}
.form-container h2 {
    font-weight: 700;
    letter-spacing: 1.2px;
    margin-bottom: 30px;
    color: #333;
    text-align: center;
}
.form-label {
    font-weight: 600;
    font-size: 1rem;
    color: #555;
}
.form-control {
    font-size: 1rem;
    padding: 10px 12px;
}
.d-flex.justify-content-end {
    margin-top: 30px;
}
</style>

<div class="form-container">
    <h2>Post Management - Create New Post</h2>

    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" novalidate>
        <div class="mb-4">
            <label class="form-label" for="title">Title</label>
            <input id="title" type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-4">
            <label class="form-label" for="content">Content</label>
            <textarea id="content" name="content" class="form-control" rows="6" required></textarea>
        </div>

       <div class="d-flex justify-content-between">
            <a href="view_post.php" class="btn btn-ash">Back</a>
            <button type="submit" class="btn btn-ash btn-lg px-4">Create Post</button>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>
