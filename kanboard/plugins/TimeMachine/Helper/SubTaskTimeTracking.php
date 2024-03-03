<?php


namespace Kanboard\Plugin\TimeMachine\Helper;

use Kanboard\Core\Base;

/**
 * Class SubTaskTimeTracking
 *
 * @package Kanboard\Plugin\TimeMachine\Helper
 * @author yvalentin
 */
class SubTaskTimeTracking extends Base
{

    /**
     * Datetime field
     *
     * @access public
     * @param  string $label
     * @param  string $name
     * @param  array  $values
     * @param  array  $errors
     * @param  array  $attributes
     * @return string
     */
    public function datetime($label, $name, array $values, array $errors = array(), array $attributes = array())
    {
        $userFormat = $this->dateParser->getUserDateTimeFormat();
        $values = $this->dateParser->format($values, array($name), $userFormat);
        $attributes = array_merge(array('placeholder="'.date($userFormat).'"'), $attributes);

        return $this->helper->form->label($label, $name) .
               $this->helper->form->text($name, $values, $errors, $attributes, 'form-datetime');
    }

}
