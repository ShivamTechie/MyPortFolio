<?php
/**
 * Experience Model
 */

require_once APP_PATH . '/core/Model.php';

class Experience extends Model {
    protected $table = 'experience';

    /**
     * Get All Experience Ordered
     */
    public function getAllOrdered() {
        $sql = "SELECT * FROM {$this->table} ORDER BY display_order ASC, start_date DESC";
        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Update Display Order
     */
    public function updateOrder($id, $order) {
        return $this->update($id, ['display_order' => $order]);
    }
}
