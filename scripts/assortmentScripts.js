function showAssortment(data){

    function printoutArea() {
        const output = document.querySelector('#assortment')

        if (!output) {
            alert("something went wrong")
        }

        removeAllChildNodes(output)
        printOutItemFromAssortment(output, data)
    }

    function removeAllChildNodes(parent) {
        while (parent.firstChild) {
            parent.removeChild(parent.firstChild)
        }
    }

    function printOutItemFromAssortment(node, data){
        if(data.length !== 1){
            Object.values(data).forEach((game) => {
                const path = "../images/" + game['id'] + ".png"
                const area = `
            <form method="post">
                <hr color="black">
                <div align="center">
                    <h1>${game['title']}</h1>
                    <img src=${path} height="500">
                    <h2>Описание</h2>
                    <p align="left">${game['description']}</p>
                    <input type="hidden" value=${game['id']} name="${game['id']}">
                    <input type="submit" value="Купить!">
                </div>
            </form>
            
        `

                node.insertAdjacentHTML('beforeend', area);
            })
        }
        else if(data.length === 1){
            Object.values(data).forEach((game) => {
                const path = "../images/" + game['id'] + ".png"
                const area = `
                <hr color="black">
                <div align="center">
                    <h1>${game['title']}</h1>
                    <img src=${path} height="400">
                    <h2>Количество игроков: от ${game['min_gamers']} до ${game['max_gamers']}</h2>
                    <h2>Цена: ${game['price']}</h2>
                    <input type="hidden" value=${game['id']} name="${game['id']}">
                    <hr color="black">
                    <div class="sell">
                        <h4>Данные заказчика</h4>
                        <form method="post">
                            <fieldset><legend>Ваше имя</legend><input name="customer_name" size="70" type="text"> <br> </fieldset>
                            <fieldset><legend>Адрес доставки</legend><input name="address" size="70" type="text"> <br> </fieldset>
                            <fieldset><legend>Номер телефона для связи с вами</legend><input name="telephone" size="70"> <br> </fieldset>
                            <input type="submit" value="Оформить заказ!">
                        </form>
                    </div> 
                    <br>
                    <br>
                </div>
            <br>
        `

                node.insertAdjacentHTML('beforeend', area);
            })
        }
    }

    printoutArea()

}
