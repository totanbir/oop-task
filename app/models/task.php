<?php 

	namespace todo\models;

	use DateTime;

	class task
	{
		protected $id;

		protected $complete = false;

		protected $description;

		protected $due;

		public function setdescription($description)
		{
			$this->description = $description;
		}

		public function getdescription()
		{
			return $this->description;
		}

		public function setcomplete($complete = true)
		{
			$this->complete = $complete;
		}

		public function getcomplete()
		{
			return (bool) $this->complete;
		}

		public function setdue(DateTime $due)
		{
			$this->due = $due;
		}

		public function getdue()
		{
			if(!$this->due instanceof DateTime){
				return new DateTime($this->due);
			}

			return $this->due;
		}

		public function getid()
		{
			return $this->id;
		}
	}

 ?>