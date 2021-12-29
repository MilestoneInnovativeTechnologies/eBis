<script>
import {ChartMixin} from "src/mixins/chart";
const { PolarArea } = require('vue-chartjs')

export default {
  name: "VueChartJSPolarArea",
  extends: PolarArea,
  mixins: [ChartMixin]
}
</script>
