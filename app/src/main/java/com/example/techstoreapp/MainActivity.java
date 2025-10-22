package com.example.techstoreapp;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

public class MainActivity extends AppCompatActivity {

    TextView titleTv;
    Button loginBtn, signupBtn, logoutBtn;
    ImageView cartIcon;
    Button btnHome, btnDeals, btnLaptops, btnSmartphones, btnAccessories;
    Button addToCart1, addToCart2, addToCart3, addToCart4, addToCart5, addToCart6;
    Button btnShopDeals;

    private CartManager cartManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        cartManager = new CartManager(this);

        // Header & Buttons
        titleTv = findViewById(R.id.titleTv);
        loginBtn = findViewById(R.id.btn_login);
        signupBtn = findViewById(R.id.btn_signup);
        logoutBtn = findViewById(R.id.logoutBtn);
        cartIcon = findViewById(R.id.cart_icon);

        // Navigation buttons
        btnHome = findViewById(R.id.btn_home);
        btnDeals = findViewById(R.id.btn_deals);
        btnLaptops = findViewById(R.id.btn_laptops);
        btnSmartphones = findViewById(R.id.btn_smartphones);
        btnAccessories = findViewById(R.id.btn_accessories);
        btnShopDeals = findViewById(R.id.btn_shop_deals);

        // Add-to-cart buttons
        addToCart1 = findViewById(R.id.addToCart1);
        addToCart2 = findViewById(R.id.addToCart2);
        addToCart3 = findViewById(R.id.addToCart3);
        addToCart4 = findViewById(R.id.addToCart4);
        addToCart5 = findViewById(R.id.addToCart5);
        addToCart6 = findViewById(R.id.addToCart6);

        // Check logged-in user
        if (SessionManager.isLoggedIn(this)) {
            String name = SessionManager.getUserName(this);
            showUserHeader(name);
        }

        // Login / Signup
        loginBtn.setOnClickListener(v -> startActivity(new Intent(this, LoginActivity.class)));
        signupBtn.setOnClickListener(v -> startActivity(new Intent(this, SignupActivity.class)));

        // Logout
        logoutBtn.setOnClickListener(v -> {
            SessionManager.logout(this);
            recreate(); // instantly update UI
        });

        // Navigation actions
        btnHome.setOnClickListener(v -> recreate());
        btnDeals.setOnClickListener(v -> startActivity(new Intent(this, DealsActivity.class)));
        btnLaptops.setOnClickListener(v -> startActivity(new Intent(this, LaptopsActivity.class)));
        btnSmartphones.setOnClickListener(v -> startActivity(new Intent(this, SmartphonesActivity.class)));
        btnAccessories.setOnClickListener(v -> startActivity(new Intent(this, AccessoriesActivity.class)));
        btnShopDeals.setOnClickListener(v -> startActivity(new Intent(this, DealsActivity.class)));

        // Cart icon
        cartIcon.setOnClickListener(v -> startActivity(new Intent(this, CartActivity.class)));

        // Add to cart actions
        addToCart1.setOnClickListener(v -> addProductToCart("1", "Gaming Laptop GTX 3060", 1299, "product1.jpg", "High performance gaming laptop"));
        addToCart2.setOnClickListener(v -> addProductToCart("2", "iPhone 15 Pro Max", 1199, "product5.jpg", "Latest iPhone 15 Pro Max"));
        addToCart3.setOnClickListener(v -> addProductToCart("3", "Wireless EarPods", 199, "product2.jpg", "Noise-cancelling wireless EarPods"));
        addToCart4.setOnClickListener(v -> addProductToCart("4", "Smartwatch Pro 2025", 349, "product3.jpg", "Smartwatch with health tracking"));
        addToCart5.setOnClickListener(v -> addProductToCart("5", "4K Drone Camera", 499, "product6.jpg", "High-resolution drone camera"));
        addToCart6.setOnClickListener(v -> addProductToCart("6", "Bluetooth Speaker X2", 149, "product7.jpg", "Portable Bluetooth speaker"));

        // Handle login data from LoginActivity
        String nameFromLogin = getIntent().getStringExtra("user_name");
        if (nameFromLogin != null) {
            SessionManager.setLogin(this, true);
            SessionManager.setUserName(this, nameFromLogin);
            showUserHeader(nameFromLogin);
        }
    }

    private void addProductToCart(String id, String name, double price, String imageUrl, String desc) {
        Product product = new Product(id, name, String.valueOf(price), imageUrl, desc);
        cartManager.addItem(product);
        Toast.makeText(this, name + " added to cart!", Toast.LENGTH_SHORT).show();
    }

    private void showUserHeader(String fullName) {
        titleTv.setText("Welcome, " + fullName.split(" ")[0]);
        loginBtn.setVisibility(View.GONE);
        signupBtn.setVisibility(View.GONE);
        logoutBtn.setVisibility(View.VISIBLE);
    }
}