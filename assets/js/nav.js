function myFunction() {
    var x = document.getElementById("header");
    if (x.className === "navbar") {
      x.className += " responsive";
    } else {
      x.className = "navbar";
    }
  }