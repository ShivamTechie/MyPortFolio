<h1>Dashboard</h1>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-folder"></i>
        </div>
        <div class="stat-info">
            <h3><?php echo $totalProjects; ?></h3>
            <p>Total Projects</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-envelope"></i>
        </div>
        <div class="stat-info">
            <h3><?php echo $totalMessages; ?></h3>
            <p>Total Messages</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-envelope-open"></i>
        </div>
        <div class="stat-info">
            <h3><?php echo $unreadMessages; ?></h3>
            <p>Unread Messages</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-blog"></i>
        </div>
        <div class="stat-info">
            <h3><?php echo $totalBlogPosts; ?></h3>
            <p>Blog Posts</p>
        </div>
    </div>
</div>

<div class="dashboard-section">
    <h2>Recent Messages</h2>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($recentMessages)): ?>
                    <?php foreach ($recentMessages as $message): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($message['name']); ?></td>
                        <td><?php echo htmlspecialchars($message['email']); ?></td>
                        <td><?php echo htmlspecialchars($message['subject'] ?? 'No Subject'); ?></td>
                        <td><?php echo date('M d, Y', strtotime($message['created_at'])); ?></td>
                        <td><span class="badge badge-<?php echo $message['status']; ?>"><?php echo ucfirst($message['status']); ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No messages yet</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
