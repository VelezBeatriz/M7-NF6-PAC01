<?php require('connect.php'); ?>
<?php
if(isset($_POST['enviar_movie'])):
    if($_GET['action'] == 'add'){

        unset($error);
        $error = array(); 
          
    //  CHECKS 
        $movie_name = $_POST['movie_name'];
        $movie_name = depurate($movie_name);
        if (empty($movie_name)) {
            $error[] = urlencode('Please enter a movie name.');
        } 

        $movie_type = $_POST['movie_type'];
        $movie_type =  depurate($movie_type);
        if (empty($movie_type)) {
            $error[] = urlencode('Please select a movie type.');
        }

        $movie_year = $_POST['movie_year'];
        $movie_year = depurate($movie_year);
        if (empty($movie_year)) {
            $error[] = urlencode('Please select a movie year.');
        }

        $movie_actor = $_POST['movie_actor'];
        $movie_actor = depurate($movie_actor);
        if (empty($movie_actor)) {
            $error[] = urlencode('Please select a lead actor.');
        }

        $movie_director = $_POST['movie_director'];
        $movie_director = depurate($movie_director);
        if (empty($movie_director)) {
            $error[] = urlencode('Please select a director.');
        }

        $movie_release = $_POST['movie_release'];
        $result_release = createDate($movie_release);
        
        if (empty($movie_release)) {
            $error[] = urlencode('Please write the date.');
        } else {
            if (isset($result_release['error'])) {
                $error[] =  $result_release['error'];
            } else {
                $movie_release = $result_release['date'];
            }
        }
        
        $movie_rating = $_POST['movie_rating'];
        $result_rating = checkRating($movie_rating);
        if (empty($movie_rating)) {
            $error[] = urlencode('Please write the rating.');
        } else {
            if (isset($result_rating['error'])) {
                $error[] =  $result_rating['error'];
            } else {
                $movie_rating = $result_rating['rating'];
            }
        }

     
    
    //  ERRORS OR ADD
        if (empty($error)) {

            $allData = [                      
                'movie_name' => $movie_name,
                'movie_type' => $movie_type,
                'movie_year' => $movie_year,
                'movie_actor' => $movie_actor,
                'movie_director' => $movie_director,
                'movie_release' => $movie_release,
                'movie_rating' => $movie_rating
            ];

                $add = add_movie($allData);

                    if($add){
                        echo '<p>¡Película añadida exitosamente!</p>';
                    }
        } else {
            header('Location:index.php?error=' . join('<br/>', $error));
        }

    } else {
            unset($error);
            $error = array();   

    // CHECKS

            $movie_name = $_POST['movie_name'];
            $movie_name = depurate($movie_name);
            if (empty($movie_name)) {
                $error[] = urlencode('Please enter a movie name.');
            } 

            $movie_type = $_POST['movie_type'];
            $movie_type = depurate($movie_type);
            if (empty($movie_type)) {
                $error[] = urlencode('Please select a movie type.');
            }

            $movie_year = $_POST['movie_year'];
            $movie_year = depurate($movie_year);
            if (empty($movie_year)) {
                $error[] = urlencode('Please select a movie year.');
            }

            $movie_actor = $_POST['movie_actor'];
            $movie_actor = depurate($movie_actor);
            if (empty($movie_actor)) {
                $error[] = urlencode('Please select a lead actor.');
            }

            $movie_director = $_POST['movie_director'];
            $movie_director = depurate($movie_director);
            if (empty($movie_director)) {
                $error[] = urlencode('Please select a director.');
            }

            $movie_id = $_POST['movie_id'];
            $movie_id = depurate($movie_id);
            if (empty($movie_id)) {
                $error[] = urlencode('ID removed');
            }

            $movie_release = $_POST['movie_release'];
            $result_release = createDate($movie_release);
            
            if (empty($movie_release)) {
                $error[] = urlencode('Please write the date.');
            } else {
                if (isset($result_release['error'])) {
                    $error[] =  $result_release['error'];
                } else {
                    $movie_release = $result_release['date'];
                }
            }
            
            $movie_rating = $_POST['movie_rating'];
            $result_rating = checkRating($movie_rating);
    
            if (empty($movie_rating)) {
                $error[] = urlencode('Please write the rating.');
            } else {
                if (isset($result_rating['error'])) {
                    $error[] =  $result_rating['error'];
                } else {
                    $movie_rating = $result_rating['rating'];
                }
            }

    // ERROR O EDIT
    
        if (empty($error)) {

            $allData = [                      
                'movie_name' => $movie_name,
                'movie_type' => $movie_type,
                'movie_year' => $movie_year,
                'movie_actor' => $movie_actor,
                'movie_director' => $movie_director,
                'movie_release' => $movie_release,
                'movie_rating' => $movie_rating,
                'movie_id' => $movie_id
            ];

                $edit = edit_movie($allData);
                if($edit){
                    echo '<p>¡Película editada exitosamente!</p>';
                }

        } else {
            header('Location:index.php?error=' . join('<br/>', $error));
        }
    

      
    }
  
