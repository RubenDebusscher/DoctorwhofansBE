# Kanboard - ⌛ Time Machine ⏳ - Plugin
------------------

**Plugin to add time machine : Back to the Future**

- *Add a Analytics Times on project Analytics sidebar* 📊 :
    - "estimated vs actual time" comparison:
        - By swimlane
        - By categories
    - Spent time with start and end dates filter **!!! Attention! this is based on time tracking - 
with the timer functionality on subtasks !!!**

- *Add a form to edit start and end dates of subtask time tracking / timer ⏱* 

- *Override Action:*
    - SubtaskTimerMoveTaskColumn
        
        // This doesn't work for now 
        
        Create a subtask and activate the timer when moving a task to another column 
        **with user session id (not with creator of the task)**

Install:
-------
* To install, download the repo into the kanboard plugins folder.
* Make sure the name of the folder is "TimeMachine".

How it works:
------------
1. Install plugin

2. Go Project Analytics to see new entries menus (see screenshot)

3. You can edit start and end dates of your subtasks time tracking

    On the task show's template, if you have subtasks with timer, 
    you can edit start and end dates of each time tracking entry for this subtask 

TODO:
------------
* Change Access map to authorize member/viewer (like customers) to see Analytics
* Check only assigned member, creator or admin can change values on time tracking edition
* Fix paginator on spent time by date analytic

Screenshots:
-----------
1. By swimlane

    ![AnalyticsTimes-swimlanes](https://gitlab.com/yv-kanboard-plugin/analytics-times/wikis/uploads/a00e312cb00c7fd131659341d10e9142/AnalyticsTimes-swimlanes.png)

2. By categories
    
    ![AnalyticsTimes-categories](https://gitlab.com/yv-kanboard-plugin/analytics-times/wikis/uploads/5dad072e0740bf9d0c96a4dbfe65829d/AnalyticsTimes-categories.png)

3. Spent time with start and end dates filter

    ![AnalyticsTimes-spenttime-dates](https://gitlab.com/yv-kanboard-plugin/analytics-times/wikis/uploads/9a6293ec54662399c992e54e55cdf8c1/AnalyticsTimes-spenttime-dates.png)
    
4. Subtask time tracking edition
    
    ![SubtaskTimeTracking-edit](https://gitlab.com/yv-kanboard-plugin/analytics-times/wikis/uploads/ef2beef638138cb86a31a47c30a86f74/SubtaskTimeTrackingEdit.png)