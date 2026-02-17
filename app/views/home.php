<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($profile['title'] ?? 'Portfolio'); ?> - <?php echo htmlspecialchars($profile['name'] ?? ''); ?>">
    <title><?php echo htmlspecialchars($profile['name'] ?? 'Portfolio'); ?> - <?php echo htmlspecialchars($profile['title'] ?? ''); ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <a href="#home" class="logo"><?php echo htmlspecialchars($profile['name'] ?? 'Portfolio'); ?></a>
            <div class="nav-toggle" id="navToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-menu" id="navMenu">
                <li><a href="#home" class="nav-link">Home</a></li>
                <li><a href="#about" class="nav-link">About</a></li>
                <li><a href="#experience" class="nav-link">Experience</a></li>
                <li><a href="#skills" class="nav-link">Skills</a></li>
                <li><a href="#projects" class="nav-link">Projects</a></li>
                <li><a href="#services" class="nav-link">Services</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Hi, I'm <span class="highlight"><?php echo htmlspecialchars($profile['name'] ?? ''); ?></span></h1>
                <h2 class="hero-subtitle"><?php echo htmlspecialchars($profile['title'] ?? ''); ?></h2>
                <p class="hero-description"><?php echo htmlspecialchars($profile['bio'] ?? ''); ?></p>
                <div class="hero-buttons">
                    <a href="#contact" class="btn btn-primary">Get In Touch</a>
                    <?php if (!empty($profile['resume_path'])): ?>
                    <a href="<?php echo BASE_URL; ?>/public/uploads/resume/<?php echo $profile['resume_path']; ?>" class="btn btn-outline" target="_blank">Download CV</a>
                    <?php endif; ?>
                </div>
                <div class="social-links">
                    <?php if (!empty($profile['linkedin'])): ?>
                    <a href="<?php echo $profile['linkedin']; ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($profile['github'])): ?>
                    <a href="<?php echo $profile['github']; ?>" target="_blank"><i class="fab fa-github"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($profile['twitter'])): ?>
                    <a href="<?php echo $profile['twitter']; ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container">
            <h2 class="section-title">About Me</h2>
            <div class="about-content">
                <div class="about-text">
                    <p><?php echo nl2br(htmlspecialchars($profile['bio'] ?? '')); ?></p>
                    <div class="contact-info">
                        <div class="info-item">
                            <i class="fas fa-envelope"></i>
                            <span><?php echo htmlspecialchars($profile['email'] ?? ''); ?></span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-phone"></i>
                            <span><?php echo htmlspecialchars($profile['phone'] ?? ''); ?></span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?php echo htmlspecialchars($profile['address'] ?? ''); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section id="experience" class="experience section">
        <div class="container">
            <h2 class="section-title">Work Experience</h2>
            <div class="timeline">
                <?php if (!empty($experience)): ?>
                    <?php foreach ($experience as $exp): ?>
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h3><?php echo htmlspecialchars($exp['position']); ?></h3>
                            <h4><?php echo htmlspecialchars($exp['company']); ?></h4>
                            <span class="timeline-date">
                                <?php echo date('M Y', strtotime($exp['start_date'])); ?> - 
                                <?php echo $exp['is_current'] ? 'Present' : date('M Y', strtotime($exp['end_date'])); ?>
                            </span>
                            <p><?php echo nl2br(htmlspecialchars($exp['description'])); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Education Section -->
    <section id="education" class="education section">
        <div class="container">
            <h2 class="section-title">Education</h2>
            <div class="education-grid">
                <?php if (!empty($education)): ?>
                    <?php foreach ($education as $edu): ?>
                    <div class="education-card">
                        <div class="education-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3><?php echo htmlspecialchars($edu['degree']); ?></h3>
                        <h4><?php echo htmlspecialchars($edu['institution']); ?></h4>
                        <p class="education-year"><?php echo $edu['year']; ?> • CGPA: <?php echo $edu['cgpa']; ?></p>
                        <?php if (!empty($edu['description'])): ?>
                        <p><?php echo htmlspecialchars($edu['description']); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="skills section">
        <div class="container">
            <h2 class="section-title">Skills & Technologies</h2>
            <div class="skills-container">
                <?php if (!empty($skills)): ?>
                    <?php foreach ($skills as $category => $categorySkills): ?>
                    <div class="skill-category">
                        <h3 class="category-title"><?php echo htmlspecialchars($category); ?></h3>
                        <div class="skills-grid">
                            <?php foreach ($categorySkills as $skill): ?>
                            <div class="skill-item">
                                <span class="skill-name"><?php echo htmlspecialchars($skill['name']); ?></span>
                                <span class="skill-level skill-<?php echo strtolower($skill['proficiency']); ?>"><?php echo $skill['proficiency']; ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="projects section">
        <div class="container">
            <h2 class="section-title">Featured Projects</h2>
            <div class="projects-grid">
                <?php if (!empty($projects)): ?>
                    <?php foreach ($projects as $project): ?>
                    <div class="project-card">
                        <?php if (!empty($project['image'])): ?>
                        <div class="project-image">
                            <img src="<?php echo BASE_URL; ?>/public/uploads/projects/<?php echo $project['image']; ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                        </div>
                        <?php endif; ?>
                        <div class="project-content">
                            <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                            <p><?php echo htmlspecialchars($project['description']); ?></p>
                            <?php if (!empty($project['technologies'])): ?>
                            <div class="project-tags">
                                <?php foreach (explode(',', $project['technologies']) as $tech): ?>
                                <span class="tag"><?php echo trim(htmlspecialchars($tech)); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                            <div class="project-links">
                                <?php if (!empty($project['project_link'])): ?>
                                <a href="<?php echo $project['project_link']; ?>" target="_blank" class="btn btn-small">View Project</a>
                                <?php endif; ?>
                                <?php if (!empty($project['github_link'])): ?>
                                <a href="<?php echo $project['github_link']; ?>" target="_blank" class="btn btn-small btn-outline"><i class="fab fa-github"></i> Code</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services section">
        <div class="container">
            <h2 class="section-title">Services I Offer</h2>
            <div class="services-grid">
                <?php if (!empty($services)): ?>
                    <?php foreach ($services as $service): ?>
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-<?php echo htmlspecialchars($service['icon']); ?>"></i>
                        </div>
                        <h3><?php echo htmlspecialchars($service['title']); ?></h3>
                        <p><?php echo htmlspecialchars($service['description']); ?></p>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <?php if (!empty($testimonials)): ?>
    <section id="testimonials" class="testimonials section">
        <div class="container">
            <h2 class="section-title">What Clients Say</h2>
            <div class="testimonials-grid">
                <?php foreach ($testimonials as $testimonial): ?>
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <p><?php echo htmlspecialchars($testimonial['content']); ?></p>
                    </div>
                    <div class="testimonial-footer">
                        <div class="testimonial-author">
                            <h4><?php echo htmlspecialchars($testimonial['client_name']); ?></h4>
                            <?php if (!empty($testimonial['company'])): ?>
                            <span><?php echo htmlspecialchars($testimonial['company']); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="testimonial-rating">
                            <?php for($i=0; $i<$testimonial['rating']; $i++): ?>
                            <i class="fas fa-star"></i>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Contact Section -->
    <section id="contact" class="contact section">
        <div class="container">
            <h2 class="section-title">Get In Touch</h2>
            <div class="contact-content">
                <div class="contact-form-wrapper">
                    <form id="contactForm" class="contact-form">
                        <div class="form-row">
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Your Name *" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Your Email *" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="subject" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <textarea name="message" placeholder="Your Message *" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                        <div id="formMessage" class="form-message"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($profile['name'] ?? ''); ?>. All rights reserved.</p>
            <div class="footer-links">
                <?php if (!empty($profile['linkedin'])): ?>
                <a href="<?php echo $profile['linkedin']; ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
                <?php endif; ?>
                <?php if (!empty($profile['github'])): ?>
                <a href="<?php echo $profile['github']; ?>" target="_blank"><i class="fab fa-github"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </footer>

    <script src="<?php echo BASE_URL; ?>/public/assets/js/script.js"></script>
</body>
</html>
