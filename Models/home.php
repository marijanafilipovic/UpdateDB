<?php

class HomeModel extends Model
{


    public function Index()
    {
        $this->query('SELECT * FROM stat');
        $rows = $this->resultSet();
        return $rows;

    }

    public function stocks()
    {
        $this->query('SELECT * FROM stat');
        $rows = $this->resultSet();
        return $rows;

    }
    public function stat(){
$this->query('SELECT * FROM stat');
$rows = $this->resultSet();
return $rows;

}



}
