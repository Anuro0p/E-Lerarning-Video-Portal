<?php
Class User
{
    function userlogin($Email, $Pass, $user, $remember) {
            include ("connect.php");
            $md5Pass = md5($Pass);
            if(isset($_POST['submit'])){
                if($user=="faculty")
                {
                $login="SELECT * from tbl_faculty where sEmail = '$Email' AND iStatus = 1";
                echo"success";

                $result = mysqli_query($con,$login);
                if(mysqli_num_rows($result)>0)
                {
                    $row=mysqli_fetch_assoc($result);
                    $e=$row["sEmail"];
                    $p=$row["sPassword"];
                        if($md5Pass==$p) {
                            if($remember == 1) {
                                setcookie('cookieEmail', $Email,time()+ 3600);
                                setcookie('cookiePass', $Pass,time()+ 3600);
                                setcookie('cookieuser', $user,time()+ 3600);
                                setcookie("remember","1",time()+ 3600);
                            }
                            else {
                                setcookie('cookieEmail', "");
                                setcookie('cookiePass', "");
                                setcookie("remember","");
                                setcookie('cookieuser', "");
                                $_SESSION['cookieUnset'] = 2;
                            }
                             $_SESSION['username'] = $Email;
                             return 1;
                    }
                        else return -1;
                    }
                 else return -2;
            }
            else if($user=="student")
                {
                $login="SELECT * from tbl_student where sEmail = '$Email' AND iStatus = 1";
                echo"success";

                $result = mysqli_query($con,$login);
                if(mysqli_num_rows($result)>0)
                {
                    $row=mysqli_fetch_assoc($result);
                    $e=$row["sEmail"];
                    $p=$row["sPassword"];
                        if($md5Pass==$p) {
                            if($remember == 1) {
                                setcookie('cookieEmail', $Email,time()+ 3600);
                                setcookie('cookiePass', $Pass,time()+ 3600);
                                setcookie('cookieuser', $user,time()+ 3600);
                                setcookie("remember","1",time()+ 3600);
                            }
                            else {
                                setcookie('cookieEmail', "");
                                setcookie('cookiePass', "");
                                setcookie('cookieuser', "");
                                setcookie("remember","");
                                $_SESSION['cookieUnset'] = 2;
                            }
                             $_SESSION['username'] = $Email;
                             return 2;
                    }
                        else return -1;
                    }
                 else return -2;
            }
        } 
    }
    function facultychangepassword($email,$oldpassword,$password){
        include ("connect.php");
        $result1 = mysqli_query ($con,"select sPassword from tbl_faculty where sEmail='$email'");
        $row1 = mysqli_fetch_assoc($result1);
        $oldpassworddb = $row1['sPassword'];
        if($oldpassworddb==$oldpassword)
            {
                $sql2="update tbl_faculty set sPassword='$password' where sEmail='$email'";
                $result2=mysqli_query($con,$sql2);
                    if($result2==TRUE)
                    {
                        //echo"changed";
                        $_SESSION['successFlag']=1;
                        return 1;
                    }
                    else
                    {
                        //echo"error";
                        $_SESSION['errorFlag']=1;
                        return 1;
                    }
            }
        else
            {
                //echo"Password doesnt match";
                $_SESSION['passwordFlag']=1;
                return 1;
            }
        }

}
?>