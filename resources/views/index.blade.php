<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="/img/favicon.ico">
    <title>Routerium</title>
    <link href='https://fonts.googleapis.com/css?family=Work+Sans:400,200' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/style.css" />
</head>


<body ng-app="publicApp">
<!--[if lte IE 8]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

@if(!Auth::check())
    @include('landing')
@else
<!-- Add your site or application content here -->
<div class="header">
    <div class="navbar navbar-main" role="navigation">

        {{--<p class="sub-logo">Your journey told sweet</p>--}}
        <div class="col-md-12 col-xs-12 text-left">

            <ul class="list-inline">
                <li>
                    <a href="/#/">
                        <h1>Routerium</h1><span class="alpha">α</span>
                    </a>
                </li>
                <li>{{ Auth::user()->name }}:</li>
                <li><a href="/#/tell-your-journey">Add new journey</a></li>
                <li><a href="/#/user/{{ Auth::user()->id }}">My journeys</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </div>
    </div>
    <div ng-view=""></div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDkN6suhbmGdtL6pD6ax1K5pB3hfhUVfpI&libraries=visualization"></script>
<script src="/bower_components/jquery/dist/jquery.js"></script>
<script src="/bower_components/angular/angular.js"></script>
<script src="/bower_components/angular-resource/angular-resource.js"></script>
<script src="/bower_components/angular-route/angular-route.js"></script>
<script src="/app/scripts/app.js"></script>
<script src="/app/scripts/controllers/main.js"></script>
<script src="/app/scripts/controllers/about.js"></script>
<script src="/app/scripts/controllers/view.js"></script>
<script src="/app/scripts/controllers/edit.js"></script>
<script src="/app/scripts/directives/gmap.js"></script>
<script src="/app/scripts/directives/edit-point.js"></script>
<script src="/app/scripts/directives/view-point.js"></script>
<script src="/bower_components/tinymce-dist/tinymce.min.js"></script>
<script src="/bower_components/angular-ui-tinymce/src/tinymce.js"></script>
@endif
</body>
</html>
