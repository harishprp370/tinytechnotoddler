<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

$page_key = 'seo';
include 'header.php';
include '../includes/conn.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => ''];
    
    try {
        if ($_POST['action'] === 'add_seo') {
            // Add new SEO meta
            $page_key = mysqli_real_escape_string($conn, $_POST['page_key']);
            $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
            $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
            $meta_keywords = mysqli_real_escape_string($conn, $_POST['meta_keywords']);
            $og_title = mysqli_real_escape_string($conn, $_POST['og_title']);
            $og_description = mysqli_real_escape_string($conn, $_POST['og_description']);
            $og_image = mysqli_real_escape_string($conn, $_POST['og_image']);
            $canonical_url = mysqli_real_escape_string($conn, $_POST['canonical_url']);
            $no_index = isset($_POST['no_index']) ? 1 : 0;
            $no_follow = isset($_POST['no_follow']) ? 1 : 0;
            
            // Handle schema markup
            $schema = [];
            if (!empty($_POST['schema_type'])) {
                $schema = [
                    '@context' => 'https://schema.org',
                    '@type' => $_POST['schema_type'],
                    'name' => $_POST['schema_name'] ?? '',
                    'description' => $_POST['schema_description'] ?? '',
                    'url' => $_POST['schema_url'] ?? ''
                ];
                
                if ($_POST['schema_type'] === 'Organization') {
                    $schema['logo'] = $_POST['schema_logo'] ?? '';
                    $schema['contactPoint'] = [
                        '@type' => 'ContactPoint',
                        'telephone' => $_POST['schema_phone'] ?? '',
                        'contactType' => 'Customer Service'
                    ];
                }
            }
            
            $extras = json_encode(['schema' => $schema]);
            
            $insert_query = "
                INSERT INTO seo_meta (
                    page_key, meta_title, meta_description, meta_keywords, og_title, og_description,
                    og_image, canonical_url, no_index, no_follow, extras, created_at
                ) VALUES (
                    '$page_key', '$meta_title', '$meta_description', '$meta_keywords', '$og_title', '$og_description',
                    '$og_image', '$canonical_url', $no_index, $no_follow, '$extras', NOW()
                )
            ";
            
            if (mysqli_query($conn, $insert_query)) {
                $response['success'] = true;
                $response['message'] = 'SEO meta added successfully!';
            } else {
                throw new Exception('Database error: ' . mysqli_error($conn));
            }
            
        } elseif ($_POST['action'] === 'update_seo') {
            // Update existing SEO meta
            $seo_id = (int)$_POST['seo_id'];
            $page_key = mysqli_real_escape_string($conn, $_POST['page_key']);
            $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
            $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
            $meta_keywords = mysqli_real_escape_string($conn, $_POST['meta_keywords']);
            $og_title = mysqli_real_escape_string($conn, $_POST['og_title']);
            $og_description = mysqli_real_escape_string($conn, $_POST['og_description']);
            $og_image = mysqli_real_escape_string($conn, $_POST['og_image']);
            $canonical_url = mysqli_real_escape_string($conn, $_POST['canonical_url']);
            $no_index = isset($_POST['no_index']) ? 1 : 0;
            $no_follow = isset($_POST['no_follow']) ? 1 : 0;
            
            // Handle schema markup
            $schema = [];
            if (!empty($_POST['schema_type'])) {
                $schema = [
                    '@context' => 'https://schema.org',
                    '@type' => $_POST['schema_type'],
                    'name' => $_POST['schema_name'] ?? '',
                    'description' => $_POST['schema_description'] ?? '',
                    'url' => $_POST['schema_url'] ?? ''
                ];
                
                if ($_POST['schema_type'] === 'Organization') {
                    $schema['logo'] = $_POST['schema_logo'] ?? '';
                    $schema['contactPoint'] = [
                        '@type' => 'ContactPoint',
                        'telephone' => $_POST['schema_phone'] ?? '',
                        'contactType' => 'Customer Service'
                    ];
                }
            }
            
            $extras = json_encode(['schema' => $schema]);
            
            $update_query = "
                UPDATE seo_meta SET
                    page_key = '$page_key',
                    meta_title = '$meta_title',
                    meta_description = '$meta_description',
                    meta_keywords = '$meta_keywords',
                    og_title = '$og_title',
                    og_description = '$og_description',
                    og_image = '$og_image',
                    canonical_url = '$canonical_url',
                    no_index = $no_index,
                    no_follow = $no_follow,
                    extras = '$extras',
                    updated_at = NOW()
                WHERE id = $seo_id
            ";
            
            if (mysqli_query($conn, $update_query)) {
                $response['success'] = true;
                $response['message'] = 'SEO meta updated successfully!';
            } else {
                throw new Exception('Database error: ' . mysqli_error($conn));
            }
            
        } elseif ($_POST['action'] === 'delete_seo') {
            // Delete SEO meta
            $seo_id = (int)$_POST['seo_id'];
            
            $delete_query = "DELETE FROM seo_meta WHERE id = $seo_id";
            
            if (mysqli_query($conn, $delete_query)) {
                $response['success'] = true;
                $response['message'] = 'SEO meta deleted successfully!';
            } else {
                throw new Exception('Database error: ' . mysqli_error($conn));
            }
        }
        
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }
    
    // Return JSON response for AJAX calls
    if (isset($_POST['ajax'])) {
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
    
    // Redirect to avoid resubmission
    if ($response['success']) {
        $_SESSION['success_message'] = $response['message'];
    } else {
        $_SESSION['error_message'] = $response['message'];
    }
    header("Location: seo.php");
    exit;
}

