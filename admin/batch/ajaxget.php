<?php 
	include ("../../class/connect.php");
	
	if(isset($_POST['department_id']) && $_POST['department_id'] !='')
	{
		$departmentID = $_POST['department_id'];
		$sql = "select * from tbl_program where Dep_ID = $departmentID and iStatus=1";
		$rs = mysqli_query($con,$sql);
		$numRows = mysqli_num_rows($rs);
		
		if($numRows == 0)
		{
			echo 'No program found';
		}
		else
		{
			echo '<label for="defaultSelect">Select Program</label>';
			echo '<select name="program" class="form-control form-control" id="defaultSelect">';
			if(isset($_POST['program_id']))
			{
				$programID=$_POST['program_id'];
				$sql1 = "select * from tbl_program where ID=$programID and iStatus=1";
				$rs1 = mysqli_query($con,$sql1);
				$program1 = mysqli_fetch_assoc($rs1);
			
				?>
				<option seleced hidden value=<?php echo $program1['ID']; ?>><?php echo $program1['sName'];?></option>
				<?php
			}
			
				while($program = mysqli_fetch_assoc($rs))
					{
						echo '<option value="'.$program['ID'].'">'.$program['sName'].'</option>';
					}
			
			
			echo '</select>';
		}
		
	}

?>