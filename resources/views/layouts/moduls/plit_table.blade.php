<td class="table-text">
    <div>{{ $task->name }}</div>
</td>
<td>
    <div>Выполнить до: {{\Carbon\Carbon::parse($task->leftdate)->timezone('Europe/Moscow')->format('H:i:s d.m.Y')}}</div>
</td>
<td>
    <div>Добавил: {{$task->Username}}</div>
    <div>Создана: {{$task->created_at->timezone('Europe/Moscow')->format('H:i:s d.m.Y')}}</div>

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