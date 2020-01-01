import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import LineChart from './LineChart';
import CircularIndeterminate from './CircularIndeterminate/CircularIndeterminate';

import Comun from './Data/Comun';
import Colors from './Data/Colors';

const axios = require('axios');

class GraficSensor extends Component{
  
    constructor(props){
        super(props);
        this.state = {
            graficData:{
                labels:[],
                datasets:[]
            },
            isFetching: true
        }

        this.setDataGraficInit = this.setDataGraficInit.bind(this);
        this.setNewData = this.setNewData.bind(this);
    }

    getData() {
        let link = window.location.href;
        link = link.split("/");
        link = link[0] + "//" + link[2] + "/api/" + link[3] + "/" + link[4];
        
        return axios.get(link).then(res => {
            return res.data;
          })
    }

    setNewData(array){
        let s = this.state;
        
        array.forEach((element, index) => {
            if (typeof(element) == "string"){
                if (s.graficData.labels.length < 15) {
                    s.graficData.labels.push(element);
                    
                } else {
                    s.graficData.labels.push(element);
                    s.graficData.labels.shift();  
                }              
            } else {
                if (element.type == this.state.graficData.datasets[0].label) {
                    if (s.graficData.datasets[0].data.length < 15) {
                        s.graficData.datasets[0].data.push(element.value)
                    } else {
                        s.graficData.datasets[0].data.push(element.value)
                        s.graficData.datasets[0].data.shift();
                    }
                }
            }
        });

        this.setState(s);
    }

    setDataGraficInit(array){
        let s = this.state;
        
        let info = {
            label: array[0][0],
            borderColor: Colors[5], //cor de fundo da borda
            pointHoverBackgroundColor: Colors[5], //cor da bolinha ao passar o mouse na intercessão
            data: array[1],
            ...Comun
        }

        s.graficData.datasets.push(info);
        s.graficData.labels = array[2];

        s.isFetching = false;
        this.setState(s);
    } 

    async componentDidMount(){        
        this.setDataGraficInit(await this.getData());

        window.Echo.channel('value-sensor').listen('ValueSensor', (e) => {            
            this.setNewData(e);            
        });
    }

    render() {
      return (
            <>
                {this.state.isFetching && <CircularIndeterminate />}
                {!this.state.isFetching && <LineChart
                    datasets={this.state.graficData.datasets}
                    labels={this.state.graficData.labels}
                    height={270}
                />}
            </>                  
      );
    }
}

export default GraficSensor;

if (document.getElementById('grafic-sensor')) {
    ReactDOM.render(<GraficSensor />, document.getElementById('grafic-sensor'));
}