<?php
    $servername="localhost";
    $username="root";
    $password="";
    $db="attendance";
    $con=new mysqli($servername,$username,$password,$db);
    
    if([$_SERVER['REQUEST_METHOD']=="POST"]){
        $id=$_POST['id'];
        $name=$_POST['name'];
        $currentDateTime = date("Y-m-d H:i:s");
        $unique="select id from staff_attendance where id=?";
        $s=$con->prepare($unique);
        $s->bind_param('i',$id);
        $s->execute();
        $result=$s->get_result();

        if($result->num_rows == 0){
            $sql="insert into staff_attendance values (?,?,?)";
            $stmt=$con->prepare($sql);
            $stmt->bind_param('iss',$id,$name,$currentDateTime);

            if($stmt->execute()){
                echo "inserted successfully";
            }
            else{
                echo "Error : ".$sql."<br>".$con->error;
            }
        }
        else{
            echo "already exists";
        }

        
    }
?>