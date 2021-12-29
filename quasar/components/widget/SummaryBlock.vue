<template>
  <q-card square class="no-shadow">
    <q-card-actions vertical class="text-center">
      <span :class="'text-' + color" style="font-size: 0.9rem"><q-icon :name="icon" size="1.3rem"></q-icon>{{ percent }}%</span>
      <strong class="q-ma-none">{{ value }}</strong>
      <span class="q-ma-none text-uppercase" style="font-size: 0.75rem">{{ title }}</span>
    </q-card-actions>
  </q-card>
</template>

<script>
export default {
  name: 'SummaryBlock',
  props: ['title', 'value'],
  computed: {
    dir () { return _(['up', 'down', 'left', 'right']).map(d => _.has(this.$attrs, d) ? d : null).filter().first() || 'left' },
    percent () { return this.$attrs[this.dir] },
    icon () { return 'keyboard_arrow_' + this.dir },
    color () { return { up: 'positive', down: 'negative', left: 'orange', right: 'purple' }[this.dir] }
  }
}
</script>
