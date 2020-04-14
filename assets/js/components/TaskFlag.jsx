import React, { Component } from 'react';

class TaskFlag extends Component {
    constructor(props) {
        super(props);
        this.state = { flagged : this.props.flagged }
    }

    toggle() {
        this.setState({ flagged : !this.state.flagged });
        var url = '/api/v1/task/'+this.props.uuid+'/';

        url += this.state.flagged ? 'unflag' : 'flag';

        fetch(url, {
            method: 'PUT',
            credentials: 'same-origin',
        })
            .then(res => res.json())
            .then(
                (message) => {
                    console.log(message.message)
                },
                (results) => {
                    alert(results);
                }
            )
    }

    render() {
        var className = 'task action action-icon';
        if(this.state.flagged) {
            className += ' active';
        }
        return (
            <a href="#" onClick={() => this.toggle()} className={className}>
                <i className="mdi mdi-flag"></i>
            </a>
        )
    }
}

export default TaskFlag;
