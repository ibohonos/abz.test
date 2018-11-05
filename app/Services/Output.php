<?php

namespace App\Services;

class Output
{
	public $parentIdFieldName = 'worker_id';
	public $nodesById = [];
	public $nodesByParent = [];

	private $branch;

	public function getNode($id)
	{
		if (!isset($this->nodesById[$id])) {
			$this->nodesById[$id] = [];
		}

		return $this->nodesById[$id];
	}

	public function getSubnodes($id)
	{
		if (!isset($this->nodesByParent[$id])) {
			$this->nodesByParent[$id] = [];
		}

		return $this->nodesByParent[$id];
	}

	public function getBranch($id)
	{
		if (isset($this->nodesById[$id])) {
			$this->branch = [];
			$this->branchRecursion($id);

			return array_reverse($this->branch);
		}
	}

	private function branchRecursion($id)
	{
		$this->branch[] = $this->nodesById[$id];

		if ($this->nodesById[$id][$this->parentIdFieldName] > 0) {
			$this->branchRecursion($this->nodesById[$id][$this->parentIdFieldName]);
		}
	}
}
