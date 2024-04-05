<!-- Modal Dialog -->
<div class="modal fade" id="confirmApproval" role="dialog" aria-labelledby="confirmApprovalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Approve Parmanently</h4>
      </div>
      <div class="modal-body">
																	<center>
																	<form method="POST" action="" style="display:inline">
																		<div class="row">
																			<div class="col-lg-6 col-md-3">
																				<label class="control-label" for="pickupTime"><font color="#EC0003">*</font>Select Pick-up Time</label>
																				<div class="form-group">
																					<select style="height:100%;width:100%;outline:none;border-radius: 5px;border: 1px solid lightgrey;font-size: 16px;transition: all 0.3s ease;color:black;" class="form-control" name="pickupTime" id="pickupTime" required>
																						<option value="Morning - 08:00-09:00 AM">Morning - 08:00-09:00 AM</option>	
																						<option value="Morning - 09:00-10:00 AM">Morning - 09:00-10:00 AM</option>
																						<option value="Morning - 10:00-11:00 AM">Morning - 10:00-11:00 AM</option>
																						<option value="Morning - 11:00-12:00 NN">Morning - 11:00-12:00 NN</option>
																						<option value="Afternoon - 01:00-02:00 PM">Morning - 01:00-02:00 PM</option>
																						<option value="Afternoon - 02:00-03:00 PM">Afternoon - 02:00-03:00 PM</option>
																						<option value="Afternoon - 03:00-04:00 PM">Afternoon - 03:00-04:00 PM</option>
																						<option value="Afternoon - 04:00-04:00 PM">Afternoon - 04:00-04:00 PM</option>
																					</select> 
																				</div>
																				<!-- <label class="control-label" for="library_userID"><font color="#EC0003">*</font> ID Number</label>
																				<div class="form-group">
																					<input type="time" class="form-control" id="library_userID" name="library_userID" placeholder="Input ID number" required >
																				</div> -->
																			</div>
																		</div>
																	</center>
																</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" id="confirm">Approve</button>
      </div>
    </div>
  </div>
</div>