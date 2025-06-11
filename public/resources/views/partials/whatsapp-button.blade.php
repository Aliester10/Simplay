@php 
    $compro = \App\Models\CompanyParameter::first();
@endphp

<!-- WhatsApp Icon -->
<div id="whatsapp-icon" onclick="toggleChatBox()">
    <i class="fab fa-whatsapp"></i>
</div>

<!-- Chat Box -->
<div id="whatsapp-chat-box" class="hidden">
    <div class="chat-header">
        <span><i class="fab fa-whatsapp"></i> WhatsApp</span>
        <button onclick="toggleChatBox()" class="close-btn">&times;</button>
    </div>
    <div class="chat-body">
        <div class="bubble">
            Selamat datang di website kami 👋<br>
            Apa yang dapat kami bantu?
        </div>
    </div>
    <div class="chat-footer">
        <button id="open-chat" onclick="openWhatsApp()">
            Open Chat
            <i class="fas fa-paper-plane"></i> <!-- Icon untuk tombol -->
        </button>
    </div>
</div>

<script>
    function toggleChatBox() {
        const chatBox = document.getElementById('whatsapp-chat-box');
        chatBox.classList.toggle('hidden');
    }

    function openWhatsApp() {
        const phoneNumber = '{{ $compro->no_wa }}';
        const formattedPhoneNumber = phoneNumber.replace(/\D/g, ''); // Remove non-numeric characters
        window.open(`https://wa.me/${formattedPhoneNumber}`, '_blank');
    }
</script>

<style>
    /* WhatsApp Icon */
    #whatsapp-icon {
        position: fixed;
        bottom: 40px;
        right: 120px;
        width: 60px;
        height: 60px;
        background-color: #25d366;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        z-index: 1000;
    }

    #whatsapp-icon i {
        color: white;
        font-size: 28px;
    }

    /* Chat Box */
    #whatsapp-chat-box {
        position: fixed;
        bottom: 110px;
        right: 120px;
        width: 320px;
        background-color: #f4f9f4;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        font-family: Arial, sans-serif;
    }

    #whatsapp-chat-box.hidden {
        display: none;
    }

    .chat-header {
        background-color: #25d366;
        color: white;
        padding: 10px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chat-header .close-btn {
        background: #68de68;
        border: none;
        color: white;
        font-size: 16px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    .chat-body {
        padding: 15px;
        background-color: #f4f9f4;
        display: flex;
        justify-content: flex-start;
    }

    .bubble {
        background-color: white;
        /* Warna bubble putih */
        border-radius: 15px;
        padding: 12px 15px;
        font-size: 14px;
        color: #333;
        line-height: 1.5;
        max-width: 80%;
        /* Membatasi ukuran bubble */
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        /* Efek bayangan */
        border: 1px solid #ddd;
    }

    .chat-footer {
        padding: 10px;
        text-align: right;
        /* Memindahkan tombol ke kanan */
        background-color: #f4f9f4;
        /* Match box background */
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    #open-chat {
        background-color: #25d366;
        color: white;
        border: none;
        padding: 10px 15px;
        font-size: 14px;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 10px;
        /* Memberi jarak dengan tombol kirim */
    }

    #open-chat i {
        margin-left: 5px;
    }

    #open-chat:hover {
        background-color: #1da851;
        /* Slightly darker green */
    }

    #send-chat {
        background-color: #0084ff;
        /* Warna biru untuk tombol kirim */
        color: white;
        border: none;
        padding: 10px;
        font-size: 14px;
        border-radius: 50%;
        cursor: pointer;
    }

    #send-chat i {
        font-size: 16px;
    }

    #send-chat:hover {
        background-color: #006fd3;
        /* Darker blue for hover */
    }
</style>