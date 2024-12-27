### Staff Module
------
------

#### 3.1.0 - JUL18

*   FIX: Switch icons color to white because they was too dark on dolibarr 7
*   FIX: Pay Wages was showing the amount as -1 always
*   FIX: Payed status wasn't applied after payment
*   FIX: Filter was not maintained when switching between weeks

**_Notes:_**
_**RE-ENABLE MODULE REQUIRED**_

#### 2.6.1 - OCT17

*   NEW: Module About page for better user support
*   NEW: Module icon
*   FIX: Email form bug _(Dolibarr v3.9)_

**_Notes:_**
_**RE-ENABLE MODULE REQUIRED**_

---

#### 2.6.0 - OCT17

*   NEW: Module icons replaced for improved user experience
*   NEW: Added hompage widget boxes for `Planned Shifts for Today` and `Timesheets for Today` for improved user experience
*   NEW: Added compatibility for Dolibarr v3.9+
*   FIX: Syntax bug for PHP <5.5 _(This bug does not affect later versions of PHP)_
*   FIX: Top Menu entry when HRM module does not exist _(Dolibarr v3.9)_
*   FIX: Card image bug _(Dolibarr v3.9)_
*   FIX: Staff Hourly Rate field in user card _(the field will only be visible if the user is a staff member)_

**_Notes:_**
_**RE-ENABLE MODULE REQUIRED**_

---

#### 2.5.0 - OCT17

*   NEW: Added `fr_FR` language translation
*   FIX: Add missing language strings for calendar part
*   SQL code cleaned
*   Minor fixes and general improvements

**_Notes:_**
_**RE-ENABLE MODULE REQUIRED**_

---

#### 2.4.1 - SEP17

*   NEW: Swapped `Timesheet` and `Planned Shifts` menu order for improved user experience
*   Improved `en_GB` language file to reflect better business language (planned shift > roster)

**_Notes:_**
_**RE-ENABLE MODULE REQUIRED**_

---

#### 2.4.0 - SEP17

*   NEW: Add quick shortcut icon in user area to link to `Waiting to Submit` planned shifts
*   NEW: Add some missing translated strings (when agenda/events module is off)
*   FIX: Admin can modify `pending` timesheets
*   FIX: Change visibility for 'existing quick shortcut icon to submit timesheet' to admin only to avoid user confusion
*   FIX: All staff timesheets are marked as paid when paying salary for one member of staff only

**_Notes:_**
_**RE-ENABLE MODULE REQUIRED**_

---

#### 2.3.1 - SEP17

*   NEW: Add `All Pending Approval Timesheets` link icon to widget box
*   NEW: Add `All Planned Shifts` lik icon to widget box
*   Updated `en_GB` language translation file

**_Notes:_**
_**RE-ENABLE MODULE REQUIRED**_

---

#### 2.3.0 - PUMA - SEP17

*   NEW: When paying from staff pay form, Payment label will be pre-filled with `Wages` language string (see notes)
*   NEW: Add widget for pending timesheets
*   NEW: Add widget for waiting to confirm planned shifts
*   FIX: Paid timesheets cannot be modified anymore
*   FIX: User email is now pre-filled to the send email form when using Send by Email button in `day` `week` `month` views if a staff/user is selected notes: you need to refresh the view when you select a user before using `Send by Email` button; also, user email must exist)
*   FIX: Shifts `DAY OFF` is shown on per user view only
*   FIX: Bugs on `send email` form
*   Some parts of code cleaned

**_Notes:_**
_**RE-ENABLE MODULE REQUIRED**_
_Seperate commit required into Dolibarr core to enable `wages` string_

---

#### 2.2.0 - JAGUAR - SEP17

