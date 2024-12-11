document.getElementById('send-button').addEventListener('click', sendMessage);

function sendMessage() {
    const messageInput = document.getElementById('chat-input');
    const message = messageInput.value;
    if (message.trim() === '') return;

    fetch('send_message.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ sender: 'user', receiver: 'delivery', message })
    }).then(() => {
        messageInput.value = '';
        fetchMessages();
    });
}

function fetchMessages() {
    fetch('fetch_messages.php')
        .then(response => response.json())
        .then(messages => {
            const chatBox = document.getElementById('chat-box');
            chatBox.innerHTML = messages.map(msg => `<div><b>${msg.sender}:</b> ${msg.message}</div>`).join('');
            chatBox.scrollTop = chatBox.scrollHeight;
        });
}

// Initial fetch of messages
fetchMessages();
setInterval(fetchMessages, 3000); // Refresh messages every 3 seconds
