<?php

namespace Kanboard\Plugin\TimeMachine\Controller;

use Kanboard\Controller\BaseController;
use Kanboard\Filter\TaskProjectFilter;
use Kanboard\Model\TaskModel;


/**
 * @plugin TimeMachine
 *
 * @package Kanboard\Plugin\TimeMachine\Controller
 * @author  yvalentin
 */
class AnalyticsTimesController extends BaseController {

    /**
     * Show comparison between actual and estimated hours chart by Swimlane
     *
     * @access public
     */
    public function timeComparisonBySwimlane()
    {
        $project = $this->getProject();
        $paginator = $this->getPaginator('timeComparisonBySwimlane', $project);

        list($metrics, $swimlanes) = $this->helper->analyticsTimes->buildBySwimlane($project['id']);
        $this->response->html(
            $this->helper->layout->analytic('TimeMachine:analytic/time_comparison_by_swimlane',
                array(
                    'project'   => $project,
                    'swimlanes' => $swimlanes,
                    'paginator' => $paginator,
                    'metrics'   => $metrics,
                    'title'     => t('Estimated vs actual time / Swimlanes'),
                )
            )
        );
    }

    /**
     * Show comparison between actual and estimated hours chart by Categories
     *
     * @access public
     */
    public function timeComparisonByCategories()
    {
        $project = $this->getProject();
        $paginator = $this->getPaginator('timeComparisonByCategories', $project);

        list($metrics, $categories) = $this->helper->analyticsTimes->buildByCategories($project['id']);
        $this->response->html(
            $this->helper->layout->analytic('TimeMachine:analytic/time_comparison_by_categories',
                array(
                    'project'       => $project,
                    'categories'    => $categories,
                    'paginator'     => $paginator,
                    'metrics'       => $metrics,
                    'title'         => t('Estimated vs actual time / Categories'),
                )
            )
        );
    }

    public function timeComparisonByDates()
    {
        $project = $this->getProject();
        list($from, $to) = $this->getDates();
        $paginatorParams = [
            'from' => $from->format('Y-m-d'),
            'to' => $to->format('Y-m-d')
        ];
        $paginator = $this->getPaginator('timeComparisonByDates', $project, $paginatorParams);

        list($metrics, $categories, $swimlanes) = $this->helper->analyticsTimes->buildByDates($project['id'], $from, $to);

        $this->response->html(
            $this->helper->layout->analytic('TimeMachine:analytic/spent_time_by_dates',
                array(
                    'project'       => $project,
                    'categories'    => $categories,
                    'swimlanes'     => $swimlanes,
                    'from'          => $from,
                    'to'            => $to,
                    'userFormat'    => $this->dateParser->getUserDateFormat(),
                    'paginator'     => $paginator,
                    'metrics'       => $metrics,
                    'title'         => t('Spent time / Dates'),
                )
            )
        );

    }

    /**
     * Get dates from/to from form request
     *
     * @return array
     */
    private function getDates()
    {
        $values = $this->request->getValues();

        $from   = $this->request->getStringParam('from', date('Y-m-d', strtotime('first day of this month')));
        $to     = $this->request->getStringParam('to', date('Y-m-d', strtotime('last day of this month')));

        if (! empty($values)) {
            $from = $this->dateParser->getIsoDate($values['from']);
            $to = $this->dateParser->getIsoDate($values['to']);
        }

        // Return \DateTime
        $from = (new \DateTime($from));
        $to = (new \DateTime($to));
        $to->setTime('23', '59', '59');

        return array($from, $to);
    }

    /**
     * @param $action
     * @param $project
     * @param array $params
     *
     * @return \Kanboard\Core\Paginator
     */
    private function getPaginator($action, $project, array $params = [])
    {
        $urlParams = array('plugin' => 'TimeMachine', 'project_id' => $project['id']);
        if(!empty($params)) {
            foreach ($params as $key => $param) {
                $urlParams[$key] = $param;
            }
        }
        return $this->paginator
            ->setUrl(
                'AnalyticsTimesController',
                $action,
                $urlParams
            )
            ->setMax(30)
            ->setOrder(TaskModel::TABLE.'.id')
            ->setQuery($this->taskQuery
                ->withFilter(new TaskProjectFilter($project['id']))
                ->getQuery()
            )
            ->calculate();
    }
}
