<?php
use Carbon\Carbon;
$dates = Carbon::now();
?>

@extends('layouts.app')
@section('content')
    <script type="text/javascript">
        function reload_content() {
            location.reload();
        }
        setInterval("reload_content()",1800000);
    </script>
    <div class="container">
        <div class= "col-sm-auto">
            <div class= "panel panel-default">
                @if(Auth::check())
                    <div class= "panel-heading">
                        <p id="txt" class="text text-sm-left"> </p>
                    </div>
                    <div class="panel-body">

                        <!-- Display Validation Error-->
                    @include('common.errors')
                    <!-- New Task Form -->
                        <form action="{{ url('task')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        <!-- Task Name -->
                            <div class="form-group">
                                <label for="task-name" class="col-md-auto control-label">Новая задача</label>
                                <div class="col-md-auto">
                                    <input type="text" name="name" id="task-name" class="form-control" value="{{ old('task') }}">
                                </div>
                                <div class="col-sm-4">
                                    <input type="datetime-local"  name="time" id="task_time" class="form-control" value="{{$dates->timezone('Europe/Moscow')->format('H:i:s d.m.Y')}}">
                                </div>
                            </div>

                            <!-- Add Task Button -->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        Добавить задачу
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
            <!-- Current Tasks -->
            @if (count($tasks) > 0)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-success ">
                            <thead class="thead-dark">
                                <th>Текущие задачи</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody>
                            @foreach ($tasks as $task)
                                <?php
                                    $raznica_chas = Carbon::parse($task->leftdate)->timezone('Europe/London')->timestamp - Carbon::now()->timezone('Europe/London')->timestamp;
                                ?>
                                <tr>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            @endif
        </div>
    </div>
@endsection



