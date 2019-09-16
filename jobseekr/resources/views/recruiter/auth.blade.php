<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recruiter Signin | JobSeekr</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <link rel="stylesheet" href="css/app.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  </head>
  <body>
  <section class="section">
    <div class="container">
      <div class="columns">
        <div class="column is-3">
        </div>
        <div class="column is-6">
          <div class="box has-text-centered">
            <div class="columns">
              <div class="column is-2">
              </div>
              <div class="column is-8">
                <figure class="image is-3by1">
                  <img src="https://bulma.io/images/placeholders/720x240.png"> <br/>
                </figure>
              </div>
              <div class="column is-2">
              </div>
            </div>
            <form action="/view?key=r/dashboard" method="POST"> <!-- CHANGE THIS -->
              <div class="box-title">
                <br/>
                <h4 class="subtitle is-4">Signin as recruiter</h4>
              </div><br/>
              <div class="columns">
                <div class="column is-2">
                </div>
                <div class="column is-8">
                  <div class="field">
                    <p class="control has-icons-left has-icons-right">
                      <input class="input" id="recruiter-signin-email-input" type="email" placeholder="Email" required>
                      <span class="icon is-small is-left">
                        <i class="fas fa-envelope"></i>
                      </span>
                    </p>
                  </div>
                  <div class="field">
                    <p class="control has-icons-left">
                      <input class="input" id="recruiter-signin-password-input" type="password" placeholder="Password" required>
                      <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                      </span>
                    </p>
                  </div>
                  <div class="field">
                    </div>
                    <p class="control">
                      {{csrf_field()}}
                      <input name="key" value="r/dashboard" hidden> <!-- CHANGE THIS -->
                      <input type="submit" class="button is-info is-fullwidth" name="btnSubmit" type="button" value="Signin">
                    </p>
                  </div>
                <div class="column is-2">
                </div>
              </div><br />
            </form>
            <form action="?key=r/dashboard" method="POST"> <!-- CHANGE THIS -->
              <div class="box-title">
                <br/>
                <h4 class="subtitle is-4">Signup as recruiter</h4>
              </div><br/>
              <div class="columns">
                <div class="column is-2">
                </div>
                <div class="column is-8">
                  <div class="field">
                    <p class="control has-icons-left has-icons-right">
                      <input id="recruiter-signup-name-input" class="input" type="text" placeholder="Name" name="name" required>
                      <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                      </span>
                    </p>
                  </div>
                  <div class="field">
                    <p class="control has-icons-left has-icons-right">
                      <input id="recruiter-signup-email-input" class="input" type="email" placeholder="Email" name="email" required>
                      <span class="icon is-small is-left">
                        <i class="fas fa-envelope"></i>
                      </span>
                    </p>
                  </div>
                  <div class="field">
                    <p class="control has-icons-left">
                      <input id="recruiter-signup-password-input" class="input" type="password" placeholder="Password" name="password" required>
                      <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                      </span>
                    </p>
                  </div>
                  <div class="field">
                    <p class="control has-icons-left">
                      <input id="recruiter-signup-password-confirm-input" class="input" type="password" placeholder="Repeat password" name="password_confirmation" required>
                      <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                      </span>
                    </p>
                  </div>
                  <div class="field">
                    <div class="control">
                      <label class="checkbox">
                        <input type="checkbox" required>
                        I have read and accept <a href="#">terms and conditions</a>
                      </label>
                    </div>
                  </div>
                  <div class="field">
                    <p class="control">
                      {{csrf_field()}}
                      <input name="key" value="?key=r/dashboard" hidden> <!-- CHANGE THIS -->
                      <input id="jobseeker-signup-btn" class="button is-info is-fullwidth" name="btnSubmit" type="submit" value="Signup">
                    </p>
                  </div>
                </div>
                <div class="column is-2">
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="column is-3">
        </div>
      </div>
    </div>
  </section>
  </body>
  <script defer src="js/auth.js"></script>
</html>