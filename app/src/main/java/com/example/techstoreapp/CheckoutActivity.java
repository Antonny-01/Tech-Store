package com.example.techstoreapp;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

public class CheckoutActivity extends AppCompatActivity {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);


        SharedPreferences prefs = getSharedPreferences("UserSession", MODE_PRIVATE);
        boolean isLoggedIn = prefs.getBoolean("isLoggedIn", false);

        if (!isLoggedIn) {

            Toast.makeText(this, "Please login to continue checkout", Toast.LENGTH_SHORT).show();
            Intent intent = new Intent(CheckoutActivity.this, LoginActivity.class);
            startActivity(intent);
            finish();
            return;
        }

        // ✅ Logged in — allow access
        setContentView(R.layout.activity_checkout);
        Toast.makeText(this, "Select your payment method", Toast.LENGTH_SHORT).show();
    }
}