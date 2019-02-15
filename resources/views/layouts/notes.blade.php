@extends('layouts.app')
@section('content')
    @if(@Auth::check())
        <div class="container">
            <div class="col-sm-auto">
                <div class= "panel-heading float-left">
                    <p id="txt" class="text text-sm-left"> </p>
                </div>
                <form action="{{ url('notes')}}" method="POST" class="form-text">
                {{ csrf_field() }}
                <!-- Task Name -->
                    <div class="form-group">

                        <div class="col-md-auto">
                            <input type="text" name="note" id="note-name" class="form-control" >
                        </div>
                    </div>

                    <!-- Add Task Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Добавить заметку</button>
                    </div>
                </form>

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
                                @foreach($notes as $note)
                                    @if($note->userid == Auth::id() or Auth::user()->name == 'Administrator')
                                        <tr>
                                            <td class="table-text">
    
                                                <div>Добавил: {{$note->Username}}</div>
                                            </td>
                                            <td>
                                                <div>{{ $note->note }}</div>
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                                <form action="{{ url('notes/'.$note->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-btn fa-trash"></i>Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
    
                                 @endforeach
                            </div>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
@endif
@endsection