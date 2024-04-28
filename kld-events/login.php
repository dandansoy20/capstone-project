<section class="login-event">
    <div class="login_body" id="login">
      <div class="login_container" id="login_container">

        <div class="form-container sign-up-container">
          <form action="getaction.php" method="post">
            <h1>Create Account</h1>
            
            <input type="text" name="kld_no" placeholder="KLD Email" />
            <input type="text" name="kld_no" placeholder="KLD ID" />
            <button type="submit" name="create">Sign Up</button>
          </form>
        </div>
        <div class="form-container sign-in-container">
          <form action="getaction.php" method="post">
            <h1>Sign in</h1>
            <input type="text" name="username" required placeholder="Username" />
            <input type="password" name="password" required placeholder="Password" />

            <button type="submit" name="login">Sign In</button>
          </form>
        </div>
        <div class="overlay-container">
          <div class="overlay">
            <div class="overlay-panel overlay-left">
              <h1>Hello World!</h1>
              <p class="login-p">Enter your ID number and create your usename and password.</p>
              <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
              <h1>Welcome KLD peeps!</h1>
              <p class="login-p">To get started, please log in your account.</p>

              <button class="ghost" href="" id="signUp">Sign Up</button>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
