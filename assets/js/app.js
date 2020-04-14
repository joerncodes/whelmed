/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/global.scss';
import '../css/app.css';
import 'bootstrap';
import 'jquery-modal';
import $ from 'jquery';

const flatpickr = require('flatpickr');
require('bootstrap');
require('jquery-modal');

import React from 'react';
import ReactDOM from 'react-dom';


// <snip>
import { createStore } from 'redux';
import whelmedApp from './reducers';
const store = createStore(
    whelmedApp,
    window.__REDUX_DEVTOOLS_EXTENSION__ && window.__REDUX_DEVTOOLS_EXTENSION__()
);
import { Provider } from 'react-redux';
import Whelmed from './components/App'

// <snap>


import TaskFlag from './components/TaskFlag'
import TaskList from './components/TaskList'

/*ReactDOM.render(
    <Provider store={store}>
        <Whelmed />
    </Provider>
    , document.getElementById('root'));*/

document.querySelectorAll('.task-flag')
    .forEach(domContainer => {
        const flagged = domContainer.dataset.flagged === 'true';
        const uuid = domContainer.dataset.uuid;
        ReactDOM.render(<TaskFlag flagged={flagged} uuid={uuid} />, domContainer)
    });

$(document).on($.modal.OPEN, function() {
    if ($('.task-form:visible').length) {
        $('#task-title').focus();
        const dueDatePicker = flatpickr('#task-due-date', {
            enableTime: true,
            onClose: function () {
                $('.due-date').toggle();
            }
        });

        $('.task-form .task-add-project').click(function() {
            $('.task-form .projects').show();
            return false;
        });
        $('.task-form .projects .task-choose-project').bind('click', function() {
            $('#task-project-uuid').val($(this).data('uuid'));
            $('.task-form .projects').hide();
            return false;
        });
        $('.task-form .task-due-date').bind('click', function() {
            $('.due-date').toggle();
            dueDatePicker.open();
            return false;
        });
        $('.task-form .task-flag-project').bind('click', function() {
            const $flag = $(this);

            if($flag.hasClass('active')) {
                $flag.removeClass('active');
                $flag.closest('.task-form').find('#task-project-flagged').val('false');
            } else {
                $flag.addClass('active');
                $flag.closest('.task-form').find('#task-project-flagged').val('true');
            }

            return false;
        });
    }

    /*if($('#task_dueDate').length) {
        const picker = datepicker('#task_dueDate', {
            formatter: (input, date, instance) => {
                const dtf = new Intl.DateTimeFormat('en', { year: 'numeric', month: '2-digit', day: '2-digit' })
                const [{ value: month },,{ value: day },,{ value: year }] = dtf.formatToParts(date)
                input.value = `${year}-${month}-${day} 00:00:00`
            }
        });
    }*/
});


// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

