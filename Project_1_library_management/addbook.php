<?php include 'header.php';

$book_name = '';
$author_name = '';
$isbn_no = '';

if (isset($_POST['save']) && $_POST['save'] == 'Save') {

    $errors = array();

    $book_name = $_POST['book_name'];
    $author_name = $_POST['author_name'];
    $isbn_no = $_POST['isbn_no'];

    if ($book_name == '') {
        $errors[0] = "Please enter book's name.";
    } 
    
    if ($author_name == '') {
        $errors[1] = "Please enter author's name.";
    } 

    $isbn_no = $conn->real_escape_string($isbn_no);
    $query1 = "SELECT book_isbn_no FROM book_details WHERE book_isbn_no =" . $isbn_no;
    $result = $conn->query($query1);
    
    if ($isbn_no == '') {
        $errors[2] = "Please enter ISBN Number.";
    } else if (!ctype_digit($isbn_no)) {
        $errors[2] = "Please enter only numbers.";
    } else if (strlen($isbn_no)!=13) {
        $errors[2] = "The length of ISBN no. should be 13, please try again!";
    } else if (mysqli_num_rows($result) != 0) {
        $errors[2] = "ISBN number already exists, please try again!";
    }

    if (count($errors) == 0) {
        $book_name = $conn->real_escape_string($book_name);
        $author_name = $conn->real_escape_string($author_name);
        $isbn_no = $conn->real_escape_string($isbn_no);

        $query2 = "INSERT INTO book_details (book_name, book_author_name, book_isbn_no) VALUES ('$book_name','$author_name', '$isbn_no')";
        
        $conn->query($query2);
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
            <span class="navbar-brand title">Add Book</span>
        </div>
        <br>
        <br>
        <form method="post" action=''>
            <div class="addstudent-lower">
                <table class="table table-bordered border-primary">

                    <tbody>
                        <tr>
                            <th scope="row">Book Name</th>
                            <td><input type="text" id="form2Example17" class="form-control form-control-mb" name="book_name" placeholder="Book Name" value='<?php if (isset($book_name)) echo $book_name; ?>'/><div style="color: red"><span><?php if (isset($errors[0])) echo $errors[0]; ?></span></div></td>
                        </tr>
                        <tr>
                            <th scope="row">Author Name</th>
                            <td><input type="text" id="form2Example17" class="form-control form-control-mb" name="author_name" placeholder="Author Name" value='<?php if (isset($author_name)) echo $author_name; ?>'/><div style="color: red"><span><?php if (isset($errors[1])) echo $errors[1]; ?></span></div></td>
                        </tr>
                        <tr>
                            <th scope="row">ISBN Number</th>
                            <td><input type="text" id="form2Example17" class="form-control form-control-mb" name="isbn_no" placeholder="ISBN Number" value='<?php if (isset($isbn_no)) echo $isbn_no; ?>'/><div style="color: red"><span><?php if (isset($errors[2])) echo $errors[2]; ?></span></div></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <div class="upper d-flex">
                    <div class="cancel">
                        <a href="booklist.php" style="color:blue;">Cancel</a>
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