<?php
/* Copyright (C) 2017	AXeL dev	<contact.axel.dev@gmail.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 *       \file       /staff/tpl/timesheet.tpl.php
 *       \brief      Template of timesheet(s)
 */

global $db, $conf, $user, $langs;
global $timesheetsarray;

$userstatic = new User($db);

// print timesheets / planned shifts for the specified day
if (is_array($timesheetsarray))
{
    $i=0;
    
    foreach ($timesheetsarray as $daykey => $notused)
    {
        $annee = date('Y',$daykey);
        $mois = date('m',$daykey);
        $jour = date('d',$daykey);
        //print $annee.'-'.$mois.'-'.$jour.' '.$year.'-'.$month.'-'.$day."<br>\n";
        
        if ($day==$jour && $month==$mois && $year==$annee) // Is it the day we are looking for when calling function ?
        {
            foreach ($timesheetsarray[$daykey] as $index => $timesheet)
            {
                    //var_dump($timesheet);

                    if ($action == 'show_peruser' && $username->id != $timesheet->fk_user) continue;	// We discard record if timesheet is from another user than user we want to show

                    //$parameters=array();
                    //$reshook=$hookmanager->executeHooks('formatTimesheet',$parameters,$timesheet,$action);    // Note that $action and $object may have been modified by some hooks
                    //if ($reshook < 0) setEventMessages($hookmanager->error, $hookmanager->errors, 'errors');
                    
                    // Define $color (Hex string like '0088FF') and $cssclass of timesheet
                    if ($conf->global->TIMESHEET_USE_MULTI_COLORS)
                    {
                        $color=-1; $colorindex=-1;

                        if ($color == -1)	// Color was not forced. Set color according to color index.
                        {
                                // Define color index if not yet defined
                                $idusertouse=($timesheet->fk_user?$timesheet->fk_user:0);
                                if (isset($colorindexused[$idusertouse]))
                                {
                                        $colorindex=$colorindexused[$idusertouse];	// Color already assigned to this user
                                }
                                else
                                {
                                        $colorindex=$nextindextouse;
                                        $colorindexused[$idusertouse]=$colorindex;
                                        if (! empty($theme_datacolor[$nextindextouse+1])) $nextindextouse++;	// Prepare to use next color
                                }
                                //print '|'.($color).'='.($idusertouse?$idusertouse:0).'='.$colorindex.'<br>';
                                // Define color
                                $color=sprintf("%02x%02x%02x",$theme_datacolor[$colorindex][0],$theme_datacolor[$colorindex][1],$theme_datacolor[$colorindex][2]);
                        }
                    }
                    else
                    {
                        $color = $type == 'planned_shift' || $timesheet->origin == 'planned_shift' ? $conf->global->PLANNED_SHIFT_BACK_COLOR : $conf->global->TIMESHEET_BACK_COLOR;
                    }

                    $cssclass = '';

                    // Defined style to disable drag and drop feature
                    $cssclass.= " unmovable";
                    
                    $h=''; $nowrapontd=1;
                    if ($action == 'show_day')  { $h='height: 100%; '; $nowrapontd=0; }
                    if ($action == 'show_week') { $h='height: 100%; '; $nowrapontd=0; }

                    // Show rect of timesheet
                    print "\n";
                    print '<!-- start timesheet '.$i.' --><div id="timesheet_'.$ymd.'_'.$i.'" class="timesheet '.$cssclass.'"';
                    //print ' style="height: 100px;';
                    //print ' position: absolute; top: 40px; width: 50%;';
                    //print '"';
                    print '>';
                    print '<ul class="cal_event" style="'.$h.'">';	// always 1 li per ul, 1 ul per event
                    print '<li class="cal_event" style="'.$h.'">';
                    print '<table class="cal_event" style="'.$h;
                    print 'background: #'.$color.'; background: -webkit-gradient(linear, left top, left bottom, from(#'.$color.'), to(#'.dol_color_minus($color,1).'));';
                    //if (! empty($event->transparency)) print 'background: #'.$color.'; background: -webkit-gradient(linear, left top, left bottom, from(#'.$color.'), to(#'.dol_color_minus($color,1).'));';
                    //print 'background-color: transparent !important; background: none;';
                    //print ' border: 1px solid #bbb;';
                    print ' -moz-border-radius:4px;" width="100%"><tr>';
                    print '<td class="tdoverflow centpercent '.($nowrapontd?'nowrap ':'').'cal_event">';
                    // Date
                    //print '<strong>';
                    $daterange='';
                    
                    // Hour start
                    $daterange.=$timesheet->start_time;
                    if ($timesheet->end_time)
                    {
                        $daterange.=' - ';
                    }
                    // Hour end
                    if ($timesheet->end_time)
                    {
                        $daterange.=$timesheet->end_time;
                    }
                    //print $daterange;
                    print $timesheet->getNomUrl($mod_path, 0, '', $daterange);
                    //print '</strong> ';
                    print '<br>'."\n";
                    
                    // Show Total hours
                    if ($conf->global->TIMESHEET_SHOW_MORE_DETAILS)
                    {
                        print '<span class="justify_detail" title="'.$langs->trans('TotalHours').'">';
                        print img_picto($langs->trans('TotalHours'), 'time@staff', 'style="vertical-align: top;"');
                        print ' '.$timesheet->getTotalHours();
                        print '</span>';
                        print '<br>'."\n";
                    }
                    
                    // Show User (we already now the user on peruser view)
                    if ($action != 'show_peruser' && $conf->global->TIMESHEET_SHOW_MORE_DETAILS)
                    {
                        print '<span class="justify_detail">';
                        $userstatic->fetch($timesheet->fk_user);
                        print $userstatic->getNomUrl(1);
                        print '</span>';
                        print '<br>'."\n";
                    }

                    // Show note
                    if (empty($type) && $timesheet->note && $conf->global->TIMESHEET_SHOW_MORE_DETAILS) {
                        //print '<strong>'.$langs->trans("Note").':</strong> ';
                        //print dol_trunc($timesheet->note,$maxnbofchar);
                        print '<span class="justify_detail" title="'.$langs->trans('Note').'">';
                        print img_picto($langs->trans('Note'), 'note@staff', 'style="vertical-align: top;"');
                        print ' '.dol_trunc($timesheet->note,$maxnbofchar);
                        print '</span>';
                    }
                    
                    print '</td>';
                    
                    // Status
                    print '<td align="right" class="nowrap">';
                    print $timesheet->getLibStatut(3);
                    print '</td>';
                    
                    print '</tr></table>';
                    print '</li>';
                    print '</ul>';
                    print '</div><!-- end timesheet '.$i.' -->'."\n";
                    
                    $i++;
            }

            break;
        }
    }
    
    if ($conf->global->STAFF_SHOW_DAY_OFF && $type == 'planned_shift' && $action == 'show_peruser' && $i == 0)
    {
        // Day Off
        print '<div class="center">';
        print '<span class="rotate">';
        print $langs->trans("DayOff");
        print '</span>';
        print '</div>';
    }
}
