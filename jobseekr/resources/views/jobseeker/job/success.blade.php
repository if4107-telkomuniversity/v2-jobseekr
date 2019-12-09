<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Apply Done! | JobSeekr</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
  <link rel="stylesheet" href="/css/app.css">
  <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  <script defer src="js/job.js"></script>
  <script defer src="js/auth.js"></script>
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
            <a class="navbar-item" href="/profile">
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
            <a class="navbar-item" onClick="signout()">
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
          <li><a href="/dashboard" class="subtitle is-4">Jobs</a></li>
          <li><a class="subtitle is-4">Applications</a></li>
        </ul>
      </aside>
    </div>
    <div class="column is-10">
      <div class="columns">
        <div class="column is-4">
        </div>
        <div class="column is-8 jobs-content">
          <div class="box has-text-centered single-container">
            <h4 class="subtitle has-text-weight-semibold is-4">Your application has been sent!</h4>
            <div class="is-flex is-horizontal-center">
              <figure class="image is-128x128">
                <img class="is-rounded" src="/images/checkbox-green.png">
              </figure>
            </div>
            <br />
            <span class="subtitle is-5">Your application has been sent to</span><br />
            <span class="subtitle is-5 company-name">{{$company_name}}</span>
            <span class="subtitle is-5">. Give them some time to</span><br />
            <span class="subtitle is-5">review your application. You will notified soon!</span><br />
            <br />
            <a href="/dashboard" class="button is-info">&nbsp&nbspGot it!&nbsp&nbsp</a>
          </div>
        </div>
        <div class="column">
        </div>
      </div>
    </div>
</body>
<script>
  function checkAuth() {
    // if (sessionStorage.getItem('email')) {
    // 	//do something
    // } else {
    // 	window.location = 'index.html';
    // }
  }

  function formatForUser() {
    var user = loadJobseeker(sessionStorage.getItem('email'));
    var jobseekerName = document.getElementsByClassName('jobseeker-name');
    for (i = 0; i < jobseekerName.length; i++) {
      jobseekerName[i].innerHTML = user.name;
      jobseekerName[i].value = user.name;
    }
    var jobseekerAddress = document.getElementsByClassName('jobseeker-address');
    for (i = 0; i < jobseekerAddress.length; i++) {
      jobseekerAddress[i].innerHTML = user.address;
      jobseekerAddress[i].value = user.address;
    }
    var jobseekerEmail = document.getElementsByClassName('jobseeker-email');
    for (i = 0; i < jobseekerEmail.length; i++) {
      jobseekerEmail[i].innerHTML = user.email;
      jobseekerEmail[i].value = user.email;
    }
    var jobseekerPhoneNumber = document.getElementsByClassName('jobseeker-phone-number');
    for (i = 0; i < jobseekerPhoneNumber.length; i++) {
      jobseekerPhoneNumber[i].innerHTML = user.phoneNumber;
      jobseekerPhoneNumber[i].value = user.phoneNumber;
    }
    var jobseekerSummary = document.getElementsByClassName('jobseeker-summary');
    for (i = 0; i < jobseekerSummary.length; i++) {
      jobseekerSummary[i].innerHTML = user.summary;
      jobseekerSummary[i].value = user.summary;
    }
  }

  function signout() {
    sessionStorage.clear();
    window.location = 'index.html';
  }

  function formatCompany() {
    var job = loadJob(sessionStorage.getItem('jobId'));
    console.log(job.company_id);
    var company = loadCompany(job.company_id);
    var companyName = document.getElementsByClassName('company-name');
    for (i = 0; i < companyName.length; i++) {
      companyName[i].innerHTML = company.name;
      companyName[i].value = company.name;
    }
    var companyAddress = document.getElementsByClassName('company-address');
    for (i = 0; i < companyAddress.length; i++) {
      companyAddress[i].innerHTML = company.address;
      companyAddress[i].value = company.address;
    }
    var companyCity = document.getElementsByClassName('company-city');
    for (i = 0; i < companyCity.length; i++) {
      companyCity[i].innerHTML = company.city;
      companyCity[i].value = company.city;
    }
  }

  function callFunctions() {
    checkAuth();
    formatForUser();
    formatCompany();
  }
</script>

</html>