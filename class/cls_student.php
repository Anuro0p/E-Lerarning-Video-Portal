<?php
Class Student
{
    function addStudent($student,$deptid,$programid,$batchid,$email,$password,$phone,$gender)
    {
        include ("connect.php");
        if($this->duplicateStudent($email)==0)
        {
            $sql1="INSERT INTO tbl_student(Dep_ID,Batch_ID,Prog_ID,sName,sEmail,sPassword,iPhone,iGender,iStatus)values($deptid,$batchid,$programid,'$student','$email','$password',$phone,$gender,1)";
            $result1=mysqli_query($con,$sql1);
            if($result1==TRUE)
            {
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
    function duplicateStudent($email)
    {
        include ("connect.php");
        $sql="SELECT sEmail from tbl_student where sEmail='$email'";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($result);
        if(($email!=$row['sEmail']))
        {        
             return 0;
        }
        else
            {
               return 1;
            }
    } 
    function duplicateStudent2($email,$editid)
    {
        include ("connect.php");
        $sql="SELECT sEmail from tbl_student where sEmail='$email' and ID <> $editid";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($result);
        if(($email!=$row['sEmail']))
        {        
             return 0;
        }
        else
            {
               return 1;
            }
    } 
    function updateStudent($editid,$student,$deptid,$programid,$batchid,$email,$phone,$gender){
        include ("connect.php");
        if($this->duplicateStudent2($email,$editid)==0)
        {
            echo "entered no duplicate !";
            $update="UPDATE tbl_student set Dep_ID='$deptid',Batch_ID='$batchid',Prog_ID='$programid',sName= '$student',sEmail='$email',iPhone='$phone',iGender='$gender' where ID = '$editid'";
            $Result=mysqli_query($con,$update);
            if($Result==TRUE) {
                echo "updated";
                return 1;
            }
            else {
                echo "not updated";
                return 0;
            }
        }
        else {
            return 2;
        }
        
    }
    function deleteStudent($delid){
        include ("connect.php");
        $sql="DELETE from tbl_student where ID = '$delid'";
        $Result=mysqli_query($con,$sql);
        $_SESSION['deleteFlag']=1;
                return 1;
        }
    function publishStudent($pubid){
            include ("connect.php");
                $sql="UPDATE tbl_student set iStatus=1 where ID = '$pubid'";
                $Result=mysqli_query($con,$sql);
                $_SESSION['pubFlag']=1;
                return 1;
            }
    function unpublishStudent($unpubid){
            include ("connect.php");
                $sql="UPDATE tbl_student set iStatus=0 where ID = '$unpubid'";
                $Result=mysqli_query($con,$sql);
                $_SESSION['unpubFlag']=1;
                return 1;
        }
               
}
?>