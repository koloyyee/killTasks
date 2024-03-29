<?php
// define('DB_HOST', 'localhost');
// define('DB_USER', 'admin'); // custom name and password
// define('DB_PASS', 'admin');
// define('DB_NAME', 'killtasks');
// define('DB_PORT', "3307");

//   $dns = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT;
//   try {
//     $conn= new PDO($dns, DB_USER, DB_PASS);
//     // set the PDO error mode to exception
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     return $conn;
//   } catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
//   }

  class PdoDao {
    private PDO $pdo;
    private static string $DB_HOST = "localhost";
    private static string $DB_USER = "admin"; // customer name and password
    private static string $DB_PASS = "admin";
    private static string $DB_NAME = "killtasks";
    private static string $DB_PORT = "3307"; // or 3306 the default port

    function __construct() {
      $dns = "mysql:host=" . self::$DB_HOST . ";dbname=" . self::$DB_NAME . ";port=" . self::$DB_PORT;
      try {
        $this->pdo = new PDO($dns, self::$DB_USER, self::$DB_PASS);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
    }
    function get_pdo(): PDO {
      return $this->pdo;
    }

  }