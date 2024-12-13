<?php
// Include the database connection
include 'include/credentials.php';

// Check if the query was successful
if (!$result) {
    die("Error executing query: " . $connection->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Plates Palette</title>
    <link rel="icon" href="images/chef-dark.png">
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
    <div class="recipe">
    <?php
// Get recipe ID from URL
$recipeId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($recipeId > 0) {
    // Fetch recipe details
    $sql = "SELECT recipe_name, cuisine, cook_time, servings, description, ingredients, steps, dish_img, ingredients_img, steps_img
            FROM recipes WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $recipeId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $recipe = $result->fetch_assoc();

        // Display recipe details
        echo '<div class="recipe-img">';
        echo '<h2>' . convertToUTF8($recipe['recipe_name']) . '</h2>';
        $dishImg = convertToUTF8($recipe['dish_img']);
        echo '<img src="pics/' . $dishImg . '" alt="' . convertToUTF8($recipe["recipe_name"]) . '">';
        echo '</div>';
        echo '<p>Cuisine: ' . convertToUTF8($recipe['cuisine']) . '</p>';
        echo '<p>Cook Time: ' . convertToUTF8($recipe['cook_time']) . '</p>';
        echo '<p>Servings: ' . convertToUTF8($recipe['servings']) . '</p>';
        echo '<p>' . convertToUTF8($recipe['description']) . '</p>';
        echo '<h3>Ingredients</h3>';
        echo '<div class="ingredients-img">';
        $ingredientsImg = convertToUTF8($recipe['ingredients_img']);
        echo '<img src="pics/' . $ingredientsImg . '" alt="Ingredients" height="200px">';
        echo '</div>';
        // Split ingredients by '*' delimiter and display as list items
        $ingredients = explode('*', $recipe['ingredients']);
        echo '<ul>';
        foreach ($ingredients as $ingredient) {
            if (!empty(trim($ingredient))) {
                echo '<li>' . convertToUTF8($ingredient) . '</li>';
            }
        }
        echo '</ul>';

        // Steps
        echo '<h3>Steps</h3>';
        if (!empty($recipe['steps_img']) && !empty($recipe['steps'])) {
            // Split steps and step images into arrays
            $stepsImg = explode('*', $recipe['steps_img']);
            $steps = explode('*', $recipe['steps']); // Split steps by '*'

            echo '<ol>';
            // Loop through steps and use the same index to access step images
            foreach ($steps as $index => $step) {
                $step = trim($step); // Trim whitespace
                if (!empty($step)) {
                    // Split the step into title and directions
                    $parts = explode('^^', $step);

                    // Assign title and directions, or fallback to avoid undefined index errors
                    $title = isset($parts[0]) ? convertToUTF8($parts[0]) : '';
                    $directions = isset($parts[1]) ? convertToUTF8($parts[1]) : '';

                    // Display the step with title and directions
                    echo '<li>';
                    if (!empty($title)) {
                        echo '<strong>' . $title . '</strong><br>';
                    }
                    echo $directions;

                    // Display the corresponding image only if it exists and is valid
                    if (!empty($stepsImg[$index]) && !ctype_space($stepsImg[$index])) {
                        $stepImg = trim($stepsImg[$index]);
                        if (!empty($stepImg)) { // Double-check for empty strings
                            echo '<div class="step-img">';
                            echo '<img src="pics/' . convertToUTF8($stepImg) . '" height="200px">';
                            echo '</div>';
                        }
                    }
                    echo '</li>';
                }
            }
            echo '</ol>';
        }
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