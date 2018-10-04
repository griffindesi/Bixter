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
  $sql="SELECT * FROM `kargo` ";
  $KargoQ=$DB->query($sql);
  dnd($KargoQ);
  $this->view->render('home/index');
}

}
