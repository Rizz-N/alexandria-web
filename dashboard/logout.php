<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_destroy();
    echo '<script>location.href = "../auth/auth.html";</script>';
} else {
    header("Location: bookmarks.html");
    exit();
}