<?php
/**
 * Experience Controller with AJAX Support
 */

require_once ADMIN_PATH . '/controllers/BaseController.php';
require_once APP_PATH . '/models/Experience.php';

class ExperienceController extends BaseController {
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
            $this->validateCsrf();
            
            $data = $this->getInput(['company', 'position', 'start_date', 'end_date', 'description', 'display_order']);
            $data['is_current'] = isset($_POST['is_current']) ? 1 : 0;

            if (!$this->validateRequired(['company', 'position', 'start_date'], $data)) {
                $this->handleResponse(false, 'Please fill in all required fields.', ADMIN_URL . '?page=experience&action=add');
            }

            if ($this->model->insert($data)) {
                $this->handleResponse(true, 'Experience added successfully! ✓', ADMIN_URL . '?page=experience');
            } else {
                $this->handleResponse(false, 'Failed to add experience. Please try again.', ADMIN_URL . '?page=experience&action=add');
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
            $this->handleResponse(false, 'Experience not found.', ADMIN_URL . '?page=experience');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateCsrf();
            
            $data = $this->getInput(['company', 'position', 'start_date', 'end_date', 'description', 'display_order']);
            $data['is_current'] = isset($_POST['is_current']) ? 1 : 0;

            if (!$this->validateRequired(['company', 'position', 'start_date'], $data)) {
                $this->handleResponse(false, 'Please fill in all required fields.', ADMIN_URL . '?page=experience&action=edit&id=' . $id);
            }

            if ($this->model->update($id, $data)) {
                $this->handleResponse(true, 'Experience updated successfully! ✓', ADMIN_URL . '?page=experience');
            } else {
                $this->handleResponse(false, 'Failed to update experience. Please try again.', ADMIN_URL . '?page=experience&action=edit&id=' . $id);
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
            if ($this->isAjax()) {
                $this->jsonResponse(true, 'Experience deleted successfully! ✓');
            }
            Session::flash('success', 'Experience deleted successfully!', 'success');
        } else {
            if ($this->isAjax()) {
                $this->jsonResponse(false, 'Failed to delete experience. Please try again.');
            }
            Session::flash('error', 'Failed to delete experience.', 'error');
        }
        header('Location: ' . ADMIN_URL . '?page=experience');
        exit;
    }
}
