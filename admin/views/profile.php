<div class="content-section profile-management">
    <div class="page-header">
        <div>
            <h1><i class="fas fa-user-circle"></i> Profile Management</h1>
            <p class="text-muted">Update your personal and professional information</p>
        </div>
    </div>
    
    <form id="profileForm" action="<?php echo ADMIN_URL; ?>/ajax/profile-update.php" method="POST" enctype="multipart/form-data" data-ajax="true">
        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
        
        <!-- Personal Information Card -->
        <div class="form-card">
            <div class="card-header">
                <h3><i class="fas fa-user"></i> Personal Information</h3>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name"><i class="fas fa-signature"></i> Full Name *</label>
                        <input type="text" id="name" name="name" class="form-control" 
                               placeholder="Enter your full name"
                               value="<?php echo htmlspecialchars($profile['name'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="title"><i class="fas fa-briefcase"></i> Professional Title *</label>
                        <input type="text" id="title" name="title" class="form-control" 
                               placeholder="e.g., Full Stack Developer"
                               value="<?php echo htmlspecialchars($profile['title'] ?? ''); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="bio"><i class="fas fa-align-left"></i> Professional Bio</label>
                    <textarea id="bio" name="bio" class="form-control" rows="5" 
                              placeholder="Tell us about your professional background and expertise..."><?php echo htmlspecialchars($profile['bio'] ?? ''); ?></textarea>
                    <small class="form-text text-muted">Write a compelling summary of your skills and experience</small>
                </div>
            </div>
        </div>

        <!-- Contact Information Card -->
        <div class="form-card">
            <div class="card-header">
                <h3><i class="fas fa-address-book"></i> Contact Information</h3>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email"><i class="fas fa-envelope"></i> Email Address *</label>
                        <input type="email" id="email" name="email" class="form-control" 
                               placeholder="your.email@example.com"
                               value="<?php echo htmlspecialchars($profile['email'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone"><i class="fas fa-phone"></i> Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="form-control" 
                               placeholder="+91 1234567890"
                               value="<?php echo htmlspecialchars($profile['phone'] ?? ''); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="address"><i class="fas fa-map-marker-alt"></i> Address</label>
                    <input type="text" id="address" name="address" class="form-control" 
                           placeholder="City, State, Country"
                           value="<?php echo htmlspecialchars($profile['address'] ?? ''); ?>">
                </div>
            </div>
        </div>

        <!-- Social Links Card -->
        <div class="form-card">
            <div class="card-header">
                <h3><i class="fas fa-share-alt"></i> Social Media Links</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="linkedin"><i class="fab fa-linkedin"></i> LinkedIn Profile</label>
                    <input type="url" id="linkedin" name="linkedin" class="form-control" 
                           placeholder="https://linkedin.com/in/yourprofile"
                           value="<?php echo htmlspecialchars($profile['linkedin'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="github"><i class="fab fa-github"></i> GitHub Profile</label>
                    <input type="url" id="github" name="github" class="form-control" 
                           placeholder="https://github.com/yourusername"
                           value="<?php echo htmlspecialchars($profile['github'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="twitter"><i class="fab fa-twitter"></i> Twitter Profile</label>
                    <input type="url" id="twitter" name="twitter" class="form-control" 
                           placeholder="https://twitter.com/yourusername"
                           value="<?php echo htmlspecialchars($profile['twitter'] ?? ''); ?>">
                </div>
            </div>
        </div>

        <!-- Media Files Card -->
        <div class="form-card">
            <div class="card-header">
                <h3><i class="fas fa-image"></i> Profile Media</h3>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="profile_image"><i class="fas fa-camera"></i> Profile Image</label>
                        <div class="custom-file-upload">
                            <input type="file" id="profile_image" name="profile_image" class="form-control-file" accept="image/*">
                            <label for="profile_image" class="file-label">
                                <i class="fas fa-cloud-upload-alt"></i> Choose Image
                            </label>
                        </div>
                        <small class="form-text text-muted">Recommended: Square image, at least 400x400px</small>
                        <?php if (!empty($profile['profile_image'])): ?>
                            <div class="current-image-preview">
                                <p class="preview-label">Current Image:</p>
                                <img src="<?php echo BASE_URL; ?>/public/uploads/profile/<?php echo $profile['profile_image']; ?>" alt="Current Profile Image">
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="resume"><i class="fas fa-file-pdf"></i> Resume (PDF)</label>
                        <div class="custom-file-upload">
                            <input type="file" id="resume" name="resume" class="form-control-file" accept=".pdf">
                            <label for="resume" class="file-label">
                                <i class="fas fa-file-upload"></i> Choose PDF
                            </label>
                        </div>
                        <small class="form-text text-muted">Upload your latest resume in PDF format</small>
                        <?php if (!empty($profile['resume_path'])): ?>
                            <div class="current-file-info">
                                <i class="fas fa-file-pdf text-danger"></i>
                                <a href="<?php echo BASE_URL; ?>/public/uploads/resume/<?php echo $profile['resume_path']; ?>" target="_blank" class="file-link">
                                    View Current Resume <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions-sticky">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-save"></i> Update Profile
            </button>
            <button type="reset" class="btn btn-secondary btn-lg">
                <i class="fas fa-undo"></i> Reset Changes
            </button>
        </div>
    </form>
</div>