*   NEW: Add `Origin` to `Timesheet Summary` and tooltips for boxes and list view. This will work only for existing planned shifts/not yet submitted and new planned shifts
*   NEW: Any timesheets originating from a planned shift will be shown the planned shift colour on the calendar only if `Multiple Colours` option is disabled. Change `Planned Shifts Colours` to `ffff56` (yellow) and `aaff56` (green) for better visibility
*   NEW: Only authorised staff can see the `payment` field in the `Timesheet Summary`. Check `User Rights`>`Salaries` (**do not give `read` permissions to anyone**)
*   NEW: Add `Send Email` feature including menu and buttons on `Planned Shifts` and `Timesheets` for `Day` `Week` `Month` views
*   NEW: Add option (in module setttings) to reset `Timesheets` to `Authorised` status if payment was deleted
*   NEW: Allow to delete payment from single timesheet (admin only). Timesheet payment field will show that a payment does not exist.
*   FIX: Timesheets will be set to `Paid` status only if the payment was done through the `Pay Salary` form in the module. Using Dolibarr's 'salary' module feature will not affect the timesheets (useful for other payments)

> **_`Send Email` Feature_**

*   Admin only feature
*   Admin can use the `Send by Email` button on timesheets / plannedshifts to send an email of the timesheet/planned shift (weekly range too) to the specified staff member
*   If you are using the Send by Email on a single timesheet/shift (from Card) then the user email will be pre-filled to the send form, if not, then only the link of timesheet(s)/shift(s) will be filled and a template (one for timesheets & the other for shifts) will be used
*   You can use the `Send Email` menu to send emails to staff generally (in this case the `Test Template` will be used)
*   Templates are translated strings in the language files

**_Notes:_**
_**RE-ENABLE MODULE REQUIRED**_
_Using the `Delete Payment` button on `Paid` timesheets will reset the timesheet to `Authorised` status and remove the payment field link. The actual payment will still be shown in Dolibarr salaries list_

--- 

#### 2.1.0 - TIGER - SEP17 - **STABLE RELEASE**

*   NEW: Add top menu entry when no module related to HRM is enabled
*   NEW: Non-staff users (normal Dolibarr users) cannot create or view timesheets/planned shifts
*   NEW: Add Menu entries for `Staff` and `Pay Salary` (visible for admin only)
*   NEW: Add a button to submit a planned shift from list view (with one click)
*   NEW: Add `Staff Hourly Rate` to `User` and `Staff List` highlighted in blue for user experience
*   NEW: Add `Pay Salary` form (see description below)
*   FIX: Non-staff users appeared on `User View`

> **_Pay Salary Form_**

* `Pay Salary` will call the Dolibarr payment form and pass the following information: `Start Period` `End Period` `Staff Member` `Amount`
* The amount is calculated using the `Staff Hourly Rate` saved for the staff member (introduced with this version). If no hourly rate is set or if the staff has no authorised timesheets in the specified period, then the pre-filled amount will be 0
* Once the salary payment is created, all authorised timesheets for the specified staff between the selected start/end periods will be set to `Paid` status
* On the Timesheet Card/Summary a new field (Payment) will be shown/visible with a link to the payment
* If admin deletes a payment, all the paid timesheets of the specified staff between start/end period will be reset to Pending status & the `Payment` field will be removed from the Timesheets Card

**_Notes:_**
_**RE-ENABLE MODULE REQUIRED**_
_Remove `/sql/llx_fix_log.sql` from module to avoid deleting existing log data_
_Module Payment Form (start/end period) requires extra coding into Dolibarr. Without this addition, the start/end date will not work (only the user and amount)_

---

#### 2.0.0 - ZEBRA - SEP17

*   NEW: Add modify button to start/end times in `List View` and optimise search fields
*   NEW: Staff members are now recognised through the user card as `Employee/Staff`. Only recognised staff members will now show in the module for timesheets and planned shifts
*   NEW: Print button added to timesheet views
*   NEW: Added menu entries `Previous Week` and `Next Week` for admins only
*   FIX: Add missing call for status css file to log page
*   FIX: `Day-1` translation error on `date` field in `list view`
*   FIX: Incorrect days displayed
*   FIX: `list view` sort order
*   FIX: Add gap between boxes (margin-bottom: 5px)
*   FIX: Time wrong in log
*   FIX: Filter by status not matched when changing the week in `Week View`

