<?php include '../includes/session.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Printing Bills</title>
</head>

<body>
    <center>
        <table style="width:100%">
            <tr>
                <td style="padding-right: 20px;">
                    <table style="height:720px;width:500px;border:2px solid;border-collapse: collapse;">
                        <tr style="height:15px;">
                            <th colspan="3" style="border-bottom: 2px solid;">Student Copy</th>
                        </tr>
                        <tr style="height:40px;">
                            <td rowspan="4" style="width:40px;"><img src="./logo.jpeg" width="115px" height="115px"></td>
                            <th colspan="2" style="text-transform: uppercase;font-size: 16px;">Royalpupil International School
                            </th>
                        <tr style="height:30px;">
                            <td colspan="2">
                                <center>Kuduthini 583115, Bellary, Karnataka</center>
                            </td>
                        </tr>
                        <tr style="height:30px;">
                            <td colspan="2">
                                <center>royalpupilinternationalschool@gmail.com</center>
                            </td>
                        </tr>
                        <tr style="height:30px;">
                            <td colspan="2">
                                <center>+91 9845138636</center>
                            </td>
                        </tr>
            </tr>
            <?php $conn = $pdo->open();
            try {
                $stmt = $conn->prepare("SELECT * FROM payments WHERE payments_id=" . $_GET['payment_id'] . "");
                $stmt->execute();
                foreach ($stmt as $row) {
            ?>
                    <tr style="height:15px;border-bottom:1pt solid black;border-top:1pt solid black;">
                        <th>No:29120117805</th>
                        <th>Fee Receipt</th>
                        <th>Date: <?php echo $row['payments_date']; ?></th>
                    </tr>
                    <?php $stmt1 = $conn->prepare("SELECT students_id,students_name,students_father_name,students_class FROM students where students_id=" . $row['payments_students_id'] . "");
                    $stmt1->execute();
                    foreach ($stmt1 as $row1) { ?>
                        <tr style="height:30px;">
                            <td colspan="2">Student Name: <?php echo $row1['students_name']; ?></td>
                            <td>Student ID: <?php echo $row1['students_id']; ?></td>
                        </tr>
                        <tr style="height:30px;">
                            <td colspan="2">Father Name: <?php echo $row1['students_father_name']; ?></td>
                            <?php $stmt11 = $conn->prepare("SELECT classes_and_fee_class FROM classes_and_fee WHERE classes_and_fee_value='" . $row1['students_class'] . "'");
                            $stmt11->execute();
                            foreach ($stmt11 as $row11) { ?>
                                <td>Class: <?php echo $row11['classes_and_fee_class']; ?></td>
                            <?php } ?>
                        </tr>
                        <tr style="height:30px;border-bottom:1pt solid black;">
                            <td colspan="2" >Mode Of Payment: <?php
                                                            if ($row['payment_through'] == '1')
                                                                echo "CASH";
                                                            elseif ($row['payment_through'] == '2')
                                                                echo "CARD";
                                                            elseif ($row['payment_through'] == '3')
                                                                echo "CHECK";
                                                            elseif ($row['payment_through'] == '4')
                                                                echo "UPI";
                                                            elseif ($row['payment_through'] == '5')
                                                                echo "NET BANKING";
                                                            elseif ($row['payment_through'] == '6')
                                                                echo "OTHERS";
                                                            ?></td>
                            <td>Payment No: <?php echo $row['payments_id']; ?></td>
                        </tr>
                    <?php } ?>
                    </tr>
                    <tr style="height:15px;border-bottom:1pt solid black;">
                        <th colspan="2">Particulars</th>
                        <th>Amount(Rs)</th>
                    </tr>
                    <tr style="border-bottom:1pt solid black;" >
                        <td colspan="2" style="padding:20px;" VALIGN=TOP><?php if ($row['payments_type'] == '1')
                                            echo "Tuition Fee";
                                        elseif ($row['payments_type'] == '2')
                                            echo "Books Fee";
                                        elseif ($row['payments_type'] == '3')
                                            echo "Dress Fee";
                                        elseif ($row['payments_type'] == '4')
                                            echo "Transport Fee"; ?></td>
                        <td style="border-left:1pt solid black;padding:20px;" VALIGN=TOP><?php echo $row['payments_fee'].'.00'; ?></td>
                    </tr>
                    <tr style="height:15px;border-bottom:1pt solid black;">
                        <td colspan="2">Total Rs.</td>
                        <th rowspan="2" style="border-left:1pt solid black;"><?php echo $row['payments_fee'].'.00'; ?></th>
                    </tr>
                    <tr style="height:15px;text-transform: capitalize;">
                        <th colspan="2"><?php 
                        $number = $row['payments_fee'];
                        $no = floor($number);
                        $hundred = null;
                        $digits_1 = strlen($no);
                        $i = 0;
                        $str = array();
                        $words = array('0' => '', '1' => 'one', '2' => 'two',
                         '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
                         '7' => 'seven', '8' => 'eight', '9' => 'nine',
                         '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
                         '13' => 'thirteen', '14' => 'fourteen',
                         '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
                         '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
                         '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
                         '60' => 'sixty', '70' => 'seventy',
                         '80' => 'eighty', '90' => 'ninety');
                        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
                        while ($i < $digits_1) {
                          $divider = ($i == 2) ? 10 : 100;
                          $number = floor($no % $divider);
                          $no = floor($no / $divider);
                          $i += ($divider == 10) ? 1 : 2;
                          if ($number) {
                             $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                             $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                             $str [] = ($number < 21) ? $words[$number] .
                                 " " . $digits[$counter] . $plural . " " . $hundred
                                 :
                                 $words[floor($number / 10) * 10]
                                 . " " . $words[$number % 10] . " "
                                 . $digits[$counter] . $plural . " " . $hundred;
                          } else $str[] = null;
                       }
                       $str = array_reverse($str);
                       $result = implode('', $str);
                               echo $result . "Rupees Only.";
                                ?></th>
                    </tr>
                    <tr style="height:25px;border-top:1pt solid black;">
                        <th colspan="3" style="font-size: 10px;">THIS IS A COMPUTER GENERATED PRINTOUT WHICH REQUIRES NO
                            SIGNATURE</th>
                    </tr>
            <?php }
            } catch (PDOException $e) {
                echo $e->getMessage();
            } ?>
        </table>
        </td>
        <td style="padding-left: 20px;">
        <table style="height:720px;width:500px;border:2px solid;border-collapse: collapse;">
                        <tr style="height:15px;">
                            <th colspan="3" style="border-bottom: 2px solid;">Office Copy</th>
                        </tr>
                        <tr style="height:40px;">
                        <td rowspan="4" style="width:40px;"><img src="./logo.jpeg" width="115px" height="115px"></td>
                            <th colspan="2" style="text-transform: uppercase;font-size: 16px;">Royalpupil International School
                            </th>
                        <tr style="height:30px;">
                            <td colspan="2">
                                <center>Kuduthini 583115, Bellary, Karnataka</center>
                            </td>
                        </tr>
                        <tr style="height:30px;">
                            <td colspan="2">
                                <center>royalpupilinternationalschool@gmail.com</center>
                            </td>
                        </tr>
                        <tr style="height:30px;">
                            <td colspan="2">
                                <center>+91 9845138636</center>
                            </td>
                        </tr>
            </tr>
            <?php $conn = $pdo->open();
            try {
                $stmt = $conn->prepare("SELECT * FROM payments WHERE payments_id=" . $_GET['payment_id'] . "");
                $stmt->execute();
                foreach ($stmt as $row) {
            ?>
                    <tr style="height:15px;border-bottom:1pt solid black;border-top:1pt solid black;">
                        <th>No:29120117805</th>
                        <th>Fee Receipt</th>
                        <th>Date: <?php echo $row['payments_date']; ?></th>
                    </tr>
                    <?php $stmt1 = $conn->prepare("SELECT students_id,students_name,students_father_name,students_class FROM students where students_id=" . $row['payments_students_id'] . "");
                    $stmt1->execute();
                    foreach ($stmt1 as $row1) { ?>
                        <tr style="height:30px;">
                            <td colspan="2">Student Name: <?php echo $row1['students_name']; ?></td>
                            <td>Student ID: <?php echo $row1['students_id']; ?></td>
                        </tr>
                        <tr style="height:30px;">
                            <td colspan="2">Father Name: <?php echo $row1['students_father_name']; ?></td>
                            <?php $stmt11 = $conn->prepare("SELECT classes_and_fee_class FROM classes_and_fee WHERE classes_and_fee_value='" . $row1['students_class'] . "'");
                            $stmt11->execute();
                            foreach ($stmt11 as $row11) { ?>
                                <td>Class: <?php echo $row11['classes_and_fee_class']; ?></td>
                            <?php } ?>
                        </tr>
                        <tr style="height:30px;border-bottom:1pt solid black;">
                            <td colspan="2" >Mode Of Payment: <?php
                                                            if ($row['payment_through'] == '1')
                                                                echo "CASH";
                                                            elseif ($row['payment_through'] == '2')
                                                                echo "CARD";
                                                            elseif ($row['payment_through'] == '3')
                                                                echo "CHECK";
                                                            elseif ($row['payment_through'] == '4')
                                                                echo "UPI";
                                                            elseif ($row['payment_through'] == '5')
                                                                echo "NET BANKING";
                                                            elseif ($row['payment_through'] == '6')
                                                                echo "OTHERS";
                                                            ?></td>
                            <td>Payment No: <?php echo $row['payments_id']; ?></td>
                        </tr>
                    <?php } ?>
                    </tr>
                    <tr style="height:15px;border-bottom:1pt solid black;">
                        <th colspan="2">Particulars</th>
                        <th>Amount(Rs)</th>
                    </tr>
                    <tr style="border-bottom:1pt solid black;" >
                        <td colspan="2" style="padding:20px;" VALIGN=TOP><?php if ($row['payments_type'] == '1')
                                            echo "Tuition Fee";
                                        elseif ($row['payments_type'] == '2')
                                            echo "Books Fee";
                                        elseif ($row['payments_type'] == '3')
                                            echo "Dress Fee";
                                        elseif ($row['payments_type'] == '4')
                                            echo "Transport Fee"; ?></td>
                        <td style="border-left:1pt solid black;padding:20px;" VALIGN=TOP><?php echo $row['payments_fee'].'.00'; ?></td>
                    </tr>
                    <tr style="height:15px;border-bottom:1pt solid black;">
                        <td colspan="2">Total Rs.</td>
                        <th rowspan="2" style="border-left:1pt solid black;"><?php echo $row['payments_fee'].'.00'; ?></th>
                    </tr>
                    <tr style="height:15px;text-transform: capitalize;">
                        <th colspan="2"><?php 
                        $number = $row['payments_fee'];
                        $no = floor($number);
                        $hundred = null;
                        $digits_1 = strlen($no);
                        $i = 0;
                        $str = array();
                        $words = array('0' => '', '1' => 'one', '2' => 'two',
                         '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
                         '7' => 'seven', '8' => 'eight', '9' => 'nine',
                         '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
                         '13' => 'thirteen', '14' => 'fourteen',
                         '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
                         '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
                         '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
                         '60' => 'sixty', '70' => 'seventy',
                         '80' => 'eighty', '90' => 'ninety');
                        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
                        while ($i < $digits_1) {
                          $divider = ($i == 2) ? 10 : 100;
                          $number = floor($no % $divider);
                          $no = floor($no / $divider);
                          $i += ($divider == 10) ? 1 : 2;
                          if ($number) {
                             $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                             $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                             $str [] = ($number < 21) ? $words[$number] .
                                 " " . $digits[$counter] . $plural . " " . $hundred
                                 :
                                 $words[floor($number / 10) * 10]
                                 . " " . $words[$number % 10] . " "
                                 . $digits[$counter] . $plural . " " . $hundred;
                          } else $str[] = null;
                       }
                       $str = array_reverse($str);
                       $result = implode('', $str);
                               echo $result . "Rupees Only.";
                                ?></th>
                    </tr>
                    <tr style="height:25px;border-top:1pt solid black;">
                        <th colspan="3" style="font-size: 10px;">THIS IS A COMPUTER GENERATED PRINTOUT WHICH REQUIRES NO
                            SIGNATURE</th>
                    </tr>
            <?php }
            } catch (PDOException $e) {
                echo $e->getMessage();
            } ?>
        </table>
    </center>
</body>
<script>
    window.print();
</script>
</html>