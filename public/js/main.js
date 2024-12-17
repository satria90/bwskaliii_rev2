// start: Sidebar
const sidebarToggle = document.querySelector('.sidebar-toggle')
const sidebarOverlay = document.querySelector('.sidebar-overlay')
const sidebarMenu = document.querySelector('.sidebar-menu')
const main = document.querySelector('.main')
if(window.innerWidth < 768) {
    main.classList.toggle('active')
    sidebarOverlay.classList.toggle('hidden')
    sidebarMenu.classList.toggle('-translate-x-full')
}
sidebarToggle.addEventListener('click', function (e) {
    e.preventDefault()
    main.classList.toggle('active')
    sidebarOverlay.classList.toggle('hidden')
    sidebarMenu.classList.toggle('-translate-x-full')
})
sidebarOverlay.addEventListener('click', function (e) {
    e.preventDefault()
    main.classList.add('active')
    sidebarOverlay.classList.add('hidden')
    sidebarMenu.classList.add('-translate-x-full')
})
document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (item) {
    item.addEventListener('click', function (e) {
        e.preventDefault()
        const parent = item.closest('.group')
        if (parent.classList.contains('selected')) {
            parent.classList.remove('selected')
        } else {
            document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (i) {
                i.closest('.group').classList.remove('selected')
            })
            parent.classList.add('selected')
        }
    })
})
// end: Sidebar

// start: Popper
const popperInstance = {}
document.querySelectorAll('.dropdown').forEach(function (item, index) {
    const popperId = 'popper-' + index
    const toggle = item.querySelector('.dropdown-toggle')
    const menu = item.querySelector('.dropdown-menu')
    menu.dataset.popperId = popperId
    popperInstance[popperId] = Popper.createPopper(toggle, menu, {
        modifiers: [
            {
                name: 'offset',
                options: {
                    offset: [0, 8],
                },
            },
            {
                name: 'preventOverflow',
                options: {
                    padding: 24,
                },
            },
        ],
        placement: 'bottom-end'
    });
})
document.addEventListener('click', function (e) {
    const toggle = e.target.closest('.dropdown-toggle')
    const menu = e.target.closest('.dropdown-menu')
    if (toggle) {
        const menuEl = toggle.closest('.dropdown').querySelector('.dropdown-menu')
        const popperId = menuEl.dataset.popperId
        if (menuEl.classList.contains('hidden')) {
            hideDropdown()
            menuEl.classList.remove('hidden')
            showPopper(popperId)
        } else {
            menuEl.classList.add('hidden')
            hidePopper(popperId)
        }
    } else if (!menu) {
        hideDropdown()
    }
})

function hideDropdown() {
    document.querySelectorAll('.dropdown-menu').forEach(function (item) {
        item.classList.add('hidden')
    })
}
function showPopper(popperId) {
    popperInstance[popperId].setOptions(function (options) {
        return {
            ...options,
            modifiers: [
                ...options.modifiers,
                { name: 'eventListeners', enabled: true },
            ],
        }
    });
    popperInstance[popperId].update();
}
function hidePopper(popperId) {
    popperInstance[popperId].setOptions(function (options) {
        return {
            ...options,
            modifiers: [
                ...options.modifiers,
                { name: 'eventListeners', enabled: false },
            ],
        }
    });
}
// end: Popper

// start: chart

// function createChart(ctx, label, data, backgroundColor) {
//     return new Chart(ctx, {
//         type: 'bar',
//         data: {
//             labels: ['Sangat Baik', 'Baik', 'Cukup', 'Buruk'],
//             datasets: [{
//                 label: label,
//                 data: data,
//                 borderWidth: 1,
//                 backgroundColor: backgroundColor,
//                 borderColor: 'rgba(0, 0, 0, 0.1)',
//             }]
//         },
//         options: {
//             responsive: true,
//             maintainAspectRatio: false,
//             scales: {
//                 y: {
//                     beginAtZero: true
//                 }
//             }
//         }
//     });
// }

// // // Data for each chart
// // const surveyData = [
// //     { label: 'Data Survey #1', data: [12, 19, 3, 5], backgroundColor: 'rgba(75, 192, 192, 0.2)' },
// //     { label: 'Data Survey #2', data: [8, 15, 6, 7], backgroundColor: 'rgba(153, 102, 255, 0.2)' },
// //     { label: 'Data Survey #3', data: [6, 11, 5, 9], backgroundColor: 'rgba(255, 159, 64, 0.2)' },
// //     { label: 'Data Survey #4', data: [14, 10, 7, 8], backgroundColor: 'rgba(255, 99, 132, 0.2)' },
// //     { label: 'Data Survey #5', data: [7, 16, 4, 6], backgroundColor: 'rgba(54, 162, 235, 0.2)' },
// //     { label: 'Data Survey #6', data: [10, 8, 9, 5], backgroundColor: 'rgba(255, 206, 86, 0.2)' },
// //     { label: 'Data Survey #7', data: [13, 11, 6, 8], backgroundColor: 'rgba(75, 192, 192, 0.2)' },
// //     { label: 'Data Survey #8', data: [9, 14, 5, 6], backgroundColor: 'rgba(153, 102, 255, 0.2)' },
// //     { label: 'Data Survey #9', data: [12, 12, 6, 7], backgroundColor: 'rgba(255, 159, 64, 0.2)' },
// //     { label: 'Data Survey #10', data: [8, 10, 7, 5], backgroundColor: 'rgba(255, 99, 132, 0.2)' },
// // ];

// // Create charts
// surveyData.forEach((survey, index) => {
//     const ctx = document.getElementById(`surveyChart${index + 1}`).getContext('2d');
//     createChart(ctx, survey.label, survey.data, survey.backgroundColor);
// });


// End: Chart

// const ctx = document.getElementById('surveyChart1').getContext('2d');
// const surveyChart = new Chart(ctx, {
//     type: 'bar', // Bar chart
//     data: {
//         labels: labels, // Pilihan untuk question1
//         datasets: [{
//             label: 'Jumlah Pilihan',
//             data: data, // Jumlah orang yang memilih masing-masing opsi
//             backgroundColor: 'rgba(75, 192, 192, 0.2)',
//             borderColor: 'rgba(75, 192, 192, 1)',
//             borderWidth: 1
//         }]
//     },
//     options: {
//         responsive: true, // Agar chart responsif terhadap perubahan ukuran layar
//         maintainAspectRatio: false, // Agar canvas menyesuaikan ukuran container
//         scales: {
//             y: {
//                 beginAtZero: true, // Memulai sumbu Y dari 0
//             }
//         }
//     }
// });\

//menampilkan data survey dengan bar
document.addEventListener("DOMContentLoaded", function() {
    if (typeof chartData === 'undefined') {
        console.error('Data chart tidak ditemukan.');
        return;
    }

    // Melakukan iterasi pada setiap data chart
    chartData.forEach((chart) => {
        const ctx = document.getElementById(chart.id)?.getContext('2d');
        if (!ctx) {
            console.error(`Canvas dengan id ${chart.id} tidak ditemukan.`);
            return;
        }

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chart.labels,
                datasets: [{
                    label: 'Jumlah Pilihan',
                    data: chart.data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 0.5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
});

