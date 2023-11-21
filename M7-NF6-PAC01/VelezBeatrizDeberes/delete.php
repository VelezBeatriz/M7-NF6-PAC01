<?php require('connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page - Delete</title>
</head>
<body>
    <?php

    if(isset($_GET['data'])):
        if( ($_GET['data'] == 'movie') || ($_GET['data'] == 'people')):
            //I'm a movie or persona AND I'm an action
            $table = $_GET['data'];
                if(isset($_GET['id'])):
                    if(is_numeric($_GET['id'])):
                        //CHECK IF ID IS INTO DATA
                        $id = $_GET['id'];
                        $id_name = ($table === 'movie') ? 'movie_id' : 'people_id';
                        $query = "SELECT * FROM  $table WHERE $id_name = $id ";
                        $data = extractData($query);
                        if($data->num_rows == 0):
                            echo "<p>Sorry, these data don't exist...</p>";
                            ?>
                            <a href="<?php echo URL_RETURN; ?>">Return to administration panel</a>
                            <?php
                        else:
                            //THIS ID EXIST                                                
                            switch($_GET['data']):
                                //I'M A MOVIE
                                case 'movie':
                                     //Query select 
                                        $query_movie = "SELECT movie_name, movie_year FROM  movie WHERE movie_id = $id";
                                        //Call this function to extract data
                                        $data = extractData($query_movie);
                                        $row = $data->fetch_assoc();
                                        extract($row);    
                                    ?>
                                        <p>Are you sure you want to delete the movie <?php echo $row['movie_name'] . " - " . $row['movie_year']  ?>?</p>
                                        <a href="<?php echo URL_RETURN; ?>">No! That was a mistake...</a>
                                        <a href="<?php echo URL; ?>&delete=true">Yes! This movie's so ancient</a>
                                        <?php
                                        if(isset($_GET['delete'])){
                                            if($_GET['delete']){
                                                  $query = "DELETE FROM movie WHERE movie_id = $id";
                                                  executeQuery($query);
                                                ?>
                                                    </br>
                                                    <p>Movie deleted...</p>
                                                    <a href="<?php echo URL_RETURN; ?>">Return to administration panel</a>
                                                <?php
                                            }
                                        }
                                    break;
                                //I'M A PERSON
                                case 'people':
                                        //Query select 
                                        $query_people = "SELECT people_fullname FROM  people WHERE people_id = $id";
                                        //Call this function to extract data
                                        $data = extractData($query_people);
                                        $row = $data->fetch_assoc();
                                        extract($row);    
                                    ?>
                                        <p>Are you sure you want to delete <?php echo $row['people_fullname'] ?>?</p>
                                        <a href="<?php echo URL_RETURN; ?>">No! That was a mistake...</a>
                                        <a href="<?php echo URL; ?>&delete=true">Yes! This person isn't fancy</a>
                                        <?php
                                        if(isset($_GET['delete'])){
                                            if($_GET['delete']){
                                                    $query = "DELETE FROM people WHERE people_id = $id";
                                                    executeQuery($query);
                                                ?>
                                                    </br>
                                                    <p>Person deleted...</p>
                                                    <a href="<?php echo URL_RETURN; ?>">Return to administration panel</a>
                                                <?php
                                            }
                                        }
                                    break;                             
                            endswitch;                    
                        endif;
                    else:
                        errorFound();
                    endif;
                else:
                    errorFound();
                endif;
        else:
            errorFound();
        endif;
    else:
        errorFound();
    endif;
    ?>    
</body>
</html>
