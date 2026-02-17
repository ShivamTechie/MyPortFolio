<?php
/**
 * Testimonial Model
 */

require_once APP_PATH . '/core/Model.php';

class Testimonial extends Model {
    protected $table = 'testimonials';

    /**
     * Get All Testimonials Ordered
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
