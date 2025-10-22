package com.example.techstoreapp;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.bumptech.glide.Glide;

public class ProductDetailsActivity extends AppCompatActivity {

    private ImageView productImage;
    private TextView productName, productPrice, productDescription;
    private Button buyButton;

    private String id, name, price, image, description;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_product_details);

        // Step 1: Link layout elements
        productImage = findViewById(R.id.productImage);
        productName = findViewById(R.id.productName);
        productPrice = findViewById(R.id.productPrice);
        productDescription = findViewById(R.id.productDescription);
        buyButton = findViewById(R.id.buyButton);

        // Step 2: Receive product data from previous activity
        Intent intent = getIntent();
        id = intent.getStringExtra("id");
        name = intent.getStringExtra("name");
        price = intent.getStringExtra("price");
        image = intent.getStringExtra("image");
        description = intent.getStringExtra("description");

        // Step 3: Display product info
        productName.setText(name);
        // Display with $ but store price as numeric only
        productPrice.setText("Price: $" + price);
        productDescription.setText(description);

        if (image.startsWith("http")) {
            // Load from URL (your PHP API provides full URL)
            Glide.with(this)
                    .load(image)
                    .placeholder(R.drawable.placeholder)
                    .into(productImage);
        } else {
            // Load from local drawable resources
            int imageResId = getResources().getIdentifier(image, "drawable", getPackageName());
            Glide.with(this)
                    .load(imageResId)
                    .into(productImage);
        }

        // Step 4: Handle Buy button click
        buyButton.setOnClickListener(v -> {
            // Ensure price stored is numeric only
            String numericPrice = price.replaceAll("[^0-9.]", "");
            Product product = new Product(id, name, numericPrice, image, description);

            CartManager cartManager = new CartManager(ProductDetailsActivity.this);
            cartManager.addItem(product);

            Toast.makeText(this, "Added to cart", Toast.LENGTH_SHORT).show();

            // Go to CartActivity
            Intent cartIntent = new Intent(ProductDetailsActivity.this, CartActivity.class);
            startActivity(cartIntent);
        });
    }
}
