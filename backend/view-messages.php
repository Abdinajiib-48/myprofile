<?php
// backend/view-messages.php
// This page shows all messages (like an admin panel)

require_once "config.php";

// Get all messages from database
$sql = "SELECT * FROM contact_messages ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Messages - Admin</title>
    <link rel="stylesheet" href="/style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #5c5d5e;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .message-preview {
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📬 Contact Messages</h1>
        <p>Total messages: <?php echo $result->num_rows; ?></p>
        
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date Received</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td class="message-preview"><?php echo htmlspecialchars($row['message']); ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No messages yet.</p>
        <?php endif; ?>
        
        <a href="../frontend/Contact.html" class="back-link">← Back to Contact Form</a>
        <br>
        <a href="../frontend/index.html" class="back-link">← Back to Home</a>
    </div>
</body>
</html>

<?php $conn->close(); ?>