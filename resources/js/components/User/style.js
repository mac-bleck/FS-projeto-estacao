import { makeStyles } from '@material-ui/core/styles';
import { deepOrange } from '@material-ui/core/colors';

const useStyles = makeStyles(theme => ({
    root: {
      display: 'flex',
      '& > *': {
        margin: theme.spacing(1),
      },
    },
    orange: {
      color: theme.palette.getContrastText(deepOrange[500]),
      backgroundColor: deepOrange[500],
    },
    back:{
      backgroundColor:'transparent'
    },
    large: {
      fontSize:'60px',
      width: theme.spacing(15),
      height: theme.spacing(15),
    }
}));

export default useStyles;