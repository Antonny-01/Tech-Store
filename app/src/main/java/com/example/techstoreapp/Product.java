package com.example.techstoreapp;

public class Product {
    private String id;
    private String name;
    private String price;
    private String image;
    private String description;

    public Product(String id, String name, String price, String image, String description) {
        this.id = id;
        this.name = name;
        this.price = price;
        this.image = image;
        this.description = description;
    }

    public String getId() { return id; }
    public String getName() { return name; }
    public String getPrice() { return price; }
    public String getImage() { return image; }
    public String getDescription() { return description; }

    public void setId(String id) { this.id = id; }
    public void setName(String name) { this.name = name; }
    public void setPrice(String price) { this.price = price; }
    public void setImage(String image) { this.image = image; }
    public void setDescription(String description) { this.description = description; }
}