<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Application | JobSeekr</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <!-- <script defer src="js/job.js"></script>
    <script defer src="js/auth.js"></script> -->
    <script>
    var jsonData = [
    @foreach ($application->experiences as $experience)
    {
    "id" : "{{$experience->object['id']}}",
    "position" : "{{$experience->object['position']}}",
    "company" : "{{$experience->object['company_name']}}",
    "duration" : "{{$experience->object['duration']}}",
    "pic" : "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973461_960_720.png"
    },
    @endforeach
    ];
    </script>
  </head>
  <body>
    <nav class="white-background custom-nav" role="navigation" aria-label="main navigation">
      <div class="columns">
        <div class="column is-4 navbar-left">
          <div class="navbar-brand">
            <a class="navbar-item" href="https://bulma.io">
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
              {{Auth::user()->name}}
            </a>
            <div class="navbar-dropdown">
              <a class="navbar-item" href="jobseeker-profile.html">
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
            <li><a href="/recruiter/job/new"class="subtitle is-4">Post Job</a></li>
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
              <div class="column is-3">
                <div class="subtitle is-4">About Them</div>
              </div>
              <div class="column is-2">
                <figure class="image is-128x128">
                  <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
                  <!-- {pic url} -->
                </figure>
              </div>
              <div class="column is-6">
                <span class="title is-4 application-name">{{$application->user->name}}</span><br/>
                <span class="subtitle is-5 application-summary">{{$applicant->address}}</span><br/>
                <span class="subtitle is-5 application-summary">{{$application->user->email}}</span><br/>
                <span class="subtitle is-5 application-summary">{{$application->user->phone}}</span><br/>
              </div>
              <div class="colums is-1"></div>
            </div>
          </div>
          <div class="box">
            <div class="columns">
              <div class="column is-3">
                <span class="subtitle is-4">Summary</span>
              </div>
              <div class="column is-8">
                {{$application->summary}}
              </div>
              <div class="column is-1"></div>
            </div>
          </div>
          <div class="box">
            <div class="columns">
              <div class="column is-3">
                <span class="subtitle is-4">Work Experience</span>
              </div>
              <div class="column is-8" id="list-work">
                <script>
                var i = "";
                for (i in jsonData) {
                document.querySelector('#list-work').innerHTML +=
                `<div class="box work-experience">
                  <div class="columns">
                    <div class="column is-3">
                      <figure class="image is-96x96">
                        <img class="is-rounded" src="`+jsonData[i].pic+`">
                      </figure>
                    </div>
                    <div class="column is-8">
                      <span class="subtitle is-5 position">`+ jsonData[i].position + `</span><br />
                      <span class="subtitle is-5 company">`+ jsonData[i].company + `</span><br />
                      <span class="subtitle is-5 duration">`+ jsonData[i].duration + `</span><br />
                    </div>
                    <div class="column is-1">
                    </div>
                  </div>
                </div>`;
                }
                </script>
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
                <div class="has-text-primary">
                  <a class="subtitle is-5 has-text-info" href="/storage/docs/cv/{{$application->cv->file_name}}" target="_blank">CV</a><br/>
                </div>
                <div>
                  <a class="subtitle is-5 has-text-info" href="/storage/docs/resume/{{$application->resume->file_name}}" target="_blank">Resume</a><br/>
                </div>
              </div>
              <div class="column is-1">
              </div>
            </div>
          </div>
          <div class="columns">
            <div class="column is-1">
            </div>
            <div class="column is-5">
              <form action="/recruiter/application/confirm" method="POST">
                <input type="hidden" name="is_accepted" value="1">
                <input type="hidden" name="job_application_id" value="{{$application->id}}">
                {{csrf_field()}}
                <input type="submit" class="button is-primary is-fullwidth is-medium" value="Accept">
              </form>
            </div>
            <div class="column is-5">
              <form action="/recruiter/application/confirm" method="POST">
                <input type="hidden" name="is_accepted" value="0">
                <input type="hidden" name="job_application_id" value="{{$application->id}}">
                {{csrf_field()}}
                <input type="submit" class="button is-danger is-fullwidth is-medium" value="Decline">
              </form>
            </div>
            <div class="column is-1">
            </div>
          </div>
        </div>
        <div class="column">
        </div>
      </div>
    </div>
  </body>
</html>