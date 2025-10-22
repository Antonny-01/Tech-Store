package com.example.techstoreapp;

import android.content.Intent;
import android.os.Bundle;
import android.widget.ImageView;
import android.widget.LinearLayout;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

public class SmartphonesActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_smartphones);

        // =============================
        // TOOLBAR WITH BACK BUTTON
        // =============================
        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        if (getSupportActionBar() != null) {
            getSupportActionBar().setDisplayHomeAsUpEnabled(true);
            getSupportActionBar().setTitle("Smartphones");
        }
        toolbar.setNavigationOnClickListener(v -> onBackPressed());

        // =============================
        // CLICKABLE CART ICON
        // =============================
        ImageView cartIcon = findViewById(R.id.cart_icon);
        cartIcon.setOnClickListener(v -> {
            Intent intent = new Intent(SmartphonesActivity.this, CartActivity.class);
            startActivity(intent);
        });

        // =============================
        // PHONE DATA
        // =============================
        int[] phoneIds = {
                R.id.phone1, R.id.phone2, R.id.phone3, R.id.phone4, R.id.phone5,
                R.id.phone6, R.id.phone7, R.id.phone8, R.id.phone9, R.id.phone10
        };

        String[] names = {
                "iPhone 15", "iPhone 15 Pro", "Samsung Galaxy S23", "Google Pixel 8",
                "OnePlus 12", "Xiaomi 14", "Sony Xperia 1 V", "Huawei P60 Pro",
                "Motorola Edge 40", "Nokia X50"
        };

        String[] prices = {
                "999", "1199", "899", "799", "749", "699", "949", "899", "599", "499"
        };

        String[] images = {
                "iphone15", "iphone15pro", "galaxys23", "pixel8", "oneplus12",
                "xiaomi14", "sony1v", "huaweip60", "motorolaedge40", "nokiax50"
        };

        String[] descriptions = {
                "Latest iPhone 15 with amazing features",
                "High-end iPhone 15 Pro with advanced camera",
                "Samsung Galaxy S23, powerful and sleek",
                "Google Pixel 8 with clean Android experience",
                "OnePlus 12 fast and smooth performance",
                "Xiaomi 14 with excellent battery life",
                "Sony Xperia 1 V professional camera",
                "Huawei P60 Pro premium flagship",
                "Motorola Edge 40 curved screen design",
                "Nokia X50 reliable and durable smartphone"
        };

        // =============================
        // SET CLICK LISTENERS FOR PRODUCTS
        // =============================
        for (int i = 0; i < phoneIds.length; i++) {
            int index = i;
            LinearLayout phoneLayout = findViewById(phoneIds[i]);
            phoneLayout.setOnClickListener(v -> {
                Intent intent = new Intent(SmartphonesActivity.this, ProductDetailsActivity.class);
                intent.putExtra("id", String.valueOf(index + 1));
                intent.putExtra("name", names[index]);
                intent.putExtra("price", prices[index]);
                intent.putExtra("image", images[index]);
                intent.putExtra("description", descriptions[index]);
                startActivity(intent);
            });
        }
    }
}