**_Notes:_**
_**RE-ENABLE MODULE REQUIRED** (log data of timesheets will be deleted)._

---

#### 1.2.9 - SEP17

*   NEW: Added menu colours for `SubmitTimesheet` `PendingList` `WaitingToSubmitList` `NewPlannedShift` `WaitingToConfirmList`
*   FIX: Typo error in language string for `ShowPlannedShiftInstructions`
*   Updated `en_GB` language translation file

---

#### 1.2.8 - SEP17

*   NEW: Add a button to validate a timesheet or confirm a planned shift from list view (with one click)
*   FIX: `Total Hours` and `Note` are shown better now on calendar
*   FIX: Day shown beside date in list view for user experience
*   Some parts of code optimised

---

#### 1.2.7 - SEP17

*   NEW: Number of shifts per day in planned shift submit form is now customisable (min:1, max:4, default:2) (see module settings)
*   NEW: Add `Per User` submenu for faster access (visible for admin only)
*   NEW: Add `Late` picto icon to any late pending timesheets/waiting to confirm planned shifts (in list view)
*   NEW: `PlannedShiftInstructions` language string is now shown on all screen/print views. Option to switch on/off (default: on) added in module settings
*   FIX: Timesheet submit form removed from timesheet views and replaced with search form (filter within view)
*   FIX: Print button moved to search form (visible for planned shifts only)
*   NEW: Add `Total hours` and `User` to timsheet/planned shift boxes (`User` visible only on day/week/month views, `Per User` view not applicable as the user is already known). Option to switch on/off (default:on)
*   NEW: Add quick shortcut icon for quick access next to the Dolibarr user icon area (top right corner of screen) to create planned shift (visible for admin only)
*   Minor fixes and general improvements

**_Notes:_**
_**RE-ENABLE MODULE REQUIRED** (old timesheets will not be deleted)._

---

#### 1.2.6 - SEP17

*   NEW: Admin can modify planned shift times even if not yet confirmed
*   NEW: Planned shifts are reset to `Waiting to Confirm` status each time they are modified
*   NEW: Show `DAY OFF` on days where no planned shifts are recorded. Option to enable/disable in module settings
*   NEW: Non-admin user restricted to create any timesheets in the current week only
*   NEW: Add day to display next to date in `/staff/timesheet/card.php` for easier reference
*   FIX: Planned shifts now show correctly in order of time
*   FIX: Font size of text/times increased for screen and print experience
*   Minor fixes and general improvements

**_Notes:_**
_**RE-ENABLE MODULE REQUIRED** (old timesheets will not be deleted)._

---

#### 1.2.5 - SEP17

*   NEW: Add css file for statuses in timesheet card/summary to allow custom colour preferences (see `status.css.php`)
*   NEW: Add settings for hour/min suffixes (print-suggested format: `hr` and `min`) (field accepts spaces)
*   NEW: Language strings `TimesheetCreateSummary` `PlannedShiftSummary` `PlannedShiftInstructions` added for user experience (instructions added when print too).
*   FIX: Menu titles language corrected

**_Notes:_**
_**RE-ENABLE MODULE REQUIRED** (old timesheets will not be deleted)._

---

#### 1.2.4 - SEP17

*   NEW: `Planned Shifts` feature added. Can now propose shifts and then convert them to timesheet
*   NEW: Add new menu entries for `Planned Shifts`
*   NEW: Timesheet submenu is not hidden by default. Option added to module settings
*   NEW: Optional colours (planned+timesheet) added to module settings. Can also choose random colours to differentiate between users
*   NEW: Planned shift reference prefix added (default: 'PS') to module settings
*   NEW: Allow default view to include `Planned Shifts` in module settings
*   FIX: Change format of hours/minutes for user experience
*   FIX: Individual logs are now seperated by horizontal line for user experience

