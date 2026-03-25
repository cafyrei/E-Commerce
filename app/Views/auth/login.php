<?php if (session()->getFlashdata('error')): ?>
  <div class="error">
    <?= session()->getFlashdata('error') ?>
  </div>
<?php endif; ?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="<?= base_url('/assets/css/user-login.css') ?>">

  <style>
    .field-wrapper {
      margin-bottom: 20px;
      width: 100%;
    }

    .field-wrapper .input-group {
      margin-bottom: 5px;
    }

    .error-msg {
      color: #ee3d37;
      font-size: 11px;
      font-weight: bold;
      margin-left: 15px;
      display: block;
      animation: shake 0.2s ease-in-out 0s 2;
    }

    .input-group.has-error input {
      border: 1.5px solid #ee3d37 !important;
      background-color: #fff9f9;
    }

    @keyframes shake {

      0%,
      100% {
        transform: translateX(0);
      }

      25% {
        transform: translateX(4px);
      }

      75% {
        transform: translateX(-4px);
      }
    }

  </style>
  <title>Login | Wood & Quality</title>
</head>

<body>
  <div class="wrapper">
    <div class="container">
      <!-- LEFT -->
      <div class="left">
        <div class="form-box">
          <h2>Login Account</h2>
          <h3>Welcome back! Please enter your details to access your account.</h3>

          <?php if (session()->getFlashdata('error')): ?>
            <div class="alert-box">
              <span class="alert-icon">!</span>
              <span class="alert-text"><?= session()->getFlashdata('error') ?></span>
            </div>
          <?php endif; ?>

          <form action="<?= site_url('login') ?>" method="post">

            <div class="field-wrapper">
              <div class="input-group <?= isset($validation) && $validation->hasError('email') ? 'has-error' : '' ?>">
                <span class="input-icon">
                  <img src="<?= base_url('assets/images/social-icons/form-icons/email-icon.png') ?>" alt="email" />
                </span>
                <input name="email" type="text" placeholder="Email Address" value="<?= old('email') ?>" required />
              </div>
              <?php if (isset($validation) && $validation->hasError('email')): ?>
                <span class="error-msg"><?= $validation->getError('email') ?></span>
              <?php endif; ?>
            </div>

            <div class="field-wrapper">
              <div class="input-group <?= isset($validation) && $validation->hasError('password') ? 'has-error' : '' ?>">
                <span class="input-icon">
                  <img src="<?= base_url('assets/images/social-icons/form-icons/lock-icon.png') ?>" alt="password" />
                </span>
                <input name="password" type="password" placeholder="Password" required />
              </div>
              <?php if (isset($validation) && $validation->hasError('password')): ?>
                <span class="error-msg"><?= $validation->getError('password') ?></span>
              <?php endif; ?>
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

            <button type="submit" class="main-btn">Login</button>
          </form>

          <div class="register-container">
            <p>Don't Have an Account?</p>
          </div>

          <div class="create-account">
            <button type="button" onclick="location.href='<?= base_url('signup') ?>'">Create Account</button>
          </div>

          <div class="social-login">
            <div class="or-separator">
              <span>Or sign in with</span>
            </div>

            <div class="social-buttons">
              <button class="facebook">
                <img src="<?= base_url('assets/images/social-icons/facebook-icon.png') ?>" alt="Facebook" />
              </button>
              <button class="google">
                <img src="<?= base_url('assets/images/social-icons/google-icon.png') ?>" alt="Google" />
              </button>
              <button class="apple">
                <img src="<?= base_url('assets/images/social-icons/apple-icon.png') ?>" alt="Apple" />
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
  </div>
</body>

</html>