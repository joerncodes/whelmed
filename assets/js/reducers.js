import {
    CHANGE_URL,
} from './actions';

const initialState = {
    url : '/api/v1/tasks/all',
}

function whelmedApp(state = initialState, action) {
    switch(action.type) {
        case CHANGE_URL:
            return Object.assign({}, state, {
                url: action.url
            });
        default:
            return state;
    }
}

export default whelmedApp;
