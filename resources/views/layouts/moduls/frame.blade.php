<?php
use Carbon\Carbon;
$dates = Carbon::now();
?>
<div class="kim">
    @foreach ($tasks as $task)
        <?php
        $raznica_chas = Carbon::parse($task->leftdate)->timezone('Europe/London')->timestamp - Carbon::now()->timezone('Europe/London')->timestamp;
        ?>

        <tr id="cont">
            @if($task->userid == Auth::id() or Auth::user()->name == 'Administrator')
                @if($raznica_chas>3600)
                    @include('layouts.moduls.plit_table')
                @endif

                @if($raznica_chas <= 3600 and $raznica_chas > 0)
                    @include('layouts.moduls.Notificator')
                    @include('layouts.moduls.plit_table_warning')
                @endif

                @if($raznica_chas<=0)
                    @include('layouts.moduls.plit_table_bad')
                @endif
            @endif
        </tr>
    @endforeach
</div>

