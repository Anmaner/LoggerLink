@extends('layouts.app')

@section('content')
<section class="main">
    <div class="title">
        Create Logger link for your goal
    </div>
    <div class="blocks">
        <div class="block">
            <div class="block-title">
                Logger
            </div>
            <div class="block-text">
                Generates a link that can be sent to a person and find out various information. You send the link, the person follows it, after you can go to your account and receive information about all the click on the link. The information you can get - IP, provider, country, city, device etc. With logger service you also can export all received information in a convenient format - txt, xml or xls. Before using, read the site terms of use.
            </div>
        </div>
        <div class="block">
            <div class="block-title">
                Shortener
            </div>
            <div class="block-text">
                Accepts your link and generates a new, shortened one, which you can place on your service and collect information about people who clicked. You can set various filters for links. Users from different countries can be redirected to different web addresses at your request. With shortener you also can export all received information in a convenient format - txt, xml or xls. Before using, read the site terms of use.
            </div>
        </div>
    </div>
    <div class="link">
        <a href="create_page.html" class="link__button">
            Create Logger now
        </a>
        <a href="create_page_shortener.html" class="link__button">
            Create Shortener now
        </a>
    </div>
   <div class="link-button">
        <a href="{{ route('about') }}" class="link__beside">
            Read more about
        </a>
   </div>
</section>
@endsection
