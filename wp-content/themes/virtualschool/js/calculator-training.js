function training() {
    var grades5 = Number(document.getElementById("training-grade-5").value);
    var grades4 = Number(document.getElementById("training-grade-4").value);
    var grades3 = Number(document.getElementById("training-grade-3").value);
    var grades2 = Number(document.getElementById("training-grade-2").value);
    var absence = Number(document.getElementById("training-absence").value);
    var students = Number(document.getElementById("training-students").value);
    var sumgrades = grades5 + grades4 + grades3 + grades2 + absence;
    var grades = grades5 + grades4 * 0.64 + grades3 * 0.36 + grades2 * 0.16 + absence * 0.08;
    if (sumgrades == students) {
        var result = grades / students;
    }
    else {
        var result = "Ошибка!";
    }
    document.getElementById("training-result").innerHTML = result;
}