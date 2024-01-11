let queue = new Array();
let queue_index = 0;

function get(id) {
    return document.getElementById(id);
}

function playNow(data, enqueue) {
    console.log(data);
    console.log(enqueue);
    if(!enqueue) {
        queue = new Array();
        queue_index = 0;
    }
    queue.push(data);
    if(queue.length - 1 == queue_index) {
        playCurrentSong();
    } else if(queue.length - 2 == queue_index) {
        let next = get("next");
        next.innerText = data.title;
    }
}

function nextSong() {
    if(queue_index < queue.length) {
        queue_index += 1;
    }
    playCurrentSong();
}

function prevSong() {
    if(queue_index <= 0) {
        queue_index = 0;
    } else {
        queue_index -= 1;
    }
    playCurrentSong();
}

function playCurrentSong() {
    let audio = get("audio");
    let title = get("title");
    let author = get("author");
    let next = get("next");
    if(queue_index >= queue.length) {
        audio.onended = null;
        audio.oncanplaythrough = null;
        pause();
        audio.src = "";
        title.innerText = "Nome del brano";
        author.innerText = "Nome dell'artista";
        next.innerText = "";
        return;
    }
    let data = queue[queue_index];
    title.innerText = data.title;
    author.innerText = data.author;
    if(queue_index + 1 < queue.length) {
        next.innerText = queue[queue_index + 1].title;
    } else {
        next.innerText = "";
    }
    audio.src = data.url;
    audio.oncanplaythrough = play;
    audio.onended = nextSong;
}

function volumeUpdate() {
    let volume = get("volume");
    audio.volume = volume.value;
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