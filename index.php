<?php
$site_title = 'Boogle';
include('dbconnect.php')
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title><?php echo $site_title; ?></title>
        <link rel="stylesheet" type="text/css" href="./main.css"></link>
    </head>
    <style>
    input
    {
        width: 500px;
        height: 35px;
        border-radius: 5px;
        border: 1px color black;
    }
    #searchbutton
    {
        width: 150px;
        height: 40px;
        border-radius: 5px;
        border: 1px color green;
        color: color black
    }
    #searchbutton:hover
    {
        background-color: green;
        color: white;
    }
</style>
    <body>
        <div id = "wrapper">
            <div id="top header">
                <div id ="logo">
                    <h1><center><a href="index.php"><img src="boogle_image.jpg" width="30%"></a></center></h1>
                </div>
            </div> 
            <div id = "main" class = "shawdow-box"><div id = "content">
                <center>
                <form action="" method = "GET" name="">
                    <table>
                        <tr>
                            <td><input type="text" name="k" placeholder="Search for Something" autocomplete="off"></td>
                            <td><input type="submit" name="" id="searchbutton" value="Search"></td>
                        </tr>
                    </table> 
                </form>   
                </center> 
                <br><br>
                <table>
                    <?php
                        if (isset($_GET['k']) && $_GET['k'] != '') {
                            $k = trim($_GET['k']);
                            $keywords = explode(' ',$k);
                            $query_string = "SELECT * FROM index_table WHERE ";
                            foreach($keywords as $word) {
                                $query_string .= " keywords LIKE '%" . $word . "%' OR ";

                            }
                            $query_string = substr($query_string, 0, strlen($query_string) - 3);
                            $conn= new PDO('mysql:host=127.0.0.1;dbname=boogle_search', 'root', '');
                            $statement = $conn->prepare($query_string);
                            $statement->execute();
                            $result = $statement->fetchAll();
                            if ($result) {
                                foreach($result as $row) {
                                    ?>
                                    <tr>
                                    <td><a href="<?= $row['url']; ?>" target="_blank"><?= $row['title']; ?></a></td>
                                    </tr>
                                    <tr>
                                    <td><?= $row['description']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><div style="height:10px;"></div></td>
                                    </tr>
                                    <?php
                                }
                            }else
                                echo "No results found";
                        }
                    ?>    
                <table>    
        </div></div>        
    </body>    
</html>    
