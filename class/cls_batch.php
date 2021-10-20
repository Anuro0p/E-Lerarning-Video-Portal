<?php
Class Batch
{
    function addBatch($batch,$departmantId,$programId,$startDate,$endDate)
    {
        include ("connect.php");
        if($this->duplicateBatch($batch,$departmantId,$programId)==0)
        {
            $sql1="INSERT INTO tbl_batch(Dep_ID,Prog_ID,sName,dFrom,dTo,iSem1,iSem2,iSem3,iSem4,iSem5,iSem6,iSem7,iSem8,iSem9,iSem10,iCurrentSem,iStatus)values($departmantId,$programId,'$batch','$startDate','$endDate',1,0,0,0,0,0,0,0,0,0,'1',1);";
            $result1=mysqli_query($con,$sql1);
            if(isset($result1))
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
    

    function duplicateBatch($batch,$departmantId,$programId)
    {
        include ("connect.php");
        $sql="SELECT sName from tbl_batch where sName='$batch' AND Dep_ID='$departmantId' AND Prog_ID='$programId'";
        $result8=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($result8);
        if(mysqli_num_rows($result8)==0)
        {
             return 0;
        }
        else
            {
               return 1;
            }
    } 


    function updateBatch($batch,$departmantId,$programId,$startDate,$endDate,$editid,$flag){
        include ("connect.php");
        if($flag==1)
        {
                $update="UPDATE tbl_batch set sName= '$batch' , Dep_ID= '$departmantId' , Prog_ID= '$programId' ,  dFrom='$startDate',  dTo='$endDate'  where ID = '$editid';";
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
                if($this->duplicateBatch($batch,$departmantId,$programId)==0)
                {
                $update="UPDATE tbl_batch set sName= '$batch' , Dep_ID= '$departmantId' , Prog_ID= '$programId' ,  dFrom='$startDate',  dTo='$endDate'  where ID = '$editid';";
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
        
        
    }

    function deleteBatch($deleteid){
        include ("connect.php");

            $deleteQry="DELETE from tbl_batch where ID = '$deleteid'";
            $dResult=mysqli_query($con,$deleteQry);
                $_SESSION['deleteFlag']=1;
                return 1;
         
    }


    function publishBatch($pubid){
        include ("connect.php");

            $deleteQry="UPDATE tbl_batch set istatus=1 where ID = '$pubid'";
            $dResult=mysqli_query($con,$deleteQry);
            $_SESSION['pubFlag']=1;
                return 1;
         
    }

    function unPublishBatch($upubid){
        include ("connect.php");

            $deleteQry="UPDATE tbl_batch set istatus=0 where ID = '$upubid'";
            $dResult=mysqli_query($con,$deleteQry);
                $_SESSION['pubFlag']=2;
                return 1;
         
    }

    function PremoteBatch($premoteid){
        include ("connect.php");

            $isemQry="SELECT * from tbl_batch where ID = '$premoteid'";
            $semResult=mysqli_query($con,$isemQry);
            $semRow=mysqli_fetch_array($semResult);


            
            if($semRow['iSem1']==1){
                $premoteQry="UPDATE tbl_batch set iSem1=2,iSem2=1,iCurrentSem='2' where ID = '$premoteid'";
                $premoteResult=mysqli_query($con,$premoteQry);
                $_SESSION['premoteFlag']=1;
            }
            elseif($semRow['iSem2']==1){
                $premoteQry="UPDATE tbl_batch set iSem2=2,iSem3=1,iCurrentSem='3' where ID = '$premoteid'";
                $premoteResult=mysqli_query($con,$premoteQry);
                $_SESSION['premoteFlag']=1;
            }
            elseif($semRow['iSem3']==1){
                $premoteQry="UPDATE tbl_batch set iSem3=2,iSem4=1,iCurrentSem='4' where ID = '$premoteid'";
                $premoteResult=mysqli_query($con,$premoteQry);
                $_SESSION['premoteFlag']=1;
            }
            elseif($semRow['iSem4']==1){
                $premoteQry="UPDATE tbl_batch set iSem4=2,iSem5=1,iCurrentSem='5' where ID = '$premoteid'";
                $premoteResult=mysqli_query($con,$premoteQry);
                $_SESSION['premoteFlag']=1;
            }
            elseif($semRow['iSem5']==1){
                $premoteQry="UPDATE tbl_batch set iSem5=2,iSem6=1,iCurrentSem='6' where ID = '$premoteid'";
                $premoteResult=mysqli_query($con,$premoteQry);
                $_SESSION['premoteFlag']=1;
            }
            elseif($semRow['iSem6']==1){
                $premoteQry="UPDATE tbl_batch set iSem6=2,iSem7=1,iCurrentSem='7' where ID = '$premoteid'";
                $premoteResult=mysqli_query($con,$premoteQry);
                $_SESSION['premoteFlag']=1;
            }
            elseif($semRow['iSem7']==1){
                $premoteQry="UPDATE tbl_batch set iSem7=2,iSem8=1,iCurrentSem='8' where ID = '$premoteid'";
                $premoteResult=mysqli_query($con,$premoteQry);
                $_SESSION['premoteFlag']=1;
            }
            elseif($semRow['iSem8']==1){
                $premoteQry="UPDATE tbl_batch set iSem8=2,iSem9=1,iCurrentSem='9' where ID = '$premoteid'";
                $premoteResult=mysqli_query($con,$premoteQry);
                $_SESSION['premoteFlag']=1;
            }
            elseif($semRow['iSem9']==1){
                $premoteQry="UPDATE tbl_batch set isem9=2,isem10=1,iCurrentSem='10' where ID = '$premoteid'";
                $premoteResult=mysqli_query($con,$premoteQry);
                $_SESSION['premoteFlag']=1;
            }
            else{
                $_SESSION['premoteFlag']=2;
            }

    }

    
}
?>