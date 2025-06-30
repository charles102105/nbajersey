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
        
        .jersey-table {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .jersey-item {
            text-align: center;
            padding: 25px;
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
            height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 5px;
            margin-bottom: 20px;
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
            font-size: 18px;
            font-weight: bold;
            margin: 15px 0;
            color: #333;
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .jersey-price {
            font-size: 20px;
            color: #dc3545;
            font-weight: bold;
            margin: 15px 0;
        }
        
        .add-to-cart {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            font-size: 16px;
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
        
        .grid-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        @media (max-width: 1200px) {
            .grid-container {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        @media (max-width: 992px) {
            .grid-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .grid-container {
                grid-template-columns: repeat(2, 1fr);
            }
            .jersey-image-container {
                height: 150px;
            }
        }
        
        @media (max-width: 576px) {
            .grid-container {
                grid-template-columns: 1fr;
            }
            .jersey-image-container {
                height: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container">
                <a class="navbar-brand" href="#">NBA JERSEY STORE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">My Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="user-info">
            <strong>Welcome, user@example.com!</strong>
            <span class="float-end">
                <a href="#" class="btn btn-sm btn-outline-primary">View My Orders</a>
            </span>
        </div>
        
        <div class="search-container">
            <h2 class="search-title">Search NBA Jerseys</h2>
            
            <form class="search-form">
                <div class="input-group">
                    <input type="text" class="form-control search-input" placeholder="Search by player name...">
                    <button type="submit" class="btn search-btn">Search</button>
                </div>
            </form>
            
            <div style="text-align: center; margin-top: 20px; color: #666; font-size: 14px;">
                <strong>Popular searches:</strong> LeBron, Curry, Giannis, Jokic, Wembanyama
            </div>
        </div>
        
        <div class="jersey-table">
            <h1 class="text-center mb-4">NBA JERSEY COLLECTION</h1>
            
            <div class="grid-container">
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/kawhileonard.jpg" alt="Kawhi Leonard" class="jersey-image">
                    </div>
                    <div class="jersey-name">Kawhi Leonard</div>
                    <div class="jersey-price">₱100</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/brunson.jpg" alt="Jalen Brunson" class="jersey-image">
                    </div>
                    <div class="jersey-name">Jalen Brunson</div>
                    <div class="jersey-price">₱200</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/jimmybutler.jpg" alt="Jimmy Butler" class="jersey-image">
                    </div>
                    <div class="jersey-name">Jimmy Butler</div>
                    <div class="jersey-price">₱300</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/Wolves.jpg" alt="KAT WOLVES SERIES" class="jersey-image">
                    </div>
                    <div class="jersey-name">KAT WOLVES SERIES</div>
                    <div class="jersey-price">₱400</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/Ball.jpeg" alt="Lamelo Ball" class="jersey-image">
                    </div>
                    <div class="jersey-name">Lamelo Ball</div>
                    <div class="jersey-price">₱500</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/wembanyama.jpeg" alt="Victor Wembanyama" class="jersey-image">
                    </div>
                    <div class="jersey-name">Victor Wembanyama</div>
                    <div class="jersey-price">₱600</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/irving.jpg" alt="Kyrie Irving" class="jersey-image">
                    </div>
                    <div class="jersey-name">Kyrie Irving</div>
                    <div class="jersey-price">₱700</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/russell.jpg" alt="D Angelo Russell" class="jersey-image">
                    </div>
                    <div class="jersey-name">D Angelo Russell</div>
                    <div class="jersey-price">₱800</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/Kemba.jpg" alt="Kemba Walker" class="jersey-image">
                    </div>
                    <div class="jersey-name">Kemba Walker</div>
                    <div class="jersey-price">₱900</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/Markannen.jpg" alt="Lauri Markannen" class="jersey-image">
                    </div>
                    <div class="jersey-name">Lauri Markannen</div>
                    <div class="jersey-price">₱1,000</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/Love.jpg" alt="Kevin Love" class="jersey-image">
                    </div>
                    <div class="jersey-name">Kevin Love</div>
                    <div class="jersey-price">₱1,100</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/Nowitski.jpg" alt="Dirk Nowitzki" class="jersey-image">
                    </div>
                    <div class="jersey-name">Dirk Nowitzki</div>
                    <div class="jersey-price">₱1,200</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/Jokic.jpg" alt="Nikola Jokic" class="jersey-image">
                    </div>
                    <div class="jersey-name">Nikola Jokic</div>
                    <div class="jersey-price">₱1,300</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/Curry.jpg" alt="Stephen Curry" class="jersey-image">
                    </div>
                    <div class="jersey-name">Stephen Curry</div>
                    <div class="jersey-price">₱1,400</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/Harden.jpg" alt="James Harden" class="jersey-image">
                    </div>
                    <div class="jersey-name">James Harden</div>
                    <div class="jersey-price">₱1,500</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/Oladipo.jpg" alt="Victor Oladipo" class="jersey-image">
                    </div>
                    <div class="jersey-name">Victor Oladipo</div>
                    <div class="jersey-price">₱1,600</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/Lebron.jpg" alt="Lebron James" class="jersey-image">
                    </div>
                    <div class="jersey-name">Lebron James</div>
                    <div class="jersey-price">₱1,700</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/Conley.jpg" alt="Mike Conley" class="jersey-image">
                    </div>
                    <div class="jersey-name">Mike Conley</div>
                    <div class="jersey-price">₱1,800</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/Wade.jpg" alt="Dwayne Wade" class="jersey-image">
                    </div>
                    <div class="jersey-name">Dwayne Wade</div>
                    <div class="jersey-price">₱1,900</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/Giannis.jpg" alt="Giannis Antetokounmpo" class="jersey-image">
                    </div>
                    <div class="jersey-name">Giannis Antetokounmpo</div>
                    <div class="jersey-price">₱2,000</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/Westbrook.jpg" alt="Russell Westbrook" class="jersey-image">
                    </div>
                    <div class="jersey-name">Russell Westbrook</div>
                    <div class="jersey-price">₱2,100</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/Suns.jpg" alt="Devin Booker" class="jersey-image">
                    </div>
                    <div class="jersey-name">Devin Booker</div>
                    <div class="jersey-price">₱2,200</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/Fox.jpg" alt="De'Aaron Fox" class="jersey-image">
                    </div>
                    <div class="jersey-name">De'Aaron Fox</div>
                    <div class="jersey-price">₱2,300</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/Utah.jpg" alt="Jordan Clarkson" class="jersey-image">
                    </div>
                    <div class="jersey-name">Jordan Clarkson</div>
                    <div class="jersey-price">₱2,400</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
                
                <div class="jersey-item">
                    <div class="jersey-image-container">
                        <img src="images/Spurs.jpg" alt="Manu Ginobili" class="jersey-image">
                    </div>
                    <div class="jersey-name">Manu Ginobili</div>
                    <div class="jersey-price">₱2,500</div>
                    <a href="#" class="add-to-cart">Add to Cart</a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>