<template>
  <q-card :class="card_class" v-bind="$attrs">
    <q-card-actions vertical class="text-center q-py-xl">
      <div class="" style="font-weight: bolder; font-size: 1.5rem; line-height: 1rem"><q-icon v-if="icon" :name="icon" class="q-mr-xs"></q-icon>{{ value }}</div>
      <div><span class="text-uppercase" style="font-size: 0.8rem">{{ title }}</span></div>
    </q-card-actions>
  </q-card>
</template>

<script>
export default {
  name: 'SimpleMetric',
  props: {
    shadow: { default: true },
    value: { default: ' ' },
    icon: { default: '' },
    title: { default: '' }
  },
  computed: {
    card_class () { return this.shadow ? '' : 'no-shadow' }
  }
}
</script>
