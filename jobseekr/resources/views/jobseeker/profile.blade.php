<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile | JobSeekr</title>
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
            <a class="navbar-link jobseeker-name">
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
              <li><a href="?key=j/dashboard" class="subtitle is-4">Jobs</a></li>
              <li><a class="subtitle is-4">Applications</a></li>
              <li><a class="subtitle is-4">My Documents</a></li>
            </ul>
          </aside>
        </div>
      </div>
      <div class="column is-10">
        <div class="columns">
          <div class="column is-4">
          </div>
          <div class="column is-8 jobs-content">
            <div class="box">
              <div class="columns">
                <div class="column is-1">
                </div>
                <div class="column is-2">
                  <figure class="image is-128x128">
                    <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
                  </figure>
                </div>
                <div class="column is-8">
                  <span class="title is-4 jobseeker-name">{Name}</span><br/>
                  <br/>
                  <form action="#" method="POST">
                    <div class="columns">
                      <div class="column is-10">
                        <div class="field">
                          <p class="control has-icons-left has-icons-right">
                            <input class="input" type="text" placeholder="Address">
                            <span class="icon is-small is-left">
                              <i class="fas fa-map-marker-alt"></i>
                            </span>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="columns low-top-margin">
                      <div class="column is-10">
                        <div class="field">
                          <p class="control has-icons-left has-icons-right">
                            <input class="input" type="text" placeholder="Phone number">
                            <span class="icon is-small is-left">
                              <i class="fas fa-phone"></i>
                            </span>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="columns low-top-margin">
                      <div class="column">
                        <button class="button is-info">&nbsp&nbspEdit&nbsp&nbsp</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="column is-1">
                </div>
              </div>
            </div>
            <div class="box">
              <div class="columns">
                <div class="column is-3">
                  <span class="subtitle is-4">Accout</span>
                </div>
                <div class="column is-8">
                  <form action="#" method="POST">
                    <div class="columns">
                      <div class="column is-10">
                        <div class="field">
                          <p class="control has-icons-left has-icons-right is-expanded">
                            <input class="input" type="email" placeholder="Email">
                            <span class="icon is-small is-left">
                              <i class="fas fa-at"></i>
                            </span>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="columns low-top-margin">
                      <div class="column is-10">
                        <div class="field">
                          <p class="control has-icons-left has-icons-right">
                            <input class="input" type="password" placeholder="Password">
                            <span class="icon is-small is-left">
                              <i class="fas fa-unlock-alt"></i>
                            </span>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="columns low-top-margin">
                      <div class="column is-10">
                        <div class="field">
                          <p class="control has-icons-left has-icons-right">
                            <input class="input" type="password" placeholder="Repeat password">
                            <span class="icon is-small is-left">
                              <i class="fas fa-unlock-alt"></i>
                            </span>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="columns low-top-margin">
                      <div class="column">
                        <button class="button is-info">&nbsp&nbspEdit&nbsp&nbsp</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="column is-1">
                </div>
              </div>
            </div>
            <div class="box">
              <div class="columns">
                <div class="column is-3">
                  <span class="subtitle is-4">Work Experience</span>
                </div>
                <div class="column is-8">
                  <div class="box work-experience">
                    <div class="columns">
                      <div class="column is-3">
                        <figure class="image is-96x96">
                          <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
                        </figure>
                      </div>
                      <div class="column is-8">
                        <span class="subtitle is-5">Backend Engineer</span><br/>
                        <span class="subtitle is-5">Proofn Indonesia</span><br/>
                        <span class="subtitle is-5">1 years 3 month</span><br/>
                      </div>
                      <div class="column is-1">
                      </div>
                    </div>
                  </div>
                  <div class="box work-experience">
                    <div class="columns">
                      <div class="column is-3">
                        <figure class="image is-96x96">
                          <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
                        </figure>
                      </div>
                      <div class="column is-8">
                        <span class="subtitle is-5">{work experience.position}</span><br/>
                        <span class="subtitle is-5">{work experience.company}</span><br/>
                        <span class="subtitle is-5">{work experience.duration}</span><br/>
                      </div>
                      <div class="column is-1">
                      </div>
                    </div>
                  </div>
                  <button class="button is-info">&nbsp&nbspEdit&nbsp&nbsp</button>
                </div>
                <div class="column is-1">
                </div>
              </div>
            </div>
            <div class="box">
              <div class="columns">
                <div class="column is-3">
                  <span class="subtitle is-4">Document</span>
                </div>
                <div class="column is-7">
                  <span class="subtitle is-5">{Document.cv.name}</span><br/>
                </div>
                <div class="column is-1">
                  <button class="button is-info">&nbsp&nbspEdit&nbsp&nbsp</button>
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
  <script>
    function callFunctions() {
      checkAuth();
      formatForUser();
    }
  </script>
</html>