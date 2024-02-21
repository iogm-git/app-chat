<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg grid sm:grid-cols-[max-content_1fr]">
                <div class="box-border w-full sm:w-[212px] md:w-[325px]">
                    <p class="hidden sm:block font-bold p-5">{{ $user->name }}</p>
                    <hr class="hidden sm:block">
                    <div class="grid gap-[1px] grid-cols-1 mt-3">
                        <small class="text-center text-xs rounded-sm mx-5 mb-3">Contact</small>
                        <div class="grid gap-2 max-h-[30vh] sm:max-h-[50vh] overflow-auto">
                            @foreach ($users as $item)
                                @if ($item->id !== $user->id)
                                    <div onclick="show({{ $item->id }}, '{{ $item->name }}')"
                                        class="p-5 cursor-pointer border-l-4 border-indigo-700 font-bold text-indigo-700 hover:bg-indigo-50">
                                        {{ $item->name }}</div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div
                    class="bg-gray-100 sm:border-l-[1px] border-t-2 sm:border-t-0 border-gray-100 grid grid-rows-[max-content_1fr_max-content]">
                    <div class="bg-white p-5 text-center font-bold" id="chat-to-user">...</div>
                    <div class="grid gap-2 box-border overflow-auto p-5 auto-rows-max"
                        style="max-height: 50vh; min-height: 40vh" id="chat-messages"></div>
                    <div class="bg-white p-5">
                        <div id="chat-send-box">

                        </div>
                        <p class="text-red-700 mt-2 text-sm font-bold" id='chat-error'></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let chatMessages = document.getElementById('chat-messages')
        let chatSendBox = document.getElementById('chat-send-box')
        let errorMessage = document.getElementById('chat-error')
        let toUser = document.getElementById('chat-to-user')
        let idToUser = 0

        function sendMessage() {
            errorMessage.innerHTML = ''
            let inputMessage = document.getElementById('chat-message')
            window.axiosInstance.post('/chat', {
                    to_user: idToUser,
                    message: inputMessage.value
                })
                .then(() => {
                    inputMessage.value = ''
                })
                .catch(({
                    response
                }) => {
                    errorMessage.innerHTML = response.data;
                    console.log(response);
                });
        }

        function show(id, name) {
            idToUser = id

            while (chatMessages.firstChild) {
                chatMessages.removeChild(chatMessages.firstChild);
            }

            while (chatSendBox.firstChild) {
                chatSendBox.removeChild(chatSendBox.firstChild);
            }

            toUser.innerHTML = 'Loading...'

            window.axiosInstance.post('/chat/show', {
                to_user: id
            }).then(({
                data
            }) => {
                toUser.innerHTML = name

                let chatForm = document.createElement('div')
                chatForm.className = 'grid grid-cols-[1fr_max-content] gap-4'

                let chatInput = document.createElement('input')
                chatInput.className = 'rounded-md border-gray-200'
                chatInput.id = 'chat-message'
                chatInput.setAttribute("type", "text");
                chatInput.setAttribute("placeholder", "Messages...")

                let chatButtonSend = document.createElement('button')
                chatButtonSend.className =
                    'bg-indigo-600 hover:shadow-md hover:underline hover:shadow-indigo-200 text-indigo-50 h-[30px] self-center rounded text-sm px-4'
                chatButtonSend.textContent = 'Send'
                chatButtonSend.onclick = sendMessage

                chatForm.appendChild(chatInput)
                chatForm.appendChild(chatButtonSend)
                chatSendBox.appendChild(chatForm)

                if (data.messages.length > 0) {
                    data.messages.forEach(element => {
                        var chatBox = document.createElement('div')
                        var chatMessage = document.createElement('p')
                        var chatTime = document.createElement('small')

                        chatBox.style.minWidth = '30vw'
                        chatBox.style.maxWidth = '70vw'
                        chatBox.className =
                            `grid p-3 w-max rounded-md ${element.user_id[0].id == {{ $user->id }} ? 'justify-self-end bg-indigo-700 text-indigo-50' : 'bg-white' }`
                        chatTime.className =
                            `text-xs justify-self-end mt-2 ${element.id == {{ $user->id }} ? 'text-indigo-400' : 'text-gray-400' }`

                        chatBox.appendChild(chatMessage)
                        chatBox.appendChild(chatTime)

                        chatMessage.innerHTML = element.message
                        chatTime.innerHTML = element.created_at

                        chatMessages.appendChild(chatBox)
                    });
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                } else {
                    var emptyMessage = document.createElement('div')
                    emptyMessage.className = 'place-self-center p-5 bg-red-100 text-red-800 font-bold rounded-md'
                    emptyMessage.innerHTML = 'No Chat'
                    chatMessages.appendChild(emptyMessage)
                }
            })
        }

        window.onload = function() {
            window.Echo.channel('messages').listen('MessageSent', data => {
                var chatBox = document.createElement('div')
                var chatMessage = document.createElement('p')
                var chatTime = document.createElement('small')

                chatBox.className =
                    `grid p-3 min-w-[30%] w-max max-w-[70%] rounded-md ${data.user == {{ $user->id }} ? 'justify-self-end bg-indigo-700 text-indigo-50' : 'bg-white' }`
                chatTime.className =
                    `text-xs justify-self-end mt-2 ${data.user == {{ $user->id }} ? 'text-indigo-400' : 'text-gray-400' }`

                chatBox.appendChild(chatMessage)
                chatBox.appendChild(chatTime)

                chatMessage.innerHTML = data.message
                chatTime.innerHTML = data.created_at

                chatMessages.appendChild(chatBox)
                chatMessages.scrollTop = chatMessages.scrollHeight;
            })

            if (toUser.innerHTML == '...') {
                let chatWarning = document.createElement('p')
                chatWarning.className = 'text-indigo-700'
                chatWarning.innerHTML = 'Click contact for send message'
                chatSendBox.appendChild(chatWarning)
            }
        }
    </script>
</x-app-layout>
