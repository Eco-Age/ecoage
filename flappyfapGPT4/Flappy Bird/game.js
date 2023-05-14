const canvas = document.getElementById("gameCanvas");
const ctx = canvas.getContext("2d");

// Variáveis do jogo
let frames = 0;
const gravity = 0.25;
const bird = {
    x: 50,
    y: canvas.height / 2,
    width: 20,
    height: 20,
    velocity: 0,
    jump: 4.6,
    update() {
        this.velocity += gravity;
        this.y += this.velocity;
    },
    draw() {
        ctx.fillStyle = "red";
        ctx.fillRect(this.x, this.y, this.width, this.height);
    },
};

const pipes = {
    width: 50,
    gap: 100,
    maxHeight: canvas.height / 2,
    minHeight: 100,
    velocity: 2,
    list: [],
    update() {
        if (frames % 100 === 0) {
            const height = Math.floor(Math.random() * (this.maxHeight - this.minHeight) + this.minHeight);
            this.list.push({
                x: canvas.width,
                y: 0,
                height,
            });
            this.list.push({
                x: canvas.width,
                y: height + this.gap,
                height: canvas.height - height - this.gap,
            });
            const hasCollectible = Math.random() < 0.5;
            if (hasCollectible) {
                collectibles.list.push({
                    x: canvas.width,
                    y: height + this.gap / 2 - collectibles.height / 2,
                    width: collectibles.width,
                    height: collectibles.height,
                });
            }
        }

        for (const pipe of this.list) {
            pipe.x -= this.velocity;
            if (pipe.x + this.width < 0) this.list.shift();
        }
    },
    draw() {
        ctx.fillStyle = "green";
        for (const pipe of this.list) {
            ctx.fillRect(pipe.x, pipe.y, this.width, pipe.height);
        }
    },
};

const collectibles = {
    width: 20,
    height: 20,
    list: [],
    update() {
        for (const collectible of this.list) {
            collectible.x -= pipes.velocity;
            if (collectible.x + this.width < 0) this.list.shift();
        }
    },
    draw() {
        ctx.fillStyle = "yellow";
        for (const collectible of this.list) {
            ctx.fillRect(collectible.x, collectible.y, this.width, this.height);
        }
    },
};

let collectedItems = 0;
let elapsedTime = 0;

function drawPipeGradient(pipe) {
    const gradient = ctx.createLinearGradient(pipe.x, pipe.y, pipe.x + pipes.width, pipe.y + pipe.height);
    gradient.addColorStop(0, "lightgreen");
    gradient.addColorStop(1, "darkgreen");
    ctx.fillStyle = gradient;
    ctx.fillRect(pipe.x, pipe.y, pipes.width, pipe.height);
}

function drawTextGradient(text, x, y) {
    const gradient = ctx.createLinearGradient(x, y - 20, x, y + 5);
    gradient.addColorStop(0, "orange");
    gradient.addColorStop(1, "yellow");
    ctx.fillStyle = gradient;
    ctx.fillText(text, x, y);
}

function collision(bird, object) {
    return bird.x < object.x + object.width &&
        bird.x + bird.width > object.x &&
        bird.y < object.y + object.height &&
        bird.y + bird.height > object.y;
}
function collision(bird, pipe) {
    return bird.x < pipe.x + pipes.width &&
        bird.x + bird.width > pipe.x &&
        bird.y < pipe.y + pipe.height &&
        bird.y + bird.height > pipe.y;
}

function detectCollisions() {
    for (const pipe of pipes.list) {
        if (collision(bird, pipe)) {
            return true;
        }
    }

    for (const collectible of collectibles.list) {
        if (collision(bird, collectible)) {
            collectedItems++;
            const index = collectibles.list.indexOf(collectible);
            collectibles.list.splice(index, 1);
        }
    }

    return bird.y <= 0 || bird.y + bird.height >= canvas.height;
}




function drawScore() {
    ctx.font = "20px Arial";
    ctx.fillStyle = "black";
    ctx.fillText(`Pontuação: ${Math.floor(frames / 100)}`, 10, 30);
    ctx.fillText(`Itens coletados: ${collectedItems}`, 10, 60);
    ctx.fillText(`Pontuação por tempo: ${elapsedTime * 10}`, 10, 90);
}

function gameLoop() {
    bird.update();
    pipes.update();
    collectibles.update();

    ctx.clearRect(0, 0, canvas.width, canvas.height);

    bird.draw();
    pipes.draw();
    collectibles.draw();
    drawScore();

    const collidedWithPipe = detectCollisions();
    if (collidedWithPipe) {
        gameOver();
        return;
    }

    for (const collectible of collectibles.list) {
        if (collision(bird, collectible)) {
            collectedItems++;
            const index = collectibles.list.indexOf(collectible);
            collectibles.list.splice(index, 1);
        }
    }

    frames++;
    requestAnimationFrame(gameLoop);
}

function gameOver() {
    ctx.font = "40px Arial";
    ctx.fillStyle = "black";
    ctx.fillText("Fim de jogo", canvas.width / 2 - 80, canvas.height / 2 - 20);
    ctx.font = "20px Arial";
    ctx.fillText(
        `Pontuação: ${Math.floor(frames / 100)}`,
        canvas.width / 2 - 50,
        canvas.height / 2 + 20
    );
    ctx.fillText(`Itens coletados: ${collectedItems}`, canvas.width / 2 - 55, canvas.height / 2 + 50);
    ctx.fillText(`Pontuação por tempo: ${elapsedTime * 10}`, canvas.width / 2 - 75, canvas.height / 2 + 80);
    ctx.font = "20px Arial";
    ctx.fillText("Clique para jogar novamente", canvas.width / 2 - 105, canvas.height / 2 + 110);
    canvas.addEventListener("click", restartGame);
}

function restartGame() {
    frames = 0;
    bird.y = canvas.height / 2;
    bird.velocity = 0;
    pipes.list = [];
    collectibles.list = [];
    collectedItems = 0;
    elapsedTime = 0;
    canvas.removeEventListener("click", restartGame);
    gameLoop();
}

function updateElapsedTime() {
    elapsedTime++;
    setTimeout(updateElapsedTime, 1000);
}

canvas.addEventListener("click", () => {
    bird.velocity = -bird.jump;
});

updateElapsedTime();
gameLoop();

