<?php
/**
 * Project Model
 */

require_once APP_PATH . '/core/Model.php';

class Project extends Model {
    protected $table = 'projects';

    /**
     * Get All Projects Ordered
     */
    public function getAllOrdered() {
        $sql = "SELECT * FROM {$this->table} ORDER BY display_order ASC, created_at DESC";
        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Get Recent Projects
     */
    public function getRecent($limit = 6) {
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT :limit";
        return $this->db->query($sql)->bind(':limit', $limit, PDO::PARAM_INT)->fetchAll();
    }

    /**
     * Update Display Order
     */
    public function updateOrder($id, $order) {
        return $this->update($id, ['display_order' => $order]);
    }
}
