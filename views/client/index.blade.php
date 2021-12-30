@php
  use \Illuminate\Support\Facades\Auth;
  use \Milestone\eBis\Controller\AssetController;
@endphp<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ePlus Business Information System</title>

  <link rel=manifest href=manifest.json>
  <link rel=mask-icon href=icons/safari-pinned-tab.svg color=#027be3>

  <meta name=theme-color content=#027be3>
  <meta name=apple-mobile-web-app-capable content=yes>
  <meta name=apple-mobile-web-app-status-bar-style content=default>
  <meta name=apple-mobile-web-app-title content=eBis>

  <meta name=msapplication-TileImage content=icons/ms-icon-144x144.png>
  <meta name=msapplication-TileColor content=#000000>

  <link rel=icon type=image/ico href=favicon.ico>
  <link rel=icon type=image/png sizes=128x128 href=icons/favicon-128x128.png>
  <link rel=icon type=image/png sizes=96x96 href=icons/favicon-96x96.png>
  <link rel=icon type=image/png sizes=32x32 href=icons/favicon-32x32.png>
  <link rel=icon type=image/png sizes=16x16 href=icons/favicon-16x16.png>
  <link rel="apple-touch-startup-image" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)" href="icons/apple-launch-828x1792.png">
  <link rel="apple-touch-startup-image" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)" href="icons/apple-launch-1125x2436.png">
  <link rel="apple-touch-startup-image" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)" href="icons/apple-launch-1242x2688.png">
  <link rel="apple-touch-startup-image" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" href="icons/apple-launch-750x1334.png">
  <link rel="apple-touch-startup-image" media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3)" href="icons/apple-launch-1242x2208.png">
  <link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" href="icons/apple-launch-640x1136.png">
  <link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)" href="icons/apple-launch-1536x2048.png">
  <link rel="apple-touch-startup-image" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)" href="icons/apple-launch-1668x2224.png">
  <link rel="apple-touch-startup-image" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)" href="icons/apple-launch-1668x2388.png">
  <link rel="apple-touch-startup-image" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)" href="icons/apple-launch-2048x2732.png">
  <link rel=apple-touch-icon href=icons/apple-icon-120x120.png>
  <link rel=apple-touch-icon sizes=152x152 href=icons/apple-icon-152x152.png>
  <link rel=apple-touch-icon sizes=167x167 href=icons/apple-icon-167x167.png>
  <link rel=apple-touch-icon sizes=180x180 href=icons/apple-icon-180x180.png>

  <script>const LOGOUT = '{!! route('logout') !!}';</script>
  <script src="{!! AssetController::JSRoute('widget_master') !!}"></script>
  <script src="{!! AssetController::JSRoute('layouts') !!}"></script>
  <script src="{!! AssetController::JSRoute('sections') !!}"></script>
  <script src="{!! AssetController::JSRoute('company') !!}"></script>
  <script src="{!! AssetController::JSAuthRoute('auth') !!}"></script>
  <script src="{!! AssetController::JSAuthRoute('pages') !!}"></script>
  <script src="{!! AssetController::JSAuthRoute('widgets') !!}"></script>
  <script src="{!! AssetController::JSAuthRoute('widget') !!}"></script>

</head>
<body>
  <div id="q-app"></div>
@php
$dev = env('DEV') === '1';
$files = json_decode(@file_get_contents(public_path('pack.json')),true);
@endphp
@if($dev)
    <base href="http://localhost:8080">
    <script src=vendor.js></script>
    <script src=app.js></script>
@else
    @foreach($files['css'] as $type => $file) <link href=css/{{ $type }}.{{ $file }}.css rel=stylesheet> @endforeach
    @foreach($files['js'] as $type => $file) <script src=js/{{ $type  }}.{{ $file }}.js></script> @endforeach
@endif

</body>
</html>
