<?php


class RecoveryPassword extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{recovery_password}}';
    }

    public function rules()
    {
        return array(
            array('user_id, code', 'required'),
            array('user_id', 'numerical', 'integerOnly' => true),
            array('code', 'length', 'max' => 32, 'min' => 32),
            array('code', 'unique'),
            array('id, user_id, creation_date, code', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id'            => Yii::t('user', 'Id'),
            'user_id'       => Yii::t('user', 'user ID'),
            'creation_date' => Yii::t('user', 'created by'),
            'code'          => Yii::t('user', 'user code'),
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('creation_date', $this->creation_date, true);
        $criteria->compare('code', $this->code, true);

        return new CActiveDataProvider('RecoveryPassword', array('criteria' => $criteria));
    }

    public function generateRecoveryCode($user_id)
    {
        return md5(time() . $user_id . uniqid());
    }

    public function beforeSave()
    {
        if ($this->isNewRecord)
            $this->creation_date = new CDbExpression('NOW()');
        
        return parent::beforeSave();
    }
}
