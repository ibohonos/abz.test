<?php

namespace App\Services;

class Tree
{
	private $builder;
	private $parentIdFieldName = 'worker_id';
	private $nodesById = [];
	private $nodesByParent = [];

	public function __construct($builder)
	{
		$this->builder = $builder;
	}

	public function parentIdField($name)
	{
		$this->parentIdFieldName = $name;

		return $this;
	}

	/**
	 * @return Output
	 */
	public function get()
	{
		$nodes = $this->builder->get();

		foreach ($nodes as $node) {
			$this->nodesById[$node->id] = $node;
			$this->nodesByParent[$node->{$this->parentIdFieldName}][] = $node;
		}

		$output = new Output;

		$output->parentIdFieldName = $this->parentIdFieldName;
		$output->nodesById = $this->nodesById;
		$output->nodesByParent = $this->nodesByParent;

		return $output;
	}
}