import { Line } from 'vue-chartjs'

export default {
  extends: Line,
  // props: ['data', 'lables'],
  props: {
  data: Array,
  labels: String,
  scale: {
    default: 'linear',
    type: String
  }
},
  mounted () {
    // Overwriting base render method with actual data.
    console.log(this.scale);
    this.renderChart({
      //labels: this.labels,
      datasets: this.data,
    }, {
        responsive: true,
        tooltips: {
            //backgroundColor: '#246EBA'
        },
        legend: {
          position: 'bottom'
        },
        scales: {
            xAxes: [{
                type: 'time',
                time: {
                    unit: 'day',
                    parser: 'YYYY-MM-DD',
                    round: 'day',
                    tooltipFormat: 'll'
                },
                display: true
            }],
            yAxes: [{
                id: 'A',
                ticks: {
                  fontColor: "#246EBA",
                  precision:0
                },
                type: this.scale,
                position: 'left',
              },
              {
                id: 'B',
                ticks: {
                  fontColor: "#eb4647",
                  precision:0
                },
                gridLines: {
                    display: false,
                  },
                type: this.scale,
                position: 'right',
            }]
        }
    })
  }
}

