<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Worker;

class WorkersController extends APIController
{
	private $data = [];

	public function listWorkers(Request $request)
	{
		if ($request->query_term != "")
			$this->data['workers'] = Worker::orderBy($request->sort_by, $request->order_by)->where($request->search_as, 'LIKE', '%' . $request->query_term . '%')->get();
		else
			$this->data['workers'] = Worker::orderBy($request->sort_by, $request->order_by)->get();

		foreach ($this->data['workers'] as &$val) {
			$val['position'] = $val->position;
		}

		return $this->sendResponse($this->data);
	}
}
