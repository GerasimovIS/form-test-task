<template>
  <div class="form delivery-form">
    <div class="row">
      <div class="col-12">
        <div class="field">
          <div class="radio-group">
            <div class="radio">
              <input
                v-model="formData.deliveryType"
                class="field-radio"
                name="delivery-type"
                type="radio"
                id="delivery"
                placeholder="Иван"
                value="delivery"
              >
              <label for="delivery">Доставка</label>
            </div>
            <div class="radio">
              <input
                v-model="formData.deliveryType"
                class="field-radio"
                name="delivery-type"
                type="radio"
                id="pickup"
                placeholder="Иван"
                value="pickup"
              >
              <label for="pickup">Самовывоз</label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="formData.deliveryType === 'delivery'" class="row">
      <div class="col-12 col-md-4">
        <div class="field">
          <label class="field-label" for="country">Страна</label>
          <select
            v-model="formData.country"
            class="field-select"
            placeholder="Страна"
            name="country-select"
            id="country"
          >
            <option disabled defailt value="">Не выбрано</option>
            <option value="ru">Россия</option>
            <option value="ua">Украина</option>
            <option value="kz">Казахстан</option>
          </select>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="field">
          <label class="field-label" for="city">Город</label>
          <input
            v-model="formData.city"
            class="field-input"
            type="text"
            id="city"
            placeholder="Москва"
            maxlength="225"
          >
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="field">
          <label class="field-label" for="index">Идекс</label>
          <input
            v-model="formData.index"
            class="field-input"
            type="text"
            maxlength="6"
            id="index"
            placeholder="162001"
          >
        </div>
      </div>
      <div class="col-12">
        <div class="field">
          <label class="field-label" for="address">Адрес</label>
          <input
            v-model="formData.address"
            class="field-input"
            type="text"
            id="address"
            placeholder="г. Москва, ул. Космоновтов, 14/5"
            maxlength="225"
          >
        </div>
      </div>
      <div class="col-12">
        <div class="field">
          <label class="field-label" for="delivery-date">Дата доставки</label>
          <input
            v-model="formData.deliveryDate"
            class="field-input"
            type="text"
            id="delivery-date"
            placeholder="24/05/2017"
          >
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="field">
          <label class="field-label" for="comment">Комментарий к заказу</label>
          <textarea
            v-model="formData.comment"
            class="field-textarea"
            id="comment"
            rows="5"
            placeholder="Ваш комментарий здесь..."
          ></textarea>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-md-3">
        <div class="field">
          <button
            class="field-btn"
            @click="back"
          >
            Вернуться
          </button>
        </div>
      </div>
      <div class="col-12 col-md-3">
        <div class="field">
          <button
            class="field-btn"
            :disabled="!validation.result"
            @click="done"
          >
            Оформить заказ
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'DeliveryForm',

  data () {
    return {
      formData: {
        deliveryType: 'delivery',
        country: '',
        city: '',
        index: '',
        address: '',
        deliveryDate: '',
        comment: ''
      },
      rules: {
        deliveryType: field => true,
        country: field => !!field,
        city: field => !!field && field.length <= 255,
        index: field => !!field && /([0-9]){6}/gm.test(field),
        address: field => !!field && field.length <= 255,
        deliveryDate: field => !!field && /[0-3]?[0-9]\/[0-3]?[0-9]\/[0-9]{4}/gm.test(field),
        comment: field => true
      }
    }
  },

  computed: {
    validation () {
      const fields = this.formValidation(this.formData, this.rules)

      return {
        fields,
        result: this.formData.deliveryType === 'pickup' || Object.entries(fields).every(([_, result]) => result)
      }
    }
  },

  methods: {
    formValidation (data, rules) {
      const result = {}

      for (const key in data) {
        result[key] = rules[key](data[key])
      }

      return result
    },
    back () {
      this.formData = {
        deliveryType: 'delivery',
        country: '',
        city: '',
        index: '',
        address: '',
        deliveryDate: '',
        comment: ''
      }

      this.$emit('back')
    },
    done () {
      if (this.validation.result) {
        this.$emit('done', this.formData)
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.radio-group {
  .radio {
    display: flex;
    align-items: center;
    margin-bottom: 5px;
  }

  .field-radio {
    margin-right: 5px;
  }
}
</style>
