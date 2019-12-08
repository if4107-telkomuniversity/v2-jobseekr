<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | JobSeekr</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  </head>
  <body onload="callFunctions()">
    <nav class="white-background custom-nav" role="navigation" aria-label="main navigation">
      <div class="columns">
        <div class="column is-4 navbar-left">
          <div class="navbar-brand">
            <a class="navbar-item" href="https://bulma.io">
              <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
            </a>
            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
              data-target="navbarBasicExample">
              <span aria-hidden="true"></span>
              <span aria-hidden="true"></span>
              <span aria-hidden="true"></span>
            </a>
          </div>
        </div>
        <div class="column is-5 navbar-center">
          <div class="field has-addons">
          </div>
        </div>
        <div class="column is-2">
          <div class="navbar-item has-dropdown is-hoverable is-pulled-right">
            <a class="navbar-link jobseeker-name">
              {{Auth::user()->name}}
            </a>
            <div class="navbar-dropdown">
              <a class="navbar-item" href="jobseeker-profile.html">
                <span class="icon is-small is-left">
                  <i class="fas fa-user-cog"></i>
                </span>
                &nbsp&nbsp Profile
              </a>
              <a class="navbar-item" href="report-an-issue.html">
                <span class="icon is-small is-left">
                  <i class="fas fa-bug"></i>
                </span>
                &nbsp&nbsp Report an issue
              </a>
              <hr class="navbar-divider">
              <a class="navbar-item" href="/logout">
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
            <li><a href="recruiter-dashboard.html" class="subtitle is-4">Job</a></li>
            <li><a href="/recruiter/job/new" class="subtitle is-4">Post Job</a></li>
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
                      <a class="button is-info" onclick="recruiterJobSearch()">
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
            <div class="box" id="job-list">
              @foreach ($jobs as $job)
              <article class="media" onclick="window.location = '/recruiter/job/{{$job->id}}'">
                <figure class="media-left">
                  <p class="image is-64x64">
                    <img src="https://bulma.io/images/placeholders/128x128.png">
                  </p>
                </figure>
                <div class="media-content">
                  <div class="content">
                    <p>
                      <strong> {{$job->position}} ({{$job->job_type}})</strong> <br />
                      {{$job->company->name}} <br />
                      {{$job->company->city}}, Indonesia | IDR. {{$job->salary}}<br />
                      <small class="is-pulled-right">Until {{$job->expire_date}} </small>
                    </p>
                  </div>
                </div>
              </article>
              @endforeach
            </div>

            <?php $obj = $jobs ?>
            @include('pagination')
            
            <!-- <div class="column is-10">
              <div class="columns">
                <div class="column is-4">
                </div>
                
                <nav class="pagination" role="navigation" aria-label="pagination">
                  <a class="pagination-previous  has-background-white has-text-black">Previous</a>
                  <a class="pagination-next  has-background-white has-text-black">Next page</a>
                  <ul class="pagination-list">
                    <li>
                      <a class="pagination-link  has-background-white has-text-black" aria-label="Goto page 1"
                      id="first-page">1</a>
                    </li>
                    <li>
                      <span class="pagination-ellipsis  has-background-white has-text-black">…</span>
                    </li>
                    <li>
                      <a class="pagination-link  has-background-white has-text-black" aria-label="Goto page 14">14</a>
                    </li>
                    <li>
                      <a class="pagination-link is-current" aria-label="Page 15" aria-current="page">15</a>
                    </li>
                    <li>
                      <a class="pagination-link  has-background-white has-text-black" aria-label="Goto page 16">16</a>
                    </li>
                    <li>
                      <span class="pagination-ellipsis  has-background-white has-text-black">…</span>
                    </li>
                    <li>
                      <a class="pagination-link  has-background-white has-text-black" aria-label="Goto page 30"
                      id="last-page">30</a>
                    </li>
                  </ul>
                </nav>
                <div class="column">
                </div>
              </div>
            </div> -->
          </body>
        </html>