<script>
import {ChartMixin} from "src/mixins/chart";
const { HorizontalBar } = require('vue-chartjs')

export default {
  name: "VueChartJSHorizontalBar",
  extends: HorizontalBar,
  mixins: [ChartMixin]
}
</script>
