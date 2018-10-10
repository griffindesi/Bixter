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
   $table="users";
   $fields=[
        'conditions' => ['phone=05375280964','fname=?'] ,
         'bind' =>['05375280964'],
         'order' =>"fname,mail",
         'limit' =>5
       ];
   $colunms=$DB->find('users',[
      'conditions' =>['phone = 020202025'] ,
         'bind' =>['020202025'],
         'order' =>"fname,mail",
         'limit' =>5
       ]);
    dnd($colunms);
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
