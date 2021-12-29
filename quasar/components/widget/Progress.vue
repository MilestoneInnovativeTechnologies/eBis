<template>
  <section class="q-ma-sm">
    <div class="flex justify-between text-uppercase" style="font-size: 0.75rem; font-weight: bold" v-if="title"><span>{{ title }}</span><span>{{ value }}%</span></div>
    <q-linear-progress :size="size" :value="parseInt(value)/100" :color="color" v-bind="$attrs" />
  </section>
</template>

<script>
export default {
  name: 'Progress',
  props: {
    value: { default: '50' },
    color: { default: 'primary' },
    size: { default: 'xl' },
    title: { default: '' }
  },
  inheritAttrs: false,
  data () {
    return {}
  }
}
</script>
