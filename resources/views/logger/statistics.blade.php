@extends('layouts.app')

@section('content')
<section class="content">
    <div class="container">
        <div class="content__title">General statistics</div>
        @include('layouts.partials.logger_menu')
        <div class="content__information content-border">
            <form method="GET">
                <div class="content-settings">
                        <div class="content-settings__date">
                            <input type="text" class="content-settings__date-item" name="first_date" value="{{ request('first_date') ?: '' }}">
                            <span class="content-settings__date-line">-</span>
                            <input type="text" class="content-settings__date-item" name="second_date" value="{{ request('second_date') ?: '' }}">
                        </div>
                        <div class="content-buttons">
                            <div class="content-settings__unique-stat content-settings__unique-stat-first">
                                <input id="c1" type="checkbox" name="unique" {{ request('unique') ? 'checked' : '' }}>
                                <label for="c1">Only unique users</label>
                            </div>
                            <div class="content-settings__unique-stat content-settings__unique-stat-second">
                                <input id="c2" type="checkbox" name="full" {{ request('full') ? 'checked' : '' }}>
                                <label for="c2">Full information</label>
                            </div>
                        </div>
                        <input type="submit" class="content-settings__button submit submit2" value="Request">
                </div>
            </form>

            <div class="content-data">
                <div class="content-data__title">
                    <div class="content-data__title-item">Time</div>
                    <div class="content-data__title-item">IP/Provider</div>
                    <div class="content-data__title-item">Country/City</div>
                    <div class="content-data__title-item">Device</div>
                    <div class="content-data__title-item">From where</div>
                </div>
                <div class="content-data__items" id="stat_remove_last_item">
                    <div class="content-data__value">
                        <div class="content-data__value-item">
                            <span class="value-item">05.10.2020</span>
                            <span class="value-item">18:56:18</span>
                        </div>
                        <div class="content-data__value-item">
                            <span class="value-item">34.46.119.87</span>
                            <span class="value-item">Telekom</span>
                        </div>
                        <div class="content-data__value-item">
                            <span class="value-item">German</span>
                            <span class="value-item">Berlin</span>
                        </div>
                        <div class="content-data__value-item">
                            <span class="value-item">Windows</span>
                            <span class="value-item">Chrome</span>
                        </div>
                        <div class="content-data__value-item">Unknown</div>
                    </div>
                    <div class="content-data__value">
                        <div class="content-data__value-item">
                            <span class="value-item">05.10.2020</span>
                            <span class="value-item">20:43:31</span>
                        </div>
                        <div class="content-data__value-item">
                            <span class="value-item">93.75.46.98</span>
                            <span class="value-item">Volia Kiev</span>
                        </div>
                        <div class="content-data__value-item">
                            <span class="value-item">Ukraine</span>
                            <span class="value-item">Kiev</span>
                        </div>
                        <div class="content-data__value-item">
                            <span class="value-item">Windows</span>
                            <span class="value-item">Chrome</span>
                        </div>
                        <div class="content-data__value-item">Unknown</div>
                    </div>
                    <div class="content-data__value">
                        <div class="content-data__value-item">
                            <span class="value-item">06.10.2020</span>
                            <span class="value-item">15:50:36</span>
                        </div>
                        <div class="content-data__value-item">
                            <span class="value-item">34.91.31.250</span>
                            <span class="value-item">Orange</span>
                        </div>
                        <div class="content-data__value-item">
                            <span class="value-item">Poland</span>
                            <span class="value-item">Warsaw</span>
                        </div>
                        <div class="content-data__value-item">
                            <span class="value-item">Windows</span>
                            <span class="value-item">Chrome</span>
                        </div>
                        <div class="content-data__value-item">Unknown</div>
                    </div>
                    <div class="content-data__value">
                        <div class="content-data__value-item">
                            <span class="value-item">07.10.2020</span>
                            <span class="value-item">19:15:49</span>
                        </div>
                        <div class="content-data__value-item">
                            <span class="value-item">163.112.215.6</span>
                            <span class="value-item">Telenor</span>
                        </div>
                        <div class="content-data__value-item">
                            <span class="value-item">Denmark</span>
                            <span class="value-item">Copenhagen</span>
                        </div>
                        <div class="content-data__value-item">
                            <span class="value-item">Windows</span>
                            <span class="value-item">Chrome</span>
                        </div>
                        <div class="content-data__value-item">Unknown</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
