<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Applicant Summary | JobSeekr</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css"
      />
      <link rel="stylesheet" href="/css/app.css" />
      <script
      defer
      src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"
      ></script>
    </head>
    <body>
      <nav
        class="white-background custom-nav"
        role="navigation"
        aria-label="main navigation"
        >
        <div class="columns">
          <div class="column is-4 navbar-left">
            <div class="navbar-brand">
              <a class="navbar-item" href="https://bulma.io">
                <img
                src="https://bulma.io/images/bulma-logo.png"
                width="112"
                height="28"
                />
              </a>
              <a
                role="button"
                class="navbar-burger burger"
                aria-label="menu"
                aria-expanded="false"
                data-target="navbarBasicExample"
                >
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
              </a>
            </div>
          </div>
          <div class="column is-5 navbar-center">
          </div>
          <div class="column is-2">
            <div class="navbar-item has-dropdown is-hoverable is-pulled-right">
              <a class="navbar-link jobseeker-name">
                {{Auth::user()->name}}
              </a>
              <div class="navbar-dropdown">
                <a class="navbar-item">
                  <span class="icon is-small is-left">
                    <i class="fas fa-user-cog"></i>
                  </span>
                  &nbsp&nbsp Profile
                </a>
                <a class="navbar-item">
                  <span class="icon is-small is-left">
                    <i class="fas fa-bug"></i>
                  </span>
                  &nbsp&nbsp Report an issue
                </a>
                <hr class="navbar-divider" />
                <a class="navbar-item" onClick="signout()">
                  <span class="icon is-small is-left">
                    <i class="fas fa-sign-out-alt"></i>
                  </span>
                  &nbsp&nbsp Signout
                </a>
              </div>
            </div>
            <div class="column is-1"></div>
          </div>
        </div>
      </nav>
      <div class="columns">
        <div class="column is-2 side-menu">
          <aside class="menu white-background">
            <ul class="menu-list">
              <li><a href="recruiter-dashboard.html" class="subtitle is-4">Job</a></li>
              <li><a href="/recruiter/job/new"class="subtitle is-4">Post Job</a></li>
            </ul>
          </aside>
        </div>
      </div>
      <div class="column is-10">
        <div class="columns">
          <div class="column is-4"></div>
          <div class="column is-8" id="applicants">
            <h1 class="title is-3 push-right-a-bit">Applicants</h1>
            <div class="column is-10">
              <div class="box" id="job-list">
                @foreach($applicants as $applicant)
                <article class="media" onclick="window.location ='/recruiter/application/{{$applicant->id}}'">
                  <figure class="media-left">
                    <p class="image is-64x64">
                      <img class="is-rounded" 
                      src="https://bulma.io/images/placeholders/128x128.png"
                      />
                    </p>
                  </figure>
                  <div class="media-content">
                    <div class="content">
                      <p>
                        <strong> {{$applicant->user->name}}</strong> <br />
                        {{$applicant->summary}}
                      </p>
                      <small class="is-pulled-right"
                      >Applied at {{$applicant->apply_date}}
                      </small>
                    </div>
                  </div>
                </article>
                @endforeach
              </div>
              
              <?php $obj = $applicants?>
              @include('pagination')

            </div>
            
          </div>
          
        </div>
        
      </div>
      
    </body>
  </html>