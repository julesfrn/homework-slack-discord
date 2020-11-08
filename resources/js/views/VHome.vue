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
        events: []
      },
      shouldShowCreationPopup: false,
      calendarApi: {}
    }
  },
  mounted() {
    this.calendarApi = this.$refs.fullCalendar.getApi()
  },
  methods: {
    addEvent(eventProps) {
      this.calendarOptions.events.push(event)
    },
    toggleCreationPopup() {
      this.shouldShowCreationPopup = !this.shouldShowCreationPopup
    },
    handleCreatedEvent(data) {
      this.calendarApi.addEvent({
        id: data.id,
        title: `${data.class} - ${data.teacher}`,
        start: data.due_date_time,
        description: data.description
      })
      this.toggleCreationPopup()
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
