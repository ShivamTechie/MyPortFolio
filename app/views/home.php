<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="<?php echo BASE_URL; ?>/public/assets/images/favicon.png" type="image/png">
	<title><?php echo htmlspecialchars($profile['name'] ?? 'Portfolio'); ?> - <?php echo htmlspecialchars($profile['title'] ?? 'Professional Portfolio'); ?></title>
	<meta name="description" content="<?php echo htmlspecialchars($profile['bio'] ?? ''); ?>">
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/vendors/linericon/style.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/vendors/owl-carousel/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/magnific-popup.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/vendors/nice-select/css/nice-select.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/style.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/custom-enhancements.css">
	
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

	<!--================ Start Header Area =================-->
	<header class="header_area">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light">
				<div class="container">
					<a class="navbar-brand logo_h" href="#home">
						<h3 class="mb-0"><?php echo htmlspecialchars($profile['name'] ?? 'Portfolio'); ?></h3>
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav justify-content-end">
							<li class="nav-item active"><a class="nav-link" href="#home">Home</a></li>
							<li class="nav-item"><a class="nav-link" href="#about">About</a></li>
							<li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
							<li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
							<li class="nav-item"><a class="nav-link" href="#testimonials">Testimonials</a></li>
							<li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</header>
	<!--================ End Header Area =================-->

	<!--================ Start Home Banner Area =================-->
	<section class="home_banner_area" id="home">
		<div class="banner_inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-7">
						<div class="banner_content">
							<h3 class="text-uppercase">Hello</h3>
							<h1 class="text-uppercase">I am <?php echo htmlspecialchars($profile['name'] ?? ''); ?></h1>
							<h5 class="text-uppercase"><?php echo htmlspecialchars($profile['title'] ?? ''); ?></h5>
							<div class="d-flex align-items-center">
								<a class="primary_btn" href="#contact"><span>Hire Me</span></a>
								<?php if (!empty($profile['resume_path'])): ?>
								<a class="primary_btn tr-bg" href="<?php echo BASE_URL; ?>/public/uploads/resume/<?php echo $profile['resume_path']; ?>" target="_blank"><span>Get CV</span></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="home_right_img">
							<?php if (!empty($profile['profile_image'])): ?>
							<img class="" src="<?php echo BASE_URL; ?>/public/uploads/profile/<?php echo $profile['profile_image']; ?>" alt="<?php echo htmlspecialchars($profile['name']); ?>">
							<?php else: ?>
							<img class="" src="<?php echo BASE_URL; ?>/public/assets/images/banner/home-right.png" alt="">
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ End Home Banner Area =================-->

	<!--================ Start About Us Area =================-->
	<section class="about_area section_gap" id="about">
		<div class="container">
			<div class="row justify-content-start align-items-center">
				<div class="col-lg-5">
					<div class="about_img">
						<?php if (!empty($profile['profile_image'])): ?>
						<img class="" src="<?php echo BASE_URL; ?>/public/uploads/profile/<?php echo $profile['profile_image']; ?>" alt="<?php echo htmlspecialchars($profile['name']); ?>">
						<?php else: ?>
						<img class="" src="<?php echo BASE_URL; ?>/public/assets/images/about-us.png" alt="">
						<?php endif; ?>
					</div>
				</div>

				<div class="offset-lg-1 col-lg-5">
					<div class="main_title text-left">
						<h2>Let's <br>Introduce about <br>myself</h2>
						<p><?php echo nl2br(htmlspecialchars($profile['bio'] ?? '')); ?></p>
						<div class="mt-4">
							<p><strong>Email:</strong> <?php echo htmlspecialchars($profile['email'] ?? ''); ?></p>
							<p><strong>Phone:</strong> <?php echo htmlspecialchars($profile['phone'] ?? ''); ?></p>
							<p><strong>Location:</strong> <?php echo htmlspecialchars($profile['address'] ?? ''); ?></p>
						</div>
						<?php if (!empty($profile['resume_path'])): ?>
						<a class="primary_btn" href="<?php echo BASE_URL; ?>/public/uploads/resume/<?php echo $profile['resume_path']; ?>" target="_blank"><span>Download CV</span></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ End About Us Area =================-->

	<!--================ Start Experience/Education Area =================-->
	<section class="brand_area section_gap_bottom">
		<div class="container">
			<div class="row">
				<?php if (!empty($experience)): ?>
				<div class="col-lg-6 mb-4">
					<h3 class="mb-4">Work Experience</h3>
					<?php foreach ($experience as $exp): ?>
					<div class="card mb-3">
						<div class="card-body">
							<h5 class="card-title"><?php echo htmlspecialchars($exp['position']); ?></h5>
							<h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($exp['company']); ?></h6>
							<p class="text-muted small">
								<?php echo date('M Y', strtotime($exp['start_date'])); ?> - 
								<?php echo $exp['is_current'] ? 'Present' : date('M Y', strtotime($exp['end_date'])); ?>
							</p>
							<p class="card-text"><?php echo nl2br(htmlspecialchars($exp['description'])); ?></p>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>

				<?php if (!empty($education)): ?>
				<div class="col-lg-6 mb-4">
					<h3 class="mb-4">Education</h3>
					<?php foreach ($education as $edu): ?>
					<div class="card mb-3">
						<div class="card-body">
							<h5 class="card-title"><?php echo htmlspecialchars($edu['degree']); ?></h5>
							<h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($edu['institution']); ?></h6>
							<p class="text-muted small"><?php echo htmlspecialchars($edu['year']); ?> • CGPA: <?php echo htmlspecialchars($edu['cgpa']); ?></p>
							<?php if (!empty($edu['description'])): ?>
							<p class="card-text"><?php echo htmlspecialchars($edu['description']); ?></p>
							<?php endif; ?>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
			</div>

			<!-- Skills Section -->
			<?php if (!empty($skills)): ?>
			<div class="row mt-5">
				<div class="col-lg-12">
					<h3 class="mb-4 text-center">Technical Skills</h3>
					<div class="row">
						<?php foreach ($skills as $category => $categorySkills): ?>
						<div class="col-lg-3 col-md-6 mb-4">
							<div class="card h-100">
								<div class="card-header bg-primary text-white">
									<h6 class="mb-0"><?php echo htmlspecialchars($category); ?></h6>
								</div>
								<div class="card-body">
									<ul class="list-unstyled mb-0">
										<?php foreach ($categorySkills as $skill): ?>
										<li class="mb-2 d-flex justify-content-between align-items-center">
											<span><?php echo htmlspecialchars($skill['name']); ?></span>
											<span class="badge badge-secondary"><?php echo htmlspecialchars($skill['proficiency']); ?></span>
										</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</section>
	<!--================ End Experience/Education Area =================-->

	<!--================ Start Features Area =================-->
	<section class="features_area" id="services">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 text-center">
					<div class="main_title">
						<h2>Service Offers</h2>
						<p>What I can do for you</p>
					</div>
				</div>
			</div>
			<div class="row feature_inner">
				<?php if (!empty($services)): ?>
					<?php foreach ($services as $service): ?>
					<div class="col-lg-3 col-md-6 mb-4">
						<div class="feature_item text-center">
							<i class="fa fa-<?php echo htmlspecialchars($service['icon']); ?> fa-3x mb-3"></i>
							<h4><?php echo htmlspecialchars($service['title']); ?></h4>
							<p><?php echo htmlspecialchars($service['description']); ?></p>
						</div>
					</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<!--================ End Features Area =================-->

	<!--================Start Portfolio Area =================-->
	<section class="portfolio_area" id="portfolio">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="main_title text-left">
						<h2>Quality Work <br>Recently Done Projects</h2>
					</div>
				</div>
			</div>
	
			<div class="filters-content">
				<div class="row portfolio-grid justify-content-center">
					<?php if (!empty($projects)): ?>
						<?php foreach ($projects as $project): ?>
						<div class="col-lg-4 col-md-6 mb-4">
							<div class="portfolio_box">
								<div class="single_portfolio">
									<?php if (!empty($project['image'])): ?>
									<img class="img-fluid w-100" src="<?php echo BASE_URL; ?>/public/uploads/projects/<?php echo $project['image']; ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
									<?php else: ?>
									<img class="img-fluid w-100" src="<?php echo BASE_URL; ?>/public/assets/images/portfolio/p1.jpg" alt="">
									<?php endif; ?>
									<div class="overlay"></div>
									<?php if (!empty($project['image'])): ?>
									<a href="<?php echo BASE_URL; ?>/public/uploads/projects/<?php echo $project['image']; ?>" class="img-gal">
										<div class="icon">
											<span class="lnr lnr-cross"></span>
										</div>
									</a>
									<?php endif; ?>
								</div>
								<div class="short_info">
									<h4><?php echo htmlspecialchars($project['title']); ?></h4>
									<p><?php echo htmlspecialchars(substr($project['description'], 0, 80)); ?>...</p>
									<?php if (!empty($project['technologies'])): ?>
									<p class="text-muted small">
										<strong>Tech:</strong> <?php echo htmlspecialchars($project['technologies']); ?>
									</p>
									<?php endif; ?>
									<?php if (!empty($project['project_link'])): ?>
									<a href="<?php echo $project['project_link']; ?>" target="_blank" class="btn btn-sm btn-primary mt-2">View Project</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	<!--================End Portfolio Area =================-->

	<!--================ Start Testimonial Area =================-->
	<?php if (!empty($testimonials)): ?>
	<div class="testimonial_area section_gap_bottom" id="testimonials">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 text-center">
					<div class="main_title">
						<h2>Client Testimonials</h2>
						<p>What my clients say about my work</p>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="testi_slider owl-carousel">
						<?php foreach ($testimonials as $testimonial): ?>
						<div class="testi_item">
							<div class="row">
								<div class="col-lg-4">
									<?php if (!empty($testimonial['client_photo'])): ?>
									<img src="<?php echo BASE_URL; ?>/public/uploads/testimonials/<?php echo $testimonial['client_photo']; ?>" alt="<?php echo htmlspecialchars($testimonial['client_name']); ?>">
									<?php else: ?>
									<img src="<?php echo BASE_URL; ?>/public/assets/images/testimonials/t1.jpg" alt="">
									<?php endif; ?>
								</div>
								<div class="col-lg-8">
									<div class="testi_text">
										<h4><?php echo htmlspecialchars($testimonial['client_name']); ?></h4>
										<?php if (!empty($testimonial['company'])): ?>
										<p class="text-muted"><?php echo htmlspecialchars($testimonial['company']); ?></p>
										<?php endif; ?>
										<p><?php echo htmlspecialchars($testimonial['content']); ?></p>
										<div class="rating">
											<?php for($i=0; $i<$testimonial['rating']; $i++): ?>
											<i class="fa fa-star"></i>
											<?php endfor; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<!--================ End Testimonial Area =================-->

	<!--================ Start Contact Area =================-->
	<section class="newsletter_area" id="contact">
		<div class="container">
			<div class="row justify-content-center align-items-center">
				<div class="col-lg-10">
					<div class="subscription_box text-center">
						<h2 class="text-uppercase text-white">Let's Work Together</h2>
						<p class="text-white mb-4">
							Have a project in mind? Let's discuss how I can help bring your ideas to life.
						</p>
						<form id="contactForm" class="subscription relative">
							<div class="row">
								<div class="col-md-6 mb-3">
									<input type="text" name="name" class="form-control" placeholder="Your Name *" required>
								</div>
								<div class="col-md-6 mb-3">
									<input type="email" name="email" class="form-control" placeholder="Your Email *" required>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 mb-3">
									<input type="text" name="subject" class="form-control" placeholder="Subject">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 mb-3">
									<textarea name="message" class="form-control" rows="5" placeholder="Tell me about your project... *" required></textarea>
								</div>
							</div>
							<button type="submit" class="primary-btn hover d-inline">
								<i class="fa fa-paper-plane"></i> Send Message
							</button>
							<div id="formMessage" class="mt-3"></div>
						</form>
						
						<div class="contact_info mt-5 text-white">
							<div class="row">
								<div class="col-md-4">
									<p><i class="fa fa-envelope"></i> <?php echo htmlspecialchars($profile['email'] ?? ''); ?></p>
								</div>
								<div class="col-md-4">
									<p><i class="fa fa-phone"></i> <?php echo htmlspecialchars($profile['phone'] ?? ''); ?></p>
								</div>
								<div class="col-md-4">
									<p><i class="fa fa-map-marker"></i> <?php echo htmlspecialchars($profile['address'] ?? ''); ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ End Contact Area =================-->

	<!--================Footer Area =================-->
	<footer class="footer_area">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-12">
					<div class="footer_top flex-column">
						<div class="footer_logo">
							<h4><?php echo htmlspecialchars($profile['name'] ?? ''); ?></h4>
							<h6>Follow Me</h6>
						</div>
						<div class="footer_social">
							<?php if (!empty($profile['github'])): ?>
							<a href="<?php echo $profile['github']; ?>" target="_blank"><i class="fa fa-github"></i></a>
							<?php endif; ?>
							<?php if (!empty($profile['linkedin'])): ?>
							<a href="<?php echo $profile['linkedin']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
							<?php endif; ?>
							<?php if (!empty($profile['twitter'])): ?>
							<a href="<?php echo $profile['twitter']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="row footer_bottom justify-content-center">
				<p class="col-lg-8 col-sm-12 footer-text">
					Copyright &copy;<script>document.write(new Date().getFullYear());</script> <?php echo htmlspecialchars($profile['name'] ?? ''); ?>. All rights reserved.
				</p>
			</div>
		</div>
	</footer>
	<!--================End Footer Area =================-->

	<!-- Optional JavaScript -->
	<script src="<?php echo BASE_URL; ?>/public/assets/js/jquery-3.2.1.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/public/assets/js/popper.js"></script>
	<script src="<?php echo BASE_URL; ?>/public/assets/js/bootstrap.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/public/assets/js/stellar.js"></script>
	<script src="<?php echo BASE_URL; ?>/public/assets/js/jquery.magnific-popup.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/public/assets/vendors/nice-select/js/jquery.nice-select.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/public/assets/vendors/isotope/imagesloaded.pkgd.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/public/assets/vendors/isotope/isotope-min.js"></script>
	<script src="<?php echo BASE_URL; ?>/public/assets/vendors/owl-carousel/owl.carousel.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/public/assets/js/jquery.ajaxchimp.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/public/assets/js/theme.js"></script>
	
	<script>
	// Smooth scroll for anchor links
	$(document).ready(function(){
		$('a[href^="#"]').on('click', function(e) {
			e.preventDefault();
			var target = $(this).attr('href');
			if(target !== '#') {
				$('html, body').animate({
					scrollTop: $(target).offset().top - 70
				}, 800);
			}
		});

		// Active menu on scroll
		$(window).on('scroll', function() {
			var scrollPos = $(window).scrollTop() + 100;
			$('section[id]').each(function() {
				var sectionTop = $(this).offset().top;
				var sectionHeight = $(this).outerHeight();
				var sectionId = $(this).attr('id');
				
				if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
					$('.menu_nav .nav-link').removeClass('active');
					$('.menu_nav .nav-link[href="#' + sectionId + '"]').addClass('active');
				}
			});
		});

		// Contact Form Handler
		$('#contactForm').on('submit', function(e) {
			e.preventDefault();
			
			var form = $(this);
			var formData = new FormData(this);
			var submitBtn = form.find('button[type="submit"]');
			var btnText = submitBtn.html();
			var formMessage = $('#formMessage');
			
			submitBtn.prop('disabled', true).html('Sending...');
			formMessage.removeClass('alert-success alert-danger').hide();
			
			$.ajax({
				url: '/contact',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				dataType: 'json',
				success: function(response) {
					if (response.success) {
						formMessage.addClass('alert alert-success text-white')
							.html('<i class="fa fa-check-circle"></i> ' + (response.message || 'Message sent successfully!'))
							.fadeIn();
						form[0].reset();
					} else {
						formMessage.addClass('alert alert-danger text-white')
							.html('<i class="fa fa-exclamation-circle"></i> ' + (response.message || 'Failed to send message.'))
							.fadeIn();
					}
				},
				error: function() {
					formMessage.addClass('alert alert-danger text-white')
						.html('<i class="fa fa-exclamation-circle"></i> An error occurred. Please try again.')
						.fadeIn();
				},
				complete: function() {
					submitBtn.prop('disabled', false).html(btnText);
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
