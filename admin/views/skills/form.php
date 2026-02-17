<div class="content-section">
    <h1><?php echo isset($item) ? 'Edit' : 'Add'; ?> Skill</h1>
    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
        <div class="form-group">
            <label for="name">Skill Name *</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($item['name'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="category">Category *</label>
            <input type="text" id="category" name="category" class="form-control" value="<?php echo htmlspecialchars($item['category'] ?? ''); ?>" required placeholder="e.g., Frontend, Backend, Database">
        </div>
        <div class="form-group">
            <label for="proficiency">Proficiency</label>
            <select id="proficiency" name="proficiency" class="form-control">
                <option value="Beginner" <?php echo isset($item) && $item['proficiency'] == 'Beginner' ? 'selected' : ''; ?>>Beginner</option>
                <option value="Intermediate" <?php echo isset($item) && $item['proficiency'] == 'Intermediate' ? 'selected' : ''; ?>>Intermediate</option>
                <option value="Expert" <?php echo isset($item) && $item['proficiency'] == 'Expert' ? 'selected' : ''; ?>>Expert</option>
            </select>
        </div>
        <div class="form-group">
            <label for="display_order">Display Order</label>
            <input type="number" id="display_order" name="display_order" class="form-control" value="<?php echo $item['display_order'] ?? 0; ?>">
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="<?php echo ADMIN_URL; ?>?page=skills" class="btn">Cancel</a>
        </div>
    </form>
</div>
