let video_box = document.getElementById("last-review-video-box");
let video_frame = document.getElementById("last-review-video-frame");
var selected = 0;

function onMouseEnterReviewBox(box)
{
    box.classList.add("last-review-box-selected");
}

function onMouseLeaveReviewBox(box, position)
{
    if(position != selected)
        box.classList.remove("last-review-box-selected");
}

function onMouseClickReviewBox(box, position, bg_url, youtube_id)
{
    var boxes = document.getElementsByClassName("last-review-box"), i;
    for(i = 0; i < boxes.length; i ++)
        boxes[i].classList.remove("last-review-box-selected");

    selected = position;
    box.classList.add("last-review-box-selected");
    
    video_box.style.backgroundImage = "url(" + bg_url + ")";
    video_frame.src = "https://www.youtube.com/embed/" + youtube_id;
}