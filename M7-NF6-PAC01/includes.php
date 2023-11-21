<?php
//Error's quote
$error = 'Error de Connexión número (' . $bbdd->connect_errno . ') ' . $bbdd->connect_error;
//FUNCTIOS QUERIES
//This function execute a query
    function executeQuery($query){
        //Call vars
        global $bbdd;
        global $error;

        //Execute query
        $data = @$bbdd->query($query) or die($error);
    }
    //This function extract Data
    function extractData($query){

        //Call vars
        global $bbdd;
        global $error;

        //Execute query and reset
        $data = @$bbdd->query($query) or die($error);
        $data->data_seek(0);

        //Return data
        return $data;
    }

//FUNCTIONS TO ADD DATA
    //This function add a movie
    function  add_movie($data){
        $name = $data['movie_name'];
        $type = $data['movie_type'];
        $year = $data['movie_year'];
        $actor = $data['movie_actor'];
        $director = $data['movie_director'];

        $query = "INSERT INTO
        movie
            (movie_name, movie_year, movie_type, movie_leadactor,
            movie_director)
        VALUES
            ('$name', '$year', $type, $actor,  $director )";
        
        executeQuery($query);

        return true;
    
    }
    //This function add a person
    function  add_people($data){
        $name = $data['people_name'];
        $actor = $data['people_actor'];
        $director = $data['people_director'];
        $query = "INSERT INTO
        people
            (people_fullname, people_isactor, people_isdirector)
        VALUES
            ('$name', $actor, $director)";  
        executeQuery($query);
        return true;  
    }

//FUNCTIONS TO EDIT DATA

    //This functions edit a movie 
    function edit_movie($data){
        $name = $data['movie_name'];
        $type = $data['movie_type'];
        $year = $data['movie_year'];
        $actor = $data['movie_actor'];
        $director = $data['movie_director'];
        $id = $data['movie_id'];

        $query = "UPDATE movie SET
        movie_name = '$name' ,
        movie_year = '$year',
        movie_type = '$type',
        movie_leadactor = '$actor',
        movie_director = '$director' 
        WHERE
        movie_id = $id";
        executeQuery($query);
        return true;   
    }
    //This function edit a person
    function edit_people($data){
        $name = $data['people_name'];
        $actor = $data['people_actor'];
        $director = $data['people_director'];
        $id = $data['people_id'];

        $query = "UPDATE people SET
        people_fullname = '$name',
        people_isactor = '$actor',
        people_isdirector = '$director'
        WHERE
        people_id = $id";

        executeQuery($query);
        return true;
    }

