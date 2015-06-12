<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
?>

<form name="find" action="" method="post">
    <table>
        <tr>
            <td>
                <?php
                      echo CHtml::CheckBoxList('author', 0, $model->getAuthorSurname());
                ?>
            </td>
            <td>
                <lable>Год издания(от):</lable>
                <?php
                    echo  CHtml::textField('first');
                ?>
            </td>
            <td>
                <lable>Год издания(до):</lable>
                <?php
                    echo   CHtml::textField('last');
                   // $model->setLastYearUser((int)$LastYear);
                ?>
            </td>
            <td>
                <?php echo CHtml::dropDownList('genre', 0,$model->getGenre(),array('empty' => '(Select a category')); ?>
            </td>
            <td>
                <?php
                    echo  CHtml::submitButton('Search', array('name'=>''));
                    $list = $model->getAuthorSurname();
                    $StringAuthors = array();
                    for($i = 0; $i < count($_POST['author']); $i++){
                          $StringAuthors[$i] = $list[$_POST['author'][$i]];
                     }
                     $model->setAuthorUser($StringAuthors);
                     $model->setFirstYearUser((int)$_POST['first']);
                     $model->setLastYearUser((int)$_POST['last']);
                     $list = $model->getGenre();
                     $model->setGenreUser($list[$_POST['genre']]);
                ?>
            </td>
        </tr>
    </table>
</form>



<table id="output">
    <tr>
        <td>Книга</td>
        <td>Год издания</td>
    </tr>
<?php
    foreach($model->findCriteria() as $find){
        echo '<tr><td>'.$find->name_book.'</td>'.'<td>'.$find->year_of_publication.'</td></tr>';
    }
?>
</table>