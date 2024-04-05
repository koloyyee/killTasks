<?php
  declare(strict_types=1);

  /***
   * PdoDao an Database Access Object 
   * bridge between database and the application
   * 
   * The benefit of using PDO is the flexibility to change the database
   * by altering the DNS.
   * 
   * The DB_USER and DB_PASS are custom names and passwords
   * which need to be setup in phpMyAdmin > Users Account > New User.
   * 
   * 3307 is the port number current XAMPP and 
   * 3306 is the default port number
   */
  class PdoDao {
    private PDO $pdo;
    private static string $DB_HOST = "localhost";
    private static string $DB_USER = "admin"; // custom name and password
    private static string $DB_PASS = "admin";
    private static string $DB_NAME = "killtasks";
    private static string $DB_PORT = "3306"; // or 3306 the default port

    /**
     * DNS: data source name 
     * mysql: mysql:host=localhost;dbname=db_name;port=3307
     * postgres: pgsql:host=localhost;dbname=db_name;port=5432
     * sqlite: sqlite:db_name
     * oracle: oci:dbname=//localhost:1521/db_name
     * sql server: sqlsrv:Server=localhost;Database=db_name
     */
    function __construct() {
      $dsn = "mysql:host=" . self::$DB_HOST . ";dbname=" . self::$DB_NAME . ";port=" . self::$DB_PORT;
      try {
        $this->pdo = new PDO($dsn, self::$DB_USER, self::$DB_PASS);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
    }
    function get_pdo(): PDO {
      return $this->pdo;
    }

  }