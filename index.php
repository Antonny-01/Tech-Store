<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tech Store - Latest Tech Products & Gadgets</title>
  
  <style>
    :root {
      --primary: #2563eb;
      --primary-dark: #1d4ed8;
      --secondary: #3b82f6;
      --accent: #f59e0b;
      --light: #f3f4f6;
      --dark: #1f2937;
      --gray: #6b7280;
      --success: #10b981;
      --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1);
      --card-hover: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }
    
    body {
      background-color: #f8fafc;
      color: var(--dark);
      line-height: 1.6;
    }
    
    /* Header Styles */
    .top-bar {
      background-color: blue;
      color: white;
      padding: 8px 0;
      font-size: 0.85rem;
      text-align: center;
    }
    
    .top-bar p {
      margin: 0;
    }
    
    header {
      background-color: white;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
      position: sticky;
      top: 0;
      z-index: 100;
    }
    
    .header-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 5%;
      max-width: 1400px;
      margin: 0 auto;
    }
    
    .logo {
      font-size: 1.8rem;
      font-weight: 700;
      color: var(--primary);
      display: flex;
      align-items: center;
      gap: 8px;
    }
    
    .logo i {
      color: var(--accent);
    }
    
    .search-bar {
      flex: 1;
      max-width: 600px;
      margin: 0 20px;
      position: relative;
    }
    
    .search-bar input {
      width: 100%;
      padding: 12px 20px;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      font-size: 1rem;
      background-color: #f9fafb;
      transition: all 0.2s;
    }
    
    .search-bar input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
      background-color: white;
    }
    
    .search-bar button {
      position: absolute;
      right: 5px;
      top: 5px;
      padding: 7px 15px;
      border: none;
      background-color: var(--primary);
      color: white;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.2s;
    }
    
    .search-bar button:hover {
      background-color: var(--primary-dark);
    }
    
    .user-links {
      display: flex;
      align-items: center;
      gap: 20px;
    }
    
    .user-links a {
      color: var(--dark);
      text-decoration: none;
      display: flex;
      flex-direction: column;
      align-items: center;
      font-size: 0.9rem;
      transition: color 0.2s;
    }
    
    .user-links a:hover {
      color: var(--primary);
    }
    
    .user-links a i {
      font-size: 1.2rem;
      margin-bottom: 4px;
    }
    
    .user-initials {
      background-color: var(--primary);
      color: white;
      font-weight: 600;
      padding: 10px;
      border-radius: 50%;
      text-align: center;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: background-color 0.2s;
    }
    
    .user-initials:hover {
      background-color: var(--primary-dark);
    }
    
    .cart-icon {
      position: relative;
    }
    
    .cart-count {
      position: absolute;
      top: -8px;
      right: -8px;
      background-color: var(--accent);
      color: white;
      font-size: 0.7rem;
      font-weight: bold;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    /* Navigation */
    nav {
      background-color:rgba(242, 243, 246, 1);
      border-top: 1px solid #e5e7eb;
      padding: 0 5%;
    }
    
    .nav-container {
      display: flex;
      justify-content: center;
      gap: 30px;
      max-width: 1400px;
      margin: 0 auto;
    }
    
    nav a {
      color: var(--dark);
      text-decoration: none;
      padding: 12px 0;
      font-weight: 500;
      position: relative;
      transition: color 0.2s;
    }
    
    nav a:hover {
      color: var(--primary);
    }
    
    nav a:hover::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 3px;
      background-color: var(--primary);
      border-radius: 3px 3px 0 0;
    }
    
    /* Hero Section */
    .hero {
      background: linear-gradient(to right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.3)), url('images/download1.jpg') no-repeat center center;
      background-size: cover;
      color: white;
      padding: 80px 5%;
      text-align: center;
      margin-bottom: 40px;
    }
    
    .hero-content {
      max-width: 800px;
      margin: 0 auto;
    }
    
    .hero h1 {
      font-size: 2.8rem;
      margin-bottom: 16px;
      font-weight: 700;
    }
    
    .hero p {
      font-size: 1.2rem;
      margin-bottom: 30px;
      opacity: 0.9;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }
    
    .hero-buttons {
      display: flex;
      gap: 15px;
      justify-content: center;
    }
    
    .btn {
      padding: 12px 24px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.2s;
      text-decoration: none;
      display: inline-block;
    }
    
    .btn-primary {
      background-color: var(--primary);
      color: white;
      border: none;
    }
    
    .btn-primary:hover {
      background-color: var(--primary-dark);
      transform: translateY(-2px);
    }
    
    .btn-outline {
      background-color: transparent;
      color: white;
      border: 2px solid white;
    }
    
    .btn-outline:hover {
      background-color: white;
      color: var(--dark);
      transform: translateY(-2px);
    }
    
    /* Products Section */
    .container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 0 5%;
    }
    
    .section-title {
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 30px;
      color: var(--dark);
      position: relative;
      padding-bottom: 10px;
    }
    
    .section-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 60px;
      height: 4px;
      background-color: var(--accent);
      border-radius: 2px;
    }
    
    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 25px;
      margin-bottom: 50px;
    }
    
    .product-card {
      background-color: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: var(--card-shadow);
      transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--card-hover);
    }
    
    .product-image {
      height: 200px;
      width: 100%;
      object-fit: cover;
      border-bottom: 1px solid #f1f1f1;
    }
    
    .product-info {
      padding: 20px;
    }
    
    .product-category {
      color: var(--gray);
      font-size: 0.85rem;
      margin-bottom: 5px;
    }
    
    .product-title {
      font-size: 1.1rem;
      font-weight: 600;
      margin-bottom: 10px;
      color: var(--dark);
    }
    
    .product-price {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-top: 15px;
    }
    
    .price {
      font-weight: 700;
      color: var(--primary);
      font-size: 1.2rem;
    }
    
    .add-to-cart {
      background-color: var(--primary);
      color: white;
      border: none;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: background-color 0.2s;
    }
    
    .add-to-cart:hover {
      background-color: var(--primary-dark);
    }
    
    /* Categories Section */
    .categories {
      margin: 60px 0;
    }
    
    .category-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 20px;
    }
    
    .category-card {
      background-color: white;
      border-radius: 12px;
      padding: 25px 20px;
      text-align: center;
      box-shadow: var(--card-shadow);
      transition: transform 0.3s, box-shadow 0.3s;
      cursor: pointer;
    }
    
    .category-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--card-hover);
    }
    
    .category-icon {
      font-size: 2.5rem;
      color: var(--primary);
      margin-bottom: 15px;
    }
    
    .category-title {
      font-weight: 600;
      font-size: 1.1rem;
      color: var(--dark);
    }
    
    /* Newsletter Section */
    .newsletter {
      background-color: var(--primary);
      color: white;
      padding: 60px 5%;
      text-align: center;
      margin: 60px 0;
    }
    
    .newsletter-content {
      max-width: 600px;
      margin: 0 auto;
    }
    
    .newsletter h2 {
      font-size: 2rem;
      margin-bottom: 16px;
    }
    
    .newsletter p {
      margin-bottom: 30px;
      opacity: 0.9;
    }
    
    .newsletter-form {
      display: flex;
      max-width: 500px;
      margin: 0 auto;
    }
    
    .newsletter-form input {
      flex: 1;
      padding: 15px 20px;
      border: none;
      border-radius: 8px 0 0 8px;
      font-size: 1rem;
    }
    
    .newsletter-form input:focus {
      outline: none;
    }
    
    .newsletter-form button {
      padding: 0 25px;
      background-color: var(--accent);
      color: white;
      border: none;
      border-radius: 0 8px 8px 0;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.2s;
    }
    
    .newsletter-form button:hover {
      background-color: #e69008;
    }
    
    /* Footer */
    footer {
      background-color: var(--dark);
      color: white;
      padding: 60px 5% 30px;
    }
    
    .footer-container {
      max-width: 1400px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 40px;
    }
    
    .footer-col h3 {
      font-size: 1.2rem;
      margin-bottom: 20px;
      position: relative;
      padding-bottom: 10px;
    }
    
    .footer-col h3::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 40px;
      height: 3px;
      background-color: blue;
    }
    
    .footer-col ul {
      list-style: none;
    }
    
    .footer-col ul li {
      margin-bottom: 12px;
    }
    
    .footer-col ul li a {
      color: #d1d5db;
      text-decoration: none;
      transition: color 0.2s;
    }
    
    .footer-col ul li a:hover {
      color: white;
    }
    
    .social-links {
      display: flex;
      gap: 15px;
      margin-top: 20px;
    }
    
    .social-links a {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      color: white;
      transition: background-color 0.2s;
    }
    
    .social-links a:hover {
      background-color: var(--primary);
    }
    
    .copyright {
      text-align: center;
      margin-top: 50px;
      padding-top: 20px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      color: #9ca3af;
      font-size: 0.9rem;
    }
    
    /* Responsive Design */
    @media (max-width: 900px) {
      .header-container {
        flex-direction: column;
        gap: 15px;
      }
      
      .search-bar {
        width: 100%;
        max-width: none;
        margin: 15px 0;
      }
      
      .nav-container {
        flex-wrap: wrap;
        gap: 15px;
      }
      
      .hero h1 {
        font-size: 2.2rem;
      }
    }
    
    @media (max-width: 600px) {
      .hero h1 {
        font-size: 1.8rem;
      }
      
      .hero-buttons {
        flex-direction: column;
      }
      
      .newsletter-form {
        flex-direction: column;
        gap: 10px;
      }
      
      .newsletter-form input,
      .newsletter-form button {
        border-radius: 8px;
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <!-- Top Bar -->
  <div class="top-bar">
    <p>Free shipping on orders over $50 | 30-day money-back guarantee</p>
  </div>
  
  <!-- Header -->
  <header>
    <div class="header-container">
      <a href="index.php" class="logo">
        <i class="fas fa-laptop-code"></i>
        TechStore
      </a>
      
      <div class="search-bar">
        <input type="text" placeholder="Search for products, brands, and categories...">
        <button><i class="fas fa-search"></i></button>
       </div>
      
      <div class="user-links">
        <?php if(isset($_SESSION['initials'])): ?>
          <div class="user-initials"><?php echo $_SESSION['initials']; ?></div>
       <div class="user-links"> <a href="logout.php">Logout</a></div>
          
        <?php else: ?>
          <a href="login.html">
            <i class="fas fa-user"></i>
            <span>Login</span>
          </a>
        <?php endif; ?>
        
        <a href="#" class="cart-icon">
          <i class="fas fa-shopping-cart"></i>
         
        </a>
      </div>
    </div>
  </header>
  
  <!-- Navigation -->
  <nav>
    <div class="nav-container">
      <a href="index.php">Home</a>
      <a href="deals.html">Deals</a>
      <a href="laptops.php">Laptops</a>
      <a href="smartphones.php">Smartphones</a>
      <a href="accessories.html">Accessories</a>
      <a href="support.html">Support</a>
    </div>
  </nav>
  
  <!-- Hero Banner -->
  <section class="hero">
    <div class="hero-content">
      <h1>Cutting-Edge Technology for Everyday Life</h1>
      <p>Discover the latest gadgets and tech innovations with free shipping and guaranteed satisfaction.</p>
      <div class="hero-buttons">
        <a href="deals.html" class="btn btn-primary">Shop Latest Deals</a>
        <a href="laptops.php" class="btn btn-outline">Browse Products</a>
      </div>
    </div>
  </section>
  
  <!-- Featured Products -->
  <section class="container">
    <h2 class="section-title">Featured Products</h2>
    <div class="product-grid">
      <div class="product-card">
        <img src="images/download4.jpg" alt="Gaming Laptop" class="product-image">
        <div class="product-info">
          <div class="product-category">Laptops & Computers</div>
          <h3 class="product-title">Gaming Laptop GTX 3060</h3>
          <div class="product-price">
            <div class="price">$1,299.00</div>
            <button class="add-to-cart"><i class="fas fa-plus"></i></button>
          </div>
        </div>
      </div>
      
      <div class="product-card">
        <img src="images/download5.jpg" alt="Wireless Earbuds" class="product-image">
        <div class="product-info">
          <div class="product-category">Headphones</div>
          <h3 class="product-title">Wireless Earbuds Pro X</h3>
          <div class="product-price">
            <div class="price">$89.99</div>
            <button class="add-to-cart"><i class="fas fa-plus"></i></button>
          </div>
        </div>
      </div>
      
      <div class="product-card">
        <img src="images/download6.jpg" alt="Smart Watch" class="product-image">
        <div class="product-info">
          <div class="product-category">Wearables</div>
          <h3 class="product-title">Smart Watch Ultra</h3>
          <div class="product-price">
            <div class="price">$199.00</div>
            <button class="add-to-cart"><i class="fas fa-plus"></i></button>
          </div>
        </div>
      </div>
      
      <div class="product-card">
        <img src="images/download7.jpg" alt="Bluetooth Speaker" class="product-image">
        <div class="product-info">
          <div class="product-category"> Headphones</div>
          <h3 class="product-title">Bluetooth Speaker Bass+</h3>
          <div class="product-price">
            <div class="price">$49.99</div>
            <button class="add-to-cart"><i class="fas fa-plus"></i></button>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Categories -->
  <section class="container categories">
    <h2 class="section-title">Shop by Category</h2>
    <div class="category-grid">
      <div class="category-card">
        <div class="category-icon"><i class="fas fa-laptop"></i></div>
        <div class="category-title">Laptops & Computers</div>
      </div>
      
      <div class="category-card">
        <div class="category-icon"><i class="fas fa-mobile-alt"></i></div>
        <div class="category-title">Smartphones</div>
      </div>
      
 
      
      <div class="category-card">
        <div class="category-icon"><i class="fas fa-tablet-alt"></i></div>
        <div class="category-title">Tablets</div>
      </div>
      

  </section>
  
  <!-- Newsletter -->
  <section class="newsletter">
    <div class="newsletter-content">
      <h2>Stay Updated with TechStore</h2>
      <p>Subscribe to our newsletter for the latest product updates, exclusive deals, and tech news.</p>
      <form class="newsletter-form">
        <input type="email" placeholder="Enter your email address">
        <button type="submit">Subscribe</button>
      </form>
    </div>
  </section>
  
  <!-- Footer -->
  <footer>
    <div class="footer-container">
      <div class="footer-col">
        <h3>TechStore</h3>
        <p>Your trusted partner for all tech needs. We offer the latest gadgets with guaranteed quality and support.</p>
        <div class="social-links">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
      
      <div class="footer-col">
        <h3>Shop</h3>
        <ul>
          <li><a href="laptops.php">Laptops & Computers</a></li>
          <li><a href="smartphones.html">Smartphones </a></li>
          
        </ul>
      </div>
      
      <div class="footer-col">
        <h3>Support</h3>
        <ul>
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">FAQs</a></li>
          <li><a href="#">Shipping & Returns</a></li>
          <li><a href="#">Warranty Information</a></li>
          <li><a href="#">Track Order</a></li>
        </ul>
      </div>
      
      <div class="footer-col">
        <h3>About</h3>
        <ul>
          <li><a href="#">Our Story</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Careers</a></li>
          <li><a href="#">Investor Relations</a></li>
          <li><a href="#">Sustainability</a></li>
        </ul>
      </div>
    </div>
    
    <div class="copyright">
      <p>&copy; 2025 TechStore. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </div>
  </footer>
</body>
</html>