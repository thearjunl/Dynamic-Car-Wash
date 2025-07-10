
Conversation opened. 1 unread message. 

Skip to content
Using Academic Enterprise Solutions (AES) Mail with screen readers
Enable desktop notifications for Academic Enterprise Solutions (AES) Mail.
   OK  No thanks

10 of 3,924
(no subject)
Inbox

SALU MANOJ
Attachments
Mar 5, 2024, 10:33 PM (15 hours ago)
to me


 3 Attachments
  •  Scanned by Gmail
<?php
require('connect.php');

function sanitizeInput($input)
{
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars($input));
}

if(isset($_GET['us_id'])) {
    $user_id = sanitizeInput($_GET['us_id']);
    
    // Prepare the SQL statement for tbl_registration
    $sql_registration = "UPDATE tbl_registration SET status = (CASE WHEN status = 0 THEN 1 ELSE 0 END) WHERE us_id = ?";
    
    // Prepare the SQL statement for tbl_login
    $sql_login = "UPDATE tbl_login SET status = (CASE WHEN status = 0 THEN 1 ELSE 0 END) WHERE us_id = ?";
    
    // Prepare and execute the SQL statements
    $stmt_registration = $conn->prepare($sql_registration);
    $stmt_login = $conn->prepare($sql_login);

    if ($stmt_registration && $stmt_login) {
        // Bind parameters for tbl_registration
        $stmt_registration->bind_param("i", $user_id);
        
        // Bind parameters for tbl_login
        $stmt_login->bind_param("i", $user_id);
        
        // Execute the statements
        if ($stmt_registration->execute() && $stmt_login->execute()) {
            // Status updated successfully in both tables
            header("Location: admin.php"); // Redirect to the same page after updating
            exit();
        } else {
            // Error in execution
            echo "Error: " . $stmt_registration->error;
        }
        
        // Close statements
        $stmt_registration->close();
        $stmt_login->close();
    } else {
        // Error in preparation
        echo "Error: " . $conn->error;
    }
}
?>
toggle_status.php
Displaying add_staff.php.