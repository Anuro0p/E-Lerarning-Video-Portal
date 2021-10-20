<?php
Class Department
{
    function addDept($dept)
    {
        include ("connect.php");
        if($this->duplicateDept($dept)==0)
        {
            $sql1="INSERT INTO tbl_department(sName,iStatus)values('$dept',1)";
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
    function duplicateDept($dept)
    {
        include ("connect.php");
        $sql="SELECT sName from tbl_department where sName='$dept'";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($result);
        if($dept!=$row['sName'])
        {
             return 0;
        }
        else
            {
               return 1;
            }
    } 
    function updateDept($editid,$editname){
        include ("connect.php");
        if($this->duplicateDept($editname)==0)
        {
            $update="UPDATE tbl_department set sName= '$editname' where ID = '$editid'";
            $Result=mysqli_query($con,$update);
            $row2=mysqli_fetch_array($Result);
            if($Result==TRUE) {
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
    function deleteDept($delid){
        include ("connect.php");
        $sql="DELETE from tbl_department where ID = '$delid'";
        $Result=mysqli_query($con,$sql);
        $_SESSION['deleteFlag']=1;
                return 1;
        }
    function publishDept($pubid){
            include ("connect.php");
                $sql="UPDATE tbl_department set iStatus=1 where ID = '$pubid'";
                $Result=mysqli_query($con,$sql);
                $_SESSION['pubFlag']=1;
                return 1;
            }
    function unpublishDept($unpubid){
            include ("connect.php");
                $sql="UPDATE tbl_department set iStatus=0 where ID = '$unpubid'";
                $Result=mysqli_query($con,$sql);
                $_SESSION['unpubFlag']=1;
                return 1;
        }
               
}
?>