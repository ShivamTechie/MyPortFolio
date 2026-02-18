<div class="content-section">
    <h1>Profile Management</h1>
    
    <form id="profileForm" action="<?php echo ADMIN_URL; ?>?page=profile" method="POST" enctype="multipart/form-data" data-ajax="true">
        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
        
        <div class="form-group">
            <label for="name">Full Name *</label>
            <input type="text" id="name" name="name" class="form-control" 
                   value="<?php echo htmlspecialchars($profile['name'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="title">Professional Title *</label>
            <input type="text" id="title" name="title" class="form-control" 
                   value="<?php echo htmlspecialchars($profile['title'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea id="bio" name="bio" class="form-control"><?php echo htmlspecialchars($profile['bio'] ?? ''); ?></textarea>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" class="form-control" 
                   value="<?php echo htmlspecialchars($profile['phone'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" id="email" name="email" class="form-control" 
                   value="<?php echo htmlspecialchars($profile['email'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" class="form-control" 
                   value="<?php echo htmlspecialchars($profile['address'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="linkedin">LinkedIn URL</label>
            <input type="url" id="linkedin" name="linkedin" class="form-control" 
                   value="<?php echo htmlspecialchars($profile['linkedin'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="github">GitHub URL</label>
            <input type="url" id="github" name="github" class="form-control" 
                   value="<?php echo htmlspecialchars($profile['github'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="twitter">Twitter URL</label>
            <input type="url" id="twitter" name="twitter" class="form-control" 
                   value="<?php echo htmlspecialchars($profile['twitter'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="profile_image">Profile Image</label>
            <input type="file" id="profile_image" name="profile_image" class="form-control" accept="image/*">
            <?php if (!empty($profile['profile_image'])): ?>
                <div class="image-preview">
                    <img src="<?php echo BASE_URL; ?>/public/uploads/profile/<?php echo $profile['profile_image']; ?>" alt="Current Profile Image">
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="resume">Resume (PDF)</label>
            <input type="file" id="resume" name="resume" class="form-control" accept=".pdf">
            <?php if (!empty($profile['resume_path'])): ?>
                <p style="margin-top: 10px;">Current: <a href="<?php echo BASE_URL; ?>/public/uploads/resume/<?php echo $profile['resume_path']; ?>" target="_blank">View Resume</a></p>
            <?php endif; ?>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </div>
    </form>
</div>
