package com.example.techstoreapp;

import android.os.Bundle;
import android.util.Patterns;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;
import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class SignupActivity extends AppCompatActivity {

    EditText fullnameEt, emailEt, passwordEt, confirmPasswordEt;
    Button signupBtn;
    private static final String SIGNUP_URL = "http://172.20.10.4/Tech%20Store/signup.php"; // replace with your PC IP

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup);

        fullnameEt = findViewById(R.id.fullnameEt);
        emailEt = findViewById(R.id.emailEt);
        passwordEt = findViewById(R.id.passwordEt);
        confirmPasswordEt = findViewById(R.id.confirmPasswordEt);
        signupBtn = findViewById(R.id.signupBtn);

        signupBtn.setOnClickListener(v -> {
            String name = fullnameEt.getText().toString().trim();
            String email = emailEt.getText().toString().trim();
            String password = passwordEt.getText().toString().trim();
            String confirmPassword = confirmPasswordEt.getText().toString().trim();

            if (name.length() < 3) { Toast.makeText(this, "Full name must be at least 3 characters", Toast.LENGTH_SHORT).show(); return; }
            if (!Patterns.EMAIL_ADDRESS.matcher(email).matches()) { Toast.makeText(this, "Enter a valid email", Toast.LENGTH_SHORT).show(); return; }
            if (password.length() < 6) { Toast.makeText(this, "Password must be at least 6 characters", Toast.LENGTH_SHORT).show(); return; }
            if (!password.equals(confirmPassword)) { Toast.makeText(this, "Passwords do not match", Toast.LENGTH_SHORT).show(); return; }

            registerUser(name, email, password);
        });
    }

    private void registerUser(String fullname, String email, String password) {
        StringRequest stringRequest = new StringRequest(Request.Method.POST, SIGNUP_URL,
                response -> {
                    try {
                        JSONObject json = new JSONObject(response);
                        if (json.getBoolean("success")) {
                            Toast.makeText(SignupActivity.this, "Signup successful", Toast.LENGTH_SHORT).show();
                        } else {
                            Toast.makeText(SignupActivity.this, "Signup failed: " + json.getString("message"), Toast.LENGTH_LONG).show();
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                        Toast.makeText(SignupActivity.this, "JSON error: " + e.getMessage(), Toast.LENGTH_LONG).show();
                    }
                },
                error -> Toast.makeText(SignupActivity.this, "Network error: " + error.getMessage(), Toast.LENGTH_LONG).show()
        ) {
            @Override
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<>();
                params.put("fullname", fullname);
                params.put("email", email);
                params.put("password", password);
                return params;
            }
        };

        Volley.newRequestQueue(this).add(stringRequest);
    }
}