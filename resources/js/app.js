import './bootstrap';

import Alpine from 'alpinejs';


import {
    Carousel, Collapse, Dropdown, Tooltip, initTE, Chart,
} from "tw-elements";



initTE({ carousel: Carousel, Collapse, Dropdown, initTE, Tooltip, Chart });
// TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com 


const dataMixedChartExample = {
    type: 'bar',
    data: {
        labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday '],
        datasets: [
            // First dataset (bar)
            {
                label: 'Impressions',
                data: [2112, 2343, 2545, 3423, 2365, 1985, 987],
                order: 2,
            },
            // Second dataset (line)
            {
                label: 'Impressions (absolute top) %',
                data: [211, 2543, 2745, 3123, 2765, 1485, 587],
                type: 'line',
                order: 1,
                backgroundColor: 'rgba(66, 133, 244, 0.0)',
                borderColor: '#94DFD7',
                borderWidth: 2,
                pointBorderColor: '#94DFD7',
                pointBackgroundColor: '#94DFD7',
                lineTension: 0.0,
            },
        ],
    },
};

new Chart(document.getElementById('chart-mixed-example'), dataMixedChartExample);


window.Alpine = Alpine;

Alpine.start();
