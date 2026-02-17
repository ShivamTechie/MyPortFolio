<div class="content-section">
    <div class="section-header">
        <h1>Services Management</h1>
        <a href="<?php echo ADMIN_URL; ?>?page=services&action=add" class="btn btn-primary">Add New Service</a>
    </div>
    <div class="table-responsive">
        <table class="data-table">
            <thead><tr><th>Icon</th><th>Title</th><th>Description</th><th>Order</th><th>Actions</th></tr></thead>
            <tbody>
                <?php if (!empty($items)): foreach ($items as $item): ?>
                <tr>
                    <td><i class="fas fa-<?php echo htmlspecialchars($item['icon']); ?>"></i></td>
                    <td><?php echo htmlspecialchars($item['title']); ?></td>
                    <td><?php echo htmlspecialchars(substr($item['description'], 0, 60)) . '...'; ?></td>
                    <td><?php echo $item['display_order']; ?></td>
                    <td class="action-btns">
                        <a href="<?php echo ADMIN_URL; ?>?page=services&action=edit&id=<?php echo $item['id']; ?>" class="btn btn-small btn-primary">Edit</a>
                        <a href="<?php echo ADMIN_URL; ?>?page=services&action=delete&id=<?php echo $item['id']; ?>" class="btn btn-small btn-danger" onclick="return confirmDelete()">Delete</a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="5" class="text-center">No services added yet</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
