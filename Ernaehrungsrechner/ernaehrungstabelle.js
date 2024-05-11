document.addEventListener('DOMContentLoaded', function() {
    fetchDailyIntake();
    checkFoodNotFound();
});

function checkFoodNotFound() {
    fetch('check_food_not_found.php')
        .then(response => response.json())
        .then(data => {
            if (data.foodNotFound) {
                document.getElementById('foodList').insertAdjacentHTML('beforebegin', '<p>Das eingegebene Lebensmittel ist nicht in unserer Datenbank.</p>');
            }
        });
}

function fetchDailyIntake() {
    fetch('fetch_daily_intake.php')
        .then(response => response.json())
        .then(data => {
            updateFoodList(data);
            updateDailySummary(data);
        });
}

function updateFoodList(data) {
    let foodListHtml = '';
    data.forEach(item => {
        foodListHtml += `<li>${item.foodName}: ${item.quantityInput}g (Protein: ${item.protein}g, Kohlenhydrate: ${item.carbohydrates}g, Fett: ${item.fat}g, Kalorien: ${item.calories}kcal)</li>`;
    });
    document.getElementById('foodList').innerHTML = foodListHtml;
}

function updateDailySummary(data) {
    let totalProtein = 0, totalCarbs = 0, totalFat = 0, totalCalories = 0;
    data.forEach(item => {
        totalProtein += parseFloat(item.protein);
        totalCarbs += parseFloat(item.carbohydrates);
        totalFat += parseFloat(item.fat);
        totalCalories += parseFloat(item.calories);
    });
    document.getElementById('dailySummary').innerText = `Protein: ${totalProtein.toFixed(2)}g, Kohlenhydrate: ${totalCarbs.toFixed(2)}g, Fett: ${totalFat.toFixed(2)}g, Kalorien: ${totalCalories.toFixed(2)}kcal`;
}

