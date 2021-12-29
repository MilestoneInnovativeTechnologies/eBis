@php use Illuminate\Support\Arr; $data = $data ?? [] @endphp<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ePlus Business Information System :: Setup</title>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <style type="text/css" rel="stylesheet">
    .register{background: -webkit-linear-gradient(left, #3931af, #00c6ff);margin-top: 3%;padding: 3%;}
    .register-left{text-align: center;color: #fff;}

    .register-right{background: #f8f9fa;border-top-left-radius: 10% 50%;border-bottom-left-radius: 10% 50%;}
    .register-left img{margin-top: 15%;margin-bottom: 5%;width: 25%;-webkit-animation: mover 2s infinite  alternate;animation: mover 1s infinite  alternate;}
    @-webkit-keyframes mover {
      0% { transform: translateY(0); }
      100% { transform: translateY(-20px); }
    }
    @keyframes mover {
      0% { transform: translateY(0); }
      100% { transform: translateY(-20px); }
    }
    .register-left p{font-weight: lighter;padding: 10px;}
    .register .register-form{padding: 0 10%;}
    .btnRegister{float: right;border: none;border-radius: 1.5rem;padding: 2%;background: #0062cc;color: #fff;font-weight: 600;width: 48%;cursor: pointer;margin: 0 1%}
    .register-heading{text-align: center; margin:20px 0;color: #495057;}
  </style>
</head>
<body>
<div class="container register">
  <div class="row">
    <div class="col-md-3 register-left">
      <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
      <h3>ePlus Business Information System</h3>
      <p>Setup requires you should be a valid customer of Milestone <br/> And must have a licenced copy of ePlus</p>
    </div>
    <div class="col-md-9 register-right">
      <form method="post">
        @csrf
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <h3 class="register-heading">ePlus Business Information System</h3>
            @if(isset($error)) <div class="text-center text-danger" style="margin: -20px auto 25px auto"> Error in fetching details!! </div> @endif
            <div class="row register-form">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="CODE" name="code" value="{{ empty($data) ? '' : $data['code'] }}"/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  @if(empty($data))
                    <input type="submit" value="Fetch Details" class="btnRegister">
                  @else
                    <select class="form-control" @if(!Arr::has($data,'subscriptions')) disabled @endif onchange="((value) => { f3 = ['package','start','end','host','database','username','password']; value.split('|').forEach((v,i) => document.querySelector('[name='+f3[i]+']').value = v);  })(this.value)">
                      <option>Select Subscription/Package</option>
                      @if(\Illuminate\Support\Arr::has($data,'subscriptions')) @foreach(Arr::get($data,'subscriptions') as $subscription)
                        <option value="{{ $subscription['package'] }}|{{ $subscription['start'] }}|{{ $subscription['end'] }}|{{ $subscription['host'] }}|{{ $subscription['database'] }}|{{ $subscription['username'] }}|{{ $subscription['password'] }}">{{ $subscription['package'] }}/({{ $subscription['start'] }}/{{ $subscription['end'] }})/{{ $subscription['status'] }}</option>
                      @endforeach @endif
                    </select>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" class="form-control" name="customer" placeholder="Customer Code" readonly value="{{ Arr::get($data,'customer.code') }}" required/>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="product" placeholder="Product" readonly value="{{ Arr::get($data,'product') }}" required/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="email" class="form-control" name="name" placeholder="Customer Name" readonly value="{{ Arr::get($data,'customer.name') }}" required/>
                </div>
                <div class="form-group">
                  <input type="text" name="package" class="form-control" placeholder="Package" readonly value="" required/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" name="start" class="form-control" placeholder="Start Date" readonly value="" required/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" name="end" class="form-control" placeholder="End Date" readonly value="" required/>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" name="database" class="form-control" placeholder="Database" @if(empty($data)) disabled @endif value="" required/>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" name="username" class="form-control" placeholder="Username" @if(empty($data)) disabled @endif value="" required/>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" name="password" class="form-control" placeholder="Password" @if(empty($data)) disabled @endif value="" required/>
                </div>
              </div>
              <input type="hidden" name="host" value="" required />
              <input type="reset" class="btnRegister" value="Cancel" style="margin-bottom: 20px" onclick="location.href = '/'" />
              <input type="submit" class="btnRegister" value="Register" style="margin-bottom: 20px" @if(!Arr::has($data,'subscriptions')) disabled @endif />
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>
