<?php
/**
 * Setting Model
 */

require_once APP_PATH . '/core/Model.php';

class Setting extends Model {
    protected $table = 'settings';

    /**
     * Get Setting by Key
     */
    public function get($key, $default = null) {
        $sql = "SELECT setting_value FROM {$this->table} WHERE setting_key = :key LIMIT 1";
        $result = $this->db->query($sql)->bind(':key', $key)->fetch();
        return $result ? $result['setting_value'] : $default;
    }

    /**
     * Set Setting Value
     */
    public function set($key, $value) {
        $existing = $this->get($key);
        
        if ($existing !== null) {
            $sql = "UPDATE {$this->table} SET setting_value = :value WHERE setting_key = :key";
            return $this->db->query($sql)
                ->bind(':key', $key)
                ->bind(':value', $value)
                ->execute();
        } else {
            return $this->insert([
                'setting_key' => $key,
                'setting_value' => $value
            ]);
        }
    }

    /**
     * Get All Settings
     */
    public function getAll() {
        $settings = parent::getAll();
        $result = [];
        foreach ($settings as $setting) {
            $result[$setting['setting_key']] = $setting['setting_value'];
        }
        return $result;
    }
}
