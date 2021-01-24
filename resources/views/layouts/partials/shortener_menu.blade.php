<div class="content__list">
    <nav>
        <ul class="content__list-inner">
            <a href="{{ route('shortener.information', $id) }}"><li><i class="fa fa-question-circle-o fa-less right-5" aria-hidden="true"></i> Logger information</li></a>
            <a href="{{ route('shortener.statistics', $id) }}"><li><i class="fa fa-bullseye fa-less right-5" aria-hidden="true"></i> General statistics</li></a>
            <a href="{{ route('shortener.redirect', $id) }}"><li><i class="fa fa-circle-o fa-less right-5" aria-hidden="true"></i> Redirect settings</li></a>
            <a href="{{ route('shortener.export', $id) }}"><li><i class="fa fa-dot-circle-o fa-less right-5" aria-hidden="true"></i> Statistics export</li></a>
        </ul>
    </nav>
</div>
