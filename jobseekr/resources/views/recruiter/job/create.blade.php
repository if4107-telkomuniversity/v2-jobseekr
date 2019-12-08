<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Post Job | JobSeekr</title>
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
                        <li><a href="recruiter-dashboard.html" class="subtitle is-4">Job</a></li>
                        <li><a href="/recruiter/job/new"class="subtitle is-4">Post Job</a></li>
                    </ul>
                </aside>
            </div>
            <div class="column is-10">
                <div class="columns">
                    <div class="column is-4">
                    </div>
                    <div class="column is-5 jobs-content" style="margin-left:180px">
                        <div class="box ">
                            <div class="field">
                                <p class="title has-text-centered">Post Job</p>
                                <br>
                            </div>
                            <form action="/recruiter/job/new" method="POST">
                                <div class="field">
                                    <div class="field-body">
                                        <div class="field">
                                            <label class="label">Position</label>
                                            <div class="control">
                                                <input class="input" type="text" placeholder="Position" id="position" name="position" required="" autofocus="">
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label class="label">Type</label>
                                            <div class="control is-expanded">
                                                <div class="select is-fullwidth">
                                                    <select id="type" name="type" required="">
                                                        <option disabled="" hidden="" selected="">Type</option>
                                                        <option value="full_time">Full-Time</option>
                                                        <option value="part_time">Part-Time</option>
                                                        <option value="internship">Internship</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Summary</label>
                                    <div class="control">
                                        <textarea class="textarea" placeholder="Summary" id="summary" rows="12" style="resize: none;" required="" name="summary"></textarea>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="field-body">
                                        <div class="field">
                                            <label class="label">Job Category</label>
                                            <div class="control is-expanded">
                                                <div class="select is-fullwidth">
                                                    <select id="category" name="category" required="">
                                                        <option selected="" disabled="" hidden="">Job Category</option>
                                                        @foreach ($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label class="label">Minimum Education</label>
                                            <div class="control is-expanded">
                                                <div class="select is-fullwidth">
                                                    <select id="qualification" name="min_education" required="">
                                                        <option selected="" disabled="" hidden="">Minimum Education</option>
                                                        <option value="high_school">High School</option>
                                                        <option value="diploma">Diploma</option>
                                                        <option value="bachelor">Bachelor</option>
                                                        <option value="master">Master</option>
                                                        <option value="doctor">Doctor</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="field-body">
                                        <div class="field">
                                            <label class="label">Salary</label>
                                            <div class="control">
                                                <input class="input" type="number" placeholder="Salary" id="salary" min="0" required="" name="salary">
                                            </div>
                                        </div>
                                        <div class="field" style="width: 22vh">
                                            <label class="label">Expire Date</label>
                                            <div class="control">
                                                <input class="input" type="date" placeholder="Text input" id="expired" name="expired_at", required="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <div class="field is-grouped is-grouped-right">
                                    <div class="control">
                                        {{csrf_field()}}
                                        <input type="submit" class="button is-link" value="Submit">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>