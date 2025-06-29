<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

$search_query = '';
$products = [];
$search_performed = false;

function getAllProducts() {
    return array(
        array('name' => 'Kawhi Leonard', 'price' => 100, 'image' => 'images/kawhileonard.jpg'),
        array('name' => 'Jalen Brunson', 'price' => 200, 'image' => 'images/brunson.jpg'),
        array('name' => 'Jimmy Butler', 'price' => 300, 'image' => 'images/jimmybutler.jpg'),
        array('name' => 'KAT WOLVES SERIES', 'price' => 400, 'image' => 'images/Wolves.jpg'),
        array('name' => 'Lamelo Ball', 'price' => 500, 'image' => 'images/Ball.jpeg'),
        array('name' => 'Victor Wembanyama', 'price' => 600, 'image' => 'images/wembanyama.jpeg'),
        array('name' => 'Kyrie Irving', 'price' => 700, 'image' => 'images/irving.jpg'),
        array('name' => 'D Angelo Russell', 'price' => 800, 'image' => 'images/russell.jpg'),
        array('name' => 'Kemba Walker', 'price' => 900, 'image' => 'images/Kemba.jpg'),
        array('name' => 'Lauri Markannen', 'price' => 1000, 'image' => 'images/Markannen.jpg'),
        array('name' => 'Kevin Love', 'price' => 1100, 'image' => 'images/Love.jpg'),
        array('name' => 'Dirk Nowitzki', 'price' => 1200, 'image' => 'images/Nowitski.jpg'),
        array('name' => 'Nikola Jokic', 'price' => 1300, 'image' => 'images/Jokic.jpg'),
        array('name' => 'Stephen Curry', 'price' => 1400, 'image' => 'images/Curry.jpg'),
        array('name' => 'James Harden', 'price' => 1500, 'image' => 'images/Harden.jpg'),
        array('name' => 'Victor Oladipo', 'price' => 1600, 'image' => 'images/Oladipo.jpg'),
        array('name' => 'Lebron James', 'price' => 1700, 'image' => 'images/Lebron.jpg'),
        array('name' => 'Mike Conley', 'price' => 1800, 'image' => 'images/Conley.jpg'),
        array('name' => 'Dwayne Wade', 'price' => 1900, 'image' => 'images/Wade.jpg'),
        array('name' => 'Giannis Antetokounmpo', 'price' => 2000, 'image' => 'images/Giannis.jpg'),
        array('name' => 'Russell Westbrook', 'price' => 2100, 'image' => 'images/Westbrook.jpg'),
        array('name' => 'Devin Booker', 'price' => 2200, 'image' => 'images/Suns.jpg'),
        array('name' => 'De\'Aaron Fox', 'price' => 2300, 'image' => 'images/Fox.jpg'),
        array('name' => 'Jordan Clarkson', 'price' => 2400, 'image' => 'images/Utah.jpg'),
        array('name' => 'Manu Ginobili', 'price' => 2500, 'image' => 'images/Spurs.jpg')
    );
}

