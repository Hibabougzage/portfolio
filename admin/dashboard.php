<?php
include '../includes/db_connect.php';

$result = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
$total_messages = $conn->query("SELECT COUNT(*) as count FROM messages")->fetch_assoc()['count'];
$new_messages = $conn->query("SELECT COUNT(*) as count FROM messages WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)")->fetch_assoc()['count'];

if (!$result) {
    $error = "Error fetching messages: " . $conn->error;
}
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
            padding: 2rem 9%;
            background: linear-gradient(135deg, var(--second-bg-color), rgba(0, 255, 238, 0.05));
            border-bottom: 2px solid var(--main-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 100;
        }

        .dashboard-header h1 {
            font-size: 2.5rem;
            color: var(--text-color);
        }

        .dashboard-header h1 span {
            color: var(--main-color);
        }

        .view-portfolio-btn {
            background: var(--main-color);
            color: var(--bg-color);
            padding: 0.8rem 2rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .view-portfolio-btn:hover {
            box-shadow: 0 0 1.5rem var(--main-color);
            transform: translateY(-2px);
        }

        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 10rem 9% 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: var(--second-bg-color);
            border: 2px solid var(--main-color);
            border-radius: 1rem;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s;
        }

        .stat-card:hover {
            box-shadow: 0 0 2rem rgba(0, 255, 238, 0.3);
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--main-color);
            margin: 1rem 0;
        }

        .stat-label {
            font-size: 1.1rem;
            color: var(--text-color);
        }

        .stat-icon {
            font-size: 2rem;
            color: var(--main-color);
        }

        .messages-section {
            background: var(--second-bg-color);
            border: 2px solid var(--main-color);
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 3rem;
        }

        .messages-section h2 {
            color: var(--text-color);
            margin-bottom: 2rem;
            font-size: 1.8rem;
            border-bottom: 2px solid var(--main-color);
            padding-bottom: 1rem;
        }

        .messages-table {
            width: 100%;
            border-collapse: collapse;
            overflow-x: auto;
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
        }

        .messages-table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(0, 255, 238, 0.2);
            color: var(--text-color);
        }

        .messages-table tbody tr:hover {
            background: rgba(0, 255, 238, 0.05);
        }

        .status-new {
            background: #ff6b6b;
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 0.3rem;
            font-size: 0.85rem;
        }

        .status-read {
            background: #51cf66;
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 0.3rem;
            font-size: 0.85rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--text-color);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--main-color);
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="dashboard-header">
        <h1>Admin <span>&lt;Dashboard&gt;</span></h1>
        <a href="../index.php" class="view-portfolio-btn">View Live Portfolio</a>
    </div>

    <div class="dashboard-container">
        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-envelope stat-icon"></i>
                <div class="stat-label">New Messages</div>
                <div class="stat-number"><?php echo $new_messages; ?></div>
            </div>
            <div class="stat-card">
                <i class="fas fa-database stat-icon"></i>
                <div class="stat-label">Total Messages</div>
                <div class="stat-number"><?php echo $total_messages; ?></div>
            </div>
            <div class="stat-card">
                <i class="fas fa-check-circle stat-icon"></i>
                <div class="stat-label">Database Status</div>
                <div class="stat-number">ONLINE</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-clock stat-icon"></i>
                <div class="stat-label">Last Updated</div>
                <div class="stat-number">NOW</div>
            </div>
        </div>

        <!-- Messages Section -->
        <div class="messages-section">
            <h2><i class="fas fa-comments"></i> Contact Messages</h2>
            
            <?php if (isset($error)): ?>
                <p style="color: #ff6b6b;">⚠️ <?php echo $error; ?></p>
            <?php elseif ($result->num_rows == 0): ?>
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p style="font-size: 1.2rem;">No messages yet</p>
                    <p style="color: var(--main-color);">Messages from your contact form will appear here</p>
                </div>
            <?php else: ?>
                <table class="messages-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Sender Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): 
                            $created_date = strtotime($row['created_at']);
                            $today = strtotime('today');
                            $is_new = $created_date >= $today;
                        ?>
                        <tr>
                            <td><?php echo date('M d, Y', $created_date); ?></td>
                            <td><strong><?php echo htmlspecialchars($row['full_name']); ?></strong></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($row['subject'] ?? 'No Subject'); ?></td>
                            <td><?php echo htmlspecialchars(substr($row['message'], 0, 50)) . (strlen($row['message']) > 50 ? '...' : ''); ?></td>
                            <td>
                                <span class="<?php echo $is_new ? 'status-new' : 'status-read'; ?>">
                                    <?php echo $is_new ? 'New' : 'Read'; ?>
                                </span>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>