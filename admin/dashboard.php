<?php
include '../includes/db_connect.php';

// Sample/Fake data for demonstration
$sample_messages = [
    [
        'id' => 1,
        'full_name' => 'Sarah Smith',
        'email' => 'sarah@gmail.com',
        'phone' => '+1 (555) 123-4567',
        'subject' => 'Complete message',
        'message' => 'I am interested in your services for my upcoming project.',
        'created_at' => '2026-05-14 10:30:00',
        'status' => 'New'
    ],
    [
        'id' => 2,
        'full_name' => 'Alex Lee',
        'email' => 'alex.lee@gmail.com',
        'phone' => '+1 (555) 234-5678',
        'subject' => 'Project inquiry',
        'message' => 'Would love to collaborate on a new web development project.',
        'created_at' => '2026-05-14 09:15:00',
        'status' => 'Read'
    ],
    [
        'id' => 3,
        'full_name' => 'Sarah Smith',
        'email' => 'arinclare@gmail.com',
        'phone' => '+1 (555) 345-6789',
        'subject' => 'Login subject',
        'message' => 'Need help with authentication implementation.',
        'created_at' => '2026-05-14 08:45:00',
        'status' => 'Read'
    ],
    [
        'id' => 4,
        'full_name' => 'Sarah Smith',
        'email' => 'brownen@gmail.com',
        'phone' => '+1 (555) 456-7890',
        'subject' => 'Design content',
        'message' => 'Looking for UI/UX design consultation.',
        'created_at' => '2026-05-14 07:20:00',
        'status' => 'New'
    ],
    [
        'id' => 5,
        'full_name' => 'Sarah Smith',
        'email' => 'email1@gmail.com',
        'phone' => '+1 (555) 567-8901',
        'subject' => 'Backend development',
        'message' => 'Interested in backend API development services.',
        'created_at' => '2026-05-13 14:10:00',
        'status' => 'Read'
    ]
];

