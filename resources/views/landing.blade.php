<link rel="stylesheet" href="/css/landing.css" />
<div class="container-fluid landing">
    <div class="row image first">
        <div class="col-md-offset-1 col-md-11 col-xs-12 col-lg-11">
            <h1>Routerium</h1>
            <br />
            <p class="sub-heading">Your journey told sweet</p>
            <div class="buttons">
                <a class="btn btn-signup" href="{{ URL::to('auth/google') }}">Take me in!</a>
            </div>
        </div>
    </div>
    <div class="row second">
        <div class="col-md-4 col-xs-12 col-lg-4">
            <h2>Tell your journey</h2>
            <div class="illustration">
                <img src="/img/screens/edit.png" class="img-responsive" />
            </div>
            <p>You are full of bright impressions after your awesome vacation. You want to share all these photos with your friends. You want to tell them in details where you've been to. There's too much information!</p>
            <p>It's as easy as a piece of cake! Just <strong>create</strong> a map, <strong>draw</strong> your route on it, <strong>describe</strong> in details your stops and don't forget to attach photos. Now <strong>share</strong> the link with your friends!</p>
        </div>
        <div class="col-md-4 col-xs-12 col-lg-4">
            <h2>Get inspired</h2>
            <div class="illustration">
                <img src="/img/screens/list.png" class="img-responsive" />
            </div>
            <p>Sometimes to make the first step we need some inspiration. Search "Routerium" stories by locations and keywords or just scroll down the full list of journeys. Who knows where it is going to take you?</p>
        </div>
        <div class="col-md-4 col-xs-12 col-lg-4">
            <h2>Plan your vacation</h2>
            <div class="illustration">
                <img src="/img/screens/plan.png" class="img-responsive" />
            </div>
            <p>Let me guess: you're excited about your upcoming vacation, you can't wait when the journey starts. You should have a long must-see and must-visit list. Make sure you don't forget anything. Create a <strong>draft</strong> map, mark all future stops. No one will see this map except you.</p>
            <p>You'll be able to make it <strong>public</strong> whenever you want!</p>
        </div>
    </div>
    <div class="row second text-center">
        <div class="buttons">
            <a class="btn btn-signup" href="{{ URL::to('auth/google') }}">Take me in!</a>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <p class="text-center"><span class="glyphicon glyphicon-heart"></span><br> {{ date('Y') }}</p>
        </div>
    </div>
</div>