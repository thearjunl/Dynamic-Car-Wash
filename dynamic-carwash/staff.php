
<?php
session_start();
include("send_memo.php");
include('inc/config.php');
function sanitizeInput($input)
{
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars($input));
}

if(isset($_GET['search'])) {
    $search = sanitizeInput($_GET['search']);
    // Modify the SQL query to filter staff members based on the first letter of the name (case-insensitive)
    $sql = "SELECT * FROM tbl_staff WHERE LOWER(LEFT(name, 1)) = LOWER('$search') OR LOWER(LEFT(expertise, 1)) = LOWER('$search')";
} else {
    // Default SQL query to fetch all staff members
    $sql = "SELECT * FROM tbl_staff";
}

// Fetch staff members from the database
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Admin Dashboard</title>
<style>
    /* staff table styles */
    body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        
    table {
        width: 90%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #333;
        color: orange;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    /* Edit and delete links */
    .action-links a {
        text-decoration: none;
        margin-right: 5px;
        padding: 3px 8px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    /* Style the side navigation */
    .sidenav {
        height: 100%;
        width: 250px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #111;
        padding-top: 20px;
    }

    /* Side navigation links */
    .sidenav a {
        padding: 10px 70px;
        text-decoration: none;
        font-size: 18px;
        color: #818181;
        display: block;
    }

    .sidenav h2{
        padding: 20px 70px;
        color: orange;
        margin-bottom: 30px;
        margin-top: -8px;
    }

    /* Change color on hover */
    .sidenav a:hover {
        color: orange;
    }

    /* Avatar styles */
    .admin-avatar {
        text-align: center; /* Center the avatar */
    }

    /* Avatar image styles */
    .avatar-img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }

    /* Logout link styles */
    .logout-link {
        color: #fff;
        text-decoration: none;
        margin-top: 1px;
        display: block; /* Make the logout link a block element */
    }

    /* Container styles */
    .container {
        margin-left: 280px; /* Adjust margin-left to accommodate side nav width */
        padding-top: 20px; /* Add padding-top for spacing */
    }

    /* Background color for container */
    .container-bg {
        background-color: #333;
        padding: 20px;
        margin-top: -8px; /* Adjust margin-top to align with side nav */
        width:100%;
    }

    /* Adjust table margin */
    table {
        margin-top: 20px;
    }

    .memo-btn {
            background-color: blue;
            color: white;
            margin-right: 10px;
            margin-bottom: 10px;
            width: 70px;
        }

        /* Active button */
        .active-button {
            background-color: green;
            color: white;
        }

        /* Inactive button */
        .deactive-button {
            background-color: red;
            color: white;
        }

        .active-button,
.inactive-button {
    margin-top: -5px; /* Adjust vertical alignment */
}
   

    .button-container {
    display: flex; /* Use flexbox to align buttons horizontally */
    justify-content: flex-start; /* Align items to the start of the container (left side) */
}

#search-input {
    margin-top:20px;
            width: 400px;
        }


</style>
</head>
<body>
<div class="sidenav">
    <div class="admin-avatar"> <!-- Avatar and logout link container -->
        <img src="admin.png" alt="Admin Avatar" class="avatar-img">
    </div>
    <h2>ADMIN</h2>
    <a href="admin.php">View Users</a>
    <a href="staff.php">View Staff</a>
    <a href="#">View Orders</a>
    <a href="product.php">Products</a>
    <a href="user_service.php">User Service</a>
    <a href="logout.php" class="logout-link">Logout</a>
</div>

