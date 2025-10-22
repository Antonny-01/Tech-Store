package com.example.techstoreapp;

import android.content.Intent;
import android.os.Bundle;
import android.widget.AdapterView;
import android.widget.GridView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONObject;
import java.util.ArrayList;

public class AccessoriesActivity extends AppCompatActivity {

    GridView gridView;
    ArrayList<Product> productList;
    ProductAdapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_accessories);

        gridView = findViewById(R.id.gridView);
        productList = new ArrayList<>();

        loadProducts();

        // Click on any product to open details
        gridView.setOnItemClickListener((AdapterView<?> parent, android.view.View view, int position, long id) -> {
            Product selected = productList.get(position);

            Intent intent = new Intent(AccessoriesActivity.this, ProductDetailsActivity.class);
            intent.putExtra("id", selected.getId());
            intent.putExtra("name", selected.getName());
            intent.putExtra("price", selected.getPrice());
            intent.putExtra("image", selected.getImage());
            intent.putExtra("description", selected.getDescription());
            startActivity(intent);
        });
    }

    private void loadProducts() {
        String url = "http://172.20.10.4/Tech%20Store/get_accessories.php";

        RequestQueue queue = Volley.newRequestQueue(this);

        JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, url, null,
                response -> {
                    try {
                        productList.clear();
                        for (int i = 0; i < response.length(); i++) {
                            JSONObject obj = response.getJSONObject(i);
                            productList.add(new Product(
                                    obj.getString("id"),
                                    obj.getString("name"),
                                    obj.getString("price"),
                                    obj.getString("image"),
                                    obj.getString("description")
                            ));
                        }
                        adapter = new ProductAdapter(this, productList);
                        gridView.setAdapter(adapter);
                    } catch (Exception e) {
                        Toast.makeText(this, "Parsing error: " + e.getMessage(), Toast.LENGTH_SHORT).show();
                    }
                },
                error -> Toast.makeText(this, "Connection error! Check your IP/network.", Toast.LENGTH_SHORT).show()
        );

        queue.add(request);
    }
}