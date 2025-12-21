<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Product {
    private $product_title;
    private $product_description;
    private $product_keyword;
    private $category_id;
    private $brand_id;
    private $product_image;
    private $product_price;
    private $created_at;

    private $connections;
    private $table = 'products';

    public function __construct($db) {
        $this->connections = $db;
    }

    // CREATE method
    public function create($params) {
        try {
            $this->product_title = $params['product_title'];
            $this->product_description = $params['product_description'];
            $this->product_keyword = $params['product_keyword'];
            $this->category_id = $params['category_id'];
            $this->brand_id = $params['brand_id'];
            $this->product_image = $params['product_image'];
            $this->product_price = $params['product_price'];

            $query = "INSERT INTO " . $this->table . " 
                     (product_title, product_description, product_keyword, category_id, brand_id, product_image, product_price, created_at) 
                     VALUES 
                     (:product_title, :product_description, :product_keyword, :category_id, :brand_id, :product_image, :product_price, NOW())";

            $stmt = $this->connections->prepare($query);
            $stmt->bindParam(':product_title', $this->product_title);
            $stmt->bindParam(':product_description', $this->product_description);
            $stmt->bindParam(':product_keyword', $this->product_keyword);
            $stmt->bindParam(':category_id', $this->category_id);
            $stmt->bindParam(':brand_id', $this->brand_id);
            $stmt->bindParam(':product_image', $this->product_image);
            $stmt->bindParam(':product_price', $this->product_price);

            if($stmt->execute()) {
                return true;
            }
            return false;

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function read() {
        try {
            // Query with JOIN to get category and brand names
            $query = "SELECT 
                        p.id,
                        p.product_title,
                        p.product_description,
                        p.product_keyword,
                        p.category_id,
                        c.category_title as category_name,
                        p.brand_id,
                        b.brand_title as brand_name,
                        p.product_image,
                        p.product_price,
                        p.created_at
                      FROM " . $this->table . " p
                      LEFT JOIN categories c ON p.category_id = c.id
                      LEFT JOIN brands b ON p.brand_id = b.id
                      ORDER BY p.created_at DESC";

            $stmt = $this->connections->prepare($query);
            $stmt->execute();

            return $stmt;

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}










?>