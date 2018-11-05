<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Worker;
use App\Position;
use Validator;
use Image;

class WorkersController extends Controller
{
	private $data = [];

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function createWorker()
	{
		$this->data['positions'] = Position::all();
		$this->data['workers'] = Worker::all();

		return view('create', $this->data);
	}

	public function saveWorker(Request $request)
	{
		$request->validate([
			'full_name' => 'required|string|max:255',
			'salary' => 'required|string',
			'position' => 'required|numeric',
			'avatar' => 'file|image|mimes:jpeg,png'
		]);

		$worker = new Worker;

		if ($request->hasFile('avatar'))
		{
			$img = $request->file('avatar');

			$avatar = Image::make($img)->encode($img->getClientOriginalExtension());

			$fileName = time() . '-' . str_slug($request->full_name, '_') . '.' . $img->getClientOriginalExtension();
			$filePath = storage_path('app/public/avatars') . '/' . $fileName;

			$avatar->save($filePath);

			$worker->avatar = '/storage/avatars/' . $fileName;
		}

		$worker->name = $request->full_name;
		$worker->salary = $request->salary;
		$worker->position_id = $request->position;
		$worker->worker_id = $request->boss;
		$worker->accepted_at = $request->accepted_at;

		$worker->save();

		return redirect()->back()->with(['status' => 'Worker saved!']);
	}

	public function deleteWorker(Request $request)
	{
		$worker = Worker::find($request->worker_id);

		$worker->delete();

		return redirect()->back()->with(['status' => 'Worker deleted!']);
	}

	public function editWorker($id)
	{
		$arr = [];
		$this->data['worker'] = Worker::find($id);
		$this->data['workers'] = Worker::all();
		$this->data['positions'] = Position::all();

		return view('edit', $this->data);
	}

	public function updateWorker(Request $request)
	{
		$request->validate([
			'full_name' => 'required|string|max:255',
			'salary' => 'required|string',
			'position' => 'required|numeric',
			'avatar' => 'file|image|mimes:jpeg,png'
		]);

		$worker = Worker::find($request->worker_id);

		if ($request->hasFile('avatar'))
		{
			$img = $request->file('avatar');

			$avatar = Image::make($img)->encode($img->getClientOriginalExtension());

			$fileName = time() . '-' . str_slug($request->full_name, '_') . '.' . $img->getClientOriginalExtension();
			$filePath = storage_path('app/public/avatars') . '/' . $fileName;

			$avatar->save($filePath);

			$worker->avatar = '/storage/avatars/' . $fileName;
		}

		$worker->name = $request->full_name;
		$worker->salary = $request->salary;
		$worker->position_id = $request->position;
		$worker->worker_id = $request->boss;
		$worker->accepted_at = $request->accepted_at;

		$worker->save();

		return redirect()->back()->with(['status' => 'Worker updated!']);
	}

	public function showWorker($id)
	{
		$this->data['worker'] = Worker::find($id);

		return view('show', $this->data);
	}

	public function listWorkers()
	{
		$this->data['workers'] = Worker::all();

		return view('list', $this->data);
	}

}
