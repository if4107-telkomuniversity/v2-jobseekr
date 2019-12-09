<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile | JobSeekr</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script>
    var jsonData = [@foreach ($experiences as $experience)
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
      <div class="columns">
        <div class="column is-4">
        </div>
        <div class="column is-8 jobs-content">
          <div class="box">
            <div class="columns">
              <div class="column is-1">
              </div>
              <div class="column is-2" id="jobseeker-pic">
                <figure class="image is-128x128">
                  <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
                </figure>
              </div>
              <div class="column is-8" id="jobseeker-profile">
                <span class="title is-4 jobseeker-name">{{$name}}</span><br />
                <br />
                <form action="#" method="POST">
                  <div class="columns">
                    <div class="column is-10">
                      <div class="field">
                        <div class="field">
                          <p class="control has-icons-left has-icons-right">
                            <input class="input" type="text" id="address-content" placeholder="Address"
                            value="{Address}" style="color: #DCDCDC;" readonly>
                            <span class="icon is-small is-left">
                              <i class="fas fa-map-marker-alt"></i>
                            </span>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="columns low-top-margin">
                    <div class="column is-10">
                      <div class="field">
                        <p class="control has-icons-left has-icons-right">
                          <input class="input" type="text" id="phone-number-content" placeholder="Phone Number"
                          value="{Phone Number}" style="color: #DCDCDC;" readonly>
                          <span class="icon is-small is-left">
                            <i class="fas fa-phone"></i>
                          </span>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="columns low-top-margin">
                    <div class="column">
                      <button class="button is-info" onclick="editProfile()">&nbsp&nbspEdit&nbsp&nbsp</button>
                      <script>
                      function editProfile() {
                      document.querySelector('#jobseeker-profile').innerHTML =
                      `<span class="title is-4 jobseeker-name">{Name}</span><br/>
                      <br/>
                      <form action="#" method="POST">
                        <div class="columns">
                          <div class="column is-10">
                            <div class="field">
                              <p class="control has-icons-left has-icons-right">
                                <input class="input" type="text" id="address-content" placeholder="Address" value="`
                                + document.querySelector('#address-content').value + `">
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
                                <input class="input" type="text" id="phone-number-content" placeholder="Phone Number" value="`
                                + document.querySelector('#phone-number-content').value + `">
                                <span class="icon is-small is-left">
                                  <i class="fas fa-phone"></i>
                                </span>
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="columns low-top-margin">
                          <div class="column is-10">
                            <div class = "field">
                              <p>Change your photo here (optional)</p>
                              <input class="input" type="file">
                            </div>
                          </div>
                        </div>
                        <div class="columns low-top-margin">
                          <div class="column">
                            <button class="button is-info" onclick="saveProfile()"
                            style="background-color: #4CAF50;">&nbsp&nbspSave&nbsp&nbsp</button>
                          </div>
                        </div>
                      </form>`;
                      }
                      function saveProfile() {
                      document.querySelector('#jobseeker-pic').innerHTML =
                      `<figure class="image is-128x128">
                        <img class="is-rounded" src="{new_pic}">
                      </figure>`;
                      document.querySelector('#jobseeker-profile').innerHTML =
                      `<span class="title is-4 jobseeker-name">{Name}</span><br />
                      <br />
                      <form action="#" method="POST">
                        <div class="columns">
                          <div class="column is-10">
                            <div class="field">
                              <div class="field">
                                <p class="control has-icons-left has-icons-right">
                                  <input class="input" type="text" id="address-content" placeholder="Address" value="`
                                  + document.querySelector('#address-content').value + `" style="color: #DCDCDC;" readonly>
                                  <span class="icon is-small is-left">
                                    <i class="fas fa-map-marker-alt"></i>
                                  </span>
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="columns low-top-margin">
                          <div class="column is-10">
                            <div class="field">
                              <p class="control has-icons-left has-icons-right">
                                <input class="input" type="text" id="phone-number-content" placeholder="Phone Number" value="`
                                + document.querySelector('#phone-number-content').value + `" style="color: #DCDCDC;" readonly>
                                <span class="icon is-small is-left">
                                  <i class="fas fa-phone"></i>
                                </span>
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="columns low-top-margin">
                          <div class="column">
                            <button class="button is-info" onclick="editProfile()">&nbsp&nbspEdit&nbsp&nbsp</button>
                          </div>
                        </div>
                      </form>`;
                      }
                      </script>
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
                <span class="subtitle is-4">Account</span>
              </div>
              <div class="column is-8" id="jobseeker-account">
                <form action="#" method="POST">
                  <div class="columns">
                    <div class="column is-10">
                      <div class="field">
                        <p class="control has-icons-left has-icons-right is-expanded">
                          <input class="input" type="email" id="email-content" placeholder="Email"
                          value="kurungemail@gmailkurung" style="color: #DCDCDC;" readonly>
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
                          <input class="input" type="password" id="password-content" placeholder="Password"
                          value="{Password}" style="color: #DCDCDC;" readonly>
                          <span class="icon is-small is-left">
                            <i class="fas fa-unlock-alt"></i>
                          </span>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="columns low-top-margin">
                    <div class="column">
                      <button class="button is-info" onclick="editAccount()">&nbsp&nbspEdit&nbsp&nbsp</button>
                      <script>
                      function editAccount() {
                      document.querySelector('#jobseeker-account').innerHTML =
                      `<form action="#" method="POST">
                        <div class="columns">
                          <div class="column is-10">
                            <div class="field">
                              <p class="control has-icons-left has-icons-right is-expanded">
                                <input class="input" type="email" id="email-content"
                                placeholder="Email" value="`+ document.querySelector('#email-content').value + `" required>
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
                                <input class="input" type="password" id="password-content"
                                placeholder="Password" value="`+ document.querySelector('#password-content').value + `" required>
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
                                <input class="input" type="password" id="repeat-password" placeholder="Repeat password" required>
                                <span class="icon is-small is-left">
                                  <i class="fas fa-unlock-alt"></i>
                                </span>
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="columns low-top-margin">
                          <div class="column">
                            <button class="button is-info" onclick="saveAccount()"
                            style="background-color: #4CAF50;">&nbsp&nbspSave&nbsp&nbsp</button>
                          </div>
                        </div>
                      </form>`;
                      }
                      function saveAccount() {
                      if (document.querySelector('#password-content').value
                      === document.querySelector('#repeat-password').value) {
                      document.querySelector('#jobseeker-account').innerHTML =
                      `<form action="#" method="POST">
                        <div class="columns">
                          <div class="column is-10">
                            <div class="field">
                              <p class="control has-icons-left has-icons-right is-expanded">
                                <input class="input" type="email" id="email-content" placeholder="Email"
                                value="`+ document.querySelector('#email-content').value + `" style="color: #DCDCDC;" readonly>
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
                                <input class="input" type="password" id="password-content" placeholder="Password"
                                value="`+ document.querySelector('#password-content').value + `"
                                style="color: #DCDCDC;" readonly>
                                <span class="icon is-small is-left">
                                  <i class="fas fa-unlock-alt"></i>
                                </span>
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="columns low-top-margin">
                          <div class="column">
                            <button class="button is-info" onclick="editAccount()">&nbsp&nbspEdit&nbsp&nbsp</button>
                          </div>
                        </div>
                      </form>`;
                      } else {
                      document.querySelector('#jobseeker-account').innerHTML =
                      `<form action="#" method="POST">
                        <div class="columns">
                          <div class="column is-10">
                            <div class="field">
                              <p class="control has-icons-left has-icons-right is-expanded">
                                <input class="input" type="email" id="email-content"
                                placeholder="Email" value="`+ document.querySelector('#email-content').value + `" required>
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
                                <input class="input" type="password" id="password-content"
                                placeholder="Password" value="`+ document.querySelector('#password-content').value + `" required>
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
                                <input class="input" type="password" id="repeat-password" placeholder="Repeat password" required>
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
                              <p style="color : red;">Password do not match.</p>
                            </div>
                          </div>
                        </div>
                        <div class="columns low-top-margin">
                          <div class="column">
                            <button class="button is-info" onclick="saveAccount()"
                            style="background-color: #4CAF50;">&nbsp&nbspSave&nbsp&nbsp</button>
                          </div>
                        </div>
                      </form>`;
                      }
                      }
                      </script>
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
                function getIdx(id){
                var i = 0;
                while (i < jsonData.length){
                if (jsonData[i].id == id) return i;
                i++;
                }
                }
                function editExp(id) {
                document.querySelector(".work-experience[data-id='"+id+"']").innerHTML =
                `
                <div form action="#" method="POST">
                  <div class="columns">
                    <div class="column is-3">
                      <figure class="image is-96x96" data-id="`+id+`">
                        <img class="is-rounded" src="`+ jsonData[getIdx(id)].pic + `">
                      </figure>
                    </div>
                    <div class="column is-8">
                      <div class = "field">
                        <input class="input position" data-id="`+id+`" type="text" placeholder="Position"
                        value="`+ jsonData[getIdx(id)].position + `" required>
                      </div>
                      <div class = "field">
                        <input class="input company" data-id="`+id+`" type="text" placeholder="Company"
                        value="`+ jsonData[getIdx(id)].company + `" required>
                      </div>
                      <div class = "field">
                        <input class="input duration" data-id="`+id+`" type="text" placeholder="Duration"
                        value="`+ jsonData[getIdx(id)].duration + `" required>
                      </div>
                      <div class = "field">
                        <p>Change your photo here (optional)</p>
                        <input class="input pic-url" data-id="`+id+`" type="file">
                      </div>
                    </div>
                    <div class="column is-1">
                    </div>
                  </div>
                  <div class="columns" style="padding-left :15px; padding-right: 15px; justify-content: space-between;">
                    <button class="button is-info is-small" onclick="delExp(\``+id+`\`)"
                    style="border-color : grey; color: grey; background-color:white; text-align:center;">Delete</button>
                    <button class="button is-info is-small" onclick="saveExp(\``+id+`\`)"
                    style="background-color: #4CAF50; text-align:center; width : 54.22px">Save</button>
                  </div>
                </div>
              </form>
              `;
              }
              function saveExp(id){
              jsonData[getIdx(id)].pic += document.querySelector(".pic-url[data-id='"+id+"']").value;
              jsonData[getIdx(id)].position = document.querySelector(".position[data-id='"+id+"']").value;
              jsonData[getIdx(id)].company = document.querySelector(".company[data-id='"+id+"']").value;
              jsonData[getIdx(id)].duration = document.querySelector(".duration[data-id='"+id+"']").value;
              viewExp();
              }
              function delExp(id) {
              document.querySelector(".work-experience[data-id='"+id+"']").parentNode.removeChild(
              document.querySelector(".work-experience[data-id='"+id+"']")
              );
              jsonData.splice(getIdx(id),1);
              viewExp();
              }
              function addJob() {
              document.querySelector('#addbtn').parentNode.removeChild(document.querySelector('#addbtn'));
              document.querySelector('#list-work').innerHTML +=
              `
              <div class="box add-work-experience">
                <div class="columns">
                  <!--div class="column is-3">
                  <figure class="image is-96x96">
                    <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
                  </figure>
                </div-->
                <div class="column is-11">
                  <div class = "field">
                    <input class="input" id="add-position" type="text" placeholder="Position" required>
                  </div>
                  <div class = "field">
                    <input class="input" id="add-company" type="text" placeholder="Company" required>
                  </div>
                  <div class = "field">
                    <input class="input" id="add-duration" type="text" placeholder="Duration" required>
                  </div>
                  <div class = "field">
                    <input class="input" id="add-pic" type="file" placeholder="Duration" required>
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
          function addExp(){
          var newExp = {
          "id" : (jsonData[jsonData.length - 1].id + 1),
          "position" : document.querySelector('#add-position').value,
          "company" : document.querySelector('#add-company').value,
          "duration" : document.querySelector('#add-duration').value,
          "pic" : "https://bulma.io/images/placeholders/128x128.png"
          };
          jsonData.push(newExp);
          viewExp();
          }
          function viewExp() {
          var i = "";
          strHTML = "";
          for (i in jsonData) {
          strHTML +=
          `<div class="box work-experience" data-id="`+jsonData[i].id+`">
            <div class="columns">
              <div class="column is-3">
                <figure class="image is-96x96">
                  <img class="is-rounded" src="`+jsonData[i].pic+`">
                </figure>
              </div>
              <div class="column is-8">
                <span class="subtitle is-5 position" data-id="`+jsonData[i].id+`">`+ jsonData[i].position + `</span><br />
                <span class="subtitle is-5 company" data-id="`+jsonData[i].id+`">`+ jsonData[i].company + `</span><br />
                <span class="subtitle is-5 duration" data-id="`+jsonData[i].id+`">`+ jsonData[i].duration + `</span><br />
              </div>
              <div class="column is-1">
                <span class="fas fa-pencil-alt" id="editbtn" onclick="editExp(\``+jsonData[i].id+`\`)"></span>
              </div>
            </div>
          </div>`;
          }
          document.querySelector('#list-work').innerHTML = strHTML;
          document.querySelector('#list-work').innerHTML +=
          `<button onclick="addJob()" class="button is-info is-fullwidth" id="addbtn" type="button">Add Work
          Experience</button>`;
          }
          </script>
        </div>
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
<script>
function callFunctions() {
checkAuth();
formatForUser();
}
</script>
</html>