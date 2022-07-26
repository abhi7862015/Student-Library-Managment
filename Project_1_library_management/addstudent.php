<?php 
include 'header.php';

$name = '';
$username = '';
$password = '';
$confirm_password = '';
$roll_no = '';
$phone_no = '';
$image = '';

if (isset($_POST['save']) && $_POST['save'] == 'Save') {

    $errors = array();

    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmpassword'];
    $roll_no = $_POST['rollno'];
    $phone_no = $_POST['phoneno'];
    $image = $_POST['image'];

    if ($name == '') {
        $errors[0] = "Please enter student's name.";
    } else if (!ctype_alpha($name)) {
        $errors[0] = "Please enter only alphabets.";
    }
    
    $usename = $conn->real_escape_string($username);
    $query1 = "SELECT student_username FROM student_details WHERE student_username like '" . $username . "'";
    $result = $conn->query($query1);
    
    if ($username == '') {
        $errors[1] = "Please enter student's username.";
    } else if (mysqli_num_rows($result) != 0) {
        $errors[1] = "Username already exists, please try again!";
    }

    if ($password == '') {
        $errors[2] = "Please create a new password.";
    } else if (strlen($password) < 5 || strlen($password) > 16) {
        $errors[2] = "Password length should be greater than 5 and less than 16.";
    }

    if ($confirm_password == '') {
        $errors[3] = "Please re-enter a password.";
    } else if ($password != $confirm_password) {
        $errors[3] = "Password not matched, please try again!";
    }

    $roll_no = $conn->real_escape_string($roll_no);
    $query2 = "SELECT student_roll_no FROM student_details WHERE student_roll_no =" . $roll_no;
    $result = $conn->query($query2);
    
    if ($roll_no == '') {
        $errors[4] = "Please enter student's roll no.";
    } else if (!ctype_digit($roll_no)) {
        $errors[4] = "Please enter only numbers.";
    } else if (mysqli_num_rows($result) != 0) {
        $errors[4] = "Roll no already exists, please try again!";
    }

    if ($phone_no == '') {
        $errors[5] = "Please enter student's mobile no.";
    } else if (!ctype_digit($phone_no)) {
        $errors[5] = "Please enter only numbers.";
    } else if (strlen($phone_no) != 10) {
        $errors[5] = "Please enter only 10 digit's mobile number.";
    }

    if ($image == '') {
        $errors[6] = "Please choose student's image.";
    }

    if (count($errors) == 0) {
        $name = $conn->real_escape_string($name);
        $usename = $conn->real_escape_string($username);
        $password = $conn->real_escape_string($password);
        $roll_no = $conn->real_escape_string($roll_no);
        $phone_no = $conn->real_escape_string($phone_no);
        $image = $conn->real_escape_string($image);

        $query3 = "INSERT INTO student_details (student_name, student_username, student_password, student_roll_no,student_phone_no, student_image_href_link) VALUES ('$name','$usename', '" . md5($password) . "', '$roll_no','$phone_no','$image')";
        $conn->query($query3);
        if ($conn->affected_rows) {
            $success = "Data Inserted successfully!";
        }
    }
}
?>
<div class="main-content col-9">
    <div style="margin-top: 1rem; margin-left: 2rem;"><span style="color:green;"><?php if (isset($success)) echo $success; ?></span></div>
    <div class="container-fluid inner-box">
        <div class="upper d-flex">
            <span class="navbar-brand title">Add Student</span>
        </div>
        <br>
        <br>
        <form method="post" action=''>
            <div class="addstudent-lower">
                <table class="table table-bordered border-primary">
                    <tbody>
                        <tr>
                            <th scope="row">Student Name</th>
                            <td><input type="text" id="form2Example17" class="form-control form-control-mb" name="name" placeholder="Name" value='<?php if (isset($name)) echo $name; ?>'/><div style="color: red"><span><?php if (isset($errors[0])) echo $errors[0]; ?></span></div></td>
                        </tr>
                        <tr>
                            <th scope="row">Student Username</th>
                            <td><input type="text" id="form2Example17" class="form-control form-control-mb" name="username" placeholder="Username" value='<?php if (isset($username)) echo $username; ?>'/><div style="color: red"><span><?php if (isset($errors[1])) echo $errors[1]; ?></span></div></td>
                        </tr>
                        <tr>
                            <th scope="row">Create Password</th>
                            <td><input type="password" id="form2Example17" class="form-control form-control-mb" name="password" placeholder="Password" value='<?php if (isset($password)) echo $password; ?>'/><div style="color: red"><span><?php if (isset($errors[2])) echo $errors[2]; ?></span></div></td>
                        </tr>
                        <tr>
                            <th scope="row">Confirm Password</th>
                            <td><input type="password" id="form2Example17" class="form-control form-control-mb" name="confirmpassword" placeholder="Confirm Password" value='<?php if (isset($confirm_password)) echo $confirm_password; ?>'/><div style="color: red"><span><?php if (isset($errors[3])) echo $errors[3]; ?></span></div></td>
                        </tr>
                        <tr>
                            <th scope="row">Student Roll No.</th>
                            <td><input type="text" id="form2Example17" class="form-control form-control-mb" name="rollno" placeholder="Roll No" value='<?php if (isset($roll_no)) echo $roll_no; ?>'/><div style="color: red"><span><?php if (isset($errors[4])) echo $errors[4]; ?></span></div></td>
                        </tr>
                        <tr>
                            <th scope="row">Phone No</th>
                            <td><input type="text" id="form2Example17" class="form-control form-control-mb" name="phoneno" placeholder="Phone No" value='<?php if (isset($phone_no)) echo $phone_no; ?>'/><div style="color: red"><span><?php if (isset($errors[5])) echo $errors[5]; ?></span></div></td>
                        </tr>
                        <tr>
                            <th scope="row">Upload Profile Image</th>
                            <td><div class="mb-3"><input class="form-control form-control-mb" id="formFileSm" type="file" name='image' value='<?php if (isset($image)) echo $image; ?>'></div><div style="color: red"><span><?php if (isset($errors[6])) echo $errors[6]; ?></span></div></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <div class="upper d-flex">
                    <div class="cancel">
                        <a href="studentlist.php" style="color:blue;">Cancel</a>
                    </div>
                    <div class="save-button" style='margin-left: 56.5rem;'>
                        <button class="btn btn-success" type="submit" name='save' value='Save'>Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include 'footer.php'; ?>