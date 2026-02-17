<?php
/**
 * Home Controller
 * Front-end Portfolio Website
 */

require_once APP_PATH . '/models/Profile.php';
require_once APP_PATH . '/models/Experience.php';
require_once APP_PATH . '/models/Education.php';
require_once APP_PATH . '/models/Skill.php';
require_once APP_PATH . '/models/Project.php';
require_once APP_PATH . '/models/Service.php';
require_once APP_PATH . '/models/Testimonial.php';
require_once APP_PATH . '/models/BlogPost.php';

class HomeController extends Controller {
    
    public function index() {
        $profileModel = new Profile();
        $experienceModel = new Experience();
        $educationModel = new Education();
        $skillModel = new Skill();
        $projectModel = new Project();
        $serviceModel = new Service();
        $testimonialModel = new Testimonial();
        $blogModel = new BlogPost();

        $data = [
            'profile' => $profileModel->getProfile(),
            'experience' => $experienceModel->getAllOrdered(),
            'education' => $educationModel->getAllOrdered(),
            'skills' => $skillModel->getByCategory(),
            'projects' => $projectModel->getAllOrdered(),
            'services' => $serviceModel->getAllOrdered(),
            'testimonials' => $testimonialModel->getAllOrdered(),
            'blogs' => $blogModel->getPublished(3)
        ];

        $this->view('home', $data);
    }
}
