<?php
require_once APP_PATH . '/models/Skill.php';

class SkillsController {
    private $model;
    public function __construct() {
        $this->model = new Skill();
        $action = $_GET['action'] ?? 'list';
        switch ($action) {
            case 'add': $this->add(); break;
            case 'edit': $this->edit(); break;
            case 'delete': $this->delete(); break;
            default: $this->index();
        }
    }
    public function index() {
        $items = $this->model->getAllOrdered();
        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/skills/list.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'category' => $_POST['category'] ?? '',
                'proficiency' => $_POST['proficiency'] ?? 'Intermediate',
                'display_order' => $_POST['display_order'] ?? 0
            ];
            if ($this->model->insert($data)) {
                Session::flash('success', 'Skill added successfully!', 'success');
                header('Location: ' . ADMIN_URL . '?page=skills');
                exit;
            }
        }
        $csrfToken = Session::generateCsrfToken();
        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/skills/form.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }
    public function edit() {
        $id = $_GET['id'] ?? 0;
        $item = $this->model->getById($id);
        if (!$item) {
            Session::flash('error', 'Skill not found.', 'error');
            header('Location: ' . ADMIN_URL . '?page=skills');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'category' => $_POST['category'] ?? '',
                'proficiency' => $_POST['proficiency'] ?? 'Intermediate',
                'display_order' => $_POST['display_order'] ?? 0
            ];
            if ($this->model->update($id, $data)) {
                Session::flash('success', 'Skill updated successfully!', 'success');
                header('Location: ' . ADMIN_URL . '?page=skills');
                exit;
            }
        }
        $csrfToken = Session::generateCsrfToken();
        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/skills/form.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }
    public function delete() {
        $id = $_GET['id'] ?? 0;
        if ($this->model->delete($id)) {
            Session::flash('success', 'Skill deleted successfully!', 'success');
        }
        header('Location: ' . ADMIN_URL . '?page=skills');
        exit;
    }
}
