<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Applicant Summary | JobSeekr</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <link rel="stylesheet" href="css/app.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script defer src="js/job.js"></script>
    <script defer src="js/auth.js"></script>
  </head>
  <body onload="callFunctions()">
    <nav class="white-background custom-nav" role="navigation" aria-label="main navigation">
      <div class="columns">
        <div class="column is-4 navbar-left">
          <div class="navbar-brand">
            <a class="navbar-item" href="?key=r/dashboard">
              <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
            </a>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
              <span aria-hidden="true"></span>
              <span aria-hidden="true"></span>
              <span aria-hidden="true"></span>
            </a>
          </div>
        </div>
        <div class="column is-5 navbar-center">
          <div class="field has-addons">
            <div class="control is-expanded">
              <input class="input" type="text" placeholder="Search jobs">
            </div>
            <div class="control">
              <a class="button is-info">
                Search
              </a>
            </div>
          </div>
        </div>
        <div class="column is-2">
          <div class="navbar-item has-dropdown is-hoverable is-pulled-right">
            <a class="navbar-link jobseeker-name">
              {Username}
            </a>
            <div class="navbar-dropdown">
              <a class="navbar-item">
                <span class="icon is-small is-left">
                  <i class="fas fa-user-cog"></i>
                </span>
                &nbsp&nbsp Profile
              </a>
              <a class="navbar-item" onclick="window.location='?key=r/report-issue'">
                <span class="icon is-small is-left">
                  <i class="fas fa-bug"></i>
                </span>
                &nbsp&nbsp  Report an Issue
              </a>
              <hr class="navbar-divider">
              <a class="navbar-item" onClick="window.location='/view'">
                <span class="icon is-small is-left">
                  <i class="fas fa-sign-out-alt"></i>
                </span>
                &nbsp&nbsp Signout
              </a>
            </div>
          </div>
          <div class="column is-1">
          </div>
        </div>
      </div>
    </nav>
    <div class="columns">
        <div class="column is-2 side-menu">
          <aside class="menu white-background">
            <ul class="menu-list">
              <li><a href="?key=r/dashboard" class="subtitle is-4">Jobs</a></li>
              <li><a class="subtitle is-4">Post Job</a></li>
            </ul>
          </aside>
        </div>
      </div>
      <div class="column is-10">
        <div class="columns">
          <div class="column is-4">
          </div>
          <div class="column is-8" id="applicants">
            <div class="box">
              <div class="columns">
                <div class="column is-1">
                </div>
                <div class="column is-2">
                  <figure class="image is-128x128">
                    <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
                  </figure>
                </div>
                <div class="column is-8" onclick="window.location='?key=r/application-detail'">
                  <span class="title is-4 jobseeker-name">Applicant name</span><br/>
                  <div class="columns">
                    <div class="column is-10">
                      <span class="subtitle is-5">Application Summary</span>
                    </div>
                  </div>
                </div>
                <div class="column is-1">
                </div>
              </div>
            </div>
            <div class="box">
              <div class="columns">
                <div class="column is-1">
                </div>
                <div class="column is-2">
                  <figure class="image is-128x128">
                    <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
                  </figure>
                </div>
                <div class="column is-8" onclick="window.location='?key=r/application-detail'">
                  <span class="title is-4 jobseeker-name">I Gusti Bagus Vayupranaditya Putraadinatha</span><br/>
                  <div class="columns">
                    <div class="column is-10">
                      <span class="subtitle is-5">nO sYsTeM iS sAfE EAAAAAAAA nO sYsTeM iS sAfE EAAAAAAAA nO sYsTeM iS sAfE EAAAAAAAA nO sYsTeM iS sAfE EAAAAAAAA nO sYsTeM iS sAfE EAAAAAAAA nO sYsTeM iS sAfE EAAAAAAAA nO sYsTeM iS sAfE EAAAAAAAA</span>
                    </div>
                  </div>
                </div>
                <div class="column is-1">
                </div>
              </div>
            </div>
          </div>
          <div class="column">
          </div>
        </div>
      </div>
  </body>
</html>