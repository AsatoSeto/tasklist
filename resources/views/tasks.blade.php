<?php
use Carbon\Carbon;
$dates = Carbon::now();
?>

@extends('layouts.app')
@section('content')

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
                    <div class="panel-body" id="kon">
                        <table class="table table-success " >
                            <thead class="thead-dark">
                                <th>Текущие задачи</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody  >
                            <div class="table-container">
                                <div id="cone">
                                    @include('layouts.moduls.frame')
                                </div>
                            </div>
                            </tbody>
                        </table>
                    </div>
                    <script>
                        function reload_content() {
                            $('#kon').load('/ #kon');
                        }
                        setInterval("reload_content()",30000);
                    </script>
                </div>
            @endif
            @endif
        </div>
    </div>
@endsection




