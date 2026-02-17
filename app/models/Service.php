<?php
/**
 * Service Model
 */

require_once APP_PATH . '/core/Model.php';

class Service extends Model {
    protected $table = 'services';

    /**
     * Get All Services Ordered
     */
    public function getAllOrdered() {
        $sql = "SELECT * FROM {$this->table} ORDER BY display_order ASC";
        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Update Display Order
     */
    public function updateOrder($id, $order) {
        return $this->update($id, ['display_order' => $order]);
    }
}
