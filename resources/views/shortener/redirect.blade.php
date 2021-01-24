@extends('layouts.app')

@section('content')
<section class="content redirect shortener">
    <div class="container">
        <div class="content__title">Redirect settings</div>
        @include('layouts.partials.shortener_menu')
        <form method="POST">
            <div class="content__information">
                <div class="info__items info-items-border" id="info_items">
                    <div class="info__item">
                        <input type="text" class="country" name="country[]">
                        <input type="text" class="info__item-value info__item-input" name="value[]" value="https://loggerlink.ru/e94dh22j8i6">
                        <span class="info__item-remove"><i class="fa fa-times" aria-hidden="true"></i></span>
                    </div>
                    <div class="info__item">
                        <input type="text" class="country" name="country[]">
                        <input type="text" class="info__item-value info__item-input" name="value[]" value="https://loggerlink.ru/e94dh22j8i6">
                        <span class="info__item-remove"><i class="fa fa-times" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="item-new" id="new">NEW</div>
            <input type="submit" class="content__button submit" value="Save">
            @csrf()
        </form>
    </div>
</section>
@endsection
