import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ClassColors from './Data/ClassColors';

const axios = require('axios');

class ValueSensor extends Component {
    
    constructor(props){
        super(props);
        this.state = {
            data:[],
            sizeClass: 'col-md-2'
        }

        this.setClassMd = this.setClassMd.bind(this);
        this.setDataSensors = this.setDataSensors.bind(this);
    }

    getData() {
        let link = window.location.href;
        link = link.split("/");
        link = link[0] + "//" + link[2] + "/api/sensor/" + link[3];

        return axios.get(link).then(res => {
            return res.data;
          })
    }

    async componentDidMount(){

        this.setDataSensorsInit(await this.getData());
        this.setClassMd(this.state.data.length);
        
        window.Echo.channel('value-sensor').listen('ValueSensor', (e) => {            
            this.setDataSensors(e);
            this.setClassMd(this.state.data.length);
        });
    }

    setDataSensorsInit(array) {
        
        let s = this.state;
        let dados = [];
        for (let i = 0; i <= array.length - 1; i++) {
            dados.push(array[i]);
        }

        s.data = dados;
        this.setState(s);
    }

    setDataSensors(array) {
        let s = this.state;
        let dados = [];
        for (let i = 0; i < array.length - 1; i++) {
            dados.push(array[i]);
        }

        s.data = dados;
        this.setState(s);
    }

    setClassMd(size){
        let s = this.state;
        
        if (size <= 4){
            s.sizeClass = 'col-md-3';
        } else if (size > 4 && size <= 6){
            s.sizeClass = 'col-md-2';
        }

        this.setState(s);
    }

    render(){
        return (
            <div className="row justify-content-center">
                {this.state.data.map((v, k)=>{
                    return (
                        <div
                            key={k} 
                            className={this.state.sizeClass} 
                            onClick={() => window.location.href= "http://" + window.location.host + "/sensor/" + v.sensor_id}>
                            
                            <div className="{card home-sensor backgound">
                                <div className="card-body station-center">
                                    <h3 className="main-value">{v.value}</h3>
                                </div>
                                
                                <div className={"card-header station-center " + ClassColors[k]}>
                                    <i className="color">{v.type}</i>
                                </div>                
                            </div>
                        </div>
                    );
                })}
            </div>
        )
    }
}

export default ValueSensor;

if (document.getElementById('value-sensor')) {
    ReactDOM.render(<ValueSensor />, document.getElementById('value-sensor'));
}