<template>
  <div class="home">
    <full-calendar ref="fullCalendar" :options="calendarOptions" class="calendar" />
    <c-creation-popup v-if="shouldShowCreationPopup" @close-popup="toggleCreationPopup" @created-event="handleCreatedEvent" />
    <c-description-popup v-if="shouldShowDescriptionPopup" @close-popup="toggleDescriptionPopup" :eventProps="currentEventProps" />
  </div>
</template>

<script>
import FullCalendar from '@fullcalendar/vue'
import timeGridPlugin from '@fullcalendar/timegrid'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

import HomeworkService from '../services/HomeworkService'
import CCreationPopup from '../components/CCreationPopup.vue'
import CDescriptionPopup from '../components/CDescriptionPopup.vue'

export default {
  name: 'VHome',
  components: {
    FullCalendar,
    CCreationPopup,
    CDescriptionPopup
  },
  data() {
    return {
      calendarOptions: {
        plugins: [ timeGridPlugin, dayGridPlugin, interactionPlugin ],
        customButtons: {
          addEvent: {
            text: '+ Ajouter un devoir',
            click: this.toggleCreationPopup
          }
        },
        headerToolbar: {
          left: 'prev,next today dayGridMonth,timeGridWeek,timeGridDay',
          center: 'title',
          right: 'addEvent'
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
      shouldShowCreationPopup: false,
      shouldShowDescriptionPopup: false,
      currentEventProps: {}
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
    toggleDescriptionPopup() {
      this.shouldShowDescriptionPopup = !this.shouldShowDescriptionPopup
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
      this.currentEventProps = this.calendarOptions.events.find(event => event.id == fullCalendarEvent.event.id)
      this.toggleDescriptionPopup()
    }
  }
}
</script>

<style lang="scss">
@import '../fullCalendarOverride.scss';

body {
  margin: 0;
}
.home {
  font-family: 'Roboto', sans-serif;
  box-sizing: border-box;
  padding: 15px;
  height: 100vh;
  max-height: 100vh;
}
.calendar {
  max-height: calc(100vh - 30px)
}
</style>
