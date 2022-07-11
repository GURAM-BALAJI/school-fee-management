<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Add New Class And Fee</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="school_info_add.php"
                    enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="value" class="col-sm-3 control-label">Value</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="value" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="class" class="col-sm-3 control-label">Class</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="class" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fee" class="col-sm-3 control-label">Fee</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="fee" required>
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i>
                    Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Edit Class and Fee</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="school_info_edit.php">
                    <input type="hidden" id="edit_school_info_id" name="id">

                    <div class="form-group">
                        <label for="value" class="col-sm-3 control-label">Value</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="edit_school_info_value" name="value" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="class" class="col-sm-3 control-label">Class</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit_school_info_class" name="class" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fee" class="col-sm-3 control-label">Fee</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="edit_school_info_fee" name="fee" required>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i>
                    Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="school_info_delete.php">
                    <input type="hidden" class="delete_school_info_id" name="id">
                    <div class="text-center">
                        <p>DELETE CLASS AND FEE</p>
                        Class : <spam class="bold delete_school_info_class"></spam> &
                        Fee : <spam class="bold delete_school_info_fee"></spam>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i>
                    Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

