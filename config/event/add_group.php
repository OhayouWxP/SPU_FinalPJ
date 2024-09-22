<?php
    if(isset($_POST['addgroup'])){
        $Group_Name = $_POST['group'];
        if($Group_Name ==""){
            $_SESSION['status_insert'] = 'nulldata'; 
            header("location:list_group.php");
        }
        else{
        $query_max_group = $db_connect-> prepare("
                                                    SELECT 
                                                            MAX(CAST(SUBSTRING(Group_ID, 2) AS INT)) as Max_Group_ID
                                                    FROM 
                                                            tbgroup
        ");
        $query_max_group -> execute();
        $fetch_max_group_id = $query_max_group -> fetch(PDO::FETCH_ASSOC);
        $max_group_id = $fetch_max_group_id['Max_Group_ID'];

        if($max_group_id === NULL || $max_group_id == 0){
            $max_group_id = 1; 
            $new_group_id = "G".$max_group_id;
            $insert_query = $db_connect -> prepare("
                                                    INSERT INTO 
                                                                    tbgroup
                                                    VALUES
                                                                (
                                                                    :Group_ID,
                                                                    :Group_Name,
                                                                    NULL,
                                                                    :Emp_ID,
                                                                    NOW(),
                                                                    '0'
                                                                )
            ");
            if ($insert_query->execute([
                ':Group_ID' => $new_group_id,
                ':Group_Name' => $Group_Name,
                ':Emp_ID' => $_SESSION['Emp_ID']
            ])) {
                $_SESSION['status_insert'] = 'true'; 
                header("location:list_group.php");
            } else {
                $_SESSION['status_insert'] = 'false'; 
                header("location:list_group.php");
            }
            
        }
        else{
            $max_group_id = $max_group_id + 1; 
            $new_group_id = "G".$max_group_id;
            $insert_query = $db_connect -> prepare("
                                                    INSERT INTO 
                                                                    tbgroup
                                                    VALUES
                                                                (
                                                                    :Group_ID,
                                                                    :Group_Name,
                                                                    NULL,
                                                                    :Emp_ID,
                                                                    NOW(),
                                                                    '0'
                                                                )
            ");
            if ($insert_query->execute([
                ':Group_ID' => $new_group_id,
                ':Group_Name' => $Group_Name,
                ':Emp_ID' => $_SESSION['Emp_ID']
            ])) {
                $_SESSION['status_insert'] = 'true'; 
                header("location:list_group.php");
            } else {
                $_SESSION['status_insert'] = 'false'; 
                header("location:list_group.php");
            }
        }
    }
}
?>