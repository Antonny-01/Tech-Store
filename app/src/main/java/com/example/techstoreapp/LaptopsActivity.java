package com.example.techstoreapp;

import android.content.Intent;
import android.os.Bundle;
import android.widget.LinearLayout;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

public class LaptopsActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_laptops);

        // Setup toolbar with back button
        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true); // show back arrow
        getSupportActionBar().setDisplayShowHomeEnabled(true);

        // Click listeners for laptops
        setupClick(R.id.laptop1_layout, "Dell Inspiron 15", "699", "laptop1");
        setupClick(R.id.laptop2_layout, "HP Pavilion 14", "649", "laptop2");
        setupClick(R.id.laptop3_layout, "Lenovo IdeaPad 5", "599", "laptop3");
        setupClick(R.id.laptop4_layout, "Asus VivoBook 15", "629", "laptop4");
        setupClick(R.id.laptop5_layout, "Acer Aspire 7", "699", "laptop5");
        setupClick(R.id.laptop6_layout, "MacBook Air M1", "999", "laptop6");
        setupClick(R.id.laptop7_layout, "MacBook Pro 14”", "1699", "laptop7");
        setupClick(R.id.laptop8_layout, "Surface Laptop 4", "1099", "laptop8");
        setupClick(R.id.laptop9_layout, "Razer Blade 15", "1899", "laptop9");
        setupClick(R.id.laptop10_layout, "Alienware m15 R6", "2099", "laptop10");
    }

    private void setupClick(int layoutId, String name, String price, String imageName) {
        LinearLayout layout = findViewById(layoutId);
        layout.setOnClickListener(v -> {
            Intent intent = new Intent(LaptopsActivity.this, ProductDetailsActivity.class);
            intent.putExtra("name", name);
            intent.putExtra("price", price);
            intent.putExtra("image", imageName);
            startActivity(intent);
        });
    }

    // Handle toolbar back button
    @Override
    public boolean onSupportNavigateUp() {
        onBackPressed();
        return true;
    }
}