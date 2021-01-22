<template>
  <div class="form general-form">
    <div class="row">
      <div class="col-12 col-md-6">
        <div class="field">
          <label class="field-label" for="first-name">Имя</label>
          <input
            v-model="formData.firstName"
            class="field-input"
            type="text"
            id="first-name"
            placeholder="Иван"
            maxlength="225"
          >
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="field">
          <label class="field-label" for="last-name">Фамилия</label>
          <input
            v-model="formData.lastName"
            class="field-input"
            type="text"
            id="last-name"
            placeholder="Иванов"
            maxlength="225"
          >
        </div>
      </div>
      <div class="col-12">
        <div class="field">
          <label class="field-label" for="phone">Телефон</label>
          <input
            v-model="formData.phoneNumber"
            class="field-input"
            type="tel"
            id="phone"
            placeholder="+79939456754"
          >
        </div>
      </div>
      <div class="col-12">
        <div class="field">
          <label class="field-label" for="email">Email</label>
          <input
            v-model="formData.email"
            class="field-input"
            type="email"
            id="email"
            placeholder="example@example.com"
          >
        </div>
      </div>
      <div class="col-12 col-md-3">
        <div class="field">
          <button
            class="field-btn"
            :disabled="!validation.result"
            @click="nextStep"
          >
            Продолжить
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'GeneralForm',

  data () {
    return {
      formData: {
        firstName: '',
        lastName: '',
        phoneNumber: '',
        email: ''
      },
      rules: {
        firstName: field => !!field && field.length <= 225,
        lastName: field => !!field && field.length <= 225,
        phoneNumber: field => !!field && /\+[1-9]{1}[0-9]{3,14}/gm.test(field),
        email: field => !!field && /\S+@\S+\.\S+/gm.test(field)
      }
    }
  },

  computed: {
    validation () {
      const fields = this.formValidation(this.formData, this.rules)

      return {
        fields,
        result: Object.entries(fields).every(([_, result]) => result)
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
    nextStep () {
      if (this.validation.result) {
        this.$emit('next', this.formData)
      }
    }
  }
}
</script>

<style lang="scss" scoped>
</style>
