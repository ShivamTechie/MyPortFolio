<?php
/**
 * Skill Model
 */

require_once APP_PATH . '/core/Model.php';

class Skill extends Model {
    protected $table = 'skills';

    /**
     * Get All Skills Ordered
     */
    public function getAllOrdered() {
        $sql = "SELECT * FROM {$this->table} ORDER BY display_order ASC";
        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Get Skills by Category
     */
    public function getByCategory() {
        $sql = "SELECT * FROM {$this->table} ORDER BY category ASC, display_order ASC";
        $skills = $this->db->query($sql)->fetchAll();
        
        $grouped = [];
        foreach ($skills as $skill) {
            $grouped[$skill['category']][] = $skill;
        }
        return $grouped;
    }

    /**
     * Update Display Order
     */
    public function updateOrder($id, $order) {
        return $this->update($id, ['display_order' => $order]);
    }
}
