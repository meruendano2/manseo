<!-- Gemini Section -->
<div id="gemini" class="gemini">
    <div class="section-container">
        <h2 class="section-title playfair">ASISTENTE VIRTUAL</h2>
        <p class="section-description">
            Nuestro asistente virtual está aquí para ayudarte con cualquier pregunta sobre nuestro restaurante.
        </p>
        
        <div class="gemini-container">
            <div class="chat-container">
                <div id="chat-messages" class="chat-messages">
                    <!-- Los mensajes se mostrarán aquí -->
                </div>
                <div id="loading-indicator" class="loading-indicator" style="display: none;">
                    <div class="spinner"></div>
                    <span>Procesando...</span>
                </div>
                <div class="chat-input">
                    <input type="text" id="user-input" placeholder="Escribe tu pregunta aquí...">
                    <button id="send-button" class="button button-primary">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatMessages = document.getElementById('chat-messages');
    const userInput = document.getElementById('user-input');
    const sendButton = document.getElementById('send-button');
    const loadingIndicator = document.getElementById('loading-indicator');

    function addMessage(message, isUser = false) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${isUser ? 'user-message' : 'bot-message'}`;
        messageDiv.textContent = message;
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function showError(message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.textContent = message;
        chatMessages.appendChild(errorDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    async function sendMessage() {
        const message = userInput.value.trim();
        if (!message) return;

        // Mostrar mensaje del usuario
        addMessage(message, true);
        userInput.value = '';
        loadingIndicator.style.display = 'flex';
        sendButton.disabled = true;

        try {
            console.log('Enviando mensaje a la API...');
            const response = await fetch('api/gemini_chat_new.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ message: message })
            });

            console.log('Respuesta recibida:', response.status);
            const data = await response.json();
            console.log('Datos recibidos:', data);
            
            if (data.error) {
                showError(data.error);
                console.error('Error del servidor:', data.error);
            } else {
                addMessage(data.response);
            }
        } catch (error) {
            console.error('Error en la petición:', error);
            showError('Error de conexión. Por favor, verifica tu conexión a internet e intenta de nuevo.');
        } finally {
            loadingIndicator.style.display = 'none';
            sendButton.disabled = false;
        }
    }

    sendButton.addEventListener('click', sendMessage);
    userInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });
});
</script> 