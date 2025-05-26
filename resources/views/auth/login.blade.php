<!DOCTYPE html>
<html lang="en">
 
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ABC - Login</title>
 
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
 
  <style>
   body{
    overflow-y:hidden;
  }
 
  @media only screen and (max-width:768px){
    body{
      overflow-y:scroll;
    }
  }
 
    .login-img,
    .login-form {
      padding: 0px;
    }
 
    .login-img .div {
      background-color: #2b3940;
      padding: 2.1875rem 2.8125rem 1rem 2.5rem;
      height: 100%;
    }
 
    .login-img .div h3 {
      color: white;
      line-height: 1.4;
      font-size: 1.5rem;
      margin-bottom: .625rem;
    }
 
    .login-img .div p {
      font-size: 1rem;
      line-height: 1.625;
      letter-spacing: -.08px;
      color: white;
    }
 
    .login-img .div img {
      width: 80%;
      display: block;
      margin: auto;
      margin-top: 20%;
      margin-bottom: 1.875rem !important;
    }
 
    .icons {
      display: flex;
      justify-content: space-between;
      border-top: 1px solid #ffffff12;
      margin-top: 10%;
      margin-bottom: 6%;
      flex-wrap: wrap;
    }
 
    .icons a {
      color: #6b6e6f;
      max-width: 56px;
      min-width: 56px;
      max-height: 56px;
      min-height: 56px;
      border-radius: 500px;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: white;
    }
 
    .icons a:hover {
      text-decoration: none;
    }
 
    .icons a i {
      font-size: 1.3125rem;
    }
 
    .input-group-append i {
      cursor: pointer;
    }
 
    .login-form {
      display: flex;
      justify-content: center;
      align-items: center;
    }
 
    .login-form .form-control {
      height: 3rem;
    }
 
    @media only screen and (max-width:400px) {
      .login-form .div1 {
        width: 100%;
        margin: 20px;
      }
    }
 
    .login-form .div1 {
      width: 400px;
      height: auto;
    }
 
    .login-form .div1 img {
      display: block;
      margin: auto;
    }
 
    .login-form .div1 label {
      font-weight: 600;
      line-height: 1;
      font-size: 1.10rem;
      letter-spacing: -.08px;
      margin-bottom: 12px;
      color: #2b3940;
    }
 
    .login-form .div1 .btn-info {
      width: 100%;
      height: 48px;
      line-height: 36px;
      font-size: 13px;
      font-weight: 700;
      margin-top: 20px;
    }
 
    .login-form .div1 .heading {
      font-size: 1rem;
      line-height: 1.625;
      letter-spacing: -.08px;
      color: #2b3940;
      text-align: center;
      font-weight: 600;
      margin-top: 10px;
    }
 
    #txt{
   display:flex;
   align-items:center;
   justify-content:center;
   flex:1;
   font-family:sans-serif;
   letter-spacing:3.5px;
   font-size:3.5rem;
   font-weight:700;
   position:relative;
   transform-style:preserve-3d;
   perspective:100px;
   -webkit-transform-style:preserve-3d;
   -webkit-perspective:100px;
}
    #txt>b{
      height:3.5rem;
      box-shadow:0 .4rem .3rem -.3rem #aaa;
      color:#979c9f;
      background:linear-gradient(#000000, #000000, rgb(81, 212, 251));
      background-clip:text;
      text-fill-color:transparent;
      -webkit-background-clip:text;
      -webkit-text-fill-color:transparent;
      transform-origin:bottom;
      transform:rotateX(-85deg);
      -webkit-transform-origin:bottom;
      -webkit-transform:rotateX(-85deg);
      animation:getUp 7s infinite;
    }
    #txt>b:nth-child(2){
      animation-delay:.25s;
    }
    #txt>b:nth-child(3){
      animation-delay:.5s;
    }
    #txt>b:nth-child(4){
      animation-delay:.75s;
    }
    #txt>b:nth-child(5){
      animation-delay:1s;
    }
    #txt>b:nth-child(6){
      animation-delay:1.25s;
    }
    #txt>b:nth-child(7){
      animation-delay:1.5s;
    }
    #txt>b:nth-child(8){
      animation-delay:1.75s;
    }
  @keyframes getUp{
    10%,50%{
        transform:rotateX(0);
    }
    0%,60%,100%{
        transform:rotateX(-85deg);
    }
  }


  .custom-alert {
        position: relative;
        padding: 15px 20px;
        border-radius: 8px;
        margin: 15px 0;
        font-size: 15px;
        font-weight: 500;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        border-left: 6px solid;
        transition: opacity 0.6s ease, transform 0.6s ease;
    }
 
    .alert-success {
        background-color: #e6f4ea;
        color: #276738;
        border-color: #4caf50;
    }
 
    .alert-danger {
        background-color: #fdecea;
        color: #b71c1c;
        border-color: #f44336;
    }
 
    .custom-alert.fade-out {
        opacity: 0;
        transform: translateY(-20px);
    }
 
  </style>
