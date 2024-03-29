<?php 
// R status
include("../model/status.php");

class StatusService {
  private PDO $conn;
  public function __construct(PDO $conn)
  {
    $this->conn = $conn;
  }
  public function get_statuses(): array {
    $statuses= [];
    $sql = "SELECT * FROM status";  
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row) {
      var_dump($row);
      $status = new Status($row['status_id'], $row['status_name'], $row['status_description']);
      array_push($statuses, $status);
    }
    return $statuses;
  }
  public function get_status_by_id(int $status_id): Status {
    $id = sanitize($status_id, Input::number); 
    $sql = "SELECT * FROM status WHERE status_id = :status_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':status_id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $status = new Status($result['status_id'], $result['status_name'], $result['status_description']);
    return $status;
  }
}
?>