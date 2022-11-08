<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include "./include/dbconnect.php" ;






if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    $loggedIn =false;
}
else{
    $loggedIn =true;
    $conn = (new Database())->getConnection();

    $email=$_SESSION['email'];
    $sql = "SELECT * FROM `upgradelogin` WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    while( $row = mysqli_fetch_assoc($result))
    {
        $mysno = $row['sno'];
        $myfname = $row['fname'];
        $mylname = $row['lname'];
        $myemail = $row['email'];

    }

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyVlogpage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>


<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid"><button type="button" class="btn btn-outline-success"" data-bs-toggle="modal" data-bs-target="#exampleModal">

        <?php

        if($loggedIn){
            echo $myfname;
            echo $mylname;
            ?>

        <?php }
        else{
            echo '<h4>ioops</h4>';
        }
        ?>

        </button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">About</a>
                </li> <li class="nav-item">
                    <a class="nav-link text-white" href="#">Contact Us</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Photos Category
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Nature</a></li>
                        <li><a class="dropdown-item" href="#">Travelling</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Food vlogging</a></li>
                    </ul>
                </li>




                <li class="nav-item dropdown">


                    <!-- Button trigger modal -->

                    <?php
                    if($loggedIn){


                        ?>




                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Profile</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">





                                        <form action="include/update.php" method="post">
                                            <input type="hidden"  id="fname" name="sno" value="<?php echo $mysno; ?>">

                                            <div class="mb-3">
                                                <label for="fname" class="form-label">fname</label>
                                                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $myfname; ?>">

                                            </div>
                                            <div class="mb-3">
                                                <label for="lname" class="form-label">lname</label>
                                                <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $mylname; ?>">

                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                                <input type="email" class="form-control"  name="email" id="email" value="<?php echo $myemail; ?>">

                                            </div>


                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>'<?php ;}
                    ?>
                </li>
            </ul>


            <div class="row mx-2">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>



            </div>
            <div class="mx-2">
                <?php
                if($loggedIn){

                    echo'<a href="include/logout.php"><button type="button" class="btn btn-outline-success" >Logout</button></a>';
                }
                else{
                    echo '<button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
    
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</button>';
                }
                ?>
            </div>
        </div>
    </div>
    <?php include 'include/login.php';?>

</nav>
<?php
if(isset($_SESSION['status']))

{
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Success!</strong> <?php echo $_SESSION['status'] ?>
    </div>
    <?php

    unset($_SESSION['status']);
}

?><?php
if(isset($_SESSION['update']))

{
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Success!</strong> <?php echo $_SESSION['update'] ?>
    </div>
    <?php

    unset($_SESSION['update']);
}

?>




<?php include 'include/header.php'; ?>

<div class="container my-3">
    <div class="row gy-3">
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://source.unsplash.com/900x700/?nature,mountain", alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://source.unsplash.com/900x700/?nature,flower", alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://source.unsplash.com/900x700/?nature,buildings", alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>      <div class="col">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://source.unsplash.com/900x700/?nature,school", alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>      <div class="col">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://source.unsplash.com/900x700/?nature,colllege", alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>      <div class="col">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://source.unsplash.com/900x700/?nature,sites", alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include 'include/footer.php'; ?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>l>