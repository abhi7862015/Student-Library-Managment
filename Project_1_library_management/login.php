<?php
include 'db_connection.php';

$username = '';
$password = '';

if (isset($_POST['login']) && $_POST['login'] == 'Login') {

    $errors = array();

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $usename = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);
    $query1 = "select student_id, student_username, student_password from student_details where student_username like '" . $username . "' and student_password='" . $password."'";
    $result = $conn->query($query1);
    $num=mysqli_num_rows($result);
    
    if ($username == '') {
        $errors[0] = "Please enter your username.";
    }
    if ($password == '') {
        $errors[1] = "Please enter your password.";
    }
    
    if ($num>0) {
        $row = $result->fetch_assoc();
        $_SESSION['student_id'] = $row['student_id'];
        
        header('Location: studentlist.php');
    } else {
        $errors[2] = "Username and password does not exist, please try again!";
    }
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

        <title>Login</title>

    </head>
    <body>
        <section class="vh-100" style="background-color: #9A616D;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-xl-10">
                        <div class="card" style="border-radius: 1rem;">
                            <div class="row g-0">
                                <div class="col-md-6 col-lg-5 d-none d-md-block">
                                    <img src="images/books.jpg"
                                         alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; width:auto;height:35rem" />
                                </div>
                                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                    <div class="card-body p-4 p-lg-5 text-black">

                                        <form method="post" action="">

                                            <div class="d-flex align-items-center mb-3 pb-1">
                                                <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                                <span class="h1 fw-bold mb-0">Library Management</span>
                                            </div>

                                            <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example17">Username</label>
                                                <input type="text" id="form2Example17" class="form-control form-control-lg" name="username" placeholder="Username" />
                                                <div style="color: red"><span><?php if (isset($errors[0])) echo $errors[0]; ?></span></div>
                                            </div>

                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example27">Password</label>
                                                <input type="password" id="form2Example27" class="form-control form-control-lg" name="password" placeholder="Password"/>
                                                <div style="color: red"><span><?php if (isset($errors[1])) echo $errors[1]; ?></span></div>
                                            </div>

                                            <div style="color: red"><span><?php if (isset($errors[2])) echo $errors[2]; ?></span></div>

                                            <a class="small text-muted" href="#!">Forgot password?</a>

                                            <div class="pt-1 mb-4 mt-4">
                                                <button class="btn btn-dark btn-lg btn-block" type="submit" name="login" value="Login">Login</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>

