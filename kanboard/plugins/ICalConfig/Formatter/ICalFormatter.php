<?php

namespace Kanboard\Plugin\ICalConfig\Formatter;

use DateTime;
use Eluceo\iCal\Component\Alarm;
use Eluceo\iCal\Component\Calendar;
use Eluceo\iCal\PropertyBag;
use Kanboard\Formatter\TaskICalFormatter;
use PicoDb\Table;

const CRLF = "\r\n";

class CustomAlarm extends Alarm
{
    /**
     * {@inheritdoc}
     */
    public function buildPropertyBag()
    {
        $propertyBag = new PropertyBag();

        if (null != $this->trigger) {
            $relation = $this->trigger[strlen($this->trigger) - 1];
            $propertyBag->set(
                'TRIGGER',
                chop($this->trigger, 'SE'),
                $relation === 'E' ? array('RELATED' => 'END') : array()
            );
        }

        if (null != $this->action) {
            $propertyBag->set('ACTION', $this->action);
        }

        if (null != $this->repeat) {
            $propertyBag->set('REPEAT', $this->repeat);
        }

        if (null != $this->duration) {
            $propertyBag->set('DURATION', $this->duration);
        }

        if (null != $this->description) {
            $propertyBag->set('DESCRIPTION', $this->description);
        }

        if (null != $this->attendee) {
            $propertyBag->set('ATTENDEE', $this->attendee);
        }

        return $propertyBag;
    }

    /**
     * Factory method to create alarms
     *
     * @return CustomAlarm
     */
    public static function create($trigger): CustomAlarm
    {
        $alarm = new CustomAlarm();
        $alarm
            ->setAction(Alarm::ACTION_DISPLAY)
            ->setDescription('Added by ICalConfig')
            ->setTrigger($trigger);
        return $alarm;
    }
}

class ICalFormatter extends TaskICalFormatter
{
    const COOKIE_NAME = 'icalconf_tz';
    private $alarms;

    /**
     * Get Ical events
     *
     * @access public
     * @return string
     */
    public function format()
    {
        $strVCal = $this->injectTimezone();
        return $strVCal != null ? $strVCal : parent::format();
    }

    /**
     * Set calendar object
     *
     * @access public
     * @param Calendar $vCalendar
     * @return $this
     */
    public function setCalendar(Calendar $vCalendar)
    {
        parent::setCalendar($vCalendar);

        $this->vCalendar->setPublishedTTL($this->configModel->get('icalconf_ttl', 'PT1H'));
        return $this;
    }

    /**
     * Transform results to iCal events
     *
     * @access public
     * @param  Table  $query
     * @param  string $startColumn
     * @param  string $endColumn
     * @return $this
     */
    public function addTasksWithStartAndDueDate(Table $query, $startColumn, $endColumn)
    {
        if ($this->getConfig('icalconf_duedate')) {
            return $this->addTasksWithDueDateOnly($query);
        }

        $this->createAlarms();

        $allday = $this->getConfig('icalconf_allday');
        $noTZID = $this->getConfig('icalconf_notzid');

        foreach ($query->findAll() as $task) {
            $start = new DateTime();
            $start->setTimestamp($task[$startColumn]);
            $end = new DateTime();
            $end->setTimestamp($task[$endColumn] ?: time());

            $vEvent = $this->getTaskIcalEvent($task, 'task-#'.$task['id'].'-'.$startColumn.'-'.$endColumn);

            if ($allday) {
                $vEvent->setNoTime(true);
            }

            $vEvent->setDtStart($start);
            $vEvent->setDtEnd($end);

            if ($noTZID) {
                $vEvent->setUseTimezone(false);
            }

            foreach ($this->alarms as $alarm) {
                $vEvent->addComponent($alarm);
            }

            $this->vCalendar->addComponent($vEvent);
        }

        return $this;
    }

    /**
     * Transform results to all day iCal events
     *
     * @access public
     * @param  Table $query
     * @return $this
     */
    public function addTasksWithDueDateOnly(Table $query)
    {
        $this->createAlarms();
        $noTZID = $this->getConfig('icalconf_notzid');

        foreach ($query->findAll() as $task) {
            $date = new DateTime();
            $date->setTimestamp($task['date_due']);

            $vEvent = $this->getTaskIcalEvent($task, 'task-#'.$task['id'].'-date_due');
            $vEvent->setDtStart($date);
            $vEvent->setDtEnd($date);

            if ($date->format('Hi') === '0000') {
                $vEvent->setNoTime(true);
            }

            if ($noTZID) {
                $vEvent->setUseTimezone(false);
            }

            foreach ($this->alarms as $alarm) {
                $vEvent->addComponent($alarm);
            }

            $this->vCalendar->addComponent($vEvent);
        }

        return $this;
    }

    /**
     * Create array of alarms
     */
    private function createAlarms()
    {
        if (!isset($this->alarms)) {
            if ($this->getConfig('icalconf_withalarm')) {
                $this->alarms = $reminders = [];
                $config = $this->configModel->get('icalconf_alarmtrigger', '-PT0ME');

                if ($config == 'custom') {
                    $configlist = $this->configModel->get('icalconf_reminders', '');
                    if (strlen($configlist) > 0) {
                        $reminders = explode(';', $configlist);
                    }
                } else {
                    $reminders[] = $config;
                }

                foreach ($reminders as $trigger) {
                    $this->alarms[] = CustomAlarm::create($trigger);
                }
            }
            else {
                $this->alarms = [];
            }
        }
    }

    /**
     * Get bool config
     *
     * @return bool
     */
    private function getConfig($name): bool
    {
        switch ($name) {
            case 'icalconf_allday':
            case 'icalconf_duedate':
            case 'icalconf_notzid':
            case 'icalconf_withalarm':
                return $this->configModel->get($name, '0') == 1;
                break;
            default:
                break;
        }
        return false;
    }

    /**
     * Get & inject VTIMEZONE
     *
     * @return string | null
     */
    private function injectTimezone() {
        $tzCalendar = $this->request->getCookie(self::COOKIE_NAME);
        if (strlen($tzCalendar) == 0) {
            $tz = $this->timezoneModel->getCurrentTimezone();
            $tzCalendar = ($this->httpClient->get("https://www.tzurl.org/zoneinfo-outlook/$tz"));
            if (strpos($tzCalendar,'BEGIN:VCALENDAR') == 0) {
                setcookie(self::COOKIE_NAME, $tzCalendar, time() + (86400 * 30), "/"); // 86400 = 1 day
            } else {
                return null;
            }
        }

        $match = [];
        $pattern = '/BEGIN:VTIMEZONE(.*\x0d\x0a)*END:VTIMEZONE/';

        preg_match($pattern, $tzCalendar, $match);

        if (($strVTimezone = isset($match[0]) ? $match[0] : null) != null) {
            $strVCal = parent::format();

            if (($pos = strpos($strVCal,'X-PUBLISHED-TTL:')) != false) {
                return substr($strVCal, 0, $pos - 1) . "\n" . $strVTimezone . CRLF . substr($strVCal,$pos);
            }
        }

        return null;
    }
}
