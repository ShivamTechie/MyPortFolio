<div class="content-section">
    <h1>View Message</h1>
    <div style="background: white; padding: 20px; border-radius: 8px;">
        <div style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #e9ecef;">
            <p><strong>From:</strong> <?php echo htmlspecialchars($item['name']); ?></p>
            <p><strong>Email:</strong> <a href="mailto:<?php echo htmlspecialchars($item['email']); ?>"><?php echo htmlspecialchars($item['email']); ?></a></p>
            <p><strong>Subject:</strong> <?php echo htmlspecialchars($item['subject'] ?? 'No Subject'); ?></p>
            <p><strong>Date:</strong> <?php echo date('F d, Y \a\t H:i', strtotime($item['created_at'])); ?></p>
            <p><strong>Status:</strong> <span class="badge badge-<?php echo $item['status']; ?>"><?php echo ucfirst($item['status']); ?></span></p>
        </div>
        <div style="margin: 20px 0;">
            <h3>Message:</h3>
            <p style="white-space: pre-wrap; line-height: 1.6;"><?php echo htmlspecialchars($item['message']); ?></p>
        </div>
        <div style="margin-top: 30px;">
            <a href="<?php echo ADMIN_URL; ?>?page=messages" class="btn btn-primary">Back to Messages</a>
            <a href="mailto:<?php echo htmlspecialchars($item['email']); ?>" class="btn btn-success">Reply via Email</a>
        </div>
    </div>
</div>
