from transformers import AutoTokenizer, AutoModel

model_path = "D:\ChatGlm\chatglm-6b"
tokenizer = AutoTokenizer.from_pretrained(model_path, trust_remote_code=True)
model = AutoModel.from_pretrained(model_path, trust_remote_code=True).float()  # Без CUDA

print("Model loaded successfully!")

try:
    input_text = "Hello"
    
    # Подготовка токенов
    inputs = tokenizer(input_text, return_tensors="pt", padding=True, truncation=True)
    
    # Преобразование attention_mask в bool
    if 'attention_mask' in inputs:
        inputs['attention_mask'] = inputs['attention_mask'].bool()

    # Получение ответа
    response, _ = model.chat(tokenizer, input_text, history=[])
    print("Response:", response)
except Exception as e:
    print("Error during processing:", e)
