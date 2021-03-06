<?php $activeMatch = $block->activeMatch(); ?>

<h2 style="letter-spacing: 0px;">

    @if($activeMatch !== null)

    @include('html.team.versus', array('block' => $block))

    @elseif($activeMatch == null && $block->isCurrentBlock())

        @if($block->matchesFinished())
            No More Live Games
        @else
            Live Games in {{ $block->timeFuture($block->dateTime) }} ({{ $block->lcsTime() }})
        @endif

    @else
        No More Live Games
    @endif
</h2>

<ol class="breadcrumb" style="{{ ($activeMatch !== null ? 'margin-top:14px;' : '') }} margin-bottom:-14px;">
    <li><a href="#" onclick="return false;">{{ $block->getLeague()->label }}</a></li>
    <li><a href="#" onclick="return false;">{{ $block->tournamentName }}</a></li>
    <li><a href="#" onclick="return false;">{{ substr($block->label, strpos($block->label, " - ") + 3) }}</a></li>

    @if($activeMatch !== null)
        <li class="active"><a href="#" onclick="return false;">{{ $activeMatch->matchName }}</a></li>
    @elseif($activeMatch == null && $block->isCurrentBlock())

        @if($block->matchesFinished())
            <li class="active">Finished</li>
        @else
            <li class="active">Scheduled</li>
        @endif

    @else
        <li class="active">Finished</li>
    @endif

    @if($activeMatch !== null && $activeMatch->maxGames > 1 && isset($block->requestedGame))
        <li><a href="#" onclick="return false;">Game {{ $activeMatch->getGames()[$block->getRequestedGame()]->gameNumber }}</a></li>
    @elseif($activeMatch !== null && $activeMatch->maxGames > 1)
        <li><a href="#" onclick="return false;">Game {{ $activeMatch->getGames()[0]->gameNumber }}</a></li>
    @endif
</ol>
