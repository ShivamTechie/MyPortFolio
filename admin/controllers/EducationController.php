<?php
require_once APP_PATH . '/models/Education.php';

class EducationController {
    private $model;
    public function __construct() {
        $this->model = new Education();
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
        require_once ADMIN_PATH . '/views/education/list.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'degree' => $_POST['degree'] ?? '',
                'institution' => $_POST['institution'] ?? '',
                'cgpa' => $_POST['cgpa'] ?? '',
                'year' => $_POST['year'] ?? '',
                'description' => $_POST['description'] ?? '',
                'display_order' => $_POST['display_order'] ?? 0
            ];
            if ($this->model->insert($data)) {
                Session::flash('success', 'Education added successfully!', 'success');
                header('Location: ' . ADMIN_URL . '?page=education');
                exit;
            }
        }
        $csrfToken = Session::generateCsrfToken();
        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/education/form.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }
    public function edit() {
        $id = $_GET['id'] ?? 0;
        $item = $this->model->getById($id);
        if (!$item) {
            Session::flash('error', 'Education not found.', 'error');
            header('Location: ' . ADMIN_URL . '?page=education');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'degree' => $_POST['degree'] ?? '',
                'institution' => $_POST['institution'] ?? '',
                'cgpa' => $_POST['cgpa'] ?? '',
                'year' => $_POST['year'] ?? '',
                'description' => $_POST['description'] ?? '',
                'display_order' => $_POST['display_order'] ?? 0
            ];
            if ($this->model->update($id, $data)) {
                Session::flash('success', 'Education updated successfully!', 'success');
                header('Location: ' . ADMIN_URL . '?page=education');
                exit;
            }
        }
        $csrfToken = Session::generateCsrfToken();
        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/education/form.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }
    public function delete() {
        $id = $_GET['id'] ?? 0;
        if ($this->model->delete($id)) {
            Session::flash('success', 'Education deleted successfully!', 'success');
        }
        header('Location: ' . ADMIN_URL . '?page=education');
        exit;
    }
}