$total_messages = count($sample_messages);
$new_messages = 2;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body { background: var(--bg-color); }
        
        .dashboard-header {
            padding: 1.5rem 9%;
            background: linear-gradient(135deg, var(--second-bg-color), rgba(0, 255, 238, 0.05));
            border-bottom: 2px solid var(--main-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 100;
            gap: 3rem;
        }

        .dashboard-header h1 {
            font-size: 1.8rem;
            color: var(--text-color);
            margin: 0;
        }

        .dashboard-header h1 span {
            color: var(--main-color);
        }

        .header-tabs {
            display: flex;
            gap: 2rem;
            flex: 1;
        }

        .header-tabs a {
            color: var(--text-color);
            text-decoration: none;
            padding: 0.5rem 0;
            border-bottom: 2px solid transparent;
            transition: all 0.3s;
        }

        .header-tabs a.active {
            color: var(--main-color);
            border-bottom-color: var(--main-color);
        }

        .header-tabs a:hover {
            color: var(--main-color);
        }

        .header-search {
            display: flex;
            align-items: center;
            background: rgba(0, 255, 238, 0.1);
            border: 1px solid var(--main-color);
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            gap: 0.5rem;
            min-width: 300px;
        }

        .header-search input {
            background: transparent;
            border: none;
            color: var(--text-color);
            flex: 1;
            outline: none;
        }

        .header-search input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .header-search button {
            background: none;
            border: none;
            color: var(--main-color);
            cursor: pointer;
            font-size: 1.1rem;
        }

        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 8rem 9% 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: var(--second-bg-color);
            border: 2px solid var(--main-color);
            border-radius: 1rem;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s;
        }

        .stat-card:hover {
            box-shadow: 0 0 2rem rgba(0, 255, 238, 0.3);
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--main-color);
            margin: 0.5rem 0;
        }

        .stat-subtitle {
            font-size: 0.85rem;
            color: #ff6b6b;
            margin-top: -0.5rem;
        }

        .stat-label {
            font-size: 1rem;
            color: var(--text-color);
        }

        .stat-icon {
            font-size: 2rem;
            color: var(--main-color);
        }

        .main-content {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .messages-section {
            background: var(--second-bg-color);
            border: 2px solid var(--main-color);
            border-radius: 1rem;
            padding: 2rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--main-color);
        }

        .section-header h2 {
            color: var(--text-color);
            margin: 0;
            font-size: 1.5rem;
        }

        .filter-btn {
            background: transparent;
            border: 1px solid var(--main-color);
            color: var(--main-color);
            padding: 0.5rem 1.2rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-btn:hover {
            background: var(--main-color);
            color: var(--bg-color);
        }

        .messages-table {
            width: 100%;
            border-collapse: collapse;
        }

        .messages-table thead {
            background: rgba(0, 255, 238, 0.1);
        }

        .messages-table th {
            padding: 1rem;
            text-align: left;
            color: var(--main-color);
            font-weight: 600;
            border-bottom: 2px solid var(--main-color);
            font-size: 0.9rem;
        }

        .messages-table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(0, 255, 238, 0.2);
            color: var(--text-color);
            font-size: 0.95rem;
        }

        .messages-table tbody tr:hover {
            background: rgba(0, 255, 238, 0.05);
        }

        .status-new {
            background: #ff6b6b;
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 0.3rem;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-read {
            background: #51cf66;
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 0.3rem;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            background: transparent;
            border: 1px solid var(--main-color);
            color: var(--main-color);
            padding: 0.4rem 0.8rem;
            border-radius: 0.3rem;
            cursor: pointer;
            font-size: 0.75rem;
            transition: all 0.3s;
            white-space: nowrap;
        }

        .action-btn:hover {
            background: var(--main-color);
            color: var(--bg-color);
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .sidebar-section {
            background: var(--second-bg-color);
            border: 2px solid var(--main-color);
            border-radius: 1rem;
            padding: 1.5rem;
        }

        .sidebar-section h3 {
            color: var(--main-color);
            margin: 0 0 1.5rem 0;
            font-size: 1.1rem;
        }

        .quick-action {
            background: transparent;
            border: 1px solid var(--main-color);
            color: var(--main-color);
            padding: 0.8rem 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            margin-bottom: 0.8rem;
            transition: all 0.3s;
            text-align: left;
            font-size: 0.9rem;
            width: 100%;
        }

        .quick-action:hover {
            background: var(--main-color);
            color: var(--bg-color);
        }

        .quick-action i {
            margin-right: 0.5rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--text-color);
        }

        @media (max-width: 1024px) {
            .main-content {
                grid-template-columns: 1fr;
            }

            .header-search {
                min-width: 200px;
            }
        }

        @media (max-width: 768px) {
            .dashboard-header {
                flex-direction: column;
                gap: 1rem;
            }

            .header-tabs {
                width: 100%;
                justify-content: center;
            }

            .header-search {
                width: 100%;
                min-width: auto;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-header">
        <h1>Admin <span>&lt;Dashboard&gt;</span></h1>
        <div class="header-tabs">
            <a href="#" class="active">Site Overview</a>
            <a href="#">Messages</a>
            <a href="#">Project Leads</a>
        </div>
        <div class="header-search">
            <input type="text" placeholder="Search Projects/Messages...">
            <button><i class="fas fa-search"></i></button>
        </div>
    </div>

    <div class="dashboard-container">
        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-envelope stat-icon"></i>
                <div class="stat-label">New Messages</div>
                <div class="stat-number"><?php echo $new_messages; ?></div>
                <div class="stat-subtitle">Urgent</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-code stat-icon"></i>
                <div class="stat-label">Active Services</div>
                <div class="stat-number">1</div>
                <div class="stat-subtitle">Needs Update</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-file-alt stat-icon"></i>
                <div class="stat-label">Project Leads</div>
                <div class="stat-number">2</div>
                <div class="stat-subtitle">Follow-ups</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-database stat-icon"></i>
                <div class="stat-label">Database Status</div>
                <div class="stat-number">ONLINE</div>
                <div class="stat-subtitle">Uptime: 99.9%</div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Messages Section -->
            <div class="messages-section">
                <div class="section-header">
                    <h2><i class="fas fa-comments"></i> Recent Contact Messages</h2>
                    <button class="filter-btn">Filter</button>
                </div>
                
                <table class="messages-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Sender</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sample_messages as $msg): ?>
                        <tr>
                            <td><?php echo date('M d, Y', strtotime($msg['created_at'])); ?></td>
                            <td><strong><?php echo htmlspecialchars($msg['full_name']); ?></strong></td>
                            <td><?php echo htmlspecialchars(substr($msg['email'], 0, 20)); ?></td>
                            <td><?php echo htmlspecialchars($msg['subject']); ?></td>
                            <td>
                                <span class="<?php echo ($msg['status'] === 'New') ? 'status-new' : 'status-read'; ?>">
                                    <?php echo $msg['status']; ?>
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn">Reply</button>
                                    <button class="action-btn">Archive</button>
                                    <button class="action-btn">Mark as Urgent</button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Workflow Center -->
                <div class="sidebar-section">
                    <h3>Workflow Center</h3>
                    <h4 style="color: #ff6b6b; margin-top: 1rem; margin-bottom: 0.5rem;">Leads</h4>
                    <p style="font-size: 0.85rem; margin: 0;">Project portfolio</p>
                    <p style="font-size: 0.8rem; color: rgba(255,255,255,0.6); margin: 0.2rem 0;">Search after 1</p>
                    <p style="font-size: 0.8rem; color: rgba(255,255,255,0.6); margin: 0 0 1rem 0;">Details: 1 issues</p>
                    
                    <h4 style="color: #ffa94d; margin-top: 1rem; margin-bottom: 0.5rem;">In Progress</h4>
                    <p style="font-size: 0.85rem; margin: 0;">Project project Statement</p>
                    <p style="font-size: 0.8rem; color: rgba(255,255,255,0.6); margin: 0.2rem 0;">Search after 2</p>
                    <p style="font-size: 0.8rem; color: rgba(255,255,255,0.6); margin: 0 0 1rem 0;">Details: 1 data</p>
                    
                    <h4 style="color: #51cf66; margin-top: 1rem; margin-bottom: 0.5rem;">Completed</h4>
                    <p style="font-size: 0.85rem; margin: 0;">Project project Completed</p>
                    <p style="font-size: 0.8rem; color: rgba(255,255,255,0.6); margin: 0.2rem 0;">Search after 3</p>
                </div>

                <!-- Quick Actions -->
                <div class="sidebar-section">
                    <h3>Quick Actions</h3>
                    <button class="quick-action"><i class="fas fa-plus"></i> Add New Service</button>
                    <button class="quick-action"><i class="fas fa-edit"></i> Edit Home Content</button>
                    <button class="quick-action"><i class="fas fa-image"></i> Update Profile Photo</button>
                    <button class="quick-action"><i class="fas fa-database"></i> View SQL Logs</button>
                    <button class="quick-action"><i class="fas fa-download"></i> Bulk Message Export</button>
                    <button class="quick-action"><i class="fas fa-chart-line"></i> View Lead Conversion Rate</button>
                    <button class="quick-action"><i class="fas fa-search"></i> Update SEO Meta</button>
                    <button class="quick-action"><i class="fas fa-shield-alt"></i> Database Backup</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>