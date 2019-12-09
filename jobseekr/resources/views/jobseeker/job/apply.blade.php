<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apply Job | JobSeekr</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <!-- <script defer src="js/job.js"></script>
    <script defer src="js/auth.js"></script> -->
    <script>
    var jsonData = [
    @foreach ($experiences as $experience)
    {
    "id": "{{$experience['id']}}",
    "position": "{{$experience['position']}}",
    "company": "{{$experience['company']}}",
    "duration": "{{$experience['duration']}}"
    },
    @endforeach
    ];
    </script>
  </head>
  <body onload="setExperience()">
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
            <li><a href="/dashboard" class="subtitle is-4">Jobs</a></li>
            <li><a class="subtitle is-4">Applications</a></li>
          </ul>
        </aside>
      </div>
    </div>
    <div class="column is-10">
      <form action="/job/{{$job_id}}/apply" method="POST" enctype="multipart/form-data">
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
                <div class="column is-8" id="jobseeker-contact">
                  <span class="title is-4 jobseeker-name" id="jobseeker-name">{{$name}}</span><br />
                  <div id="jobseeker-edit">
                    <div id="address">
                      <span class="subtitle is-5 jobseeker-address" id="jobseeker-address">{{$address}}</span><br />
                    </div>
                    <div id="email">
                      <span class="subtitle is-5 jobseeker-email" id="jobseeker-email">{{$email}}</span><br />
                    </div>
                    <div id="phone">
                      <span class="subtitle is-5 jobseeker-phone-number" id="jobseeker-phone">{{$phone}}</span><br />
                    </div>
                    <button class="button is-info" id="biodata-edit-btn"
                    onclick="editBiodata()">&nbsp&nbspEdit&nbsp&nbsp</button>
                  </div>
                </div>
                <div class="column is-1">
                </div>
              </div>
            </div>
            <div class="box">
              <div class="columns">
                <div class="column is-3">
                  <span class="subtitle is-4">Summary</span>
                </div>
                <div class="column is-8" id="summary">
                  <div class="columns">
                    <div class="column">
                      <div class="field">
                        <div class="control">
                          <textarea class="textarea is-medium" name="summary" id="summary-content" placeholder="Summary" autofocus=""></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
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
                <style>
                #editbtn {
                margin: 0px 0 15px 15px;
                color: #cdcdcd;
                font-weight: bold;
                float: right;
                font-size: 16px;
                line-height: 50%;
                cursor: pointer;
                transition: 0.3s;
                }
                #editbtn:hover {
                color: black;
                }
                </style>
                <div class="column is-8" id="list-work">
                  <script>
                  viewExp();
                  function getIdx(id) {
                  var i = 0;
                  while (i < jsonData.length) {
                  if (jsonData[i].id == id) return i;
                  i++;
                  }
                  }
                  function editExp(id) {
                  document.querySelector(".work-experience[data-id='" + id + "']").innerHTML =
                  `
                  <div class="columns">
                    <div class="column is-3">
                      <figure class="image is-96x96">
                        <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
                      </figure>
                    </div>
                    <div class="column is-8">
                      <div class = "field">
                        <input class="input position" data-id="`+ id + `" type="text" placeholder="Position"
                        value="`+ jsonData[getIdx(id)].position + `" required>
                      </div>
                      <div class = "field">
                        <input class="input company" data-id="`+ id + `" type="text" placeholder="Company"
                        value="`+ jsonData[getIdx(id)].company + `" required>
                      </div>
                      <div class = "field">
                        <input class="input duration" data-id="`+ id + `" type="text" placeholder="Duration"
                        value="`+ jsonData[getIdx(id)].duration + `" required>
                      </div>
                    </div>
                    <div class="column is-1">
                    </div>
                  </div>
                  <div class="columns" style="padding-left :15px; padding-right: 15px; justify-content: space-between;">
                    <button class="button is-info is-small" onclick="delExp(\``+ id + `\`)"
                    style="border-color : grey; color: grey; background-color:white; text-align:center;">Delete</button>
                    <button class="button is-info is-small" onclick="saveExp(\``+ id + `\`)"
                    style="background-color: #4CAF50; text-align:center; width : 54.22px">Save</button>
                  </div>
                  `;
                  }
                  function saveExp(id) {
                  jsonData[getIdx(id)].position = document.querySelector(".position[data-id='" + id + "']").value;
                  jsonData[getIdx(id)].company = document.querySelector(".company[data-id='" + id + "']").value;
                  jsonData[getIdx(id)].duration = document.querySelector(".duration[data-id='" + id + "']").value;
                  viewExp();
                  }
                  function delExp(id) {
                  document.querySelector(".work-experience[data-id='" + id + "']").parentNode.removeChild(
                  document.querySelector(".work-experience[data-id='" + id + "']")
                  );
                  jsonData.splice(getIdx(id), 1);
                  viewExp();
                  }
                  function addJob() {
                  document.querySelector('#addbtn').parentNode.removeChild(document.querySelector('#addbtn'));
                  document.querySelector('#list-work').innerHTML +=
                  `
                  <div class="box add-work-experience">
                    <div class="columns">
                      <div class="column is-3">
                        <figure class="image is-96x96">
                          <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
                        </figure>
                      </div>
                      <div class="column is-8">
                        <div class = "field">
                          <input class="input" id="add-position" type="text" placeholder="Position" required>
                        </div>
                        <div class = "field">
                          <input class="input" id="add-company" type="text" placeholder="Company" required>
                        </div>
                        <div class = "field">
                          <input class="input" id="add-duration" type="text" placeholder="Duration" required>
                        </div>
                      </div>
                      <div class="column is-1">
                      </div>
                    </div>
                    <div class="columns" style="padding-left :15px; padding-right: 15px; justify-content: space-between;">
                      <button class="button is-info is-small" onclick="viewExp()"
                      style="border-color : grey; color: grey; background-color:white; text-align:center;">Cancel</button>
                      <button class="button is-info is-small" onclick="addExp()"
                      style="background-color: #4CAF50; text-align:center; width : 54.22px">Add</button>
                    </div>
                  </div>
                </div>
                `;
                }
                function addExp() {
                var newExp = {
                "id": (jsonData[jsonData.length - 1].id + 1),
                "position": document.querySelector('#add-position').value,
                "company": document.querySelector('#add-company').value,
                "duration": document.querySelector('#add-duration').value
                };
                jsonData.push(newExp);
                viewExp();
                }
                function viewExp() {
                var i = "";
                strHTML = "";
                for (i in jsonData) {
                strHTML +=
                `<div class="box work-experience" data-id="` + jsonData[i].id + `">
                  <div class="columns">
                    <div class="column is-3">
                      <figure class="image is-96x96">
                        <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
                      </figure>
                    </div>
                    <div class="column is-8">
                      <span class="subtitle is-5 position" data-id="`+ jsonData[i].id + `">` + jsonData[i].position + `</span><br />
                      <span class="subtitle is-5 company" data-id="`+ jsonData[i].id + `">` + jsonData[i].company + `</span><br />
                      <span class="subtitle is-5 duration" data-id="`+ jsonData[i].id + `">` + jsonData[i].duration + `</span><br />
                    </div>
                    <div class="column is-1">
                      <span class="fas fa-pencil-alt" id="editbtn" onclick="editExp(\``+ jsonData[i].id + `\`)"></span>
                    </div>
                  </div>
                </div>`;
                }
                document.querySelector('#list-work').innerHTML = strHTML;
                document.querySelector('#list-work').innerHTML +=
                `<button onclick="addJob()" class="button is-info is-fullwidth" id="addbtn" type="button">Add Work
                Experience</button>`;
                //document.querySelector('#list-work').innerHTML += jsonData.length;
                }
                </script>
              </div>
            </div>
          </div>
          <div class="box">
            <div class="columns">
              <div class="column is-3">
                <span class="subtitle is-4">Document</span>
              </div>
              <div class="column is-8">
                <div class="box">
                  <div class="columns">
                    <div class="column is-10">
                      <span class="subtitle is-5">CV</span><br />
                      <p id="filename-cv">(No file chosen)</p>
                    </div>
                    <div class="column is-2 file is-vertical-center" style="float:right;display: flex; align-items: center;">
                      <label class="file-label" onclick="addCV()">
                        <input class="file-input" type="file" name="cv" id="file-cv" accept="application/pdf">
                        <span class="file-cta button is-info">
                          <span class="file-label">
                            Add
                          </span>
                        </span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="box">
                  <div class="columns">
                    <div class="column is-10">
                      <span class="subtitle is-5">Resume</span><br />
                      <p id="filename-resume">(No file chosen)</p>
                    </div>
                    <div class="column is-2 file is-vertical-center" style="float:right;display: flex; align-items: center;">
                      <label class="file-label" onclick="addResume()">
                        <input class="file-input" type="file" name="resume" id="file-resume" accept="application/pdf">
                        <span class="file-cta button is-info">
                          <span class="file-label">
                            Add
                          </span>
                        </span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="column is-1">
              </div>
            </div>
          </div>
          <input type="" name="experiences" hidden="" id="input-experiences">
          {{csrf_field()}}
          @if ($errors->any())
          <div class="has-text-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <input type="submit" class="button is-info is-fullwidth is-medium" value="Apply for job!">
        </div>
        <div class=" column">
        </div>
      </div>
    </form>
  </div>
