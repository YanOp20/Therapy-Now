// This code handles the chat functionality by joining a chat room, loading existing messages,
//  and dynamically updating the chat interface with new messages, including text, images, and audio.
   
const outgoingID = document.querySelector('.outgoing_id').value;
    const incomingID = document.querySelector('.incoming_id').value;
    const roomId = [outgoingID, incomingID].sort().join('-');



    chatNamespace.emit('get messages by user IDs', { outgoingID, incomingID    });


    chatNamespace.emit('join room', roomId);

    chatNamespace.on('load messages', messages => {

        messages.forEach((message) => {
            const chatElement = document.createElement('div');
            chatElement.classList.add('chat');
            if (message.outgoing_msg_id == outgoingID) {
                chatElement.classList.add('outgoing');
            } else {
                chatElement.classList.add('incoming');

                if (message.img) {
                    const imgElement = document.createElement('img');
                    imgElement.src = `php/images/${message.img}`;
                    imgElement.alt = "Profile picture";
                    chatElement.appendChild(imgElement);
                }
            }

            const detailsElement = document.createElement('div');
            detailsElement.classList.add('details');

            if (message.audio) {
                const audioElement = document.createElement('audio');
                audioElement.src = `php/uploads/${message.audio}`;
                audioElement.type = 'audio/wav';
                audioElement.controls = true;
                detailsElement.appendChild(audioElement);
            } else {
                const messageElement = document.createElement('p');
                messageElement.textContent = message.msg;
                detailsElement.appendChild(messageElement);
            }

            chatElement.appendChild(detailsElement);

            // Append the chat element to the chat box
            chatBox.appendChild(chatElement);
            // console.log(chatBox)
            if (!chatBox.classList.contains("active")) {
                scrollToBottom();
            }
        });
        chatBox.scrollTop = chatBox.scrollHeight;
        // document.querySelector('#mes').innerHTML = messages[0].msg
    });

    chatNamespace.on('new messages', (data) => {
        // console.log("new message", data);
        let class_name = "";
        let image = "";

        if (data.outgoingId != outgoingID) {
            class_name = 'incoming';

            if (data.img) {
                image = `<img src="php/images/${data.img}" alt="">`;
            }
        } else {
            class_name = 'outgoing';
        }

        const whatData = data.message && !data.audioDataUrl ?
            `<p>${data.message}</p>` :
            `<audio src="php/uploads/${data.audioDataUrl}" type="audio/wav" controls></audio>`;


        chatBox.innerHTML += `
            <div class="chat ${class_name}">
                ${image}
                <div class="details">
                ${whatData}
                </div>
            </div>
            `;
        if (!chatBox.classList.contains("active")) {
            scrollToBottom();
        }
    });
