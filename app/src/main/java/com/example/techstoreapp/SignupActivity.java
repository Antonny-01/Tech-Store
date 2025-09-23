package com.example.techstoreapp;

import android.content.Intent;
import android.os.Bundle;
import android.util.Patterns;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

public class SignupActivity extends AppCompatActivity {

    EditText fullnameEt, emailEt, passwordEt, confirmPasswordEt;
    Button signupBtn;
    DBHelper dbHelper;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup);

        // Enable built-in back arrow in the action bar
        if (getSupportActionBar() != null) {
            getSupportActionBar().setDisplayHomeAsUpEnabled(true);
            getSupportActionBar().setTitle("Sign Up"); // Optional: set title
        }

        fullnameEt = findViewById(R.id.fullnameEt);
        emailEt = findViewById(R.id.emailEt);
        passwordEt = findViewById(R.id.passwordEt);
        confirmPasswordEt = findViewById(R.id.confirmPasswordEt);
        signupBtn = findViewById(R.id.signupBtn);

        dbHelper = new DBHelper(this);

        signupBtn.setOnClickListener(v -> {
            String name = fullnameEt.getText().toString().trim();
            String email = emailEt.getText().toString().trim();
            String password = passwordEt.getText().toString().trim();
            String confirmPassword = confirmPasswordEt.getText().toString().trim();

            if (name.length() < 3) {
                Toast.makeText(this, "Full name must be at least 3 characters", Toast.LENGTH_SHORT).show();
                return;
            }

            if (!Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
                Toast.makeText(this, "Enter a valid email", Toast.LENGTH_SHORT).show();
                return;
            }

            if (password.length() < 6) {
                Toast.makeText(this, "Password must be at least 6 characters", Toast.LENGTH_SHORT).show();
                return;
            }

            if (!password.equals(confirmPassword)) {
                Toast.makeText(this, "Passwords do not match", Toast.LENGTH_SHORT).show();
                return;
            }

            boolean inserted = dbHelper.insertUser(name, email, password);
            if (inserted) {
                Toast.makeText(this, "Signup successful", Toast.LENGTH_SHORT).show();
                Intent intent = new Intent(SignupActivity.this, LoginActivity.class);
                startActivity(intent);
                finish();
            } else {
                Toast.makeText(this, "Email already exists", Toast.LENGTH_SHORT).show();
            }
        });
    }

    // Handle back arrow click
    @Override
    public boolean onSupportNavigateUp() {
        finish(); // Go back to previous activity
        return true;
    }
}