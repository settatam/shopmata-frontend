<script>
import { Line } from "vue-chartjs";

export default {
  extends: Line,
  props: ['graphData'],
  data() {
    return {
      gradient2: null
    };
  },
  mounted() {
    this.gradient2 = this.$refs.canvas
      .getContext("2d")
      .createLinearGradient(0, 0, 0, 450);

    this.gradient2.addColorStop(0, "rgba(222,33,255, 0.12)");
    this.gradient2.addColorStop(0.5, "rgba(146, 62, 161, 0.25)");
    this.gradient2.addColorStop(1, "rgba(146, 62, 161, 0)");

    this.renderChart(
      {
        labels: this.graphData.months,
        datasets: [
          {
            borderColor: "#632A6D",
            pointBackgroundColor: "white",
            pointBorderColor: "white",
            borderWidth: 1,
            backgroundColor: this.gradient2,
            data: this.graphData.sales
          }
        ]
      },
      { responsive: true, maintainAspectRatio: false, legend: false }
    );
  }
};
</script>
