<?php
class searchSt{
    
    
    private $link;
    private $host, $user,$ps,$db;
    private $username, $password, $sql,$login, $data, $rows;

    public function __construct(){
    
     
        $this -> host = "localhost";
        $this -> user = "root";
        $this -> ps = "lumas";
        $this -> db = "mpghs";
        $this -> connect();

    }
    
    public function connect(){
        $this -> link = mysql_connect($this->host, $this->user, $this->ps);
        mysql_select_db($this -> db) or die("database not found");
        
    }
    
    
    
    
    public function search(){
        
        
        if(isset($_POST['hide'])){
            
            $search_text_value = $_POST['search_txt'];
            $sql = "select * from students as s, picture as p where s.mobile = p.id and ( s.fname like '%{$search_text_value}%' OR s.lname like '%{$search_text_value}%' OR s.passing_year like '%{$search_text_value}%')";
        $getValues = mysql_query($sql);
            $rows_num = mysql_num_rows($getValues);
            
            if ( $rows_num <= 0){
                
                ?>

    <div class="col-sm-6 col-xs-12 col-sm-offset-3">
        <h1 style="color: red;">Sorry! We cannot find whaterver you want. </h1>
    </div>


    <?php
                
            }else{
                while($data = mysql_fetch_array($getValues)){
            if($data[11] > 3){
            ?>

        <div class="col-xs-12 col-sm-4">
            <div class="thumbnail">

                <div class="img-holder">
                    <img class="img-responsive img-thumbnail" src="<?php echo $data[13];?>" width="242" height="200">
                </div>



                <div class="caption">
                    <div>
                        <h3><?php echo $data[0]." ".$data[1];?></h3>
                    </div>
                    <div>
                        <h5><span class="fa fa-birthday-cake"></span> <?php echo date('F j, Y',strtotime($data[2]));?></h5>
                    </div>

                    <div class="">

                        <h5><span class="fa fa-tint fa-2x"></span> <?php echo $data[4];?></h5>
                    </div>

                    <div class="">
                        <h5><span class="fa fa-mobile fa-2x"></span> <?php echo $data[5];?></h5>
                    </div>

                    <div class="">

                        <h5><span class="fa fa-envelope"></span> <?php echo $data[6];?></h5>
                    </div>
                    <div class="">

                        <h5><span class="glyphicon glyphicon-education"></span> <?php echo $data[8];?></h5>
                    </div>
                    <div class="">

                        <h5><span class="fa fa-university"></span> <?php echo $data[9];?></h5>
                    </div>

                    <div class="">

                        <h5><span class="fa fa-briefcase"></span> <?php echo $data[10];?></h5>
                    </div>

                </div>
            </div>
        </div>



        <?php
            }
        }
            }
        
            
        }
        
        
    }
    
    
    
    
}


?>
