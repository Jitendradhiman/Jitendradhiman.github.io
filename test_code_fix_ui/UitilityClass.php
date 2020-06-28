<?php 
	class UitilityClass
{
		/*===================== Read file ==========================*/
		function read_file()
		{
			$fileCont  = file_get_contents("MOSconfigure3.json");
			$file      = json_decode($fileCont,true);			
			return $file;

		}
		/*==========================================================*/

		/*===================== Count Test ==========================*/
		function count_test() // counts total test-sets
		{
			return count($this->read_file());
		}
		/*==========================================================*/
		/*================ count tests in each set =================*/
		function count_sub_test($index) // takes the test-set number as argument
		{
			$file = $this->read_file();
			$allkeys   = array_keys($file);
			$lines     = COUNT($file[$allkeys[$index]]); // Count No of Paths
			return $lines;
		}

		/*===============Read File Conatin Paths ===================*/
		/*
		function random_array($index)
		{
			$file = $this->read_file();
			$allkeys   = array_keys($file);
			$lines     = COUNT($file[$allkeys[$index]]); // Count No of Paths
			$audioPath = $file[$allkeys[$index]]; 		 // Audio Paths
			$audioPathKey = array_keys($audioPath); 	 // Create Index Array of Paths Kays

			// ---- shuffle all the keys for audio files ---
			shuffle($audioPathKey);

			//	Create Shuffled Array //
			foreach($audioPathKey as $key) 
				{
					$new[$key] = $audioPath[$key];
		        }

		        $my_shuffle_array = $new;
		    //////////////////////////////

		    return $my_shuffle_array;
		 }
		 */
		/*=========================================================*/
				/*============= create a random sequence ================*/
		function test_shuffle_sequence($index){// $total_numbers is usually is the number of tests in one set
			$total_numbers = $this->count_sub_test($index);
			for($i=0;$i<$total_numbers;$i++) $shuffle_sequence[$i] = $i;
			shuffle($shuffle_sequence);
			return $shuffle_sequence;
		}

		/*============ shuffle the original test ===================*/
		function test_shuffle($index,$shuffle_sequence)
		{
			//$shuffle_sequence = $this->test_shuffle_sequence($index);
			$file     = $this->read_file();
			$allkeys  = array_keys($file);
			$lines    = COUNT($file[$allkeys[$index]]); // Count No of Paths
			$audioPath= $file[$allkeys[$index]]; 		 // Audio Paths
			$audioPathKey = array_keys($audioPath); // the keys to methods in one set of the test

			foreach ($shuffle_sequence as $key) {
				$my_shuffle_array[$audioPathKey[$key]] = $audioPath[$audioPathKey[$key]]; // get the methods randomly shuffled in one test-set
			}
			return $my_shuffle_array;
		}
		/*===== sort the shuffled test, to save the results ========*/
		function test_sort($shuf_sequence, $test_shuffled){
			$test_sorted = array_combine($shuf_sequence, $test_shuffled);
			ksort($test_sorted);
			return $test_sorted;
		}
		/*================= Create A Result File CVC ==============*/
		function write_file($data,$userdata,$testcount,$totalNumberOfTests)
		{
			//echo $testcount;
			$gender   = $userdata['gender'];
			$fullName = $userdata['name'].$userdata['age'].$gender[0];
			$path     = "./Results/".$fullName;	
			$file     = fopen($path.".csv","a");
			$data1    = array_merge(array($testcount+1),$data); 
			// foreach ($data as $key)
			// 	{
					fputcsv($file, $data1); // the first number at the begining of each line is the test count, will retrived to check if user has completed the test or not
			//	}
				
			fclose($file);
			return true;
		}
		/*=========================================================*/


		/*================= Create Errors Array==============*/
		function Errors_check($original_array,$input_array)
		{
			$Error_msg = NULL;
			////// check missing key in input array
			$missing_key=array_diff($original_array,$input_array);
			//print_r($missing_key);
			foreach ($missing_key as $key => $value)
			{
				if(count($missing_key)-1>0) // if error on more than 1 panel, separate mesaage by |
				{  
				$Error_msg.= '<small><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Error on Missing Field :'.($key+1).' | </small>';
				}
				else{
				$Error_msg.= '<small><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Error on Missing Field :'.($key+1).'</small>';
				}
			}
			return $Error_msg;
		}
		/*=========================================================*/


		/*====================Send Email==========================*/
		function sendmail($to,$user_info)
		{
			$subject = "Jitendra Test ";
			$txt = " Your login details are".$user_info['name'].$user_info['age'].$user_info['email'].$user_info['gender'];
			$headers = "From: jitendra_email@example.com" . "\r\n" .
			"CC: jitendra_email@example.com";

			return mail($to,$subject,$txt,$headers);

		}
		/*=========================================================*/


}

?>