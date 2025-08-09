<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
   
    echo "ignored";  
} else {
    echo "error";
}
?>
