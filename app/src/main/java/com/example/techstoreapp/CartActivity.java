package com.example.techstoreapp;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import java.util.ArrayList;

public class CartActivity extends AppCompatActivity implements CartAdapter.TotalPriceUpdateListener {

    private ListView listView;
    private TextView totalPriceText;
    private Button checkoutButton;
    private CartAdapter adapter;
    private ArrayList<Product> cartItems;
    private CartManager cartManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cart);

        listView = findViewById(R.id.cartListView);
        totalPriceText = findViewById(R.id.totalPriceText);
        checkoutButton = findViewById(R.id.checkoutButton);

        cartManager = new CartManager(this);
        cartItems = cartManager.getCart();

        // Pass cartManager and listener to adapter
        adapter = new CartAdapter(this, cartItems, cartManager, this);
        listView.setAdapter(adapter);

        // Show initial total
        updateTotalPrice();

        // Checkout button click
        checkoutButton.setOnClickListener(v -> handleCheckout());
    }

    private void handleCheckout() {
        if (SessionManager.isLoggedIn(this)) {
            // ✅ User is logged in → go to Checkout
            startActivity(new Intent(CartActivity.this, CheckoutActivity.class));
        } else {
            // ⚠ Not logged in → redirect to Login, but remember to come back
            Toast.makeText(this, "Please log in to continue checkout.", Toast.LENGTH_SHORT).show();

            Intent intent = new Intent(CartActivity.this, LoginActivity.class);
            intent.putExtra("redirectToCheckout", true); // flag to return after login
            startActivity(intent);
        }
    }

    private void updateTotalPrice() {
        double total = cartManager.getTotalPrice();
        totalPriceText.setText("Total: $" + String.format("%.2f", total));
    }

    @Override
    public void onTotalPriceUpdated(double total) {
        totalPriceText.setText("Total: $" + String.format("%.2f", total));
    }
}