<?php
Class SubjectAllocation
{
    function duplicateSubAlloc($department, $faculty, $program, $batch, $subject, $semester) {
        include ("connect.php");

        $sql="SELECT * from tbl_subject_allocation where Dep_ID = '$department' and Faculty_ID = '$faculty' and Prog_ID = '$program' and Batch_ID = '$batch' and Subject_ID = '$subject' and Sem_ID = '$semester'";
        $result = mysqli_query($con,$sql);
        $numRows = mysqli_num_rows($result);
        
        if($numRows == 0) {
            return 0;
        }
        else {
              $_SESSION['duplicateFlag']=1;
              return 2;
            }
    }

    function addSubAlloc($department, $faculty, $program, $batch, $subject, $semester) {
        include ("connect.php");

        if($this->duplicateSubAlloc($department, $faculty, $program, $batch, $subject, $semester)==0){
            $sql1="INSERT INTO tbl_subject_allocation(Dep_ID, Batch_ID, Prog_ID, Subject_ID, Faculty_ID, Sem_ID , iStatus)values('$department', '$batch', '$program', '$subject', '$faculty', '$semester', 1)";
            $result1=mysqli_query($con,$sql1);
            
            if($result1==TRUE) {
                $_SESSION['successFlag']=1;
                return 1;
            }
            else {
                return 0;
            }
        }
        else {
            return 2;
        }
    }

    function deleteSubAlloc($deleteid){
        include ("connect.php");
        
        $sql="DELETE from tbl_subject_allocation where ID = '$deleteid'";
        $result=mysqli_query($con,$sql);
        if(isset($result)) {
            $_SESSION['deleteFlag']=1;
            return 1;
            }
        else {
                return 0;
            }
        }
    
    function updateSubAlloc($department, $faculty, $program, $batch, $subject, $semester, $updateid){
        include ("connect.php");

        if($this->duplicateSubAlloc($department, $faculty, $program, $batch, $subject, $semester)==0){
            $update="UPDATE tbl_subject_allocation set Dep_id= '$department', Batch_ID = '$batch', Prog_ID = '$program', Subject_ID = '$subject', Faculty_ID = '$faculty', Sem_ID = '$semester' where ID = '$updateid'";
            $uResult=mysqli_query($con,$update);
            $row2=mysqli_fetch_array($uResult);
                $_SESSION['updateFlag']=1;
                return 1;
        }
    }

    function publishSubAlloc($pubid){
        include ("connect.php");

        $deleteQry="UPDATE tbl_subject_allocation set istatus=1 where ID = '$pubid'";
        $dResult=mysqli_query($con,$deleteQry);
            $_SESSION['pubFlag']=1;
            return 1;
    }

    function unPublishSubAlloc($upubid){
        include ("connect.php");

        $deleteQry="UPDATE tbl_subject_allocation set istatus=0 where ID = '$upubid'";
        $dResult=mysqli_query($con,$deleteQry);
            $_SESSION['pubFlag']=2;
            return 1;

    }
    
}
?>