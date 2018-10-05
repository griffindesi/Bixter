<?php


/**
 *
 */
class Home extends Controller
{
  public function __construct($controller,$action)
  {
    parent::__construct($controller,$action);
  }

public function indexAction()
{
  $DB= DataBase::getInstance();
  $table="users ";
  $sql="SELECT * FROM users";
  $fields=[
        'id'=>'',
        'fname'=>'Hussain Mardini',
        'phone'=>'05375280964',
        'mail'=>'aboodma@gmail.com'
      ];
  // /$newUser=$DB->insert($table,$fields);
  //$KargoQ=$DB->query($sql);
  $KargoQ=$DB->SelectAll($table);
  $users=['count'=>$KargoQ->count(),'resaults'=>$KargoQ->resaults(),'error'=>$KargoQ->error()];
  print_r($users);

  $this->view->render('home/index');
}
public function  newAction() {

  $DB= DataBase::getInstance();
  $table="users ";
  $fields=[
        'id'=>'',
        'fname'=>'Hussain Mardini',
        'phone'=>'05375280964',
        'mail'=>'aboodma@gmail.com'
      ];
  $newUser=$DB->insert($table,$fields);

  dnd($newUser);
}

public function deleteAction()
{

  $DB= DataBase::getInstance();
  $deleteUser=$DB->Delete('users',2);
  dnd($deleteUser);
}

}
