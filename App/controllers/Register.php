<?php


/**
 *
 */
class Register extends Controller
{
  public function __construct($controller,$action)
  {
    parent::__construct($controller,$action);
    $this->load_model('Users');
    $this->view->setLayout('default');
  }

  public function registerAction()
  {
    $validation = new Validate();
    if ($_POST) {
      $validation->check($_POST,
      [
        'username'=>[
          'display'=>"Username",
          'required'=>true,
          'max'=> 25,
          'min'=> 6

        ],
        'password'=>[
          'display'=>"Password",
          'required'=>true,
          'max'=>30,
          'min'=>6
        ],
        'password_Again'=>[
          'display'=>"Password Again",
          'required'=>true

        ],
        'email'=>[
          'display'=>"Email",
          'required'=>true,

        ]
      ]);
      if ($validation->passed()) {
        $options = [
                'cost' => 12,
                      ];
        $password =password_hash(Input::get('password'), PASSWORD_BCRYPT, $options);
        $username = Input::get('username');
        $email = Input::get('email');
        $First_name = Input::get('First_name');
        $Last_Name = Input::get('Last_Name');
        $table = 'users';
        $fields = [
          'username'=>$username,
          'password'=>$password,
          'email'=>$email,
          'fname'=>$First_name,
          'lname'=>$Last_Name
        ];
        $this->UsersModel->signup($fields,$table);
      }
    }
$this->view->displayErrors = $validation->displayErrors();
    $this->view->render('register/register');
  }

  public function saveAction($value='')
  {

  }

public function loginAction()
{
  $validation = new Validate();

  if($_POST){
    // form validation
    $validation->check($_POST,[
      'username'=>[
        'display'=>"Username",
        'required'=> true

      ],
      'password'=>[
        'display'=>"Password",
        'required'=> true

      ]
    ]);


    if ($validation->passed()) {

      $user = $this->UsersModel->findByUsername($_POST['username']);
      if($user &&  password_verify($_POST['password'], $user->password)){
        $remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;
        $user->login($remember);
        //dnd(  $user->login($remember));
        Router::redirect('');
      }else{
        $validation->addError("There is an Error with your Username or Password.");
      }
    }
  }
  $this->view->displayErrors = $validation->displayErrors();
  $this->view->render('register/login');
}

    public function logoutAction(){

      session_unset();
      if(currentUser()){
      currentUser()->logout();
      }
      Router::redirect('register/login');

    }

}
