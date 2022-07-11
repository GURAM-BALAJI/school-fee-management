<?php include '../session.php'; ?>
<html>

<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        h2 {
            color: #1c94c4;
            text-align: center;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>

    <h2>PERMISSION</h2>
    <form class="form-horizontal" method="POST" action="admin_permission_edit.php">
        <?php
        $id = $_GET['id'];
        $conn = $pdo->open();
        $stmt = $conn->prepare("SELECT * FROM admin WHERE admin_id=:id");
        $stmt->execute(['id' => $id]);
        foreach ($stmt as $row) {
        ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <table>
                <tr>
                    <th> </th>
                    <th style="color: #3a8104;"> Name </th>
                    <th style="color: #3a8104;"> View </th>
                    <th style="color: #3a8104;"> Create </th>
                    <th style="color: #3a8104;"> Edit </th>
                    <th style="color: #3a8104;"> Delete </th>
                    <th style="color: #3a8104;"> Special </th>
                    <th> </th>
                </tr>
                <tr>
                    <td> </td>
                    <td> ADMIN </td>
                    <td style="text-align: center;"> <input type="checkbox" name="admin_view" <?php if ($row['admin_view']) echo "checked"; ?>> </td>
                    <td style="text-align: center;"> <input type="checkbox" name="admin_create" <?php if ($row['admin_create']) echo "checked"; ?>> </td>
                    <td style="text-align: center;"> <input type="checkbox" name="admin_edit" <?php if ($row['admin_edit']) echo "checked"; ?>> </td>
                    <td style="text-align: center;"> <input type="checkbox" name="admin_del" <?php if ($row['admin_del']) echo "checked"; ?>> </td>
                    <td style="text-align: center;"> <input type="checkbox" name="admin_special" <?php if ($row['admin_special']) echo "checked"; ?>> </td>
                    <td> </td>
                </tr>
                <tr>
                    <td> </td>
                    <td> PAYMENTS </td>
                    <td style="text-align: center;"> <input type="checkbox" name="payments_view" <?php if ($row['payments_view']) echo "checked"; ?>> </td>
                    <td style="text-align: center;"> <input type="checkbox" name="payments_create" <?php if ($row['payments_create']) echo "checked"; ?>> </td>
                    <td> </td>
                    <td style="text-align: center;"> <input type="checkbox" name="payments_del" <?php if ($row['payments_del']) echo "checked"; ?>> </td>
                    <td> </td>
                    <td> </td>
                </tr>
                <tr>
                    <td> </td>
                    <td> STUDENTS </td>
                    <td style="text-align: center;"> <input type="checkbox" name="students_view" <?php if ($row['students_view']) echo "checked"; ?>> </td>
                    <td style="text-align: center;"> <input type="checkbox" name="students_create" <?php if ($row['students_create']) echo "checked"; ?>> </td>
                    <td style="text-align: center;"> <input type="checkbox" name="students_edit" <?php if ($row['students_edit']) echo "checked"; ?>> </td>
                    <td style="text-align: center;"> <input type="checkbox" name="students_del" <?php if ($row['students_del']) echo "checked"; ?>> </td>
                    <td> </td>
                     <td> </td>
                </tr>
                <tr>
                    <td> </td>
                    <td> CLASS AND FEE </td>
                    <td style="text-align: center;"> <input type="checkbox" name="classes_and_fee_view" <?php if ($row['classes_and_fee_view']) echo "checked"; ?>> </td>
                    <td style="text-align: center;"> <input type="checkbox" name="classes_and_fee_create" <?php if ($row['classes_and_fee_create']) echo "checked"; ?>> </td>
                    <td style="text-align: center;"> <input type="checkbox" name="classes_and_fee_edit" <?php if ($row['classes_and_fee_edit']) echo "checked"; ?>> </td>
                    <td style="text-align: center;"> <input type="checkbox" name="classes_and_fee_del" <?php if ($row['classes_and_fee_del']) echo "checked"; ?>> </td>
                    <td> </td>
                    <td> </td>
                </tr>
                <tr>
                    <td> </td>
                    <td> PAYMENT LIST </td>
                    <td style="text-align: center;"> <input type="checkbox" name="payments_records_view" <?php if ($row['payments_records_view']) echo "checked"; ?>> </td>
                    <td> </td>
                    <td> </td>
                     <td> </td>
                     <td> </td>
                     <td> </td>
                </tr>
                <tr>
                    <td> </td>
                    <td> PAYMENT PENDING LIST </td>
                    <td style="text-align: center;"> <input type="checkbox" name="payment_pending_records_view" <?php if ($row['payment_pending_records_view']) echo "checked"; ?>> </td>
                    <td> </td>
                    <td> </td>
                     <td> </td>
                     <td> </td>
                     <td> </td>
                </tr>
                <tr>
                    <td> </td>
                    <td> STUDENTS LIST</td>
                    <td style="text-align: center;"> <input type="checkbox" name="students_records_view" <?php if ($row['students_records_view']) echo "checked"; ?>> </td>
                    <td> </td>
                    <td> </td>
                     <td> </td>
                     <td> </td>
                     <td> </td>
                </tr>
                <tr>
                    <td> </td>
                    <td> NOT TAKEN LIST</td>
                    <td style="text-align: center;"> <input type="checkbox" name="not_taken_records_view" <?php if ($row['not_taken_records_view']) echo "checked"; ?>> </td>
                    <td> </td>
                    <td> </td>
                     <td> </td>
                     <td> </td>
                     <td> </td>
                </tr>
            </table>
        <?php } ?>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success btn-flat" name="update"><i class="fa fa-check"></i> UPDATE</button>
        </div>
    </form>
</body>

</html>