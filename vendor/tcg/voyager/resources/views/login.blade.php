<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" @if (config('voyager.multilingual.rtl')) dir="rtl" @endif>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="none" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="admin login">
    <title>Admin - {{ Voyager::setting("admin.title") }}</title>
    <link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}">
    @if (config('voyager.multilingual.rtl'))
        <link href="https://cdn.bootcss.com/bootstrap-rtl/3.4.0/css/bootstrap-rtl.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ voyager_asset('css/rtl.css') }}">
    @endif
    <style>
        body.login .login-container{
            width: 480px;
            left: 50%;
            top: 36%;
            margin: 0;
            transform: translate(-50%, -50%);
        }
        body.login .login-sidebar {
            border-top:5px solid {{ config('voyager.primary_color','#22A7F0') }};
        }
        body.login .login-button{
            font-size: 14px;
        }
        body.login .form-group-default label {
            font-size: 14px;
        }
        .login-header{
            margin-bottom: 30px;
        }
        .login-header h1{
            color: #22A7F0;
            letter-spacing: 1px;
            text-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
        }
        @media (max-width: 767px) {
            body.login .login-sidebar {
                border-top:0px !important;
                border-left:5px solid {{ config('voyager.primary_color','#22A7F0') }};
            }
        }
        body.login .form-group-default.focused{
            border-color:{{ config('voyager.primary_color','#22A7F0') }};
        }
        .login-button, .bar:before, .bar:after{
            background:{{ config('voyager.primary_color','#22A7F0') }};
        }
    </style>
</head>
<body class="login">
<div class="container-fluid">
    <div class="login-container">
        <div class="login-header">
            <h1>江苏致公参政议政智库</h1>
            <!-- <p>{{ Voyager::setting('admin.description', __('voyager::login.welcome')) }}</p> -->
        </div>

        <form action="{{ route('voyager.login') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group form-group-default" id="emailGroup">
                <label>{{ __('voyager::generic.name') }}</label>
                <div class="controls">
                    <input type="text" name="name" id="name" value="{{ old('name') }}"  class="form-control" required>
                 </div>
            </div>

            <div class="form-group form-group-default" id="passwordGroup">
                <label>{{ __('voyager::generic.password') }}</label>
                <div class="controls">
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
            </div>

            <button type="submit" class="btn-lg btn-block login-button pull-right">
                <span class="signingin hidden"><span class="voyager-refresh"></span> {{ __('voyager::login.loggingin') }}...</span>
                <span class="signin">{{ __('voyager::generic.login') }}</span>
            </button>

      </form>

      <div style="clear:both"></div>

      @if(!$errors->isEmpty())
      <div class="alert alert-red">
        <ul class="list-unstyled">
            @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
            @endforeach
        </ul>
      </div>
      @endif

    </div> <!-- .login-container -->
</div> <!-- .container-fluid -->
<script src="https://cdn.bootcss.com/three.js/56/three.min.js"></script>
<script>
    window.onload = function (){
        var btn = document.querySelector('button[type="submit"]');
        var form = document.forms[0];
        var name = document.getElementById('name');
        var password = document.getElementById('password');
        var passwordGroup = document.getElementById('passwordGroup');
        var emailGroup = document.getElementById('emailGroup');
        btn.addEventListener('click', function(ev){
            if (form.checkValidity()) {
                btn.querySelector('.signingin').className = 'signingin';
                btn.querySelector('.signin').className = 'signin hidden';
            } else {
                ev.preventDefault();
            }
        });
        name.focus();
        emailGroup.classList.add("focused");

        // Focus events for email and password fields
        name.addEventListener('focusin', function(e){
            emailGroup.classList.add("focused");
        });
        name.addEventListener('focusout', function(e){
            emailGroup.classList.remove("focused");
        });

        password.addEventListener('focusin', function(e){
            passwordGroup.classList.add("focused");
        });
        password.addEventListener('focusout', function(e){
            passwordGroup.classList.remove("focused");
        });        
    }
</script>
<script>
var SEPARATION = 125, AMOUNTX = 50, AMOUNTY = 50;

var container;
var camera, scene, renderer;

var particles, particle, count = 0;

var mouseX = 360, mouseY = -215;

var windowHalfX = window.innerWidth / 2;
var windowHalfY = window.innerHeight / 2;

init();
animate();

function init() {

    container = document.createElement( 'div' );
    document.body.appendChild( container );

    camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 1, 10000 );
    camera.position.z = 1000;

    scene = new THREE.Scene();

    particles = new Array();

    var PI2 = Math.PI * 2;
    var material = new THREE.ParticleCanvasMaterial( {

        color: 0x22A7F0,
        program: function ( context ) {

            context.beginPath();
            context.arc( 0, 0, 1, 0, PI2, true );
            context.fill();

        }

    } );

    var i = 0;

    for ( var ix = 0; ix < AMOUNTX; ix ++ ) {

        for ( var iy = 0; iy < AMOUNTY; iy ++ ) {

            particle = particles[ i ++ ] = new THREE.Particle( material );
            particle.position.x = ix * SEPARATION - ( ( AMOUNTX * SEPARATION ) / 2 );
            particle.position.z = iy * SEPARATION - ( ( AMOUNTY * SEPARATION ) / 2 );
            scene.add( particle );

        }

    }

    renderer = new THREE.CanvasRenderer();
    renderer.setSize( window.innerWidth, window.innerHeight );
    container.appendChild( renderer.domElement );

    //

    window.addEventListener( 'resize', onWindowResize, false );

}

function onWindowResize() {

    windowHalfX = window.innerWidth / 2;
    windowHalfY = window.innerHeight / 2;

    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();

    renderer.setSize( window.innerWidth, window.innerHeight );

}


function animate() {

    requestAnimationFrame( animate );

    render();


}

function render() {

    camera.position.x += ( mouseX - camera.position.x ) * .05;
    camera.position.y += ( - mouseY - camera.position.y ) * .05;
    camera.lookAt( scene.position );

    var i = 0;

    for ( var ix = 0; ix < AMOUNTX; ix ++ ) {

        for ( var iy = 0; iy < AMOUNTY; iy ++ ) {

            particle = particles[ i++ ];
            particle.position.y = ( Math.sin( ( ix + count ) * 0.3 ) * 50 ) + ( Math.sin( ( iy + count ) * 0.5 ) * 50 );
            particle.scale.x = particle.scale.y = ( Math.sin( ( ix + count ) * 0.3 ) + 1 ) * 2 + ( Math.sin( ( iy + count ) * 0.5 ) + 1 ) * 2;

        }

    }

    renderer.render( scene, camera );

    count += 0.1;

}
</script>
</body>
</html>
