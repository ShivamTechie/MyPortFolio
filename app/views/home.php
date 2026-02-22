<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($profile['name'] ?? 'Portfolio'); ?> - <?php echo htmlspecialchars($profile['title'] ?? 'Developer'); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($profile['bio'] ?? ''); ?>">
    <!-- AOS Animation -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<!-- Font Awesome (you already use it, but ensure latest) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .animate-pulse-slow {
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#667eea',
                        secondary: '#764ba2',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white text-gray-900">

    <!-- Navigation -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="#home" class="text-2xl font-bold text-gray-900 hover:text-blue-600 transition-colors">
                    <?php echo htmlspecialchars(explode(' ', $profile['name'] ?? 'Portfolio')[0]); ?><span class="text-blue-600">.</span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="#home" class="nav-link px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors rounded-lg hover:bg-gray-50">Home</a>
                    <a href="#about" class="nav-link px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors rounded-lg hover:bg-gray-50">About</a>
                    <a href="#skills" class="nav-link px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors rounded-lg hover:bg-gray-50">Skills</a>
                    <a href="#experience" class="nav-link px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors rounded-lg hover:bg-gray-50">Experience</a>
                    <?php if (!empty($services)): ?>
                    <a href="#services" class="nav-link px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors rounded-lg hover:bg-gray-50">Services</a>
                    <?php endif; ?>
                    <a href="#projects" class="nav-link px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors rounded-lg hover:bg-gray-50">Projects</a>
                    <?php if (!empty($testimonials)): ?>
                    <a href="#testimonials" class="nav-link px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors rounded-lg hover:bg-gray-50">Testimonials</a>
                    <?php endif; ?>
                    <a href="#contact" class="nav-link px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors rounded-lg hover:bg-gray-50">Contact</a>
                </div>

                <!-- CTA Button -->
                <div class="hidden md:block">
                    <a href="#contact" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-medium transition-all duration-300">
                        Let's Talk
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 shadow-lg">
            <div class="px-4 py-4 space-y-2">
                <a href="#home" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-colors">Home</a>
                <a href="#about" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-colors">About</a>
                <a href="#skills" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-colors">Skills</a>
                <a href="#experience" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-colors">Experience</a>
                <?php if (!empty($services)): ?>
                <a href="#services" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-colors">Services</a>
                <?php endif; ?>
                <a href="#projects" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-colors">Projects</a>
                <?php if (!empty($testimonials)): ?>
                <a href="#testimonials" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-colors">Testimonials</a>
                <?php endif; ?>
                <a href="#contact" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-colors">Contact</a>
                <a href="#contact" class="block w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg font-medium text-center mt-4">Let's Talk</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex items-center justify-center pt-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-gray-50 via-white to-blue-50">
        <div class="max-w-7xl mx-auto w-full">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="space-y-8 fade-in-up">
                    <div class="space-y-4">
                        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-900 leading-tight">
                            Hi, I'm 
                            <span class="gradient-text block mt-2"><?php echo htmlspecialchars($profile['name'] ?? ''); ?></span>
                        </h1>
                        <p class="text-xl sm:text-2xl text-gray-600 font-medium">
                            <?php echo htmlspecialchars($profile['title'] ?? ''); ?>
                        </p>
                        <p class="text-lg text-gray-500 leading-relaxed">
                            Crafting Digital Experiences with Code
                        </p>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-wrap gap-4">
                        <a href="#contact" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg text-base font-medium transition-all duration-300 hover:shadow-lg">
                            Hire Me
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                        <?php if (!empty($profile['resume_path'])): ?>
                        <a href="<?php echo BASE_URL; ?>/public/uploads/resume/<?php echo $profile['resume_path']; ?>" download class="inline-flex items-center border-2 border-gray-900 text-gray-900 hover:bg-gray-900 hover:text-white px-8 py-4 rounded-lg text-base font-medium transition-all duration-300">
                            <i class="fas fa-download mr-2"></i>
                            Download CV
                        </a>
                        <?php endif; ?>
                    </div>

                    <!-- Social Links -->
                    <div class="flex items-center gap-4 pt-4">
                        <span class="text-gray-600 font-medium">Follow me:</span>
                        <div class="flex gap-3">
                            <?php if (!empty($profile['github'])): ?>
                            <a href="<?php echo $profile['github']; ?>" target="_blank" class="p-3 rounded-full bg-gray-100 hover:bg-blue-600 hover:text-white transition-all duration-300">
                                <i class="fab fa-github text-xl"></i>
                            </a>
                            <?php endif; ?>
                            <?php if (!empty($profile['linkedin'])): ?>
                            <a href="<?php echo $profile['linkedin']; ?>" target="_blank" class="p-3 rounded-full bg-gray-100 hover:bg-blue-600 hover:text-white transition-all duration-300">
                                <i class="fab fa-linkedin text-xl"></i>
                            </a>
                            <?php endif; ?>
                            <?php if (!empty($profile['twitter'])): ?>
                            <a href="<?php echo $profile['twitter']; ?>" target="_blank" class="p-3 rounded-full bg-gray-100 hover:bg-blue-600 hover:text-white transition-all duration-300">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Image -->
                <div class="relative fade-in-up" style="animation-delay: 0.2s">
                    <div class="relative z-10">
                        <div class="w-full max-w-lg mx-auto">
                            <div class="relative">
                                <!-- Decorative Elements -->
                                <div class="absolute -top-6 -left-6 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse-slow"></div>
                                <div class="absolute -bottom-6 -right-6 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse-slow" style="animation-delay: 2s"></div>
                                
                                <!-- Main Image -->
                                <div class="relative bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl p-1">
                                    <?php if (!empty($profile['profile_image'])): ?>
                                    <img src="<?php echo BASE_URL; ?>/public/uploads/profile/<?php echo $profile['profile_image']; ?>" alt="<?php echo htmlspecialchars($profile['name']); ?>" class="w-full h-auto rounded-2xl object-cover shadow-2xl">
                                    <?php else: ?>
                                    <img src="<?php echo BASE_URL; ?>/public/assets/images/shivam.jpg" alt="Profile" class="w-full h-auto rounded-2xl object-cover shadow-2xl">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
  <!-- About Section -->
<section id="about" class="relative py-28 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-white to-gray-50 overflow-hidden">
    
    <!-- Gradient Blob -->
    <div class="absolute -top-32 -right-32 w-96 h-96 bg-blue-400/20 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto relative">
        
        <!-- Heading -->
        <div class="text-center mb-20" data-aos="fade-up">
            <span class="inline-block mb-4 px-4 py-1 text-sm font-semibold text-blue-600 bg-blue-100 rounded-full">
                About Me
            </span>
            <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                Building Ideas Into Reality
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Passionate developer crafting scalable, modern, and impactful digital experiences
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-16 items-center">
            
            <!-- LEFT -->
            <div data-aos="fade-right">
                <p class="text-lg text-gray-700 leading-relaxed mb-8">
                    <?php echo nl2br(htmlspecialchars($profile['bio'] ?? '')); ?>
                </p>

                <!-- Info -->
                <div class="grid sm:grid-cols-2 gap-6 mb-8">
                    <div class="p-5 bg-white rounded-xl border shadow-sm hover:shadow-md transition">
                        <p class="text-xs uppercase tracking-wide text-gray-500">Email</p>
                        <p class="font-semibold"><?php echo htmlspecialchars($profile['email'] ?? ''); ?></p>
                    </div>
                    <div class="p-5 bg-white rounded-xl border shadow-sm hover:shadow-md transition">
                        <p class="text-xs uppercase tracking-wide text-gray-500">Phone</p>
                        <p class="font-semibold"><?php echo htmlspecialchars($profile['phone'] ?? ''); ?></p>
                    </div>
                    <div class="p-5 bg-white rounded-xl border shadow-sm hover:shadow-md transition">
                        <p class="text-xs uppercase tracking-wide text-gray-500">Location</p>
                        <p class="font-semibold"><?php echo htmlspecialchars($profile['address'] ?? ''); ?></p>
                    </div>
                    <div class="p-5 bg-white rounded-xl border shadow-sm hover:shadow-md transition">
                        <p class="text-xs uppercase tracking-wide text-gray-500">Experience</p>
                        <p class="font-semibold">2+ Years</p>
                    </div>
                </div>

                <!-- CTA -->
                <?php if (!empty($profile['resume_path'])): ?>
                        <a href="<?php echo BASE_URL; ?>/public/uploads/resume/<?php echo $profile['resume_path']; ?>" download class="inline-flex items-center border-2 border-gray-900 text-gray-900 hover:bg-gray-900 hover:text-white px-8 py-4 rounded-lg text-base font-medium transition-all duration-300">
                            <i class="fas fa-download mr-2"></i>
                            Download CV
                        </a>
                        <?php endif; ?>
            </div>

            <!-- RIGHT STATS -->
            <div class="grid grid-cols-2 gap-6" data-aos="fade-left">
                <?php 
                $stats = [
                    ['label' => 'Years Experience', 'value' => 2, 'icon' => 'fa-calendar-alt', 'color' => 'blue'],
                    ['label' => 'Happy Clients', 'value' => 50, 'icon' => 'fa-users', 'color' => 'green'],
                    ['label' => 'Projects Done', 'value' => 10, 'icon' => 'fa-project-diagram', 'color' => 'purple'],
                    ['label' => 'Technologies', 'value' => 10, 'icon' => 'fa-code', 'color' => 'pink'],
                ];
                foreach ($stats as $stat): ?>
                
                <div class="bg-white p-8 rounded-2xl border shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all">
                    <div class="w-14 h-14 flex items-center justify-center rounded-xl mb-4 bg-<?php echo $stat['color']; ?>-100 text-<?php echo $stat['color']; ?>-600">
                        <i class="fas <?php echo $stat['icon']; ?> text-2xl"></i>
                    </div>
                    <div class="text-4xl font-bold text-gray-900">
                        <span data-count="<?php echo $stat['value']; ?>">0</span>+
                    </div>
                    <div class="text-sm text-gray-600 mt-1"><?php echo $stat['label']; ?></div>
                </div>

                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>

    <!-- Skills Section -->
    <section id="skills" class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">Skills & Expertise</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Technologies and tools I work with</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php 
                if (!empty($skills)):
                    $colors = ['blue', 'green', 'purple', 'pink', 'indigo', 'red'];
                    $colorIndex = 0;
                    foreach ($skills as $category => $categorySkills):
                        foreach ($categorySkills as $skill):
                            $color = $colors[$colorIndex % count($colors)];
                            $proficiencyMap = [
                                'Beginner' => 40,
                                'Intermediate' => 70,
                                'Expert' => 90
                            ];
                            $proficiency = $proficiencyMap[$skill['proficiency']] ?? 0;
                ?>
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-semibold text-gray-900"><?php echo htmlspecialchars($skill['name']); ?></h3>
                        <span class="text-sm font-medium text-<?php echo $color; ?>-600"><?php echo $proficiency; ?>%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-<?php echo $color; ?>-500 to-<?php echo $color; ?>-600 h-2 rounded-full transition-all duration-500" style="width: <?php echo $proficiency; ?>%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2"><?php echo htmlspecialchars($category); ?></p>
                </div>
                <?php 
                            $colorIndex++;
                        endforeach;
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section id="experience" class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">Experience & Education</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">My professional journey and academic background</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Experience -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-briefcase text-blue-600 mr-3"></i>
                        Work Experience
                    </h3>
                    <div class="space-y-6">
                        <?php if (!empty($experience)): ?>
                            <?php foreach ($experience as $exp): ?>
                            <div class="bg-gray-50 p-6 rounded-xl card-hover">
                                <h4 class="text-lg font-semibold text-gray-900"><?php echo htmlspecialchars($exp['position']); ?></h4>
                                <p class="text-blue-600 font-medium mt-1"><?php echo htmlspecialchars($exp['company']); ?></p>
                                <p class="text-sm text-gray-500 mt-2">
                                    <?php 
                                    echo date('M Y', strtotime($exp['start_date'])); 
                                    echo ' - ';
                                    echo $exp['end_date'] ? date('M Y', strtotime($exp['end_date'])) : 'Present';
                                    ?>
                                </p>
                                <?php if (!empty($exp['description'])): ?>
                                <p class="text-gray-600 mt-3 text-sm"><?php echo htmlspecialchars($exp['description']); ?></p>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-gray-500">Add your work experience from the admin panel.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Education -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-graduation-cap text-purple-600 mr-3"></i>
                        Education
                    </h3>
                    <div class="space-y-6">
                        <?php if (!empty($education)): ?>
                            <?php foreach ($education as $edu): ?>
                            <div class="bg-gray-50 p-6 rounded-xl card-hover">
                                <h4 class="text-lg font-semibold text-gray-900"><?php echo htmlspecialchars($edu['degree']); ?></h4>
                                <p class="text-purple-600 font-medium mt-1"><?php echo htmlspecialchars($edu['institution']); ?></p>
                                <p class="text-sm text-gray-500 mt-2">
                                    <?php 
                                    echo date('Y', strtotime($edu['start_date'])); 
                                    echo ' - ';
                                    echo $edu['end_date'] ? date('Y', strtotime($edu['end_date'])) : 'Present';
                                    ?>
                                </p>
                                <?php if (!empty($edu['cgpa'])): ?>
                                <p class="text-sm text-gray-600 mt-2">CGPA: <span class="font-semibold"><?php echo htmlspecialchars($edu['cgpa']); ?></span></p>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-gray-500">Add your education details from the admin panel.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <?php if (!empty($services)): ?>
    <section id="services" class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">My Services</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">What I can do for you</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php 
                $iconClasses = ['fa-code', 'fa-wordpress', 'fa-paint-brush', 'fa-chart-line', 'fa-mobile-alt', 'fa-cogs'];
                $iconIndex = 0;
                foreach ($services as $service): 
                ?>
                <div class="bg-gradient-to-br from-gray-50 to-blue-50 p-8 rounded-xl card-hover">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mb-6 text-white text-2xl">
                        <i class="fas <?php echo !empty($service['icon']) ? htmlspecialchars($service['icon']) : $iconClasses[$iconIndex % count($iconClasses)]; ?>"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3"><?php echo htmlspecialchars($service['title']); ?></h3>
                    <p class="text-gray-600 leading-relaxed"><?php echo htmlspecialchars($service['description']); ?></p>
                </div>
                <?php 
                    $iconIndex++;
                endforeach; 
                ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Projects Section -->
    <section id="projects" class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">Featured Projects</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Showcasing my recent work and achievements</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if (!empty($projects)): ?>
                    <?php foreach ($projects as $project): ?>
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm card-hover">
                        <div class="relative h-48 overflow-hidden group">
                            <?php if (!empty($project['image'])): ?>
                            <img src="<?php echo BASE_URL; ?>/public/uploads/projects/<?php echo $project['image']; ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            <?php else: ?>
                            <div class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                <i class="fas fa-project-diagram text-white text-5xl"></i>
                            </div>
                            <?php endif; ?>
                            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-4">
                                <?php if (!empty($project['project_link'])): ?>
                                <a href="<?php echo $project['project_link']; ?>" target="_blank" class="p-3 bg-white rounded-full hover:bg-blue-600 hover:text-white transition-colors">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                <?php endif; ?>
                                <?php if (!empty($project['github_link'])): ?>
                                <a href="<?php echo $project['github_link']; ?>" target="_blank" class="p-3 bg-white rounded-full hover:bg-blue-600 hover:text-white transition-colors">
                                    <i class="fab fa-github"></i>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2"><?php echo htmlspecialchars($project['title']); ?></h3>
                            <p class="text-gray-600 text-sm mb-4"><?php echo htmlspecialchars(substr($project['description'], 0, 120)); ?>...</p>
                            <?php if (!empty($project['technologies'])): ?>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach (array_slice(explode(',', $project['technologies']), 0, 4) as $tech): ?>
                                <span class="text-xs px-3 py-1 bg-blue-50 text-blue-600 rounded-full font-medium"><?php echo htmlspecialchars(trim($tech)); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500 text-lg">Add your projects from the admin panel.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php if (!empty($testimonials)): ?>
    <!-- Testimonials Section -->
    <section id="testimonials" class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">Client Testimonials</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">What clients say about my work</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($testimonials as $testimonial): ?>
                <div class="bg-gradient-to-br from-blue-50 to-purple-50 p-8 rounded-xl card-hover">
                    <div class="flex items-center mb-4">
                        <?php if (!empty($testimonial['client_photo'])): ?>
                        <img src="<?php echo BASE_URL; ?>/public/uploads/testimonials/<?php echo $testimonial['client_photo']; ?>" alt="<?php echo htmlspecialchars($testimonial['client_name']); ?>" class="w-16 h-16 rounded-full object-cover border-4 border-white shadow-md">
                        <?php else: ?>
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-xl border-4 border-white shadow-md">
                            <?php echo strtoupper(substr($testimonial['client_name'], 0, 1)); ?>
                        </div>
                        <?php endif; ?>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-900"><?php echo htmlspecialchars($testimonial['client_name']); ?></h4>
                            <p class="text-sm text-gray-600"><?php echo htmlspecialchars($testimonial['client_position'] ?? $testimonial['company'] ?? ''); ?></p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic leading-relaxed">"<?php echo htmlspecialchars($testimonial['testimonial'] ?? $testimonial['content'] ?? ''); ?>"</p>
                    <?php if (!empty($testimonial['rating'])): ?>
                    <div class="flex mt-4 text-yellow-400">
                        <?php for($i = 0; $i < intval($testimonial['rating']); $i++): ?>
                        <i class="fas fa-star"></i>
                        <?php endfor; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Contact Section -->
    <section id="contact" class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-bold mb-4">Get In Touch</h2>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">Let's discuss your project and bring your ideas to life</p>
            </div>

            <div class="grid md:grid-cols-2 gap-12">
                <!-- Contact Info -->
                <div class="space-y-8">
                    <div>
                        <h3 class="text-2xl font-bold mb-6">Contact Information</h3>
                        <div class="space-y-4">
                            <?php if (!empty($profile['email'])): ?>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-envelope text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-sm">Email</p>
                                    <p class="font-medium"><?php echo htmlspecialchars($profile['email']); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if (!empty($profile['phone'])): ?>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-phone text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-sm">Phone</p>
                                    <p class="font-medium"><?php echo htmlspecialchars($profile['phone']); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if (!empty($profile['address'])): ?>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-sm">Location</p>
                                    <p class="font-medium"><?php echo htmlspecialchars($profile['address']); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-4">Follow Me</h4>
                        <div class="flex gap-3">
                            <?php if (!empty($profile['github'])): ?>
                            <a href="<?php echo $profile['github']; ?>" target="_blank" class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition-colors">
                                <i class="fab fa-github text-xl"></i>
                            </a>
                            <?php endif; ?>
                            <?php if (!empty($profile['linkedin'])): ?>
                            <a href="<?php echo $profile['linkedin']; ?>" target="_blank" class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition-colors">
                                <i class="fab fa-linkedin text-xl"></i>
                            </a>
                            <?php endif; ?>
                            <?php if (!empty($profile['twitter'])): ?>
                            <a href="<?php echo $profile['twitter']; ?>" target="_blank" class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition-colors">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="bg-gray-800 p-8 rounded-xl">
                    <form id="contactForm" class="space-y-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium mb-2">Your Name</label>
                                <input type="text" name="name" required class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Your Email</label>
                                <input type="email" name="email" required class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent outline-none transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Subject</label>
                            <input type="text" name="subject" class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Message</label>
                            <textarea name="message" rows="5" required class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent outline-none transition-all resize-none"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                            Send Message
                            <i class="fas fa-paper-plane"></i>
                        </button>
                        <div id="formMessage" class="hidden mt-4 p-4 rounded-lg"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-950 text-gray-300 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <p class="text-sm">© <?php echo date('Y'); ?> <?php echo htmlspecialchars($profile['name'] ?? 'Portfolio'); ?>. All rights reserved.</p>
                <div class="flex gap-6 mt-4 md:mt-0">
                    <a href="#home" class="text-sm hover:text-blue-600 transition-colors">Home</a>
                    <a href="#about" class="text-sm hover:text-blue-600 transition-colors">About</a>
                    <a href="#projects" class="text-sm hover:text-blue-600 transition-colors">Projects</a>
                    <a href="#contact" class="text-sm hover:text-blue-600 transition-colors">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-8 right-8 w-12 h-12 bg-blue-600 text-white rounded-full shadow-lg opacity-0 invisible transition-all duration-300 hover:bg-blue-700 flex items-center justify-center z-50">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Navigation
        const navbar = document.getElementById('navbar');
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const backToTop = document.getElementById('backToTop');
        
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('bg-white', 'shadow-sm');
                navbar.classList.remove('bg-transparent');
                backToTop.classList.remove('opacity-0', 'invisible');
            } else {
                navbar.classList.remove('bg-white', 'shadow-sm');
                navbar.classList.add('bg-transparent');
                backToTop.classList.add('opacity-0', 'invisible');
            }
        });
        
        // Mobile menu toggle
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
        
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offset = 80;
                    const targetPosition = target.offsetTop - offset;
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                    mobileMenu.classList.add('hidden');
                }
            });
        });
        
        // Back to top
        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
        
        // Contact form
        document.getElementById('contactForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const form = e.target;
            const formData = new FormData(form);
            const submitBtn = form.querySelector('button[type="submit"]');
            const formMessage = document.getElementById('formMessage');
            const btnText = submitBtn.innerHTML;
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            formMessage.classList.add('hidden');
            
            try {
                const response = await fetch('<?php echo BASE_URL; ?>/contact', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                formMessage.classList.remove('hidden');
                if (data.success) {
                    formMessage.className = 'mt-4 p-4 bg-green-600 text-white rounded-lg';
                    formMessage.textContent = data.message || 'Message sent successfully!';
                    form.reset();
                } else {
                    formMessage.className = 'mt-4 p-4 bg-red-600 text-white rounded-lg';
                    formMessage.textContent = data.message || 'Failed to send message. Please try again.';
                }
            } catch (error) {
                formMessage.classList.remove('hidden');
                formMessage.className = 'mt-4 p-4 bg-red-600 text-white rounded-lg';
                formMessage.textContent = 'An error occurred. Please try again.';
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = btnText;
                setTimeout(() => formMessage.classList.add('hidden'), 5000);
            }
        });
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 900,
    once: true,
    easing: 'ease-out-cubic'
  });
</script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const counters = document.querySelectorAll('[data-count]');
  const speed = 80;

  counters.forEach(counter => {
    const updateCount = () => {
      const target = +counter.getAttribute('data-count');
      const count = +counter.innerText;
      const inc = Math.ceil(target / speed);

      if (count < target) {
        counter.innerText = count + inc;
        setTimeout(updateCount, 20);
      } else {
        counter.innerText = target;
      }
    };
    updateCount();
  });
});
</script>
</body>
</html>
