import React from 'react';
import ReactDOM from 'react-dom';
import AppBar from '@material-ui/core/AppBar';
import Toolbar from '@material-ui/core/Toolbar';
import Typography from '@material-ui/core/Typography';

import MenuLeft from './../Menu/Menu';
import useStyles from './style';

export default function NavBar() {

    const [title, setTitle] = React.useState(()=>{
        let t = document.getElementById('navegation');
        return t.title;
    });

    const classes = useStyles();

    return (
            <div className={classes.grow}>
                <AppBar className={classes.colorBar} position="static">
                    <Toolbar>
                        <MenuLeft />
                        <Typography className={classes.title} variant="h6" noWrap>
                            { title }
                        </Typography>
                        
                        <div className={classes.grow} />
                    </Toolbar>
                </AppBar>
            </div>
        );
    }

if (document.getElementById('nav-bar')) {
    ReactDOM.render(<NavBar />, document.getElementById('nav-bar'));
}