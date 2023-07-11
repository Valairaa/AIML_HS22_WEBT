// JavaScript Dokument für Canvas
var canvas = document.getElementById("freeShipping");
var context = canvas.getContext("2d");
canvas.height = 65;
canvas.width = window.innerWidth;
let timeUntilNextFrame = 1000 / 100; // 100 Bilder pro Sekunde
let position = { x: -200, y: 40 };

function animate() {
    update();
    context.clearRect(0, 0, window.innerWidth * 2, 100);
    draw(context);
}

function update() {
    position.x =  position.x + 1;
    if (position.x > window.innerWidth) { position.x = -window.innerWidth*0.5 };
}

function draw(context) {
    context.beginPath();
    context.fillStyle = "darkred";
    context.font = "24pt Arial";
    context.fillText("Kostenloser Versand!!! Nur HEUTE!!!", position.x, position.y);
    context.closePath();

    context.beginPath();
    context.moveTo(position.x + 180, 5);
    context.lineTo(position.x - position.x + window.innerWidth * 0.5, 5);
    context.lineWidth = 2;
    context.strokeStyle = "darkred";
    context.stroke();

    context.beginPath();
    context.moveTo(-position.x + position.x * 2, 60);
    context.lineTo(-position.x + window.innerWidth * 0.5, 60);
    context.lineWidth = 2;
    context.stroke();

    drawstar(position.x - 50, 15, 0.4);
    drawstar(position.x + 550, 15, 0.4);

    function drawstar(xPos, yPos, scale) {
        context.beginPath();
        context.moveTo(xPos + 0 * scale, yPos + 20 * scale);
        context.lineTo(xPos + 60 * scale, yPos + 20 * scale);
        context.lineTo(xPos + 30 * scale, yPos + 70 * scale);
        context.lineTo(xPos + 0 * scale, yPos + 20 * scale);

        context.fillStyle = "#darkred";
        context.fill();
        context.moveTo(xPos + 0 * scale, yPos + 50 * scale);
        context.lineTo(xPos + 60 * scale, yPos + 50 * scale);
        context.lineTo(xPos + 30 * scale, yPos + 0 * scale);
        context.lineTo(xPos + 0 * scale, yPos + 50 * scale);
        context.stroke();
        context.closePath();

        context.fillStyle = "#darkred";
        context.fill();

        context.lineWidth = 1;
        context.strokeStyle = '#darkred';
        context.stroke();
    }
}
setInterval(animate, 10);