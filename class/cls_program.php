<?php
Class Program
{
    function duplicateProg($prog,$depID) {
        include ("connect.php");

        $sql="SELECT sName, Dep_ID from tbl_program where sName='$prog' and Dep_ID = '$depID'";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($result);
        $_SESSION['duplicateFlag']=1;
        if($prog != $row['sName'] && $depID != $row['Dep_ID']) {
            return 0;
        }
        else {
              return 2;
            }
    } 

    function addProg($prog, $depID) {
        include ("connect.php");

        if($this->duplicateProg($prog,$depID)==0){
            $sql1="INSERT INTO tbl_program(sName, Dep_ID, iStatus)values('$prog', '$depID', 1)";
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

    function deleteProg($deleteid){
        include ("connect.php");
        
        $sql="DELETE from tbl_program where ID = '$deleteid'";
        $result=mysqli_query($con,$sql);
        if(isset($result)) {
            $_SESSION['deleteFlag']=1;
            return 1;
            }
        else {
                return 0;
            }
        }
    
    function updateProg($editid,$prog,$depID){
        include ("connect.php");

        if($this->duplicateProg($prog,$depID)==0){
            $update="UPDATE tbl_program set sName= '$prog', Dep_ID = '$depID' where ID = '$editid'";
            $uResult=mysqli_query($con,$update);
            $row2=mysqli_fetch_array($uResult);
                $_SESSION['updateFlag']=1;
                return 1;
        }
    }

    function publishProgram($pubid){
        include ("connect.php");

        $deleteQry="UPDATE tbl_program set istatus=1 where ID = '$pubid'";
        $dResult=mysqli_query($con,$deleteQry);
            $_SESSION['pubFlag']=1;
            return 1;
    }

    function unPublishProgram($upubid){
        include ("connect.php");

        $deleteQry="UPDATE tbl_program set istatus=0 where ID = '$upubid'";
        $dResult=mysqli_query($con,$deleteQry);
            $_SESSION['pubFlag']=2;
            return 1;

    }
    
}
?>