<?php
/**
 * ContactMessage Model
 */

require_once APP_PATH . '/core/Model.php';

class ContactMessage extends Model {
    protected $table = 'contact_messages';

    /**
     * Get Unread Messages
     */
    public function getUnread() {
        $sql = "SELECT * FROM {$this->table} WHERE status = 'unread' ORDER BY created_at DESC";
        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Get Recent Messages
     */
    public function getRecent($limit = 10) {
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT :limit";
        return $this->db->query($sql)->bind(':limit', $limit, PDO::PARAM_INT)->fetchAll();
    }

    /**
     * Mark as Read
     */
    public function markAsRead($id) {
        return $this->update($id, ['status' => 'read']);
    }

    /**
     * Mark as Replied
     */
    public function markAsReplied($id) {
        return $this->update($id, ['status' => 'replied']);
    }

    /**
     * Count Unread Messages
     */
    public function countUnread() {
        $sql = "SELECT COUNT(*) as total FROM {$this->table} WHERE status = 'unread'";
        $result = $this->db->query($sql)->fetch();
        return $result['total'];
    }
}
