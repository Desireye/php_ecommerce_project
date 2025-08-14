

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThriftAll</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include('../nav.php') ?>
    <form action="search_results.php" method="GET">
    <input type="text" name="search_query" placeholder="Search for products...">
    <button type="submit">Search</button>

    <?php
// Establish database connection
$db = mysqli_connect("localhost", "root", "", "mall") or die(mysqli_error($db));

// Retrieve search query from URL parameter
$search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

// Perform search in the database
if (!empty($search_query)) {
    $search_query = mysqli_real_escape_string($db, $search_query);
    $search_results = mysqli_query($db, "SELECT * FROM product WHERE product_name LIKE '%$search_query%'") or die(mysqli_error($db));

    // Display search results
    while ($result = mysqli_fetch_array($search_results)) {
        echo "<div class='product'>";
        echo "<div class='image'>";
        echo "<img src='../seller/img/{$result[6]}'alt='{$result[1]}'>";
        echo "<h4>{$result[1]}</h4>";
        echo "<p>{$result[4]}</p>";
        echo "<span class='price badge'>&#8358;{$result[5]}</span>";
        // Add "Add to Cart" button or other actions for each search result
        echo "<form method='post' action='add_to_cart.php'>";
        echo "<input type='hidden' name='product_id' value='{$result['id']}'>";
        echo "<button type='submit' class='add-to-cart'>Add to Cart</button>";
        echo "</form>";
        echo "</div>";
        
    }
} else {
    echo "No search query entered.";
}

?>




</body>
</html>



