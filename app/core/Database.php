<?php
/**
 * Database Class
 * PDO Database Connection and Query Handler
 */

class Database {
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $charset = DB_CHARSET;
    private $conn = null;
    private $stmt;
    private $error;

    /**
     * Get PDO Database Connection
     */
    public function getConnection() {
        if ($this->conn !== null) {
            return $this->conn;
        }

        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset={$this->charset}";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
            return $this->conn;
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            if (APP_DEBUG) {
                die("Database Connection Error: " . $this->error);
            } else {
                die("Database Connection Error. Please contact administrator.");
            }
        }
    }

    /**
     * Prepare SQL Query
     */
    public function query($sql) {
        $this->stmt = $this->getConnection()->prepare($sql);
        return $this;
    }

    /**
     * Bind Parameters
     */
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
        return $this;
    }

    /**
     * Execute Prepared Statement
     */
    public function execute() {
        try {
            return $this->stmt->execute();
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            if (APP_DEBUG) {
                die("Query Error: " . $this->error);
            }
            return false;
        }
    }

    /**
     * Get Multiple Records
     */
    public function fetchAll() {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    /**
     * Get Single Record
     */
    public function fetch() {
        $this->execute();
        return $this->stmt->fetch();
    }

    /**
     * Get Row Count
     */
    public function rowCount() {
        return $this->stmt->rowCount();
    }

    /**
     * Get Last Insert ID
     */
    public function lastInsertId() {
        return $this->getConnection()->lastInsertId();
    }

    /**
     * Begin Transaction
     */
    public function beginTransaction() {
        return $this->getConnection()->beginTransaction();
    }

    /**
     * Commit Transaction
     */
    public function commit() {
        return $this->getConnection()->commit();
    }

    /**
     * Rollback Transaction
     */
    public function rollBack() {
        return $this->getConnection()->rollBack();
    }
}
