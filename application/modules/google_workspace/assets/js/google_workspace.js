(function(){
    'use strict';
    $(function(){
        if ($('#google-workspace-email-table').length) {
            $('#google-workspace-email-table').DataTable();
        }

        if (typeof calendar_events !== 'undefined' && $('#google-workspace-calendar').length) {
            var calendarEl = document.getElementById('google-workspace-calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: calendar_events
            });
            calendar.render();
        }
    });
})();
