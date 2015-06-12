<?php

/**
 * This is the model class for table "book".
 *
 * The followings are the available columns in table 'book':
 * @property integer $id_book
 * @property string $name_book
 * @property integer $id_genre
 * @property string $year_of_publication
 *
 * The followings are the available model relations:
 * @property Genre $idGenre
 * @property Books[] $books
 */
class book extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'book';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_genre', 'required'),
			array('id_genre', 'numerical', 'integerOnly'=>true),
			array('name_book', 'length', 'max'=>32),
			array('year_of_publication', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_book, name_book, id_genre, year_of_publication', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'genre' => array(self::BELONGS_TO, 'Genre', 'id_genre'),
            'books' => array(self::HAS_MANY, 'Books', 'id_book'),
            'authors' => array(self::HAS_MANY,'Author', array('id_author'=>'id_author'),'through'=>'books'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_book' => 'Id Book',
			'name_book' => 'Name Book',
			'id_genre' => 'Id Genre',
			'year_of_publication' => 'Year Of Publication',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_book',$this->id_book);
		$criteria->compare('name_book',$this->name_book,true);
		$criteria->compare('id_genre',$this->id_genre);
		$criteria->compare('year_of_publication',$this->year_of_publication,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return book the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
