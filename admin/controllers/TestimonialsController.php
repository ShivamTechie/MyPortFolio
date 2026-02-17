<?php
require_once APP_PATH . '/models/Testimonial.php';

class TestimonialsController {
    private $model;
    public function __construct() {
        $this->model = new Testimonial();
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
        require_once ADMIN_PATH . '/views/testimonials/list.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'client_name' => $_POST['client_name'] ?? '',
                'company' => $_POST['company'] ?? '',
                'content' => $_POST['content'] ?? '',
                'rating' => $_POST['rating'] ?? 5,
                'display_order' => $_POST['display_order'] ?? 0
            ];
            if ($this->model->insert($data)) {
                Session::flash('success', 'Testimonial added successfully!', 'success');
                header('Location: ' . ADMIN_URL . '?page=testimonials');
                exit;
            }
        }
        $csrfToken = Session::generateCsrfToken();
        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/testimonials/form.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }
    public function edit() {
        $id = $_GET['id'] ?? 0;
        $item = $this->model->getById($id);
        if (!$item) {
            Session::flash('error', 'Testimonial not found.', 'error');
            header('Location: ' . ADMIN_URL . '?page=testimonials');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'client_name' => $_POST['client_name'] ?? '',
                'company' => $_POST['company'] ?? '',
                'content' => $_POST['content'] ?? '',
                'rating' => $_POST['rating'] ?? 5,
                'display_order' => $_POST['display_order'] ?? 0
            ];
            if ($this->model->update($id, $data)) {
                Session::flash('success', 'Testimonial updated successfully!', 'success');
                header('Location: ' . ADMIN_URL . '?page=testimonials');
                exit;
            }
        }
        $csrfToken = Session::generateCsrfToken();
        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/testimonials/form.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }
    public function delete() {
        $id = $_GET['id'] ?? 0;
        if ($this->model->delete($id)) {
            Session::flash('success', 'Testimonial deleted successfully!', 'success');
        }
        header('Location: ' . ADMIN_URL . '?page=testimonials');
        exit;
    }
}
