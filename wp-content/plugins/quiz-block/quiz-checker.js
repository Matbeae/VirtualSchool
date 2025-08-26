document.addEventListener('DOMContentLoaded', () => {
    const quizContainers = document.querySelectorAll('.wp-block-quiz-block');

    quizContainers.forEach((quizContainer) => {
        const button = quizContainer.querySelector('button');
        const resultElement = quizContainer.querySelector('#quiz-result');

        button.addEventListener('click', () => {
            const questions = quizContainer.querySelectorAll('.question');
            let score = 0;

            questions.forEach((question, index) => {
                const correctOption = parseInt(question.dataset.correctOption, 10);
                const selectedOption = question.querySelector(`input[name="question_${index}"]:checked`);
                if (selectedOption && parseInt(selectedOption.value, 10) === correctOption) {
                    score++;
                }
            });

            const test_id = quizContainer.dataset.testId; // Получаем ID теста из data-атрибута
            const user_id = wpApiSettings.user_id;
            
            const maxScore = questions.length; // Максимальное количество правильных ответов
            const percentage = (score / maxScore) * 100;

            // Логика для перевода в 5-балльную систему
            let grade = 1; // Изначально ставим минимальный балл
            if (percentage >= 20 && percentage < 40) {
                grade = 2;
            } else if (percentage >= 40 && percentage < 60) {
                grade = 3;
            } else if (percentage >= 60 && percentage < 80) {
                grade = 4;
            } else if (percentage >= 80) {
                grade = 5;
            }

            const resultText = `Ваш результат: ${grade} баллов (${score} из ${maxScore})`;
            resultElement.textContent = resultText;

            if (user_id && test_id) {
                fetch(wpApiSettings.ajax_url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `action=update_user_test_results&user_id=${user_id}&test_id=${test_id}&score=${score}&grade=${grade}`,
                })
                .then(response => response.json())
                .then(data => console.log("Server Response:", data))
                .catch(error => console.error('Ошибка:', error));
            } else {
                console.error('Ошибка: test_id или user_id не определены.');
            }
        });
    });
});
