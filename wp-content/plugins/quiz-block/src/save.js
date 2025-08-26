import { useBlockProps } from '@wordpress/block-editor';

export default function save({ attributes }) {
    const { questions = [], postId } = attributes; // Добавляем postId

    return (
        <div {...useBlockProps.save()} className="wp-block-quiz-block" data-test-id={postId}>
            {questions.length > 0 ? (
                questions.map((question, index) => (
                    <div key={index} className="question" data-correct-option={question.correctOption}>
                        <p>{question.text}</p>
                        {question.options.map((option, optionIndex) => (
                            <label key={optionIndex}>
                                <input type="radio" name={`question_${index}`} value={optionIndex} />
                                <p>{option}</p>
                            </label>
                        ))}
                    </div>
                ))
            ) : (
                <p>Нет вопросов в тесте</p>
            )}
            <button>Проверить ответы</button>
            <p id="quiz-result" style={{ marginTop: '10px', fontWeight: 'bold' }}></p>
        </div>
    );
}
