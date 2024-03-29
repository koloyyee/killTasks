<?php

class Category{
  private int $category_id;
  private string $category_name;
  private string $category_description;

  function __construct(int $category_id, string $category_name, string $category_description)
  {
    $this->category_id = $category_id;
    $this->category_name = $category_name;
    $this->category_description = $category_description;
  }
  function get_category_id():int {
    return $this->category_id;
  }
  function get_category_name():string {
    return $this->category_name;
  }
  function get_category_description():string {
    return $this->category_description;
  }
}