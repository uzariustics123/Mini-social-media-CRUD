<?php
 include_once('includes/header.php');
 
 if(isset($_POST['userid'])){
header('location: main.php');
 }else{

 }
?>
    <section class="forms-section">
        <h2 class="section-title">BlueGenMedia</h2>
        <dotlottie-player src='anims/manageAnim.json' background='transparent' speed='1' style='width: 300px; height: 200px;' loop autoplay></dotlottie-player></dotlottie-player>
        <div class="forms">
          <div class="form-wrapper is-active">
            <button type="button" class="switcher switcher-login">
              Login
              <span class="underline"></span>
            </button>
            <form class="form form-login">
              <fieldset>
                <legend>Please, enter your email and password for login.</legend>
                <div class="input-block">
                  <label for="login-email">E-mail</label>
                  <input id="login-email" type="email" required>
                </div>
                <div class="input-block">
                  <label for="login-password">Password</label>
                  <input id="login-password" type="password" required>
                </div>
              </fieldset>
              <button type="submit" class="btn-login">Login</button>
            </form>
          </div>
          <div class="form-wrapper">
            <button type="button" class="switcher switcher-signup">
              Sign Up
              <span class="underline"></span>
            </button>
            <form class="form form-signup">
              <fieldset>
                <legend>Please, enter your email, password and password confirmation for sign up.</legend>
                <div class="input-block">
                  <label for="signup-email">E-mail</label>
                  <input id="signup-email" type="email" required>
                </div>
                <div class="input-block">
                  <label for="signup-firstname">First name</label>
                  <input id="signup-firstname" type="text" required>
                </div>
                <div class="input-block">
                  <label for="signup-lastname">Last name</label>
                  <input id="signup-lastname" type="text" required>
                </div>
                <div class="input-block">
                  <label for="signup-password">Password</label>
                  <input id="signup-password" type="password" required>
                </div>
                <div class="input-block">
                  <label for="signup-password-confirm">Confirm password</label>
                  <input id="signup-password-confirm" type="password" required>
                </div>
              </fieldset>
              <button type="submit" class="btn-signup">Continue</button>
            </form>
          </div>
        </div>
      </section>
<script> 
    const switchers = [...document.querySelectorAll('.switcher')]

    switchers.forEach(item => {
        item.addEventListener('click', function() {
            switchers.forEach(item => item.parentElement.classList.remove('is-active'))
            this.parentElement.classList.add('is-active')
        })
    })
    
</script>
<?php
include_once('includes/footer.php');
?>
<script src="js/handleRegLogin.js">
  
  </script>