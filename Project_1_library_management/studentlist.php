<?php
include 'header.php';

$query1 = "SELECT student_id, student_name, student_roll_no, student_phone_no, student_image_href_link FROM student_details";
$result = $conn->query($query1);
?>
<div class="main-content col-9">    
    <div style="margin-top: 1rem; margin-left: 2rem;"><span style="color:green;"><?php if (isset($_SESSION['success'])) echo $_SESSION['success'];unset($_SESSION['success']); ?></span></div>
    <div class="container-fluid inner-box">
        <div class="upper d-flex">
            <div class="main-title">
                <span class="navbar-brand title">Student List</span>
            </div>
            <div class="add-student-button" align="rightside">
                <a href="addstudent.php"><button class="btn btn-success" type="button">Add Student</button></a>
            </div>
        </div>
        <br>
        <br>
        <div class="lower">
            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">ID</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Student Roll No.</th>
                        <th scope="col">Phone No.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($rows = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <th scope="row"><img class="img-thumbnail" style="border-radius: 5rem;" src="images/<?php echo $rows['student_image_href_link']; ?>" alt="profile"></th>
                                <td><?php echo $rows['student_id']; ?></td>
                                <td><?php echo $rows['student_name']; ?></td>
                                <td><?php echo $rows['student_roll_no']; ?></td>
                                <td><?php echo $rows['student_phone_no']; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <br>
            <div class="add-student-button" style="margin-left: 58.5rem; width: 10rem;">
                <a href="export.php?export=1"><button class="btn btn-success" type="button">Export</button></a>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>