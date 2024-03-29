<?php
class Status {
  private int $status_id;
  private string $status_name;
  private string $status_description;

  public function __construct(int $status_id, string $status_name, string $status_description)
  {
    $this->status_id = $status_id;
    $this->status_name = $status_name;
    $this->status_description = $status_description;
  }
  public function get_status_id():string {
    return $this->status_id;
  }
  public function get_status_name():string {
    return $this->status_name;
  }
  public function get_status_description():string {
    return $this->status_description;
  }
}