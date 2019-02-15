<?php
use Carbon\Carbon;
$dates = Carbon::now();
?>

@extends('layouts.app')
@section('content')

    <div class="container">
        @include('layouts.moduls.modalForm')
        <div class= "col-sm-auto">
            <div class= "panel panel-default">
                @if(Auth::check())
                    <div class="container">
                        <div class= "panel-heading float-left">
                            <p id="txt" class="text text-sm-left"> </p>
                        </div>
                        <div class="text-right">
                            <a href="#" class="btn btn-lg btn-success" data-toggle="modal" data-target="#basicModal">
                                Добавить задачу
                            </a>
                        </div>
                    </div>
                    <div>
                        </br>
                    </div>
                    <div class="panel-body">
                        @include('common.errors')
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




