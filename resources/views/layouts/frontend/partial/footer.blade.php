<div class="container-fluid well well-sm" align="center">
    <small>&copy; Frontend Footer</small>
    @if(isset($pages))
        <ul>
            @foreach($pages as $page)
                @if($page->menu_option == 'footer' || $page->menu_option == 'both')
                    <li {!! Request::is('/') ? 'class="active"' : '' !!} style="list-style-type: none;">
                        <small> {!! link_to('pages/'.$page->slug, trans(ucwords($page->title))) !!}</small>
                    </li>
                @endif
            @endforeach
        </ul>
    @endif
</div>