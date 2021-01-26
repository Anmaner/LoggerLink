<div class="content__list">
    <nav>
        <ul class="content__list-inner">
            <a href="{{ route('logger.information', $logger->token) }}"><li><i class="fa fa-question-circle-o fa-less right-5" aria-hidden="true"></i> Logger information</li></a>
            <a href="{{ route('logger.statistics', $logger->token) }}"><li><i class="fa fa-bullseye fa-less right-5" aria-hidden="true"></i> General statistics</li></a>
            <a href="{{ route('logger.export', $logger->token) }}"><li><i class="fa fa-dot-circle-o fa-less right-5" aria-hidden="true"></i> Statistics export</li></a>
        </ul>
    </nav>
</div>