// Handle session messages
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
unset($_SESSION['success_message'], $_SESSION['error_message']);

// Fetch all SEO meta records
$seo_query = "SELECT * FROM seo_meta ORDER BY created_at DESC";
$seo_result = mysqli_query($conn, $seo_query);

// Get statistics
$stats_query = "SELECT COUNT(*) as total_pages FROM seo_meta";
$stats_result = mysqli_query($conn, $stats_query);
$total_pages = mysqli_fetch_assoc($stats_result)['total_pages'];
?>

<style>
.admin-main {
    margin-left: 280px;
    margin-top: 80px;
    padding: 30px;
    background: #f8f9ff;
    min-height: calc(100vh - 80px);
}

.page-header {
    background: white;
    padding: 30px;
    border-radius: 15px;
    margin-bottom: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    border: 1px solid #e8ebff;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.page-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 2rem;
    color: #6B2C91;
    margin: 0;
}

.page-subtitle {
    color: #666;
    margin: 5px 0 0 0;
    font-size: 1rem;
}

.btn-add {
    background: linear-gradient(135deg, #4CAF50, #66BB6A);
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
    color: white;
}

.stats-card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    border: 1px solid #e8ebff;
    text-align: center;
    margin-bottom: 30px;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #6B2C91;
    font-family: 'Fredoka', sans-serif;
    margin-bottom: 5px;
}

.stat-label {
    color: #666;
    font-weight: 600;
}

.seo-form {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    border: 1px solid #e8ebff;
    margin-bottom: 30px;
    display: none;
}

.seo-form.active {
    display: block;
}

.form-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f0f0f0;
}

.form-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.8rem;
    color: #6B2C91;
    margin: 0;
}

.form-close {
    background: #ff4757;
    color: white;
    border: none;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.form-sections {
    display: grid;
    gap: 30px;
}

.form-section {
    background: #f8f9ff;
    padding: 20px;
    border-radius: 10px;
    border: 1px solid #e8ebff;
}

.section-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.2rem;
    color: #6B2C91;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    color: #6B2C91;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 12px 15px;
    border: 2px solid #e8ebff;
    border-radius: 8px;
    font-size: 1rem;
    font-family: 'Poppins', sans-serif;
    transition: border-color 0.3s;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #FFD700;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.checkbox-group {
    display: flex;
    gap: 20px;
    margin: 15px 0;
}

