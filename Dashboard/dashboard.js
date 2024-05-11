document.addEventListener('DOMContentLoaded', function() {
    getDailyCalories();
    getWeightHistory(); 
});

const ctx = document.getElementById('weightChart').getContext('2d');
let weightChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [], // Datumsangaben
        datasets: [{
            label: 'Gewicht',
            data: [], // Gewichtsdaten
            backgroundColor: 'rgba(0, 123, 255, 0.5)',
            borderColor: 'rgba(0, 123, 255, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: false
            }
        }
    }
});

function addWeight() {
    var date = document.getElementById('datum').value;
    var weight = document.getElementById('gewicht').value;

    var url="speichere_gewicht.php" + "?datum=" + date +"&gewicht=" + weight;

    var xhr = new XMLHttpRequest();
    xhr.open("GET", url , true);
    xhr.onreadystatechange = getWeightHistory;
    xhr.send(null);
}

function getWeightHistory(){
    fetch('get_weight_history.php')
    .then(response => response.json())
    .then(data => {
        weightChart.data.labels = data.map(item => item.datum);
        weightChart.data.datasets[0].data = data.map(item => item.gewicht);
        weightChart.update();
    });
}

function getDailyCalories() {
    fetch('get_daily_calories.php')
        .then(response => response.json())
        .then(data =>{
             document.getElementById('calories').innerText = data.Tageskalorien + ' kcal'
             if (parseFloat(data.Tageskalorien) > parseFloat(data.berechneteKalorien)){
                document.getElementById('recomandation').innerText = 'Du hast heute zu viel gegessen, laut unseren Berechnungen solltest du maximal ' + data.berechneteKalorien.toFixed(2) + 'kcal zu dir nehmen, um dein Ziel zu erreichen!'
             }else{
                document.getElementById('recomandation').innerText = 'Du hast heute zu wenig gegessen, laut unseren Berechnungen solltest du mindestens ' + data.berechneteKalorien.toFixed(2) + 'kcal zu dir nehmen, um dein Ziel zu erreichen!'
             }
         });
}