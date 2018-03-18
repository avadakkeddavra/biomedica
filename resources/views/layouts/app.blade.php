<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Biomedica</title>
    <!-- Compiled and minified CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.css">

</head>
<body>


    <header>
        <ul id="slide-out" class="side-nav">
            <li><div class="user-view">
                    <div class="background">
                        <img src="http://materializecss.com/images/office.jpg">
                    </div>
                    <a href="#!user"><img class="circle" src="img/user4-128x128.jpg"></a>
                    <a href="#!name"><span class="white-text name">John Doe</span></a>
                    <a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a>
                </div></li>
            <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
            <li><a href="#!">Second Link</a></li>
            <li><div class="divider"></div></li>
            <li><a class="subheader">Subheader</a></li>
            <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
        </ul>
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="brand-logo">Logo</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="">Sass</a></li>
                    <li><a href="">Components</a></li>
                    <li><a href="">JavaScript</a></li>
                    <li><a href="" data-activates="slide-out" id="nav"><i class="material-icons">menu</i></a></li>
                </ul>
            </div>
        </nav>

        <div class="header valign-wrapper">
            <div class="row">
                <div class="col s12 m6">
                    <h3>This should be vertically aligned</h3>
                    <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam culpa eius eum expedita facilis laudantium odit officiis quibusdam tenetur vero!</h5>

                    <a class="waves-effect waves-light btn">button</a>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        @yield('content')
    </div>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.js"></script>
<script>
    $(document).ready(function(){
        $('#nav').sideNav();
    })

</script>
</body>
</html>