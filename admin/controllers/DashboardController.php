<?php
/**
 * Dashboard Controller
 * Admin Dashboard
 */

require_once APP_PATH . '/models/Project.php';
require_once APP_PATH . '/models/ContactMessage.php';
require_once APP_PATH . '/models/BlogPost.php';

class DashboardController {
    private $projectModel;
    private $messageModel;
    private $blogModel;

    public function __construct() {
        $this->projectModel = new Project();
        $this->messageModel = new ContactMessage();
        $this->blogModel = new BlogPost();
        $this->index();
    }

    /**
     * Dashboard Index
     */
    public function index() {
        $data = [
            'totalProjects' => $this->projectModel->count(),
            'totalMessages' => $this->messageModel->count(),
            'unreadMessages' => $this->messageModel->countUnread(),
            'totalBlogPosts' => $this->blogModel->count(),
            'recentMessages' => $this->messageModel->getRecent(5),
            'username' => Session::get('username')
        ];

        require_once ADMIN_PATH . '/views/layout/header.php';
        require_once ADMIN_PATH . '/views/dashboard.php';
        require_once ADMIN_PATH . '/views/layout/footer.php';
    }
}
