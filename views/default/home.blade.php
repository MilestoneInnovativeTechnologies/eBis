
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>ePlus Business Information System</title>
    <base href="https://templatemo.com/templates/templatemo_525_the_town/" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/templatemo-style.css" />
</head>
<body>
<section id="hero" class="text-white tm-font-big tm-parallax">
    <div class="text-center tm-hero-text-container">
        <div class="tm-hero-text-container-inner">
            <h2 class="tm-hero-title">eBis</h2>
            <p class="tm-hero-subtitle">
                ePlus Business Information System
                <br /><i style="font-size:14px">by Milestone Innovative Technologies</i>
            </p>
        </div>
      @if(session()->has('info'))<h6>{{ session()->get('info') }}</h6>@endif
    </div>
</section>
</body>
</html>
