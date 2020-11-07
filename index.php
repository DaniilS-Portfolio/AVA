<?php
    require_once "analystic.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="page_name" content="Index page">
    <title>Hello</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="is.js"></script>
    <script src="analystic.js"></script>
</head>
<body>
    <p>Hello, World!</p>
    <hr>
    <p>Admin! Analystic:</p>
    <?php AVA::GetData(); ?>
</body>
</html>