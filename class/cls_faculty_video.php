<?php
Class Video
{
    function addVideo($id,$title,$desc,$link,$udate)
    {
        include ("connect.php");
        if($this->duplicateVideo($title)==0)
        {
            $sql="SELECT * from tbl_subject_allocation where ID=$id";
            $result=mysqli_query($con,$sql);
            $row=mysqli_fetch_array($result);
            $dept=$row['Dep_ID'];
            $batch=$row['Batch_ID'];
            $program=$row['Prog_ID'];
            $subject=$row['Subject_ID'];
            $sem=$row['Sem_ID'];
            $faculty=$row['Faculty_ID'];
            $sql1="INSERT INTO tbl_video(Dep_ID,Batch_ID,Prog_ID,Subject_ID,Sem_ID ,Faculty_ID,sTitle,sDescription,sUrl,dtDate,iStatus)values($dept,$batch,$program,$subject,$sem,$faculty,'$title','$desc','$link','$udate',1)";
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
    function duplicateVideo($title)
    {
        include ("connect.php");
        $sql="SELECT sTitle from tbl_video where sTitle='$title'";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($result);
        if($title!=$row['sTitle'])
        {
             return 0;
        }
        else
            {
               return 1;
            }
    } 
    function duplicateVideo1($id,$title)
    {
        include ("connect.php");
        $sql="SELECT sTitle from tbl_video where sTitle='$title' and ID<>$id";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($result);
        if($title!=$row['sTitle'])
        {
             return 0;
        }
        else
            {
               return 1;
            }
    } 
    function updateVideo($editid,$editname,$desc,$link,$udate){
        include ("connect.php");
        if($this->duplicateVideo1($editid,$editname)==0)
        {
            $update="UPDATE tbl_video set sTitle= '$editname',sDescription='$desc',sUrl='$link', dtDate='$udate' where ID = '$editid'";
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
    function deleteVideo($delid){
        include ("connect.php");
        $sql="DELETE from tbl_video where ID = '$delid'";
        $Result=mysqli_query($con,$sql);
        $_SESSION['deleteFlag']=1;
                return 1;
        }
    function publishVideo($pubid){
            include ("connect.php");
                $sql="UPDATE tbl_video set iStatus=1 where ID = '$pubid'";
                $Result=mysqli_query($con,$sql);
                $_SESSION['pubFlag']=1;
                return 1;
            }
    function unpublishVideo($unpubid){
            include ("connect.php");
                $sql="UPDATE tbl_video set iStatus=0 where ID = '$unpubid'";
                $Result=mysqli_query($con,$sql);
                $_SESSION['unpubFlag']=1;
                return 1;
        }
               
}
?>