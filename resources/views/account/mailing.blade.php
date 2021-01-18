@extends('layouts.app')

@section('content')
<section class="account-section bottom">
    <div class="container">
        @include('layouts.partials.flash')
        <div class="account account-mail">
            @include('layouts.partials.account_sections')
            <div class="account-content">
                <form action="{{ route('account.mailing') }}" method="POST">
                    <div class="account-content-item">
                        <div class="content-title">Mailing settings</div>
                        <div class="content-checkbox">
                            <div class="content-checkbox__item">
                                <div class="content-checkbox__text checkbox-1">Promotions and special offers</div>
                                <input type="hidden" name="offers" value="0">
                                <input class="switch content-checkbox-switch" id="s2d" type="checkbox" name="offers"
                                       value="1" {{ $notification->offers ? 'checked' : '' }}>
                            </div>
                            <div class="content-checkbox__item">
                                <div class="content-checkbox__text checkbox-2">Project news</div>
                                <div class="content-checkbox__input">
                                    <input type="hidden" name="news" value="0">
                                    <input class="switch" id="s2d" type="checkbox" name="news"
                                           value="1" {{ $notification->news ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="account-content-item">
                        <div class="content-title">Browser notifications</div>
                        <div class="content-checkbox">
                            <div class="content-checkbox__item">
                                <div class="content-checkbox__text checkbox-3">Enable browser notifications</div>
                                <input type="hidden" name="browser" value="0">
                                <input class="switch content-checkbox-switch" id="s2d" type="checkbox" name="browser"
                                       value="1" {{ $notification->browser ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="content__button auth-content__buttons-signin submit" value="Send">
                    @csrf()
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
