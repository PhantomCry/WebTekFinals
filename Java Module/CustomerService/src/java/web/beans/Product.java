package web.beans;

import java.math.BigDecimal;

public class Product {
    private String prodId;
    private String category;
    private String description;
    private BigDecimal price;

    public Product(String prodId, String category, String description, BigDecimal price) {
        this.prodId = prodId;
        this.category = category;
        this.description = description;
        this.price = price;
    }

    public String getProdId() {
        return prodId;
    }

    public void setProdId(String prodId) {
        this.prodId = prodId;
    }

    public String getCategory() {
        return category;
    }

    public void setCategory(String category) {
        this.category = category;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public BigDecimal getPrice() {
        return price;
    }

    public void setPrice(BigDecimal price) {
        this.price = price;
    }
}
