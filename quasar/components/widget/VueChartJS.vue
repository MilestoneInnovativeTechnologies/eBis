<template>
  <q-card v-if="inCard">
    <q-card-section>
      <div class="text-h6 q-mb-sm" v-if="heading">{{ heading }}</div>
      <div :style="containerStyle">
        <component :is="component" v-bind="{ data,options }" :style="canvasStyle" />
      </div>
    </q-card-section>
  </q-card>
  <component v-else :is="component" v-bind="{ data,options }" :style="canvasStyle" />
</template>
<script>
import {ChartJSDimension} from "src/mixins/chartjs_dimension";

export default {
  name: "VueChartJS",
  props: ['type','data','options','card','heading'],
  mixins: [ChartJSDimension],
  computed: {
    file(){ let type = this.type; return  'VueChartJS' + type.substr(0,1).toUpperCase() + type.substr(1) },
    component(){ return require(`./VueChartJS/${this.file}.vue`).default },
    inCard(){ return !(this.card !== undefined && (this.card === false || this.card === 'false')); },
    canvasStyle(){ return _.assign({},{ margin: 'auto' },this.dimension) },
    containerStyle(){ return _.assign({},{ position: 'relative', overflow: 'hidden' },this.dimension) },
  }
}
</script>
