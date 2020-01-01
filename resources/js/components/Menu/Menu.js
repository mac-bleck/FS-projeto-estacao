import React, { useState, Component } from 'react';
import Drawer from '@material-ui/core/Drawer';
import List from '@material-ui/core/List';
import Divider from '@material-ui/core/Divider';
import ListItem from '@material-ui/core/ListItem';
import ListItemIcon from '@material-ui/core/ListItemIcon';
import ListItemText from '@material-ui/core/ListItemText';
import SettingsIcon from '@material-ui/icons/Settings';
import HomeIcon from '@material-ui/icons/Home';
import ExitToAppIcon from '@material-ui/icons/ExitToApp';
import IconButton from '@material-ui/core/IconButton';
import MenuIcon from '@material-ui/icons/Menu';
import AppsIcon from '@material-ui/icons/Apps';
import EditIcon from '@material-ui/icons/Edit';
import AssignmentIndIcon from '@material-ui/icons/AssignmentInd';
import Collapse from '@material-ui/core/Collapse';
import ExpandLess from '@material-ui/icons/ExpandLess';
import ExpandMore from '@material-ui/icons/ExpandMore';
import AssessmentIcon from '@material-ui/icons/Assessment';

const axios = require('axios');
import useStyles from './style';

const MenuFunc = ({ menus }) => {

    const classes = useStyles();
    
    const [stations, setStations] = useState(menus);

    const [state, setState] = useState({
        left: false,
    });

    const [open, setOpen] = React.useState({
        station: false,
        config:false
    });

    const handleClick = (side, status) => {
        setOpen({ ...open, [side]: !status });
    };

    const toggleDrawer = (side, open) => event => {
        if (event.type === 'keydown' && (event.key === 'Tab' || event.key === 'Shift')) {
            return;
        }

        setState({ ...state, [side]: open });
    };    

    const routeHome = () => {
        window.location.href = window.location.origin;
    }

    const routeUser = () => {
        window.location.href = window.location.origin + "/config";
    }

    const routeStations = () => {
        window.location.href = window.location.origin + "/stations";
    }

    const routeLogout = () => {
        let link = window.location.origin + "/logout";

        axios.post(link).catch(function (error) {
            console.log(error);
            window.location.reload();
        });
    }

    const sideList = side => (
        <div
            className={classes.list}
            role="presentation"
            onKeyDown={toggleDrawer(side, false)}
        >
            <List>
                <ListItem button onClick={toggleDrawer('left', false)}>
                    <ListItemIcon>
                        <IconButton
                            edge="start"
                            color="inherit"
                            aria-label="open drawer"
                        >
                            <MenuIcon />
                        </IconButton>
                    </ListItemIcon>
                    <ListItemText primary="Projeto Estação" />
                </ListItem>
            </List>

            <List>
                <ListItem button onClick={()=>routeHome()}>
                    <ListItemIcon>
                        <HomeIcon />
                    </ListItemIcon>
                    <ListItemText primary="Home" />
                </ListItem>
            </List>

            <ListItem button onClick={()=>routeUser()}>
                <ListItemIcon>
                    <AssignmentIndIcon />
                </ListItemIcon>
                <ListItemText primary="Usuario" />
            </ListItem>
            
            <List>
                <ListItem button onClick={()=>handleClick('station', open.station)}>
                    <ListItemIcon>
                        <AppsIcon />
                    </ListItemIcon>
                    <ListItemText primary="Estações" />
                    {open.station ? <ExpandLess /> : <ExpandMore />}
                </ListItem>
                <Collapse in={open.station} timeout="auto" unmountOnExit>
                    <List component="div" disablePadding>
                        {stations.map((item, key)=>{
                            return (<ListItem key={key} button className={classes.nested} onClick={item.route}>
                                        <ListItemIcon>
                                            <AssessmentIcon />
                                        </ListItemIcon>
                                        <ListItemText primary={item.title} />
                                    </ListItem>
                                )
                        })}
                    </List>
                </Collapse>
            </List>

            <Divider />
            
            <List>
                <List>
                    <ListItem button onClick={()=>handleClick('config', open.config)}>
                        <ListItemIcon>
                            <SettingsIcon />
                        </ListItemIcon>
                        <ListItemText primary="Configurações" />
                        {open.config ? <ExpandLess /> : <ExpandMore />}
                    </ListItem>
                    <Collapse in={open.config} timeout="auto" unmountOnExit>
                        <List component="div" disablePadding>
                            <ListItem button className={classes.nested} onClick={()=>routeStations()}>
                                <ListItemIcon>
                                    <EditIcon />
                                </ListItemIcon>
                                <ListItemText primary="Editar Estações" />
                            </ListItem>
                        </List>
                    </Collapse>
                </List>

                <ListItem button onClick={()=>routeLogout()}>
                    <ListItemIcon>
                        <ExitToAppIcon />
                    </ListItemIcon>
                    <ListItemText primary="Sair" />
                </ListItem>
            </List>

        </div>
    );

    return (
        <div>
            <IconButton
                edge="start"
                color="inherit"
                aria-label="open drawer"
                onClick={toggleDrawer('left', true)}
            >
                <MenuIcon />
            </IconButton>
            <Drawer open={state.left} onClose={toggleDrawer('left', false)}>
                {sideList('left')}
            </Drawer>
        </div>
    );
}

class Menu extends Component {
    constructor(props){
        super(props);
        this.state = {
            stations:[]
        }

        this.getMenuItens = this.getMenuItens.bind(this);
        this.setMenu = this.setMenu.bind(this);
    }

    routeStations(id){
        window.location.href = window.location.origin + "/main?station="+id;
    }

    getMenuItens(){
        let use_id = document.querySelector("meta[name='user-id']").getAttribute('content');
        let link = window.location.origin + "/api/home/stations/" + use_id;
        
        return axios.get(link).then(res => {
            return res.data;
        });
    }

    async componentDidMount(){
        this.setMenu(await this.getMenuItens());
    }

    setMenu(array){
        let s = this.state;
   
        array.forEach(element => {
            let item = {
                "route":()=>this.routeStations(element.id),
                "icon":"",
                "title":element.name
            }

            s.stations.push(item);
        });

        this.setState(s);
    }

    render(){
        return <MenuFunc menus={this.state.stations} />
    }
}

export default Menu;