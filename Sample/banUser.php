<?php
require_once 'header.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookreview";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tbluseraccount WHERE userType = 0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Ban Users</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <style>
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 24px;
                margin-bottom: 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            .ban-button, .unban-button {
                padding: 6px 12px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .ban-button {
                background-color: #ff0000;
                color: #fff;
            }

            .unban-button {
                background-color: #00ff00;
                color: #fff;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Ban Users</h2>
            <table>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['Firstname'] . "</td>";
                    echo "<td>" . $row['Lastname'] . "</td>";
                    echo "<td>" . $row['Username'] . "</td>";
                    echo "<td>" . $row['Email'] . "</td>";
                    echo "<td>" . ($row['Status'] == 1 ? 'Banned' : 'Active') . "</td>";
                    echo "<td>";
                    if ($row['Status'] == 0) {
                        echo '<form action="banUserAction.php" method="post">';
                        echo '<input type="hidden" name="username" value="' . $row['Username'] . '">';
                        echo '<button class="ban-button" type="submit" name="ban">Ban</button>';
                        echo '</form>';
                    } else {
                        echo '<form action="banUserAction.php" method="post">';
                        echo '<input type="hidden" name="username" value="' . $row['Username'] . '">';
                        echo '<button class="unban-button" type="submit" name="unban">Unban</button>';
                        echo '</form>';
                    }
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "No users found.";
}

$conn->close();

require_once 'footer.php';
?>
