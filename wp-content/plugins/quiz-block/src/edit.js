import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { TextControl, Button, PanelBody, PanelRow } from '@wordpress/components';
import { useState } from '@wordpress/element';
import { useSelect } from '@wordpress/data';

export default function Edit({ attributes, setAttributes }) {
    const { questions = [] } = attributes;
    const postId = useSelect((select) => select('core/editor').getCurrentPostId(), []); // Получаем ID текущего поста
    console.log("Post ID in edit.js:", postId);

    const addQuestion = () => {
        const newQuestions = [
            ...questions,
            { text: '', options: ['', '', '', ''], correctOption: 0 },
        ];
        setAttributes({ questions: newQuestions });
    };

    const updateQuestion = (index, field, value) => {
        const updatedQuestions = [...questions];
        updatedQuestions[index][field] = value;
        setAttributes({ questions: updatedQuestions });
    };

    const updateOption = (questionIndex, optionIndex, value) => {
        const updatedQuestions = [...questions];
        updatedQuestions[questionIndex].options[optionIndex] = value;
        setAttributes({ questions: updatedQuestions });
    };

    if (postId && attributes.postId !== postId) {
        setAttributes({ postId });
    }

    return (
        <div {...useBlockProps()}>
            <InspectorControls>
                <PanelBody title="Настройки теста">
                    <PanelRow>
                        <Button isPrimary onClick={addQuestion}>
                            Добавить вопрос
                        </Button>
                    </PanelRow>
                </PanelBody>
            </InspectorControls>
            <div className="quiz-block">
                {questions.map((question, questionIndex) => (
                    <div key={questionIndex} className="question-block">
                        <TextControl
                            label={`Вопрос ${questionIndex + 1}`}
                            value={question.text}
                            onChange={(value) => updateQuestion(questionIndex, 'text', value)}
                        />
                        {question.options.map((option, optionIndex) => (
                            <TextControl
                                key={optionIndex}
                                label={`Вариант ${optionIndex + 1}`}
                                value={option}
                                onChange={(value) => updateOption(questionIndex, optionIndex, value)}
                            />
                        ))}
                        <TextControl
                            label="Номер правильного ответа"
                            type="number"
                            value={question.correctOption + 1}
                            onChange={(value) =>
                                updateQuestion(questionIndex, 'correctOption', parseInt(value) - 1)
                            }
                            min="1"
                            max="4"
                        />
                    </div>
                ))}
            </div>
        </div>
    );
}
