function fetchTagesbilanz() {
    var date = document.getElementById('dateIn').value;
    fetch('tagesbilanz.php?dateIn=' + date)
        .then(response => response.json())
        .then(data => {
            updateFoodLi(data);
            updateDailySum(data);
        });
}

function updateFoodLi(data) {
    let foodLiHtml = '';
    data.forEach(item => {
        foodLiHtml += `<li>${item.foodName}: ${item.quantityInput}g (Protein: ${item.protein}g, Kohlenhydrate: ${item.carbohydrates}g, Fett: ${item.fat}g, Kalorien: ${item.calories}kcal)</li>`;
    });
    document.getElementById('foodLi').innerHTML = foodLiHtml;
}

function updateDailySum(data) {
    let totalProtein = 0, totalCarbs = 0, totalFat = 0, totalCalories = 0;
    data.forEach(item => {
        totalProtein += parseFloat(item.protein);
        totalCarbs += parseFloat(item.carbohydrates);
        totalFat += parseFloat(item.fat);
        totalCalories += parseFloat(item.calories);
    });
    document.getElementById('dailySum').innerText = `Protein: ${totalProtein.toFixed(2)}g, Kohlenhydrate: ${totalCarbs.toFixed(2)}g, Fett: ${totalFat.toFixed(2)}g, Kalorien: ${totalCalories.toFixed(2)}kcal`;
}

