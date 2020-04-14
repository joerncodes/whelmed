import React, { Component } from 'react';
import TaskListEntry from "./TaskListEntry";
import { connect } from 'react-redux';

const mapStateToProps = state => {
    return { url : state.url };
};

class TaskListComponent extends Component
{
    constructor(props) {
        super(props);
        this.state = {
            loaded: false,
            tasks: []
        }
    }

    fetchTasks() {
        this.setState({ loaded : false });
        fetch(this.props.url, {
            credentials: 'include',
            headers: {
                'Authorization': 'Bearer rt206mq0e71whn7hdif7mj62437xus47',
            }
        })
            .then(res => res.json())
            .then(
                (results) => {
                    this.setState({
                        loaded: true,
                        tasks: results.results.tasks
                    });
                }
            );
    }

    componentDidMount() {
        this.fetchTasks()
    }

    componentDidUpdate(prevProps) {
        if(this.props.url != prevProps.url) {
            this.fetchTasks()
        }
    }

    render() {
        const { loaded, tasks } = this.state;

        if(!loaded) {
            return <div>Loading...</div>
        }

        return(
            <ul className={'list-unstyled task-list'}>
                <li><b>{this.props.url}</b></li>
                {tasks.map(task => (
                    <TaskListEntry task={task}></TaskListEntry>
                ))}
            </ul>
        )
    }
}

const TaskList = connect(mapStateToProps)(TaskListComponent);
export default TaskList;
