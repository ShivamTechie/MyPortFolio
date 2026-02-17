<?php
/**
 * Experience Controller
 */

require_once APP_PATH . '/models/Experience.php';

class ExperienceController {
    private $model;

    public function __construct() {
        $this->model = new Experience();
        
        $action = $_GET['action'] ?? 'list';
        
        switch ($action) {
            case 'add':
                $this->add();
                break;
            case 'edit':
                $this->edit();
                break;
            case 'delete':
                $this->delete();
                break;
            default:
                $this->index();
        }
    }

    public function index() {
        $items = $this->model->getAllOrdered();
        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/experience/list.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'company' => $_POST['company'] ?? '',
                'position' => $_POST['position'] ?? '',
                'start_date' => $_POST['start_date'] ?? '',
                'end_date' => $_POST['end_date'] ?? null,
                'is_current' => isset($_POST['is_current']) ? 1 : 0,
                'description' => $_POST['description'] ?? '',
                'display_order' => $_POST['display_order'] ?? 0
            ];

            if ($this->model->insert($data)) {
                Session::flash('success', 'Experience added successfully!', 'success');
                header('Location: ' . ADMIN_URL . '?page=experience');
                exit;
            }
        }

        $csrfToken = Session::generateCsrfToken();
        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/experience/form.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? 0;
        $item = $this->model->getById($id);

        if (!$item) {
            Session::flash('error', 'Experience not found.', 'error');
            header('Location: ' . ADMIN_URL . '?page=experience');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'company' => $_POST['company'] ?? '',
                'position' => $_POST['position'] ?? '',
                'start_date' => $_POST['start_date'] ?? '',
                'end_date' => $_POST['end_date'] ?? null,
                'is_current' => isset($_POST['is_current']) ? 1 : 0,
                'description' => $_POST['description'] ?? '',
                'display_order' => $_POST['display_order'] ?? 0
            ];

            if ($this->model->update($id, $data)) {
                Session::flash('success', 'Experience updated successfully!', 'success');
                header('Location: ' . ADMIN_URL . '?page=experience');
                exit;
            }
        }

        $csrfToken = Session::generateCsrfToken();
        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/experience/form.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }

    public function delete() {
        $id = $_GET['id'] ?? 0;
        if ($this->model->delete($id)) {
            Session::flash('success', 'Experience deleted successfully!', 'success');
        }
        header('Location: ' . ADMIN_URL . '?page=experience');
        exit;
    }
}
