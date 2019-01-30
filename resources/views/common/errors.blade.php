@if (count($errors)>0)
    <div class="alert alert-danger">
        <strong>Упс чот пошло не так</strong>
        <br><br>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif