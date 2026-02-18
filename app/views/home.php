<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($profile['name'] ?? 'Portfolio'); ?> - <?php echo htmlspecialchars($profile['title'] ?? 'Professional Portfolio'); ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="<?php echo htmlspecialchars($profile['bio'] ?? ''); ?>" name="description">
    <meta content="<?php echo htmlspecialchars($profile['title'] ?? ''); ?>" name="keywords">

    <!-- Favicon -->
    <link href="<?php echo BASE_URL; ?>/public/assets/images/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo BASE_URL; ?>/public/assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>/public/assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>/public/assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo BASE_URL; ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?php echo BASE_URL; ?>/public/assets/css/style.css" rel="stylesheet">
    
    <style>
        /* Custom Navigation Styles */
        .navbar {
            padding: 15px 0;
            transition: all 0.3s ease;
        }
        
        .navbar-brand h3 {
            font-size: 1.8rem;
            margin: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .navbar .nav-link {
            font-weight: 500;
            color: #495057 !important;
            padding: 8px 16px !important;
            margin: 0 2px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .navbar .nav-link:hover,
        .navbar .nav-link.active {
            color: #667eea !important;
            background: rgba(102, 126, 234, 0.1);
        }
        
        .navbar .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .navbar .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .navbar-toggler {
            border: none;
            padding: 5px 10px;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }
        
        /* Adjust header spacing */
        .container-fluid.bg-light.my-6 {
            margin-top: 80px !important;
        }
        
        @media (max-width: 991px) {
            .navbar .btn-primary {
                margin-top: 10px;
                width: 100%;
            }
            
            .navbar .nav-link {
                padding: 10px 15px !important;
            }
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="51">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light fixed-top shadow-sm">
        <div class="container">
            <a href="#home" class="navbar-brand">
                <h3 class="text-primary fw-bold m-0"><?php echo htmlspecialchars($profile['name'] ?? 'Portfolio'); ?></h3>
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a href="#home" class="nav-item nav-link active">Home</a>
                    <a href="#about" class="nav-item nav-link">About</a>
                    <a href="#skill" class="nav-item nav-link">Skills</a>
                    <a href="#service" class="nav-item nav-link">Services</a>
                    <a href="#project" class="nav-item nav-link">Projects</a>
                    <?php if (!empty($testimonials)): ?>
                    <a href="#testimonial" class="nav-item nav-link">Testimonial</a>
                    <?php endif; ?>
                    <a href="#contact" class="nav-item nav-link">Contact</a>
                    <?php if (!empty($profile['resume_path'])): ?>
                    <a href="<?php echo BASE_URL; ?>/public/uploads/resume/<?php echo $profile['resume_path']; ?>" 
                       class="btn btn-primary ms-3 px-4 py-2" download>
                        <i class="fas fa-download me-2"></i>Download CV
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Header Start -->
    <div class="container-fluid bg-light my-6 mt-0" id="home">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 py-6 pb-0 pt-lg-0">
                    <h3 class="text-primary mb-3">I'm</h3>
                    <h1 class="display-3 mb-3"><?php echo htmlspecialchars($profile['name'] ?? ''); ?></h1>
                    <h2 class="typed-text-output d-inline"></h2>
                    <div class="typed-text d-none"><?php echo htmlspecialchars($profile['title'] ?? 'Web Designer, Web Developer, Full Stack Developer'); ?></div>
                    <div class="d-flex align-items-center pt-5">
                        <?php if (!empty($profile['resume_path'])): ?>
                        <a href="<?php echo BASE_URL; ?>/public/uploads/resume/<?php echo $profile['resume_path']; ?>" class="btn btn-primary py-3 px-4 me-5" download>Download CV</a>
                        <?php endif; ?>
                        <a href="#contact" class="btn btn-outline-primary py-3 px-4">Hire Me</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <?php if (!empty($profile['profile_image'])): ?>
                    <img class="img-fluid" src="<?php echo BASE_URL; ?>/public/uploads/profile/<?php echo $profile['profile_image']; ?>" alt="<?php echo htmlspecialchars($profile['name']); ?>">
                    <?php else: ?>
                    <img class="img-fluid" src="<?php echo BASE_URL; ?>/public/assets/images/profile.png" alt="">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- About Start -->
    <div class="container-xxl py-6" id="about">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <?php 
                    $yearsExperience = 0;
                    if (!empty($experience)) {
                        foreach ($experience as $exp) {
                            $start = new DateTime($exp['start_date']);
                            $end = $exp['end_date'] ? new DateTime($exp['end_date']) : new DateTime();
                            $diff = $start->diff($end);
                            $yearsExperience += $diff->y + ($diff->m / 12);
                        }
                        $yearsExperience = round($yearsExperience);
                    }
                    ?>
                    <div class="d-flex align-items-center mb-5">
                        <div class="years flex-shrink-0 text-center me-4">
                            <h1 class="display-1 mb-0"><?php echo $yearsExperience > 0 ? $yearsExperience : '2+'; ?></h1>
                            <h5 class="mb-0">Years</h5>
                        </div>
                        <h3 class="lh-base mb-0">of working experience as a <?php echo htmlspecialchars($profile['title'] ?? 'web designer & developer'); ?></h3>
                    </div>
                    <p class="mb-4"><?php echo nl2br(htmlspecialchars($profile['bio'] ?? '')); ?></p>
                    <div class="row mb-4">
                        <div class="col-sm-6 py-2">
                            <h6 class="mb-0">Name:</h6>
                            <span><?php echo htmlspecialchars($profile['name'] ?? ''); ?></span>
                        </div>
                        <div class="col-sm-6 py-2">
                            <h6 class="mb-0">Email:</h6>
                            <span><?php echo htmlspecialchars($profile['email'] ?? ''); ?></span>
                        </div>
                        <div class="col-sm-6 py-2">
                            <h6 class="mb-0">Phone:</h6>
                            <span><?php echo htmlspecialchars($profile['phone'] ?? ''); ?></span>
                        </div>
                        <div class="col-sm-6 py-2">
                            <h6 class="mb-0">Location:</h6>
                            <span><?php echo htmlspecialchars($profile['address'] ?? ''); ?></span>
                        </div>
                    </div>
                    <?php if (!empty($profile['resume_path'])): ?>
                    <a class="btn btn-primary py-3 px-5 mt-3" href="<?php echo BASE_URL; ?>/public/uploads/resume/<?php echo $profile['resume_path']; ?>" download>Download CV</a>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <?php if (!empty($profile['profile_image'])): ?>
                    <div class="row g-3 mb-4">
                        <div class="col-sm-12">
                            <img class="img-fluid rounded" src="<?php echo BASE_URL; ?>/public/uploads/profile/<?php echo $profile['profile_image']; ?>" alt="<?php echo htmlspecialchars($profile['name']); ?>">
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="d-flex align-items-center mb-3">
                        <h5 class="border-end pe-3 me-3 mb-0">Happy Clients</h5>
                        <h2 class="text-primary fw-bold mb-0" data-toggle="counter-up"><?php echo !empty($testimonials) ? count($testimonials) * 10 : 50; ?></h2>
                    </div>
                    <p class="mb-4">Delivering quality solutions that exceed expectations.</p>
                    <div class="d-flex align-items-center mb-3">
                        <h5 class="border-end pe-3 me-3 mb-0">Projects Completed</h5>
                        <h2 class="text-primary fw-bold mb-0" data-toggle="counter-up"><?php echo !empty($projects) ? count($projects) : 10; ?></h2>
                    </div>
                    <p class="mb-0">Successfully delivered projects using modern technologies and best practices.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Expertise Start -->
    <div class="container-xxl py-6 pb-5" id="skill">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="display-5 mb-5">Skills & Experience</h1>
                    <p class="mb-4"><?php echo htmlspecialchars(substr($profile['bio'] ?? '', 0, 200)); ?>...</p>
                    <h3 class="mb-4">My Skills</h3>
                    <div class="row align-items-center">
                        <?php 
                        $colors = ['primary', 'warning', 'danger', 'success', 'info', 'dark'];
                        $colorIndex = 0;
                        $skillCount = 0;
                        if (!empty($skills)): 
                            foreach ($skills as $category => $categorySkills):
                                foreach ($categorySkills as $skill):
                                    if ($skillCount < 8): // Limit to 8 skills for display
                                        $proficiency = isset($skill['proficiency']) ? intval($skill['proficiency']) : 90;
                                        $color = $colors[$colorIndex % count($colors)];
                                        $colorIndex++;
                        ?>
                        <div class="col-md-6">
                            <div class="skill mb-4">
                                <div class="d-flex justify-content-between">
                                    <h6 class="font-weight-bold"><?php echo htmlspecialchars($skill['name']); ?></h6>
                                    <h6 class="font-weight-bold"><?php echo $proficiency; ?>%</h6>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-<?php echo $color; ?>" role="progressbar" aria-valuenow="<?php echo $proficiency; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $proficiency; ?>%"></div>
                                </div>
                            </div>
                        </div>
                        <?php 
                                        $skillCount++;
                                    endif;
                                endforeach;
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <ul class="nav nav-pills rounded border border-2 border-primary mb-5">
                        <li class="nav-item w-50">
                            <button class="nav-link w-100 py-3 fs-5 active" data-bs-toggle="pill" href="#tab-1">Experience</button>
                        </li>
                        <li class="nav-item w-50">
                            <button class="nav-link w-100 py-3 fs-5" data-bs-toggle="pill" href="#tab-2">Education</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row gy-5 gx-4">
                                <?php if (!empty($experience)): ?>
                                    <?php foreach (array_slice($experience, 0, 4) as $exp): ?>
                                    <div class="col-sm-6">
                                        <h5><?php echo htmlspecialchars($exp['position']); ?></h5>
                                        <hr class="text-primary my-2">
                                        <p class="text-primary mb-1">
                                            <?php 
                                            echo date('Y', strtotime($exp['start_date'])); 
                                            echo ' - ';
                                            echo $exp['end_date'] ? date('Y', strtotime($exp['end_date'])) : 'Present';
                                            ?>
                                        </p>
                                        <h6 class="mb-0"><?php echo htmlspecialchars($exp['company']); ?></h6>
                                    </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="col-12">
                                        <p>Add your work experience from the admin panel.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane fade show p-0">
                            <div class="row gy-5 gx-4">
                                <?php if (!empty($education)): ?>
                                    <?php foreach (array_slice($education, 0, 4) as $edu): ?>
                                    <div class="col-sm-6">
                                        <h5><?php echo htmlspecialchars($edu['degree']); ?></h5>
                                        <hr class="text-primary my-2">
                                        <p class="text-primary mb-1">
                                            <?php 
                                            echo date('Y', strtotime($edu['start_date'])); 
                                            echo ' - ';
                                            echo $edu['end_date'] ? date('Y', strtotime($edu['end_date'])) : 'Present';
                                            ?>
                                        </p>
                                        <h6 class="mb-0"><?php echo htmlspecialchars($edu['institution']); ?></h6>
                                        <?php if (!empty($edu['cgpa'])): ?>
                                        <small class="text-muted">CGPA: <?php echo htmlspecialchars($edu['cgpa']); ?></small>
                                        <?php endif; ?>
                                    </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="col-12">
                                        <p>Add your education details from the admin panel.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Expertise End -->

    <!-- Service Start -->
    <div class="container-fluid bg-light my-5 py-6" id="service">
        <div class="container">
            <div class="row g-5 mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-6">
                    <h1 class="display-5 mb-0">My Services</h1>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <a class="btn btn-primary py-3 px-5" href="#contact">Hire Me</a>
                </div>
            </div>
            <div class="row g-4">
                <?php if (!empty($services)): ?>
                    <?php 
                    $delays = ['0.1s', '0.3s', '0.5s', '0.7s'];
                    $iconClasses = ['fa-crop-alt', 'fa-code-branch', 'fa-code', 'fa-laptop-code', 'fa-paint-brush', 'fa-cogs'];
                    $iconIndex = 0;
                    foreach ($services as $index => $service): 
                    ?>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="<?php echo $delays[$index % 4]; ?>">
                        <div class="service-item d-flex flex-column flex-sm-row bg-white rounded h-100 p-4 p-lg-5">
                            <div class="bg-icon flex-shrink-0 mb-3">
                                <i class="fa <?php echo !empty($service['icon']) ? htmlspecialchars($service['icon']) : $iconClasses[$iconIndex % count($iconClasses)]; ?> fa-2x text-dark"></i>
                            </div>
                            <div class="ms-sm-4">
                                <h4 class="mb-3"><?php echo htmlspecialchars($service['title']); ?></h4>
                                <span><?php echo htmlspecialchars($service['description']); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php 
                        $iconIndex++;
                    endforeach; 
                    ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p>Add your services from the admin panel.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Projects Start -->
    <div class="container-xxl py-6 pt-5" id="project">
        <div class="container">
            <div class="row g-5 mb-5 align-items-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-6">
                    <h1 class="display-5 mb-0">My Projects</h1>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <?php if (!empty($profile['github'])): ?>
                    <a class="btn btn-primary py-3 px-5" href="<?php echo $profile['github']; ?>" target="_blank">View All on GitHub</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row g-4 portfolio-container wow fadeInUp" data-wow-delay="0.1s">
                <?php if (!empty($projects)): ?>
                    <?php foreach ($projects as $project): ?>
                    <div class="col-lg-4 col-md-6 portfolio-item">
                        <div class="portfolio-img rounded overflow-hidden">
                            <?php if (!empty($project['image'])): ?>
                            <img class="img-fluid" src="<?php echo BASE_URL; ?>/public/uploads/projects/<?php echo $project['image']; ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                            <?php else: ?>
                            <img class="img-fluid" src="<?php echo BASE_URL; ?>/public/assets/images/project-1.jpg" alt="">
                            <?php endif; ?>
                            <div class="portfolio-btn">
                                <?php if (!empty($project['image'])): ?>
                                <a class="btn btn-lg-square btn-outline-secondary border-2 mx-1" href="<?php echo BASE_URL; ?>/public/uploads/projects/<?php echo $project['image']; ?>" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <?php endif; ?>
                                <?php if (!empty($project['project_link'])): ?>
                                <a class="btn btn-lg-square btn-outline-secondary border-2 mx-1" href="<?php echo $project['project_link']; ?>" target="_blank"><i class="fa fa-link"></i></a>
                                <?php endif; ?>
                                <?php if (!empty($project['github_link'])): ?>
                                <a class="btn btn-lg-square btn-outline-secondary border-2 mx-1" href="<?php echo $project['github_link']; ?>" target="_blank"><i class="fab fa-github"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="pt-3">
                            <h5 class="text-primary mb-2"><?php echo htmlspecialchars($project['title']); ?></h5>
                            <p class="mb-2"><?php echo htmlspecialchars(substr($project['description'], 0, 100)); ?>...</p>
                            <?php if (!empty($project['technologies'])): ?>
                            <small class="text-muted"><i class="fa fa-code me-2"></i><?php echo htmlspecialchars($project['technologies']); ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p>Add your projects from the admin panel.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Projects End -->

    <?php if (!empty($testimonials)): ?>
    <!-- Testimonial Start -->
    <div class="container-fluid bg-light py-5 my-5" id="testimonial">
        <div class="container-fluid py-5">
            <h1 class="display-5 text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Testimonial</h1>
            <div class="row justify-content-center">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="owl-carousel testimonial-carousel">
                        <?php foreach ($testimonials as $testimonial): ?>
                        <div class="testimonial-item text-center">
                            <div class="position-relative mb-5">
                                <?php if (!empty($testimonial['client_photo'])): ?>
                                <img class="img-fluid rounded-circle border border-secondary p-2 mx-auto" src="<?php echo BASE_URL; ?>/public/uploads/testimonials/<?php echo $testimonial['client_photo']; ?>" alt="<?php echo htmlspecialchars($testimonial['client_name']); ?>" style="width: 100px; height: 100px; object-fit: cover;">
                                <?php else: ?>
                                <img class="img-fluid rounded-circle border border-secondary p-2 mx-auto" src="<?php echo BASE_URL; ?>/public/assets/images/testimonial-1.jpg" alt="">
                                <?php endif; ?>
                                <div class="testimonial-icon">
                                    <i class="fa fa-quote-left text-primary"></i>
                                </div>
                            </div>
                            <p class="fs-5 fst-italic"><?php echo htmlspecialchars($testimonial['testimonial'] ?? $testimonial['content'] ?? ''); ?></p>
                            <hr class="w-25 mx-auto">
                            <h5><?php echo htmlspecialchars($testimonial['client_name']); ?></h5>
                            <span><?php echo htmlspecialchars($testimonial['client_position'] ?? $testimonial['company'] ?? ''); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
    <?php endif; ?>

    <!-- Contact Start -->
    <div class="container-xxl pb-5" id="contact">
        <div class="container py-5">
            <div class="row g-5 mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-6">
                    <h1 class="display-5 mb-0">Let's Work Together</h1>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <a class="btn btn-primary py-3 px-5" href="mailto:<?php echo htmlspecialchars($profile['email'] ?? ''); ?>">Say Hello</a>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-5 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <?php if (!empty($profile['address'])): ?>
                    <p class="mb-2">My office:</p>
                    <h3 class="fw-bold"><?php echo htmlspecialchars($profile['address']); ?></h3>
                    <hr class="w-100">
                    <?php endif; ?>
                    <?php if (!empty($profile['phone'])): ?>
                    <p class="mb-2">Call me:</p>
                    <h3 class="fw-bold"><?php echo htmlspecialchars($profile['phone']); ?></h3>
                    <hr class="w-100">
                    <?php endif; ?>
                    <?php if (!empty($profile['email'])): ?>
                    <p class="mb-2">Mail me:</p>
                    <h3 class="fw-bold"><?php echo htmlspecialchars($profile['email']); ?></h3>
                    <hr class="w-100">
                    <?php endif; ?>
                    <p class="mb-2">Follow me:</p>
                    <div class="d-flex pt-2">
                        <?php if (!empty($profile['twitter'])): ?>
                        <a class="btn btn-square btn-primary me-2" href="<?php echo $profile['twitter']; ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($profile['linkedin'])): ?>
                        <a class="btn btn-square btn-primary me-2" href="<?php echo $profile['linkedin']; ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($profile['github'])): ?>
                        <a class="btn btn-square btn-primary me-2" href="<?php echo $profile['github']; ?>" target="_blank"><i class="fab fa-github"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <form id="contactForm" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" id="message" name="message" style="height: 100px" required></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary py-3 px-5" type="submit">Send Message</button>
                            </div>
                            <div class="col-12">
                                <div id="formMessage" class="mt-3"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <!-- Copyright Start -->
    <div class="container-fluid bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom text-secondary" href="#"><?php echo htmlspecialchars($profile['name'] ?? 'ProMan'); ?></a>, All Right Reserved.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        <a href="#home">Home</a>
                        <a href="#about">About</a>
                        <a href="#contact">Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/assets/lib/wow/wow.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/assets/lib/easing/easing.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/assets/lib/waypoints/waypoints.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/assets/lib/typed/typed.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/assets/lib/counterup/counterup.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/assets/lib/isotope/isotope.pkgd.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/assets/lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?php echo BASE_URL; ?>/public/assets/js/main.js"></script>
    
    <script>
    // Contact Form AJAX Handler
    $(document).ready(function() {
        $('#contactForm').on('submit', function(e) {
            e.preventDefault();
            
            var form = $(this);
            var formData = new FormData(this);
            var submitBtn = form.find('button[type="submit"]');
            var btnText = submitBtn.text();
            var formMessage = $('#formMessage');
            
            submitBtn.prop('disabled', true).text('Sending...');
            formMessage.removeClass('alert-success alert-danger').hide();
            
            $.ajax({
                url: '<?php echo BASE_URL; ?>/contact',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        formMessage.addClass('alert alert-success')
                            .html('<i class="fa fa-check-circle me-2"></i>' + (response.message || 'Message sent successfully!'))
                            .fadeIn();
                        form[0].reset();
                    } else {
                        formMessage.addClass('alert alert-danger')
                            .html('<i class="fa fa-exclamation-circle me-2"></i>' + (response.message || 'Failed to send message.'))
                            .fadeIn();
                    }
                },
                error: function() {
                    formMessage.addClass('alert alert-danger')
                        .html('<i class="fa fa-exclamation-circle me-2"></i>An error occurred. Please try again.')
                        .fadeIn();
                },
                complete: function() {
                    submitBtn.prop('disabled', false).text(btnText);
                    setTimeout(function() {
                        formMessage.fadeOut();
                    }, 5000);
                }
            });
        });
    });
    </script>
</body>
</html>