<div class="container-bg"></div>
<div class="container">
    <h2>STAFF</h2>
    <button class="add-button" onclick="window.location.href='add_staff.php'">Add Staff</button>

     <!-- Search form -->
     <div class="search-form">
        <input type="text" id="search-input" class="form-control mb-3" placeholder="Search staff">
    </div>

        <!-- Staff table -->
        <table border="1" id="staff-table">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Expertise</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            $sequenceNumber = 1;
            while ($row = $result->fetch_assoc()) {
            
                echo "<tr>";
                echo "<td>" . $sequenceNumber . "</td>"; 
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["expertise"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["phone"] . "</td>";
                echo "<td>";
                // Memo button
                echo "<button type='button' name='memo' class='memo-btn' onclick='openMemoPopup(\"" . $row['name'] . "\", \"" . $row['email'] . "\")'>Memo</button>";
                // Activate/Deactivate button
                echo "<form id='statusForm_" . $row['staff_id'] . "' onsubmit='return false;'>";
                echo "<input type='hidden' name='staff_id' value='" . $row['staff_id'] . "'>";
                if ($row['status'] == 0) {
                    echo "<button type='button' class='active-button' onclick='toggleStatus(" . $row['staff_id'] . ", 1)'>Activate</button>";
                } else {
                    echo "<button type='button' class='deactive-button' onclick='toggleStatus(" . $row['staff_id'] . ", 0)'>Deactivate</button>";
                }
                echo "</form>";
                echo "</td>";
                echo "</tr>";
                $sequenceNumber++;
            }
        } else {
            // If no records found in the result set
            echo "<tr><td colspan='7'>No records found</td></tr>";
        }
        ?>
    </table>
    <?php

if(isset($_POST['send'])) {
$email= $_POST['email'];
$memo=$_POST['memo'];
echo "<script>showNotification('Email sent successfully.');</script>";
$send_success = sendMemoEmail($email, $memo);

if ($send_success) {
   
} else {
    echo "<script>showNotification('Failed to send email.');</script>";
}
}
?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var searchInputField = document.getElementById('search-input');
    var staffTable = document.getElementById('staff-table');
    var rows = staffTable.getElementsByTagName('tr');

    searchInputField.addEventListener('input', function() {
        var searchText = searchInputField.value.toLowerCase();

        // Loop through all table rows
        for (var i = 1; i < rows.length; i++) { // Start from index 1 to skip the header row
            var row = rows[i];
            var name = row.cells[1].textContent.toLowerCase(); // Get the text content of the Name column
            var expertise = row.cells[2].textContent.toLowerCase(); // Get the text content of the Expertise column

            // Check if the search text matches the beginning of either name or expertise
            if (searchText === '' || 
                (name.indexOf(searchText) === 0 && searchText.length <= 8) || 
                (expertise.indexOf(searchText) === 0 && searchText.length <= 8)) {
                row.style.display = ''; // Show the row
            } else {
                row.style.display = 'none'; // Hide the row
            }
        }
    });
});

    // Function to toggle staff member status using AJAX
    function toggleStatus(staffId, newStatus) {
        // Send AJAX request to toggle_status.php script
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Reload the page or update the table dynamically after successful toggle
                window.location.reload(); // You can also update the table dynamically using JavaScript
            }
        };
        xhr.open("POST", "toggle_status.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("staff_id=" + staffId + "&new_status=" + newStatus);
    }

    function openMemoPopup(name, email) {
    var memoPopup = document.createElement('div');
    memoPopup.innerHTML = `
        <div class="memo-popup" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 999;">
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 5px;">
                <h3>Write Memo for ${name}</h3>
                <form id="memoForm" method="POST">
                    <input type="hidden" id="email" name="email" value="${email}">
                    <input type="hidden" id="memo" name="memo"> <!-- Hidden input for memo content -->
                    <label for="action">Select Action:</label><br>
                    <input type="radio" id="disciplinary" name="action" value="disciplinary" checked> <!-- Set the disciplinary option as default checked -->
                    <label for="disciplinary">Disciplinary Action</label><br>
                    <input type="radio" id="late" name="action" value="late">
                    <label for="late">Late for Service</label><br><br>
                    <input type="submit" name="send" value="Send">
                    <input type="button" value="Cancel" onclick="closeMemoPopup()">
                </form>
            </div>
        </div>
    `;
    document.body.appendChild(memoPopup);

    // Set event listener to update memo content when action changes
    var radioButtons = document.querySelectorAll('input[name="action"]');
    radioButtons.forEach(function(radioButton) {
        radioButton.addEventListener('change', function() {
            updateMemoContent(name);
        });
    });

    // Initial memo content update
    updateMemoContent(name);
}

