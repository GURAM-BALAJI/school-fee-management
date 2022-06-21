<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Add New students</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="students_add.php" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Full Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" required autocomplete="OFF">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="class" class="col-sm-4 control-label">Class </label>
                        <div class="col-sm-8">
                            <select class="form-control" name="classes_and_fee_value" required>
                                <option value="">Select Class</option>
                                <?php
                                $stmt1 = $conn->prepare("SELECT * FROM classes_and_fee");
                                $stmt1->execute();
                                foreach ($stmt1 as $row1)
                                    echo "<option value='" . $row1['classes_and_fee_value'] . "'>" . $row1['classes_and_fee_class'] . '(' . $row1['classes_and_fee_fee'] . ')' . "</option>";
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="student_image" class="col-sm-4 control-label">Student Image</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" name="student_image">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="students_DOB" class="col-sm-4 control-label">Date Of Birth</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="students_DOB">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="students_gender" class="col-sm-4 control-label">Gender</label>
                        <div class="col-sm-8">
                            <select name="students_gender" class="form-control" required>
                                <option value="">Select Gender</option>
                                <option value="0">Male</option>
                                <option value="1">Female</option>
                                <option value="2">Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="students_cast" class="col-sm-4 control-label">Cast</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="students_cast">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="students_mother_tongue" class="col-sm-4 control-label">Mother Tongue</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="students_mother_tongue" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="students_blood_group" class="col-sm-4 control-label">Blood Group</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="students_blood_group">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="students_adher" class="col-sm-4 control-label">Adher No</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="students_adher" autocomplete="OFF">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="students_address" class="col-sm-4 control-label">Address</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="students_address" rows="4" cols="50" required autocomplete="OFF"></textarea>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group">
                        <label for="students_father_name" class="col-sm-4 control-label">Father Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="students_father_name" required autocomplete="OFF">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="students_father_phone" class="col-sm-4 control-label">Father Phone No</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="students_father_phone" autocomplete="OFF">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="students_father_occupation" class="col-sm-4 control-label">Father Occupation</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="students_father_occupation" autocomplete="OFF">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="students_mother_name" class="col-sm-4 control-label">Mother Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="students_mother_name" required autocomplete="OFF">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="students_mother_phone" class="col-sm-4 control-label">Mother Phone No</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="students_mother_phone" autocomplete="OFF">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="students_mother_occupation" class="col-sm-4 control-label">Mother Occupation</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="students_mother_occupation" autocomplete="OFF">
                        </div>
                    </div>
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

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Edit students</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="students_edit.php">
                    <input type="hidden" id="edit_students_id" name="id">

                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Full Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="edit_students_name" name="name" required autocomplete="OFF">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="class" class="col-sm-4 control-label">Class </label>
                        <div class="col-sm-8">
                            <span id="edit_students_class"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="students_DOB" class="col-sm-4 control-label">Date Of Birth</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="edit_students_DOB" name="students_DOB">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="students_gender" class="col-sm-4 control-label">Gender</label>
                        <div class="col-sm-8">
                            <span id="edit_students_gender"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="students_cast" class="col-sm-4 control-label">Cast</label>
                        <div class="col-sm-8">
                            <input type="text" id="edit_students_cast" class="form-control" name="students_cast">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="students_mother_tongue" class="col-sm-4 control-label">Mother Tongue</label>
                        <div class="col-sm-8">
                            <input type="text" id="edit_students_mother_tongue" class="form-control" name="students_mother_tongue" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="students_blood_group" class="col-sm-4 control-label">Blood Group</label>
                        <div class="col-sm-8">
                            <input type="text" id="edit_students_blood_group" class="form-control" name="students_blood_group">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="students_adher" class="col-sm-4 control-label">Adher No</label>
                        <div class="col-sm-8">
                            <input type="text" id="edit_students_adher" class="form-control" name="students_adher" autocomplete="OFF">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="students_address" class="col-sm-4 control-label">Address</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="edit_students_address" name="students_address" rows="4" cols="50" required autocomplete="OFF"></textarea>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group">
                        <label for="students_father_name" class="col-sm-4 control-label">Father Name</label>
                        <div class="col-sm-8">
                            <input type="text" id="edit_students_father_name" class="form-control" name="students_father_name" required autocomplete="OFF">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="students_father_phone" class="col-sm-4 control-label">Father Phone No</label>
                        <div class="col-sm-8">
                            <input type="text" id="edit_students_father_phone" class="form-control" name="students_father_phone" autocomplete="OFF">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="students_father_occupation" class="col-sm-4 control-label">Father Occupation</label>
                        <div class="col-sm-8">
                            <input type="text" id="edit_students_father_occupation" class="form-control" name="students_father_occupation" autocomplete="OFF">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="students_mother_name" class="col-sm-4 control-label">Mother Name</label>
                        <div class="col-sm-8">
                            <input type="text" id="edit_students_mother_name" class="form-control" name="students_mother_name" required autocomplete="OFF">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="students_mother_phone" class="col-sm-4 control-label">Mother Phone No</label>
                        <div class="col-sm-8">
                            <input type="text" id="edit_students_mother_phone" class="form-control" name="students_mother_phone" autocomplete="OFF">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="students_mother_occupation" class="col-sm-4 control-label">Mother Occupation</label>
                        <div class="col-sm-8">
                            <input type="text" id="edit_students_mother_occupation" class="form-control" name="students_mother_occupation" autocomplete="OFF">
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
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
                <form class="form-horizontal" method="POST" action="students_delete.php">
                    <input type="hidden" class="delete_students_id" name="id">
                    <div class="text-center">
                        <h3>DELETE STUDENT</h3>
                        ID : <b class="bold delete_students_id_view"></b> & NAME : <b class="bold delete_students_name"></b>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i>
                    Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- view  more -->
