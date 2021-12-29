<script>
import {ChartMixin} from "src/mixins/chart";
const { Radar } = require('vue-chartjs')

export default {
  name: "VueChartJSRadar",
  extends: Radar,
  mixins: [ChartMixin]
}
</script>
