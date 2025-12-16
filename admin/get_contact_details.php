<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    http_response_code(403);
    exit('Access denied');
}

include '../includes/conn.php';

$contact_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$mode = isset($_GET['mode']) ? $_GET['mode'] : 'view';

if ($contact_id <= 0) {
    echo '<div style="color:red;text-align:center;padding:20px;">Invalid contact ID</div>';
    exit;
}

// Fetch contact details
$query = "SELECT * FROM contact_queries WHERE id = $contact_id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo '<div style="color:red;text-align:center;padding:20px;">Contact query not found</div>';
    exit;
}

$contact = mysqli_fetch_assoc($result);

if ($mode === 'edit'): ?>
    <form method="POST" action="contacts.php">
        <input type="hidden" name="action" value="update_status">
        <input type="hidden" name="query_id" value="<?php echo $contact['id']; ?>">
        
        <div class="info-grid">
            <div class="info-group">
                <label>Contact Name</label>
                <span><?php echo htmlspecialchars($contact['name']); ?></span>
            </div>
            <div class="info-group">
                <label>Email</label>
                <span><?php echo htmlspecialchars($contact['email']); ?></span>
            </div>
            <div class="info-group">
                <label>Phone</label>
                <span><?php echo htmlspecialchars($contact['phone']); ?></span>
            </div>
            <div class="info-group">
                <label>Query Type</label>
                <span><?php echo ucfirst($contact['query_type']); ?></span>
            </div>
            <div class="info-group full-width">
                <label>Subject</label>
                <span><?php echo htmlspecialchars($contact['subject']); ?></span>
            </div>
            <div class="info-group full-width">
                <label>Message</label>
                <div style="background: #f8f9ff; padding: 15px; border-radius: 8px; border-left: 4px solid #6B2C91;">
                    <?php echo nl2br(htmlspecialchars($contact['message'])); ?>
                </div>
            </div>
        </div>

        <div class="update-form">
            <h4 style="color: #6B2C91; margin-bottom: 20px;">Update Query Status</h4>
            
            <div class="info-grid">
                <div class="info-group">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="new" <?php echo $contact['status'] === 'new' ? 'selected' : ''; ?>>New</option>
                        <option value="in_progress" <?php echo $contact['status'] === 'in_progress' ? 'selected' : ''; ?>>In Progress</option>
                        <option value="resolved" <?php echo $contact['status'] === 'resolved' ? 'selected' : ''; ?>>Resolved</option>
                        <option value="closed" <?php echo $contact['status'] === 'closed' ? 'selected' : ''; ?>>Closed</option>
                    </select>
                </div>
                <div class="info-group">
                    <label>Priority</label>
                    <select name="priority" required>
                        <option value="low" <?php echo $contact['priority'] === 'low' ? 'selected' : ''; ?>>Low</option>
                        <option value="medium" <?php echo $contact['priority'] === 'medium' ? 'selected' : ''; ?>>Medium</option>
                        <option value="high" <?php echo $contact['priority'] === 'high' ? 'selected' : ''; ?>>High</option>
                        <option value="urgent" <?php echo $contact['priority'] === 'urgent' ? 'selected' : ''; ?>>Urgent</option>
                    </select>
                </div>
                <div class="info-group">
                    <label>Assigned To</label>
                    <input type="text" name="assigned_to" value="<?php echo htmlspecialchars($contact['assigned_to']); ?>" placeholder="Assign to team member">
                </div>
                <div class="info-group">
                    <label>Follow-up Date</label>
                    <input type="date" name="follow_up_date" value="<?php echo $contact['follow_up_date']; ?>">
                </div>
                <div class="info-group full-width">
                    <label>
                        <input type="checkbox" name="response_sent" value="1" <?php echo $contact['response_sent'] ? 'checked' : ''; ?>>
                        Response sent to customer
                    </label>
                </div>
                <div class="info-group full-width">
                    <label>Resolution Notes</label>
                    <textarea name="resolution_notes" rows="4" placeholder="Add notes about how this query was handled..."><?php echo htmlspecialchars($contact['resolution_notes']); ?></textarea>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="button" class="btn-cancel" onclick="document.getElementById('contactModal').style.display='none'">Cancel</button>
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </div>
    </form>

