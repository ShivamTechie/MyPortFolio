<?php
/**
 * User Model
 */

require_once APP_PATH . '/core/Model.php';

class User extends Model {
    protected $table = 'users';

    /**
     * Find User by Username
     */
    public function findByUsername($username) {
        $sql = "SELECT * FROM {$this->table} WHERE username = :username LIMIT 1";
        return $this->db->query($sql)->bind(':username', $username)->fetch();
    }

    /**
     * Find User by Email
     */
    public function findByEmail($email) {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email LIMIT 1";
        return $this->db->query($sql)->bind(':email', $email)->fetch();
    }

    /**
     * Verify Password
     */
    public function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }

    /**
     * Hash Password
     */
    public function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Update Password
     */
    public function updatePassword($id, $password) {
        $hashedPassword = $this->hashPassword($password);
        return $this->update($id, ['password' => $hashedPassword]);
    }
}
