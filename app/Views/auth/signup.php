<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="<?= base_url('assets/css/user-signup.css') ?>">
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

          <form action="<?= site_url('signup') ?>" method="post">
            <div class="name-input-group">

              <div class="name-division">
                <div class="input-group">
                  <span class="input-icon">
                    <img src="<?= base_url('assets/images/social-icons/form-icons/user-icon.png') ?>" alt="user" />
                  </span>
                  <input type="text" name="first_name" placeholder="First Name" />
                </div>

                <div class="input-group">
                  <span class="input-icon">
                    <img src="<?= base_url('assets/images/social-icons/form-icons/user-icon.png') ?>" alt="user" />
                  </span>
                  <input type="text" name="middle_name" placeholder="Middle Name" />
                </div>
              </div>

              <div class="name-division">
                <div class="input-group">
                  <span class="input-icon">
                    <img src="<?= base_url('assets/images/social-icons/form-icons/user-icon.png') ?>" alt="user" />
                  </span>
                  <input type="text" name="last_name" placeholder="Last Name" />
                </div>

                <div class="input-group">
                  <select name="suffix">
                    <option value="">None</option>
                    <option value="Jr">Jr.</option>
                    <option value="Sr">Sr.</option>
                    <option value="III">III</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="input-group">
              <span class="input-icon">
                <img src="<?= base_url('assets/images/social-icons/form-icons/email-icon.png') ?>" alt="email" />
              </span>
              <input type="email" name="email" placeholder="Email Address" />
            </div>

            <div class="input-group">
              <span class="input-icon">
                <img src="<?= base_url('assets/images/social-icons/form-icons/phone-icon.png') ?>" alt="phonenumber" />
              </span>
              <input type="text" name="phone_number" placeholder="Phone Number" />
            </div>

            <div class="input-group">
              <span class="input-icon">
                <img src="<?= base_url('assets/images/social-icons/form-icons/lock-icon.png') ?>" alt="password" />
              </span>
              <input type="password" name="password" placeholder="Password" />
            </div>

            <div class="input-group">
              <span class="input-icon">
                <img src="<?= base_url('assets/images/social-icons/form-icons/lock-icon.png') ?>" alt="confirm-password" />
              </span>
              <input type="password" name="confirm_password" placeholder="Confirm Password" />
            </div>

            <button type="submit" class="main-btn">Sign Up</button>
          </form>

          <div class="login-link">
            <p>Already Have an Account? <a href="<?= base_url('login')?>">Login</a></p>
          </div>

          <div class="social-login">
            <div class="or-separator">
              <span>Or sign up with</span>
            </div>

            <div class="social-buttons">
              <button class="facebook"> <img src="<?= base_url('assets/images/social-icons/facebook-icon.png') ?>" alt="Facebook" /></button>
              <button class="google"><img src="<?= base_url('assets/images/social-icons/google-icon.png') ?>" alt="Google" /></button>
              <button class="apple"><img src="<?= base_url('assets/images/social-icons/apple-icon.png') ?>" alt="Apple" /></button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</body>

</html>