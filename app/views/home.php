<!doctype html>
<html lang="en">
<head>
  <title><?php echo htmlspecialchars($profile['name'] ?? 'Portfolio'); ?> - <?php echo htmlspecialchars($profile['title'] ?? ''); ?></title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="<?php echo htmlspecialchars($profile['bio'] ?? 'Professional Portfolio'); ?>">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

  <!-- Lightbox CSS -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/lightbox.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/style.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
  <!-- Loading Screen -->
  <div class="loading" id="loading">
    <div class="loader"></div>
  </div>

  <!-- SVG Icons -->
  <svg style="display:none;">
    <symbol id="menu" viewBox="0 0 24 24">
      <path fill="black" d="M4 6a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2H5a1 1 0 0 1-1-1m0 12a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2H5a1 1 0 0 1-1-1m7-7a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2z" />
    </symbol>
  </svg>

  <!-- Header -->
  <header id="top" class="position-sticky top-0 start-0" style="z-index:10;">
    <nav class="navbar bg-white fixed-top">
      <div class="container-fluid">
        <div class="d-flex align-items-center g-4">
          <a class="navbar-brand d-flex" href="#home">
            <h3 class="mb-0 fw-bold"><?php echo htmlspecialchars($profile['name'] ?? 'Portfolio'); ?></h3>
          </a>
          <div class="icon px-5">
            <?php if (!empty($profile['github'])): ?>
            <a href="<?php echo $profile['github']; ?>" target="_blank" class="text-decoration-none">
              <i class="fab fa-github" style="font-size: 20px;"></i>
            </a>
            <?php endif; ?>
            <?php if (!empty($profile['linkedin'])): ?>
            <a href="<?php echo $profile['linkedin']; ?>" target="_blank" class="text-decoration-none ms-3">
              <i class="fab fa-linkedin" style="font-size: 20px;"></i>
            </a>
            <?php endif; ?>
            <?php if (!empty($profile['twitter'])): ?>
            <a href="<?php echo $profile['twitter']; ?>" target="_blank" class="text-decoration-none ms-3">
              <i class="fab fa-twitter" style="font-size: 20px;"></i>
            </a>
            <?php endif; ?>
            <?php if (!empty($profile['email'])): ?>
            <a href="mailto:<?php echo $profile['email']; ?>" class="text-decoration-none ms-3">
              <i class="fas fa-envelope" style="font-size: 20px;"></i>
            </a>
            <?php endif; ?>
          </div>
        </div>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
          <span class="navbar-toggler-icon">
            <svg class="text-primary menu" width="32" height="32">
              <use xlink:href="#menu"></use>
            </svg>
          </span>
        </button>
        <div class="offcanvas offcanvas-end text-white bg-black" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <button type="button" class="btn-close btn-close-white ms-3" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav flex-grow-1 p-4">
              <li class="nav-item">
                <a class="nav-link active text-uppercase ls-4 text-white" href="#home">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-uppercase ls-4 text-white" href="#about">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-uppercase ls-4 text-white" href="#services">Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-uppercase ls-4 text-white" href="#portfolio">Portfolio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-uppercase ls-4 text-white" href="#testimonials">Testimonials</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-uppercase ls-4 text-white" href="#contact">Contact</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <!-- Hero Banner -->
  <section id="home">
    <div class="container">
      <div class="banner rounded-4 p-5" style="background-image: url(<?php echo BASE_URL; ?>/public/assets/images/banner.png); background-size: cover; background-repeat: no-repeat; background-position: center;">
        <div class="text-content text-white py-5 my-5">
          <p class="fs-4"><?php echo htmlspecialchars($profile['title'] ?? ''); ?></p>
          <h1 class="display-1"><?php echo htmlspecialchars($profile['name'] ?? ''); ?></h1>
        </div>
        <div class="row text-uppercase bg-black rounded-4 p-3 mt-5 stats-row">
          <div class="col-md-3 mb-3 mb-md-0">
            <div class="d-flex align-items-center gap-4">
              <h2 class="display-2 text-light mb-0">
                <?php 
                $totalExp = 0;
                if (!empty($experience)) {
                    foreach($experience as $exp) {
                        $start = strtotime($exp['start_date']);
                        $end = $exp['is_current'] ? time() : strtotime($exp['end_date']);
                        $totalExp += ($end - $start) / (365*24*60*60);
                    }
                }
                echo round($totalExp); 
                ?>
              </h2>
              <p class="text-light-emphasis justify-content-center m-0 ls-4">Years of<br>experience</p>
            </div>
          </div>
          <div class="col-md-3 mb-3 mb-md-0">
            <div class="d-flex align-items-center gap-4">
              <h2 class="display-2 text-light mb-0"><?php echo count($projects ?? []); ?></h2>
              <p class="text-light-emphasis justify-content-center m-0 ls-4">Projects<br>completed</p>
            </div>
          </div>
          <div class="col-md-3 mb-3 mb-md-0">
            <div class="d-flex align-items-center gap-4">
              <h2 class="display-2 text-light mb-0"><?php echo count($skills ?? []); ?>+</h2>
              <p class="text-light-emphasis justify-content-center m-0 ls-4">Skills<br>mastered</p>
            </div>
          </div>
          <div class="col-md-3 mb-3 mb-md-0">
            <div class="d-flex align-items-center gap-4">
              <h2 class="display-2 text-light mb-0"><?php echo count($testimonials ?? []); ?></h2>
              <p class="text-light-emphasis justify-content-center m-0 ls-4">Happy<br>clients</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Services Section -->
  <section id="services" class="p-5">
    <div class="container">
      <div class="row justify-content-center">
        <?php if (!empty($services)): ?>
          <?php foreach (array_slice($services, 0, 3) as $service): ?>
          <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="d-flex gap-4 align-items-start">
              <div class="icon">
                <i class="fas fa-<?php echo htmlspecialchars($service['icon']); ?> text-primary" style="font-size: 50px;"></i>
              </div>
              <div class="text-md-start">
                <h5><?php echo htmlspecialchars($service['title']); ?></h5>
                <p class="postf"><?php echo htmlspecialchars(substr($service['description'], 0, 100)); ?>...</p>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- About (Education/Experience/Skills) Section -->
  <section id="about">
    <div class="container">
      <div class="row g-4">
        <!-- Education -->
        <div class="col-lg-4">
          <div class="h-100 bg-yellow p-4 rounded-4">
            <h3 class="mb-4">Education</h3>
            <?php if (!empty($education)): ?>
              <?php foreach ($education as $edu): ?>
              <div class="py-3">
                <p class="text-dark-emphasis mb-2"><?php echo htmlspecialchars($edu['year']); ?></p>
                <h5><?php echo htmlspecialchars($edu['degree']); ?></h5>
                <p class="text-dark-emphasis mb-2"><?php echo htmlspecialchars($edu['institution']); ?></p>
                <p class="text-muted small">CGPA: <?php echo htmlspecialchars($edu['cgpa']); ?></p>
              </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>

        <!-- Experience -->
        <div class="col-lg-4">
          <div class="h-100 bg-green p-4 rounded-4">
            <h3 class="mb-4">Experience</h3>
            <?php if (!empty($experience)): ?>
              <?php foreach ($experience as $exp): ?>
              <div class="py-3">
                <p class="text-dark-emphasis mb-2">
                  <?php echo date('Y', strtotime($exp['start_date'])); ?> - 
                  <?php echo $exp['is_current'] ? 'Present' : date('Y', strtotime($exp['end_date'])); ?>
                </p>
                <h5><?php echo htmlspecialchars($exp['company']); ?>: <?php echo htmlspecialchars($exp['position']); ?></h5>
                <p class="text-dark-emphasis"><?php echo htmlspecialchars(substr($exp['description'], 0, 150)); ?>...</p>
              </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>

        <!-- Skills Overview -->
        <div class="col-lg-4">
          <div class="h-100 bg-teal p-4 rounded-4">
            <h3 class="mb-4">Top Skills</h3>
            <?php if (!empty($skills)): ?>
              <?php 
              $topSkills = array_slice($skills, 0, 10);
              foreach ($topSkills as $skill): 
              ?>
              <div class="py-2">
                <div class="d-flex justify-content-between align-items-center">
                  <h6 class="mb-0"><?php echo htmlspecialchars($skill['name']); ?></h6>
                  <span class="badge bg-dark"><?php echo htmlspecialchars($skill['proficiency']); ?></span>
                </div>
              </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Portfolio Section -->
  <section id="portfolio" class="portfolio py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 mb-5">
          <div class="section-header text-center">
            <h2 class="display-4 fw-bold mb-3">My Work</h2>
            <p class="lead">As a passionate developer, I'm dedicated to creating exceptional digital experiences.</p>
          </div>
        </div>
      </div>

      <div class="grid p-0 clearfix row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php if (!empty($projects)): ?>
          <?php foreach ($projects as $project): ?>
          <div class="col portfolio-item">
            <?php if (!empty($project['image'])): ?>
            <a href="<?php echo BASE_URL; ?>/public/uploads/projects/<?php echo $project['image']; ?>" data-lightbox="portfolio" data-title="<?php echo htmlspecialchars($project['title']); ?>">
              <img src="<?php echo BASE_URL; ?>/public/uploads/projects/<?php echo $project['image']; ?>" class="img-fluid rounded-4" alt="<?php echo htmlspecialchars($project['title']); ?>">
            </a>
            <?php endif; ?>
            <div class="mt-3">
              <h5><?php echo htmlspecialchars($project['title']); ?></h5>
              <p class="postf small"><?php echo htmlspecialchars(substr($project['description'], 0, 80)); ?>...</p>
              <?php if (!empty($project['project_link'])): ?>
              <a href="<?php echo $project['project_link']; ?>" target="_blank" class="btn btn-sm btn-primary">View Project</a>
              <?php endif; ?>
            </div>
          </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <?php if (!empty($testimonials)): ?>
  <section id="testimonials">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="display-3">Testimonials</h2>
      </div>

      <div class="swiper testimonial-swiper">
        <div class="swiper-wrapper">
          <?php foreach ($testimonials as $testimonial): ?>
          <div class="testimonial-card rounded-3 py-4 px-4 swiper-slide">
            <div class="text-start">
              <p class="mb-4">"<?php echo htmlspecialchars($testimonial['content']); ?>"</p>
              <h5 class="mb-1"><?php echo htmlspecialchars($testimonial['client_name']); ?></h5>
              <?php if (!empty($testimonial['company'])): ?>
              <p class="postd mb-0"><?php echo htmlspecialchars($testimonial['company']); ?></p>
              <?php endif; ?>
              <div class="mt-2">
                <?php for($i=0; $i<$testimonial['rating']; $i++): ?>
                <i class="fas fa-star" style="color: var(--bs-primary);"></i>
                <?php endfor; ?>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="testimonial-swiper-pagination position-relative mt-5 text-center"></div>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- Contact Section -->
  <section id="contact" class="p-5 bg-yellow py-5">
    <div class="container">
      <div class="row justify-content-center my-5">
        <div class="col-md-5">
          <h6>Quick Contact</h6>
          <h2 class="display-3">Leave a Message</h2>
          <p>Feel free to reach out for collaborations or just a friendly hello!</p>
          <div class="mt-4">
            <p><i class="fas fa-envelope me-2"></i> <?php echo htmlspecialchars($profile['email'] ?? ''); ?></p>
            <p><i class="fas fa-phone me-2"></i> <?php echo htmlspecialchars($profile['phone'] ?? ''); ?></p>
            <p><i class="fas fa-map-marker-alt me-2"></i> <?php echo htmlspecialchars($profile['address'] ?? ''); ?></p>
          </div>
        </div>
        <div class="col-md-5">
          <form id="contactForm">
            <div class="mb-3">
              <input type="text" class="form-control p-3 rounded-4" name="name" placeholder="Your name *" required />
            </div>
            <div class="mb-3">
              <input type="email" class="form-control p-3 rounded-4" name="email" placeholder="Your email *" required />
            </div>
            <div class="mb-3">
              <input type="text" class="form-control p-3 rounded-4" name="subject" placeholder="Subject" />
            </div>
            <div class="mb-3">
              <textarea class="form-control p-3 rounded-4" name="message" placeholder="Your message *" rows="3" required></textarea>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-dark btn-lg text-uppercase rounded-4">Submit</button>
            </div>
            <div id="formMessage" class="form-message mt-3"></div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer id="footer" class="bg-black text-white py-5">
    <div class="container-sm">
      <div class="row g-md-5 my-5">
        <div class="col-md-4">
          <div class="info-box">
            <h4 class="text-white mb-4"><?php echo htmlspecialchars($profile['name'] ?? ''); ?></h4>
            <p class="py-4"><?php echo htmlspecialchars(substr($profile['bio'] ?? '', 0, 150)); ?>...</p>
            <div class="social-links">
              <?php if (!empty($profile['github'])): ?>
              <a href="<?php echo $profile['github']; ?>" target="_blank" class="text-white me-3"><i class="fab fa-github fa-lg"></i></a>
              <?php endif; ?>
              <?php if (!empty($profile['linkedin'])): ?>
              <a href="<?php echo $profile['linkedin']; ?>" target="_blank" class="text-white me-3"><i class="fab fa-linkedin fa-lg"></i></a>
              <?php endif; ?>
              <?php if (!empty($profile['twitter'])): ?>
              <a href="<?php echo $profile['twitter']; ?>" target="_blank" class="text-white me-3"><i class="fab fa-twitter fa-lg"></i></a>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <h6 class="text-white mb-3">Quick Links</h6>
          <ul class="list-unstyled">
            <li><a class="text-decoration-none text-white-50" href="#home">Home</a></li>
            <li><a class="text-decoration-none text-white-50" href="#about">About</a></li>
            <li><a class="text-decoration-none text-white-50" href="#services">Services</a></li>
            <li><a class="text-decoration-none text-white-50" href="#portfolio">Portfolio</a></li>
            <li><a class="text-decoration-none text-white-50" href="#contact">Contact</a></li>
          </ul>
        </div>
        <div class="col-md-5">
          <h6 class="text-white mb-3">Get In Touch</h6>
          <p>Feel free to contact if you wanna collaborate with me, or simply have a conversation.</p>
          <h5>
            <a href="mailto:<?php echo htmlspecialchars($profile['email'] ?? ''); ?>" class="text-white text-decoration-none">
              <?php echo htmlspecialchars($profile['email'] ?? ''); ?>
            </a>
          </h5>
        </div>
      </div>
      <div class="row">
        <p class="text-center text-white-50">©<?php echo date('Y'); ?> <?php echo htmlspecialchars($profile['name'] ?? ''); ?>. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JavaScript -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

  <!-- Lightbox JS -->
  <script src="<?php echo BASE_URL; ?>/public/assets/js/lightbox.min.js"></script>

  <!-- Custom JS -->
  <script src="<?php echo BASE_URL; ?>/public/assets/js/script.js"></script>
</body>
</html>
