<div class="content-section">
    <h1><?php echo isset($item) ? 'Edit' : 'Add'; ?> Education</h1>
    <form action="<?php echo ADMIN_URL; ?>/ajax/education-save.php" method="POST" data-ajax="true">
        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
        <?php if (isset($item)): ?>
        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
        <?php endif; ?>
        <div class="form-group">
            <label for="degree">Degree *</label>
            <input type="text" id="degree" name="degree" class="form-control" value="<?php echo htmlspecialchars($item['degree'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="institution">Institution *</label>
            <input type="text" id="institution" name="institution" class="form-control" value="<?php echo htmlspecialchars($item['institution'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="cgpa">CGPA/Percentage</label>
            <input type="text" id="cgpa" name="cgpa" class="form-control" value="<?php echo htmlspecialchars($item['cgpa'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label for="year">Year *</label>
            <input type="number" id="year" name="year" class="form-control" value="<?php echo $item['year'] ?? ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control"><?php echo htmlspecialchars($item['description'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label for="display_order">Display Order</label>
            <input type="number" id="display_order" name="display_order" class="form-control" value="<?php echo $item['display_order'] ?? 0; ?>">
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="<?php echo ADMIN_URL; ?>?page=education" class="btn">Cancel</a>
        </div>
    </form>
</div>
