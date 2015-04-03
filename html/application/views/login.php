


<div class="container">
            <div class="form-wrapper">

            <?php 
            echo validation_errors(); 
            $attributes = array('class' => 'form-signin wow fadeInUp');
   			echo form_open('verifylogin', $attributes); 
   			?>

            <!-- <form class="form-signin wow fadeInUp" action="index.html"> -->
            <h2 class="form-signin-heading">sign in now</h2>
            <div class="login-wrap">
                <input type="text" class="form-control" id="username" name="username" placeholder="User ID" autofocus>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <!-- <label class="checkbox">
                    <input type="checkbox" value="remember-me"> Remember me
                    <span class="pull-right">
                        <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                    </span>
                </label> -->
                <input class="btn btn-lg btn-login btn-block" name="submit" type="submit" value="Login" > </br>
                <!-- <p>or you can sign in via social network</p> -->
                <!-- <div class="login-social-link">
                    <a href="index.html" class="facebook">
                        <i class="fa fa-facebook"></i>
                        Facebook
                    </a>
                    <a href="index.html" class="twitter">
                        <i class="fa fa-twitter"></i>
                        Twitter
                    </a>
                </div> -->
                <div class="registration">
                    Don't have an account yet?
                    <a class="" href="registration.html"> <!-- THIS NEEDS TO MODIFIED AS SOON AS THERE IS A REGISTRATION PAGE -->
                        Create an account
                    </a>
                </div>

            </div>

            	<!-- This modal is only needed if there is an option for forgot my password -->
               <!-- Modal -->
              <!-- <div aria-hidden="true" aria-labelledby="myModal" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">Forgot Password ?</h4>
                          </div>
                          <div class="modal-body">
                              <p>Enter your e-mail address below to reset your password.</p>
                              <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                          </div>
                          <div class="modal-footer">
                              <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                              <button class="btn btn-success" type="button">Submit</button>
                          </div>
                      </div>
                  </div>
              </div> -->
              <!-- modal -->

          <?php form_close(); ?>
          </div>
        </div>


<