<?php else: ?>
    <!-- View Mode -->
    <div class="info-grid">
        <div class="info-group">
            <label>Query ID</label>
            <span>#<?php echo str_pad($contact['id'], 4, '0', STR_PAD_LEFT); ?></span>
        </div>
        <div class="info-group">
            <label>Submitted On</label>
            <span><?php echo date('M j, Y g:i A', strtotime($contact['submitted_at'])); ?></span>
        </div>
        <div class="info-group">
            <label>Contact Name</label>
            <span><?php echo htmlspecialchars($contact['name']); ?></span>
        </div>
        <div class="info-group">
            <label>Email</label>
            <span><a href="mailto:<?php echo $contact['email']; ?>"><?php echo htmlspecialchars($contact['email']); ?></a></span>
        </div>
        <div class="info-group">
            <label>Phone</label>
            <span><?php echo $contact['phone'] ? '<a href="tel:' . $contact['phone'] . '">' . htmlspecialchars($contact['phone']) . '</a>' : 'Not provided'; ?></span>
        </div>
        <div class="info-group">
            <label>Query Type</label>
            <span class="query-type-badge query-<?php echo $contact['query_type']; ?>">
                <?php echo ucfirst($contact['query_type']); ?>
            </span>
        </div>
        <?php if ($contact['company']): ?>
        <div class="info-group">
            <label>Company</label>
            <span><?php echo htmlspecialchars($contact['company']); ?></span>
        </div>
        <?php endif; ?>
        <?php if ($contact['designation']): ?>
        <div class="info-group">
            <label>Designation</label>
            <span><?php echo htmlspecialchars($contact['designation']); ?></span>
        </div>
        <?php endif; ?>
        <div class="info-group">
            <label>City</label>
            <span><?php echo htmlspecialchars($contact['city']); ?></span>
        </div>
        <div class="info-group">
            <label>State</label>
            <span><?php echo htmlspecialchars($contact['state']); ?></span>
        </div>
        <div class="info-group">
            <label>Preferred Contact Time</label>
            <span><?php echo ucfirst(str_replace('_', ' ', $contact['preferred_contact_time'])); ?></span>
        </div>
        <div class="info-group">
            <label>Contact Method</label>
            <span><?php echo ucfirst($contact['contact_method']); ?></span>
        </div>
        <div class="info-group full-width">
            <label>Subject</label>
            <span><?php echo htmlspecialchars($contact['subject']); ?></span>
        </div>
        <div class="info-group full-width">
            <label>Message</label>
            <div style="background: #f8f9ff; padding: 15px; border-radius: 8px; border-left: 4px solid #6B2C91; margin-top: 5px;">
                <?php echo nl2br(htmlspecialchars($contact['message'])); ?>
            </div>
        </div>
        
        <div class="info-group">
            <label>Current Status</label>
            <span class="status-badge status-<?php echo str_replace('_', '-', $contact['status']); ?>">
                <?php echo ucfirst(str_replace('_', ' ', $contact['status'])); ?>
            </span>
        </div>
        <div class="info-group">
            <label>Priority</label>
            <span class="priority-badge priority-<?php echo $contact['priority']; ?>">
                <?php echo ucfirst($contact['priority']); ?>
            </span>
        </div>
        
        <?php if ($contact['assigned_to']): ?>
        <div class="info-group">
            <label>Assigned To</label>
            <span><?php echo htmlspecialchars($contact['assigned_to']); ?></span>
        </div>
        <?php endif; ?>
        
        <div class="info-group">
            <label>Response Sent</label>
            <span><?php echo $contact['response_sent'] ? '<span style="color: green;">Yes</span>' : '<span style="color: orange;">No</span>'; ?></span>
        </div>
        
        <?php if ($contact['follow_up_date']): ?>
        <div class="info-group">
            <label>Follow-up Date</label>
            <span><?php echo date('M j, Y', strtotime($contact['follow_up_date'])); ?></span>
        </div>
        <?php endif; ?>
        
        <?php if ($contact['resolution_notes']): ?>
        <div class="info-group full-width">
            <label>Resolution Notes</label>
            <div style="background: #f8f9ff; padding: 15px; border-radius: 8px; margin-top: 5px;">
                <?php echo nl2br(htmlspecialchars($contact['resolution_notes'])); ?>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if ($contact['updated_at'] !== $contact['submitted_at']): ?>
        <div class="info-group">
            <label>Last Updated</label>
            <span><?php echo date('M j, Y g:i A', strtotime($contact['updated_at'])); ?></span>
        </div>
        <?php endif; ?>
    </div>
    
    <div style="margin-top: 30px; text-align: center;">
        <button type="button" class="btn-edit" onclick="editContact(<?php echo $contact['id']; ?>)">
            <i class="fas fa-edit"></i> Edit Query
        </button>
        <a href="mailto:<?php echo $contact['email']; ?>?subject=Re: <?php echo urlencode($contact['subject']); ?>" class="btn-edit" style="margin-left: 10px; text-decoration: none;">
            <i class="fas fa-reply"></i> Reply via Email
        </a>
    </div>

<?php endif; ?>
