<?php
//import model
require_once 'models/home.php';
class Home extends Controller
{

    protected function Index()
    {

        $viewmodel = new HomeModel();
        $this->returnView($viewmodel->index(), true);

    }

    protected function stocks()
    {

        $viewmodel = new HomeModel();
        $this->returnView($viewmodel->stocks(), true);

    }

    protected function stat()
    {

        $viewmodel = new HomeModel();
        $this->returnView($viewmodel->stat(), true);

    }
}
?>