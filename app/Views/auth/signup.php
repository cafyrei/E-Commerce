<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="<?= base_url('assets/css/user-signup.css') ?>">
  <title>Sign Up | Wood & Quality</title>

  <style>
    .field-wrapper {
      margin-bottom: 15px;
    }

    .input-group {
      position: relative;
      margin-bottom: 0px !important;
    }

    .error-msg {
      color: #ee3d37;
      font-size: 11px;
      font-weight: 600;
      margin-top: 4px;
      margin-left: 15px;
      display: block;
      animation: shake 0.2s ease-in-out 0s 2;
      line-height: 1.2;
    }

    .input-group.has-error input {
      border: 1px solid #ee3d37;
      background-color: #fff5f5;
    }
  </style>
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
                <div class="field-wrapper">
                  <div class="input-group <?= isset($validation) && $validation->hasError('first_name') ? 'has-error' : '' ?>">
                    <span class="input-icon"><img src="<?= base_url('assets/images/social-icons/form-icons/user-icon.png') ?>" alt="user" /></span>
                    <input type="text" name="first_name" placeholder="First Name" value="<?= old('first_name') ?>" />
                  </div>
                  <?php if (isset($validation) && $validation->hasError('first_name')): ?>
                    <span class="error-msg"><?= str_replace('The first_name field is required.', 'First Name is required', $validation->getError('first_name')) ?></span>
                  <?php endif; ?>
                </div>

                <div class="field-wrapper">
                  <div class="input-group">
                    <span class="input-icon"><img src="<?= base_url('assets/images/social-icons/form-icons/user-icon.png') ?>" alt="user" /></span>
                    <input type="text" name="middle_name" placeholder="Middle Name" value="<?= old('middle_name') ?>" />
                  </div>
                </div>
              </div>

              <div class="name-division">
                <div class="field-wrapper">
                  <div class="input-group <?= isset($validation) && $validation->hasError('last_name') ? 'has-error' : '' ?>">
                    <span class="input-icon"><img src="<?= base_url('assets/images/social-icons/form-icons/user-icon.png') ?>" alt="user" /></span>
                    <input type="text" name="last_name" placeholder="Last Name" value="<?= old('last_name') ?>" />
                  </div>
                  <?php if (isset($validation) && $validation->hasError('last_name')): ?>
                    <span class="error-msg"><?= str_replace('The last_name field is required.', 'Last Name is required', $validation->getError('last_name')) ?></span>
                  <?php endif; ?>
                </div>

                <div class="input-group">
                  <select name="suffix">
                    <option value="">None</option>
                    <option value="Jr" <?= old('suffix') == 'Jr' ? 'selected' : '' ?>>Jr.</option>
                    <option value="Sr" <?= old('suffix') == 'Sr' ? 'selected' : '' ?>>Sr.</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="field-wrapper">
              <div class="input-group <?= isset($validation) && $validation->hasError('email') ? 'has-error' : '' ?>">
                <span class="input-icon"><img src="<?= base_url('assets/images/social-icons/form-icons/email-icon.png') ?>" alt="email" /></span>
                <input type="email" name="email" placeholder="Email Address" value="<?= old('email') ?>" />
              </div>
              <?php if (isset($validation) && $validation->hasError('email')): ?>
                <span class="error-msg"><?= str_replace('The email field is required.', 'Email is required', $validation->getError('email')) ?></span>
              <?php endif; ?>
            </div>

            <div class="field-wrapper">
              <div class="input-group <?= isset($validation) && $validation->hasError('password') ? 'has-error' : '' ?>">
                <span class="input-icon"><img src="<?= base_url('assets/images/social-icons/form-icons/lock-icon.png') ?>" alt="password" /></span>
                <input type="password" name="password" placeholder="Password" />
              </div>
              <?php if (isset($validation) && $validation->hasError('password')): ?>
                <span class="error-msg"><?= $validation->getError('password') ?></span>
              <?php endif; ?>
            </div>

            <div class="field-wrapper">
              <div class="input-group <?= isset($validation) && $validation->hasError('confirm_password') ? 'has-error' : '' ?>">
                <span class="input-icon"><img src="<?= base_url('assets/images/social-icons/form-icons/lock-icon.png') ?>" alt="confirm-password" /></span>
                <input type="password" name="confirm_password" placeholder="Confirm Password" />
              </div>
              <?php if (isset($validation) && $validation->hasError('confirm_password')): ?>
                <span class="error-msg">
                  <?= $validation->getError('confirm_password') ?>
                </span>
              <?php endif; ?>
            </div>

            <button type="submit" class="main-btn">Sign Up</button>
          </form>

          <div class="login-link">
            <p>Already Have an Account? <a href="<?= base_url('login') ?>">Login</a></p>
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