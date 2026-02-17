<div class="content-section">
    <div class="section-header">
        <h1>Blog Posts</h1>
        <a href="<?php echo ADMIN_URL; ?>?page=blog&action=add" class="btn btn-primary">Add New Post</a>
    </div>
    <div class="table-responsive">
        <table class="data-table">
            <thead><tr><th>Title</th><th>Status</th><th>Created</th><th>Actions</th></tr></thead>
            <tbody>
                <?php if (!empty($items)): foreach ($items as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['title']); ?></td>
                    <td><span class="badge badge-<?php echo $item['status'] == 'published' ? 'success' : 'secondary'; ?>"><?php echo ucfirst($item['status']); ?></span></td>
                    <td><?php echo date('M d, Y', strtotime($item['created_at'])); ?></td>
                    <td class="action-btns">
                        <a href="<?php echo ADMIN_URL; ?>?page=blog&action=edit&id=<?php echo $item['id']; ?>" class="btn btn-small btn-primary">Edit</a>
                        <a href="<?php echo ADMIN_URL; ?>?page=blog&action=delete&id=<?php echo $item['id']; ?>" class="btn btn-small btn-danger" onclick="return confirmDelete()">Delete</a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="4" class="text-center">No blog posts yet</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
