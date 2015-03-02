<?php
/**
 *
 * User.php
 *
 * Date: 02/03/15
 * Time: 12:09
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 */

namespace tests\data\models;


use yii\db\ActiveRecord;

class Post extends ActiveRecord
{
    public $message;

    public static $db;

    public static function getDb()
    {
        return self::$db;
    }
}
