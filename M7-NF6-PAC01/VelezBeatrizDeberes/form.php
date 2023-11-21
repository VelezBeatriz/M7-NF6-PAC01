<?php require('connect.php'); ?>
<?php
if(isset($_POST['enviar_movie'])):
    if($_GET['action'] == 'add'){
        $add = add_movie($_POST);
        if($add){
            echo '<p>¡Película añadida exitosamente!</p>';
        }
    } else {
        $edit = edit_movie($_POST);
        if($edit){
            echo '<p>¡Película editada exitosamente!</p>';
        }
    }
  
endif;
if(isset($_POST['enviar_people'])):
    if($_GET['action'] == 'add'){
        $add = add_people($_POST);
        if($add){
            echo '<p>¡Persona añadida exitosamente!</p>';
        }
    } else {
        $edit = edit_people($_POST);
        if($edit){
            echo '<p>¡Persona editada exitosamente!</p>';
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