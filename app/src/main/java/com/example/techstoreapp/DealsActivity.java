package com.example.techstoreapp;

import android.content.Intent;
import android.os.Bundle;
import android.widget.ImageView;
import androidx.appcompat.app.AppCompatActivity;

public class DealsActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_deals);

        // Cart icon click
        ImageView cartIcon = findViewById(R.id.cartIcon);
        cartIcon.setOnClickListener(v -> startActivity(new Intent(DealsActivity.this, CartActivity.class)));

        // Click listeners for all deals
        setupDealClick(R.id.deal1, "1", "Phone Case", "15.99", "deal1", "Durable silicone phone case with a sleek design.");
        setupDealClick(R.id.deal2, "2", "Wireless Earbuds", "59.99", "deal2", "Noise-cancelling Bluetooth earbuds with long battery life.");
        setupDealClick(R.id.deal3, "3", "4K Ultra TV", "799.99", "deal3", "Smart 55-inch 4K Ultra HD TV with HDR support.");
        setupDealClick(R.id.deal4, "4", "Android Smartphone", "349.99", "deal4", "Fast and reliable Android phone with 128GB storage.");
        setupDealClick(R.id.deal5, "5", "Computer Mouse", "19.99", "deal5", "Wireless ergonomic mouse with smooth tracking.");
        setupDealClick(R.id.deal6, "6", "Phone Charger", "12.99", "deal6", "Fast-charging USB-C wall adapter with cable.");
        setupDealClick(R.id.deal7, "7", "Wireless Speaker", "89.99", "deal7", "Portable Bluetooth speaker with deep bass sound.");
        setupDealClick(R.id.deal8, "8", "Android Smartphone", "399.99", "deal8", "Powerful Android phone with great camera performance.");
        setupDealClick(R.id.deal9, "9", "Nokia Phone", "129.99", "deal9", "Classic Nokia phone with modern smart features.");
        setupDealClick(R.id.deal10, "10", "Smartwatch", "149.99", "deal10", "Stylish smartwatch with fitness and notification tracking.");
    }

    private void setupDealClick(int layoutId, String id, String name, String price, String image, String description) {
        findViewById(layoutId).setOnClickListener(v -> {
            Intent intent = new Intent(DealsActivity.this, ProductDetailsActivity.class);
            intent.putExtra("id", id);
            intent.putExtra("name", name);
            intent.putExtra("price", price);
            intent.putExtra("image", image);
            intent.putExtra("description", description);
            startActivity(intent);
        });
    }
}
