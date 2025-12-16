<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    http_response_code(403);
    exit('Access denied');
}

include '../includes/conn.php';

$admission_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$mode = isset($_GET['mode']) ? $_GET['mode'] : 'view';

if ($admission_id <= 0) {
    echo '<div style="color:red;text-align:center;padding:20px;">Invalid admission ID</div>';
    exit;
}

// Fetch admission details
$query = "SELECT * FROM admissions WHERE id = $admission_id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo '<div style="color:red;text-align:center;padding:20px;">Admission not found</div>';
    exit;
}

$admission = mysqli_fetch_assoc($result);

if ($mode === 'edit'): ?>
    <form method="POST" action="admissions.php">
        <input type="hidden" name="action" value="update_status">
        <input type="hidden" name="admission_id" value="<?php echo $admission['id']; ?>">
        
        <div class="info-grid">
            <div class="info-group">
                <label>Child's Name</label>
                <span><?php echo htmlspecialchars($admission['child_name']); ?></span>
            </div>
            <div class="info-group">
                <label>Child's Age</label>
                <span><?php echo htmlspecialchars($admission['child_age']); ?></span>
            </div>
            <div class="info-group">
                <label>Parent's Name</label>
                <span><?php echo htmlspecialchars($admission['parent_name']); ?></span>
            </div>
            <div class="info-group">
                <label>Relationship</label>
                <span><?php echo ucfirst($admission['relationship']); ?></span>
            </div>
            <div class="info-group">
                <label>Email</label>
                <span><?php echo htmlspecialchars($admission['email']); ?></span>
            </div>
            <div class="info-group">
                <label>Phone</label>
                <span><?php echo htmlspecialchars($admission['phone']); ?></span>
            </div>
            <div class="info-group">
                <label>Program</label>
                <span><?php echo htmlspecialchars($admission['program']); ?></span>
            </div>
            <div class="info-group">
                <label>Preferred Location</label>
                <span><?php echo htmlspecialchars($admission['preferred_location']); ?></span>
            </div>
            <div class="info-group full-width">
                <label>Address</label>
                <span><?php echo htmlspecialchars($admission['address']); ?></span>
            </div>
        </div>

        <div class="update-form">
            <h4 style="color: #6B2C91; margin-bottom: 20px;">Update Application Status</h4>
            
            <div class="info-grid">
                <div class="info-group">
                    <label>Application Status</label>
                    <select name="status" required>
                        <option value="pending" <?php echo $admission['application_status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="contacted" <?php echo $admission['application_status'] === 'contacted' ? 'selected' : ''; ?>>Contacted</option>
                        <option value="visited" <?php echo $admission['application_status'] === 'visited' ? 'selected' : ''; ?>>Visited</option>
                        <option value="enrolled" <?php echo $admission['application_status'] === 'enrolled' ? 'selected' : ''; ?>>Enrolled</option>
                        <option value="rejected" <?php echo $admission['application_status'] === 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                    </select>
                </div>
                <div class="info-group">
                    <label>Assigned Counselor</label>
                    <input type="text" name="counselor" value="<?php echo htmlspecialchars($admission['assigned_counselor']); ?>" placeholder="Enter counselor name">
                </div>
                <div class="info-group">
                    <label>Follow-up Date</label>
                    <input type="date" name="follow_up_date" value="<?php echo $admission['follow_up_date']; ?>">
                </div>
                <div class="info-group full-width">
                    <label>Notes</label>
                    <textarea name="notes" rows="3" placeholder="Add notes about this application..."><?php echo htmlspecialchars($admission['notes']); ?></textarea>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="button" class="btn-cancel" onclick="document.getElementById('admissionModal').style.display='none'">Cancel</button>
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
            <label>Application ID</label>
            <span>#<?php echo str_pad($admission['id'], 4, '0', STR_PAD_LEFT); ?></span>
        </div>
        <div class="info-group">
            <label>Submitted On</label>
            <span><?php echo date('M j, Y g:i A', strtotime($admission['submitted_at'])); ?></span>
        </div>
        <div class="info-group">
            <label>Child's Name</label>
            <span><?php echo htmlspecialchars($admission['child_name']); ?></span>
        </div>
        <div class="info-group">
            <label>Child's Age</label>
            <span><?php echo htmlspecialchars($admission['child_age']); ?></span>
        </div>
        <div class="info-group">
            <label>Program</label>
            <span><?php echo htmlspecialchars($admission['program']); ?></span>
        </div>
        <div class="info-group">
            <label>Session</label>
            <span><?php echo htmlspecialchars($admission['session']); ?></span>
        </div>
        <div class="info-group">
            <label>Parent/Guardian</label>
            <span><?php echo htmlspecialchars($admission['parent_name']); ?> (<?php echo ucfirst($admission['relationship']); ?>)</span>
        </div>
        <div class="info-group">
            <label>Email</label>
            <span><?php echo htmlspecialchars($admission['email']); ?></span>
        </div>
        <div class="info-group">
            <label>Primary Phone</label>
            <span><?php echo htmlspecialchars($admission['phone']); ?></span>
        </div>
        <?php if ($admission['alternate_phone']): ?>
        <div class="info-group">
            <label>Alternate Phone</label>
            <span><?php echo htmlspecialchars($admission['alternate_phone']); ?></span>
        </div>
        <?php endif; ?>
        <div class="info-group full-width">
            <label>Address</label>
            <span><?php echo htmlspecialchars($admission['address']); ?></span>
        </div>
        <div class="info-group">
            <label>City</label>
            <span><?php echo htmlspecialchars($admission['city']); ?></span>
        </div>
        <div class="info-group">
            <label>State</label>
            <span><?php echo htmlspecialchars($admission['state']); ?></span>
        </div>
        <div class="info-group">
            <label>PIN Code</label>
            <span><?php echo htmlspecialchars($admission['pincode']); ?></span>
        </div>
        <div class="info-group">
            <label>Preferred Location</label>
            <span><?php echo htmlspecialchars($admission['preferred_location']); ?></span>
        </div>
        
        <?php if ($admission['previous_school']): ?>
        <div class="info-group full-width">
            <label>Previous School</label>
            <span><?php echo htmlspecialchars($admission['previous_school']); ?></span>
        </div>
        <?php endif; ?>
        
        <?php if ($admission['special_needs']): ?>
        <div class="info-group full-width">
            <label>Special Needs</label>
            <span><?php echo htmlspecialchars($admission['special_needs']); ?></span>
        </div>
        <?php endif; ?>
        
        <?php if ($admission['medical_conditions']): ?>
        <div class="info-group full-width">
            <label>Medical Conditions</label>
            <span><?php echo htmlspecialchars($admission['medical_conditions']); ?></span>
        </div>
        <?php endif; ?>
        
        <?php if ($admission['allergies']): ?>
        <div class="info-group full-width">
            <label>Allergies</label>
            <span><?php echo htmlspecialchars($admission['allergies']); ?></span>
        </div>
        <?php endif; ?>
        
        <div class="info-group">
            <label>Transport Required</label>
            <span><?php echo $admission['transport_required'] ? 'Yes' : 'No'; ?></span>
        </div>
        <div class="info-group">
            <label>Lunch Required</label>
            <span><?php echo $admission['lunch_required'] ? 'Yes' : 'No'; ?></span>
        </div>
        <div class="info-group">
            <label>Extended Care</label>
            <span><?php echo $admission['extended_care_required'] ? 'Yes' : 'No'; ?></span>
        </div>
        
        <div class="info-group">
            <label>Application Status</label>
            <span class="status-badge status-<?php echo $admission['application_status']; ?>">
                <?php echo ucfirst($admission['application_status']); ?>
            </span>
        </div>
        
        <?php if ($admission['assigned_counselor']): ?>
        <div class="info-group">
            <label>Assigned Counselor</label>
            <span><?php echo htmlspecialchars($admission['assigned_counselor']); ?></span>
        </div>
        <?php endif; ?>
        
        <?php if ($admission['follow_up_date']): ?>
        <div class="info-group">
            <label>Follow-up Date</label>
            <span><?php echo date('M j, Y', strtotime($admission['follow_up_date'])); ?></span>
        </div>
        <?php endif; ?>
        
        <?php if ($admission['notes']): ?>
        <div class="info-group full-width">
            <label>Notes</label>
            <span><?php echo nl2br(htmlspecialchars($admission['notes'])); ?></span>
        </div>
        <?php endif; ?>
        
        <?php if ($admission['emergency_contact_name']): ?>
        <div class="info-group">
            <label>Emergency Contact</label>
            <span><?php echo htmlspecialchars($admission['emergency_contact_name']); ?></span>
        </div>
        <div class="info-group">
            <label>Emergency Phone</label>
            <span><?php echo htmlspecialchars($admission['emergency_contact_phone']); ?></span>
        </div>
        <div class="info-group">
            <label>Emergency Relationship</label>
            <span><?php echo htmlspecialchars($admission['emergency_contact_relationship']); ?></span>
        </div>
        <?php endif; ?>
    </div>
    
    <div style="margin-top: 30px; text-align: center;">
        <button type="button" class="btn-edit" onclick="editAdmission(<?php echo $admission['id']; ?>)">
            <i class="fas fa-edit"></i> Edit Application
        </button>
    </div>

<?php endif; ?>
