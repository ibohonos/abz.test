<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Worker;
use App\Position;
use Validator;

class HomeController extends Controller
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

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('home');
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
			'position' => 'required|numeric'
		]);

		$worker = new Worker;

		$worker->name = $request->full_name;
		$worker->salary = $request->salary;
		$worker->position_id = $request->position;
		$worker->worker_id = $request->boss;
		$worker->accepted_at = $request->accepted_at;

		$worker->save();

		return redirect()->back()->with(['status' => 'Worker saved!']);
	}
}
