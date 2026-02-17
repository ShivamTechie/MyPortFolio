<div class="content-section">
    <div class="section-header">
        <h1>Testimonials Management</h1>
        <a href="<?php echo ADMIN_URL; ?>?page=testimonials&action=add" class="btn btn-primary">Add New Testimonial</a>
    </div>
    <div class="table-responsive">
        <table class="data-table">
            <thead><tr><th>Client Name</th><th>Company</th><th>Rating</th><th>Content</th><th>Order</th><th>Actions</th></tr></thead>
            <tbody>
                <?php if (!empty($items)): foreach ($items as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['client_name']); ?></td>
                    <td><?php echo htmlspecialchars($item['company']); ?></td>
                    <td><?php echo str_repeat('⭐', $item['rating']); ?></td>
                    <td><?php echo htmlspecialchars(substr($item['content'], 0, 50)) . '...'; ?></td>
                    <td><?php echo $item['display_order']; ?></td>
                    <td class="action-btns">
                        <a href="<?php echo ADMIN_URL; ?>?page=testimonials&action=edit&id=<?php echo $item['id']; ?>" class="btn btn-small btn-primary">Edit</a>
                        <a href="<?php echo ADMIN_URL; ?>?page=testimonials&action=delete&id=<?php echo $item['id']; ?>" class="btn btn-small btn-danger" onclick="return confirmDelete()">Delete</a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="6" class="text-center">No testimonials added yet</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
