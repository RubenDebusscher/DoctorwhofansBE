<?php

namespace Kanboard\Plugin\TimeMachine\Model;

use Kanboard\Model\SubtaskModel;
use Kanboard\Model\TaskModel;
use Kanboard\Model\UserModel;

/**
 * Class SubtaskTimeTrackingModel
 *
 * @author yvalentin
 * https://yohannvalentin.com
 */
class SubtaskTimeTrackingModel extends \Kanboard\Model\SubtaskTimeTrackingModel
{
    /**
     *
     * @param $subTask_id
     *
     * @return array
     */
    public function getBySubTaskId($subTask_id)
    {
        $sttts =  $this->db
            ->table(self::TABLE)
            ->columns(
                self::TABLE.'.id',
                self::TABLE.'.subtask_id',
                self::TABLE.'.end',
                self::TABLE.'.start',
                self::TABLE.'.time_spent',
                self::TABLE.'.user_id',
                SubtaskModel::TABLE.'.task_id',
                SubtaskModel::TABLE.'.title AS subtask_title',
                UserModel::TABLE.'.username',
                UserModel::TABLE.'.name AS user_fullname'
            )
            ->join(SubtaskModel::TABLE, 'id', 'subtask_id')
            ->join(UserModel::TABLE, 'id', 'user_id', self::TABLE)
            ->eq(SubtaskModel::TABLE.'.id', $subTask_id)
            ->findAll();

        $values = [];
        foreach ($sttts as $key => $sttt) {
            $values[$sttt['id']] = $sttt;
            // This is for form input name
            $values[$sttt['id']]['start-'.$sttt['id']]  = $sttt['start'];
            $values[$sttt['id']]['end-'.$sttt['id']]    = $sttt['end'];
        }

        return $values;
    }

    /**
     * Update a subTask Time Tracking
     *
     * @param array $values
     * @param $subTaskId
     * @param $taskId
     * @param bool $fireEvent
     *
     * @return array
     * @throws \Exception
     */
    public function updates(array $values, $subTaskId, $taskId,  $fireEvent = true)
    {
        $result = [];
        foreach ($values as $key => $value) {
            $value = $this->dateParser->convert($value, array('start'), true);
            $value = $this->dateParser->convert($value, array('end'), true);
            if (!empty($value['start']) && !empty($value['end'])) {
                $value['time_spent'] = $this->dateParser->getHours(
                    (new \DateTime())->setTimestamp($value['start']),
                    (new \DateTime())->setTimestamp($value['end'])
                );
            } else {
                $value['time_spent'] = 0;
                $value['start'] = !empty($value['start']) ? $value['start'] : 0;
                $value['end'] = !empty($value['end']) ? $value['end'] : 0;
            }

            $result[] = $this->db->table(self::TABLE)->eq('id', $key)->save($value);
        }

        if (!in_array(false, $result)) {
            // Need to update task time tracking spent time and sub task too
            $this->calculateSubtaskTimeSpent($subTaskId, $fireEvent);
        }

        return $result;
    }

    /**
     * Update subtask time spent By calculation
     *
     * @access public
     * @param  integer   $subtask_id
     * @return bool
     */
    public function calculateSubtaskTimeSpent($subtask_id, $fireEvent)
    {
        $timeSpent = $this->db->table(self::TABLE)
            ->eq('subtask_id', $subtask_id)
            ->columns(
                'SUM(time_spent) AS time_spent'
            )
            ->findOne();

        $subtask = $this->subtaskModel->getById($subtask_id);

        return $this->subtaskModel->update(array(
            'id' => $subtask['id'],
            'time_spent' => $timeSpent['time_spent'],
            'task_id' => $subtask['task_id'],
        ), $fireEvent);
    }

    /**
     * Update task time tracking based on subtasks time tracking
     *
     * @access public
     * @param  integer   $task_id    Task id
     * @return bool
     */
    public function updateTaskTimeTracking($task_id)
    {
        $values = $this->calculateSubtaskTime($task_id);
        // Do not update time_estimated or spend_time of task if sum of subtask time estimated is equal to 0
        if($values['time_estimated'] == 0) {
            unset($values['time_estimated']);
        }
        if($values['time_spent'] == 0) {
            unset($values['time_spent']);
        }

        if (empty($values)) {
            return true;
        }

        return $this->db
            ->table(TaskModel::TABLE)
            ->eq('id', $task_id)
            ->update($values);
    }

}