//FUNCTIONS TO PRINT FORMS

    //This function print de form's movies
    function form_movie($id){
        if ($_GET['action'] == 'edit'){
            $query = "SELECT
                movie_name, movie_type, movie_year, movie_leadactor, movie_director
            FROM
                movie
            WHERE
                movie_id =  $id";
            $data = extractData($query);
            $row = $data->fetch_assoc();
            extract($row);
      
            $name = $row['movie_name'];
            $type = $row['movie_type'];
            $year = $row['movie_year'];
            $actor = $row['movie_leadactor'];
            $director = $row['movie_director'];

        } else {
            $name = '';
            $type = '';
            $year = '';
            $actor = '';
            $director = '';
        }
        ?>
        <form action="<?php echo URL ?>" method="POST">
                                            <label for="movie_name">Movie name</label>
                                            <input type="text" id="movie_name" name="movie_name" value="<?php echo $name ?>"required>
                                            </br>
                                            <label for="movie_type">Movie type</label>
                                            <select id="movie_type" name="movie_type" required>
                                                <?php
                                                        $query_type = 'SELECT
                                                        movietype_id, movietype_label
                                                    FROM
                                                        movietype
                                                    ORDER BY
                                                        movietype_label';

                                                    $data_movie = extractData($query_type);
                                                    while( $row_movie = $data_movie->fetch_assoc()):
                                                        //Extract row
                                                        extract($row_movie);
                                                        ?>
                                                        <option value="<?php echo $row_movie['movietype_id']?>" <?php echo $type ==  $row_movie['movietype_id'] ? 'selected' : '' ?> ><?php echo $row_movie['movietype_label'] ?></option>
                                                        <?php
                                                    endwhile;
                                                ?>
                                            </select>
                                            </br>
                                            <label for="movie_year">Movie year</label>
                                            <select id="movie_year" name="movie_year" required>
                                                <?php
                                                    // populate the select options with years
                                                    for ($yr = date("Y"); $yr >= 1970; $yr--) {
                                                        ?>
                                                        <option value="<?php echo $yr ?>" <?php echo $year ==  $yr ? 'selected' : '' ?>><?php echo $yr ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                            </br>
                                            <label for="movie_actor">Lead Actor</label>
                                            <select id="movie_actor" name="movie_actor" required>
                                                <?php
                                                        $query_actor = 'SELECT
                                                        people_id, people_fullname
                                                    FROM
                                                        people
                                                    WHERE
                                                        people_isactor = 1
                                                    ORDER BY
                                                        people_fullname';

                                                    $data_actor = extractData($query_actor);
                                                    while( $row_actor = $data_actor->fetch_assoc()):
                                                        //Extract row
                                                        extract($row_actor);
                                                        ?>
                                                        <option value="<?php echo $row_actor['people_id']?>" <?php echo $actor ==  $row_actor['people_id'] ? 'selected' : '' ?>><?php echo $row_actor['people_fullname'] ?></option>
                                                        <?php
                                                    endwhile;
                                                ?>
                                            </select>
                                            </br>
                                            <label for="movie_director">Director</label>
                                            <select id="movie_director" name="movie_director" required>
                                                <?php
                                                        $query_director = 'SELECT
                                                        people_id, people_fullname
                                                    FROM
                                                        people
                                                    WHERE
                                                        people_isdirector = 1
                                                    ORDER BY
                                                        people_fullname';

                                                    $data_director = extractData($query_director);
                                                    while( $row_director = $data_director->fetch_assoc()):
                                                        //Extract row
                                                        extract($row_director);
                                                        ?>
                                                        <option value="<?php echo $row_director['people_id']?>" <?php echo $director ==  $row_director['people_id'] ? 'selected' : '' ?> ><?php echo $row_director['people_fullname'] ?></option>
                                                        <?php
                                                    endwhile;
                                                ?>
                                            </select>
                                            </br>
                                            <?php
                                            if ($_GET['action'] == 'edit'):
                                            ?>
                                                <input type="hidden" value="<?php echo $id ?> " name="movie_id" />
                                            <?php
                                            endif;
                                            ?>
                                                <input type="submit" value="<?php echo ucfirst($_GET['action'])?>" name="enviar_movie">
                                        </form>
        <?php
    }
    //This function print de form's people
    function form_people($id){
        if ($_GET['action'] == 'edit'){
            $query = "SELECT
                *
                FROM
                people
                WHERE
                people_id = $id";
            $data = extractData($query);
            $row = $data->fetch_assoc();
            extract($row);

            $name_actor = $row['people_fullname']; 
            $is_actor = $row['people_isactor'];     
            $is_director = $row['people_isdirector'];   

        } else {
            $name_actor = '';
            $is_actor = '';
            $is_director = '';
        }
        ?>
        <form action="<?php echo URL ?>"  method="POST">
            <label for="people_name">Name</label>
            <input type="text" id="people_name" name="people_name" value='<?php echo $name_actor ?>'>
            </br>
            <label for="people_actor">Actor:</label>
            <select name="people_actor" id="people_actor">
                <option value="0" <?php echo $is_actor == '0' ? 'selected' : ''?>>No</option>
                <option value="1" <?php echo $is_actor == '1' ? 'selected' : ''?>>Yes</option>
            </select>
            </br>
            <label for="people_director">Director:</label>
            <select name="people_director" id="people_director">
            <option value="0" <?php echo $is_director == '0' ? 'selected' : ''?>>No</option>
            <option value="1" <?php echo $is_director == '1' ? 'selected' : ''?>>Yes</option>
            </select>
            </br>
            <?php
                if ($_GET['action'] == 'edit'):
                    ?>
                        <input type="hidden" value="<?php echo $id ?> " name="people_id" />
                    <?php
                endif;
            ?>
            <input type="submit" value="<?php echo ucfirst($_GET['action'])?>" name="enviar_people">
        </form>
        <?php
    }

//FUNCTIONS TO PRINT GLOBAL ERRORS
    //This function print and error 
    function errorFound(){
        echo "<p>Sorry, you cannot access to this page...</p>";  
    }
?>