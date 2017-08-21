<?php 

	namespace todo;

	use todo\models\task;
	use todo\storage\contracts\taskstorageinterface;

	class taskmanager
	{
		protected $storage;

		public function __construct(taskstorageinterface $storage)
		{
			$this->storage = $storage;
		}

		public function addtask(task $task)
		{
			return $this->storage->store($task);
		}

		public function updatetask(task $task)
		{
			return $this->storage->update($task);
		}

		public function gettask($id)
		{
			return $this->storage->get($id);
		}

		public function deletetask($id)
		{
			return $this->storage->delete($id);
		}

		public function gettasks()
		{
			return $this->storage->all();
		}
	}

 ?>