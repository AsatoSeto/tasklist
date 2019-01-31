<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
use App\Task;
use Illuminate\Http\Request;
Route::group(['middleware' => ['web']], function () {
    /**
     * Show Task Dashboard
     */
    Route::get('/', function () {
        return view('tasks', [
            'tasks' => Task::orderBy('created_at', 'asc')->get()
        ]);
    });

    /**
     * Add New Task
     */



    Route::post('/task', function (Request $request) {
        $datasessions = $request->session()->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        $dates= \Carbon\Carbon::now();
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        $task = new Task;
        if (empty($request->time))
        {
            $task->leftdate = \Carbon\Carbon::now()->addHour();
        }
        else
        {
            $task->leftdate = (\Carbon\Carbon::parse($request->time)->subHour(3));
        }
        $task->name = $request->name;
        $task->Username =Auth::user()->name;
        $task->userid = Auth::id();
        $task->checkers = '0';

        $task->save();
        return redirect('/');
    });
    /**
     * Delete Task
     */
    Route::delete('/task/{id}', function ($id) {
        Task::findOrFail($id)->delete();
        return redirect('/');
    });
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
