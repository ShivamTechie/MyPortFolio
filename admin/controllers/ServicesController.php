<?php
require_once APP_PATH . '/models/Service.php';

class ServicesController {
    private $model;
    public function __construct() {
        $this->model = new Service();
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
        require_once ADMIN_PATH . '/views/services/list.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'] ?? '',
                'description' => $_POST['description'] ?? '',
                'icon' => $_POST['icon'] ?? '',
                'display_order' => $_POST['display_order'] ?? 0
            ];
            if ($this->model->insert($data)) {
                Session::flash('success', 'Service added successfully!', 'success');
                header('Location: ' . ADMIN_URL . '?page=services');
                exit;
            }
        }
        $csrfToken = Session::generateCsrfToken();
        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/services/form.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }
    public function edit() {
        $id = $_GET['id'] ?? 0;
        $item = $this->model->getById($id);
        if (!$item) {
            Session::flash('error', 'Service not found.', 'error');
            header('Location: ' . ADMIN_URL . '?page=services');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'] ?? '',
                'description' => $_POST['description'] ?? '',
                'icon' => $_POST['icon'] ?? '',
                'display_order' => $_POST['display_order'] ?? 0
            ];
            if ($this->model->update($id, $data)) {
                Session::flash('success', 'Service updated successfully!', 'success');
                header('Location: ' . ADMIN_URL . '?page=services');
                exit;
            }
        }
        $csrfToken = Session::generateCsrfToken();
        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/services/form.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }
    public function delete() {
        $id = $_GET['id'] ?? 0;
        if ($this->model->delete($id)) {
            Session::flash('success', 'Service deleted successfully!', 'success');
        }
        header('Location: ' . ADMIN_URL . '?page=services');
        exit;
    }
}
