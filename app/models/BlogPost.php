<?php
/**
 * BlogPost Model
 */

require_once APP_PATH . '/core/Model.php';

class BlogPost extends Model {
    protected $table = 'blog_posts';

    /**
     * Get Published Posts
     */
    public function getPublished($limit = null) {
        $sql = "SELECT * FROM {$this->table} WHERE status = 'published' ORDER BY created_at DESC";
        if ($limit) {
            $sql .= " LIMIT :limit";
            return $this->db->query($sql)->bind(':limit', $limit, PDO::PARAM_INT)->fetchAll();
        }
        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Get Post by Slug
     */
    public function getBySlug($slug) {
        $sql = "SELECT * FROM {$this->table} WHERE slug = :slug LIMIT 1";
        return $this->db->query($sql)->bind(':slug', $slug)->fetch();
    }

    /**
     * Generate Unique Slug
     */
    public function generateSlug($title) {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        
        // Check if slug exists
        $originalSlug = $slug;
        $counter = 1;
        while ($this->getBySlug($slug)) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }

    /**
     * Count Published Posts
     */
    public function countPublished() {
        $sql = "SELECT COUNT(*) as total FROM {$this->table} WHERE status = 'published'";
        $result = $this->db->query($sql)->fetch();
        return $result['total'];
    }
}
