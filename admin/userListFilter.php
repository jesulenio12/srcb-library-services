<?php
	require 'conn.php';
    
		$query=mysqli_query($conn, "SELECT * FROM userlogin WHERE archive = 0 AND permission != 5 AND permission != 6 ORDER BY `id` ASC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
        <td><?php echo getRoleByPermission($fetch['permissionRole']);?></td>
		<td><?php echo substr($fetch['library_userID'], 3, 255); ?></td>
        <td><?php echo $fetch['username']?></td>
		<td>
			<?php echo $fetch['firstname']?>
			<?php echo $fetch['lastname']?>
		</td>
        <td align="center">
            <?php if ($fetch['username'] == $_SESSION['username']) {?>
                    <a href="admin.php?action=settings">
                        <button class="bookbtn1" type="button" style="width:100%;">
                            <i class="glyphicon glyphicon-list"></i>
                        </button>
                    </a>
            <?php }else{?>
                <form method="POST" action="admin.php?action=AdminStaffView&&library_userID=<?php echo urlencode($fetch['library_userID']); ?>" style="display:inline">
                    <button class="bookbtn1" type="submit" style="width:100%;">
                        <i class="glyphicon glyphicon-list"></i>
                    </button>
                </form>
            <?php }?>
        </td>
	</tr>
<?php
		}

        
function getRoleByPermission($permissionRole)
    {
        switch ($permissionRole) {
            case '1':
                return 'ADMINISTRATOR';
            case '2':
                return 'HED LIBRARY STAFF';
            case '3':
                return 'HS LIBRARY STAFF';
            case '4':
                return 'GS LIBRARY STAFF';
            default:
                return ''; // Default course name
        }
    }
        
?>