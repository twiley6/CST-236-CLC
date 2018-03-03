<!--CST-236 CLC-Registration and Login Pages
Tim Wiley
Gary Sundquist
Robert Nichols
Jan. 27, 2018
DB management
-->
<?php
Class DBManagement{

    //function to get dbconnection
    public function dbConnect(){
        //set DB connection
        //Gary Sundquist connection info
        //$con = mysqli_connect('localhost', 'admin','password', 'cst236db') or die("couldn't connect");
        //Justin Hamman connection info
        //Robert Nichols connection info
        //Tim Wiley connection info
        $con = mysqli_connect('127.0.0.1', 'root', 'root', 'cst236db') or die("couldn't connect");
        if ($con->connect_error) {
            echo "<p>Error processing SQL transaction. " +
                "Error: </p>" .this.$con->error;
            exit();
        }
        return $con;
    }

    //function to close db connection
    public function dbClose(){
        mysqli_close($this->dbConnect());
    }

    //Process queries such as selects, deletes, inserts
    public function dbQuery($query){
        $result=mysqli_query($this->dbConnect(),$query);
        $this->dbClose();
        return $result;
    }

    //function to update checks old data for changes
    public function dbUpdate($oldDataQuery,$newDataQuery){
        /*if old data exists process new data request else
        echo error */
        if ($oldQueryResult = mysqli_query($this->dbConnect(), $oldDataQuery)){
            mysqli_query($this->dbConnect(), $newDataQuery);
            $this->dbClose();
        }else{
            echo "Could not execute query: " .mysql_error();
        }
    }
}
?>