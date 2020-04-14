import React, { Component } from 'react';
import { connect } from 'react-redux';
import TaskList from "./TaskList";
import { changeURL } from '../actions';

const mapStateToProps = state => {
    return { url : state.url };
};

class App extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div>
                <h1>{ this.props.url }</h1>
                <a onClick={() => this.props.dispatch(changeURL('/api/v1/tasks/all')) }>All</a>
                <a onClick={() => this.props.dispatch(changeURL('/api/v1/perspective/flagged')) }>Flagged</a>
                <h1>Hi</h1>
                <TaskList url={this.props.url}/>
            </div>
        )
    }
}

const Whelmed = connect(mapStateToProps)(App);

export default Whelmed;

