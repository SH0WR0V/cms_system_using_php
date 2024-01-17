<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<!-- Navigation -->

<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Contact us</h1>
                        <form action="mail.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="name" class="sr-only">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="enter your name here" value="<?php if (isset($_SESSION['username'])) {
                                                                                                                                            echo $_SESSION['username'];
                                                                                                                                        } ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="enter your email here" required>
                            </div>
                            <div class="form-group">
                                <label for="subject" class="sr-only">Subject</label>
                                <input type="text" name="subject" id="key" class="form-control" placeholder="enter your subject here" required>
                            </div>
                            <div class="form-group">
                                <label for="message" class="sr-only">Message</label>
                                <textarea name="message" id="message" class="form-control" cols="30" rows="10" placeholder="enter your message here.." required></textarea>
                            </div>
                            <input type="submit" name="send" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Send">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>