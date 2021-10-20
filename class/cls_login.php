<?php
Class adminLogin
{
    function login($adminEmail, $adminPass, $remember) {
        include ("connect.php");
        $md5AdminPass = md5($adminPass);
        if(isset($_POST['submit'])){
            $login="SELECT * from tbl_usermaster where sEmail = '$adminEmail' AND iStatus = 1";
            $result = mysqli_query($con,$login);
            if(mysqli_num_rows($result)>0)
            {
                $row=mysqli_fetch_assoc($result);
                $e=$row["sEmail"];
                $p=$row["sPassword"];
                    if($md5AdminPass==$p) {
                        if($remember == 1) {
                            setcookie('cookieEmail', $adminEmail,time()+ 3600);
                            setcookie('cookiePass', $adminPass,time()+ 3600);
                            setcookie("remember","1",time()+ 3600);
                        }
                        else {
                            setcookie('cookieEmail', "");
                            setcookie('cookiePass', "");
                            setcookie("remember","");
                            $_SESSION['cookieUnset'] = 2;
                        }
                         $_SESSION['username'] = $adminEmail;
                         return 1;
                }
                    else return -1;
                }
             else return -2;
        }
    } 
    function changepassword($email,$oldpassword,$password){
        include ("connect.php");
        $result1 = mysqli_query ($con,"select sPassword from tbl_usermaster where sEmail='$email'");
        $row1 = mysqli_fetch_assoc($result1);
        $oldpassworddb = $row1['sPassword'];
        if($oldpassworddb==$oldpassword)
            {
                $sql2="update tbl_usermaster set sPassword='$password' where sEmail='$email'";
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