if (isset($_POST['search']) && !empty($_POST['search_term'])) {
    $search_query = trim($_POST['search_term']);
    $search_performed = true;
    $all_products = getAllProducts();
    
    foreach ($all_products as $product) {
        if (stripos($product['name'], $search_query) !== false) {
            $products[] = $product;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Products - NBA Jersey Store</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        
        .navbar-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1rem 0;
            margin-bottom: 30px;
            border-radius: 10px;
        }
        
        .navbar-custom .navbar-brand {
            color: white !important;
            font-weight: bold;
            font-size: 1.5rem;
        }
        
        .navbar-custom .nav-link {
            color: white !important;
            margin: 0 10px;
            font-weight: 500;
        }
        
        .navbar-custom .nav-link:hover {
            color: #f0f0f0 !important;
        }
        
        .search-container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .search-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        
        .search-form {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .search-input {
            border-radius: 25px;
            padding: 12px 20px;
            border: 2px solid #dee2e6;
            font-size: 16px;
        }
        
        .search-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .search-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            color: white;
            font-weight: 500;
        }
        
        .search-btn:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
            color: white;
        }
        
        .results-container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .results-title {
            margin-bottom: 20px;
            color: #333;
        }
        
        .user-info {
            background: white;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .no-results {
            text-align: center;
            padding: 50px;
            color: #666;
        }
        
        .search-stats {
            background: #e9ecef;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }
        
        .clear-search {
            background-color: #6c757d;
            border: none;
            border-radius: 25px;
            padding: 8px 20px;
            color: white;
            font-size: 14px;
            margin-left: 10px;
        }
        
        .clear-search:hover {
            background-color: #5a6268;
            color: white;
        }
        
        .jersey-item {
            text-align: center;
            padding: 20px;
            border: 1px solid #dee2e6;
            margin-bottom: 20px;
            border-radius: 8px;
            background: white;
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .jersey-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        
        .jersey-image-container {
            width: 100%;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 5px;
            margin-bottom: 15px;
            background-color: #f8f9fa;
        }
        
        .jersey-image {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            border-radius: 5px;
        }
        
        .jersey-name {
            font-size: 16px;
            font-weight: bold;
            margin: 10px 0;
            color: #333;
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .jersey-price {
            font-size: 18px;
            color: #dc3545;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .add-to-cart {
            background-color: #007bff;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            font-size: 14px;
            margin-top: auto;
            transition: background-color 0.3s ease;
        }
        
        .add-to-cart:hover {
            background-color: #0056b3;
            color: white;
            text-decoration: none;
        }
        
        .browse-all {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container">
                <a class="navbar-brand" href="ordering.php">NBA JERSEY STORE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="ordering.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view_orders.php">My Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="search_orders.php">Search Items</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="user-info">
            <strong>Welcome, <?php echo htmlspecialchars($_SESSION['user_email']); ?>!</strong>
            <span class="float-end">
                <a href="view_orders.php" class="btn btn-sm btn-outline-primary">View My Orders</a>
                <a href="ordering.php" class="btn btn-sm btn-primary">Browse All Jerseys</a>
            </span>
        </div>
        
        <div class="search-container">
            <h2 class="search-title">Search NBA Jerseys</h2>
            
            <form method="POST" class="search-form">
                <div class="input-group">
                    <input type="text" name="search_term" class="form-control search-input" 
                           placeholder="Search by player name..." 
                           value="<?php echo htmlspecialchars($search_query); ?>" required>
                    <button type="submit" name="search" class="btn search-btn">Search</button>
                    <?php if (!empty($search_query)): ?>
                        <a href="search_orders.php" class="btn clear-search">Clear</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        
        <?php if ($search_performed): ?>
            <div class="results-container">
                <?php if (!empty($search_query)): ?>
                    <h3 class="results-title">Search Results for "<?php echo htmlspecialchars($search_query); ?>"</h3>
                <?php endif; ?>
                
                <?php if (count($products) > 0): ?>
                    <div class="search-stats">
                        Found <?php echo count($products); ?> jersey(s) matching your search
                    </div>
                    
                    <div class="row">
                        <?php foreach ($products as $product): ?>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="jersey-item">
                                    <div class="jersey-image-container">
                                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="jersey-image">
                                    </div>
                                    <div class="jersey-name"><?php echo htmlspecialchars($product['name']); ?></div>
                                    <div class="jersey-price">₱<?php echo number_format($product['price']); ?></div>
                                    <a href="ordering.php?item=<?php echo urlencode($product['name']); ?>&cost=<?php echo $product['price']; ?>" class="add-to-cart">Add to Cart</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="browse-all">
                        <a href="ordering.php" class="btn btn-primary btn-lg">Browse All Jerseys</a>
                    </div>
                    
                <?php else: ?>
                    <div class="no-results">
                        <div style="font-size: 60px; color: #ccc; margin-bottom: 20px;">🔍</div>
                        <h4>No Results Found</h4>
                        <p>No jerseys found matching "<?php echo htmlspecialchars($search_query); ?>". Try searching with different keywords.</p>
                        <a href="search_orders.php" class="btn btn-secondary me-2">Try Again</a>
                        <a href="ordering.php" class="btn btn-primary">Browse All Jerseys</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="results-container">
                <div class="no-results">
                    <div style="font-size: 60px; color: #ccc; margin-bottom: 20px;">🏀</div>
                    <h4>Search NBA Jerseys</h4>
                    <p>Enter a player name above to search through our complete collection of NBA jerseys.</p>
                    <div style="margin: 20px 0; color: #666; font-size: 14px;">
                        <strong>Popular searches:</strong> LeBron, Curry, Giannis, Jokic, Wembanyama
                    </div>
                    <a href="ordering.php" class="btn btn-primary">Browse All Jerseys</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>