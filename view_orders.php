<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

require_once 'db_connect.php';

$user_email = $_SESSION['user_email'];

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    $check_stmt = $conn->prepare("SELECT item FROM orders WHERE item = ? AND email = ?");
    $check_stmt->bind_param("ss", $delete_id, $user_email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows > 0) {
        $delete_stmt = $conn->prepare("DELETE FROM orders WHERE item = ? AND email = ?");
        $delete_stmt->bind_param("ss", $delete_id, $user_email);
        
        if ($delete_stmt->execute()) {
            $success_message = "Order deleted successfully!";
        } else {
            $error_message = "Error deleting order.";
        }
        $delete_stmt->close();
    } else {
        $error_message = "Order not found or access denied.";
    }
    $check_stmt->close();
}

$stmt = $conn->prepare("SELECT item, cost, order_date FROM orders WHERE email = ? ORDER BY order_date DESC");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

$total_cost = 0;
$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
    $total_cost += $row['cost'];
}

$stmt->close();
$conn->close();

function getJerseyImage($jersey_name) {
    $jersey_images = array(
        "Kawhi Leonard" => "images/kawhileonard.jpg",
        "Jalen Brunson" => "images/brunson.jpg",
        "Jimmy Butler" => "images/jimmybutler.jpg",
        "KAT WOLVES SERIES" => "images/Wolves.jpg",
        "Lamelo Ball" => "images/Ball.jpeg",
        "Victor Wembanyama" => "images/wembanyama.jpeg",
        "Kyrie Irving" => "images/irving.jpg",
        "D Angelo Russell" => "images/russell.jpg",
        "Kemba Walker" => "images/Kemba.jpg",
        "Lauri Markannen" => "images/Markannen.jpg",
        "Kevin Love" => "images/Love.jpg",
        "Dirk Nowitzki" => "images/Nowitski.jpg",
        "Nikola Jokic" => "images/Jokic.jpg",
        "Stephen Curry" => "images/Curry.jpg",
        "James Harden" => "images/Harden.jpg",
        "Victor Oladipo" => "images/Oladipo.jpg",
        "Lebron James" => "images/Lebron.jpg",
        "Mike Conley" => "images/Conley.jpg",
        "Dwayne Wade" => "images/Wade.jpg",
        "Giannis Antetokounmpo" => "images/Giannis.jpg",
        "Russell Westbrook" => "images/Westbrook.jpg",
        "Devin Booker" => "images/Suns.jpg",
        "De'Aaron Fox" => "images/Fox.jpg",
        "Jordan Clarkson" => "images/Utah.jpg",
        "Manu Ginobili" => "images/Spurs.jpg"
    );
    
    return isset($jersey_images[$jersey_name]) ? $jersey_images[$jersey_name] : "images/default.jpg";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - NBA Jersey Store</title>
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
        
        .orders-container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .orders-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
        
        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
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
        
        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 4px;
            font-size: 12px;
            transition: background-color 0.3s ease;
        }
        
        .btn-delete:hover {
            background-color: #c82333;
            color: white;
        }
        
        .total-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
        }
        
        .no-orders {
            text-align: center;
            padding: 50px;
            color: #666;
        }
        
        .no-orders img {
            width: 100px;
            opacity: 0.5;
            margin-bottom: 20px;
        }
        
        .user-info {
            background: white;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .action-buttons {
            margin-bottom: 20px;
        }
        
        .order-count {
            background: #e9ecef;
            padding: 10px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }
        
        .jersey-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 10px;
        }
        
        .jersey-info {
            display: flex;
            align-items: center;
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
                            <a class="nav-link active" href="view_orders.php">My Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="search_orders.php">Search Items</a>
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
                <a href="ordering.php" class="btn btn-sm btn-primary">Continue Shopping</a>
            </span>
        </div>
        
        <div class="action-buttons text-center">
            <a href="ordering.php" class="btn btn-primary me-2">Add More Items</a>
            <a href="search_orders.php" class="btn btn-outline-secondary">Search Items</a>
        </div>
        
        <?php if (isset($success_message)): ?>
            <div class="success-message"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>
        
        <?php if (isset($error_message)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        
        <div class="orders-container">
            <h2 class="orders-title">My Orders</h2>
            
            <?php if (count($orders) > 0): ?>
                <div class="order-count">
                    Total Orders: <?php echo count($orders); ?> | Total Amount: ₱<?php echo number_format($total_cost, 2); ?>
                </div>
            <?php endif; ?>
            
            <?php if (count($orders) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Jersey</th>
                                <th>Price</th>
                                <th>Order Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $index => $order): ?>
                                <tr>
                                    <td>#<?php echo str_pad($index + 1, 4, '0', STR_PAD_LEFT); ?></td>
                                    <td>
                                        <div class="jersey-info">
                                            <img src="<?php echo getJerseyImage($order['item']); ?>" alt="<?php echo htmlspecialchars($order['item']); ?>" class="jersey-image">
                                            <strong><?php echo htmlspecialchars($order['item']); ?></strong>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-danger fw-bold">₱<?php echo number_format($order['cost'], 2); ?></span>
                                    </td>
                                    <td><?php echo date('M d, Y - g:i A', strtotime($order['order_date'])); ?></td>
                                    <td>
                                        <form method="GET" action="view_orders.php" style="display: inline;">
                                            <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($order['item']); ?>">
                                            <button type="submit" class="btn-delete">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="total-section">
                    <h4>Order Summary</h4>
                    <p class="mb-0">Total Orders: <?php echo count($orders); ?></p>
                    <h3 class="mb-0">Total Amount: ₱<?php echo number_format($total_cost, 2); ?></h3>
                </div>
                
            <?php else: ?>
                <div class="no-orders">
                    <div style="font-size: 60px; color: #ccc; margin-bottom: 20px;">🛒</div>
                    <h4>No Orders Yet</h4>
                    <p>You haven't placed any orders yet. Start shopping to see your orders here!</p>
                    <a href="ordering.php" class="btn btn-primary btn-lg">Start Shopping</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>