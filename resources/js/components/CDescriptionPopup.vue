<template>
  <div class="description-popup">
    <h1>{{ eventProps.title }}</h1>
    <h3>à rendre pour : {{ new Date(eventProps.start).toLocaleString('fr-FR') }}</h3>
    <p>{{ eventProps.description }}</p>
    <button @click="$emit('close-popup')">Retourner au calendrier</button>
  </div>
</template>

<script>
  export default {
    name: 'CDescriptionPopup',
    props: {
      eventProps: {
        type: Object,
        required: true
      }
    }
  }
</script>

<style lang="scss" scoped>
.description-popup {
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
}
</style>
