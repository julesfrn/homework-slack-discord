<template>
  <div class="home">
    <full-calendar :options="calendarOptions" />
    <c-creation-popup v-if="shouldShowCreationPopup" @close-popup="toggleCreationPopup" />
  </div>
</template>

<script>
import FullCalendar from '@fullcalendar/vue'
import timeGridPlugin from '@fullcalendar/timegrid'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

import CCreationPopup from '../components/CCreationPopup.vue'

export default {
  name: 'VHome',
  components: {
    FullCalendar,
    CCreationPopup
  },
  data() {
    return {
      calendarOptions: {
        plugins: [ timeGridPlugin, dayGridPlugin, interactionPlugin ],
        customButtons: {
          addEvent: {
            text: 'Ajouter un devoir',
            click: this.toggleCreationPopup
          }
        },
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'addEvent dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialView: 'timeGridWeek',
        locale: 'fr',
        firstDay: 1,
        nowIndicator: true,
        height: '100vh',
        eventClick: this.openPopup,
        eventDisplay: 'auto',
        events: [{
          title: 'The Title',
          start: '2020-11-05T12:30:00',
          end: '2020-11-05T12:30:00'
        }]
      },
      shouldShowCreationPopup: false
    }
  },
  methods: {
    addEvent(eventProps) {
      this.calendarOptions.events.push(event)
    },
    toggleCreationPopup() {
      this.shouldShowCreationPopup = !this.shouldShowCreationPopup
    }
  }
}
</script>

<style lang="scss">
body {
  margin: 0;
}
.home {
  font-family: 'Roboto', sans-serif;
}
</style>
