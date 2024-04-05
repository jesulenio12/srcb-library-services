<?php
require 'conn.php';

if (isset($_POST['filterbook'])) {
    $filters = array();

    if (!empty($_POST['bookSec'])) {
        $bookSection = $_POST['bookSec'];
        $filters[] = "bookSection LIKE '$bookSection%'";
    }

    // Construct the WHERE clause based on the filters
    $whereClause = implode(' AND ', $filters);

    $query = mysqli_query($conn, "SELECT b.*, COUNT(*) as totalCopies,
        SUM(CASE WHEN b.status = 'Available' THEN 1 ELSE 0 END) as availableCopies
        FROM books b 
        WHERE b.bookSection != 'Periodical' AND b.lost = 0 AND discarded = 0 AND libraryClass = 'High School Library'
        " . ($whereClause ? " AND $whereClause" : "") . " GROUP BY b.bookTitle ORDER BY b.id DESC") or die(mysqli_error());

    $row = mysqli_num_rows($query);

    if ($row > 0) {
        while ($fetch = mysqli_fetch_array($query)) { ?>
        <tr>
            <td>#</td>
            <td><?php echo $fetch['bookTitle'] ?></td>
            <td><?php echo $fetch['author'] ?></td>
            <td><?php echo $fetch['publisher'] ?></td>
            <td><?php echo $fetch['datePublished'] ?></td>
            <td><?php echo $fetch['bookSection'] ?></td>
            <td style="text-align:center; font-weight:900"><?php echo "x".$fetch['totalCopies']?></td>
            <td style="text-align:center; color:red"><?php echo "x".$fetch['availableCopies'] ?></td>
            <td>
                <form method="POST" action="admin.php?action=hsBookViewCopies&&bookTitle=<?php echo urlencode($fetch['bookTitle']); ?>" style="display:inline">
                    <button class="bookbtn1" type="submit" style="width:100%;">
                        <i class="glyphicon glyphicon-list"></i>
                    </button>
                </form>
            </td>
        </tr>
<?php
        }
    }
} else {
    // Execute the query without the borrowed books condition
    $query = mysqli_query($conn, "SELECT b.*, COUNT(*) as totalCopies,
        SUM(CASE WHEN b.status = 'Available' THEN 1 ELSE 0 END) as availableCopies
        FROM books b 
        WHERE b.bookSection != 'Periodical' AND b.lost = 0 AND discarded = 0 AND libraryClass = 'High School Library'
        GROUP BY b.bookTitle ORDER BY b.id DESC") or die(mysqli_error());

    $row = mysqli_num_rows($query);

    while ($fetch = mysqli_fetch_array($query)) { ?>
        <tr>
            <td>#</td>
            <td><?php echo $fetch['bookTitle'] ?></td>
            <td><?php echo $fetch['author'] ?></td>
            <td><?php echo $fetch['publisher'] ?></td>
            <td><?php echo $fetch['datePublished'] ?></td>
            <td><?php echo $fetch['bookSection'] ?></td>
			<td style="text-align:center; font-weight:900"><?php echo "x".$fetch['totalCopies']?></td>
            <td style="text-align:center; color:red"><?php echo "x".$fetch['availableCopies'] ?></td>
			<td>
				<form method="POST" action="admin.php?action=hsBookViewCopies&&bookTitle=<?php echo urlencode($fetch['bookTitle']); ?>" style="display:inline">
					<button class="bookbtn1" type="submit" style="width:100%;">
						<i class="glyphicon glyphicon-list"></i>
					</button>
				</form>
			</td>
        </tr>
<?php
    }
}
?>
