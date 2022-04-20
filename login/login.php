<?php
include_once ("../login/inc/header.php");

if(isset($_POST['but_submit']))
    {
      if(empty($_POST['username']) && empty($_POST['password']))
      {
        echo '<script>alert("Fill all Fields")</script>';
      }
      else
      {
        // username and password sent from form 
      $username = mysqli_real_escape_string($connect,$_POST['username']);
      $password = mysqli_real_escape_string($connect,$_POST['password']); 
      
      $sql = "SELECT * FROM tblaccount WHERE username = '$username'";
      $result = mysqli_query($connect,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      // check email if exist
      if($count == 1) 
      {
        // $em = $row['email'];
        $hash = $row['pass'];
        $status = $row['status'];
        $fname = $row['name'];
        $categ = $row['ucategory'];

       
        if($_POST['username'] && password_verify($_POST['password'], $hash))
        {
            if($status == "Active" || $status == "Inactive")
            {
                if($categ == "Administrator")
                {
                    // session_register("myusername");
                      $_SESSION['id'] = $row['id'];
                      $_SESSION['name'] = $row['name'];
                      $_SESSION['role'] = $row['ucategory'];
                      $_SESSION['status'] = $row['status'];
                      $_SESSION['subscribe'] = $row['subcribe'];
                      $_SESSION['email'] = $row['email'];
                    header("location: ../admin/index.php");
                }
                else
                {
                    // session_register("myusername");
                      $_SESSION['id'] = $row['id'];
                      $_SESSION['name'] = $row['name'];
                      $_SESSION['role'] = $row['ucategory'];
                      $_SESSION['status'] = $row['status'];
                      $_SESSION['subscribe'] = $row['subcribe'];
                      $_SESSION['email'] = $row['email'];
                    header("location: ../index.php");
                }
            }
            else
            {
              // echo '<script>alert("Account Inactive")</script>';
            }
        }
        else
        {
            echo '<script>alert("Email and Password not Match")</script>';
        }
      }
      else 
      {
        echo '<script>alert("Account Not Exist")</script>';
      }
      }
   }
?>

<section id="intro" class="clearfix">
<!-- #sign in -->
<div class="container">
<div class="row">
	<div class="col-3"></div>
	<div class="col-6">
            <div class="card">
            <div class="card-body" id="margin-top">
            <?php
            
            ?>
            <h3 class="card-title text-center">Login</h3>
        <form action="" method="POST" name="Form" onsubmit="return validateForm()">
            <div class="md-form">
              <input type="text" class="form-control validate"  
              id="username"
              name="username"
              placeholder="Your username">
              <label data-error="wrong" data-success="right"></label>
            </div>

            <div class="md-form">
              
              <input type="password" class="form-control validate"
              id="myInput"
              name="password" 
              placeholder="Your Password">

              <label data-error="wrong" data-success="right"></label>
              <input type="checkbox" onclick="myFunction()">  Show Password
              <!-- <p class="font-small blue-text d-flex justify-content-end"><a href="#" class="blue-text ml-1">Forgot Password?</a></p> -->
            </div>


            <div class="md-form">
            <input type="checkbox" id="myCheck" name="accept" value="yes" required> 
            "I agree to the Terms and Conditions" or "I agree to the Privacy Policy"
            </div>

          <div class="text-center mb-3">
            
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="but_submit" name="but_submit" >Sign in</button>
          </div>
          <span>Don't have an account? <a href="../signup/signup.php" >Create a free account</span>
        </form>
    
        <!-- <p class="font-small dark-grey-text d-flex justify-content-center">or sign in with:</p>
        <div class="row my-3 justify-content-center">
          <button type="button" class="btn btn-primary z-depth-1a"><i class="fab fa-facebook-f text-center"></i></button>
          <button type="button" class="btn btn-purple z-depth-1a"><i class="fab fa-twitter text-center"></i></button>
          <button type="button" class="btn btn-red z-depth-1a"><i class="fab fa-google-plus-g text-center"></i></button> -->
        </div>
      </div>
    </div>
    </div> 
</div>
</div>

</section>

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

  <script type="text/javascript">
    function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
    </script>
    
    <script>
function myFunction1() {
  var x = document.getElementById("myCheck").required;
  document.getElementById("demo").innerHTML = x;
}
</script>