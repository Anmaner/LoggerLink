@extends('layouts.app')

@section('content')
<section class="content">
    <div class="container">
        @include('layouts.partials.flash')
        <div class="content__title">Logger information</div>
        @include('layouts.partials.logger_menu')
        <form method="POST">
            <div class="content__information">
                <div class="info__items info-items-border">
                    <div class="info__item">
                        <div class="info__item-title">Your link for logging</div>
                        <input type="text" class="info__item-value info__item-input"
                               value="{{ route('logger.follow', $logger->token) }}" disabled>
                    </div>
                    <div class="info__item">
                        <div class="info__item-title">Link for redirect after </div>
                        <input type="text" class="info__item-value info__item-input" name="redirect"
                               value="{{ old('redirect', $logger->redirect) }}">
                    </div>
                    <div class="info__item">
                        <div class="info__item-title">Code for access to statistics</div>
                        <input type="text" class="info__item-value info__item-input" name="code"
                               value="{{ old('code', $logger->code) }}">
                    </div>
                    <div class="info__item">
                        <div class="info__item-title">Enable / Disable link</div>
                        <div class="info__item-value">
                            <input type="hidden" name="status" value="0">
                            <input id="s1d" type="checkbox" class="switch"
                                   {{ $logger->status ? 'checked' : '' }} name="status" value="1">
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
