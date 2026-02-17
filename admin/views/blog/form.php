<div class="content-section">
    <h1><?php echo isset($item) ? 'Edit' : 'Add'; ?> Blog Post</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
        <div class="form-group">
            <label for="title">Post Title *</label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($item['title'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="excerpt">Excerpt</label>
            <textarea id="excerpt" name="excerpt" class="form-control" rows="3"><?php echo htmlspecialchars($item['excerpt'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label for="content">Content *</label>
            <textarea id="content" name="content" class="form-control" rows="12" required><?php echo htmlspecialchars($item['content'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label for="featured_image">Featured Image</label>
            <input type="file" id="featured_image" name="featured_image" class="form-control" accept="image/*">
            <?php if (isset($item) && $item['featured_image']): ?>
                <div class="image-preview"><img src="<?php echo BASE_URL; ?>/public/uploads/blog/<?php echo $item['featured_image']; ?>"></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control">
                <option value="draft" <?php echo isset($item) && $item['status'] == 'draft' ? 'selected' : ''; ?>>Draft</option>
                <option value="published" <?php echo isset($item) && $item['status'] == 'published' ? 'selected' : ''; ?>>Published</option>
            </select>
        </div>
        <div class="form-group">
            <label for="meta_title">Meta Title (SEO)</label>
            <input type="text" id="meta_title" name="meta_title" class="form-control" value="<?php echo htmlspecialchars($item['meta_title'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label for="meta_description">Meta Description (SEO)</label>
            <textarea id="meta_description" name="meta_description" class="form-control" rows="2"><?php echo htmlspecialchars($item['meta_description'] ?? ''); ?></textarea>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="<?php echo ADMIN_URL; ?>?page=blog" class="btn">Cancel</a>
        </div>
    </form>
</div>