</body>
<script>
const setExperience = () => {
  console.log('exp');
let experiencesInput = document.getElementById('input-experiences');
let ids = '[';
for (let i = 0; i < jsonData.length; i++) {
ids += `${jsonData[i].id},`;
}
ids = ids.substring(0, ids.length-1) + ']';
experiencesInput.setAttribute('value', ids);
};
function addCV() {
var input = document.getElementById('file-cv');
var infoArea = document.getElementById('filename-cv');
input.addEventListener('change', showFileName);
function showFileName(event) {
var input = event.srcElement;
var fileName = input.files[0].name;
infoArea.textContent = fileName;
}
}
function addResume() {
var input = document.getElementById('file-resume');
var infoArea = document.getElementById('filename-resume');
input.addEventListener('change', showFileName);
function showFileName(event) {
var input = event.srcElement;
var fileName = input.files[0].name;
infoArea.textContent = fileName;
}
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
function apply() {
var data = new FormData();
data.append('owner', sessionStorage.getItem('email'));
data.append('job_id', sessionStorage.getItem('jobId'));
data.append('summary', document.getElementById('summary-content').innerHTML);
data.append('file', document.getElementById('file-upload'))
data.append('cv_id', 0);
data.append('resume_id', 0);
var xhr = new XMLHttpRequest();
xhr.open('POST', 'http://localhost:8000/job-application/create', false);
xhr.send(data);
if (xhr.status === 201) {
window.location = 'jobseeker-application-sent.html';
} else {
alert(xhr.status);
}
}
function editBiodata() {
document.querySelector('#jobseeker-edit').innerHTML =
`<form action="#" method="POST">
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
          <input class="input" type="email" placeholder="Email">
          <span class="icon is-small is-left">
            <i class="fas fa-envelope"></i>
          </span>
        </p>
      </div>
    </div>
  </div>
  <div class="columns low-top-margin">
    <div class="column is-10">
      <div class="field">
        <p class="control has-icons-left has-icons-right">
          <input class="input" type="text" placeholder="Phone Number">
          <span class="icon is-small is-left">
            <i class="fas fa-phone"></i>
          </span>
        </p>
      </div>
    </div>
  </div>
  <div class="columns low-top-margin">
    <div class="column">
      <button class="button is-info" id="profile-edit-btn" onclick="saveBiodata()"
      style="background-color: #4CAF50;">&nbsp&nbspSave&nbsp&nbsp</button>
    </div>
  </div>
</form>`;
}
function saveBiodata() {
document.querySelector('#jobseeker-contact').innerHTML =
`<span class="title is-4 jobseeker-name" id="jobseeker-name">{name}</span><br />
<div id="jobseeker-edit">
  <div id="address">
    <span class="subtitle is-5 jobseeker-address" id="jobseeker-address">{address}</span><br />
  </div>
  <div id="email">
    <span class="subtitle is-5 jobseeker-email" id="jobseeker-email">{email}</span><br />
  </div>
  <div id="phone">
    <span class="subtitle is-5 jobseeker-phone-number" id="jobseeker-phone">{phone}</span><br />
  </div>
  <button class="button is-info" id="biodata-edit-btn"
  onclick="editBiodata()">&nbsp&nbspEdit&nbsp&nbsp</button>
</div>`;
}
function editSummary() {
document.querySelector('#summary').innerHTML =
`
<div class="columns">
  <div class="column is-10">
    <div class="field">
      <div class="control">
        <textarea class="textarea is-medium" name="summary" id="summary-content" placeholder="Summary"></textarea>
      </div>
    </div>
  </div>
</div>
<div class="columns low-top-margin">
  <div class="column is-8 ">
    <button class="button is-info" id="profile-edit-btn" onclick="saveSummary()" style="background-color: #4CAF50;">&nbsp&nbspSave&nbsp&nbsp</button>
  </div>
</div>`;
}
function saveSummary() {
document.querySelector('#application-summary').innerHTML =
`<span class="subtitle is-5 jobseeker-summary" id="summary-content">{Summary}</span><br/>`;
}
</script>
</html>