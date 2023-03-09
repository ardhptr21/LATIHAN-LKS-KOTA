const preview = document.querySelector(".preview")
const red = document.getElementById("red")
const green = document.getElementById("green")
const blue = document.getElementById("blue")

function changeBgColor() {
  const rgb = `rgb(${red.value}, ${green.value}, ${blue.value})`
  preview.textContent = rgb;
  document.body.style.background = rgb;
}

red.oninput = changeBgColor;
green.oninput = changeBgColor;
blue.oninput = changeBgColor;