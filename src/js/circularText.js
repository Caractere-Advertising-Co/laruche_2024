function updateCurvedText($curvedText, radius) {
  var w = 60,
    h = 60;
  $curvedText.css("min-width", w + "px");
  $curvedText.css("min-height", h + "px");
  var text = $curvedText.text();
  var html = "";

  Array.from(text).forEach(function (letter) {
    html += `<span>${letter}</span>`;
  });
  $curvedText.html(html);

  var $letters = $curvedText.find("span");
  $letters.css({
    position: "absolute",
    height: `60px`,
    transformOrigin: "bottom center",
  });

  var angleRad = 150 / (2 * radius);
  var angle = (2 * angleRad * 180) / Math.PI / text.length;

  $letters.each(function (idx, el) {
    $(el).css({
      transform: `rotate(${idx * angle - (text.length * angle) / 2}deg)`,
    });
  });
  //translate(${w / 2}px,0px)
}

var $curvedText = $(".curved-text");
updateCurvedText($curvedText, 25);

function settingsChanged() {
  $curvedText.text($(".text").val());
  updateCurvedText($curvedText, $(".radius").val());
}

$(".radius").on("input change", settingsChanged);
$(".text").on("input change", settingsChanged);
