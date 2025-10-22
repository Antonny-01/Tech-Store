package com.example.techstoreapp;

import android.content.Context;
import android.content.SharedPreferences;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import java.lang.reflect.Type;
import java.util.ArrayList;

public class CartManager {

    private static final String PREFS_NAME = "cart_prefs";
    private static final String CART_KEY = "cart_items";

    private final SharedPreferences prefs;
    private final Gson gson;

    public CartManager(Context context) {
        prefs = context.getSharedPreferences(PREFS_NAME, Context.MODE_PRIVATE);
        gson = new Gson();
    }

    // ✅ Add product to cart
    public void addItem(Product product) {
        ArrayList<Product> cart = getCart();
        cart.add(product);
        saveCart(cart);
    }

    // ✅ Remove product by ID
    public void removeItem(Product product) {
        ArrayList<Product> cart = getCart();
        for (int i = 0; i < cart.size(); i++) {
            if (cart.get(i).getId().equals(product.getId())) {
                cart.remove(i);
                break;
            }
        }
        saveCart(cart);
    }

    // ✅ Get all cart items
    public ArrayList<Product> getCart() {
        String json = prefs.getString(CART_KEY, null);
        if (json == null) return new ArrayList<>();
        Type type = new TypeToken<ArrayList<Product>>() {}.getType();
        ArrayList<Product> cart = gson.fromJson(json, type);
        return cart != null ? cart : new ArrayList<>();
    }

    // ✅ Save the entire cart
    private void saveCart(ArrayList<Product> cart) {
        String json = gson.toJson(cart);
        prefs.edit().putString(CART_KEY, json).apply();
    }

    // ✅ Clear all items from the cart
    public void clearCart() {
        prefs.edit().remove(CART_KEY).apply();
    }

    // ✅ Get total price of items
    public double getTotalPrice() {
        double total = 0;
        ArrayList<Product> cart = getCart();
        for (Product p : cart) {
            try {
                String priceStr = p.getPrice().replaceAll("[^0-9.]", "");
                total += Double.parseDouble(priceStr);
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
        return total;
    }
}