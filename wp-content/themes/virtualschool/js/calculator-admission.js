function admission() {
    var result1 = "Информационные системы и технологии в дизайне";
    var result2 = "Информационные технологии и программные комплексы";
    var result3 = "Промышленная электроника";
    var result4 = "Микроэлектроника и твердотельная электроника";
    b = document.all.object.selectedIndex;
    c = document.all.object.options[b].text;
    if (c == "Информатика") {
        if (Number(document.getElementById("score").value) >= 143) {
            document.getElementById("admission-result").innerHTML = result1;
        }
        else if (Number(document.getElementById("score").value) >= 133) {
            document.getElementById("admission-result").innerHTML = result2;
        }
    }
    else if (c == "Физика") {
        if (Number(document.getElementById("score").value) >= 131){
            document.getElementById("admission-result").innerHTML = result3;
        }
        else if (Number(document.getElementById("score").value) >= 125){
            document.getElementById("admission-result").innerHTML = result4;
        }
    }
}