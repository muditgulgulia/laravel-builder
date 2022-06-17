<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title')</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="{{ url('frontend/theme/js/3.2.1_jquery.min.js') }}"></script>
<script src="{{ url('frontend/theme/js/3.3.7_bootstrap.min.js') }}"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<link href="{{url('frontend/theme/css/bootswatch/'.$selectedTheme->selected_theme.'_bootstrap.css')}}"
      rel="stylesheet" type="text/css">

