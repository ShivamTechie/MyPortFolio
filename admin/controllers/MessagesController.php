<?php
require_once APP_PATH . '/models/ContactMessage.php';

class MessagesController {
    private $model;
    public function __construct() {
        $this->model = new ContactMessage();
        $action = $_GET['action'] ?? 'list';
        switch ($action) {
            case 'view': $this->view(); break;
            case 'delete': $this->delete(); break;
            default: $this->index();
        }
    }
    public function index() {
        $items = $this->model->getAll('id', 'DESC');
        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/messages/list.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }
    public function view() {
        $id = $_GET['id'] ?? 0;
        $item = $this->model->getById($id);
        if (!$item) {
            Session::flash('error', 'Message not found.', 'error');
            header('Location: ' . ADMIN_URL . '?page=messages');
            exit;
        }
        if ($item['status'] == 'unread') {
            $this->model->markAsRead($id);
        }
        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/messages/view.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }
    public function delete() {
        $id = $_GET['id'] ?? 0;
        if ($this->model->delete($id)) {
            Session::flash('success', 'Message deleted successfully!', 'success');
        }
        header('Location: ' . ADMIN_URL . '?page=messages');
        exit;
    }
}
