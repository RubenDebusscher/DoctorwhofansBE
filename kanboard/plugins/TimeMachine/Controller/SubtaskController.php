<?php

namespace Kanboard\Plugin\TimeMachine\Controller;

use Kanboard\Controller\BaseController;
use Kanboard\Core\Controller\AccessForbiddenException;
use Kanboard\Core\Controller\PageNotFoundException;

/**
 * Subtask controller
 *
 * @package  Kanboard\Plugin\TimeMachine\Controller
 * @author   yvalentin
 */
class SubtaskController extends BaseController
{

    /**
     * Edit form with subTaskTimeTracking
     *
     * @access public
     * @param array $values
     * @param array $errors
     * @throws AccessForbiddenException
     * @throws PageNotFoundException
     */
    public function edit(array $values = [], array $valuesSttts = [], array $errors = [], array $errorsSttts = [])
    {
        $task = $this->getTask();
        $subtask = $this->getSubtask($task);
        $sttts = $this->subtaskTimeTrackingModel->getBySubTaskId($subtask['id']);

        $this->response->html($this->template->render('subtask/edit', array(
            'values'        => empty($values) ? $subtask : $values,
            'errors'        => $errors,
            'errorsSttts'   => $errorsSttts,
            'users_list'    => $this->projectUserRoleModel->getAssignableUsersList($task['project_id']),
            'status_list'   => $this->subtaskModel->getStatusList(),
            'sttts'         => empty($valuesSttts) ? $sttts : $valuesSttts,
            'subtask'       => $subtask,
            'task'          => $task,
        )));
    }

    /**
     * Update and validate a subtask with subTaskTimeTracking
     *
     * @access public
     */
    public function update()
    {
        $task = $this->getTask();
        $subtask = $this->getSubtask($task);

        $values = $this->request->getValues();
        $values['id'] = $subtask['id'];
        $values['task_id'] = $task['id'];

        // get subTaskTimeTracking values
        $valuesSttts = $this->getSubTaskTimeTracking($values);

        list($valid, $errors) = $this->subtaskValidator->validateModification($values);
        list($validSttts, $errorsSttts) = $this->helper->subTaskTimeTrackingValidator->validates($valuesSttts);

        if ($valid && !in_array(false, $validSttts)) {
            if ($this->subtaskModel->update($values)
                && $this->subtaskTimeTrackingModel->updates($valuesSttts, $subtask['id'], $task['id'])) {
                $this->flash->success(t('Sub-task updated successfully.'));
            } else {
                $this->flash->failure(t('Unable to update your sub-task.'));
            }

            return $this->response->redirect($this->helper->url->to('TaskViewController', 'show', array('project_id' => $task['project_id'], 'task_id' => $task['id'])), true);
        }

        return $this->edit($values, $valuesSttts, $errors, $errorsSttts);
    }

    /**
     * Get Sub Task Time Tracking from form values
     *
     * @param array $values
     *
     * @return array
     */
    private function getSubTaskTimeTracking(array &$values)
    {
        $sttts = [];
        foreach ($values as $key => $value) {
            if(strpos($key,'-') !== false) {
                list($column, $id) = explode('-', $key);
                $sttts[$id][$column] = $value;
                $sttts[$id]['id'] = $id;
                unset($values[$key]);
            }
        }

        return $sttts;
    }
}
