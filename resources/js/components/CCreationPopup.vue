<template>
  <div class="creation-popup">
    <label for="class">Matière :</label>
    <input type="text" name="class" id="class"/>
    <label for="teacher">Professeur :</label>
    <input type="text" name="teacher" id="teacher" />
    <label for="description">Description du devoir :</label>
    <textarea name="description" id="description" cols="30" rows="10"></textarea>
    <label for="dateDeRendu">Date du rendu :</label>
    <input type="date" name="dueDate">
    <label for="dueTime">Heure du rendu :</label>
    <div id="dueTime">
      <select name="hours">
        <option :value="n - 1" v-for="n in 24" :key="n">{{ n - 1 }}</option>
      </select>
      <select name="minutes">
        <option :value="n - 1" v-for="n in 60" :key="n">{{ n - 1 }}</option>
      </select>
    </div>
    <button @click="$emit('close-popup')">Annuler</button>
    <button @click="$emit('close-popup')">Créer le devoir</button>
  </div>
</template>

<script>
export default {
  name: 'CCreationPopup'
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
