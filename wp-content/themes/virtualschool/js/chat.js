// document.addEventListener("DOMContentLoaded", function () {
//     const chatbox = document.createElement("div");
//     chatbox.style.position = "fixed";
//     chatbox.style.bottom = "10px";
//     chatbox.style.right = "10px";
//     chatbox.style.width = "300px";
//     chatbox.style.height = "400px";
//     chatbox.style.border = "1px solid #ccc";
//     chatbox.style.borderRadius = "10px";
//     chatbox.style.boxShadow = "0px 4px 6px rgba(0, 0, 0, 0.1)";
//     chatbox.style.background = "#fff";
//     chatbox.style.overflow = "hidden";
//     chatbox.style.display = "flex";
//     chatbox.style.flexDirection = "column";
//     document.body.appendChild(chatbox);

//     const chatWindow = document.createElement("div");
//     chatWindow.style.flex = "1";
//     chatWindow.style.overflowY = "auto";
//     chatWindow.style.padding = "10px";
//     chatbox.appendChild(chatWindow);

//     const inputContainer = document.createElement("div");
//     inputContainer.style.display = "flex";
//     inputContainer.style.borderTop = "1px solid #ccc";
//     chatbox.appendChild(inputContainer);

//     const input = document.createElement("input");
//     input.style.flex = "1";
//     input.style.border = "none";
//     input.style.padding = "10px";
//     input.style.outline = "none";
//     inputContainer.appendChild(input);

//     const sendButton = document.createElement("button");
//     sendButton.textContent = "Send";
//     sendButton.style.border = "none";
//     sendButton.style.padding = "10px";
//     sendButton.style.cursor = "pointer";
//     inputContainer.appendChild(sendButton);

//     sendButton.addEventListener("click", async function () {
//         const userInput = input.value;
//         if (!userInput) return;
//         chatWindow.innerHTML += `<div>User: ${userInput}</div>`;
//         input.value = "";

//         const response = await fetch("http://localhost:5000/chat", {
//             method: "POST",
//             headers: {
//                 "Content-Type": "application/json",
//             },
//             body: JSON.stringify({ input: userInput }),
//         });
//         const data = await response.json();
//         chatWindow.innerHTML += `<div>Bot: ${data.response}</div>`;
//     });
// });
