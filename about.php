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
    <title>About</title>
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
    <div class="about-text">
        <h3>About Plates Palette</h3>
        <p>Welcome to Plate Palette - a vibrant destination for culinary inspiration where every dish is a canvas, and every recipe adds a brushstroke to your cooking skills. At Plate Palette, we believe that cooking is both an art and a science, blending creativity with technique to craft meals that bring joy, comfort, and adventure to your table.</p>
        <h3>Our Mission</h3>
        <p>Our mission is simple: to make cooking approachable, exciting, and a little more colorful for everyone. Whether you're a seasoned chef, a passionate home cook, or someone just beginning their culinary journey, Plate Palette offers a diverse array of recipes to suit every palate and skill level.</p>
        <h3>What We Offer</h3>
        <p>From quick weeknight dinners to elaborate weekend projects, our recipes are crafted to fit seamlessly into your lifestyle. Here's what you'll find:</p>
        <ul>
            <li>Delicious, Tested Recipes - Each recipe is carefully tested to ensure you get great results every time.</li>
            <li>Step-by-Step Guides - We provide easy-to-follow instructions and tips to help you master even the most intricate dishes.</li>
            <li>Inspiration for Every Palate - With a global range of flavors and cuisines, there's something to delight every taste.</li>
            <li>Healthy Options & Comfort Classics - Enjoy recipes for every mood, from wholesome, nutritious meals to indulgent comfort foods.</li>
        </ul>
        <h3>Why Plate Palette?</h3>
        <p>At Plate Palette, we understand that cooking is about more than just food; it's about creating memories, connecting with loved ones, and exploring the world from your kitchen. Our recipes are designed to bring you closer to these experiences, inspiring you to experiment, learn, and most importantly, enjoy the process.</p>
    </div>
    <p>&nbsp;</p>
    <script src="index.js"></script>
</body>
</html>