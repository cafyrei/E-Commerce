<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url('css/signup.css') ?>">
    <title>Sign Up | Wood & Quality</title>
  </head>

  <body>
    <div class="wrapper">
      <div class="container">
        
        <div class="image-side">
          <div class="quote-box">
            <h2><span>Crafted for Comfort</span><br>Join our community</h2>
          </div>
        </div>

        <div class="form-side">
          <div class="form-box">
            <h2>Create Account</h2>
            <h3>Join us to get the best quality wood designs for your home.</h3>

            <div class="input-group">
              <span class="input-icon">
                <img src="user-icon.png" alt="user" />
              </span>
              <input type="text" placeholder="Full Name" />
            </div>

            <div class="input-group">
              <span class="input-icon">
                <img src="email-icon.png" alt="email" />
              </span>
              <input type="email" placeholder="Email Address" />
            </div>

            <div class="input-group">
              <span class="input-icon">
                <img src="lock-icon.png" alt="password" />
              </span>
              <input type="password" placeholder="Password" />
            </div>

            <button class="main-btn">Sign Up</button>

            <div class="login-link">
              <p>Already Have an Account? <a href="login.html">Login</a></p>
            </div>

            <div class="social-login">
              <div class="or-separator">
                <span>Or sign up with</span>
              </div>

              <div class="social-buttons">
                <button class="facebook"><img src="facebook-icon.png" alt="FB" /></button>
                <button class="google"><img src="google-icon.png" alt="G" /></button>
                <button class="apple"><img src="apple-icon.png" alt="A" /></button>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </body>
</html>