<?php 
include 'header.php'; 

$query1 = "SELECT book_name,book_author_name, book_isbn_no FROM book_details";
$result = $conn->query($query1);
?>
<div class="main-content col-9">
    <div class="container-fluid inner-box">
        <div class="upper d-flex">
            <div class="main-title">
                <span class="navbar-brand title">Book List</span>
            </div>
            <div class="add-book-button" align="rightside">
                <a href="addbook.php"><button class="btn btn-success" type="submit">Add Book</button></a>
            </div>
        </div>
        <br>
        <br>
        <div class="lower">
            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th scope="col">Book Name</th>
                        <th scope="col">Author Name</th>
                        <th scope="col">ISBN No.</th>
                    </tr>
                </thead>
                <tbody>
                     <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($rows = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $rows['book_name']; ?></td>
                                <td><?php echo $rows['book_author_name']; ?></td>
                                <td><?php echo $rows['book_isbn_no']; ?></td>
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