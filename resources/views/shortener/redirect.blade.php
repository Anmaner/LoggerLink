@extends('layouts.app')

@section('content')
<section class="content redirect shortener">
    <div class="container">
        @include('layouts.partials.flash')
        <div class="content__title">Redirect settings</div>
        @include('layouts.partials.shortener_menu')
        <form method="POST">
            <div class="content__information">
                <div class="info__items info-items-border" id="info_items">
                    @if($old = old())
                        @foreach($old['country'] as $num=>$country)
                            <div class="info__item">
                                <input type="text" class="country" name="country[]" value="{{ $old['country'][$num] }}">
                                <input type="text" class="info__item-value info__item-input" name="url[]" value="{{ $old['url'][$num] }}">
                                <span class="info__item-remove"><i class="fa fa-times" aria-hidden="true"></i></span>
                            </div>
                        @endforeach
                    @else
                        @foreach($redirects as $redirect)
                            <div class="info__item">
                                <input type="text" class="country" name="country[]" value="{{ $redirect->country->name }}">
                                <input type="text" class="info__item-value info__item-input" name="url[]" value="{{ $redirect->url }}">
                                <span class="info__item-remove"><i class="fa fa-times" aria-hidden="true"></i></span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="item-new" id="new">NEW</div>
            <input type="submit" class="content__button submit" value="Save">
            @csrf()
        </form>
    </div>
</section>
@endsection
