<div class="content-section">
    <div class="section-header">
        <h1>Experience Management</h1>
        <a href="<?php echo ADMIN_URL; ?>?page=experience&action=add" class="btn btn-primary">Add New Experience</a>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Company</th>
                    <th>Position</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($items)): ?>
                    <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['company']); ?></td>
                        <td><?php echo htmlspecialchars($item['position']); ?></td>
                        <td><?php echo date('M Y', strtotime($item['start_date'])); ?></td>
                        <td><?php echo $item['is_current'] ? 'Present' : date('M Y', strtotime($item['end_date'])); ?></td>
                        <td><?php echo $item['display_order']; ?></td>
                        <td class="action-btns">
                            <a href="<?php echo ADMIN_URL; ?>?page=experience&action=edit&id=<?php echo $item['id']; ?>" class="btn btn-small btn-primary">Edit</a>
                            <a href="<?php echo ADMIN_URL; ?>?page=experience&action=delete&id=<?php echo $item['id']; ?>" 
                               class="btn btn-small btn-danger" onclick="return confirmDelete()">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No experience added yet</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
