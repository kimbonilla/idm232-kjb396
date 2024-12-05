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
            <p>This is where the help information will go. For now, click on the categories on the home page to reach the results page. The "no results" page is accessible by clicking the search icon no matter what input is given. The Plates Palette logo will always bring you back to the homepage.</p>
        </div>
    </div>
    <div class="recipe">
    <?php
    // Get recipe ID from URL
        $recipeId = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($recipeId > 0) {
            // Fetch recipe details
            $sql = "SELECT recipe_name, cuisine, cook_time, servings, description, ingredients, steps, dish_img 
                    FROM recipes WHERE id = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("i", $recipeId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $recipe = $result->fetch_assoc();

                // Display recipe details
                echo '<div class="recipe_img">';
                echo '<h2>' . utf8_encode($recipe['recipe_name']) . '</h2>';
                $dishImg = utf8_encode($recipe['dish_img']);
                echo '<img src="pics/' . $dishImg . '" alt="' . utf8_encode($recipe["recipe_name"]) . '"';
                echo '</div>';
                echo '<p>Cuisine: ' . utf8_encode($recipe['cuisine']) . '</p>';
                echo '<p>Cook Time: ' . utf8_encode($recipe['cook_time']) . '</p>';
                echo '<p>Servings: ' . utf8_encode($recipe['servings']) . '</p>';
                echo '<p>' . utf8_encode($recipe['description']) . '</p>';
                echo '<h3>Ingredients</h3>';
                if (!empty($recipe['ingredients_img'])) {
                    $ingredientsImg = htmlspecialchars($recipe['ingredients_img']);
                    echo '<img src="pics/' . $ingredientsImg . '" alt="Ingredients" height="200px">';
                }
                // Split ingredients by '*' delimiter and display as list items
                $ingredients = explode('*', $recipe['ingredients']);
                echo '<ul>';
                foreach ($ingredients as $ingredient) {
                    if (!empty(trim($ingredient))) {
                        echo '<li>' . utf8_encode($ingredient) . '</li>';
                    }
                }
                echo '</ul>';

                 // Steps
                echo '<h3>Steps</h3>';
                if (!empty($recipe['steps_img'])) {
                    $stepsImg = explode('*', $recipe['steps_img']);
                    foreach ($stepsImg as $stepImg) {
                        if (!empty(trim($stepImg))) {
                            echo '<img src="pics/' . htmlspecialchars($stepImg) . '" alt="Step" height="200px">';
                        }
                    }
                }

                $steps = explode('*', $recipe['steps']); // Split steps by '*'
                echo '<ol>';
                foreach ($steps as $step) {
                    // Trim whitespace and ensure the step is not empty
                    $step = trim($step);
                    if (!empty($step)) {
                        // Split the step into title and directions
                        $parts = explode('^^', $step);

                        // Assign title and directions, or fallback to avoid undefined index errors
                        $title = isset($parts[0]) ? utf8_encode($parts[0]) : '';
                        $directions = isset($parts[1]) ? utf8_encode($parts[1]) : '';

                        // Display the step with title and directions
                        echo '<li>';
                        if (!empty($title)) {
                            echo '<strong>' . $title . '</strong><br>';
                        }
                        echo $directions;
                        echo '</li>';
                    }
                }
                echo '</ol>';
            } else {
                echo '<p>Recipe not found.</p>';
            }
            $stmt->close();
        } else {
            echo '<p>Invalid recipe ID.</p>';
        }
    ?>
    </div>
    <p>&nbsp;</p>
    <script src="index.js"></script>
</body>
</html>