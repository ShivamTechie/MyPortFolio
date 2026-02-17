<div class="content-section">
    <div class="section-header">
        <h1>Skills Management</h1>
        <a href="<?php echo ADMIN_URL; ?>?page=skills&action=add" class="btn btn-primary">Add New Skill</a>
    </div>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr><th>Skill Name</th><th>Category</th><th>Proficiency</th><th>Order</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php if (!empty($items)): foreach ($items as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo htmlspecialchars($item['category']); ?></td>
                    <td><?php echo $item['proficiency']; ?></td>
                    <td><?php echo $item['display_order']; ?></td>
                    <td class="action-btns">
                        <a href="<?php echo ADMIN_URL; ?>?page=skills&action=edit&id=<?php echo $item['id']; ?>" class="btn btn-small btn-primary">Edit</a>
                        <a href="<?php echo ADMIN_URL; ?>?page=skills&action=delete&id=<?php echo $item['id']; ?>" class="btn btn-small btn-danger" onclick="return confirmDelete()">Delete</a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="5" class="text-center">No skills added yet</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
