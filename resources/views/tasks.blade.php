<?php
use Carbon\Carbon;
$dates = Carbon::now();?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <button onclick="notifyMe()">Показать уведомление</button>
        <div class= "col-md-auto">
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
                                            <td class="table-text">
                                                <div>{{ $task->name }}</div>
                                            </td>
                                            <td>
                                                <div>Создана: {{$task->created_at->timezone('Europe/Moscow')->format('H:i:s d.m.Y')}}</div>
                                            </td>
                                            <td>
                                                <div>Добавил: {{$task->Username}}</div>
                                                <div>Выполнить до: {{Carbon::parse($task->leftdate)->timezone('Europe/Moscow')->format('H:i:s d.m.Y')}}</div>
                                            </td>
                                            <!-- Task Delete Button -->
                                            <td>
                                                <form action="{{ url('task/'.$task->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-btn fa-trash"></i>Delete
                                                    </button>
                                                </form>
                                            </td>
                                        @endif
                                        @if($raznica_chas <= 3600 and $raznica_chas > 0)
                                            <?php

                                               echo '<script type="text/javascript">notifyMe();</script>';
                                                ?>
                                            <td class="table-text table-warning">
                                                <div>{{ $task->name }}</div>
                                            </td>
                                            <td class="table-text table-warning">
                                                <div>Создана: {{$task->created_at->timezone('Europe/Moscow')->format('H:i:s d.m.Y')}}</div>
                                            </td>
                                            <td class="table-text table-warning">
                                                <div>Добавил: {{$task->Username}}</div>
                                                <div>Выполнить до: {{Carbon::parse($task->leftdate)->timezone('Europe/Moscow')->format('H:i:s d.m.Y')}}</div>
                                                <div>Осталось менее часа</div>
                                            </td>
                                            <!-- Task Delete Button -->
                                            <td class="table-text table-warning">
                                                <form action="{{ url('task/'.$task->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-btn fa-trash"></i>Delete
                                                    </button>
                                                </form>
                                            </td>
                                        @endif
                                        @if($raznica_chas<=0)
                                            <td class="table-text table-danger">
                                                <div>{{ $task->name }}</div>
                                            </td>
                                            <td class="table-text table-danger">
                                                <div>Создана: {{$task->created_at->timezone('Europe/Moscow')->format('H:i:s d.m.Y')}}</div>
                                            </td>
                                            <td class="table-text table-danger">
                                                <div>Добавил: {{$task->Username}}</div>
                                                <div>Выполнить до: {{Carbon::parse($task->leftdate)->timezone('Europe/Moscow')->format('H:i:s d.m.Y')}}</div>
                                                <div>Время истекло</div>
                                            </td>
                                            <!-- Task Delete Button -->
                                            <td class="table-text table-danger">
                                                <form action="{{ url('task/'.$task->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-btn fa-trash"></i>Delete
                                                    </button>
                                                </form>
                                            </td>
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
