$(document).ready(function () {
      var video_id;
      console.log(document.getElementById('artiste'));
      $.get("https://www.googleapis.com/youtube/v3/search", {type: 'video', part: 'id, snippet', key: "AIzaSyD0HX0kSeMKR_QWBYx-HE-6Wui9zL66ePU", q: $("#artiste").val(), maxResults: 1}, function (data, status) {
            video_id = data.items[0].id.videoId;
            console.log(video_id);
            var div = document.getElementById('player');
            var iframe = document.createElement('iframe');
            div.appendChild(iframe);
            iframe.width = 640
            iframe.height = 390;
            iframe.src = "http://www.youtube.com/embed/"+video_id+"?autoplay=1";
      }, 'jsonp');
});