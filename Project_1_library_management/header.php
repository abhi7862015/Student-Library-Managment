<?php
include 'db_connection.php';

//check account logged in or not
if(!isset($_SESSION['student_id'])){
    header('Location: login.php');
}
//Logout functionality
if (isset($_POST['logout'])) {
    unset($_SESSION['student_id']);
    header('Location: login.php');
}
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Library Management</title>
        <style>
            .navbar{
                background-color: #6D6968;
            }
            .navbar-brand{
                color: white;
            }
            .library-management{
                background-color: red;
                height: 4rem;
                width: 20rem;
                padding: 1rem 4rem 1rem 4rem;
            }
            .left-column{
                background-color: black;
                height: 120rem;
                padding-top: 2.5rem;
                padding-left: .5rem;
            }
            .book-logos{
                width:12rem;
                height:12rem;
            }
            .logo{
                height:3rem;
                width:4rem;
            }
            .book-listing{
                margin-top: 1rem;
                width: 10rem;
                text-align: center;
            }
            .issue-listing{
                margin-top: 1rem;
                width: 10rem;
                text-align: center;
            }
            .student-listing{
                margin-top: 1rem;
                width: 11rem;
                text-align: center;
            }
            .user-manual{
                margin-top: 1rem;
                width: 16rem;
                text-align: center;
            }
            a{
                color: white;
                text-decoration: none;
            }
            .main-content{
                background-color: white;
            }
            .inner-box{
                background-color: #EFEFEF;
                margin: 2rem 2rem 2rem 2rem;
                width: 94%;
                padding: 2rem 2rem 2rem 2rem;
            }
            .title{
                color:blue;
            }
            .add-student-button{
                margin-left: 48rem;
            }
            .add-book-button{
                margin-left: 50.5rem;
            }
            .issue-list-button{
                margin-left: 50.5rem
            }
            .lower{
                width:50%;
            }
            .select-student-name{
                margin-left: 1rem;
            }
            .search{
                margin-left: 25rem;
            }
        </style>
    </head>
    <body>
        <nav class="navbar">
            <div class="container-fluid">
                <div class="library-management">
                    <span class="navbar-brand">Library Management</span>
                </div>
                <div class="d-flex">
                    <span class="navbar-brand">Welcome Admin</span>
                    <form method="post" action="">
                        <button class="btn btn-danger" type="submit" value="<?php if (isset($_SESSION['student_id'])) echo $_SESSION['student_id']; ?>" name="logout">Logout</button>
                    </form>
                </div>
            </div>
        </nav>
        <div class="main-box d-flex">
            <div class="left-column col-3">
                <div class="book-logos">
                    <img class="img-thumbnail" src="images/books.jpg" alt="Books">
                </div>
                <div class="book-listing d flex">
                    <img class="img-thumbnail logo" src="images/booklisting.jpg" alt="Book-listing">
                    <a href="booklist.php">Book List</a>
                </div>
                <div class="issue-listing d flex">
                    <img class="img-thumbnail logo" src="images/pc.jpg" alt="Issue-listing">
                    <a href="issuelist.php">Issue List</a>
                </div>
                <div class="student-listing d flex">
                    <img class="img-thumbnail logo" src="images/barcode.jpg" alt="Student-listing">
                    <a href="studentlist.php">Student List</a>
                </div>
                <div class="user-manual d flex">
                    <img class="img-thumbnail logo" src="images/calender.jpg" alt="User-manual">
                    <a href="#">Download User Manual</a>
                </div>
            </div>

