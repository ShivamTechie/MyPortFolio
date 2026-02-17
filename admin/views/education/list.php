<div class="content-section">
    <div class="section-header">
        <h1>Education Management</h1>
        <a href="<?php echo ADMIN_URL; ?>?page=education&action=add" class="btn btn-primary">Add New Education</a>
    </div>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr><th>Degree</th><th>Institution</th><th>CGPA</th><th>Year</th><th>Order</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php if (!empty($items)): foreach ($items as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['degree']); ?></td>
                    <td><?php echo htmlspecialchars($item['institution']); ?></td>
                    <td><?php echo htmlspecialchars($item['cgpa']); ?></td>
                    <td><?php echo $item['year']; ?></td>
                    <td><?php echo $item['display_order']; ?></td>
                    <td class="action-btns">
                        <a href="<?php echo ADMIN_URL; ?>?page=education&action=edit&id=<?php echo $item['id']; ?>" class="btn btn-small btn-primary">Edit</a>
                        <a href="<?php echo ADMIN_URL; ?>?page=education&action=delete&id=<?php echo $item['id']; ?>" class="btn btn-small btn-danger" onclick="return confirmDelete()">Delete</a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="6" class="text-center">No education added yet</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
