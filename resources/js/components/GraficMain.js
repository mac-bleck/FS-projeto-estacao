import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import CircularIndeterminate from './CircularIndeterminate/CircularIndeterminate';

import LineChart from './LineChart';

import Comun from './Data/Comun';
import Colors from './Data/Colors';

const axios = require('axios');

class GraficMain extends Component {
  
    constructor(props){
        super(props);
        this.state = {
            graficData:{
                labels:[],
                datasets:[]
            },
            setType: '',
            isFetching: true
        }

        this.setDataGraficInit = this.setDataGraficInit.bind(this);
        this.setNewData = this.setNewData.bind(this);
    }

    getData() {
        let link = window.location.href;
        link = link.split("/");
        link = link[0] + "//" + link[2] + "/api/grafic/" + link[3];

        return axios.get(link).then(res => {
            return res.data;
        });
    }

    async componentDidMount(){
        
        this.setDataGraficInit(await this.getData());

        window.Echo.channel('value-sensor').listen('ValueSensor', (e) => {            
            this.setNewData(e);            
        });
    }

    setNewData(array){
        let s = this.state;
        
        array.forEach((element, index) => {
            if (typeof(element) == "string"){
                if (s.graficData.labels.length < 20) {
                    s.graficData.labels.push(element);                    
                } else {
                    s.graficData.labels.push(element);
                    s.graficData.labels.shift();  
                }                   
            } else {
                if (s.graficData.datasets[index].data.length < 20) {
                    s.graficData.datasets[index].data.push(element.value)
                    
                } else {
                    s.graficData.datasets[index].data.push(element.value)
                    s.graficData.datasets[index].data.shift();
                }
            }
        });
        
        this.setState(s);
    }

    setDataGraficInit(array){
        let s = this.state;
        
        for (let i = 0; i <= array.length - 1; i++) {

            let info = {
                label: array[i].label,
                borderColor: Colors[i], //cor de fundo da borda
                pointHoverBackgroundColor: Colors[i], //cor da bolinha ao passar o mouse na intercessão
                data: array[i].data,
                ...Comun
            }

            s.graficData.datasets.push(info);
            s.graficData.labels = array[i].labels;
            
            s.setType = s.graficData.datasets[0].label;
        }
        
        s.isFetching = false;
        this.setState(s);
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

export default GraficMain;

if (document.getElementById('grafic-main')) {
    ReactDOM.render(<GraficMain />, document.getElementById('grafic-main'));
}