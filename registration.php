<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
<?php  include "includes/navigation.php"; ?>

<?php
    $message = "";

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!empty($username) && !empty($email) && !empty($password)){
            $username = mysqli_real_escape_string($connection, $username);
            $email = mysqli_real_escape_string($connection, $email);
            $password = mysqli_real_escape_string($connection, $password);
    
            // $query = "SELECT randSalt FROM users";
            // $query_result = mysqli_query($connection, $query);
    
            // $row = mysqli_fetch_assoc($query_result);
            // $randSalt = $row['randSalt'];

            // $hash_format = "$2y$10$";
            // $salt = "iusesomecrazystrings22";
            // $hashF_and_salt = $hash_format . $salt;
            // $password = crypt($password, $hashF_and_salt);
    
            $query_for_registration = "INSERT into users (username, password, user_email, user_role) 
            VALUES ('{$username}', '{$password}', '{$email}', 'subscriber')";
            $insert_query = mysqli_query($connection, $query_for_registration);
            
            header("Location: registration.php");
        }
        else{
            $message = "*This Field cannot be empty";
        } 
    }
?>
    
 
    <!-- Page Content -->
    <div class="container">

    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                        <div><b style="color:red;"><?php if(empty($username)){echo $message;} ?></b></div>
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" value="<?php if(isset($username)){echo $username;}  ?>">
                        </div>
                         <div class="form-group">
                         <div><b style="color:red;"><?php if(empty($email)){echo $message;} ?></b></div>
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" value="<?php if(isset($email)){echo $email;}  ?>">
                        </div>
                         <div class="form-group">
                         <div><b style="color:red;"><?php if(empty($password)){echo $message;} ?></b></div>
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" value="<?php if(isset($password)){echo $password;}  ?>">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-success btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
