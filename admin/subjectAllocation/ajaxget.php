<?php 
	include ("../../class/connect.php");
	
	if(isset($_POST['department_id']) && $_POST['department_id'] !='')
	{
		$departmentID = $_POST['department_id'];

		//Faculty fetch using department ID

		$sql2 = "select * from tbl_faculty where (Dep_ID = $departmentID or iCommon_Dep = 1) and iStatus = 1";
		$rs2 = mysqli_query($con,$sql2);
		$numRows2 = mysqli_num_rows($rs2);
		
		if($numRows2 == 0)
		{
			echo 'No Faculties found';
		}
		else
		{
			echo '<label class = "mt-2" for="defaultSelect">Faculty</label>';
			echo '<select name="faculty" class="form-control" id="facFetch" required>';
			
			echo '<option hidden value = "" selected>--Select--</option>';
			while($faculty = mysqli_fetch_assoc($rs2))
			{
				echo '<option value="'.$faculty['ID'].'">'.$faculty['sName'].'</option>';
			}
			echo '</select>';
		}

		//Program fetch

		$sql = "select * from tbl_program where Dep_ID = $departmentID and iStatus=1";
		$rs = mysqli_query($con,$sql);
		$numRows = mysqli_num_rows($rs);
		
		if($numRows == 0)
		{
			echo 'No program found';
		}
		else
		{
			echo '<label class = "mt-2" for="defaultSelect">Program</label>';
			echo '<select name="program" class="form-control" id="batchFetch" required>';
			echo '<option hidden value = "" selected>--Select--</option>';
			while($program = mysqli_fetch_assoc($rs))
			{
				echo '<option value="'.$program['ID'].'">'.$program['sName'].'</option>';
			}
			echo '</select>';


		}
		
	}

	if(isset($_POST['program_id']) && $_POST['program_id'] !='')
	{
		$programID = $_POST['program_id'];
		$sql = "select * from tbl_batch where Prog_ID = $programID and iStatus=1";
		$rs = mysqli_query($con,$sql);
		$numRows = mysqli_num_rows($rs);
		
		if($numRows == 0)
		{
			echo '<br> No Batch found';
		}
		else
		{
			echo '<label class = "mt-2" for="defaultSelect">Batch</label>';
			echo '<select name="batch" class="form-control" id="semFetch" required>';
			echo '<option hidden value = "" selected>--Select--</option>';
			while($batch = mysqli_fetch_assoc($rs))
			{
				echo '<option value="'.$batch['ID'].'">'.$batch['sName'].'</option>';
			}
			echo '</select>';


		}

		$sql2 = "select * from tbl_subject where Prog_ID = $programID and iStatus = 1";
		$rs2 = mysqli_query($con,$sql2);
		$numRows2 = mysqli_num_rows($rs2);
		
		if($numRows2 == 0 || $numRows == 0)
		{
			echo ' <br> No Subjects found';
		}
		else
		{
			echo '<label class = "mt-2" for="defaultSelect">Subject</label>';
			echo '<select name="subject" class="form-control" id="subFetch" required>';
			echo '<option hidden value = "" selected>--Select--</option>';
			while($subject = mysqli_fetch_assoc($rs2))
			{
				echo '<option value="'.$subject['ID'].'">'.$subject['sName'].'</option>';
			}
			echo '</select>';
		}
		
	}

	if(isset($_POST['sem_id']) && $_POST['sem_id'] !='')
	{
		$semID = $_POST['sem_id'];
		$sql = "select * from tbl_batch where ID = $semID and iStatus=1";
		$rs = mysqli_query($con,$sql);
		$numRows = mysqli_num_rows($rs);
		$sem = mysqli_fetch_assoc($rs);
		$currentSem = $sem['iCurrentSem'];
		
		if($numRows == 0)
		{
			echo 'No Semesters found';
		}
		else
		{
			echo '<label for="defaultSelect">Semester</label>';
			echo '<input name="semester" value="'.$sem['iCurrentSem'].'" class="form-control" id="semFetch" readonly>';
		}
		
	}

?>