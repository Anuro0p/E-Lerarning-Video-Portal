<?php
Class Semester
{
    function addSemester($semester)
    {
        include ("connect.php");
        if($this->duplicateSemester($semester)==0)
        {
            $sql1="INSERT INTO tbl_semester(sName,iStatus)values('$semester',1)";
            $result1=mysqli_query($con,$sql1);
            if($result1==TRUE)
            {
                $_SESSION['successFlag']=1;
                return 1;
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return 2;
        }
    }
    

    function duplicateSemester($semester)
    {
        include ("connect.php");
        $sql="SELECT sName from tbl_semester where sName='$semester'";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($result);
        if($semester!=$row['sName'])
        {
             return 0;
        }
        else
            {
               return 1;
            }
    } 


    function updateSemester($editid,$editname){
        include ("connect.php");
        if($this->duplicateSemester($editname)==0)
        {
            $update="UPDATE tbl_semester set sName= '$editname' where ID = '$editid'";
            $uResult=mysqli_query($con,$update);
            $row2=mysqli_fetch_array($uResult);
            if($uResult==TRUE) {
                $_SESSION['updateFlag']=1;
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

    function deleteSemester($deleteid){
        include ("connect.php");

            $deleteQry="DELETE from tbl_semester where ID = '$deleteid'";
            $dResult=mysqli_query($con,$deleteQry);
                $_SESSION['deleteFlag']=1;
                return 1;
         
    }


    function publishSemester($pubid){
        include ("connect.php");

            $deleteQry="UPDATE tbl_semester set istatus=1 where ID = '$pubid'";
            $dResult=mysqli_query($con,$deleteQry);
            $_SESSION['pubFlag']=1;
                return 1;
         
    }

    function unPublishSemester($upubid){
        include ("connect.php");

            $deleteQry="UPDATE tbl_semester set istatus=0 where ID = '$upubid'";
            $dResult=mysqli_query($con,$deleteQry);
                $_SESSION['pubFlag']=2;
                return 1;
         
    }

    
}
?>