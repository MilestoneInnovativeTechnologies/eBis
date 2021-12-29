<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>eBis :: Login</title>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <style>
    :root {
      --input-padding-x: 1.5rem;
      --input-padding-y: .75rem;
    }
    body {background: #007bff;background: linear-gradient(to right, #0062E6, #33AEFF);}
    .card-signin {border: 0;border-radius: 1rem;box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);overflow: hidden;}
    .card-signin .card-title {margin-bottom: 2rem;font-weight: 300;font-size: 1.5rem;}
    .card-signin .card-img-left {width: 45%; background: scroll center url('https://i.pinimg.com/originals/49/84/42/49844238703abbc11d1c069da726a89d.jpg'); background-size: cover;}
    .card-signin .card-body {padding: 2rem;}
    .form-signin {width: 100%;}
    .form-signin .btn {font-size: 80%;border-radius: 5rem;letter-spacing: .1rem;font-weight: bold;padding: 1rem;transition: all 0.2s;}
    .form-label-group {position: relative;margin-bottom: 1rem;}
    .form-label-group input {height: auto;border-radius: 2rem;}
    .form-label-group>input {padding: var(--input-padding-y) var(--input-padding-x);}
    .form-label-group>label {padding: var(--input-padding-y) var(--input-padding-x);}
    .form-label-group>label {position: absolute;top: 0;left: 0px;display: block;width: 100%;margin-bottom: 0; /* Override default `<label>` margin */line-height: 1.5;color: #495057;border: 1px solid transparent;border-radius: .25rem;transition: all .1s ease-in-out;}
    .form-label-group input::-webkit-input-placeholder {color: transparent;}
    .form-label-group input:-ms-input-placeholder {color: transparent;}
    .form-label-group input::-ms-input-placeholder {color: transparent;}
    .form-label-group input::-moz-placeholder {color: transparent;}
    .form-label-group input::placeholder {color: transparent;}
    .form-label-group input:not(:placeholder-shown) {padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));padding-bottom: calc(var(--input-padding-y) / 3);}
    .form-label-group input:not(:placeholder-shown)~label {padding-top: calc(var(--input-padding-y) / 3);padding-bottom: calc(var(--input-padding-y) / 3);font-size: 12px;color: #777;}
  </style>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-lg-10 col-xl-9 mx-auto" style="display: flex; flex-direction: column; justify-content: center; height: 100vh">
      <div class="card card-signin flex-row my-5">
        <div class="card-img-left d-none d-md-flex" style="align-items: center">
          <!-- Background image for card set in CSS! -->
          <h2 class="text-center" style="margin: auto">ePlus Business Information System</h2>
        </div>
        <div class="card-body">
          <h5 class="card-title text-center">Login</h5>
          @if(session()->has('error')) <div class="text-danger text-center" style="margin-bottom: 5px">{{ session('error') }}</div> @endif
          <form class="form-signin" method="post">@csrf

            <div class="form-label-group" style="margin-bottom: 20px">
              <input id="username" name="email" type="text" class="form-control" placeholder="Username" required autofocus value="">
              <label for="username">Username</label>
            </div>

            <div class="form-label-group">
              <input id="password" name="password" type="password" class="form-control" placeholder="Password" value="">
              <label for="password">Password</label>
            </div>
            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
