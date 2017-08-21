<?php 

	namespace todo\storage\contracts;

	use todo\models\task;

	interface taskstorageinterface
	{
		public function store(task $task);
		public function update(task $task);
		public function delete($id);
		public function get($id);
		public function all();
	}

 ?>