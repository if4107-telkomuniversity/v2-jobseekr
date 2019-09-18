<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | JobSeekr</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <link rel="stylesheet" href="css/app.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script defer src="js/job.js"></script>
    <script defer src="js/auth.js"></script>
  </head>
  <body onload="callFunctions()">
    <nav class="navbar" role="navigation" aria-label="main navigation">
      <div class="container">
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

        <div id="navbarBasicExample" class="navbar-menu">
          <div class="navbar-start">
          </div>

          <div class="navbar-end">
            <div class="navbar-item has-dropdown is-hoverable">
              <a class="navbar-link jobseeker-name">
                {name}
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
            <div class="box">
              <div class="columns">
                <div class="column">
                  <div class="field has-addons">
                    <div class="control is-expanded">
                      <input id="job-search-input" class="input" type="text" placeholder="Search jobs">
                    </div>
                    <div class="control">
                      <a class="button is-info" onclick="jobSearch()">
                        Search
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="columns">
                <div class="column is-2">
                  <div class="field">
                    <div class="control">
                      <div class="select is-small">
                        <select>
                          <option>Location</option>
                          <option>loc1</option>
                          <option>loc2</option>
                          <option>Lorem ipsum dolor sit amet</option>
                          <option>etc.</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="column is-2">
                  <div class="field">
                    <div class="control">
                      <div class="select is-small">
                        <select>
                          <option class="dropdown-menu">Education</option>
                          <option>Under secondary</option>
                          <option>Secondary</option>
                          <option>Primary</option>
                          <option>Undergraduate</option>
                          <option>Graduate</option>
                          <option>Doctorate</option>
                          <option>Lorem ipsum dolor sit amet</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="column is-2">
                  <div class="field">
                    <div class="control">
                      <div class="select is-small">
                        <select>
                          <option>Category</option>
                          <option>cat1</option>
                          <option>cat2</option>
                          <option>etc.</option>
                          <option>Lorem ipsum dolor sit amet</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="column is-2">
                  <div class="field">
                    <div class="control">
                      <div class="select is-small">
                        <select>
                          <option>Salary</option>
                          <option>Under 5 M.</option>
                          <option>From 1 M.</option>
                          <option>From 5 M.</option>
                          <option>From 10 M.</option>
                          <option>Lorem ipsum dolor sit amet</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="columns">
              <div class="column is-8">
                <h6 class="subtitle is-6">1 - 5 of 10000 jobs found</h6>
              </div>
              <div class="column is-4">
                <div class="control is-pulled-right">
                  <div class="select">
                    <select>
                      <option selected>Sort by name: A - Z</option>
                      <option>Sort by name: Z - A</option>
                      <option>Sort by location: A - Z</option>
                      <option>Sort by location: Z - A</option>
                      <option>Sort by category: A - Z</option>
                      <option>Sort by category: Z - A</option>
                      <option>Sort by education: lowest to highest</option>
                      <option>Sort by salary: lowest to highest</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="box" id="job-list">
              <article class="media" onclick="window.location='?key=j/job'">
                <figure class="media-left">
                  <p class="image is-64x64">
                    <img src="https://bulma.io/images/placeholders/128x128.png">
                  </p>
                </figure>
                <div class="media-content">
                  <div class="content">
                    <p>
                      <strong>position (employment type)</strong> <br />
                      company name<br />
                      city, Indonesia | IDR. min_salary-max_salary<br />
                      <small class="is-pulled-right">Until expire_date</small>
                    </p>
                  </div>
                </div>
              </article>
              <article class="media" onclick="window.location='?key=j/job'">
                <figure class="media-left">
                  <p class="image is-64x64">
                    <img src="https://bulma.io/images/placeholders/128x128.png">
                  </p>
                </figure>
                <div class="media-content">
                  <div class="content">
                    <p>
                      <strong>Web Developer (Internship)</strong> <br />
                      Garena Indonesia<br />
                      Jakarta, Indonesia | IDR. 4,000,000 - 4,000,000<br />
                      <small class="is-pulled-right">Until 20 May 2020</small>
                    </p>
                  </div>
                </div>
              </article>
              <article class="media" onclick="window.location='?key=j/job'">
                <figure class="media-left">
                  <p class="image is-64x64">
                    <img src="https://bulma.io/images/placeholders/128x128.png">
                  </p>
                </figure>
                <div class="media-content">
                  <div class="content">
                    <p>
                      <strong>Associate Web Developer (Full time)</strong> <br />
                      Garena Indonesia<br />
                      Jakarta, Indonesia | IDR. 7,500,000 - 8,500,000<br />
                      <small class="is-pulled-right">Until 20 May 2020</small>
                    </p>
                  </div>
                </div>
              </article>
            </div>
          </div>
          <div class="column">
          </div>
        </div>
      </div>
  </body>
  <script>
    function callFunctions() {
      loadJobs();
      checkAuth();
      formatForUser();
    }
  </script>
</html>