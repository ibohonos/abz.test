<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Worker;
use App\Services\Tree;
use Auth;

class HomeController extends Controller
{



	private $tree;
	private $output;
	private $level = 0;
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
		$builder = new Worker;
		$arr = [];

		// if ()
		$this->tree = (new Tree($builder))->get();
		if ($this->tree->nodesByParent) {
			$nodesByParent = $this->tree->nodesByParent[0];

			foreach ($nodesByParent as $value) {
				$arr = $this->treeRecursion($value->id);
			}
		}

		$this->data['arr'] = $arr;

		return view('home', $this->data);
	}

	private function treeRecursion($id)
	{
		$node = $this->tree->getNode($id);
		$subnodes = $this->tree->getSubnodes($id);

		if (Auth::id()) {
			$accessed = '<a href="' . route('delete.worker') . '" class="d-inline-flex p-2 align-self-center float-right card-link text-danger" onclick="event.preventDefault();
											 document.getElementById(\'delete-form-' . $node->id . '\').submit();">Delete</a>
						<form id="delete-form-' . $node->id . '" action="' . route('delete.worker') . '" method="POST" style="display: none;">
							<input type="hidden" name="_token" value="' . csrf_token() . '">
							<input type="hidden" name="worker_id" value="' . $node->id . '">
						</form>
						<a href="' . route('edit.worker', $node->id) . '" class="d-inline-flex p-2 align-self-center float-right card-link">Edit</a>';
		} else {
			$accessed = '';
		}

		$this->output[] = '<div class="list-group-item list-group-item-action level-' . $this->level . '">
								<a href="' . route('show.worker', $node->id) . '" class="card-link">
									<img class="d-inline-flex pl-2 align-self-center" src="' . $node->avatar . '" style="width: 10%;">
									<div class="d-inline-flex pl-2 align-self-center flex-column">
										<h4 class="pb-2">' . $node->name . '</h4>
										<h6>' . $node->salary . '</h6>
										<h6>' . $node->position->title . '</h6>
									</div>
								</a>' . $accessed . '
							</div>';

		if ($subnodes) {
			$this->level++;

			foreach ($subnodes as $subnode) {
				$this->treeRecursion($subnode->id);
			}

			$this->level--;
		}

		return $this->output;
	}

}
