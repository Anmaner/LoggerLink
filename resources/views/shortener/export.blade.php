@extends('layouts.app')

@section('content')
    <section class="content shortener">
        <div class="container">
            @include('layouts.partials.flash')
            <div class="content__title">Statistics export</div>
            @include('layouts.partials.shortener_menu')
            <form method="POST" target="_blank">
                <div class="content__information content-border">
                    <div class="content-export">
                        <div class="content-settings content-settings-export">
                            <div class="content-settings__date content-settings__date-export">
                                <input type="text" class="content-settings__date-item" name="first_date" value="">
                                <span class="content-settings__date-line">-</span>
                                <input type="text" class="content-settings__date-item" name="second_date" value="">
                            </div>
                            <div class="content-settings__format">
                                <div class="content-settings__unique unique-text">
                                    Select format
                                </div>
                                <div class="content-settings__unique unique-first">
                                    <input id="r1" type="radio" name="type" value="txt" checked>
                                    <label for="r1">txt</label>
                                </div>
                                <div class="content-settings__unique">
                                    <input id="r2" type="radio" name="type" value="xml">
                                    <label for="r2">xml</label>
                                </div>
                                <div class="content-settings__unique">
                                    <input id="r3" type="radio" name="type" value="json">
                                    <label for="r3">json</label>
                                </div>
                            </div>
                        </div>
                        <div class="settings">
                            <div class="settings-bottom">
                                <div class="settings-bottom__items bottom-items__first">
                                    <div class="settings-bottom__item">
                                        <input id="c1d" type="checkbox" name="date" value="1" checked>
                                        <label for="c1d">Date</label>
                                    </div>
                                    <div class="settings-bottom__item">
                                        <input id="c2d" type="checkbox" name="ip" value="1" checked>
                                        <label for="c2d">IP</label>
                                    </div>
                                    <div class="settings-bottom__item">
                                        <input id="c3d" type="checkbox" name="country" value="1" checked>
                                        <label for="c3d">Country</label>
                                    </div>
                                    <div class="settings-bottom__item">
                                        <input id="c4d" type="checkbox" name="os" value="1" checked>
                                        <label for="c4d">OS</label>
                                    </div>
                                </div>
                                <div class="settings-bottom__items bottom-items__second">
                                    <div class="settings-bottom__item">
                                        <input id="c5d" type="checkbox" name="time" value="1" checked>
                                        <label for="c5d">Time</label>
                                    </div>
                                    <div class="settings-bottom__item">
                                        <input id="c6d" type="checkbox" name="provider" value="1" checked>
                                        <label for="c6d">Provider</label>
                                    </div>
                                    <div class="settings-bottom__item">
                                        <input id="c7d" type="checkbox" name="city" value="1" checked>
                                        <label for="c7d">City</label>
                                    </div>
                                    <div class="settings-bottom__item">
                                        <input id="c8d" type="checkbox" name="browser" value="1" checked>
                                        <label for="c8d">Browser</label>
                                    </div>
                                </div>
                            </div>
                            <div class="settings-main-bottom">
                                <div class="settings-bottom__item">
                                    <input id="c9d" type="checkbox" name="unique" value="1">
                                    <label for="c9d">Only unique users</label>
                                </div>
                                <div class="settings-bottom__item">
                                    <input id="c0d" type="checkbox" name="full" value="1">
                                    <label for="c0d">Full information</label>
                                </div>
                                <input type="hidden" name="from" value="1">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="content__button submit submit2" value="Export">
                @csrf()
            </form>
        </div>
    </section>
@endsection
