<?php
/**
 * Profile Model
 */

require_once APP_PATH . '/core/Model.php';

class Profile extends Model {
    protected $table = 'profile';

    /**
     * Get Profile Data
     */
    public function getProfile() {
        $sql = "SELECT * FROM {$this->table} LIMIT 1";
        return $this->db->query($sql)->fetch();
    }

    /**
     * Update Profile
     */
    public function updateProfile($data) {
        $profile = $this->getProfile();
        if ($profile) {
            return $this->update($profile['id'], $data);
        } else {
            return $this->insert($data);
        }
    }
}
