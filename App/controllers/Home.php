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
  $fields=[
        'id'=>'',
        'fname'=>'Hussain Mardini',
        'phone'=>'05375280964',
        'mail'=>'aboodma@gmail.com'
      ];
  // /$newUser=$DB->insert($table,$fields);
  $KargoQ=$DB->SelectAll($table);
  dnd($KargoQ);

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

}
