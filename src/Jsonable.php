<?php namespace Raplos\Jsonable;

class Jsonable extends \Phalcon\Mvc\Model\Behavior implements \Phalcon\Mvc\Model\BehaviorInterface
{
    private $fieldname;

    public function __construct($options = null)
    {
        $this->fieldname = isset($options['field']) ? $options['field'] : '';
    }

    public function notify($eventType, $model)
    {
        switch ($eventType) {
            case 'afterFetch':
            case 'afterSave':
                $model->{$this->fieldname} = json_decode($model->{$this->fieldname}, true);
                break;

            case 'beforeSave':

                $model->{$this->fieldname} = json_encode($model->{$this->fieldname});
                break;

            default:
        }
    }

}