<?php

namespace common\models;

/**
 * This is the model class for table "ticket".
 *
 * @property integer $id
 * @property string $users_ids
 * @property string $description
 * @property string $deadline
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Ticket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['deadline'], 'safe'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['users_ids', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'users_ids' => 'Users Ids',
            'description' => 'Description',
            'deadline' => 'Deadline',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
