<?php
session_start();


if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}


require_once 'db_connect.php';


if (isset($_GET['item']) && isset($_GET['cost'])) {
    $item_name = $_GET['item'];
    $cost = intval($_GET['cost']);
    $user_email = $_SESSION['user_email'];
    $quantity = 1; 
    $amount = $cost * $quantity;
    $order_date = date('Y-m-d'); 
    

    $stmt = $conn->prepare("INSERT INTO orders (order_date, email, item, cost, quantity, amount) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiid", $order_date, $user_email, $cost, $cost, $quantity, $amount);
    
    if ($stmt->execute()) {
        $success_message = "Item added to your orders successfully!";
    } else {
        $error_message = "Error adding item to orders.";
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
    <title>NBA JERSEY STORE</title>
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
        
        .jersey-table {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .jersey-item {
            text-align: center;
            padding: 15px;
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
            height: 300px;
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
        
        .user-info {
            background: white;
            padding: 10px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        @media (max-width: 768px) {
            .jersey-image-container {
                height: 250px;
            }
        }
        
        @media (max-width: 576px) {
            .jersey-image-container {
                height: 200px;
            }
            
            .jersey-item {
                padding: 10px;
            }
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
                            <a class="nav-link" href="search_orders.php">Search Orders</a>
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
            </span>
        </div>
        
       
        <?php if (isset($success_message)): ?>
            <div class="success-message"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>
        
        <?php if (isset($error_message)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        
        <div class="jersey-table">
            <h1 class="text-center mb-4">NBA JERSEY COLLECTION</h1>
            
        
            <div class="row">
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="jersey-item">
                        <div class="jersey-image-container">
                            <img src="images/kawhileonard.jpg" alt="Kawhi Leonard" class="jersey-image">
                        </div>
                        <div class="jersey-name">Kawhi Leonard</div>
                        <div class="jersey-price">₱100</div>
                        <a href="ordering.php?item=Kawhi Leonard&cost=100" class="add-to-cart">Add to Cart</a>
                    </div>
                </div>
                
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="jersey-item">
                        <div class="jersey-image-container">
                            <img src="images/brunson.jpg" alt="Jalen Brunson" class="jersey-image">
                        </div>
                        <div class="jersey-name">Jalen Brunson</div>
                        <div class="jersey-price">₱200</div>
                        <a href="ordering.php?item=Jalen Brunson&cost=200" class="add-to-cart">Add to Cart</a>
                    </div>
                </div>
                
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="jersey-item">
                        <div class="jersey-image-container">
                            <img src="images/jimmybutler.jpg" alt="Jimmy Butler" class="jersey-image">
                        </div>
                        <div class="jersey-name">Jimmy Butler</div>
                        <div class="jersey-price">₱300</div>
                        <a href="ordering.php?item=Jimmy Butler&cost=300" class="add-to-cart">Add to Cart</a>
                    </div>
                </div>
                
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="jersey-item">
                        <div class="jersey-image-container">
                            <img src="images/Wolves.jpg" alt="Karl Anthony Towns" class="jersey-image">
                        </div>
                        <div class="jersey-name">KAT WOLVES SERIES</div>
                        <div class="jersey-price">₱400</div>
                        <a href="ordering.php?item=Karl Anthony Towns Wolves Series&cost=400" class="add-to-cart">Add to Cart</a>
                    </div>
                </div>
                
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="jersey-item">
                        <div class="jersey-image-container">
                            <img src="images/Ball.jpeg" alt="Lamelo Ball" class="jersey-image">
                        </div>
                        <div class="jersey-name">Lamelo Ball</div>
                        <div class="jersey-price">₱500</div>
                        <a href="ordering.php?item=Lamelo Ball&cost=500" class="add-to-cart">Add to Cart</a>
                    </div>
                </div>
            </div>
            
            
            <div class="row">
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="jersey-item">
                        <div class="jersey-image-container">
                            <img src="images/wembanyama.jpeg" alt="Victor Wembanyama" class="jersey-image">
                        </div>
                        <div class="jersey-name">Victor Wembanyama</div>
                        <div class="jersey-price">₱600</div>
                        <a href="ordering.php?item=Victor Wembanyama&cost=600" class="add-to-cart">Add to Cart</a>
                    </div>
                </div>
                
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="jersey-item">
                        <div class="jersey-image-container">
                            <img src="images/irving.jpg" alt="Kyrie Irving" class="jersey-image">
                        </div>
                        <div class="jersey-name">Kyrie Irving</div>
                        <div class="jersey-price">₱700</div>
                        <a href="ordering.php?item=Kyrie Irving&cost=700" class="add-to-cart">Add to Cart</a>
                    </div>
                </div>
                
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="jersey-item">
                        <div class="jersey-image-container">
                            <img src="images/russell.jpg" alt="D Angelo Russell" class="jersey-image">
                        </div>
                        <div class="jersey-name">D Angelo Russell</div>
                        <div class="jersey-price">₱800</div>
                        <a href="ordering.php?item=D Angelo Russell&cost=800" class="add-to-cart">Add to Cart</a>
                    </div>
                </div>
                
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="jersey-item">
                        <div class="jersey-image-container">
                            <img src="images/Kemba.jpg" alt="Kemba Walker" class="jersey-image">
                        </div>
                        <div class="jersey-name">Kemba Walker</div>
                        <div class="jersey-price">₱900</div>
                        <a href="ordering.php?item=Kemba Walker&cost=900" class="add-to-cart">Add to Cart</a>
                    </div>
                </div>
                
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="jersey-item">
                        <div class="jersey-image-container">
                            <img src="images/Markannen.jpg" alt="Lauri Markannen" class="jersey-image">
                        </div>
                        <div class="jersey-name">Lauri Markannen</div>
                        <div class="jersey-price">₱1000</div>
                        <a href="ordering.php?item=Lauri Markannen&cost=1000" class="add-to-cart">Add to Cart</a>
                    </div>
                </div>
            </div>
            
        
            <div class="row">
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="jersey-item">
                        <div class="jersey-image-container">
                            <img src="images/Love.jpg" alt="Kevin Love" class="jersey-image">
                        </div>
                        <div class="jersey-name">Kevin Love</div>
                        <div class="jersey-price">₱1100</div>
                        <a href="ordering.php?item=Kevin Love&cost=1100" class="add-to-cart">Add to Cart</a>
                    </div>
                </div>
                
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="jersey-item">
                        <div class="jersey-image-container">
                            <img src="images/Nowitski.jpg" alt="Dirk Nowitzki" class="jersey-image">
                        </div>
                        <div class="jersey-name">Dirk Nowitzki</div>
                        <div class="jersey-price">₱1200</div>
                        <a href="ordering.php?item=Dirk Nowitzki&cost=1200" class="add-to-cart">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>