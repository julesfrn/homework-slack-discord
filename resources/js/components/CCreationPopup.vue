<template>
  <div class="creation-popup">
    <label for="class">Matière :</label>
    <input type="text" name="class" id="class" v-model="className" />
    <label for="teacher">Professeur :</label>
    <input type="text" name="teacher" id="teacher" v-model="teacher" />
    <label for="description">Description du devoir :</label>
    <textarea name="description" id="description" cols="30" rows="10" v-model="description"></textarea>
    <label for="dateDeRendu">Date du rendu :</label>
    <input type="date" name="dueDate" v-model="dueDate">
    <label for="dueTime">Heure du rendu :</label>
    <div id="dueTime">
      <select name="hours" v-model="hours">
        <option :value="stringifyNumber(n - 1)" v-for="n in 24" :key="n">{{ stringifyNumber(n - 1) }}</option>
      </select> :
      <select name="minutes" v-model="minutes">
        <option :value="stringifyNumber(n - 1)" v-for="n in 60" :key="n">{{ stringifyNumber(n - 1) }}</option>
      </select>
    </div>
    <div style="color: red;" v-if="shouldShowErrorMessage">
      N'oublie pas de remplir tous les champs avant de valider !
    </div>
    <button @click="$emit('close-popup')">Annuler</button>
    <button @click="postHomework">Créer le devoir</button>
  </div>
</template>

<script>
import HomeworkService from '../services/HomeworkService'

export default {
  name: 'CCreationPopup',
  data() {
    return {
      className: '',
      teacher: '',
      description: '',
      dueDate: '',
      hours: '',
      minutes: '',
      shouldShowErrorMessage: false
    }
  },
  methods: {
    toggleShouldShowErrorMessage() {
      this.shouldShowErrorMessage = !this.shouldShowErrorMessage
    },
    async postHomework() {
      if (this.isFormValid) {
        const response = await HomeworkService.create({
          class: this.className,
          teacher: this.teacher,
          description: this.description,
          due_date_time: this.formatedDateTime
        })
        if (response.status === 201) {
          this.$emit('created-event', response.data)
        }
      } else {
        this.toggleShouldShowErrorMessage()
      }
    },
    stringifyNumber(number) {
      return number.toString().length < 2
        ? `0${number}`
        : number.toString()
    },
  },
  computed: {
    isFormValid() {
      return this.className.length > 0 && this.className.length < 256
        && this.teacher.length > 0 && this.teacher.length < 256
        && this.description.length > 0
        && this.dueDate.length > 0 && this.dueDate.length < 256
        && this.hours.toString().length > 0 && this.hours.toString().length < 256
        && this.minutes.toString().length > 0 && this.minutes.toString().length < 256
    },
    formatedDateTime() {
      return `${this.dueDate}T${this.hours}:${this.minutes}:00`
    }
  },
}
</script>

<style lang="scss">
.creation-popup {
  &::before {
    content: "";
    z-index: -1;
    position: absolute;
    background: #fff;
    opacity: .6;
    width: 100vw;
    height: 100vh;
  }
  z-index: 99999;
  background: #fff;
  border: solid 1px #36a8f5;
  box-shadow: 0 0 10px #000;
  border-radius: 5px;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  height: calc(100vh - 30px);
  width: calc(100vw - 30px);
  max-width: 800px;
  max-height: 500px;
  padding: 15px;
  box-sizing: border-box;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  & > * {
    width: 100%
  }
  label:not(:first-child), button {
    margin-top: 15px;
  }
}
</style>
