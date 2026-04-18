<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    
    $sql = "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);
    
    if ($stmt->execute()) {
        // Success! Show a nice message with CORRECT links
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Message Sent Successfully</title>
            <style>
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }
                body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    background-color: #f1f5f9;
                    min-height: 100vh;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
                .success-container {
                    max-width: 500px;
                    margin: 50px 20px;
                    padding: 40px;
                    background-color: white;
                    border-radius: 16px;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                    text-align: center;
                }
                .success-icon {
                    font-size: 64px;
                    margin-bottom: 20px;
                }
                h1 {
                    color: #28a745;
                    margin-bottom: 20px;
                }
                p {
                    color: #333;
                    margin-bottom: 15px;
                    line-height: 1.6;
                }
                .message-preview {
                    background-color: #e9ecef;
                    padding: 15px;
                    border-radius: 8px;
                    margin: 20px 0;
                    text-align: left;
                }
                .btn {
                    display: inline-block;
                    padding: 12px 24px;
                    margin: 10px 5px;
                    background-color: #5c5d5e;
                    color: white;
                    text-decoration: none;
                    border-radius: 6px;
                    transition: background-color 0.3s;
                }
                .btn:hover {
                    background-color: #3a8df4;
                }
                .btn-primary {
                    background-color: #28a745;
                }
                .btn-primary:hover {
                    background-color: #218838;
                }
            </style>
        </head>
        <body>
            <div class="success-container">
                <div class="success-icon">✅</div>
                <h1>Message Sent Successfully!</h1>
                <p>Thank you <strong><?php echo htmlspecialchars($name); ?></strong> for reaching out to me.</p>
                <p>I will get back to you at <strong><?php echo htmlspecialchars($email); ?></strong> as soon as possible.</p>
                
                <div class="message-preview">
                    <strong>Your message:</strong><br>
                    <?php echo nl2br(htmlspecialchars($message)); ?>
                </div>
                
                <!-- FIXED LINKS - Notice the /myprofile/frontend/ paths -->
                <div>
                    <a href="/myprofile/frontend/Contact.html" class="btn">📝 Send Another Message</a>
                    <a href="/myprofile/frontend/index.html" class="btn btn-primary">🏠 Back to Home</a>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        // Error message
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Error</title>
            <style>
                body { font-family: Arial; text-align: center; padding: 50px; }
                .error { background: #f8d7da; padding: 20px; border-radius: 10px; color: #721c24; }
            </style>
        </head>
        <body>
            <div class="error">
                <h1>❌ Error</h1>
                <p>Something went wrong. Please try again.</p>
                <p>Error: <?php echo $stmt->error; ?></p>
                <a href="/myprofile/frontend/Contact.html">Go Back to Form</a>
            </div>
        </body>
        </html>
        <?php
    }
    
    $stmt->close();
    $conn->close();
} else {
    // If someone tries to access this file directly
    header("Location: /myprofile/frontend/Contact.html");
    exit;
}
?>