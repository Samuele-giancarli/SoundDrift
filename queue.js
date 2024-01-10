function get(id) {
    return document.getElementById(id);
}

function playNow(data) {
    let audio = get("audio");
    let title = get("title");
    let author = get("author");
    title.innerText = data.title;
    author.innerText = data.author;
    audio.src = data.url;
    audio.oncanplaythrough = play;
}

function play() {
    let button = get("playButton");
    let audio = get("audio");
    audio.play();
    button.innerHTML = "<i class=\"bi bi-pause\"></i> Pause";
    button.onclick = pause;
}

function pause() {
    let button = get("playButton");
    let audio = get("audio");
    audio.pause();
    button.innerHTML = "<i class=\"bi bi-play\"></i> Play";
    button.onclick = play;
}

function enableLoop(){
    let button = get("loopButton");
    let audio = get("audio");
    audio.loop = true;
    button.innerHTML = "<i class=\"bi bi-arrow-repeat\"></i> Disable Loop";
    button.onclick = disableLoop;
}

function disableLoop(){
    let button = get("loopButton");
    let audio = get("audio");
    audio.loop = false;
    button.innerHTML = "<i class=\"bi bi-arrow-repeat bgn-secondary\"></i> Enable Loop";
    button.onclick = enableLoop;
}