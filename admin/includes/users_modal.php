<!-- Users Modals -->
<!-- =============================================================================================== -->

<!-- Activate User -->
<div class="modal fade" id="activate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><b>Activating...</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="users_activate.php">
                    <input type="true" class="userid" name="id">
                        <div class="text-center">
                            <p>ACTIVATE USER</p>
                            <h2 class="bold fullname"></h2>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="activate"><i class="fa fa-check"></i> Activate</button>
                </form>
            </div>
        </div>
    </div>
</div> 


<!-- Activate User Internal -->
<div class="modal fade" id="activate_internal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><b>Activating...</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="internal_activate.php">
                    <input type="true" class="userid" name="id">
                        <div class="text-center">
                            <p>ACTIVATE USER</p>
                            <h2 class="bold fullname"></h2>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="activate_internal"><i class="fa fa-check"></i> Activate</button>
                </form>
            </div>
        </div>
    </div>
</div> 


<!-- Delete User -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
                <form action="users_delete.php" method="POST" class="form-horizontal">
                    <input type="true" class="userid" name="id">
                        <div class="text-center">
                            <p>DELETE USER ?</p>
                            <h2 class="bold fullname"></h2>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i>Close</button>
                <button type="submit" class="btn btn-success btn-flat" name='delete'><i class="fa fa-trash">Delete</i></button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- !-- Add New User--> 
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New User</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_add.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" id="address" name="address"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">Contact Info</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="contact" name="contact">
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label for="image" class="col-sm-3 control-label">Image</label>

                    <div class="col-sm-9">
                      <input type="file" id="image" name="image">
                    </div>
                </div> -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Users -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit User</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_edit.php" enctype="multipart/form-data">
              <input type="hidden" class="userid" name="id">
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_firstname" name="firstname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_lastname" name="lastname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="edit_password" name="password" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_address" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" id="edit_address" name="address"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_contact" class="col-sm-3 control-label">Contact Info</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_contact" name="contact">
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label for="image" class="col-sm-3 control-label">Image</label>

                    <div class="col-sm-9">
                      <input type="file" id="image" name="image">
                    </div>
                </div> -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="edit"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- END Users Modals -->
<!-- =============================================================================================== -->



<!-- Donation Modals -->
<!-- =============================================================================================== -->

<!-- Donation Confirm Payment -->
<div class="modal fade" id="confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><b>Confirm...</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="donation_confirmed.php">
                    <input type="true" class="userid" name="id">
                        <div class="text-center">
                            <p>CONFIRM USER PAYMENT</p>
                            <h2 class="bold fullname"></h2>
                            <h3 class="bold user_trx"></h3>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="confirm"><i class="fa fa-check"></i> Confirmed</button>
                </form>
            </div>
        </div>
    </div>
</div> 


<!-- Donation Confirm Payment Internal -->
<div class="modal fade" id="confirm_internal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><b>Confirm...</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="internal_confirmed.php">
                    <input type="true" class="userid" name="id">
                        <div class="text-center">
                            <p>CONFIRM USER PAYMENT</p>
                            <h2 class="bold fullname"></h2>
                            <h3 class="bold user_trx"></h3>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="confirm_internal"><i class="fa fa-check"></i> Confirmed</button>
                </form>
            </div>
        </div>
    </div>
</div> 


<!-- Delete Donation Payment -->
<div class="modal fade" id="deleteDonation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
                <form action="donation_delete.php" method="POST" class="form-horizontal">
                    <input type="hidden" class="userid" name="id">
                        <div class="text-center">
                            <p>DELETE USER ?</p>
                            <h2 class="bold fullname"></h2>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i>Close</button>
                <button type="submit" class="btn btn-success btn-flat" name='deleteDonation'><i class="fa fa-trash">Delete</i></button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- !-- Add New Donation --> 
<div class="modal fade" id="addNewDonation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Donation</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="donation_add.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="email_user" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">Nominal</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="nominal" name="nominal">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="addDonation"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- END Donation Modals -->
<!-- =============================================================================================== -->