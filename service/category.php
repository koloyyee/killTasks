
<?php
// CRUD category 
include("../model/category.php");
include("../utils/checkers.php");

class CategoryService {
  private PDO $conn;

  public function __construct(PDO $conn)
  {
    $this->conn = $conn;
  }

  public function get_categories(): array {
    $categories = [];
    $sql = "SELECT * FROM category";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row) {
      $category = new Category($row['category_id'], $row['category_name'], $row['category_description']);
      array_push($categories, $category);
    }
    return $categories;
  }
  public function get_category_by_id(int $category_id): Category {
    $id = sanitize($category_id, Input::number); 
    
    $sql = "SELECT * FROM category WHERE category_id = :category_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':category_id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $category = new Category($result['category_id'], $result['category_name'], $result['category_description']);
    return $category;
  }

}
?>