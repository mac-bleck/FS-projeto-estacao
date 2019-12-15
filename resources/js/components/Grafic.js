import React from 'react';
import ReactDOM from 'react-dom';
import { Line } from 'react-chartjs-2';

const data = {
  labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'June', 'July', 'June', 'July'],
  datasets: [
    {
      label: 'Temperatura',
      fill: false,
      lineTension: 0.1,
      backgroundColor: 'rgba(75,192,192,0.4)',
      borderColor: 'rgba(75,192,192,1)',
      borderCapStyle: 'butt',
      borderDash: [],
      borderDashOffset: 0.0,
      borderJoinStyle: 'miter',
      pointBorderColor: 'rgba(75,192,192,1)',
      pointBackgroundColor: '#fff',
      pointBorderWidth: 1,
      pointHoverRadius: 5,
      pointHoverBackgroundColor: 'rgba(75,192,192,1)',
      pointHoverBorderColor: 'rgba(220,220,220,1)',
      pointHoverBorderWidth: 2,
      pointRadius: 1,
      pointHitRadius: 10,
      data: [65, 59, 80, 81, 56, 55, 40, 30, 30, 80]
    }
  ]
};

function Grafic() {
    return (
        <Line data={data} />                    
    );
}

export default Grafic;

if (document.getElementById('grafic-sensor')) {
    ReactDOM.render(<Grafic />, document.getElementById('grafic-sensor'));
}

/*
 
*/