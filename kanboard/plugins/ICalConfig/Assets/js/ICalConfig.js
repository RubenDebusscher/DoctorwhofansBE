
'strict'

$(function () {
  if (window.location.pathname !== '/settings/application') {
    return;
  }

  const PATTERN = /([+-])PT(\d{1,})([MHDW])([SE])/;

  const app = {

    alarmTrigger: $('#form-icalconf_alarmtrigger'),
    offset: $('#form-icalconf_offset'),

    unit: $('#form-icalconf_triggerunit'),
    unitopt: $('#form-icalconf_triggerunit')[0].options,

    relation: $('#form-icalconf_relation'),
    relopt: $('#form-icalconf_relation')[0].options,

    reminder: $('#form-icalconf_remind'),
    remopt: $('#form-icalconf_remind')[0].options,
    reminderList: $('#form-icalconf_reminders'),

    cbxWithAlarm: $('#icalconf_withalarm'),
    alarmItems: $('.icalconf-withalarm'),

    getAlarmTrigger: function () {
      let obj = this.alarmTrigger[0];

      return obj.options[obj.selectedIndex].value;
    },

    showAlarmItems: function () {
      $('.icalconf-custom-rem').css('visibility',
        this.getAlarmTrigger() === 'custom' ? 'visible' : 'hidden',
      );
    },

    getReminderText: function (trigger) {

      function getText(match, options) {
          for (option of options) {
              if (option.value == match) {
                  return option.innerHTML;
              }
          }
          return ' unexpected';
      }

      let match = trigger.match(PATTERN);

      return `${match[2]} ${getText(match[3], this.unitopt)} ${getText(match[1] + match[4], this.relopt)}`;
    },

    composeTrigger: function () {
      let offset = this.offset.val();
      let unit = this.unitopt[this.unit.prop('selectedIndex')].value;
      let rel = this.relopt[this.relation.prop('selectedIndex')].value;

      return `${rel[0]}PT${offset}${unit}${rel[1]}`;
    },

    initReminderList: function () {
      let reminderList = this.reminderList.val();

      if (reminderList.length) {
        for (let trigger of reminderList.split(';')) {
          let opt = new Option;

          opt.value = trigger;
          opt.innerHTML = this.getReminderText(trigger);
          this.remopt.add(opt);
        }
      }
    },

    run: function () {

      // Init stuff

      const REMCLASS = 'rem-ctrl';

      this.offset.addClass(REMCLASS);
      this.unit.addClass(REMCLASS);
      this.relation.addClass(REMCLASS);

      this.alarmItems.attr('disabled', !this.cbxWithAlarm.prop('checked'));
      this.initReminderList();
      this.showAlarmItems();

      // Submit hook

      $('form:first').submit(() => {
        let reminders = '';
        let n = 1;
        let m = this.remopt.length;

        for (let opt of this.remopt) {
          reminders += opt.value;
          if (n++ < m) {
            reminders += ';';
          }
        }

        this.reminderList.val(reminders);
      });

      // Reminder yes/no

      this.cbxWithAlarm.click((e) => {
        let withAlarm = e.target.checked;

        this.alarmItems.attr('disabled', !withAlarm);

        if (!withAlarm) {
          let obj = this.alarmTrigger[0];

          obj.selectedIndex = 1;
          obj.dispatchEvent(new Event('change'));
        }
      });

      // Custom reminder

      this.alarmTrigger.change(() => {
        this.showAlarmItems();
      });

      // Add a reminder

      $('#add-reminder').click((e) => {
        e.preventDefault();

        let opt = new Option;

        opt.value = this.composeTrigger();
        opt.innerHTML = this.getReminderText(opt.value);
        this.remopt.add(opt);
      });

      // Remove a reminder

      $('#rm-reminder').click((e) => {
        e.preventDefault();
        let idx = this.reminder.prop('selectedIndex');
        if (idx != -1) {
          this.remopt.remove(idx);
        }
      });

      $(`.${REMCLASS}`).change(() => {
        let idx = this.reminder.prop('selectedIndex');
        if (idx != -1) {
          let trigger = this.composeTrigger();
          let opt = this.remopt[idx];
          opt.value = trigger;
          opt.innerHTML = this.getReminderText(trigger);
        }
      });

      $(this.reminder).change(() => {
        let opt = this.remopt
        let match = opt[opt.selectedIndex].value.match(PATTERN);

        this.offset.val(match[2]);
        this.unit.val(match[3]);
        this.relation.val(`${match[1]}${match[4]}`);
      });
    },
  }

  app.run();
});
