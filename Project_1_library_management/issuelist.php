<?php
include 'header.php';

//dropdown data for book
$query3 = "SELECT book_id,book_name FROM book_details";
$result3 = $conn->query($query3);

//dropdown data for student
$query4 = "SELECT student_id, student_name FROM student_details";
$result4 = $conn->query($query4);

//filter
$condition_book_id = '';
$condition_student_id = '';
$condition_both = '';
$book_id = '';
$student_id = '';

if (isset($_GET['search']) && $_GET['search'] == 'Search') {
    if ($_GET['book_id'] != '' && $_GET['student_id'] != '') {
        $book_id = $_GET['book_id'];
        $student_id = $_GET['student_id'];
        $condition_both = " WHERE bd.book_id=" . $_GET['book_id'] . " AND sd.student_id=" . $_GET['student_id'];
    } else if ($_GET['book_id'] != '') {
        $book_id = $_GET['book_id'];
        $condition_book_id = " WHERE bd.book_id=" . $_GET['book_id'];
    } else if ($_GET['student_id'] != '') {
        $student_id = $_GET['student_id'];
        $condition_student_id = " WHERE sd.student_id=" . $_GET['student_id'];
    }
}

//list data
$query1 = "SELECT ibd.issued_book_id, bd.book_name, sd.student_name, ibd.issued_date, ibd.returned_date, ibd.is_returned FROM issued_book_details ibd inner join student_details sd on ibd.student_id=sd.student_id inner join book_details bd on ibd.book_id=bd.book_id " . $condition_book_id . $condition_student_id . $condition_both . " order by issued_book_id asc";
$result1 = $conn->query($query1);

//update for returning book
if (isset($_GET['issued_id']) && $_GET['issued_id'] != '') {
    $issued_id = $conn->real_escape_string($_GET['issued_id']);

    $query2 = "UPDATE issued_book_details set is_returned='Yes', returned_date=CURRENT_TIMESTAMP WHERE issued_book_id=" . $issued_id;

    $conn->query($query2);
    if ($conn->affected_rows) {
        $success = "Data Updated successfully!";
    }
}
?>
<div class="main-content col-9">
    <div style="margin-top: 1rem; margin-left: 2rem;"><span style="color:green;"><?php if (isset($success)) echo $success; ?></span></div>
    <div class="container-fluid inner-box">
        <div class="upper d-flex">
            <div class="main-title">
                <span class="navbar-brand title">Issue List</span>
            </div>
            <div class="issue-list-button">
                <a href="issuebook.php"><button class="btn btn-success" type="submit">Issue book</button></a>
            </div>
        </div>
        <br>
        <form method="get" action="">
            <div class="filterd d-flex">
                <div class="select-book">
                    <select name="book_id"> 
                        <option value = "">Select Book</option>
                        <?php
                        if (mysqli_num_rows($result3) > 0) {
                            while ($rows = $result3->fetch_assoc()) {
                                ?>
                                <option value = "<?php echo $rows['book_id']; ?>" <?php if(isset($book_id) && $rows['book_id']==$book_id) echo "selected";?>><?php echo $rows['book_name']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="select-student-name">              
                    <select name="student_id">  
                        <option value = "">Select Student</option>
                        <?php
                        if (mysqli_num_rows($result4) > 0) {
                            while ($rows = $result4->fetch_assoc()) {
                                ?>
                                <option value = "<?php echo $rows['student_id']; ?>" <?php if(isset($student_id) && $rows['student_id']==$student_id) echo "selected";?>><?php echo $rows['student_name']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="search">
                    <button class="btn btn-success" type="submit" name="search" value="Search">Search</button>
                </div>
            </div>
        </form>

        <br>
        <br>
        <div class="lower" style="width: 100%;">
            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Issue Date</th>
                        <th scope="col">Return Date</th>
                        <th scope="col">Return Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result1) > 0) {
                        while ($rows = $result1->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $rows['issued_book_id']; ?></td>
                                <td><?php echo $rows['book_name']; ?></td>
                                <td><?php echo $rows['student_name']; ?></td>
                                <td><?php echo $rows['issued_date']; ?></td>
                                <td><?php echo $rows['returned_date']; ?></td>
                                <td><?php if ($rows['returned_date'] == '') { ?><a href="issuelist.php?issued_id=<?php echo $rows['issued_book_id']; ?>" style="color: blue">Return</a><?php } ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>