<div class="content-section">
    <h1><?php echo isset($item) ? 'Edit' : 'Add'; ?> Project</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
        <div class="form-group">
            <label for="title">Project Title *</label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($item['title'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control"><?php echo htmlspecialchars($item['description'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label for="technologies">Technologies (comma-separated)</label>
            <input type="text" id="technologies" name="technologies" class="form-control" value="<?php echo htmlspecialchars($item['technologies'] ?? ''); ?>" placeholder="PHP, MySQL, JavaScript">
        </div>
        <div class="form-group">
            <label for="project_link">Project Link</label>
            <input type="url" id="project_link" name="project_link" class="form-control" value="<?php echo htmlspecialchars($item['project_link'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label for="github_link">GitHub Link</label>
            <input type="url" id="github_link" name="github_link" class="form-control" value="<?php echo htmlspecialchars($item['github_link'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label for="image">Project Image</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
            <?php if (isset($item) && $item['image']): ?>
                <div class="image-preview"><img src="<?php echo BASE_URL; ?>/public/uploads/projects/<?php echo $item['image']; ?>"></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="display_order">Display Order</label>
            <input type="number" id="display_order" name="display_order" class="form-control" value="<?php echo $item['display_order'] ?? 0; ?>">
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="<?php echo ADMIN_URL; ?>?page=projects" class="btn">Cancel</a>
        </div>
    </form>
</div>
