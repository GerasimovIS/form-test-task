<template>
  <div v-if="value" class="modal-mask">
    <div class="modal-container">
      <div class="modal">
        <slot />
        <div class="footer">
          <button
            class="field-btn"
            @click="$emit('input', false)"
          >
            Закрыть
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    value: {
      type: Boolean,
      default: false
    }
  }
}
</script>

<style lang="scss" scoped>
.modal {
  padding: 10px;
  background: #ECECEC;;
  border-radius: 4px;
  box-shadow: 0 0 4px rgba(0,0,0,0.5);

  &-mask {
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    overflow: hidden;
    z-index: 9999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
  }

  &-container {
    max-width: 350px;
    width: 100%;
  }

  .footer {
    margin-top: 15px;
    text-align: right;
  }
}
</style>
