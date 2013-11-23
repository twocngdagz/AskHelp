<?php


class TasksController extends BaseController {

	public function tasks()
	{
		$tasks = Task::all();
		return View::make('tasks.tasks')->with('tasks',$tasks);
	}

	public function newtask()
	{
		return View::make('tasks.new');
	} 


	public function save()
	{
		$input = Input::all();
		Task::create(array(
			'title' => $input['title'],
			'due_date' => date("Y-m-d",strtotime($input['due_date']))
		));
		return Redirect::to('tasks');
	}

	public function show($id)
	{
		$task = Task::findOrFail($id);
		return View::make('tasks.show')->with('task', $task);
	}

	public function edit()
	{
		$id = Input::get('id');
		$task = Task::find($id);
		$task->completed = Input::get('completed');
		$task->save();
	}

	public function edit_all()
	{
		$id = Input::get('id');
		$task = Task::find($id);
		$task->title = Input::get('title');
		$task->due_date = date("Y-m-d",strtotime(Input::get('due_date')));
		$task->save();
		return Redirect::to('tasks');
	}

	public function delete()
	{
		$id = Input::get('id');
		$task = Task::find($id);
		$task->delete();
		return Redirect::to('tasks');
	}

}

?>