endif;
if(isset($_POST['enviar_people'])):
    if($_GET['action'] == 'add'){
        unset($error);
        $error = array(); 
       
        //CHECKS
        $people_name = $_POST['people_name'];
        $people_name = depurate($people_name);
        if (empty($people_name)) {
            $error[] = urlencode('Please enter a people name.');
        } 

        $people_actor = $_POST['people_actor'];
        $people_actor = depurate($people_actor);
        if (empty($people_actor)) {
            $error[] = urlencode('Please select is or is not actor.');
        } else {
            if($people_actor != '1' && $people_actor != '0'){
            $error[] = urlencode('Please select is or is not actor.');
            }
        }

        $people_director = $_POST['people_director'];
        $people_director = depurate($people_director);
        if (empty($people_director)) {
            $error[] = urlencode('Please select is or is not director.');
        } else {
            if($people_director != '1' && $people_director != '0'){
                $error[] = urlencode('Please select is or is not director.');
            }
        }

        //ERRORS OR ADD
        if (empty($error)) {

            $allData = [                      
                'people_name' => $people_name,
                'people_actor' => $people_actor,
                'people_director' => $people_director
            ];

                $add = add_people($allData);
                if($add){
                    echo '<p>¡Persona añadida exitosamente!</p>';
                }
        } else {
            header('Location:index.php?error=' . join('<br/>', $error));
        }

            
          
    } else {
        unset($error);
        $error = array(); 

        //CHECKS
        $people_name = $_POST['people_name'];
        $people_name = depurate($people_name);
        if (empty($people_name)) {
            $error[] = urlencode('Please enter a people name.');
        } 

        $people_actor = $_POST['people_actor'];
        $people_actor = depurate($people_actor);
        if (empty($people_actor)) {
            $error[] = urlencode('Please select is or is not actor.');
        } else {
            if($people_actor != '1' && $people_actor != '0'){
            $error[] = urlencode('Please select is or is not actor.');
            }
        }

        $people_director = $_POST['people_director'];
        $people_director = depurate($people_director);
        if (empty($people_director)) {
            $error[] = urlencode('Please select is or is not director.');
        } else {
            if($people_director != '1' && $people_director != '0'){
                $error[] = urlencode('Please select is or is not director.');
            }
        }
        //ERRORS OR ADD
        if (empty($error)) {

            $allData = [                      
                'people_name' => $people_name,
                'people_actor' => $people_actor,
                'people_director' => $people_director
            ];
                $edit = edit_people($_POST);
                if($edit){
                    echo '<p>¡Persona editada exitosamente!</p>';
                }
        } else {
            header('Location:index.php?error=' . join('<br/>', $error));
        }
            
    }

endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if(isset($_GET['action'])):
        if( ($_GET['action'] == 'add') || ($_GET['action'] == 'edit')):
            $action = ucwords($_GET['action']);

        else:
           $action = 'Not Found';
        endif;
    else:
        $action = 'Not Found';
    endif;
    ?>
    <title>Page - <?php echo $action?></title>
</head>
<body>
    <?php
    //CHECK ACTION
    if(isset($_GET['action'])):
        if( ($_GET['action'] == 'add') || ($_GET['action'] == 'edit')):
            //CHECK DATA
            if(isset($_GET['data'])):
                if( ($_GET['data'] == 'movie') || ($_GET['data'] == 'people')):
                    //I'm a movie or persona AND I'm an action
                    $table = $_GET['data'];
                    switch ($_GET['action']):
                        case 'add':
                            //START ACTION - ADD
                            switch ($_GET['data']):
                                case 'movie':
                                    form_movie(-1);
                                    break;
                                case 'people':
                                    form_people(-1);
                                    break;
                                default:
                                    errorFound();
                            endswitch;
                            //END ACTION - ADD
                            break;
                        case 'edit':
                            //START ACTION - EDIT
                                //CHECK IF ID EXIST
                                    if(isset($_GET['id'])):
                                        if(is_numeric($_GET['id'])):
                                            //CHECK IF ID IS INTO DATA
                                            $id = $_GET['id'];
                                            $id_name = ($table === 'movie') ? 'movie_id' : 'people_id';
                                            $query = "SELECT * FROM  $table WHERE $id_name = $id ";
                                            $data = extractData($query);

                                            if($data->num_rows == 0):
                                                echo "<p>Sorry, these data don't exist...</p>";
                                            else:
                                                    //THIS ID EXIST                                                
                                                    switch($_GET['data']):
                                                        //I'M A MOVIE
                                                        case 'movie':
                                                            form_movie($id);
                                                            break;
                                                        //I'M A PERSON
                                                        case 'people':
                                                            form_people($id);
                                                            break;
                                                        
                                                    endswitch;
                                            endif;
                                        else:
                                            errorFound();
                                        endif;
                                    else:
                                        errorFound();
                                    endif;

                            //END ACTION - EDIT
                            break;
                        default:
                            errorFound();
                    endswitch;

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

    // data=people&action=add


    ?>
    <br/>
    <a href="<?php echo URL_RETURN; ?>">Return to administration panel</a>


</body>
</html>