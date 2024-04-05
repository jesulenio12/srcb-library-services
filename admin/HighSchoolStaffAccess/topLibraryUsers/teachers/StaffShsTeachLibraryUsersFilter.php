<?php
require 'conn.php';

$filterTitle = ""; // Initialize an empty variable for the filter title

if (isset($_POST['filter'])) {
    // Get start and end dates from the form
    $firstDate = date("Y-m-d", strtotime($_POST['firstDate']));
    $secondDate = date("Y-m-d", strtotime($_POST['secondDate']));
    $gender = $_POST['gender'];
    $departmentType = $_POST['departmentType'];

    // Construct the dynamic SQL query with date filter
    $sql = "SELECT
                attendance.library_userID,
                attendance.fullname,
                attendance.gender,
                attendance.departmentType,
                COUNT(*) as EntryCount
            FROM
                attendance
            WHERE 
                timeIn BETWEEN '$firstDate' AND '$secondDate' AND gender LIKE '$gender%' AND departmentType LIKE '$departmentType%'
                AND
                userType = 'Teacher' && libraryClass = 'High School Library' AND MONTH(timeIn) = MONTH(CURRENT_DATE) AND YEAR(timeIn) = YEAR(CURRENT_DATE)
            GROUP BY
                attendance.library_userID, attendance.fullname, attendance.gender, attendance.departmentType
            ORDER BY
                EntryCount DESC";

    // Set the filter title
    $filterTitle = "Library Statistics from " . date('F j, Y', strtotime($firstDate)) . ' to ' . date('F j, Y', strtotime($secondDate));
} else {
    // Default query without date filter
    $sql = "SELECT
                attendance.library_userID,
                attendance.fullname,
                attendance.gender,
                attendance.departmentType,
                COUNT(*) AS EntryCount
            FROM
                attendance
            WHERE
                libraryClass = 'High School Library' && userType = 'Teacher' AND MONTH(timeIn) = MONTH(CURRENT_DATE) AND YEAR(timeIn) = YEAR(CURRENT_DATE)
            GROUP BY
                attendance.library_userID, attendance.fullname, attendance.gender, attendance.departmentType
            ORDER BY
                EntryCount DESC";

    // Set the filter title for the default query
    $filterTitle = "Library Statistics as of: " . date('F j, Y');
}

// Execute the query
$result = mysqli_query($conn, $sql);
?>

    <?php
    // Display $filterTitle inside an HTML tag with inline CSS
        echo "<center><h1 class='statLabel'>{$filterTitle}</h1></center>";
    ?>

    <!-- Loop to fetch and display data -->
    <?php
    $count = 1; // Initialize a counter
    while ($fetch = mysqli_fetch_array($result)) {
    ?>
        <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo substr($fetch['library_userID'], 3, 100); ?></td>
        <td><?php echo $fetch['fullname']; ?></td>
        <td><?php echo $fetch['gender']; ?></td>
        <td><?php echo $fetch['departmentType']; ?></td>
        <td style="text-align: center"><?php echo $fetch['EntryCount']; ?></td>
    </tr>
    <?php
        $count++;
    }
    ?>