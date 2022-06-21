<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Add New Payments</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="payments_add.php">
                    <div class="form-group">
                        <label for="student_id" class="col-sm-3 control-label">Student </label>
                        <div class="col-sm-9">
                            <select id='student_id' name="student_id" required style="width: 100%;">
                                <option disabled selected> Select Student </option>
                                <?php
                                $stmt1 = $conn->prepare("SELECT * FROM students");
                                $stmt1->execute();
                                foreach ($stmt1 as $row1)
                                    echo "<option value='" . $row1['students_id'] . "'>" . $row1['students_name'] . " ( " . $row1['students_id'] ." ), Father : " . $row1['students_father_name'] . ", Mother : " . $row1['students_mother_name'] ."</option>";
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class='form-group'><label for='fees_type' class='col-sm-3 control-label'>Fee Type </label>
                        <div class='col-sm-9'>
                            <select name='fees_type' id="fees_type" class='form-control' required>
                                <option disabled selected> Select Payment </option>
                            </select>
                        </div>
                    </div>
                    <span id="payment_pay"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i>
                    Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- roll_back -->
<div class="modal fade" id="roll_back">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Rolling Back...</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="payments_delete.php">
                    <input type="hidden" id="payment_id" name="id">
                    <div class="text-center">
                        <p>ROLLING BACK PAYMENT</p>
                        <h2 class="bold payment_id"></h2>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-undo"></i>
                    Roll Back</button>
                </form>
            </div>
        </div>
    </div>
</div>