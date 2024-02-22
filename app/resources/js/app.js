// window.$ = window.jQuery = require('jquery');

require ('./bootstrap');

var items = document.getElementsByClassName("app_block");
var movePlayer = true;
var game = true;

for (var i = 0; i < items.length; i++) {
    items[i].addEventListener("click", function() {
        var collecion = document.querySelectorAll(".app_block:not(.active)");
        if(collecion.length == 1) {
            console.log(123);
            exit({win: "other"});
        }
        if( !this.classList.contains("active") ){

            if( movePlayer) {
                if(this.innerHTML == "") {
                    this.classList.add("active");
                    this.classList.add("active_x");
                    this.innerHTML = "x"
                }

                var result = checkMap();
                if( result.val) {
                    game = false;
                    setTimeout(function() {
                        exit(result);
                    }, 10);
                }

                movePlayer = !movePlayer;
            }

            if(game) {
                setTimeout(function() {
                    botMove();
                }, 200);
            }

        }
    });
}

function botMove() {
    var items = document.querySelectorAll(".app_block:not(.active)");

    var step = getRandomInt(items.length);

    items[ step ].innerHTML = "0";
    items[ step ].classList.add("active");
    items[ step ].classList.add("active_o");

    var result = checkMap();
    if( result.val) {
        setTimeout(function() {
            exit(result);
        }, 10);
    }

    movePlayer = !movePlayer;
}

function victoryAlgorithm() {

    // рутина?1 Не! Спасибо!
    var items = document.querySelectorAll(".app_block");

    if ( !items[4].classList.contains("active_x") ) {
        if(!items[4].classList.contains("active")) {
            appendValBot();
        }
    } else if ( !items[0].classList.contains("active") ) {
        appendValBot();
    } else if ( !items[2].classList.contains("active") ) {

    }
}

function appendValBot(a) {
    items[ a ].innerHTML = "0";
    items[ a ].classList.add("active");
    items[ a ].classList.add("active_o");
}

function getRandomInt(max) {
    return Math.floor(Math.random() * Math.floor(max));
}

function checkMap() {
    var block = document.querySelectorAll(".app_block");
    var items = [];
    for (var i = 0; i < block.length; i++) {
        items.push(block[i].innerHTML);
    }

    if ( items[0] == "x" && items[1] == 'x' && items[2] == 'x' ||
        items[3] == "x" && items[4] == 'x' && items[5] == 'x' ||
        items[6] == "x" && items[7] == 'x' && items[8] == 'x' ||
        items[0] == "x" && items[3] == 'x' && items[6] == 'x' ||
        items[1] == "x" && items[4] == 'x' && items[7] == 'x' ||
        items[2] == "x" && items[5] == 'x' && items[8] == 'x' ||
        items[0] == "x" && items[4] == 'x' && items[8] == 'x' ||
        items[6] == "x" && items[4] == 'x' && items[2] == 'x' )
        return { val: true, win: "player"}
    if ( items[0] == "0" && items[1] == '0' && items[2] == '0' ||
        items[3] == "0" && items[4] == '0' && items[5] == '0' ||
        items[6] == "0" && items[7] == '0' && items[8] == '0' ||
        items[0] == "0" && items[3] == '0' && items[6] == '0' ||
        items[1] == "0" && items[4] == '0' && items[7] == '0' ||
        items[2] == "0" && items[5] == '0' && items[8] == '0' ||
        items[0] == "0" && items[4] == '0' && items[8] == '0' ||
        items[6] == "0" && items[4] == '0' && items[2] == '0' )
        return { val: true, win: "bot"}

    return {val: false}
}

function exit(obj) {
    var resultModal = document.getElementById("resultModal");
    var resultText = document.getElementById("resultText");
    var resultInput = document.getElementById("resultInput");

    if (obj.win === "player") {
        resultText.textContent = "Player wins";
        resultInput.value = "Player wins";
    } else if (obj.win === "bot") {
        resultText.textContent = "Bot wins";
        resultInput.value = "Bot wins";
    } else if (obj.win === "other") {
        resultText.textContent = "A draw";
        resultInput.value = "A draw";
    }

    resultModal.style.display = "block";
}

// document.getElementById("playAgainButton").addEventListener("click", function() {
//     // Перезагрузка страницы для начала новой игры
//     location.reload();
// });
