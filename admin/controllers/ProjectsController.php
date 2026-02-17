<?php
require_once APP_PATH . '/models/Project.php';

class ProjectsController {
    private $model;
    public function __construct() {
        $this->model = new Project();
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
        require_once ADMIN_PATH . '/views/projects/list.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'] ?? '',
                'description' => $_POST['description'] ?? '',
                'technologies' => $_POST['technologies'] ?? '',
                'project_link' => $_POST['project_link'] ?? '',
                'github_link' => $_POST['github_link'] ?? '',
                'display_order' => $_POST['display_order'] ?? 0
            ];
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                require_once APP_PATH . '/core/Upload.php';
                $upload = new Upload(UPLOAD_PATH . '/projects', ALLOWED_IMAGE_TYPES);
                $imageName = $upload->upload($_FILES['image']);
                if ($imageName) $data['image'] = $imageName;
            }
            if ($this->model->insert($data)) {
                Session::flash('success', 'Project added successfully!', 'success');
                header('Location: ' . ADMIN_URL . '?page=projects');
                exit;
            }
        }
        $csrfToken = Session::generateCsrfToken();
        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/projects/form.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }
    public function edit() {
        $id = $_GET['id'] ?? 0;
        $item = $this->model->getById($id);
        if (!$item) {
            Session::flash('error', 'Project not found.', 'error');
            header('Location: ' . ADMIN_URL . '?page=projects');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'] ?? '',
                'description' => $_POST['description'] ?? '',
                'technologies' => $_POST['technologies'] ?? '',
                'project_link' => $_POST['project_link'] ?? '',
                'github_link' => $_POST['github_link'] ?? '',
                'display_order' => $_POST['display_order'] ?? 0
            ];
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                require_once APP_PATH . '/core/Upload.php';
                $upload = new Upload(UPLOAD_PATH . '/projects', ALLOWED_IMAGE_TYPES);
                $imageName = $upload->upload($_FILES['image']);
                if ($imageName) $data['image'] = $imageName;
            }
            if ($this->model->update($id, $data)) {
                Session::flash('success', 'Project updated successfully!', 'success');
                header('Location: ' . ADMIN_URL . '?page=projects');
                exit;
            }
        }
        $csrfToken = Session::generateCsrfToken();
        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/projects/form.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }
    public function delete() {
        $id = $_GET['id'] ?? 0;
        if ($this->model->delete($id)) {
            Session::flash('success', 'Project deleted successfully!', 'success');
        }
        header('Location: ' . ADMIN_URL . '?page=projects');
        exit;
    }
}
