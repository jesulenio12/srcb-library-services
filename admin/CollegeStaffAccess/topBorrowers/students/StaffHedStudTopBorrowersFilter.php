<?php
require 'conn.php';

$filterTitle = ""; // Initialize an empty variable for the filter title

if (isset($_POST['filter'])) {
    // Get start and end dates from the form
    $firstDate = date("Y-m-d", strtotime($_POST['firstDate']));
    $secondDate = date("Y-m-d", strtotime($_POST['secondDate']));
    $gender = $_POST['gender'];
    $progtrack = $_POST['progtrack'];
    $yearLevel = $_POST['yearLevel'];
    $departmentType = $_POST['departmentType'];

    // Construct the dynamic SQL query with date filter
    $sql = "SELECT
                booktransactions.library_userID,
                booktransactions.fullname,
                booktransactions.gender,
                booktransactions.yearLevel,
                booktransactions.progtrack,
                booktransactions.classSection,
                booktransactions.departmentType,
                COUNT(*) as EntryCount
            FROM
                booktransactions
            WHERE 
                transactionDate BETWEEN '$firstDate' AND '$secondDate' AND gender LIKE '$gender%' AND yearLevel LIKE '$yearLevel%' AND progtrack LIKE '$progtrack%' AND departmentType LIKE '$departmentType%'
                AND
                userType = 'Student' && transactionType = 'return' && transactionPlace = 'Col-Lib' AND MONTH(transactionDate) = MONTH(CURRENT_DATE) AND YEAR(transactionDate) = YEAR(CURRENT_DATE)
            GROUP BY
                booktransactions.library_userID, booktransactions.fullname, booktransactions.gender, booktransactions.yearLevel, booktransactions.progtrack, booktransactions.classSection, booktransactions.departmentType
            ORDER BY
                EntryCount DESC";

    // Set the filter title
    $filterTitle = "Library Statistics from " . date('F j, Y', strtotime($firstDate)) . ' to ' . date('F j, Y', strtotime($secondDate));
} else {
    // Default query without date filter
    $sql = "SELECT
                booktransactions.library_userID,
                booktransactions.fullname,
                booktransactions.gender,
                booktransactions.yearLevel,
                booktransactions.progtrack,
                booktransactions.classSection,
                booktransactions.departmentType,
                COUNT(*) AS EntryCount
            FROM
                booktransactions
            WHERE
                userType = 'Student' && transactionType = 'return' && transactionPlace = 'Col-Lib' AND MONTH(transactionDate) = MONTH(CURRENT_DATE) AND YEAR(transactionDate) = YEAR(CURRENT_DATE)
            GROUP BY
                booktransactions.library_userID, booktransactions.fullname, booktransactions.gender, booktransactions.yearLevel, booktransactions.progtrack, booktransactions.classSection, booktransactions.departmentType
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
        <td><?php echo $fetch['yearLevel']; ?></td>
        <td>
            <?php if($fetch['progtrack'] == '') { ?>
                ---
            <?php } else { ?>
                <?php echo $fetch['progtrack']; ?>
            <?php } ?>
        </td>
        <td>
            <?php if($fetch['classSection'] == '') { ?>
                ---
            <?php } else { ?>
                <?php echo $fetch['classSection']; ?>
            <?php } ?>
        </td>
        <td><?php echo $fetch['departmentType']; ?></td>
        <td style="text-align: center"><?php echo $fetch['EntryCount']; ?></td>
    </tr>
    <?php
        $count++;
    }
    ?>