<script>
import {ChartMixin} from "src/mixins/chart";
const { Line } = require('vue-chartjs')

export default {
  name: "VueChartJSLine",
  extends: Line,
  mixins: [ChartMixin]
}
</script>
