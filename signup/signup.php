<?php
include "../signup/inc/header.php";

if(isset($_POST['btnsubmit']))
{
    //initiate the form
    $name = isset($_POST['name']) && $_POST['name']!="";
    $username = isset($_POST['username']) && $_POST['username']!="";
    $email = isset($_POST['email']) && $_POST['email']!="";
    $password = isset($_POST['password']) && $_POST['password']!="";
    
    //convert to post method for safety
    if ($name && $username && $password && $email) 
    {   
        //value from db
        $name = $_POST['name'];
        $username = $_POST['username'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        
        // $id = date("YmdHis");

        if($email == "")
        {
          
        }
        else
        {
            $sql = "SELECT * FROM tblaccount WHERE username = '$username'";
            $result = mysqli_query($connect,$sql);
            $count = mysqli_fetch_array($result);
            // check email if exist
            if($count >= 1) 
            {
              echo '<script>alert("Email Already Exist")</script>';
            }
            elseif ($count <= 0) 
            {

              $options = [
                'cost' => 12,];
                $hash_pass = password_hash("$password", PASSWORD_BCRYPT, $options);
                //insert to db
                $query = "INSERT INTO tblaccount VALUES ('','$name', '$username','$hash_pass','$email', 'Unsubscribe', 'User','No','','')";
                if(mysqli_query($connect, $query))
                {
                  $_SESSION['success_message'] = "Account Created successfully.";
                    header("Location: ../signup/signup.php");
                    exit();
                    
                }
                else
                {
                  echo "Server problem, Try after sometime.";
                }
            }
        }    
    }

    else
    {
      echo '<script>alert("Please provide all data on the form")</script>';
    }
  }
?>

<section id="intro" class="clearfix">
<div class="container">
<div class="row">
	<div class="col-3">


  </div>
	 <div class="col-6">
    <div class="card">
            <h5 class="card-header  text-center lead text-muted">Join us! Find your study here.</h5>
            <div class="card-body" id="margin-top">
              <?php 
              // echo "$query";
              ?>
            <h3 class="card-title text-center">Signup</h3>
            <form action="" method="POST" onsubmit="return validateForm()" name="Form">
            <div class="form-group">

            <?php if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) { ?>
                        <div class="success-message" style="margin-bottom: 20px;font-size: 20px;color: green;"><?php echo $_SESSION['success_message']; ?></div>
                        <?php
                        unset($_SESSION['success_message']);
                    }
                    ?>
                    
                  <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="username" placeholder="Username" name="username">
                </div>
                <div class="form-group">
                <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>
               <div class="form-group">
               <input type="checkbox" onclick="myFunction2()">  Show Password
                  </div>
                <button type="submit" class="btn btn-primary btn-block" name="btnsubmit">Register</button>
              <br>
              Are you already registered? <a href="../login/login.php">Login Now</a>
          </form>
          </div>
        </div>
        </div>
</div>
</div>
</section>

  <br>
  <script type="text/javascript">
    function myFunction2() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
    </script>
  <!--==========================
    Footer
  ============================-->
  <!-- <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6 footer-info">
            <h3>AURESPOR</h3>
            <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus. Scelerisque felis imperdiet proin fermentum leo. Amet volutpat consequat mauris nunc congue.</p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">About us</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Terms of service</a></li>
              <li><a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br>
              <b>Phone:</b> +1 5589 55488 55<br>
              <b>Email:</b> info@example.com<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div>

          </div>

          <div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna veniam enim veniam illum dolore legam minim quorum culpa amet magna export quem marada parida nodela caramase seza.</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit"  value="Subscribe">
            </form>
          </div>

        </div>
      </div>
      
    </div>
  </footer> -->

 