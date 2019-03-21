<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Convert Table to JSON</title>
</head>
<body>
    <?php
    
        $connect = mysqli_connect("localhost", "root","", "margarita");
        
        $sql = "SELECT * FROM `vertices`,`parcelas` WHERE `parcelas`.`id` = `vertices`.`id_parcela`";
    
        $result = mysqli_query($connect, $sql);
    
        $json_array = array();
    
        while($row = mysqli_fetch_assoc($result)){
            $json_array[] = $row;
        }
    
        echo '<pre>';
        print_r($json_array);
        echo '</pre>';
    
        $json = json_encode($json_array);
        echo $json;
        
    ?>
</body>
</html>