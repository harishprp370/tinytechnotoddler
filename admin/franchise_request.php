<?php
include 'header.php';
include '../includes/conn.php';

// Fetch franchise requests
$result = $conn->query("SELECT * FROM franchise_interest ORDER BY submitted_at DESC");
?>
<style>
    .franchise-table-container { max-width:1200px; margin:40px auto; background:#fff; border-radius:18px; box-shadow:0 4px 24px rgba(123,63,160,0.08); padding:32px; }
    .franchise-table { width:100%; border-collapse:collapse; }
    .franchise-table th, .franchise-table td { padding:14px 10px; border-bottom:1px solid #F3E9FF; text-align:left; }
    .franchise-table th { background:#7B3FA0; color:#FFD700; font-weight:600; }
    .franchise-table tr:hover { background:#F3E9FF; }
    .action-btn { background:#FFD700; color:#5B2D8F; border:none; border-radius:8px; padding:6px 16px; font-size:14px; cursor:pointer; margin-right:6px; }
    .action-btn:hover { background:#5B2D8F; color:#FFD700; }
</style>
<div class="franchise-table-container">
    <h2 style="color:#5B2D8F;">Franchise Requests</h2>
    <table class="franchise-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>City</th>
                <th>State</th>
                <th>Investment</th>
                <th>Message</th>
                <th>Submitted</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
                <td><?= htmlspecialchars($row['city']) ?></td>
                <td><?= htmlspecialchars($row['state']) ?></td>
                <td><?= htmlspecialchars($row['investment_range']) ?></td>
                <td><?= htmlspecialchars($row['message']) ?></td>
                <td><?= date('d M Y', strtotime($row['submitted_at'])) ?></td>
                <td>
                    <button class="action-btn" onclick="window.location='mailto:<?= $row['email'] ?>'"><i class="fas fa-envelope"></i> Email</button>
                    <button class="action-btn" onclick="window.location='tel:<?= $row['phone'] ?>'"><i class="fas fa-phone"></i> Call</button>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php include 'footer.php'; ?>
