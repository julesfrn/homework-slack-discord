<template>
  <div class="home">
    <full-calendar ref="fullCalendar" :options="calendarOptions" />
    <c-creation-popup v-if="shouldShowCreationPopup" @close-popup="toggleCreationPopup" @created-event="handleCreatedEvent" />
  </div>
</template>

<script>
import FullCalendar from '@fullcalendar/vue'
import timeGridPlugin from '@fullcalendar/timegrid'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

import HomeworkService from '../services/HomeworkService'
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
        eventClick: this.openEvent,
        eventDisplay: 'auto',
        events: [],
        allDaySlot: false
      },
      shouldShowCreationPopup: false
    }
  },
  async beforeMount() {
    const eventsRaw = await HomeworkService.index()
    this.calendarOptions.events = eventsRaw.map(eventRaw => this.eventMapper(eventRaw))
  },
  methods: {
    toggleCreationPopup() {
      this.shouldShowCreationPopup = !this.shouldShowCreationPopup
    },
    eventMapper(eventRaw) {
      return {
        id: eventRaw.id,
        title: `${eventRaw.class} - ${eventRaw.teacher}`,
        start: eventRaw.due_date_time,
        description: eventRaw.description
      }
    },
    handleCreatedEvent(data) {
      this.calendarOptions.events.push(this.eventMapper(data))
      this.toggleCreationPopup()
    },
    openEvent(fullCalendarEvent) {
      console.log(this.calendarOptions.events.find(event => event.id == fullCalendarEvent.event.id).description)
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
