<?php
require_once APP_PATH . '/models/BlogPost.php';

class BlogController {
    private $model;
    public function __construct() {
        $this->model = new BlogPost();
        $action = $_GET['action'] ?? 'list';
        switch ($action) {
            case 'add': $this->add(); break;
            case 'edit': $this->edit(); break;
            case 'delete': $this->delete(); break;
            default: $this->index();
        }
    }
    public function index() {
        $items = $this->model->getAll('created_at', 'DESC');
        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/blog/list.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $data = [
                'title' => $title,
                'slug' => $this->model->generateSlug($title),
                'content' => $_POST['content'] ?? '',
                'excerpt' => $_POST['excerpt'] ?? '',
                'status' => $_POST['status'] ?? 'draft',
                'meta_title' => $_POST['meta_title'] ?? '',
                'meta_description' => $_POST['meta_description'] ?? ''
            ];
            if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
                require_once APP_PATH . '/core/Upload.php';
                $upload = new Upload(UPLOAD_PATH . '/blog', ALLOWED_IMAGE_TYPES);
                $imageName = $upload->upload($_FILES['featured_image']);
                if ($imageName) $data['featured_image'] = $imageName;
            }
            if ($this->model->insert($data)) {
                Session::flash('success', 'Blog post added successfully!', 'success');
                header('Location: ' . ADMIN_URL . '?page=blog');
                exit;
            }
        }
        $csrfToken = Session::generateCsrfToken();
        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/blog/form.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }
    public function edit() {
        $id = $_GET['id'] ?? 0;
        $item = $this->model->getById($id);
        if (!$item) {
            Session::flash('error', 'Blog post not found.', 'error');
            header('Location: ' . ADMIN_URL . '?page=blog');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'] ?? '',
                'content' => $_POST['content'] ?? '',
                'excerpt' => $_POST['excerpt'] ?? '',
                'status' => $_POST['status'] ?? 'draft',
                'meta_title' => $_POST['meta_title'] ?? '',
                'meta_description' => $_POST['meta_description'] ?? ''
            ];
            if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
                require_once APP_PATH . '/core/Upload.php';
                $upload = new Upload(UPLOAD_PATH . '/blog', ALLOWED_IMAGE_TYPES);
                $imageName = $upload->upload($_FILES['featured_image']);
                if ($imageName) $data['featured_image'] = $imageName;
            }
            if ($this->model->update($id, $data)) {
                Session::flash('success', 'Blog post updated successfully!', 'success');
                header('Location: ' . ADMIN_URL . '?page=blog');
                exit;
            }
        }
        $csrfToken = Session::generateCsrfToken();
        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/blog/form.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }
    public function delete() {
        $id = $_GET['id'] ?? 0;
        if ($this->model->delete($id)) {
            Session::flash('success', 'Blog post deleted successfully!', 'success');
        }
        header('Location: ' . ADMIN_URL . '?page=blog');
        exit;
    }
}
