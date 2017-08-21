<?php 

	namespace todo\storage;

	use PDO;
	use todo\models\task;
	use todo\storage\contracts\taskstorageinterface;

	class mysqldatabasetaskstorage implements taskstorageinterface
	{
		protected $db;

		public function __construct(PDO $db)
		{
			$this->db = $db;
		}

		public function store(task $task)
		{
			$statement = $this->db->prepare("
				INSERT INTO tasks (description, due, complete)
				VALUES (:description, :due, :complete)
				");

			$statement->execute($this->buildcolumns($task));

			return $this->get($this->db->lastInsertId()); 
		}

		public function update(task $task)
		{
			$statement = $this->db->prepare("
				UPDATE tasks SET description = :description, due = :due, complete = :complete WHERE id = :id
				");

			$statement->execute($this->buildcolumns($task, ['id' => $task->getid(),]));
			return $this->get($task->getid());
		}

		//delete
		public function delete($id)
		{
			$statement = $this->db->prepare("DELETE FROM tasks WHERE id = :id");
			$statement->execute(['id' => $id,]);
			return $statement->fetch();
		}

		public function get($id)
		{
			$statement = $this->db->prepare("SELECT id, description, due, complete FROM tasks WHERE id = :id
				");

			$statement->setFetchMode(PDO::FETCH_CLASS, task::class);

			$statement->execute([
				'id' => $id,
				]);
			return $statement->fetch();
		}

		public function all()
		{
			$statement = $this->db->prepare("
				SELECT id, description, due, complete FROM tasks order by id desc
				");

			$statement->setFetchMode(PDO::FETCH_CLASS, task::class);

			$statement->execute();

			return $statement->fetchAll();
		}

		protected function buildcolumns(task $task, array $additional =[])
		{
			return array_merge([
				
				'description' => $task->getdescription(),
				'due' => $task->getdue()->format('Y-m-d H:i:s'),
				'complete' => $task->getcomplete() ? 1:0,
			], $additional);
		}
	}

 ?>