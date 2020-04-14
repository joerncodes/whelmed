import React, { Component } from 'react';
import TaskFlag from "./TaskFlag";
const classNames = require('classnames');

class TaskListEntry extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        const task = this.props.task;
        var taskClass = classNames({
            'completed' : task.completed,
        });

        return (
            <li className="task-list-entry">
                <div className="row">
                    <div className="task-completion">

                    </div>
                    <div className="task-label col-10">
                        <a href="#" className={taskClass}>
                            {task.title}
                        </a>
                    </div>
                    <div className="task-actions col-1">
                        <TaskFlag flagged={task.flagged} uuid={task.uuid}></TaskFlag>
                    </div>
                </div>
            </li>
        );
    }
}

export default TaskListEntry;
