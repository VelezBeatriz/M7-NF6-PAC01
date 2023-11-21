<?php require('connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration panel</title>
    <style>
        h1{
            text-align: center;
        }
        table{
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
        }

        td a {
            display: block;
            width: 100%;
            text-align: center;

        }
        a {
            color:blue;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <h1>Administration panel</h1>
    <!-- CONNEXION BBDD -->
    <?php
    //Query select 
    $query_movie = 'SELECT movie_id, movie_name FROM  movie ORDER BY  movie_name ASC';
    //Call this function to extract data
    $data = extractData($query_movie);
    
    if($data->num_rows == 0):
        
        ?> <h2>¡This table is empty!</h2> <?php
        @$bbdd->close;
        exit;
        
    else:
        ?>
        <table>
            <thead>
                <tr>
                    <th colspan="3" >Movies <a href="<?php echo URL_SITE;?>form.php?data=movie&action=add">[ADD]</a></th>                    
                </tr>
            </thead>
            <tbody>
        <?php
        while( $row = $data->fetch_assoc()):
            //Extract row
            extract($row);
            ?>
            <tr>
                  <td><?php echo $movie_name?></td>
                  <td><a href="<?php echo URL_SITE;?>form.php?data=movie&action=edit&id=<?php echo $movie_id ?>">[EDIT]</a></td>
                  <td><a href="<?php echo URL_SITE;?>delete.php?data=movie&id=<?php echo $movie_id ?>">[DELETE]</a></td>
            </tr>
            <?php
        endwhile;
        ?>
        </tbody>
    </table>
    <?php
    endif; 
    ?>
    <br/>
    <?php  

     //Query select 
    $query_people = 'SELECT people_id, people_fullname FROM  people ORDER BY  people_fullname ASC';
    //Call this function to extract data
    $data = extractData($query_people);
    
    if($data->num_rows == 0):

        ?> <h2>¡This table is empty!</h2> <?php
        @$bbdd->close;
        exit;
        
    else:
        ?>
        <table>
            <thead>
                <tr>
                    <th colspan="3" >People <a href="<?php echo URL_SITE;?>form.php?data=people&action=add">[ADD]</a></th>                    
                </tr>
            </thead>
            <tbody>
        <?php
        while( $row = $data->fetch_assoc()):
            //Extract row
            extract($row);
            
            ?>
            <tr>
                  <td><?php echo $people_fullname?></td>
                  <td><a href="<?php echo URL_SITE;?>form.php?data=people&action=edit&id=<?php echo $people_id ?>">[EDIT]</a></td>
                  <td><a href="<?php echo URL_SITE;?>delete.php?data=people&id=<?php echo $people_id ?>">[DELETE]</a></td>
            </tr>
            <?php
        endwhile;
        ?>
        </tbody>
    </table>
    <?php
    endif;
    ?> 
</body>
</html>