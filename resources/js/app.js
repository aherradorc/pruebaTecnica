import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';

window.initCalendar = function () {
    const calendarEl = document.getElementById('calendar');
    if (!calendarEl) return;

    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin],
        initialView: 'dayGridMonth',
        events: '/calendar/events',
        locale: 'es',
        eventClick: function(info) {
            info.jsEvent.preventDefault();
            if (info.event.url) {
                window.open(info.event.url, '_blank');
            }
        }
    });

    calendar.render();
};
