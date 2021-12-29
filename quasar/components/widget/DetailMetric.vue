<template>
  <q-card :class="card_class" :square="square">
    <q-card-section horizontal>
      <q-card-section :class="'bg-' +color+ '-8'">
        <q-icon :name="icon" size="2.5rem" :color="color + '-3'" class="q-pa-md"></q-icon>
      </q-card-section>
      <q-card-section class="q-px-none full-width">
        <div class="q-px-md">
          <div :class="uppercase ? 'text-uppercase' : ''" style="font-size: 0.75rem">{{ title }} </div>
          <p class="q-mt-none q-mb-sm" style="font-weight: bolder">{{ value }} </p>
        </div>
        <q-linear-progress style="height: 0.1rem" :value="parseInt(progress)/100" :color="text"></q-linear-progress>
        <p class="q-mx-md q-pt-sm q-my-none" style="font-size: 0.75rem">{{ detail }} </p>
      </q-card-section>
    </q-card-section>
  </q-card>
</template>

<script>
export default {
  name: 'DetailMetric',
  props: {
    color: { default: 'indigo' },
    shadow: { default: false },
    square: { default: true },
    text: { default: 'white' },
    value: { default: '' },
    progress: { default: '50' },
    title: { default: ' ' },
    detail: { default: ' ' },
    icon: { default: 'mood' },
    uppercase: { default: true }
  },
  computed: {
    card_class () {
      return [].concat(
        ['bg-' + this.color],
        this.shadow ? [] : ['no-shadow'],
        ['text-' + this.text]
      )
    }
  }
}
</script>
