const btnMessage = document.querySelector('.chat-area button');
const chatBox = document.querySelector('.chat-area .chat-form');
// const btnCloseChat = document.querySelector('.chat-area .chat-form btn-close');
const closeChatBox = document.querySelector('.chat-area .chat-form #close-chatbox');
btnMessage.onclick = ()=>{
   btnMessage.classList.toggle('active')
   chatBox.classList.toggle('active');
}
closeChatBox.onclick= ()=>{
   chatBox.classList.toggle('active');
   btnMessage.classList.toggle('active')
}
