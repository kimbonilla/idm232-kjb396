<?php
// Include the database connection
include 'include/credentials.php';

// Check if a search query is submitted
$searchQuery = isset($_GET['query']) ? trim($_GET['query']) : '';
$searchResults = [];

if ($searchQuery) {
    // Prepare the SQL query
    $sql = "SELECT * FROM recipes WHERE recipe_name LIKE ? OR description LIKE ?";
    $stmt = $connection->prepare($sql);
    $searchTerm = '%' . $searchQuery . '%';
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the results
    while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
    }

    $stmt->close();
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
    <div class="logo">
        <a href="index.php">
            <img src="images/logo-dark.png" alt="Plate Palette Logo">
        </a>
    </div>
    <div class="search">
        <form method="GET">
            <input type="text" name="query" placeholder="What would you like to make? .." value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
            <button type="submit">
                <img src="images/search.svg" alt="Search">
            </button>
        </form>
    </div>
    <div class="search-results">  
    <?php
    if ($searchQuery) {
        echo '<h3>Search Results for "' . htmlspecialchars($searchQuery) . '"</h3>';
        echo '<div class="recipes">';
        if (count($searchResults) > 0) {
            foreach ($searchResults as $recipe) {
                $dishImg = utf8_encode($recipe['dish_img']);
                echo '<article class="recipe-card">';
                echo '<a href="individual-recipe.php?id=' . $recipe["id"] . '">';
                echo '<img src="pics/' . $dishImg . '" alt="' . utf8_encode($recipe["recipe_name"]) . '">';
                echo '<h4>' . utf8_encode($recipe["recipe_name"]) . '</h4>';
                echo '</a>';
                echo '<p>' . utf8_encode($recipe["cuisine"]) . ' | ' . $recipe["cook_time"] . ' | ' . $recipe["servings"] . '</p>';
                echo '</article>';
            }
        } else {
            echo '<div class="no-results">
            <p>No results found for "' . htmlspecialchars($searchQuery) . '"</p>                </div>';
        }
        echo '</div>';
    }
    ?>
    </div>
    <!-- <div class="previews">
    <a href="recipes.php">
        <div class="preview-card" >
        <img src="images/vertical.webp" alt="Food">
        <h3>Category</h3>
        </div>
    </a>
    <a href="recipes.php">
    <div class="preview-card">
        <img src="images/vertical.webp" alt="Food">
        <h3>Category</h3>
    </div>
    </a>
    <a href="recipes.php">
    <div class="preview-card">
        <img src="images/vertical.webp" alt="Food">
        <h3>Category</h3>
    </div>
    </a>
    </div> -->
    <p>&nbsp;</p>
    <script src="index.js"></script>
</body>
</html>