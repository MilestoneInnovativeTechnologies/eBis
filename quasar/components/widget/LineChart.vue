<template>
  <VueChartJS type="line" :options="chart_options" :data="chart_data" v-bind="chartProps()" />
</template>

<script>
import VueChartJS from "components/widget/VueChartJS";
import {ColorMixin} from "src/mixins/color";
import {ChartJSAttributes} from "src/mixins/chartjs_attributes";

export default {
  name: "LineChart",
  components: {VueChartJS},
  mixins: [ColorMixin,ChartJSAttributes],
  props: ['data'],
  data(){ return {
    attrs: {
      showLine: true,
      borderWidth: 1,
      lineTension: 0.4,
      pointRadius: 2,
      steppedLine: false,
      pointBorderWidth: 2
    }
  } },
  computed: {
    labels(){ return _.reduce(this.data,(labels,ary) => _.union(labels,_.map(ary,'label')),[]) },
    names(){ return _.keys(this.data) },
    datasets(){ return _(this.data).map((dataArray,name) => _.assign({},this.attrs,this.chartData(),_.zipObject(['label','borderColor','backgroundColor','fill','data'],[name,this.getColor(_.indexOf(this.names,name),1),this.getColor(_.indexOf(this.names,name),1),false,_.map(dataArray,'value')]))).value() },
    chart_data(){ return {
      labels: this.labels,
      datasets: this.datasets,
    } },
    chart_options(){ return this.chartOptions() }
  }
}
</script>
