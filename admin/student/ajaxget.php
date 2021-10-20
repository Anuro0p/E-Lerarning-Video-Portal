<?php 
	include ("../../class/connect.php");

	if((isset($_POST['department_id']) && $_POST['department_id'] !='')||isset($_POST['id']))
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
			// echo '<label for="defaultSelect">Select Program</label>';
			// echo '<select name="program_id" class="form-control form-control prog" id="prog">';
			if(isset($_POST['prgm_id'])){
				while($program = mysqli_fetch_assoc($rs))
				{
				?>
					<option value="<?php echo $program['ID'];?>"<?php if($program['sName']==$_POST['prgm_id']) echo "selected" ?>><?php echo $program['sName'];?></option>
					
				<?php
				}
			}
			else{
				echo '<option hidden value="">--select--</option>';
				while($program = mysqli_fetch_assoc($rs))
				{
					
					 echo '<option value="'.$program['ID'].'">'.$program['sName'].'</option>';
				}
			}
			
			// echo '</select>';
		}
		
	}
	if(isset($_POST['prog']) && $_POST['prog'] !='')
	{
		$prog = $_POST['prog'];
		$sql = "select * from tbl_batch where Prog_ID = $prog and iStatus=1";
		$rs = mysqli_query($con,$sql);
		$numRows = mysqli_num_rows($rs);
		
		if($numRows == 0)
		{
			echo 'No batch found';
		}
		else
		{
			echo '<label for="defaultSelect">Select Program</label>';
			echo '<select name="batchid" class="form-control form-control prog" id="batch">';
			if(isset($_POST['bch_id'])){
				while($batch = mysqli_fetch_assoc($rs))
				{
					?>
					<option value="<?php echo $batch['ID'];?>"<?php if($batch['ID']==$_POST['bch_id']) echo "selected" ?>><?php echo $batch['sName'];?></option>
					<?php
				}
			}
			else{
				echo '<option hidden value="">--select--</option>';
				while($batch = mysqli_fetch_assoc($rs))
				{
					echo '<option value="'.$batch['ID'].'">'.$batch['sName'].'</option>';
				}
			}
			
			echo '</select>';
		}
		
	}
?>