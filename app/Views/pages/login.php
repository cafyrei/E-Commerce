<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url('css/login.css') ?>">
    <title>Login | Wood & Quality</title>
  </head>

  <body>
    <div class="wrapper">
      <div class="container">
        <!-- LEFT -->
        <div class="left">
          <div class="form-box">
            <h2>Login Account</h2>
            <h3>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque
              voluptate fugit reprehenderit repellat perspiciatis harum vitae
              laboriosam exercitationem libero,
            </h3>

            <div class="input-group">
              <span class="input-icon">
                <img src="<?= base_url('../images/social-icons/form-icons/email-icon.png') ?>" alt="email" />
              </span>
              <input type="text" placeholder="Email Address" />
            </div>

            <div class="input-group">
              <span class="input-icon">
                <img src="<?= base_url('../images/social-icons/form-icons/lock-icon.png') ?>" alt="password" />
              </span>
              <input type="password" placeholder="Password" />
            </div>

            <div class="login-options-container">
              <div class="checkbox-group">
                <input type="checkbox" id="remember" name="remember" />
                <label for="remember">Remember Me</label>
              </div>
              <div class="forgot-container">
                <a href="#">Forgot Password?</a>
              </div>
            </div>

            <button>Login</button>

            <div class="register-container">
              <a href="#">Don't Have an Account?</a>
            </div>

            <div class="create-account">
              <button>Create Account</button>
            </div>

            <div class="social-login">
              <div class="or-separator">
                <span>Or sign in with</span>
              </div>

              <div class="social-buttons">
                <button class="facebook">
                  <img src="<?= base_url('../images/social-icons/facebook-icon.png') ?>" alt="Facebook" />
                </button>
                <button class="google">
                  <img src="<?= base_url('../images/social-icons/google-icon.png') ?>" alt="Google" />
                </button>
                <button class="apple">
                  <img src="<?= base_url('../images/social-icons/apple-icon.png') ?>" alt="Apple" />
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- RIGHT -->
        <div class="right">
          <div class="quote-box">
            <h2><span>Wood that speaks quality</span><br> not just style</h2>
          </div>
        </div>
      </div>
      <!-- End Container DIV -->
    </div>
  </body>
</html>
