@if($selectedTheme->breadcrumb)
    <ul class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li class="active">{{isset($slug) ? ucwords($slug) : (isset($panelTitle) ? $panelTitle : config('app.name')) }}</li>
    </ul>
@endif