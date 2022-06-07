function chooseGames () {
    let data = $('div.hidden').data('json');
    let genre_element = document.getElementById("genre");
    let genre = genre_element.options[genre_element.selectedIndex].value;
    let count_gamers = parseInt(document.getElementById("count_gamers").value);
    let max_price = parseInt(document.getElementById("max_price").value);
    if (count_gamers < 0 || max_price < 0)
        alert("Введите корректные значения!");
    if (genre === "" || count_gamers === "" || max_price === "")
        alert("Заполните, пожалуйста, все поля.")
    let isSomeThingFind = false;
    let result = document.getElementById("result");
    Object.values(data).forEach((game) => {
        if (game['genre'] === genre && game['min_gamers'] <= parseInt(count_gamers) && count_gamers <= parseInt(game['max_gamers']) && parseInt(game['price']) <= max_price) {
            if (!isSomeThingFind) {
                isSomeThingFind = true;
                result.innerHTML = "Вам подходит: " + game.title;
            } else {
                result.innerHTML += ", " + game.title;
            }
        }
    });
    if (!isSomeThingFind) {
        result.innerHTML = "К сожалению, ничего не нашлось(";
    } else {
        let btn = document.getElementById("button");
        btn.hidden = false;
    }
}