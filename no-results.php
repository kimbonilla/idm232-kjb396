<?php
// Include the database connection
include 'include/credentials.php';

// Query to fetch the first row
$sql = "SELECT * FROM recipes LIMIT 1";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Plates Palette</title>
    <link rel="icon" href="images/chef-dark.png">
    <link rel="icon" href="images/chef-dark.png" media="(prefers-color-scheme: light)">
    <link rel="icon" href="images/chef-light.png" media="(prefers-color-scheme: dark)">
</head>
<body>
    <header>
        <section class="top-nav">
            <div class="header-logo">
                <a href="index.php"><img src="images/logo-dark.png" alt="Plate Palette Logo" height="50px"></a>
            </div>
            <input id="menu-toggle" type="checkbox">
            <label class="menu-button-container" for="menu-toggle">
            <span class="menu-button"></span>
            </label>
            <ul class="menu">
                <li><a href="about.php">About</a></li>
                <li><a href="recipes.php">Recipes</a></li>
            </ul>
        </section>
    </header>
    <div class="help-button">
        <button>?</button>
    </div>
    <div class="help-modal">
        <div class="help-content">
            <button class="close-button">X</button>
            <img src="images/logo-dark.png" alt="Plate Palette Logo">
            <p>This is where the help information will go. For now, click on the categories on the home page to reach the results page. The "no results" page is accessible by clicking the search icon no matter what input is given. The Plates Palette logo will always bring you back to the homepage.</p>
        </div>
    </div>
    <div class="logo">
        <a href="index.php">
        <img src="images/logo-dark.png" alt="Plate Palette Logo">
        </a>
    </div>
    <div class="search">
        <input type="text" name="search" placeholder="What would you like to make? ..">
        <a href="no-results.php"><img src="images/search.svg" alt="Search"></a>
    </div>
    <div class="no-results">
        <p>No results found.</p>
    </div>
    <script src="index.js"></script>
</body>
</html>