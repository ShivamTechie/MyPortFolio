<div class="content-section">
    <h1><?php echo isset($item) ? 'Edit' : 'Add'; ?> Service</h1>
    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
        <div class="form-group">
            <label for="title">Service Title *</label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($item['title'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control"><?php echo htmlspecialchars($item['description'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label for="icon">Icon (Font Awesome name without 'fa-')</label>
            <input type="text" id="icon" name="icon" class="form-control" value="<?php echo htmlspecialchars($item['icon'] ?? ''); ?>" placeholder="code, wordpress, tools">
        </div>
        <div class="form-group">
            <label for="display_order">Display Order</label>
            <input type="number" id="display_order" name="display_order" class="form-control" value="<?php echo $item['display_order'] ?? 0; ?>">
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="<?php echo ADMIN_URL; ?>?page=services" class="btn">Cancel</a>
        </div>
    </form>
</div>
