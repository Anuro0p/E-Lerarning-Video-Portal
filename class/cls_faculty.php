<?php
Class Faculty
{
    function duplicateFac($email) {
        include ("connect.php");

        $sql="SELECT * from tbl_faculty where sEmail = '$email'";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($result);
        $_SESSION['duplicateFlag']=1;
        if($email != $row['sEmail']) {
            return 0;
        }
        else {
            return 2;
            }
    }
    function duplicateFacUpdate($email, $editid) {
        include ("connect.php");

        $sql="SELECT * from tbl_faculty where sEmail = '$email' and ID <> $editid";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($result);
        $_SESSION['duplicateFlag']=1;
        if($email != $row['sEmail']) {
            return 0;
        }
        else {
            return 2;
            }
    } 

    function addFac($fac, $pass, $desi, $quali, $email, $gender, $phone, $depID, $multipleDep) {
        include ("connect.php");

        $sql2 = "SELECT * from tbl_department where ID = '$depID'";
        $result2 = mysqli_query($con,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
        if($this->duplicateFac($email)==0){
            $sql1="INSERT INTO tbl_faculty(sName, Dep_ID, sPassword, sDesignation, sQualification, sEmail, sGender, iPhone, iCommon_Dep, iStatus)values('$fac', '$depID', '$pass', '$desi', '$quali', '$email', '$gender', '$phone','$multipleDep', 1)";
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

    function deleteFac($deleteid){
        include ("connect.php");
        $subsql="Select * from tbl_subject_allocation where Faculty_ID = '$deleteid'";
        $subresult=mysqli_query($con,$subsql);
        $subrow=mysqli_num_rows($subresult);
        $vidsql="Select * from tbl_video where Faculty_ID ='$deleteid'";
        $vidresult=mysqli_query($con,$vidsql);
        $vidrow=mysqli_num_rows($vidresult);
        if(($subrow>0) || ($vidrow>0))
        {
            $_SESSION['duplicateFlag']=3;
            return 3;
        }
        else
        {
            $sql="DELETE from tbl_faculty where ID = '$deleteid'";
            $result=mysqli_query($con,$sql);
            if(isset($result)) {
                $_SESSION['deleteFlag']=1;
                return 1;
                }
            else {
                    return 0;
                }
        }
    }
    
    function updateFac($editid, $fac, $desi, $quali, $email, $gender, $phone, $depID){
        include ("connect.php");

      if($this->duplicateFacUpdate($email, $editid)==0){
          
            $update="UPDATE tbl_faculty set sName = '$fac', Dep_ID = '$depID', sDesignation = '$desi', sQualification = '$quali', sEmail = '$email', sGender = '$gender', iPhone = '$phone' where ID = '$editid'";
            $uResult=mysqli_query($con,$update);
            $row2=mysqli_fetch_array($uResult);
                $_SESSION['updateFlag']=1;
                return 1;
       }
    }

    function publishFac($pubid){
        include ("connect.php");

        $deleteQry="UPDATE tbl_faculty set istatus=1 where ID = '$pubid'";
        $dResult=mysqli_query($con,$deleteQry);
            $_SESSION['pubFlag']=1;
            return 1;
    }

    function unPublishFac($upubid){
        include ("connect.php");

        $deleteQry="UPDATE tbl_faculty set istatus=0 where ID = '$upubid'";
        $dResult=mysqli_query($con,$deleteQry);
            $_SESSION['pubFlag']=2;
            return 1;

    }
    
}
?>