import React, { Component } from 'react';

class TaskSelectProject extends Component {
    constructor(props) {
        super(props);
        this.state = { opened : false }
    }

    /*toggle() {
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
    }*/
    toggle() {
        this.state.opened = !this.state.opened;
        this.forceUpdate();
        return false;
    }

    render() {
        if(this.state.opened === true) {
            return (<p>Open!</p>)
        }

        var className = 'task action action-icon';
        return (
            <a href="javascript:void(0);" onClick={() => this.toggle()} className={className}>
                <i className="mdi mdi-format-list-checkbox"></i>
            </a>
        )
    }
}

export default TaskSelectProject;
