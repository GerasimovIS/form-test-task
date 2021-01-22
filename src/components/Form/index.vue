<template>
  <div class="form">
    <div class="top">
      <div class="row">
        <div class="col-12">
          <span
            class="title title-general"
            :class="activeComponent === 'General' && 'title-active'"
          >
            Основные данные
          </span>
          <span>&#8594;</span>
          <span
            class="title title-delivery"
            :class="activeComponent === 'Delivery' && 'title-active'"
          >
            Адрес доставки
          </span>
        </div>
      </div>
    </div>

    <div class="body">
      <keep-alive>
        <component
          :is="activeComponent"
          @next="next"
          @back="back"
          @done="done"
        />
      </keep-alive>
    </div>

    <Modal v-model="showModal">
      <div v-if="isRequestSuccess" class="message message-success">
        Успешно отправлено
      </div>
      <div v-else class="message message-error">
        Просьба повторить запрос позже
      </div>
    </Modal>
  </div>
</template>

<script>
import Modal from '../Modal'
import GeneralForm from './GeneralForm'
import DeliveryForm from './DeliveryForm'

export default {
  name: 'Form',

  components: {
    General: GeneralForm,
    Delivery: DeliveryForm,
    Modal
  },

  data () {
    return {
      activeComponent: 'General',
      showModal: false,
      isRequestSuccess: false,
      result: {
        generalData: null,
        deliveryData: null
      }
    }
  },

  methods: {
    next (data) {
      this.result.generalData = Object.assign({}, data)
      this.activeComponent = 'Delivery'
    },
    back () {
      this.result.deliveryData = null
      this.activeComponent = 'General'
    },
    done (data) {
      this.result.deliveryData = Object.assign({}, data)

      fetch('http://localhost:9000/test.php')
        .then(res => res.json())
        .then(({ success }) => {
          this.isRequestSuccess = success
          this.showModal = true

          if (success) {
            setTimeout(() => location.reload(), 2000)
          }
        })
        .catch(e => {
          this.isRequestSuccess = false
          this.showModal = false
          throw new Error(e)
        })
    }
  }
}
</script>

<style lang="scss" scoped>
.form {
  width: 100%;

  .top {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 15px 0;
    margin-bottom: 15px;
    border-bottom: 1px solid #CCC;

    span {
      color: #CCC;
      margin-right: 15px;
    }

    .title {
      &-active {
        color: #000;
      }
    }
  }

  .body {
    margin-bottom: 5px;
  }

  .message {
    text-align: center;

    &-success {
      color: #357135;
    }

    &-error {
      color: #713535;
    }
  }
}
</style>
