<div class="content-section">
    <h1><?php echo isset($item) ? 'Edit' : 'Add'; ?> Experience</h1>

    <form action="<?php echo ADMIN_URL; ?>/ajax/experience-save.php" method="POST" data-ajax="true">
        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
        <?php if (isset($item)): ?>
        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
        <?php endif; ?>

        <div class="form-group">
            <label for="company">Company *</label>
            <input type="text" id="company" name="company" class="form-control" 
                   value="<?php echo htmlspecialchars($item['company'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="position">Position *</label>
            <input type="text" id="position" name="position" class="form-control" 
                   value="<?php echo htmlspecialchars($item['position'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="start_date">Start Date *</label>
            <input type="date" id="start_date" name="start_date" class="form-control" 
                   value="<?php echo $item['start_date'] ?? ''; ?>" required>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_current" value="1" 
                       <?php echo isset($item) && $item['is_current'] ? 'checked' : ''; ?>>
                Currently working here
            </label>
        </div>

        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" id="end_date" name="end_date" class="form-control" 
                   value="<?php echo $item['end_date'] ?? ''; ?>">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control"><?php echo htmlspecialchars($item['description'] ?? ''); ?></textarea>
        </div>

        <div class="form-group">
            <label for="display_order">Display Order</label>
            <input type="number" id="display_order" name="display_order" class="form-control" 
                   value="<?php echo $item['display_order'] ?? 0; ?>">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="<?php echo ADMIN_URL; ?>?page=experience" class="btn">Cancel</a>
        </div>
    </form>
</div>
