<?php

namespace common\models;

/**
 * This is the model class for table "ticket".
 *
 * @property integer $id
 * @property string name
 * @property string $users_ids
 * @property string $tickets_ids
 * @property string $description
 *
 * @property string $admins_ids
 * @property string $project_manager_id
 * @property string $developers_ids
 * @property string $business_intelligences_ids
 * @property string $observers_ids
 *
 * @property integer $created_at
 * @property integer $updated_at
 */

class Team extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            /*[['deadline'], 'safe'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['users_ids', 'description'], 'string', 'max' => 255],*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                         => 'ID',
            'name'                       => 'Name',
            'users_ids'                  => 'Users Ids',
            'tickets_ids'                => 'Tickets Ids',
            'description'                => 'Description',

            'admins_ids'                 => 'Admins Ids',
            'project_manager_id'         => 'Project Manager Id',
            'developers_ids'             => 'Developers Ids',
            'business_intelligences_ids' => 'Business Intelligences Ids',
            'observers_ids'              => 'Observers Ids',

            'created_at'                 => 'Created At',
            'updated_at'                 => 'Updated At',
        ];
    }
}