**_Notes:_**
_**RE-ENABLE MODULE REQUIRED** (old timesheets will not be deleted)._
_Planned Shifts use seperate views/calendars to Timesheets_
_Planned Shifts use seperate statuses_
_Users can see their own planned shifts only_
_Admins can create/publish weekly planned shifts_
_Only admins can delete planned shifts_

---

#### 1.2.3 - SEP17

*   NEW: Updated `en_GB` language file to reflect `Planned Shifts` (not yet implemented)
*   FIX: Added `date` field and made action titles bold for log section for user experience in `en_GB` language

---

#### 1.2.2 - SEP17 - **STABLE RELEASE**

*   NEW: User can access list view (restricted to own timesheets)
*   NEW: User can submit timesheet for any date
*   NEW: Menu entry for `Pending Approval` added (visible for admin only)
*   NEW: Modify/Re-open button added
*   NEW: Highlight status with colors {Pending: transparent, Authorised: light green, Refused: light red}
*   NEW: Feature request: Show total hours in day/week/month tabs (keep in mind that admin will see the total hours for all users in day/week/month views)
*   NEW: Add verification for start & end time inputs, they cannot be the same anymore (e.g. start at 12:00 & end at 12:00 will prompt an error/warning)
*   NEW: Timesheet log added in new tab
*   FIX: Changing the start or end time will return the timesheet status to `not authorised/pending`
*   FIX: Timesheets menu fixed (hidden by default)
*   Minor fixes and general improvements

**_Notes:_**
_**RE-ENABLE MODULE REQUIRED** (old timesheets will not be deleted)._

---

#### 1.2.1 - SEP17

*   NEW: Added menu entries for `today`, `this week`, `all timesheets` (list view)
*   NEW: Added menu entry for `statistics` (not yet implemented)

**_Notes:_**
_Any existing timesheets will be deleted once this version is enabled._

---

#### 1.2.0 - SEP17

*   NEW: Numbering models added for timesheet referencing **RE-ENABLE MODULE REQUIRED**
*   NEW: User can submit more than one time slot per day (split working shifts)
*   NEW: Add 'Filter by Status' to user view
*   NEW: Allow admin to refuse timesheet
*   NEW: Add menu entry `submit timesheet`
*   NEW: Allow admin to create user timesheets on their behalf
*   NEW: Add `Submit Timesheet` icon for quick access next to the Dolibarr user icon area (top right corner of screen) - Enabled for all users by default; option to disable in module settings.
*   FIX: Note field shortened for brief notes/reasons
*   FIX: Better display of warning (CannotModifyUntilGetValidated) for user experience

**_Notes:_**
_Any existing timesheets will be deleted once this version is enabled._

---

#### 1.1.0 - SEP17

*   NEW: Add 'time_diff' sql table field to store the total hours per timesheet to get the sum of total hours per week or month. **RE-ENABLE MODULE REQUIRED**
*   NEW: Add refresh icon to recalculate the total hours ondemand (the timesheet must be approved/validated to recalculate the Total hours)
*   NEW: Per user view added (visible only for admin)
*   NEW: List view added (visible only for admin)
*   FIX: General fixes and improvements

**_Notes:_**
_Only admin can recalculate the total hours of a timesheet using the refresh/recalculate button although this value will be recalculated automaticaly when the user changes the start or end time_

---

#### 1.0.0 - SEP17 - Initial Release

*   NEW: User can submit a timesheet every day and can see their own timesheet(s) using day, week or month view
*   NEW: Admin can validate (authorise) user-submitted timesheets
*   NEW: Only validated (authorised) timesheets can be modified by the user (staff)
*   NEW: Admin can see timesheets for all staff/users
*   NEW: Only admin users can validate (authorise) a timesheet
*   NEW: Admin can create/submit/authorise their own timesheet
*   NEW: Add user permissions to read/submit/modify/delete a timesheet

