package com.example.techstoreapp;

import android.content.Intent;
import android.os.Bundle;
import android.widget.TextView;
import android.widget.Button;
import android.widget.ImageView;

import androidx.appcompat.app.AppCompatActivity;

public class MainActivity extends AppCompatActivity {

    TextView titleTv;
    Button loginBtn, signupBtn;
    ImageView cartIcon;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // Initialize views
        titleTv = findViewById(R.id.titleTv);
        loginBtn = findViewById(R.id.btn_login);
        signupBtn = findViewById(R.id.btn_signup);
        cartIcon = findViewById(R.id.cart_icon);

        // Set button click actions
        loginBtn.setOnClickListener(v -> {
            Intent intent = new Intent(MainActivity.this, LoginActivity.class);
            startActivity(intent);
        });

        signupBtn.setOnClickListener(v -> {
            Intent intent = new Intent(MainActivity.this, SignupActivity.class);
            startActivity(intent);
        });

        // Show user initials if logged in
        String name = getIntent().getStringExtra("user_name");
        if (name != null && !name.isEmpty()) {
            String initials = "";
            String[] parts = name.split(" ");
            for (String part : parts) {
                initials += part.charAt(0);
            }
            titleTv.setText("Tech Store (" + initials.toUpperCase() + ")");

            // Hide login/signup buttons
            loginBtn.setVisibility(Button.GONE);
            signupBtn.setVisibility(Button.GONE);
        }
    }
}