function updateMemoContent(name) {
    var memoInput = document.getElementById('memo');
    var action = document.querySelector('input[name="action"]:checked').value;

    // Get the current date
    var currentDate = new Date().toLocaleDateString();

    // Replace placeholders with dynamic values
    var memoContent = '';
    if (action === 'disciplinary') {
        memoContent = "Dear " + name + ",\n\nThis is to inform you that disciplinary action is being taken against you due to the following reasons:\n\n 1. Excessive absenteeism without prior notification.\n 2. Violation of company policies regarding workplace conduct.\n 3. Failure to meet performance targets despite repeated warnings.\n\n The disciplinary action may include but is not limited to:\n  - Verbal warning\n  - Written warning\n  - Suspension\n  - Termination of employment\n\n Please note that this action is being taken in accordance with the company's policies and procedures.\n\n We expect your full cooperation and compliance with the corrective measures outlined in this disciplinary action.\n\n If you have any questions or concerns regarding this matter, please feel free to contact [HR Department/Supervisor's Name] at [HR Department/Supervisor's Email].\n\n Sincerely,\n\nAdmin\n\nSmartphone Galaxy Store \n\n Date: " + currentDate;
    } else if (action === 'late') {
        memoContent = `Dear ${name},\n\nThis is to inform you that you have been marked as late for service on ${currentDate}. Please ensure that you make every effort to arrive on time for your scheduled service in the future.\n\nThank you for your attention to this matter.\n\nBest regards,\nAdmin\nSmartphone Galaxy Store`;
    }

    memoInput.value = memoContent;
}

function closeMemoPopup() {
    var memoPopup = document.querySelector('.memo-popup');
    if (memoPopup) {
        memoPopup.parentNode.removeChild(memoPopup);
    }
}

function sendMemo(email) {
    var action = document.querySelector('input[name="action"]:checked').value;
    var memoContent = document.getElementById('memo').value;

    var currentDate = new Date().toLocaleDateString();
    var staffName = ''; // You need to fetch the staff name dynamically

    // Adjust the memo content based on the selected action
    if (action === 'disciplinary') {
    // Add predefined content for disciplinary action
    memoContent = "Dear " + staffName + ",\n\nThis is to inform you that disciplinary action is being taken against you due to the following reasons:\n\n 1. Excessive absenteeism without prior notification.\n 2. Violation of company policies regarding workplace conduct.\n 3. Failure to meet performance targets despite repeated warnings.\n\n The disciplinary action may include but is not limited to:\n  - Verbal warning\n  - Written warning\n  - Suspension\n  - Termination of employment\n\n Please note that this action is being taken in accordance with the company's policies and procedures.\n\n We expect your full cooperation and compliance with the corrective measures outlined in this disciplinary action.\n\n If you have any questions or concerns regarding this matter, please feel free to contact [HR Department/Supervisor's Name] at [HR Department/Supervisor's Email].\n\n Sincerely,\n\n [Your Name]\n [Your Position/Title]\n [Company Name] \n\n Date: " + currentDate;

    } else if (action === 'late') {
        // Add predefined content for late for service
        memoContent = "[Late for Service] Dear " + staffName + ",\n\nThis is to inform you that you have been marked as late for service on " + currentDate + " at [time].\n\n[Additional details or instructions]";
    }

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Memo sent successfully, show the notification
                showNotification('Memo sent successfully!');
                // Close the popup
                closeMemoPopup();
            } else {
                // Memo sending failed, show the error notification
                showNotification('Failed to send memo. Please try again.');
            }
        }
    };
    xhr.open("POST", "send_memo.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var params = "email=" + encodeURIComponent(email) + "&memo=" + encodeURIComponent(memoContent) + "&send=true";
    console.log(action);
    console.log("Sending memo:", memoContent);
    xhr.send(params);
}

</script>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
staff.php
Displaying add_staff.php.