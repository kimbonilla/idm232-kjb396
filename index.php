<?php
// Include the database connection
include 'include/credentials.php';

// Check if a search query is submitted
$searchQuery = isset($_GET['query']) ? trim($_GET['query']) : '';
$searchResults = [];

if ($searchQuery) {
    // Prepare the SQL query
    $sql = "SELECT * FROM recipes WHERE recipe_name LIKE ? OR recipe_with LIKE ? OR cuisine LIKE ? OR category LIKE ? OR description LIKE ? OR ingredients LIKE ?";
    $stmt = $connection->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die('MySQL prepare error: ' . $connection->error);
    }

    $searchTerm = '%' . $searchQuery . '%';
    $stmt->bind_param("ssssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the results
    while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
    }

    // Check if the query was successful
if (!$result) {
    die("Error executing query: " . $connection->error);
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
                $dishImg = convertToUTF8($recipe['dish_img']);
                echo '<article class="recipe-card">';
                echo '<a href="individual-recipe.php?id=' . $recipe["id"] . '">';
                echo '<img src="pics/' . convertToUTF8($dishImg) . '" alt="' . convertToUTF8($recipe["recipe_name"]) . '">';
                echo '<h4>' . convertToUTF8($recipe["recipe_name"]) . '</h4>';
                echo '</a>';
                echo '<p>' . convertToUTF8($recipe["cuisine"]) . ' | ' . $recipe["cook_time"] . ' | ' . $recipe["servings"] . '</p>';
                echo '</article>';
            }
        } else {
            echo '<div class="no-results">
            <p>No results found for "' . htmlspecialchars($searchQuery) . '"</p>
            </div>';
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