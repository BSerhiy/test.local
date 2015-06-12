<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11.06.2015
 * Time: 23:03
 */
class Output extends CFormModel
{
   //public $find;
    private $AuthorUser = array();
    private $FirstYearUser = 0;
    private $LastYearUser = 0;
    private $GenreUser = '';

    public function getAuthorName(){
        $models = author::model()->findAll();
        $list = CHtml::listData($models, 'id_author', 'name_author');
        return $list;
    }
    public function  getAuthorSurname(){
        $models = author::model()->findAll();
        $list = CHtml::listData($models, 'id_author', 'surname_author');
        return $list;
    }
    public function getGenre(){
        $models = genre::model()->findAll();
        $list = CHtml::listData($models, 'id_genre', 'name_genre');
        return  $list;
    }
    public function setAuthorUser($_AuthorUser){
        $this->AuthorUser = $_AuthorUser;
        return $this;
    }
    public function setFirstYearUser($_FirstYearUser){
        $this->FirstYearUser = $_FirstYearUser;
        return $this;
    }
    public function setLastYearUser($_LastYearUser){
        $this->LastYearUser = $_LastYearUser;
        return $this;
    }
    public function  setGenreUser($_GenreUser){
        $this->GenreUser = $_GenreUser;
        return $this;
    }
    public function findCriteria(){
        $criteria = new CDbCriteria();
        $criteria->alias = 'book';
       // var_dump($this->$GenreUser);
        if(count($this->AuthorUser)!=0) {
            for ($i = 0; $i < count($this->AuthorUser); $i++) {
                if ($i < count($this->AuthorUser) - 1) {
                    if($this->GenreUser != '') {
                        $criteria->condition .= ' name_genre = ' . "'" . $this->GenreUser . "' and";
                    }
                    if ($this->FirstYearUser != 0) {
                        $criteria->condition .= ' year_of_publication >=' . $this->FirstYearUser ." and";
                    }
                    if (($this->LastYearUser) != 0) {
                        $criteria->condition .= ' year_of_publication <= ' . $this->LastYearUser. " and";
                    }
                    $criteria->condition .= ' surname_author = ' ."'". $this->AuthorUser[$i] ."' or ";
                } else {
                    if($this->GenreUser != '') {
                        $criteria->condition .= ' name_genre = ' . "'" . $this->GenreUser . "' and";
                    }
                    if ($this->FirstYearUser != 0) {
                        $criteria->condition .= ' year_of_publication >=' .$this->FirstYearUser. " and";
                    }
                    if (($this->LastYearUser) != 0) {
                        $criteria->condition .= ' year_of_publication <= ' .$this->LastYearUser. " and";
                    }
                    $criteria->condition .= ' surname_author = ' . "'" . $this->AuthorUser[$i] . "'";
                }
            }
        }
        else{
            if($this->GenreUser != '') {
                $criteria->condition .= ' name_genre = ' . "'" . $this->GenreUser . "'";
            }
            if($this->FirstYearUser != 0){
                $criteria->condition .= ' year_of_publication >=' .$this->FirstYearUser." and";
            }
            if(($this->LastYearUser)!= 0){
                $criteria->condition .= ' year_of_publication <= '.$this->LastYearUser;
            }
        }
        $criteria->select = array('name_book','year_of_publication');
        $criteria->together = true;
        $criteria->with = array('books', 'authors', 'genre');
        $books=book::model()->findAll($criteria);
        return $books;
    }

}

