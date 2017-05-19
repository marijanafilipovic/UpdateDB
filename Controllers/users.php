<?php
require_once 'models/user.php';
class Users extends Controller{

protected function login()
{
    $viewmodel = new UserModel();
    $this->returnView($viewmodel->login(), true);
    }
    protected function register()
    {
        $viewmodel = new UserModel();
        $this->returnView($viewmodel->register(), true);
    }
    protected function logout()
{
    unset($_SESSION['is_log_in']);
    unset($_SESSION['user_data']);
    session_destroy();
    header('Location:'. ROOT_PATH);
}
public function rollAccount()
{
    $viewmodel = new UserModel();
    $this->returnView($viewmodel->rollAccount(), true);
}

public function change(){
    $viewmodel = new UserModel();
    $this->returnView($viewmodel->getWhere($model='korisnici', $key='id_korisnika',$_GET['id']), true);
}

public function changeUserName()
{
        $viewmodel = new UserModel();
        $this->returnView($viewmodel->getWhere($model='users', $key='uid',$_GET['id']), true);
    if(isset($_POST['submit'])){
        $viewmodel = new UserModel();
        $this->returnView($viewmodel->changeUserData($_POST['ime']),  true);
    }
}

public function changeUserData()
{
    $viewmodel = new UserModel();
    $this->returnView($viewmodel->getWhere($model='korisnici', $key='id_korisnika',$_GET['id']), true);

    if(isset($_POST['submit'])){
        $viewmodel = new UserModel();
        $this->returnView($viewmodel->changeUserData($id_korisnika),  true);
    }
}

public function changePassword()
{
    $viewmodel = new UserModel();
    $this->returnView($viewmodel->changePassword($_GET['email']), true);
}
}

?>