<?php
include 'config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->bind_param("i", $id);

    echo $stmt->execute() ? "success" : "error";

    $stmt->close();
} else {
    echo "error";
}
?>
