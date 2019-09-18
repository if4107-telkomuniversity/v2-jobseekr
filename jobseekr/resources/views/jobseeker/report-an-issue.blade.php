<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report an Issue | JobSeekr</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <link rel="stylesheet" href="css/app.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  </head>
  <body>
    <nav class="white-background custom-nav" role="navigation" aria-label="main navigation">
      <div class="columns">
        <div class="column is-4 navbar-left">
          <div class="navbar-brand">
            <a class="navbar-item" href="?key=j/dashboard">
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
            <a class="navbar-link">
              {Username}
            </a>

            <div class="navbar-dropdown">
              <a class="navbar-item" href="?key=j/profile">
                <span class="icon is-small is-left">
                  <i class="fas fa-user-cog"></i>
                </span>
                &nbsp&nbsp Profile
              </a>
              <a class="navbar-item" href="?key=j/report-issue">
                <span class="icon is-small is-left">
                  <i class="fas fa-bug"></i>
                </span>
                &nbsp&nbsp  Report an Issue
              </a>
              <hr class="navbar-divider">
              <a class="navbar-item">
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
              <li><a href="?key=j/dashboard" class="subtitle is-4">Jobs</a></li>
              <li><a class="subtitle is-4">Applications</a></li>
              <li><a class="subtitle is-4">My Documents</a></li>
            </ul>
          </aside>
      </div>
      <div class="column is-10">
        <div class="columns">
          <div class="column is-4">
          </div>
          <div class="column is-8 jobs-content">
            <div class="box has-text-centered single-container">
              <h4 class="subtitle has-text-weight-semibold is-4"></h4>
              <div class="is-flex is-horizontal-center">
                <figure class="image is-128x128 rounded light-grey-background push-inside">
                  <img class="is-rounded" src="images/bug.png">
                </figure>
              </div>
              <br/>
              <span class="subtitle is-5">Hopefully it's an open source project, so</span><br/>
              <span class="subtitle is-5">feel free to report by hitting the button below.</span><br/>
              <span class="subtitle is-5">Any feedback will make JobSeekr better</span><br/>
              <br/>
              <a onclick="submitIssue()" class="button is-info" target="_blank">&nbsp&nbspGot it!&nbsp&nbsp</a>
            </div>
          </div>
          <div class="column">
          </div>
        </div>
      </div>
  </body>
  <script>
    const submitIssue = () => {
      window.open('https://github.com/vayupranaditya/JobSeekr/issues/new', '_blank');
      window.location='?key=j/dashboard';
    }
  </script>
</html>