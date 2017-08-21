<?php 
  use todo\models\task;
  use todo\taskmanager;
  use todo\storage\mysqldatabasetaskstorage;

  require 'vendor/autoload.php';

  $db = new PDO('mysql:host=localhost;dbname=todo', 'root', '123456');
  
  $storage = new mysqldatabasetaskstorage($db);
  
  $manager = new taskmanager($storage);


if (isset($_POST['submit'])) {
try{

$hotline = $_POST['task'];
$sucess = "Update Sucessfully";

}
catch(Exception $e){
$error_message = $e->getmessage();
}
}

  $task = new task;
  $task->setdescription(@$hotline);
  $task->setdue(new DateTime);
  $task->setcomplete();

  $storedtask= $manager->addtask($task);

  
  
    	$del = @$_GET['del'];
		$manager->deletetask($del);
  			
  

    
 ?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Task List</title>
  <link rel="stylesheet" href="css/style.css">  
</head>

<body>
  <!doctype html>
<html>
  <head>
    <link rel="stylesheet" href="https://s3.amazonaws.com/codecademy-content/projects/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='style.css'/>
    <script   src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/annyang/1.4.0/annyang.min.js"></script>

   
    
  </head>
  <body>
    <div class="header">
      <h1>Daily Task List</h1>
    </div>
    <div class="main">
    <form action="" method="post" class="form">
        <div class="form-container">
          <input type="text" name="task" class="form-input" placeholder="Add Task">
        </div>
        <button name="submit" type="submit" class="btn">Add</button>
      </form>
      <div class="list">
      <?php $i=0; foreach ($manager->gettasks() as $talk){
      $i++;
      ?>
        <p>
          <a href="ok.php?tas=<?=$talk->getcomplete();?>&ts=<?=$talk->getid();?>"><i class="fa fa-check-square<?php if($talk->getcomplete() == 0){ echo "-o";}
    ?>"></i></a>
          <span><?php echo $talk->getdescription(); ?></span>
          <a href="index.php?del=<?=$talk->getid();?>"><i class="glyphicon glyphicon-remove"></i></a>
        </p>
		<?php  if ($i==7) {
		break;
		}
		}
		?>
      </div>
      </div>
    
    
</body>
</html>
  
</body>
</html>
