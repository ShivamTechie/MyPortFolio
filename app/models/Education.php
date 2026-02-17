<?php
/**
 * Education Model
 */

require_once APP_PATH . '/core/Model.php';

class Education extends Model {
    protected $table = 'education';

    /**
     * Get All Education Ordered
     */
    public function getAllOrdered() {
        $sql = "SELECT * FROM {$this->table} ORDER BY display_order ASC, year DESC";
        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Update Display Order
     */
    public function updateOrder($id, $order) {
        return $this->update($id, ['display_order' => $order]);
    }
}
