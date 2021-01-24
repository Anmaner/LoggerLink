@extends('layouts.app')

@section('content')
<section class="content shortener">
    <div class="container">
        <div class="content__title">Shortener information</div>
        @include('layouts.partials.shortener_menu')
        <form method="POST">
            <div class="content__information">
                <div class="info__items info-items-border">
                    <div class="info__item">
                        <div class="info__item-title">Your link for logging</div>
                        <input type="text" value="https://loggerlink.ru/e94dh22j8i6" class="info__item-value info__item-input" disabled>
                    </div>
                    <div class="info__item">
                        <div class="info__item-title">Link for redirect after </div>
                        <input type="text" class="info__item-value info__item-input" name="redirect">
                    </div>
                    <div class="info__item">
                        <div class="info__item-title">Password for access to statistics</div>
                        <input type="text" class="info__item-value info__item-input" name="password">
                    </div>
                    <div class="info__item">
                        <div class="info__item-title">Enable / Disable link</div>
                        <div class="info__item-value">
                            <input id="s1d" type="checkbox" class="switch" checked name="status">
                            <label for="s1d">Switch</label>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" class="content__button submit" value="Save">
            @csrf()
        </form>
    </div>
</section>
@endsection
