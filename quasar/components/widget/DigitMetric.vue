<template>
  <q-card square @mouseover="hover = true" @mouseleave="hover = false" class="no-shadow">
    <q-card-section :class="section_class">
      <div class="text-h4" style="font-weight: bolder">{{ value }}<q-icon style="position: absolute; right: 0px; top: 0px;" class="q-mr-md q-mt-md" v-if="icon" :color="icon_color" :name="icon" size="3.8rem"></q-icon></div>
      <div class="text-subtitle2 text-uppercase" style="font-size: 0.75rem">{{ title||defaults.title }}</div>
    </q-card-section>
    <q-card-actions align="center" :class="action_class" v-if="to">
      <q-btn size="sm" flat type="a" :to="to">View Detail <q-icon name="double_arrow" class="q-ml-sm" size="0.8rem"></q-icon></q-btn>
    </q-card-actions>
  </q-card>
</template>

<script>
export default {
  name: 'DigitMetric',
  props: ['bg', 'value', 'text', 'title', 'icon', 'to'],
  data () {
    return {
      defaults: { bg: 'white', text: 'black', title: 'Title' },
      hover: false
    }
  },
  computed: {
    section_class () {
      return []
        .concat('bg-' + this.bg || this.defaults.bg)
        .concat('text-' + this.text || this.defaults.text)
        .concat(this.hover ? 'over' : '')
    },
    action_class () {
      return []
        .concat('bg-' + (this.bg || this.defaults.bg) + '-9')
        .concat('text-' + (this.text || this.defaults.text))
        .concat('q-pa-none')
    },
    icon_color () {
      return (this.bg || this.defaults.bg) + '-9'
    }
  }
}
</script>

<style lang="css" scoped>
  .q-icon { transition:all 0.1s linear; }
  .over .q-icon { transform: scale(1.2,1.2) }
</style>
