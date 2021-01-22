@extends('layouts.app')

@section('content')
<section class="about bottom">
    <div class="container">
        <div class="title general-title">
            How it works?
        </div>
        <div class="service">

            <div class="service-main-item">
                <div class="descritpion descritpion-first">
                    LoggerLink - Service tha allows you to find out information about a person by sending links. And also collect statistics on link clicks.
                    Logger - generates a link that can be sent to a person and find out various information about - IP, provider, country, city, device etc.
                    Shortener - accepts your link and generates a new, shortened one, which you can place on your service and collect information about people who clicked.
                </div>
            </div>

            <div class="service-item">
                <div class="descritpion">
                    Logger information - menu for logger/shortener creation.<br>
                    Your link for logging - here will be your link for logging.<br>
                    Link for redirect after - link where the redirect will be made after clicking.<br>
                    Password for access to statistics - restrict free access to the statistics menu using the given password.<br>
                    Enable / Disable link - enable or disable link and collection of information.
                </div>
                <div class="image">
                    <img src="{{ asset('storage/img/about-creation.png') }}" alt="" width="900px">
                </div>
            </div>

            <div class="service-item">
                <div class="descritpion">
                    General statistics - table where data is collected on users who followed your link.<br>
                    Time - date and time when user clicked on your link.<br>
                    IP/Provider - User's ip and his internet provider.<br>
                    Country/City - User's country and city.<br>
                    Device - User's OC and browser.<br>
                    From where - from which site the user followed your link.<br>
                </div>
                <div class="image">
                    <img src="{{ asset('storage/img/about-statistics.png') }}" alt="" width="900px">
                </div>
            </div>

            <div class="service-item">
                <div class="descritpion">
                    Statistics export - export the collected information in a format convenient for you.<br>
                    In the left top column you can select the date range.<br>
                    In the right top column you can select needed format.<br>
                    Only unique users - export the same users only once.<br>
                    Full information - export full user's data including "From where" field.
                </div>
                <div class="image">
                    <img src="{{ asset('storage/img/about-export.png') }}" alt="" width="900px">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
