<?php
include 'header.php';

$book_id = '';
$student_id = '';

if (isset($_POST['save']) && $_POST['save'] == 'Save') {

    $errors = array();

    $book_id = $_POST['book_id'];
    $student_id = $_POST['student_id'];
    
    if($book_id==''){
        $errors[0]="Please choose any one book.";
    }
    
    if($student_id==''){
        $errors[1]="Please choose any one student.";
    }
    
    if(count($errors)==0){
        
        $book_id = $conn->real_escape_string($book_id);
        $student_id = $conn->real_escape_string($student_id);

        $query3 = "INSERT INTO issued_book_details (book_id, student_id, is_returned) VALUES ('$book_id','$student_id','No')";
        $conn->query($query3);
        if ($conn->affected_rows) {
            $success = "Data Inserted successfully!";
        }
    }
}

$query1 = "SELECT book_id,book_name FROM book_details";
$result1 = $conn->query($query1);

$query2 = "SELECT student_id, student_name FROM student_details";
$result2 = $conn->query($query2);
?>
<div class="main-content col-9">
    <div style="margin-top: 1rem; margin-left: 2rem;"><span style="color:green;"><?php if (isset($success)) echo $success; ?></span></div>
    <div class="container-fluid inner-box">
        <div class="upper d-flex">
            <span class="navbar-brand title">Issue Book</span>
        </div>
        <br>
        <br>
        <form method="post" action=''>
            <div class="issuebook-lower">
                <table class="table table-bordered border-primary">
                    <tbody>

                        <tr>
                            <td scope="col">Book Name</td>
                            <td><select name="book_id"> 
                                    <option value = "">Select Book</option>
                                    <?php
                                    if (mysqli_num_rows($result1) > 0) {
                                        while ($rows = $result1->fetch_assoc()) {
                                            ?>
                                            <option value = "<?php echo $rows['book_id']; ?>"><?php echo $rows['book_name']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <div style="color: red"><span><?php if (isset($errors[0])) echo $errors[0]; ?></span></div>
                            </td>
                        </tr>
                        <tr>
                            <td scope="col">Student Name</td>
                            <td><select name="student_id">  
                                    <option value = "">Select Student</option>
                                    <?php
                                    if (mysqli_num_rows($result2) > 0) {
                                        while ($rows = $result2->fetch_assoc()) {
                                            ?>
                                            <option value = "<?php echo $rows['student_id']; ?>"><?php echo $rows['student_name']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <div style="color: red"><span><?php if (isset($errors[1])) echo $errors[1]; ?></span></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <div class="upper d-flex">
                    <div class="cancel" style='margin-left: 53.5rem;'>
                        <a href="issuelist.php"><button class="btn btn-success" type="button" name='cancel' value='cancel'>Cancel</button></a>
                    </div>
                    <div class="save-button" style='margin-left: 1rem;'>
                        <button class="btn btn-success" type="submit" name='save' value='Save'>Issue</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include 'footer.php'; ?>