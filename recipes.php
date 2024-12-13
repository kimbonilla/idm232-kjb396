<?php
// Include the database connection
include 'include/credentials.php';
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
                <li><a href="recipes.php">All Recipes</a></li>
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
            <p>Welcome to Plates Palette! Go to the "All Recipes" page to view all of our recipes or use the search bar if you already have something in mind. Enjoy your meal!</p>
        </div>
    </div>
    <div class="logo">
        <a href="index.php">
        <img src="images/logo-dark.png" alt="Plate Palette Logo">
        </a>
    </div>
    <div class="search" >
        <form method="GET" action="index.php">
            <input type="text" name="query" placeholder="What would you like to make? .." value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
            <button type="submit">
                <img src="images/search.svg" alt="Search">
            </button>
        </form>
    </div>
    <div class="recipes">
    <?php   
        // Fetch recipes from the database
        $sql = "SELECT id, recipe_name, cuisine, cook_time, servings, dish_img FROM recipes";
        $result = $connection->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dishImg = convertToUTF8($row['dish_img']);
                echo '<article class="recipe-card">';
                echo '<a href="individual-recipe.php?id=' . $row["id"] . '">';
                echo '<img src="pics/' . $dishImg . '" alt="' . convertToUTF8($row["recipe_name"]) . '">';
                echo '<h4>' . convertToUTF8($row["recipe_name"]) . '</h4>';
                echo '</a>';
                echo '<p>' . convertToUTF8($row["cuisine"]) . ' | ' . $row["cook_time"] . ' | ' . $row["servings"] . '</p>';
                echo '</article>';
            }
        } else {
            echo '<div class="no-results">
            <p>No results found.</p>
            </div>';
        }
    ?>
    </div>
    <p>&nbsp;</p>
    <script src="index.js"></script>
</body>
</html>