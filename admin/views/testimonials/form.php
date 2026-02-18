<div class="content-section">
    <h1><?php echo isset($item) ? 'Edit' : 'Add'; ?> Testimonial</h1>
    <form action="<?php echo ADMIN_URL; ?>/ajax/testimonial-save.php" method="POST" data-ajax="true">
        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
        <?php if (isset($item)): ?>
        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
        <?php endif; ?>
        <div class="form-group">
            <label for="client_name">Client Name *</label>
            <input type="text" id="client_name" name="client_name" class="form-control" value="<?php echo htmlspecialchars($item['client_name'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="company">Company</label>
            <input type="text" id="company" name="company" class="form-control" value="<?php echo htmlspecialchars($item['company'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label for="content">Testimonial Content *</label>
            <textarea id="content" name="content" class="form-control" required><?php echo htmlspecialchars($item['content'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label for="rating">Rating (1-5)</label>
            <select id="rating" name="rating" class="form-control">
                <?php for($i=1; $i<=5; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php echo isset($item) && $item['rating'] == $i ? 'selected' : ''; ?>><?php echo $i; ?> Star<?php echo $i>1 ? 's' : ''; ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="display_order">Display Order</label>
            <input type="number" id="display_order" name="display_order" class="form-control" value="<?php echo $item['display_order'] ?? 0; ?>">
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="<?php echo ADMIN_URL; ?>?page=testimonials" class="btn">Cancel</a>
        </div>
    </form>
</div>
