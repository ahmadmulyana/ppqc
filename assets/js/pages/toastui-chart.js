// Area Chart
const el = document.getElementById('chart-area');
const data = {
  categories: [
    'Jan',
    'Feb',
    'Mar',
    'Apr',
    'May',
    'Jun',
    'Jul',
    'Aug',
    'Sep',
    'Oct',
    'Nov',
    'Dec',
  ],
  series: [
    {
      name: 'Seoul',
      data: [20, 40, 25, 50, 15, 45, 33, 34, 20, 30, 22, 13],
    },
    {
      name: 'Sydney',
      data: [5, 30, 21, 18, 59, 50, 28, 33, 7, 20, 10, 30],
    },
    {
      name: 'Moscow',
      data: [30, 5, 18, 21, 33, 41, 29, 15, 30, 10, 33, 5],
    },
  ],
};
const options = {
  chart: { width: 'auto', height: 345 },
  xAxis: { pointOnColumn: false },
  legend: { visible: false },
  exportMenu: { visible: false },
  series: { spline: true },
  theme: { series: { areaOpacity: 0.5, lineWidth: 3, colors: ['#224D8D', '#0A9452', '#FFDA17'] } },
};

const chart = toastui.Chart.areaChart({ el, data, options });