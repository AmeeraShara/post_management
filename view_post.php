<?php include 'config.php'; ?>
<?php include 'header.php'; ?>

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
table.table th.actions,
table.table td.actions {
    width: 180px;  
    min-width: 180px;
    white-space: nowrap; 
}
</style>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="m-0">All Posts</h2>
    <a href="create_new_post.php" class="btn btn-ash">+ Create New Post</a>
</div>

<?php
$result = $conn->query("SELECT * FROM posts ORDER BY id ASC");
if ($result && $result->num_rows > 0) {
    echo "<table class='table table-bordered'>";
    echo "<thead><tr><th>ID</th><th>Title</th><th>Content</th><th>Created At</th><th class='actions'>Actions</th></tr></thead><tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr id='row{$row['id']}'>";
        echo "<td>" . (int)$row['id'] . "</td>";
        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
        echo "<td>" . htmlspecialchars($row['content']) . "</td>";
        echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
        echo "<td class='actions'>
                <a href='update_post.php?id=" . (int)$row['id'] . "' class='btn btn-sm btn-ash'>Edit</a>
                <button class='btn btn-sm btn-ash delete-btn' data-id='" . (int)$row['id'] . "'>Delete</button>
              </td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p>No posts found.</p>";
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).on('click', '.delete-btn', function(){
    var id = $(this).data('id');
    $.post("delete_post.php", { id: id }, function(response){
        if(response.trim() === "ignored"){ 
            var actionCell = $("#row" + id).find("td.actions");
            actionCell.html("<span style='color: red; font-weight: 600;'>Deleted</span>");
        } else {
            console.error("Failed to delete post.");
        }
    });
});
</script>

<?php include 'footer.php'; ?>
