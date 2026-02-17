<div class="content-section">
    <h1>Contact Messages</h1>
    <div class="table-responsive">
        <table class="data-table">
            <thead><tr><th>Status</th><th>Name</th><th>Email</th><th>Subject</th><th>Date</th><th>Actions</th></tr></thead>
            <tbody>
                <?php if (!empty($items)): foreach ($items as $item): ?>
                <tr style="<?php echo $item['status'] == 'unread' ? 'font-weight: bold; background: #f0f8ff;' : ''; ?>">
                    <td><span class="badge badge-<?php echo $item['status']; ?>"><?php echo ucfirst($item['status']); ?></span></td>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo htmlspecialchars($item['email']); ?></td>
                    <td><?php echo htmlspecialchars($item['subject'] ?? 'No Subject'); ?></td>
                    <td><?php echo date('M d, Y H:i', strtotime($item['created_at'])); ?></td>
                    <td class="action-btns">
                        <a href="<?php echo ADMIN_URL; ?>?page=messages&action=view&id=<?php echo $item['id']; ?>" class="btn btn-small btn-primary">View</a>
                        <a href="<?php echo ADMIN_URL; ?>?page=messages&action=delete&id=<?php echo $item['id']; ?>" class="btn btn-small btn-danger" onclick="return confirmDelete()">Delete</a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="6" class="text-center">No messages received yet</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
