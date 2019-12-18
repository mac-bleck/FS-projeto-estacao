import React, { Component } from 'react';
import 'chart.js';

class LineChart extends Component {
    
    constructor(props) {
        super(props);
        this.canvasRef = React.createRef();
    }

    componentDidUpdate() {
        this.myChart.data.labels = this.props.labels;
        this.myChart.data.datasets = this.props.datasets;
        this.myChart.update();
    }

    componentDidMount() {        
        this.myChart = new Chart(this.canvasRef.current, {
            type: 'line',
            options: {
                maintainAspectRatio: false,
                
            },
            data: {
                labels: this.props.labels,
                datasets: this.props.datasets,
            }
        });
    }

    render() {
        return (
                <canvas
                    className="backgound"
                    height={this.props.height}
                    ref={this.canvasRef} 
                />
        );
    }
}

export default LineChart;