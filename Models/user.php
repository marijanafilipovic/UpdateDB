 <?php

    class UserModel extends Model {
    public $id;

    public function rollAccount(){
   $result = $this->getAll($model='korisnici');
    return $result; 

    }

    public function changeUserName(){
        if(isset($_POST['submit'])){
            $this->query('UPDATE korisnici SET ime = :ime WHERE id_korisnika = :id');
            $this->bind(':ime', $ime);
            $this->bind(':id', $uid);
            $this->execute();

        }
    }
    public function Akcije(){

    $akcije=$this->getWhere($model='akcije', $key='Simbol');
    $kontaktInfo=$this->getWhere($model='kontakt', $key='Simbol');
    return array('akcije'=>$akcije, 'kontakInfo'=>$kontaktInfo);
}

    public function login(){
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
   
  if($post['submit']){
    $name = $post['email'];
    $password= $post['password'];
    $this->query("SELECT * FROM korisnici WHERE email = :email AND lozinka = :lozinka");
    $this->bind(':email',  $post['email']);
    $this->bind(':lozinka', $password);
    $row = $this->single(); 

    if($row){
        $_SESSION['is_logged_in'] = true;
        $_SESSION['user_data'] = array(
            'id'=>$row['id_korisnika'],
            'email'=>$row['email'],
            'status'=>$row['status']
          
        );
         header('Location:' . ROOT_URL);
     
        }else{
      
        Messages::setMsg("Log nije uspesan.", "errorMsg");

    }
    
    }return;
    }
    
    


public function register(){
       $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
       
        $username=  ($post['username']);
        $lname= ($post['lname']);
        $fname= ($post['fname']);
        $email= ($post['email']);
        $pass= ($post['password']);
          $token=bin2hex(openssl_random_pseudo_bytes(32));
          
   if($post['register'])
   {
if($post['username'] == '' || $post['email']== '' || $post['password']== '')
{
    Messages::setMsg("Molimo popunite sva polja za korisnicko ime, email i lozinku.", "errorMsg");
    return;
}
if($post['password']==$post['password2']){
    if(strlen($post['password'])<5){
         Messages::setMsg("Lozinka mora imati vise od 4 karaktera.", "errorMsg");
    }
}
if(!empty($post['email']))
{
        $this->query("SELECT uemail FROM users WHERE uemail = :uemail");
        $this->bind(':uemail',$email);
        $result= $this->single();
 if($result)
 {   
     Messages::setMsg("Uneti email je vec registrovan.", "errorMsg");
    return;
}

}
if(!empty($post['username']))
{
      $this->query("SELECT * FROM users WHERE uname = :uname");
 $this->bind(":uname", $post['username']);
    $result = $this->single();
  if(!empty($result)){
      Messages::setMsg('Korisnicko ime je vec registrovano.', 'errorMsg');
    return;
}

}
if($post['password']!==$post['password2']){
    Messages::setMsg('Lozinka mora da se potvrdi identicnim unosom.', 'errorMsg');
         return;
}

    if(strlen($post['password'])<5){
         Messages::setMsg('Lozinka mora imati vise od 4 karaktera.', 'errorMsg');
         return;
    }


$this->query("INSERT INTO users(uname,uemail,lastname,fname,password,active_code)VALUES(:uname,:uemail,:lname,:fname,:pass, :token)");
$this->bind(':uname', $post['username']);
$this->bind(':fname', $post['fname']);
$this->bind(':uemail', $post['email']);
$this->bind(':lname', $post['lname']);
$this->bind(':pass', $post['password']);
$this->bind(':token', $token);
 $this->execute();
      if($this->lastInsertId()){
        header('Location:' . ROOT_URL .'users/login');
      }
   }
   return;
}

public function changePassword(){

    if((isset($_POST['send']))&&(!empty($_POST['email']))) {
        $email = ($_POST['email']);

        if ($email) {
            $query = "SELECT * FROM users WHERE uemail = '{$email}'";
            global $conn;
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                require '../PHPMailer/PHPMailerAutoload.php';
                $mail = new PHPMailer;

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = '*********@gmail.com';
                $mail->Password = '********';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('********@gmail.com', 'name');
                $mail->addReplyTo('********@gmail.com', 'TTTTT');
                $mail->addAddress($email);


                $mail->isHTML(true);  // Set email format to HTML


                $mail->Subject = 'You requested new password?';
                $mail->Body = 'To change your password, <br/>go and click on link<br/>http://localhost/ssss/1/inc/newPass.php?email=' . $email;
                echo "If you need help contact as on..";
                if (!$mail->send()) {
                    echo "Try again..";

                }
            }
        }
    }

}
public function changeUserData()
{
if(isset($_POST['submit']))
{
$id_korisnika= $_GET['id'];
        if ($_POST['ime'] == '' || $_POST['email'] == '' || $_POST['prezime'] == '')
        {
          echo "Molimo popunite polja za korisnicko ime, prezime i email.";

        }else {
            $this->query('UPDATE korisnici SET ime, prezime, email VALUES :ime, :prezime, :email WHERE id_korisnika = :id_korisnika');
            $this->bind(':ime', $_POST['ime']);
            $this->bind(':prezime', $_POST['prezime']);
            $this->bind(':email', $_POST['email']);
            $this->bind(':id_korisnika', $id_korisnika);
            if($this->execute()){
                echo "updated data";
            }else{
                echo "error";
            }

        }
        }
        }



 }


 

