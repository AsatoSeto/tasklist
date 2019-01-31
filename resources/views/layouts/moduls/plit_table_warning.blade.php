<td class="table-text table-warning">
    <div>{{ $task->name }}</div>
</td>
<td class="table-text table-warning">
    <div>Выполнить до: {{\Carbon\Carbon::parse($task->leftdate)->timezone('Europe/Moscow')->format('H:i:s d.m.Y')}}</div>
</td>
<td class="table-text table-warning">
    <div>Добавил: {{$task->Username}}</div>
    <div>Создана: {{$task->created_at->timezone('Europe/Moscow')->format('H:i:s d.m.Y')}}</div>
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