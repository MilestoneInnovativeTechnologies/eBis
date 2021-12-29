<template>
  <div class="text-center">
    <q-circular-progress :show-value="show" font-size="1.5rem" :value="parseFloat(value)" size="8rem" :thickness="0.35" :color="color" :track-color="track" v-bind="$attrs">
      {{ value }}%
    </q-circular-progress>
    <p class="q-my-sm text-uppercase" style="font-size: 0.7rem; font-weight: bolder">{{ title }}</p>
  </div>
</template>

<script>
export default {
  name: 'CircularProgress',
  inheritAttrs: false,
  props: {
    value: { default: 100, type: [String, Number] },
    color: { default: 'primary' },
    track: { default: 'grey-3' },
    show: { default: true },
    title: { default: '' }
  }
}
</script>
