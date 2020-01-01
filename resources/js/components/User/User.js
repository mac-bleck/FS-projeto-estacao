import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Avatar from '@material-ui/core/Avatar';
import CircularIndeterminate from './../CircularIndeterminate/CircularIndeterminate';

import useStyles from './style';
const axios = require('axios');

const UserContent = ({ name }) => {
  
    const classes = useStyles();

    return (
      <div className={classes.root}>
            <Avatar 
                alt={name}
                src="/broken-image.jpg" 
                className={classes.orange + " " + classes.large} 
            />
      </div>
    );
}

class User extends Component {
  
    constructor(props){
        super(props);
        this.state = {
            user:{
                name:"",
                email:"",
                token:""
            },
            isFetching: true
        }

        this.setDataInit = this.setDataInit.bind(this);
    }

    getData() {
        let use_id = document.querySelector("meta[name='user-id']").getAttribute('content');
        let link = window.location.origin + "/api/config/" + use_id;
        
        return axios.get(link).then(res => {
            return res.data;
        });
    }

    async componentDidMount(){
        this.setDataInit(await this.getData());
    }

    setDataInit(info){
        let s = this.state;

        s.user.name = info.name;
        s.user.email = info.email;
        s.user.token = info.writing_token;
        
        s.isFetching = false;
        this.setState(s);
    }    

    render() {
        return (
            <>
                { this.state.isFetching &&  (<div className="col-md-3" >
                                                <div className="card back">
                                                    <div className="card-body station-center">
                                                        <CircularIndeterminate />
                                                    </div>               
                                                </div>
                                             </div>
                                            )
                }
                {!this.state.isFetching && (<div className="col-md-8 info-user-div">
                                                <div className="col-md-3 block" >
                                                    <div className="card back">
                                                        <div className="card-body station-center new-card-body">
                                                            <UserContent name={this.state.user.name} />
                                                        </div>               
                                                    </div>
                                                </div>
                                                <div className="col-md-9" >
                                                    <div className="card back info">
                                                        <div className="card-body new-card-body">
                                                            <div className="row-info">
                                                                <div className="col-md-2 info-title">User</div>
                                                                <div className="col-md-10">{this.state.user.name}</div>
                                                            </div>
                                                            <div className="row-info">
                                                                <div className="col-md-2 info-title">E-mail</div>
                                                                <div className="col-md-10">{this.state.user.email}</div>
                                                            </div>
                                                            <div className="row-info">
                                                                <div className="col-md-2 info-title">Token</div>
                                                                <div className="col-md-10 info-body" >
                                                                    {this.state.user.token}
                                                                </div>
                                                            </div>
                                                        </div>             
                                                    </div>
                                                </div>
                                            </div>
                                            )}                   
            </>
        );
    }
}

export default User;

if (document.getElementById('user-info')) {
    ReactDOM.render(<User />, document.getElementById('user-info'));
}