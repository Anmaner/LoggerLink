@extends('layouts.app')

@section('content')
<section class="content">
    <div class="container">
        @include('layouts.partials.flash')
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
                                <input id="c1" type="checkbox" name="unique" value="1" {{ request('unique') ? 'checked' : '' }}>
                                <label for="c1">Only unique users</label>
                            </div>
                            <div class="content-settings__unique-stat content-settings__unique-stat-second">
                                <input type="hidden" name="full" value="0">
                                <input id="c2" type="checkbox" name="full" value="1" {{ request('full') ? 'checked' : '' }}>
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
                    @foreach($follows as $follow)
                    <div class="content-data__value">
                        <div class="content-data__value-item">
                            <span class="value-item">{{ $follow->created_at->format('d-m-Y') }}</span>
                            <span class="value-item">{{ $follow->created_at->format('h:i:s') }}</span>
                        </div>
                        <div class="content-data__value-item">
                            <span class="value-item">{{ $follow->ip }}</span>
                            <span class="value-item">{{ $follow->provider }}</span>
                        </div>
                        <div class="content-data__value-item">
                            <span class="value-item">{{ $follow->country }}</span>
                            <span class="value-item">{{ $follow->city }}</span>
                        </div>
                        <div class="content-data__value-item">
                            <span class="value-item">{{ $follow->os }}</span>
                            <span class="value-item">{{ $follow->browser }}</span>
                        </div>
                        <div class="content-data__value-item">{{ $follow->from }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
