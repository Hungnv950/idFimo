<?php
namespace app\api\modules\v1\helpers;

/**
 * Created by PhpStorm.
 * User: Nguyen Huy Hoang
 * Date: 3/28/2017
 * Time: 3:37 PM
 */
class UrlRule extends \fproject\rest\UrlRule
{
    /** @inheritdoc */
    public $tokens = [
        '{id}' => '<id:\\d[\\d,]*|{("\\w+"\\s*:\\s*"{0,1}\\d+"{0,1}\\s*,{0,1})+\\}|>',
        '{mst}' => '<id:[0-9a-zA-Z\-]*>',
    ];

    /** @inheritdoc */
    public $patterns = [
        'PUT,PATCH {id}' => 'update',
        'DELETE {id}' => 'delete',
        'GET,HEAD {id}' => 'view',
        'GET,HEAD {mst}' => 'view',
        'POST' => 'create',
        'POST save' => 'save',
        'POST batch-save' => 'batch-save',
        'GET remove/{id}' => 'delete',
        'POST batch-remove' => 'batch-remove',
        'GET,HEAD' => 'index',
        '{id}' => 'options',
        '' => 'options',
    ];
}