<div class="modal fade" id="view_more">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>view more...</b></h4>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Full Name : </label>
                        <div class="col-sm-8">
                            <span id="view_students_name"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <center>
                            <table border="1" >
                                <tr>
                                    <th style="padding: 10px;">FEE NAME</th>
                                    <th style="padding: 10px;">TOTAL FEE</th>
                                    <th style="padding: 10px;">PAID</th>
                                    <th style="padding: 10px;">BALANCE</th>
                                </tr>
                                <tr>
                                    <th style="padding: 5px;">SCHOOL FEE</th>
                                    <td style="padding: 5px;"> <span id="view_students_total_school_fee"></span></td>
                                    <td style="padding: 5px;"><span id="view_student_total_school_fee_paid"></span></td>
                                    <td style="padding: 5px;"> <span id="view_students_total_school_fee_balance"></span></td>
                                </tr>
                                <tr>
                                    <th style="padding: 5px;">BOOKS FEE</th>
                                    <td style="padding: 5px;"> <span id="view_students_total_books_fee"></span></td>
                                    <td style="padding: 5px;"><span id="view_student_total_books_fee_paid"></span></td>
                                    <td style="padding: 5px;"> <span id="view_students_total_books_fee_balance"></span></td>
                                </tr>
                                <tr>
                                    <th style="padding: 5px;">DRESS FEE</th>
                                    <td style="padding: 5px;"> <span id="view_students_total_dress_fee"></span></td>
                                    <td style="padding: 5px;"><span id="view_student_total_dress_fee_paid"></span></td>
                                    <td style="padding: 5px;"> <span id="view_students_total_dress_fee_balance"></span></td>
                                </tr>
                                <tr>
                                    <th style="padding: 5px;">TRANSPORT FEE</th>
                                    <td style="padding: 5px;"> <span id="view_students_total_transport_fee"></span></td>
                                    <td style="padding: 5px;"><span id="view_student_total_transport_fee_paid"></span></td>
                                    <td style="padding: 5px;"> <span id="view_students_total_transport_fee_balance"></span></td>
                                </tr>
                            </table>
                            </center>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="view_students_DOB" class="col-sm-4 control-label">Date Of Birth : </label>
                        <div class="col-sm-8">
                            <span id="view_students_DOB"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="students_cast" class="col-sm-4 control-label">Cast : </label>
                        <div class="col-sm-8">
                            <span id="view_students_cast"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="students_mother_tongue" class="col-sm-4 control-label">Mother Tongue : </label>
                        <div class="col-sm-8">
                            <span id="view_students_mother_tongue"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="students_blood_group" class="col-sm-4 control-label">Blood Group : </label>
                        <div class="col-sm-8">
                            <span id="view_students_blood_group"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="students_adher" class="col-sm-4 control-label">Adher No : </label>
                        <div class="col-sm-8">
                            <span id="view_students_adher"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="students_address" class="col-sm-4 control-label">Address : </label>
                        <div class="col-sm-8">
                            <span id="view_students_address"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="students_father_name" class="col-sm-4 control-label">Father Name : </label>
                        <div class="col-sm-8">
                            <span id="view_students_father_name"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="students_father_phone" class="col-sm-4 control-label">Father Phone No : </label>
                        <div class="col-sm-8">
                            <span id="view_students_father_phone"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="students_father_occupation" class="col-sm-4 control-label">Father Occupation : </label>
                        <div class="col-sm-8">
                            <span id="view_students_father_occupation"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="students_mother_name" class="col-sm-4 control-label">Mother Name : </label>
                        <div class="col-sm-8">
                            <span id="view_students_mother_name"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="students_mother_phone" class="col-sm-4 control-label">Mother Phone No : </label>
                        <div class="col-sm-8">
                            <span id="view_students_mother_phone"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="students_mother_occupation" class="col-sm-4 control-label">Mother Occupation : </label>
                        <div class="col-sm-8">
                            <span id="view_students_mother_occupation"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="students_mother_occupation" class="col-sm-4 control-label"> Last Updated date : </label>
                        <div class="col-sm-8">
                            <span id="view_students_updated_date"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="students_mother_occupation" class="col-sm-4 control-label">Created Date : </label>
                        <div class="col-sm-8">
                            <span id="view_students_created_date"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b><span class="students_photo_name"></span></b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="students_photo.php" enctype="multipart/form-data">
                    <input type="hidden" class="students_photo_id" name="id">
                    <div class="form-group">
                        <label for="photo" class="col-sm-3 control-label">Photo</label>
                        <div class="col-sm-9">
                            <input type="file" id="photo" name="photo" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Fee view -->
<div class="modal fade" id="fee_details">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Fee Details</b></h4>
            </div>
            <div class="modal-body">
              <div id="fee_view"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                </form>
            </div>
        </div>
    </div>
</div>