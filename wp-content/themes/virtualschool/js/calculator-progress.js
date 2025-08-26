function GPA() {
    var grades5 = Number(document.getElementById("GPA-grade-5").value);
    var grades4 = Number(document.getElementById("GPA-grade-4").value);
    var grades3 = Number(document.getElementById("GPA-grade-3").value);
    var grades2 = Number(document.getElementById("GPA-grade-2").value);
    var students = Number(document.getElementById("GPA-students").value);
    var sumgrades = grades5 + grades4 + grades3 + grades2;
    var grades = 5 * grades5 + 4 * grades4 + 3 * grades3 + 2 * grades2;
    if (sumgrades == students) {
        var result = grades / students;
    }
    else {
        var result = "Ошибка!";
    }
    document.getElementById("GPA-result").innerHTML = result;
}