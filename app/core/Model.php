<?php
/**
 * Base Model Class
 * All models extend this class
 */

class Model {
    protected $db;
    protected $table;

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Get All Records
     */
    public function getAll($orderBy = 'id', $order = 'ASC') {
        $sql = "SELECT * FROM {$this->table} ORDER BY {$orderBy} {$order}";
        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Get Record by ID
     */
    public function getById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        return $this->db->query($sql)->bind(':id', $id)->fetch();
    }

    /**
     * Insert Record
     */
    public function insert($data) {
        $fields = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO {$this->table} ({$fields}) VALUES ({$placeholders})";
        $query = $this->db->query($sql);
        
        foreach ($data as $key => $value) {
            $query->bind(":{$key}", $value);
        }
        
        if ($query->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    /**
     * Update Record
     */
    public function update($id, $data) {
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "{$key} = :{$key}, ";
        }
        $fields = rtrim($fields, ', ');
        
        $sql = "UPDATE {$this->table} SET {$fields} WHERE id = :id";
        $query = $this->db->query($sql);
        
        foreach ($data as $key => $value) {
            $query->bind(":{$key}", $value);
        }
        $query->bind(':id', $id);
        
        return $query->execute();
    }

    /**
     * Delete Record
     */
    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        return $this->db->query($sql)->bind(':id', $id)->execute();
    }

    /**
     * Count Records
     */
    public function count() {
        $sql = "SELECT COUNT(*) as total FROM {$this->table}";
        $result = $this->db->query($sql)->fetch();
        return $result['total'];
    }

    /**
     * Custom Query
     */
    public function query($sql) {
        return $this->db->query($sql);
    }
}
