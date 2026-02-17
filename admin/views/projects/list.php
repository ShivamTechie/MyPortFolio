<div class="content-section">
    <div class="section-header">
        <h1>Projects Management</h1>
        <a href="<?php echo ADMIN_URL; ?>?page=projects&action=add" class="btn btn-primary">Add New Project</a>
    </div>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr><th>Image</th><th>Title</th><th>Technologies</th><th>Order</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php if (!empty($items)): foreach ($items as $item): ?>
                <tr>
                    <td>
                        <?php if ($item['image']): ?>
                            <img src="<?php echo BASE_URL; ?>/public/uploads/projects/<?php echo $item['image']; ?>" style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px;">
                        <?php else: ?>
                            <span style="color: #999;">No image</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($item['title']); ?></td>
                    <td><?php echo htmlspecialchars(substr($item['technologies'], 0, 50)); ?></td>
                    <td><?php echo $item['display_order']; ?></td>
                    <td class="action-btns">
                        <a href="<?php echo ADMIN_URL; ?>?page=projects&action=edit&id=<?php echo $item['id']; ?>" class="btn btn-small btn-primary">Edit</a>
                        <a href="<?php echo ADMIN_URL; ?>?page=projects&action=delete&id=<?php echo $item['id']; ?>" class="btn btn-small btn-danger" onclick="return confirmDelete()">Delete</a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="5" class="text-center">No projects added yet</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