</head>
 
<body>



  
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 login-img" style="padding-left:0px !important;">
            <div class="div">
                <h3>HRMS</h3>
                <p>Log in to continue to your HRMS account</p>
                <img src="assets/images/icehrm-login.png" alt="icehrm-login loading...." />
 
 
                <div class="icons">
 
                    <a href="">
                        <i class="fa fa-linkedin-square"></i>
                    </a>
 
                    <a href="">
                        <i class="fa fa-facebook-square"></i>
                    </a>
 
                    <a href="">
                        <i class="fa fa-twitter-square"></i>
                    </a>
 
                    <a href="">
                        <i class="fa fa-github-square"></i>
                    </a>
 
                    <a href="">
                        <i class="fa fa-solid fa-bolt"></i>
                    </a>
 
                    <a href="">
                        <i class="fa fa-question-circle"></i>
                    </a>
 
                </div>
            </div>
        </div>
 
        <div class="col-xl-7 col-lg-7 col-md-6 col-sm-12 login-form">
            <div class="div1">
                <!-- <img src="assets/img/redianlogo.jpeg" alt="Logo"> -->
                <div class="txt" id="txt">
                    <b>A</b><b>B</b><b>C</b>&nbsp;<b>H</b><b>R</b><b>M</b><b>S</b>
                </div>
                <hr />
                {{-- {!! Toastr::message() !!} --}}
                @if (session('success'))
                    <div class="custom-alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
 
                @if (session('error'))
                    <div class="custom-alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
 
                @if ($errors->any())
                    <div class="custom-alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
 
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <label for="email">E-mail or Username</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" placeholder="Enter email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
 
                        <div class="col-12 mt-4">
                            <label for="password">Password</label>
                            <div class="input-group mb-3">
                                <input type="password" id ="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    placeholder="Enter Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2" onclick="toggleIcon()">
                                        <i id="icon" class="fa fa-solid fa-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
 
                        <div class="col-12">
                            <button class="btn btn-info">LOG IN</button>
                        </div>
 
                        <!-- <div class="col-12">
                  <p class="heading">
                     Can't remember your password? <br>
                    <a href="" class="text-info">Reset Password</a>
                  </p>
                </div> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function toggleIcon() {
        let icon = document.getElementById("icon");
        icon.className = icon.classList.contains("fa-eye-slash") ? "fa fa-solid fa-eye" : "fa fa-solid fa-eye-slash";
 
 
        let passwordField = document.getElementById("password");
 
        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.className = "fa fa-solid fa-eye-slash";
        } else {
            passwordField.type = "password";
            icon.className = "fa fa-solid fa-eye";
        }
    }
 
    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(function () {
            const alerts = document.querySelectorAll('.custom-alert');
            alerts.forEach(function (alert) {
                alert.classList.add('fade-out');
                setTimeout(() => alert.remove(), 600);
            });
        }, 5000);
    });
</script>
</body>
 
</html>
 