.checkbox-item {
    display: flex;
    align-items: center;
    gap: 8px;
}

.checkbox-item input[type="checkbox"] {
    transform: scale(1.2);
    accent-color: #6B2C91;
}

.form-actions {
    display: flex;
    gap: 15px;
    justify-content: flex-end;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 2px solid #f0f0f0;
}

.btn-save {
    background: #4CAF50;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
}

.btn-cancel {
    background: #757575;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
}

.seo-table {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    border: 1px solid #e8ebff;
}

.table-header {
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    color: white;
    padding: 20px 25px;
}

.table-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.3rem;
    margin: 0;
}

.seo-data-table {
    width: 100%;
    border-collapse: collapse;
}

.seo-data-table th {
    background: #f8f9ff;
    color: #6B2C91;
    font-weight: 600;
    padding: 15px 12px;
    text-align: left;
    border-bottom: 2px solid #e8ebff;
}

.seo-data-table td {
    padding: 15px 12px;
    border-bottom: 1px solid #f0f0f0;
    vertical-align: top;
}

.seo-data-table tr:hover {
    background: #f8f9ff;
}

.page-key-badge {
    background: #6B2C91;
    color: white;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

.meta-preview {
    max-width: 300px;
    font-size: 0.85rem;
    line-height: 1.4;
}

.meta-title {
    color: #1a0dab;
    font-weight: 600;
    margin-bottom: 3px;
}

.meta-url {
    color: #006621;
    margin-bottom: 3px;
}

.meta-desc {
    color: #545454;
}

.action-buttons {
    display: flex;
    gap: 8px;
}

.btn-sm {
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    font-size: 0.8rem;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-edit {
    background: #FFF3E0;
    color: #F57C00;
}

.btn-edit:hover {
    background: #F57C00;
    color: white;
}

.btn-delete {
    background: #FFEBEE;
    color: #D32F2F;
}

.btn-delete:hover {
    background: #D32F2F;
    color: white;
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 8px;
    font-weight: 600;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.help-text {
    font-size: 0.85rem;
    color: #666;
    margin-top: 5px;
    font-style: italic;
}

.schema-preview {
    background: #f8f9ff;
    padding: 15px;
    border-radius: 8px;
    margin-top: 15px;
    border: 1px solid #e8ebff;
}

.schema-preview pre {
    margin: 0;
    font-size: 0.85rem;
    color: #333;
    white-space: pre-wrap;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .admin-main {
        margin-left: 0;
        padding: 20px;
    }
    
    .page-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    .form-actions {
        flex-direction: column;
    }
}
</style>

<div class="admin-main">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">SEO Management</h1>
            <p class="page-subtitle">Manage meta tags, Open Graph, and schema markup for all pages</p>
        </div>
        <button class="btn-add" onclick="showAddForm()">
            <i class="fas fa-plus"></i>
            Add SEO Meta
        </button>
    </div>

    <?php if (!empty($success_message)): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($error_message)): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-triangle"></i> <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <!-- Statistics -->
    <div class="stats-card">
        <div class="stat-number"><?php echo $total_pages; ?></div>
        <div class="stat-label">Total SEO Pages Configured</div>
    </div>

    <!-- SEO Form -->
    <div id="seoForm" class="seo-form">
        <div class="form-header">
            <h3 class="form-title" id="formTitle">Add SEO Meta</h3>
            <button type="button" class="form-close" onclick="hideSeoForm()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form id="seoFormElement" method="POST">
            <input type="hidden" name="action" id="formAction" value="add_seo">
            <input type="hidden" name="seo_id" id="seoId" value="">
            
            <div class="form-sections">
                <!-- Basic SEO Section -->
                <div class="form-section">
                    <h4 class="section-title">
                        <i class="fas fa-tags"></i>
                        Basic SEO Meta Tags
                    </h4>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="page_key">Page Key *</label>
                            <select id="page_key" name="page_key" required>
                                <option value="">Select Page</option>
                                <option value="home">Home Page</option>
                                <option value="about">About Us</option>
                                <option value="programs">Programs</option>
                                <option value="playgroup">PlayGroup</option>
                                <option value="nursery">Nursery</option>
                                <option value="kindergarten">Kindergarten</option>
                                <option value="teacher-training">Teacher Training</option>
                                <option value="admissions">Admissions</option>
                                <option value="contact">Contact Us</option>
                                <option value="franchise">Franchise</option>
                                <option value="partners">Our Partners</option>
                                <option value="blog">Blog</option>
                            </select>
                            <div class="help-text">Unique identifier for the page</div>
                        </div>
                        <div class="form-group">
                            <label for="meta_title">Meta Title *</label>
                            <input type="text" id="meta_title" name="meta_title" required maxlength="60" placeholder="Enter page title (max 60 chars)">
                            <div class="help-text">Appears in search results and browser tab</div>
                        </div>
                        <div class="form-group full-width">
                            <label for="meta_description">Meta Description *</label>
                            <textarea id="meta_description" name="meta_description" required maxlength="160" rows="3" placeholder="Enter page description (max 160 chars)"></textarea>
                            <div class="help-text">Brief description shown in search results</div>
                        </div>
                        <div class="form-group full-width">
                            <label for="meta_keywords">Meta Keywords</label>
                            <input type="text" id="meta_keywords" name="meta_keywords" placeholder="keyword1, keyword2, keyword3">
                            <div class="help-text">Comma-separated keywords (optional)</div>
                        </div>
                        <div class="form-group">
                            <label for="canonical_url">Canonical URL</label>
                            <input type="url" id="canonical_url" name="canonical_url" placeholder="https://tinytechnotoddlers.com/page">
                            <div class="help-text">Preferred URL for this page</div>
                        </div>
                    </div>
                    
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="no_index" name="no_index" value="1">
                            <label for="no_index">No Index (Hide from search engines)</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="no_follow" name="no_follow" value="1">
                            <label for="no_follow">No Follow (Don't follow links)</label>
                        </div>
                    </div>
                </div>

                <!-- Open Graph Section -->
                <div class="form-section">
                    <h4 class="section-title">
                        <i class="fab fa-facebook"></i>
                        Open Graph (Social Media)
                    </h4>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="og_title">OG Title</label>
                            <input type="text" id="og_title" name="og_title" maxlength="60" placeholder="Title for social media sharing">
                            <div class="help-text">Title when shared on Facebook, Twitter, etc.</div>
                        </div>
                        <div class="form-group">
                            <label for="og_image">OG Image URL</label>
                            <input type="url" id="og_image" name="og_image" placeholder="https://example.com/image.jpg">
                            <div class="help-text">Image shown when shared (1200x630px recommended)</div>
                        </div>
                        <div class="form-group full-width">
                            <label for="og_description">OG Description</label>
                            <textarea id="og_description" name="og_description" maxlength="200" rows="3" placeholder="Description for social media sharing"></textarea>
                            <div class="help-text">Description when shared on social media</div>
                        </div>
                    </div>
                </div>

                <!-- Schema Markup Section -->
                <div class="form-section">
                    <h4 class="section-title">
                        <i class="fas fa-code"></i>
                        Schema Markup (Structured Data)
                    </h4>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="schema_type">Schema Type</label>
                            <select id="schema_type" name="schema_type">
                                <option value="">Select Schema Type</option>
                                <option value="WebPage">Web Page</option>
                                <option value="Organization">Organization</option>
                                <option value="EducationalOrganization">Educational Organization</option>
                                <option value="LocalBusiness">Local Business</option>
                                <option value="Article">Article</option>
                                <option value="Course">Course</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="schema_name">Schema Name</label>
                            <input type="text" id="schema_name" name="schema_name" placeholder="Name for schema">
                        </div>
                        <div class="form-group">
                            <label for="schema_url">Schema URL</label>
                            <input type="url" id="schema_url" name="schema_url" placeholder="https://tinytechnotoddlers.com">
                        </div>
                        <div class="form-group">
                            <label for="schema_logo">Logo URL (Organization)</label>
                            <input type="url" id="schema_logo" name="schema_logo" placeholder="https://example.com/logo.png">
                        </div>
                        <div class="form-group">
                            <label for="schema_phone">Phone Number (Organization)</label>
                            <input type="tel" id="schema_phone" name="schema_phone" placeholder="+91 8000 333 555">
                        </div>
                        <div class="form-group full-width">
                            <label for="schema_description">Schema Description</label>
                            <textarea id="schema_description" name="schema_description" rows="3" placeholder="Description for schema markup"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="button" class="btn-cancel" onclick="hideSeoForm()">Cancel</button>
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Save SEO Meta
                </button>
            </div>
        </form>
    </div>

    <!-- SEO Table -->
    <div class="seo-table">
        <div class="table-header">
            <h3 class="table-title">SEO Meta Records</h3>
        </div>
        
        <div class="table-responsive">
            <table class="seo-data-table">
                <thead>
                    <tr>
                        <th>Page Key</th>
                        <th>Meta Preview</th>
                        <th>Open Graph</th>
                        <th>Schema</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($seo_result) > 0): ?>
                        <?php while ($seo = mysqli_fetch_assoc($seo_result)): ?>
                        <tr>
                            <td>
                                <span class="page-key-badge"><?php echo htmlspecialchars($seo['page_key']); ?></span>
                            </td>
                            <td>
                                <div class="meta-preview">
                                    <div class="meta-title"><?php echo htmlspecialchars(substr($seo['meta_title'], 0, 60)); ?></div>
                                    <div class="meta-url"><?php echo htmlspecialchars($seo['canonical_url'] ?: 'tinytechnotoddlers.com/' . $seo['page_key']); ?></div>
                                    <div class="meta-desc"><?php echo htmlspecialchars(substr($seo['meta_description'], 0, 160)); ?></div>
                                </div>
                            </td>
                            <td>
                                <?php if ($seo['og_title']): ?>
                                    <i class="fas fa-check-circle" style="color: #4CAF50;" title="OG tags configured"></i>
                                <?php else: ?>
                                    <i class="fas fa-times-circle" style="color: #f44336;" title="OG tags not configured"></i>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php 
                                $extras = json_decode($seo['extras'], true);
                                if (!empty($extras['schema']['@type'])): ?>
                                    <span style="font-size: 0.8rem; color: #6B2C91; font-weight: 600;">
                                        <?php echo htmlspecialchars($extras['schema']['@type']); ?>
                                    </span>
                                <?php else: ?>
                                    <span style="color: #999;">Not set</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo date('M j, Y', strtotime($seo['updated_at'])); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-sm btn-edit" onclick="editSeo(<?php echo $seo['id']; ?>)">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn-sm btn-delete" onclick="deleteSeo(<?php echo $seo['id']; ?>)">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: #666;">
                                <i class="fas fa-search" style="font-size: 3rem; margin-bottom: 20px; color: #ccc;"></i><br>
                                No SEO meta records found. Click "Add SEO Meta" to get started.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Show add form
function showAddForm() {
    document.getElementById('seoForm').classList.add('active');
    document.getElementById('formTitle').textContent = 'Add SEO Meta';
    document.getElementById('formAction').value = 'add_seo';
    document.getElementById('seoId').value = '';
    document.getElementById('seoFormElement').reset();
    document.body.style.overflow = 'hidden';
}

// Hide form
function hideSeoForm() {
    document.getElementById('seoForm').classList.remove('active');
    document.body.style.overflow = 'auto';
}

// Edit SEO
function editSeo(seoId) {
    fetch(`get_seo_data.php?id=${seoId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const seo = data.seo;
                
                document.getElementById('formTitle').textContent = 'Edit SEO Meta';
                document.getElementById('formAction').value = 'update_seo';
                document.getElementById('seoId').value = seoId;
                
                // Populate form fields
                document.getElementById('page_key').value = seo.page_key || '';
                document.getElementById('meta_title').value = seo.meta_title || '';
                document.getElementById('meta_description').value = seo.meta_description || '';
                document.getElementById('meta_keywords').value = seo.meta_keywords || '';
                document.getElementById('og_title').value = seo.og_title || '';
                document.getElementById('og_description').value = seo.og_description || '';
                document.getElementById('og_image').value = seo.og_image || '';
                document.getElementById('canonical_url').value = seo.canonical_url || '';
                document.getElementById('no_index').checked = seo.no_index == '1';
                document.getElementById('no_follow').checked = seo.no_follow == '1';
                
                // Schema fields
                const extras = JSON.parse(seo.extras || '{}');
                const schema = extras.schema || {};
                document.getElementById('schema_type').value = schema['@type'] || '';
                document.getElementById('schema_name').value = schema.name || '';
                document.getElementById('schema_url').value = schema.url || '';
                document.getElementById('schema_logo').value = schema.logo || '';
                document.getElementById('schema_description').value = schema.description || '';
                document.getElementById('schema_phone').value = (schema.contactPoint && schema.contactPoint.telephone) || '';
                
                document.getElementById('seoForm').classList.add('active');
                document.body.style.overflow = 'hidden';
            } else {
                alert('Error loading SEO data: ' + data.message);
            }
        })
        .catch(error => {
            alert('Error loading SEO data');
            console.error('Error:', error);
        });
}

// Delete SEO
function deleteSeo(seoId) {
    if (confirm('Are you sure you want to delete this SEO meta? This action cannot be undone.')) {
        const formData = new FormData();
        formData.append('action', 'delete_seo');
        formData.append('seo_id', seoId);
        formData.append('ajax', '1');
        
        fetch('seo.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            alert('Error deleting SEO meta');
            console.error('Error:', error);
        });
    }
}

// Character count for meta fields
document.addEventListener('DOMContentLoaded', function() {
    const metaTitle = document.getElementById('meta_title');
    const metaDescription = document.getElementById('meta_description');
    
    function updateCharCount(element, maxLength) {
        const helpText = element.nextElementSibling;
        if (helpText && helpText.classList.contains('help-text')) {
            const remaining = maxLength - element.value.length;
            const originalText = helpText.textContent.split('(')[0];
            helpText.textContent = `${originalText}(${remaining} chars remaining)`;
            
            if (remaining < 0) {
                helpText.style.color = '#f44336';
            } else if (remaining < 10) {
                helpText.style.color = '#ff9800';
            } else {
                helpText.style.color = '#666';
            }
        }
    }
    
    metaTitle.addEventListener('input', () => updateCharCount(metaTitle, 60));
    metaDescription.addEventListener('input', () => updateCharCount(metaDescription, 160));
    
    // Auto-fill OG fields from meta fields
    metaTitle.addEventListener('input', function() {
        const ogTitle = document.getElementById('og_title');
        if (!ogTitle.value) {
            ogTitle.value = this.value;
        }
    });
    
    metaDescription.addEventListener('input', function() {
        const ogDescription = document.getElementById('og_description');
        if (!ogDescription.value) {
            ogDescription.value = this.value;
        }
    });
});

// Close form when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('seo-form') && e.target.classList.contains('active')) {
        hideSeoForm();
    }
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hideSeoForm();
    }
});
</script>

<?php include 'footer.php'; ?>
