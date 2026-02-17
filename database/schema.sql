-- Portfolio Website Database Schema
-- Created for Shivam Kumar's Portfolio

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Database: portfolio_db

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Default admin user (username: admin, password: admin123)
-- Password should be changed immediately after first login
--

INSERT INTO `users` (`username`, `email`, `password`) VALUES
('admin', 'shivamkk2001@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `bio` text,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `github` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `resume_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Default profile data
--

INSERT INTO `profile` (`name`, `title`, `bio`, `phone`, `email`, `address`) VALUES
('Shivam Kumar', 'Software Developer & WordPress Specialist', 'Passionate software developer with expertise in PHP, WordPress, and API integrations. Experienced in building custom themes, plugins, and modern web applications.', '+91 7037535354', 'shivamkk2001@gmail.com', 'Haridwar, Uttarakhand, India');

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE IF NOT EXISTS `experience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `is_current` tinyint(1) DEFAULT 0,
  `description` text,
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Default experience data
--

INSERT INTO `experience` (`company`, `position`, `start_date`, `end_date`, `is_current`, `description`, `display_order`) VALUES
('Ebizon Netinfo Pvt Ltd', 'Programmer Analyst', '2024-06-03', NULL, 1, 'Working on WordPress development, custom plugin and theme development, API integrations including OpenAI, and building modern web applications. Gained expertise in MCP servers and AI tool integration.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE IF NOT EXISTS `education` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `degree` varchar(255) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `cgpa` varchar(10) DEFAULT NULL,
  `year` int(11) NOT NULL,
  `description` text,
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Default education data
--

INSERT INTO `education` (`degree`, `institution`, `cgpa`, `year`, `description`, `display_order`) VALUES
('Master of Computer Applications (MCA)', 'Quantum University, Roorkee', '8.7', 2024, 'Specialized in advanced software development, database management, and modern web technologies.', 1),
('Bachelor''s Degree', 'Gurukul Kangri Vishwavidyalaya, Haridwar', '7.1', 2022, 'Foundation in computer science and programming fundamentals.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `proficiency` enum('Beginner','Intermediate','Expert') DEFAULT 'Intermediate',
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Default skills data
--

INSERT INTO `skills` (`name`, `category`, `proficiency`, `display_order`) VALUES
('HTML5', 'Frontend', 'Expert', 1),
('CSS3', 'Frontend', 'Expert', 2),
('JavaScript', 'Frontend', 'Expert', 3),
('PHP', 'Backend', 'Expert', 4),
('MVC Architecture', 'Backend', 'Expert', 5),
('Java OOP', 'Backend', 'Intermediate', 6),
('MySQL', 'Database', 'Expert', 7),
('REST API', 'Backend', 'Expert', 8),
('API Integration', 'Backend', 'Expert', 9),
('WordPress', 'CMS', 'Expert', 10),
('Custom Theme Development', 'CMS', 'Expert', 11),
('Custom Plugin Development', 'CMS', 'Expert', 12),
('Elementor', 'CMS', 'Expert', 13),
('OpenAI Integration', 'AI/ML', 'Intermediate', 14),
('MCP Server', 'AI/ML', 'Intermediate', 15);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `technologies` varchar(500) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `project_link` varchar(255) DEFAULT NULL,
  `github_link` varchar(255) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `icon` varchar(100) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Default services data
--

INSERT INTO `services` (`title`, `description`, `icon`, `display_order`) VALUES
('Website Development', 'Custom website development using modern technologies including PHP, WordPress, and responsive design. Building scalable and performant web applications.', 'code', 1),
('WordPress Development', 'Expert WordPress development including custom themes, plugins, and complete website solutions. Specialized in Elementor and advanced customizations.', 'wordpress', 2),
('API Integration', 'Seamless API integration services including REST APIs, OpenAI, and third-party service integrations. Expertise in building and consuming APIs.', 'api', 3),
('Content Writing', 'Professional content writing services for websites, blogs, and digital marketing materials.', 'edit', 4),
('Website Management', 'Comprehensive website management services including updates, maintenance, security, and performance optimization.', 'settings', 5),
('Digital Marketing', 'Digital marketing services to boost your online presence and reach your target audience effectively.', 'trending-up', 6);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `rating` int(11) DEFAULT 5,
  `image` varchar(255) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `excerpt` text,
  `featured_image` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') DEFAULT 'draft',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('unread','read','replied') DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Default settings
--

INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES
('site_name', 'Shivam Kumar - Portfolio'),
('site_description', 'Software Developer & WordPress Specialist'),
('smtp_host', 'smtp.gmail.com'),
('smtp_port', '587'),
('smtp_username', ''),
('smtp_password', ''),
('smtp_from_email', 'shivamkk2001@gmail.com'),
('smtp_from_name', 'Shivam Kumar');
