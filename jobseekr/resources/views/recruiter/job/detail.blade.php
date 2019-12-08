<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Job Detail | JobSeekr</title>
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
    <div class="column is-10">
      <div class="columns">
        <div class="column is-4">
        </div>
        <div class="column is-8 jobs-content">
          <div class="box" id="detail-job">
            <i class="fas fa-trash" style="float:right" onclick="deleteJob()"></i>
            <br>
            <article class="media">
              <div class="media-content job-summary">
                <div class="columns">
                  <div class="column is-3">
                    <figure class="image company-img-in-job-detail">
                      <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
                    </figure>
                  </div>
                  <div class="column is-9">
                    <div class="content">
                      <div class="columns">
                        <div class="column is-7">
                          <span class="subtitle is-4 job-name">{{$job->position}}</span> <br />
                          <span class="subtitle is-5 company-name">{{$job->company->name}}</span> <br />
                          <span class="subtitle is-6 company-city">{{$job->company->city}}</span>
                          <span class="subtitle is-6"> | IDR </span>
                          <span class="subtitle is-6 job-salary">{{$job->salary}}</span>
                          <span class="subtitle is-6"> | </span>
                          <span class="subtitle is-6 job-employment">{{$job->job_type}}</span>
                        </div>
                        <div class="column is-5">
                          <div class="columns">
                            <div class="column has-text-right">
                              <small class="job-expire-date">Posted on {{$job->post_date}}, until
                                {{$job->expire_date}}</small> <br />
                            </div>
                          </div>
                          <div class="columns">
                            <div class="column">
                              <a class="button is-info is-large is-fullwidth" href="/recruiter/job/{{$job->id}}/applicants">See
                                Applicants</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </article>
            <article class="media">
              <div class="media-content">
                <div class="columns">
                  <div class="column is-3">
                  </div>
                  <div class="column is-9">
                    <div class="content">
                      <span class="subtitle is-5">Job Summary</span> <br />
                      <span class="subtitle is-6 job-summary-info">{{$job->summary}}</span> <br />
                      <br />
                      <span class="subtitle is-5">Minimum Qualification</span> <br />
                      <span class="subtitle is-6 job-minimum">{{$job->min_qualification}}</span> <br />
                      <br />
                      <span class="subtitle is-5">Category</span> <br />
                      <span class="subtitle is-6 category-name">{{$job->category->name}}</span> <br />
                      <br />
                      <span class="subtitle is-5">Industry</span> <br />
                      <span class="subtitle is-6 industry-name">{{$job->company->industry->name}}</span> <br />
                      <br />
                      <span class="subtitle is-5">Office Address</span> <br />
                      <span class="subtitle is-6 company-address">{{$job->company->address}}</span>
                      <span class="subtitle is-6">, </span>
                      <span class="subtitle is-6 company-city">{{$job->company->city}}</span> <br />
                      <br />

                    </div>
                  </div>
                </div>
                <button class="button is-info" id="job-edit-btn" style="float:right"
                  onclick="editJob()">&nbsp&nbspEdit&nbsp&nbsp</button>
              </div>

              <script>
                function editJob() {
                  document.querySelector('#detail-job').innerHTML =
                    `
                    <br>
                    <article class="media">
                      <div class="media-content job-summary">
                        <div class="columns">
                          <div class="column is-3">
                            <figure class="image company-img-in-job-detail">
                              <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
                            </figure>
                          </div>
                          <div class="column is-9">
                            <div class="content">
                              <div class="columns">
                                <div class="column is-7">
                                    <div class="field">
                                      <input class="input job-name" type="text" placeholder="Position">
                                    </div>
                                    <div class="field">
                                     <input class="input company-name" type="text" placeholder="Company Name" disabled><br>
                                    </div>
                                    <div class="field">
                                      <input class="input company-city" type="text" placeholder="City">
                                    </div>
                          
                                    <div class="field-body">
                                      <div class="field">
                                        <input class="input min-job-salary" type="text" placeholder="Min. Salary">
                                      </div>
                                      <div class="field has-text-centered">
                                          <p>to</p>
                                      </div>
                                      <div class="field">
                                        <input class="input max-job-salary" type="text" placeholder="Max. Salary">
                                      </div>
                                    </div>
                                    <div class="field">
                                      
                                    </div>
                                    <div class="field">
                                        
                                        
                                        
                                            <div class="select job-employment">
                                                <select id="type">
                                                    <option>Full-Time</option>
                                                    <option>Part-Time</option>
                                                    <option>Internship</option>
                                                </select>
                                            </div>
                                        
                                        
                                    </div>                                    
                                </div>
                                <div class="column is-5">
                                  <div class="columns">
                                    <div class="column has-text-right">
                                        <small>Before </small><small class="job-expire-date">Posted on {job.date_posted}, until
                                            <div class="field" style="width:20vh;float:right" >
                                
                                
                                    <input class="input" type="date" placeholder="Text input" id="expired">
                               
                            </div></small> <br />
                                    </div>
                                  </div>
                                  <div class="columns">
                                    <div class="column">
                                      <a class="button is-info is-large is-fullwidth" href="recruiter-list-applicants.html">See Applicants</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </article>
                    <article class="media">
                      <div class="media-content">
                        <div class="columns">
                          <div class="column is-3">
                          </div>
                          <div class="column is-9">
                            <div class="content">
                              <span class="subtitle is-5">Job Summary</span> <br />
                              <div class="field">
                                    <textarea class="textarea job-summary-info" placeholder="Summary" id="summary"></textarea>
                            </div>
                              <br />
                              <span class="subtitle is-5">Minimum Education</span> <br />
                              <div class="field">
                                <div class="select job-minimum">
                                    <select id="qualification"> 
                                        <option>SMA</option>
                                        <option>D1</option>
                                        <option>D3</option>
                                        <option>D4/S1</option>
                                        <option>S2</option>
                                    </select>
                                </div>
                              </div>
                              
                              <span class="subtitle is-5">Category</span> <br />
                              <span class="subtitle is-6 category-name">{job.category.name}</span> <br />
                              <br />
                              <span class="subtitle is-5">Industry</span> <br />
                              <span class="subtitle is-6 industry-name">{job.company.industry}</span> <br />
                              <br />
                              <span class="subtitle is-5">Office Address</span> <br />
                              <span class="subtitle is-6 company-address">{job.company.address}</span>
                              <span class="subtitle is-6">, </span>
                              <span class="subtitle is-6 company-city">{job.company.city}</span> <br />
                              <br />
                              
                            </div>
                          </div>
                        </div>
                        <button class="button is-info" id="job-edit-btn" style="float:right"
                        onclick="saveJob()">&nbsp&nbspSave&nbsp&nbsp</button>
                      </div>               
                    </article>`
                }

                function saveJob() {
                  document.querySelector('#detail-job').innerHTML =
                    `<i class="fas fa-trash" style="float:right" onclick="deleteJob()"></i>
              <br>
              <article class="media">
                <div class="media-content job-summary">
                  <div class="columns">
                    <div class="column is-3">
                      <figure class="image company-img-in-job-detail">
                        <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
                      </figure>
                    </div>
                    <div class="column is-9">
                      <div class="content">
                        <div class="columns">
                          <div class="column is-7">
                              <span class="subtitle is-4 job-name">{job.position}</span> <br />
                              <span class="subtitle is-5 company-name">{job.company}</span> <br />
                              <span class="subtitle is-6 company-city">{job.city}</span>
                              <span class="subtitle is-6"> | IDR </span>
                              <span class="subtitle is-6 job-salary">{job.salary.min}</span>
                              <span class="subtitle is-6"> - IDR </span>
                              <span class="subtitle is-6 job-salary">{job.salary.max}</span>
                              <span class="subtitle is-6"> | </span>
                              <span class="subtitle is-6 job-employment">{job.type}</span>
                          </div>
                          <div class="column is-5">
                            <div class="columns">
                              <div class="column has-text-right">
                                  <small>Before </small><small class="job-expire-date">Posted on {job.date_posted}, until
                                      {job.date_expired}</small> <br />
                              </div>
                            </div>
                            <div class="columns">
                              <div class="column">
                                <a class="button is-info is-large is-fullwidth" href="recruiter-list-applicants.html">See Applicants</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </article>
              <article class="media">
                <div class="media-content">
                  <div class="columns">
                    <div class="column is-3">
                    </div>
                    <div class="column is-9">
                      <div class="content">
                        <span class="subtitle is-5">Job Summary</span> <br />
                        <span class="subtitle is-6 job-summary-info">{job.summary}</span> <br />
                        <br />
                        <span class="subtitle is-5">Minimum Qualification</span> <br />
                        <span class="subtitle is-6 job-minimum">{job.qualification}</span> <br />
                        <br />
                        <span class="subtitle is-5">Category</span> <br />
                        <span class="subtitle is-6 category-name">{job.category.name}</span> <br />
                        <br />
                        <span class="subtitle is-5">Industry</span> <br />
                        <span class="subtitle is-6 industry-name">{job.company.industry}</span> <br />
                        <br />
                        <span class="subtitle is-5">Office Address</span> <br />
                        <span class="subtitle is-6 company-address">{job.company.address}</span>
                        <span class="subtitle is-6">, </span>
                        <span class="subtitle is-6 company-city">{job.company.city}</span> <br />
                        <br />
                        
                      </div>
                    </div>
                  </div>
                  <button class="button is-info" id="job-edit-btn" style="float:right"
                  onclick="editJob()">&nbsp&nbspEdit&nbsp&nbsp</button>
                </div>
                </article> `
                }

                function deleteJob() {
                  document.querySelector("#detail-job").parentNode.removeChild(
                    document.querySelector("#detail-job")
                  );
                  jsonData.splice(getIdx(id), 1);
                  viewExp();
                  // window.location = 'recruiter-dashboard.html';
                }
              </script>

            </article>
          </div>
        </div>
        <div class="column">
        </div>
      </div>
    </div>
</body>
</html>