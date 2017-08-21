<?php 
			require 'index.php';

			$tas = @$_GET['tas'];
    		$ts = @$_GET['ts'];

    		if($tas == 1){
			$task = $manager->gettask(@$ts);
			$task->setcomplete('0');
			$manager->updatetask($task);
			}else{
			$task = $manager->gettask(@$ts);
			$task->setcomplete('1');
			$manager->updatetask($task);
			}

			header('location:index.php');

			
 ?>