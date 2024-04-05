<!-- Modal Dialog -->
<div class="modal fade" id="confirmRequest" role="dialog" aria-labelledby="confirmRequestLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Confirm Parmanently</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to borrow this?
      </div>
      <form method="POST" action="">
        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $_SESSION['fname']; ?>" required >
        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $_SESSION['lname']; ?>" required >
        <input type="text" class="form-control" id="library_userID" name="library_userID" value="<?php echo $_SESSION['username']; ?>" required >
        <input type="text" class="form-control" id="userType" name="userType" value="<?php echo $_SESSION['userType']; ?>" required >
        <input type="text" class="form-control" id="departmentType" name="departmentType" value="<?php echo $_SESSION['departmentType']; ?>" required >
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" id="confirm" >Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>