<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

require_once 'db_connect.php';

$user_email = $_SESSION['user_email'];
$search_query = '';
$orders = [];
$total_cost = 0;

if (isset($_POST['search']) && !empty($_POST['search_term'])) {
    $search_query = $_POST['search_term'];
    
    $stmt = $conn->prepare("SELECT item, cost, order_date FROM orders WHERE email = ? AND item LIKE ? ORDER BY order_date DESC");
    $search_term = "%" . $search_query . "%";
    $stmt->bind_param("ss", $user_email, $search_term);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
        $total_cost += $row['cost'];
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Orders - NBA Jersey Store</title>
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
        
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px;
            font-weight: 600;
        }
        
        .table td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid #dee2e6;
        }
        
        .table tbody tr:hover {
            background-color: #f8f9fa;
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
        
        .total-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
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
                            <a class="nav-link active" href="search_orders.php">Search Orders</a>
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
                <a href="view_orders.php" class="btn btn-sm btn-outline-primary">View All Orders</a>
                <a href="ordering.php" class="btn btn-sm btn-primary">Continue Shopping</a>
            </span>
        </div>
        
        <div class="search-container">
            <h2 class="search-title">Search Your Orders</h2>
            
            <form method="POST" class="search-form">
                <div class="input-group">
                    <input type="text" name="search_term" class="form-control search-input" 
                           placeholder="Search by jersey name..." 
                           value="<?php echo htmlspecialchars($search_query); ?>" required>
                    <button type="submit" name="search" class="btn search-btn">Search</button>
                    <?php if (!empty($search_query)): ?>
                        <a href="search_orders.php" class="btn clear-search">Clear</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        
        <?php if (isset($_POST['search'])): ?>
            <div class="results-container">
                <?php if (!empty($search_query)): ?>
                    <h3 class="results-title">Search Results for "<?php echo htmlspecialchars($search_query); ?>"</h3>
                <?php endif; ?>
                
                <?php if (count($orders) > 0): ?>
                    <div class="search-stats">
                        Found <?php echo count($orders); ?> result(s) | Total Amount: ₱<?php echo number_format($total_cost, 2); ?>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Jersey Name</th>
                                    <th>Price</th>
                                    <th>Order Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orders as $index => $order): ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td>
                                            <strong><?php echo htmlspecialchars($order['item']); ?></strong>
                                        </td>
                                        <td>
                                            <span class="text-danger fw-bold">₱<?php echo number_format($order['cost'], 2); ?></span>
                                        </td>
                                        <td><?php echo date('M d, Y - g:i A', strtotime($order['order_date'])); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="total-section">
                        <h4>Search Summary</h4>
                        <p class="mb-0">Total Results: <?php echo count($orders); ?></p>
                        <h3 class="mb-0">Total Amount: ₱<?php echo number_format($total_cost, 2); ?></h3>
                    </div>
                    
                <?php else: ?>
                    <div class="no-results">
                        <div style="font-size: 60px; color: #ccc; margin-bottom: 20px;">🔍</div>
                        <h4>No Results Found</h4>
                        <p>No orders found matching "<?php echo htmlspecialchars($search_query); ?>". Try searching with different keywords.</p>
                        <a href="search_orders.php" class="btn btn-secondary me-2">Try Again</a>
                        <a href="view_orders.php" class="btn btn-primary">View All Orders</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="results-container">
                <div class="no-results">
                    <div style="font-size: 60px; color: #ccc; margin-bottom: 20px;">🔍</div>
                    <h4>Search Your Orders</h4>
                    <p>Enter a jersey name or keyword above to search through your orders.</p>
                    <a href="view_orders.php" class="btn btn-primary">View All Orders</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>