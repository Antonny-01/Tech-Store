package com.example.techstoreapp;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;

import java.util.ArrayList;

public class CartAdapter extends BaseAdapter {

    private Context context;
    private ArrayList<Product> cartItems;
    private CartManager cartManager;
    private TotalPriceUpdateListener listener;

    // Interface to notify CartActivity to update total price
    public interface TotalPriceUpdateListener {
        void onTotalPriceUpdated(double total);
    }

    public CartAdapter(Context context, ArrayList<Product> cartItems, CartManager cartManager, TotalPriceUpdateListener listener) {
        this.context = context;
        this.cartItems = cartItems;
        this.cartManager = cartManager;
        this.listener = listener;
    }

    @Override
    public int getCount() {
        return cartItems.size();
    }

    @Override
    public Object getItem(int position) {
        return cartItems.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {

        if (convertView == null) {
            convertView = LayoutInflater.from(context).inflate(R.layout.cart_item, parent, false);
        }

        ImageView image = convertView.findViewById(R.id.cartItemImage);
        TextView name = convertView.findViewById(R.id.cartItemName);
        TextView price = convertView.findViewById(R.id.cartItemPrice);
        Button removeButton = convertView.findViewById(R.id.removeButton);

        Product product = cartItems.get(position);

        name.setText(product.getName());
        price.setText("$" + product.getPrice());

        // Hybrid image loading: URL or drawable
        if (product.getImage() != null && !product.getImage().isEmpty()) {
            if (product.getImage().startsWith("http")) {
                // Load from URL
                Glide.with(context)
                        .load(product.getImage())
                        .placeholder(R.drawable.placeholder)
                        .error(R.drawable.placeholder)
                        .into(image);
            } else {
                // Load from drawable
                int imageResId = context.getResources().getIdentifier(product.getImage(), "drawable", context.getPackageName());
                if (imageResId != 0) {
                    Glide.with(context).load(imageResId).into(image);
                } else {
                    image.setImageResource(R.drawable.placeholder);
                }
            }
        } else {
            image.setImageResource(R.drawable.placeholder);
        }

        // Remove item
        removeButton.setOnClickListener(v -> {
            cartItems.remove(position);

            // Clear old cart and save updated cart
            cartManager.clearCart();
            for (Product p : cartItems) {
                cartManager.addItem(p);
            }

            notifyDataSetChanged();

            // Update total in CartActivity
            if (listener != null) {
                listener.onTotalPriceUpdated(cartManager.getTotalPrice());
            }
        });

        return convertView;
    }
}